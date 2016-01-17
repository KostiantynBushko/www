<?php

ClassLoader::import("application.model.ActiveRecordModel");
ClassLoader::import("application.model.category.Category");
ClassLoader::import("module.store-cloning.application.model.ClonedStore");

/**
 * @author Integry Systems <http://integry.com>
 */
class ClonedStoreCategory extends ActiveRecordModel
{
	public static function defineSchema($className = __CLASS__)
	{
		$schema = self::getSchemaInstance($className);
		$schema->setName(__CLASS__);

		$schema->registerField(new ARPrimaryKeyField("ID", ARInteger::instance()));
		$schema->registerField(new ARForeignKeyField("categoryID", "Category", "ID", null, ARInteger::instance()));
		$schema->registerField(new ARForeignKeyField("storeID", "ClonedStore", "ID", null, ARInteger::instance()));
		$schema->registerField(new ARField("lastModifiedTime", ARDateTime::instance()));
	}

	/*####################  Static method implementations ####################*/

	/**
	 * Create new campaign
	 */
	public static function getNewInstance(Category $category, ClonedStore $store)
	{
		$instance = parent::getNewInstance(__CLASS__);
		$instance->category->set($category);
		$instance->store->set($store);
		return $instance;
	}
}

?>
