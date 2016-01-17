<?php

ClassLoader::import("module.store-cloning.plugin.model.productImage.array.SeoProductImage");

class SeoImageArray extends ControllerPlugin
{
	public function process()
	{
		$images = $this->response->get('images');
		$product = $this->response->get('product');
		// add keywords to supplemental image paths.
		foreach($images as &$imageArray)
		{
			$imageArray['Product'] = $product;
			$modelPlugin = new SeoProductImage($imageArray, $this->application);
			$modelPlugin->process();
		}
		
		$this->response->set('images', $images);

		// set product keywords
		$keywords = $product['keywords'];
		if (!$keywords)
		{
			$keywords = $this->getDescrWords($product['name_lang'] . ', '. $product['shortDescription_lang']);
		}

		//$product['keywords'] = $keywords;
		$this->response->set('product', $product);
    }

    private function getDescrWords($descr)
    {
    	$descr = strtolower($descr);
    	preg_match_all('/([a-zA-Z]{3,})/', $descr, $words);
    	$words = array_unique($words[0]);
    	return implode(', ', $words);
	}
}
?>
