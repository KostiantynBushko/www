<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/6/16
 * Time: 10:02
 */

ClassLoader::import("application.model.ActiveRecordModel");

class UserApnToken extends ActiveRecordModel {

    public static function defineSchema($className = __CLASS__)
    {
        $schema = self::getSchemaInstance($className);
        $schema->setName("UserApnToken");

        $schema->registerField(new ARPrimaryKeyField("ID", ARInteger::instance()));
        $schema->registerField(new ARField("userID", ARInteger::instance()));
        $schema->registerField(new ARField("token", ARVarchar::instance(256)));
        $schema->registerField(new ARField("dateCreated", ARDateTime::instance()));
    }


    public static function getInstanceByID($recordID, $loadRecordData = false, $loadReferencedRecords = false, $data = array())
    {
        return parent::getInstanceByID(__CLASS__, $recordID, $loadRecordData, $loadReferencedRecords, $data);
    }

    public static function getInstanceByUserID($userID)
    {
        $filter = new ARSelectFilter();
        $filter->setCondition(new EqualsCond(new ARFieldHandle(__CLASS__, 'userID'), $userID));
        $recordSet = ActiveRecordModel::getRecordSet(__CLASS__, $filter);

        if (!$recordSet->size())  {
            return null;
        } else  {
            return $recordSet->get(0);
        }
    }

    public static function getInstanceByToken($token)
    {
        $filter = new ARSelectFilter();
        $filter->setCondition(new EqualsCond(new ARFieldHandle(__CLASS__, 'token'), $token));
        $recordSet = ActiveRecordModel::getRecordSet(__CLASS__, $filter);

        if (!$recordSet->size())  {
            return null;
        } else  {
            return $recordSet->get(0);
        }
    }


    public static function getNewInstance($userID, $token)
    {
        $instance = parent::getNewInstance(__CLASS__);
        if (isset($userID)) {
            $instance->userID->set($userID);
        }
        $instance->token->set($token);
        $instance->dateCreated->set(new ARSerializableDateTime());

        return $instance;
    }

    public static function getRecordSet(ARSelectFilter $filter, $loadReferencedRecords = false)
    {
        return parent::getRecordSet(__CLASS__, $filter, $loadReferencedRecords);
    }
}
?>