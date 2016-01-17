<?php

ClassLoader::import('module.store-cloning.plugin.controller.base.init.AddRatingFieldToSchema');

class PreloadVariations extends ControllerPlugin
{
	public function process()
	{
		AddRatingFieldToSchema::process();

		$main = Product::getInstanceByID($this->request->get('id'), true);

		if ($main->parent->get())
		{
			$main->parent->get()->load();
			$var = $main->toArray();
			$var['custom'] = $main->custom->get();
			$this->request->set('variation', $var);

			$this->request->set('activeVariationID', $this->request->get('id'));
			$main = $main->parent->get();

			$this->request->set('id', $main->getID());

			$productArray = $main->toArray();
			$handle = empty($productArray['URL']) ? $productArray['name_lang'] : $productArray['URL'];
			$this->request->set('producthandle', $handle);
		}

		ActiveRecord::clearPool();

		$variations = $main->getRelatedRecordSet('Product', select());
		$handle = $main->URL->get() ? $main->URL->get() : $main->getValueByLang('name', 'en');
		foreach ($variations as $variation)
		{
			$variation->setValueByLang('name', 'en', $main->getValueByLang('name', 'en') . ' ' . $variation->sku->get());
			$variation->URL->set($handle . ' ' . $variation->sku->get());
			$variation->parent->set(null);
		}

		$variations->toArray();
	}
}

?>
