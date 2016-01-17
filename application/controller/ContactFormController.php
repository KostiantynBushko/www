<?php

class ContactFormController extends FrontendController
{
	public function index()
	{
		$this->addBreadCrumb($this->translate('_contact_us'), $this->router->createUrl(array('controller' => 'contactForm')));
		return new ActionResponse('form', $this->buildForm());
	}

	public function send()
	{
		if (!$this->buildValidator()->isValid())
		{
			return new ActionRedirectResponse('contactForm', 'index');
		}

		$email = new Email($this->application);
		$email->setTemplate('contactForm/contactForm');
		$email->setFrom($this->request->get('email'), $this->request->get('name'));
		$email->setTo($this->config->get('NOTIFICATION_EMAIL'), $this->config->get('STORE_NAME'));
		$email->set('message', $this->request->get('msg'));
		$email->send();

		return new ActionRedirectResponse('contactForm', 'sent');
	}

	public function sent()
	{
		$this->addBreadCrumb($this->translate('_contact_us'), $this->router->createUrl(array('controller' => 'contactForm')));
		$this->addBreadCrumb($this->translate('_form_sent'), '');

		return new ActionResponse();
	}

	public function buildForm()
	{
		return new Form($this->buildValidator());
	}

	public function buildValidator(Request $request = null)
	{
		$request = $request ? $request : $this->request;

		$validator = $this->getValidator("contactForm", $request);
		$validator->addCheck('name', new IsNotEmptyCheck($this->translate('_err_name')));
		$validator->addCheck('email', new IsNotEmptyCheck($this->translate('_err_email')));
		$validator->addCheck('msg', new IsNotEmptyCheck($this->translate('_err_message')));
		$validator->addCheck('surname', new MaxLengthCheck('Please do not enter anything here', 0));

		return $validator;
	}

	public function captcha()
	{
		$_SESSION['captcha'] = substr(sha1(mt_rand()), 17, 6);

		$image = imagecreatetruecolor(150, 35);

		$width = imagesx($image);
		$height = imagesy($image);

		$black = imagecolorallocate($image, 0, 0, 0);
		$white = imagecolorallocate($image, 255, 255, 255);
		$red = imagecolorallocatealpha($image, 255, 0, 0, 75);
		$green = imagecolorallocatealpha($image, 0, 255, 0, 75);
		$blue = imagecolorallocatealpha($image, 0, 0, 255, 75);

		imagefilledrectangle($image, 0, 0, $width, $height, $white);

		imagefilledellipse($image, ceil(rand(5, 145)), ceil(rand(0, 35)), 30, 30, $red);
		imagefilledellipse($image, ceil(rand(5, 145)), ceil(rand(0, 35)), 30, 30, $green);
		imagefilledellipse($image, ceil(rand(5, 145)), ceil(rand(0, 35)), 30, 30, $blue);

		imagefilledrectangle($image, 0, 0, $width, 0, $black);
		imagefilledrectangle($image, $width - 1, 0, $width - 1, $height - 1, $black);
		imagefilledrectangle($image, 0, 0, 0, $height - 1, $black);
		imagefilledrectangle($image, 0, $height - 1, $width, $height - 1, $black);

		imagestring($image, 10, intval(($width - (strlen($this->session->data['captcha']) * 9)) / 2), intval(($height - 15) / 2), $this->session->data['captcha'], $black);

		header('Content-type: image/jpeg');

		imagejpeg($image);

		imagedestroy($image);
	}
}

?>