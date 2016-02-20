<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/14/16
 * Time: 04:21
 */

ClassLoader::import('application.model.datasync.api.reader.ApiReader');

class XmlTransactionApiReader extends  ApiReader {
    protected $xmlKeyToApiActionMapping = array
    (
        'list' => 'filter'
    );

    public static function getXMLPath()
    {
        return '/request/transaction';
    }

    public function loadDataInRequest($request)
    {
        $apiActionName = $this->getApiActionName();
        $shortFormatActions = array('get'); // like <customer><delete>[customer id]</delete></customer>
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
}

?>