<?php

ClassLoader::import("application.controller.FrontendController");
ClassLoader::import('module.eye-exam.application.model.eyeexam.EyeExamRequest');
ClassLoader::import('module.eye-exam.application.model.eyeexam.EyeExamSchedule');

/**
 * Displays static pages
 *
 * @author Integry Systems
 * @package application.controller
 */
class EyeExamController extends FrontendController
{
    private $regex_date_patern = '/^[0-9]{4}-([1-9]|0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
    const ACTIVE_DATES_LIMIT = 14;

	public function index()
	{
		// why not loaded automatically?
		$this->loadLanguageFile('Frontend');

        $this->addBreadCrumb($this->translate('_contact_us'), $this->router->createUrl(array('controller' => 'EyeExam')));

        if (!isset($locale))
        {
            $locale = self::getApplication()->getLocale();
        }

        $dates = self::getActiveDates();

        $schedule = array();
        foreach ($dates as $date)
        {
            $date_numeric = strtotime($date);
            $date_localized = $locale->getFormattedTime($date_numeric);
            $date_formatted = $date_localized['date_long'];
            $schedule[$date_formatted] = array();
            $nowDoctorName = null;
            $workingHours = self::getActiveTimeList($date);
            foreach ($workingHours as $workingHour)
            {
                $nowDoctorName = $workingHour['doctorName'];
                if (!isset($schedule[$date_formatted][$nowDoctorName]))
                {
                    $schedule[$date_formatted][$nowDoctorName] = array();
                    $schedule[$date_formatted][$nowDoctorName]['times'] = array();
                }
                $time = $workingHour['time'];
                $id = $workingHour['ID'];
                $schedule[$date_formatted][$nowDoctorName]['times'][$time] = $id;
                $schedule[$date_formatted][$nowDoctorName]['isVisible'] = $workingHour['isVisible'];
                $schedule[$date_formatted][$nowDoctorName]['doctorName'] = $nowDoctorName;
            }
            // clear $nowDoctorName
            $nowDoctorName = null;
        }

        $page = EyeExamRequest::getNewInstance();

		$pageArray = $page->toArray();
        $form = $this->buildForm();
        $form->setData($pageArray);

        $response = new ActionResponse('form', $form);
        $page->getSpecification()->setFormResponse($response, $form);

        $response->set('schedule', $schedule);

        return $response;
	}

    public function buildForm()
    {
        return new Form($this->buildValidator());
    }

    public function buildValidator(Request $request = null)
    {
        $request = $request ? $request : $this->request;

        $validator = $this->getValidator("contactForm", $request);
        $validator->addCheck('time',      new IsNotEmptyCheck($this->translate('_err_time')));
        $validator->addCheck('time',      new IsNumericCheck($this->translate('_err_time')));
        $validator->addCheck('surname',   new MaxLengthCheck('Please do not enter anything here', 0));

        return $validator;
    }

    public function send()
    {
        if (!$this->buildValidator()->isValid())
        {
            return new ActionRedirectResponse('EyeExam', 'index');
        }

        $eyeExamScheduleID = $this->request->get('time'); // this field is used for passing ID
        $eyeExamSchedule = EyeExamSchedule::getInstanceByID('EyeExamSchedule', $eyeExamScheduleID, ActiveRecord::LOAD_DATA);

        $requestDate = $eyeExamSchedule->date->get();
        $requestTime = $eyeExamSchedule->time->get();
        $eyeExamRequest = EyeExamRequest::getNewInstance();
        $eyeExamRequest->date->set( strtotime($requestDate) ); // does it still needed in DB??
        $eyeExamRequest->time->set($requestTime);              // does it still needed in DB??

        // custom fields
        $eyeExamRequest->getSpecification()->loadRequestData($this->request);

        $eyeExamRequest->save();

        $eyeExamSchedule->setFieldValue('eyeExamRequestID', $eyeExamRequest);
        $eyeExamSchedule->save();

        $email = new Email($this->application);
        $email->setTemplate('module/eye-exam/eyeExam/eyeExamRequestNotify');
        $email->setTo($this->config->get('NOTIFICATION_EMAIL'), $this->config->get('STORE_NAME'));
        $email->set('date', $requestDate);
        $email->set('time', $requestTime);
        $email->set('doctorName', $eyeExamSchedule->doctorName->get());
        $email->send();

        $response = new ActionResponse();
        $response->set('date', $requestDate);
        $response->set('time', $requestTime);

        $this->addBreadCrumb($this->translate('_title_lang'), $this->router->createUrl(array('controller' => 'EyeExam')));
        $this->addBreadCrumb($this->translate('_form_sent'), '');

        return $response;
    }

    private function getActiveTimeList($date) {
        $f = new ARSelectFilter();
        $f->setCondition(new AndChainCondition(array(
             eq(f('EyeExamSchedule.date'), 'DATE(\''.$date.'\')'),
             isnull(f('EyeExamSchedule.eyeExamRequestID')))));
        $f->setOrder(new ARFieldHandle('EyeExamSchedule', 'doctorName'), 'ASC');
        $f->setOrder(new ARFieldHandle('EyeExamSchedule', 'time'), 'ASC');
        $workingHours = ActiveRecordModel::getFieldValues('EyeExamSchedule', $f, array('ID', 'doctorName', 'time', 'isVisible'));

        return $workingHours;
    }

    private function getActiveDates() {
        $date = date("Y-m-d");

        $f = new ARSelectFilter();
        $f->setCondition(new AndChainCondition(array(
             gte(f('EyeExamSchedule.date'), $date),
             isnull(f('EyeExamSchedule.eyeExamRequestID')))));
        $f->setGrouping(f('EyeExamSchedule.date'));
        $f->setLimit(self::ACTIVE_DATES_LIMIT);
        $timeList = ActiveRecordModel::getRecordSetFields('EyeExamSchedule', $f, array('date'));

        // as result is an array of arrays with single value
        $activeTimes = array();

        foreach ($timeList as $id)
        {
            $activeTimes[] = $id['date'];
        }

        return $activeTimes;
    }
}

?>