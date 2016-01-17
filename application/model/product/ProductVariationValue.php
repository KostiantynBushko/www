<?php

ClassLoader::import('application.model.ActiveRecordModel');
ClassLoader::import('application.model.product.Product');
ClassLoader::import('application.model.product.ProductVariation');

/**
 * Relates a product variation to particular product.
 *
 * @package application.model.product
 * @author Integry Systems <http://integry.com>
 */
class ProductVariationValue extends ActiveRecordModel
{
	public static function defineSchema($className = __CLASS__)
	{
		$schema = self::getSchemaInstance($className);
		$schema->setName($className);

		$schema->registerField(new ARPrimaryKeyField("ID", ARInteger::instance()));
		$schema->registerField(new ARForeignKeyField("productID", "Product", "ID", null, ARInteger::instance()));
		$schema->registerField(new ARForeignKeyField("variationID", "ProductVariation", "ID", null, ARInteger::instance()));
	}

	public static function getNewInstance(Product $product, ProductVariation $variation)
	{
		$instance = parent::getNewInstance(__CLASS__);
		$instance->product->set($product);
		$instance->variation->set($variation);
		return $instance;
	}
	
	public function delete()
	{
		if (ActiveRecordModel::getApplication()->getConfig()->get('CLONE_STORE_TYPE') == 'CLONE_STORE_MASTER')
		{
			return parent::delete();
		}
		else
		{
			ActiveRecordModel::executeUpdate('SET FOREIGN_KEY_CHECKS=0');
			ActiveRecordModel::executeUpdate('UPDATE ' . __CLASS__ . ' SET productID=NULL, variationID=NULL, protectedFields="|productID||variationID|" WHERE ID=' . $this->getID());
		}
	}
}

?>
