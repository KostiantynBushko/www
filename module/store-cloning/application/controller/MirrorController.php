<?php

ClassLoader::import('application.model.Product');
ClassLoader::import('application.model.ProductImage');

class MirrorController extends FrontendController
{
	public function index()
	{
		//error_reporting(E_ALL);ini_set('display_errors', 1);
		$product = Product::getInstanceByID($this->request->get('id'), true);
		$mirror = null;
		foreach ($product->getRelatedRecordSetArray('ProductImage', select()) as $image)
		{
			if ($image['title_lang'] == 'Virtual Mirror')
			{
				$mirror = $image['urls'][3];
			}
		}
		
		if ($mirror)
		{
			$response = new BlockResponse();
			$response->set('mirror', $mirror);
			return $response;
		}
	}
}
