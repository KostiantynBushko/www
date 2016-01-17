<?php

ClassLoader::import('application.controller.backend.abstract.StoreManagementController');
ClassLoader::import('module.eye-exam.application.model.eyeexam.EyeExamSchedule');
ClassLoader::import('module.eye-exam.application.model.eyeexam.EyeExamRequest');
ClassLoader::import('module.eye-exam.application.model.datasync.api.UserApi');

/**
 * @package application.controller.backend
 * @author Integry Systems
 * @role news
 */
class EyeExamScheduleController extends StoreManagementController
{
	public function index()
	{
		$f = new ARSelectFilter();
		$f->setOrder(new ARFieldHandle('EyeExamSchedule', 'doctorName'), 'ASC');
		$f->setOrder(new ARFieldHandle('EyeExamSchedule', 'date'), 'DESC');
        $f->setOrder(new ARFieldHandle('EyeExamSchedule', 'time'), 'ASC');
        $arrEyeSchedule = ActiveRecordModel::getRecordSetArray('EyeExamSchedule', $f);

		$response = new ActionResponse('eyeExamList', self::loadFormattedReferences($arrEyeSchedule));
		$response->set('form', $this->buildForm());

        $curDate = date("Y-m-d");
        $response->set('curDate', $curDate);

		return $response;
	}

     private function loadFormattedReferences($arrEyeSchedule)
     {
         if (!isset($locale))
         {
             $locale = self::getApplication()->getLocale();
         }
         foreach($arrEyeSchedule as & $item){
             $date = strtotime($item['date']);
             $item['formatted_date'] = $locale->getFormattedTime($date);
             $EyeExamRequestID = $item['eyeExamRequestID'];
             if ($EyeExamRequestID !== null) {
                 $EyeExamRequestItem = EyeExamRequest::getInstanceByID($EyeExamRequestID, ActiveRecordModel::LOAD_DATA);
                 $EyeExamRequestItem->getSpecification();

                 $EyeExamRequestItemAsArray = $EyeExamRequestItem->toArray();
                 $eyeExamRequest = array();
                 $eyeExamRequest['ID'] = $EyeExamRequestItemAsArray['ID'];
                 $eyeExamRequest['date'] = $EyeExamRequestItemAsArray['date'];
                 $eyeExamRequest['time'] = $EyeExamRequestItemAsArray['time'];

                 if (isset($EyeExamRequestItemAsArray['byHandle'])) {
                     $specialFields = array();
                     foreach ($EyeExamRequestItemAsArray['byHandle'] as $key => $value) {
                         $fieldName = $value['EavField']['name'];
                         $specialFields[$fieldName] = $value['value'];
                     }
                     $eyeExamRequest['specialFields'] = $specialFields;
                 }

                 $item['EyeExamRequest'] = $eyeExamRequest;
             }
         }
         return $arrEyeSchedule;
     }
	/**
	 * @role update
	 */
	public function edit()
	{
		$form = $this->buildForm();
		$form->loadData(EyeExamSchedule::getInstanceById($this->request->get('id'), EyeExamSchedule::LOAD_DATA)->toArray());
		return new ActionResponse('form', $form);
	}

	/**
	 * @role update
	 */
	public function save()
	{
		$validator = $this->buildValidator();
		if (!$validator->isValid())
		{
			return new JSONResponse(array('err' => $validator->getErrorList()));
		}

		$post = $this->request->get('id') ? ActiveRecordModel::getInstanceById('EyeExamSchedule', $this->request->get('id'), ActiveRecordModel::LOAD_DATA) : ActiveRecordModel::getNewInstance('EyeExamSchedule');
		$post->loadRequestData($this->request);
		$post->save();

        $postArr = $post->toArray();

        if (!isset($locale))
        {
            $locale = self::getApplication()->getLocale();
        }
        $date = strtotime($postArr['date']);
        $postArr['formatted_date'] = $locale->getFormattedTime($date);

		return new JSONResponse($postArr);
	}

	/**
	 * Create new record
	 * @role create
	 */
	public function add()
	{
		return $this->save();
	}

	/**
	 * Remove a news entry
	 *
	 * @role delete
	 * @return JSONResponse
	 */
	public function delete()
	{
		try
	  	{
			ActiveRecordModel::deleteById('EyeExamSchedule', $this->request->get('id'));
			return new JSONResponse(false, 'success');
		}
		catch (Exception $exc)
		{
			return new JSONResponse(false, 'failure', $this->translate('_could_not_remove_entry'));
		}
	}

	private function buildForm()
	{
		return new Form($this->buildValidator());
	}

	private function buildValidator()
	{
		$validator = $this->getValidator("eyeExamForm", $this->request);
		$validator->addCheck('date', new IsNotEmptyCheck($this->translate('_err_date_and_time')));
        $validator->addCheck('doctorName', new IsNotEmptyCheck($this->translate('_err_doctor_name')));

		return $validator;
	}

    public function printSchedule()
    {
        $date = $this->request->get('date');
        if ($date == null)
        {
            $date = date("Y-m-d");
        }
        $f = new ARSelectFilter();
        $f->setCondition(new EqualsCond(new ARFieldHandle('EyeExamSchedule', 'date'), $date));
        $f->setOrder(new ARFieldHandle('EyeExamSchedule', 'doctorName'), 'ASC');
        $f->setOrder(new ARFieldHandle('EyeExamSchedule', 'date'), 'ASC');
        $arrEyeSchedule = ActiveRecordModel::getRecordSetArray('EyeExamSchedule', $f, ActiveRecordModel::LOAD_REFERENCES);

        $this->application->setTheme('');
        $this->setLayout('frontend');
        $this->loadLanguageFile('Frontend');
        $this->loadLanguageFile('User');

        return new ActionResponse('schedule', self::loadFormattedReferences($arrEyeSchedule));
    }
}

?>