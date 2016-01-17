<?php

ClassLoader::import('application.model.eav.EavAble');
ClassLoader::import('application.model.eav.EavObject');
ClassLoader::importNow('application.helper.CreateHandleString');


/**
 * Static site pages (shipping information, contact information, terms of service, etc.)
 *
 * @package application.model.eyeexam
 * @author Integry Systems <http://integry.com>
 */
class EyeExamRequest extends MultilingualObject implements EavAble
{
	public static function defineSchema($className = __CLASS__)
	{
		$schema = self::getSchemaInstance($className);
		$schema->setName($className);
		$schema->registerField(new ARPrimaryKeyField("ID", ARInteger::instance()));
//		$schema->registerField(new ARField("firstName", ARVarchar::instance(255)));
//        $schema->registerField(new ARField("lastName", ARVarchar::instance(255)));
//		$schema->registerField(new ARField("phone", ARVarchar::instance(255)));
//		$schema->registerField(new ARField("email", ARVarchar::instance(255)));
//		$schema->registerField(new ARField("chip", ARBool::instance()));
		$schema->registerField(new ARField("date", ARDateTime::instance()));
        $schema->registerField(new ARField("time", ARTime::instance()));
		$schema->registerField(new ARForeignKeyField("eavObjectID", "eavObject", "ID", 'EavObject', ARInteger::instance()), false);

	}

	/*####################  Static method implementations ####################*/

	/**
	 * Gets an existing record instance (persisted on a database).
	 * @param mixed $recordID
	 * @param bool $loadRecordData
	 * @param bool $loadReferencedRecords
	 * @param array $data	Record data array (may include referenced record data)
	 *
	 * @return EyeExamRequest
	 */
	public static function getInstanceByID($recordID, $loadRecordData = false, $loadReferencedRecords = false, $data = array())
	{
		return parent::getInstanceByID(__CLASS__, $recordID, $loadRecordData, $loadReferencedRecords, $data);
	}

	public static function getNewInstance()
	{
		return parent::getNewInstance(__CLASS__);
	}

}

?>