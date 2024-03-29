<?php
ClassLoader::import("application.model.delivery.DeliveryZone");

/**
 * Country assignment to a DeliveryZone 
 *
 * @package application.model.delivery
 * @author Integry Systems <http://integry.com> 
 */
class DeliveryZoneCountry extends ActiveRecordModel 
{
	public static function defineSchema($className = __CLASS__)
	{
		$schema = self::getSchemaInstance($className);
		$schema->setName("DeliveryZoneCountry");
		
		$schema->registerField(new ARPrimaryKeyField("ID", ARInteger::instance()));
		$schema->registerField(new ARForeignKeyField("deliveryZoneID", "DeliveryZone", "ID", "DeliveryZone", ARInteger::instance()));
		$schema->registerField(new ARField("countryCode", ARChar::instance(2)));
	}

	/**
	 * @return DeliveryZoneCountry
	 */
	public static function getNewInstance(DeliveryZone $zone, $countryCode)
	{
	  	$instance = ActiveRecord::getNewInstance(__CLASS__);
	  	
	  	$instance->deliveryZone->set($zone);
	  	$instance->countryCode->set($countryCode);
	  	
	  	return $instance;
	}

	/**
	 * @param DeliveryZone $zone
	 * 
	 * @return ARSet
	 */
	public static function getRecordSetByZone(DeliveryZone $zone, $loadReferencedRecords = false)
	{
		$filter = new ARSelectFilter();
		$filter->setCondition(new EqualsCond(new ARFieldHandle(__CLASS__, 'deliveryZoneID'), $zone->getID()));
		
		return self::getRecordSet(__CLASS__, $filter, $loadReferencedRecords);
	}

	public static function removeByZone(DeliveryZone $zone)
	{
		$filter = new ARDeleteFilter();
		$filter->setCondition(new EqualsCond(new ARFieldHandle(__CLASS__, 'deliveryZoneID'), $zone->getID()));
		
		return ActiveRecord::deleteRecordSet(__CLASS__, $filter);
	}
}

?>