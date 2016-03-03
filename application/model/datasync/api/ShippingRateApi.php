<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/26/16
 * Time: 19:22
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.delivery.ShippingRate');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class ShippingRateApi extends ModelApi{
    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlShippingRateApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            "ShippingRate",
            array()
        );
    }

    public function filter($emptyListIsException = false)
    {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $parser->loadDataInRequest($request);
        $f = new ARSelectFilter();
        $ID = $request->get('ID');
        $shippingServiceID = $request->get('shippingServiceID');

        if(intval($ID) > 0) {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('ShippingRate', 'ID'), $ID));
        }

        if(intval($shippingServiceID) > 0) {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('ShippingRate', 'shippingServiceID'), $shippingServiceID));
        }

        $shipping_rate = ActiveRecordModel::getRecordSetArray('ShippingRate', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        if($emptyListIsException && count($shipping_rate) == 0)
        {
            throw new Exception('ShippingService not found');
        }
        while($rate = array_shift($shipping_rate))
        {
            $xmlRate = $response->addChild('shipping_rate');
            foreach($rate as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $xmlRate->addChild($k, $v);
                }
            }
        }
        return new SimpleXMLResponse($response);
    }
}

?>