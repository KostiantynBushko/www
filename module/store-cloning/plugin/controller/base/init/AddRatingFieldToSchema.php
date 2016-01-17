<?php

ClassLoader::import('application.model.product.Product');

class AddRatingFieldToSchema extends ControllerPlugin
{
	public function process()
	{
		static $beenHere = null;

		if (!$beenHere)		
		{
			Product::defineSchema();
			$schema = Product::getSchemaInstance('Product');
			$schema->registerField(new ArField('custom', ARText::instance()));
		}

		$beenHere = true;
	}
}

?>
