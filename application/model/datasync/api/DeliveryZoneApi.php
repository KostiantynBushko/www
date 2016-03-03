<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/25/16
 * Time: 02:57
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.delivery.DeliveryZone');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class DeliveryZoneApi extends ModelApi {
    protected $application;

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlDeliveryZoneApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'DeliveryZone',
            array() // fields to ignore in  model
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

        if(!empty($countryID)) {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('DeliveryZone', 'ID'), $ID));
        }

        $zones = ActiveRecordModel::getRecordSetArray('DeliveryZone', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        if($emptyListIsException && count($zones) == 0)
        {
            throw new Exception('DeliveryZone not found');
        }
        while($zone = array_shift($zones))
        {
            $xmlZone = $response->addChild('delivery_zone');
            foreach($zone as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $xmlZone->addChild($k, $v);
                }
            }
        }
        return new SimpleXMLResponse($response);
    }
}