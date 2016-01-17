<?php

ClassLoader::import('application.controller.ApiController');

class ClonedApiController extends ApiController
{
	public function getDocInfo()
	{
		return parent::getDocInfo();
	}
}

?>
