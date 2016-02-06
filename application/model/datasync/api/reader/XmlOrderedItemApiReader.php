<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/1/16
 * Time: 20:19
 */

ClassLoader::import('application.model.datasync.api.reader.ApiReader');

class XmlOrderedItemApiReader extends ApiReader{

    protected $xmlKeyToApiActionMapping = array
    (
        'list' => 'filter'
    );

    public static function getXMLPath()
    {
        return '/request/ordered_item';
    }

    public function loadDataInRequest($request)
    {
        $apiActionName = $this->getApiActionName();
        $shortFormatActions = array('get','delete');
        if(in_array($apiActionName, $shortFormatActions))
        {
            $request = parent::loadDataInRequest($request, '//', $shortFormatActions);
            $request->set('ID',$request->get($apiActionName));
            $request->remove($apiActionName);
        } else {
            $request = parent::loadDataInRequest($request, self::getXMLPath().'//', $this->getApiFieldNames());
        }
        return $request;
    }

    public function populate($updater, $profile)
    {
        parent::populate( $updater, $profile, $this->xml,
            self::getXMLPath().'/[[API_ACTION_NAME]]/[[API_FIELD_NAME]]', array('ID'));
    }

    public function getARSelectFilter()
    {
        return parent::getARSelectFilter('OrderedItem');
    }

    public function sanitizeFilterField($fieldName, &$value)
    {
        if(in_array($fieldName, array('ID', 'customerOrderID')))
        {
            $value = '%:"%'.$value.'%"%'; // lets try to find value in serialized array.
        }
        return $value;
    }
}

?>