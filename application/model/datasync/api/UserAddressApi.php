<?php
/**
 * User: Admin
 * Date: 1/28/16
 * Time: 13:57
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.user.UserAddress');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class UserAddressApi extends ModelApi{

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlUserAddressApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'UserAddress',
            array() // fields to ignore in NewsPost model
        );
    }

    public function filter($emptyListIsException = false)
    {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $parser->loadDataInRequest($request);
        $f = new ARSelectFilter();
        $id = $request->get('ID');
        if(intval($id) > 0) // get action
        {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('UserAddress', 'ID'), $id));
        } else {
            throw new Exception('Address ID is required');
        }

        $shipping_address = ActiveRecordModel::getRecordSetArray('UserAddress', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        if($emptyListIsException && count($shipping_address) == 0)
        {
            throw new Exception('UserAddress not found');
        }
        while($category = array_shift($shipping_address))
        {
            $xmlNewsPost = $response->addChild('user_address');
            foreach($category as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $xmlNewsPost->addChild($k, htmlentities($v));
                }
            }
        }
        return new SimpleXMLResponse($response);
    }

}