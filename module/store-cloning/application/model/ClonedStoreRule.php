<?php

ClassLoader::import("application.model.ActiveRecordModel");
ClassLoader::import("module.store-cloning.application.model.ClonedStore");

/**
 * @author Integry Systems <http://integry.com>
 */
class ClonedStoreRule extends ActiveRecordModel
{
	const TYPE_TEXT = 0;
	const TYPE_SQL = 1;

	public static function defineSchema($className = __CLASS__)
	{
		$schema = self::getSchemaInstance($className);
		$schema->setName(__CLASS__);

		$schema->registerField(new ARPrimaryKeyField("ID", ARInteger::instance()));
		$schema->registerField(new ARForeignKeyField("storeID", "ClonedStore", "ID", null, ARInteger::instance()));
		$schema->registerField(new ARField("type", ARInteger::instance(2)));
		$schema->registerField(new ARField("entity", ARVarchar::instance(100)));
		$schema->registerField(new ARField("field", ARVarchar::instance(100)));
		$schema->registerField(new ARField("find", ARText::instance()));
		$schema->registerField(new ARField("repl", ARText::instance()));
		$schema->registerField(new ARField("query", ARText::instance(100)));
	}

	/*####################  Static method implementations ####################*/

	/**
	 * Create new advertiser
	 */
	public static function getNewInstance(ClonedStore $store, $type)
	{
		$instance = parent::getNewInstance(__CLASS__);
		$instance->store->set($store);
		$instance->type->set($type);
		return $instance;
	}
}

?>
