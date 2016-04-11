<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/1/16
 * Time: 09:10
 */

ClassLoader::import('application.model.datasync.api.reader.ApiReader');

class XmlOrderedItemOptionApiReader extends ApiReader {
    protected $xmlKeyToApiActionMapping = array
    (
        'list' => 'filter'
    );

    public static function getXMLPath()
    {
        return '/request/ordered_item_option';
    }

    public function loadDataInRequest($request)
    {
        $apiActionName = $this->getApiActionName();
        $shortFormatActions = array('get');
        if(in_array($apiActionName, $shortFormatActions))
        {
            $request = parent::loadDataInRequest($request, '//', $shortFormatActions);
            $request->set('orderedItemID',$request->get($apiActionName));
            $request->remove($apiActionName);
        } else {
            $request = parent::loadDataInRequest($request, self::getXMLPath().'//', $this->getApiFieldNames());
        }
        return $request;
    }
    public function getARSelectFilter()
    {
        return parent::getARSelectFilter('OrderedItemOption');
    }
}

?>