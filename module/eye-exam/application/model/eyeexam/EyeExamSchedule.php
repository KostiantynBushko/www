<?php

ClassLoader::import("application.model.ActiveRecordModel");

/**
 * News post entry
 *
 * @package application.model.news
 * @author Integry Systems <http://integry.com>
 */
class EyeExamSchedule extends MultilingualObject
{
	public static function defineSchema($className = __CLASS__)
	{
		$schema = self::getSchemaInstance($className);
		$schema->setName(__CLASS__);

		$schema->registerField(new ARPrimaryKeyField("ID", ARInteger::instance()));	
		$schema->registerField(new ARField("isVisible", ARBool::instance()));
		$schema->registerField(new ARField("doctorName", ARVarchar::instance(255)));
		$schema->registerField(new ARField("date", ARDate::instance()));
		$schema->registerField(new ARField("time", ARTime::instance()));
        $schema->registerField(new ARField("comment", ARText::instance()));
        $schema->registerField(new ARField("eyeExamRequestID", ARInteger::instance()));

        $schema->registerField(new ARForeignKeyField("eyeExamRequestID", "EyeExamRequest", "ID", null, ARInteger::instance()), false);
    }

    public static function getInstanceByDateTime($date, $time)
    {
        $f = new ARSelectFilter();
        $f->setCondition(new AndChainCondition(array(
            eq(f('EyeExamSchedule.date'), $date),
            eq(f('EyeExamSchedule.time'), $time),
            isnull(f('EyeExamSchedule.eyeExamRequestID')))));


        $s = self::getRecordSet('EyeExamSchedule', $f);

        if (!$s->size())
        {
            return null;
        }

        return $s->get(0);
    }
}

?>