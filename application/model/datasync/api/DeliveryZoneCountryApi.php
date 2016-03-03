<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/25/16
 * Time: 03:09
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.delivery.DeliveryZoneCountry');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class DeliveryZoneCountryApi extends ModelApi{
    protected $application;

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlDeliveryZoneCountryApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'DeliveryZoneCountry',
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
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('DeliveryZoneCountry', 'ID'), $ID));
        }

        $countryZones = ActiveRecordModel::getRecordSetArray('DeliveryZoneCountry', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        if($emptyListIsException && count($countryZones) == 0)
        {
            throw new Exception('DeliveryZoneCountry not found');
        }
        while($country_zone = array_shift($countryZones))
        {
            $xmlCountryZone = $response->addChild('delivery_zone_country');
            foreach($country_zone as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $xmlCountryZone->addChild($k, $v);
                }
            }
        }
        return new SimpleXMLResponse($response);
    }
}