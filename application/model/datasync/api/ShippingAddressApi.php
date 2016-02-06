<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/27/16
 * Time: 21:38
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.user.ShippingAddress');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class ShippingAddressApi extends ModelApi {

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlShippingAddressApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'ShippingAddress',
            array() // fields to ignore in NewsPost model
        );
    }

    public function get()
    {
        $parser = $this->getParser();
        $id = $this->getRequestID();
        $categories = ActiveRecordModel::getRecordSetArray('ShippingAddress',
            select(eq(f('ShippingAddress.ID'), $id))
        );
        if(count($categories) == 0)
        {
            throw new Exception('Shipping address not found');
        }
        $apiFieldNames = $parser->getApiFieldNames();

        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        $responseCategory = $response->addChild('shipping_address');
        while($category = array_shift($categories))
        {
            foreach($category as $k => $v)
            {
                if(in_array($k, $apiFieldNames))
                {
                    $responseCategory->addChild($k, $v);
                }
            }
        }
        return new SimpleXMLResponse($response);
    }

    public function filter($emptyListIsException = false)
    {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $parser->loadDataInRequest($request);
        $f = new ARSelectFilter();
        $id = $request->get('userID');
        if(intval($id) > 0) // get action
        {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('ShippingAddress', 'userID'), $id));
        } else {
            throw new Exception('User ID is required');
        }
        //$f->setOrder(MultiLingualObject::getLangOrderHandle(new ARFieldHandle('Category', 'name')));

        $shipping_address = ActiveRecordModel::getRecordSetArray('ShippingAddress', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        if($emptyListIsException && count($shipping_address) == 0)
        {
            throw new Exception('ShippingAddress not found');
        }
        while($category = array_shift($shipping_address))
        {
            $xmlNewsPost = $response->addChild('shipping_address');
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