<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/6/16
 * Time: 08:49
 */

class Country extends ActiveRecordModel {

    public static function defineSchema($className = __CLASS__)
    {
        $schema = self::getSchemaInstance($className);
        $schema->setName($className);
    }

    public static function getNewInstance()
    {
        $instance = parent::getNewInstance(__CLASS__);
        return $instance;
    }

    public function getCountryList(LiveCart $application) {
        $countries = $application->getEnabledCountries();
        asort($countries);
        return $countries;
    }

}