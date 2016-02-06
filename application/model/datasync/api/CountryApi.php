<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/6/16
 * Time: 08:40
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.delivery.Country');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class CountryApi extends ModelApi {
    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlCountryApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'Country',
            array() // fields to ignore in NewsPost model
        );
    }

    public function filter($emptyListIsException = false)
    {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $parser->loadDataInRequest($request);

        $countries = Country::getNewInstance()->getCountryList($this->application);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        foreach($countries as $k => $v) {
            $xmlState = $response->addChild('country');
            $xmlState->addChild("countryID", htmlentities($k));
            $xmlState->addChild("country_name", htmlentities($v));
        }
        return new SimpleXMLResponse($response);
    }
}

?>