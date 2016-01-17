<?php

ClassLoader::import("framework.controller.exception.*");
ClassLoader::import("framework.controller.Controller");
ClassLoader::import("application.helper.*");
ClassLoader::import("application.model.system.Language");
ClassLoader::import("library.locale.*");
ClassLoader::import("library.locale.LCiTranslator");
ClassLoader::import("framework.request.validator.Form");
ClassLoader::import("application.helper.LiveCartValidator");

/**
 * Base controller for the whole application
 *
 * Store controller which implements common operations needed for both frontend and
 * backend
 *
 * @package application.controller
 * @author Integry Systems
 */
abstract class СaptchaController extends Controller implements LCiTranslator
{
	/**
	 * System user
	 *
	 * @var User
	 */
	protected $user = null;

	/**
	 * Session instance
	 *
	 * @var Session
	 */
	protected $session = null;

	/**
	 * Router instance
	 *
	 * @var Router
	 */
	protected $router = null;

	/**
	 * Locale
	 *
	 * @var Locale
	 */
	protected $locale = null;

	/**
	 * Configuration handler instance
	 *
	 * @var Config
	 */
	protected $config = null;

	/**
	 * Configuration files (language, registry)
	 */
	protected $configFiles = array();

	/**
	 * Roles
	 *
	 * @var RolesParser
	 */
	protected $roles;

	protected $cacheHandler;

	/**
	 * Bese controller constructor: restores user object by using session data and
	 * checks a permission to a requested action
	 *
	 * @param LiveCart $application Application instance
	 * @throws AccessDeniedExeption
	 */
	public function __construct(LiveCart $application)
	{
		parent::__construct($application);

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
