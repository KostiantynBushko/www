<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/30/16
 * Time: 04:55
 */

class XmlProductOptionChoiceApiReader extends ApiReader {
    protected $xmlKeyToApiActionMapping = array
    (
        'list' => 'filter'
    );

    public static function getXMLPath()
    {
        return '/request/product_option_choice';
    }

    public function loadDataInRequest($request)
    {
        $apiActionName = $this->getApiActionName();
        $shortFormatActions = array('get');
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
    public function getARSelectFilter()
    {
        return parent::getARSelectFilter('ProductOptionChoice');
    }
}

?>