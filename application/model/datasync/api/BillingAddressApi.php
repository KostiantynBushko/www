<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/28/16
 * Time: 15:28
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.user.BillingAddress');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class BillingAddressApi extends ModelApi{

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlBillingAddressApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'BillingAddress',
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
        $id = $request->get('userID');
        if(intval($id) > 0) // get action
        {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('BillingAddress', 'userID'), $id));
        } else {
            throw new Exception('User ID is required');
        }
        //$f->setOrder(MultiLingualObject::getLangOrderHandle(new ARFieldHandle('Category', 'name')));

        $shipping_address = ActiveRecordModel::getRecordSetArray('BillingAddress', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        if($emptyListIsException && count($shipping_address) == 0)
        {
            throw new Exception('BillingAddress not found');
        }
        while($category = array_shift($shipping_address))
        {
            $xmlNewsPost = $response->addChild('billing_address');
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

?>