<?php
ClassLoader::import("module.store-cloning.plugin.model.SeoImagePlugin");

class SeoProduct extends SeoImagePlugin
{
	public function process()
	{
		try {
		static $total = 0;
		$total++;



		if(isset($this->object['DefaultImage']) && array_key_exists('-seo-image-has-keywords', $this->object['DefaultImage']))
		{
			return;
		}
	
		//$this->loadDefaultImage();

		if(isset($this->object['DefaultImage']) && array_key_exists('paths', $this->object['DefaultImage']))
		{
			//if (17 == $total) { var_dump($this->object); die('here'); }
			$product = $this->object;
			unset($product['DefaultImage']);
			$this->object['DefaultImage']['Product'] = $product;
			$this->object['DefaultImage']['Product']['DefaultImage'] = $this->object['DefaultImage'];
			$this->applyKeywords($this->object['DefaultImage']);
		}


			
		}
		catch (Exception $e)
		{
			die($e->getMessage());
		}
		
    }

    private function loadDefaultImage() //todo: other way of getting DefaultImage and product data here
    {
		if (!isset($this->object['DefaultImage']) && isset($this->object['defaultImageID']))  // in backend products->pricing tab there is no 'defaultImageID'.
		{
			$defaultImageArray = ActiveRecordModel::getRecordSetArray('ProductImage', select(eq(f('ProductImage.ID'), $this->object['defaultImageID'])));
			if(count($defaultImageArray) > 0)
			{
				$this->object['DefaultImage'] =  array_merge(current($defaultImageArray),
					array('Product' => ActiveRecord::getArrayData('Product-' . $this->object['ID'])));
			}
		}
	}
}

?>
