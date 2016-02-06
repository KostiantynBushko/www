<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/6/16
 * Time: 03:27
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.delivery.State');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class StateApi extends ModelApi {
    protected $application;

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlStateApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'State',
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
        $countryID = $request->get('countryID');

        if(!empty($countryID)) // get action
        {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('State', 'countryID'), $countryID));
        } else {
            throw new Exception('countryID is required');
        }

        $states = ActiveRecordModel::getRecordSetArray('State', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        if($emptyListIsException && count($states) == 0)
        {
            throw new Exception('UserAddress not found');
        }
        while($state = array_shift($states))
        {
            $xmlState = $response->addChild('state');
            foreach($state as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $xmlState->addChild($k, htmlentities($v));
                }
            }
        }
        return new SimpleXMLResponse($response);
    }
}

?>