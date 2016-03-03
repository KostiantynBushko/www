<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/20/16
 * Time: 12:53
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.delivery.ShippingService');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class ShippingServiceApi extends ModelApi {
    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlShippingServiceApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            "ShippingService",
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

        if(intval($ID) > 0) {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('ShippingService', 'ID'), $ID));
        }

        $service = ActiveRecordModel::getRecordSetArray('ShippingService', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        if($emptyListIsException && count($service) == 0)
        {
            throw new Exception('ShippingService not found');
        }
        while($ser = array_shift($service))
        {
            $xmlService = $response->addChild('shipping_service');
            foreach($ser as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $xmlService->addChild($k, $v);
                }
            }
        }
        return new SimpleXMLResponse($response);
    }
}