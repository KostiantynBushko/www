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
        $this->addSupportedApiActionName('update');
    }

    public function update() {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        $id = $request->get('ID');
        $f = new ARSelectFilter();
        if(intval($id) > 0) {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('UserAddress', 'ID'), $id));
        } else {
            throw new Exception('Address ID is required');
        }

        $user_address = UserAddress::getInstanceById($id);

        $firstName = $request->get('firstName');
        $lastName = $request->get('lastName');
        $companyName = $request->get('companyName');
        $address1 = $request->get('address1');
        $address2 = $request->get('address2');
        $city = $request->get('city');
        $stateName = $request->get('stateName');
        $stateID = $request->get('stateID');
        $postalCode = $request->get('postalCode');
        $countryID = $request->get('countryID');
        $phone = $request->get('phone');

        if(isset($firstName)) {
            $user_address->setFieldValue('firstName',$firstName);
        }
        if(isset($lastName)) {
            $user_address->setFieldValue('lastName',$lastName);
        }
        if(isset($companyName)) {
            $user_address->setFieldValue('companyName',$companyName);
        }
        if(isset($address1)) {
            $user_address->setFieldValue('address1',$address1);
        }
        if(isset($address2)) {
            $user_address->setFieldValue('address2',$address2);
        }
        if(isset($city)) {
            $user_address->setFieldValue('city',$city);
        }
        if(isset($stateName)) {
            $user_address->setFieldValue('stateName',$stateName);
        }
        if(isset($stateID)) {
            $user_address->state->set(State::getInstanceByID((int)$stateID, true));
        }
        if(isset($postalCode)) {
            $user_address->setFieldValue('postalCode',$postalCode);
        }
        if(isset($countryID)) {
            $user_address->setFieldValue('countryID',$countryID);
        }
        if(isset($phone)) {
            $user_address->setFieldValue('phone',$phone);
        }
        $user_address->save();

        $apiFieldNames = $parser->getApiFieldNames();
        $user_record = ActiveRecordModel::getRecordSetArray('UserAddress', $f);
        while($address = array_shift($user_record))
        {
            $user_address_response = $response->addChild('user_address');
            foreach($address as $k => $v)
            {
                if(in_array($k, $apiFieldNames))
                {
                    $user_address_response->addChild($k, htmlentities($v));
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
        $id = $request->get('ID');
        if(intval($id) > 0) // get action
        {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('UserAddress', 'ID'), $id));
        } else {
            throw new Exception('Address ID is required');
        }

        $user_address = ActiveRecordModel::getRecordSetArray('UserAddress', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        if($emptyListIsException && count($user_address) == 0)
        {
            throw new Exception('UserAddress not found');
        }
        while($address = array_shift($user_address))
        {
            $user_address_response = $response->addChild('user_address');
            foreach($address as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $user_address_response->addChild($k, htmlentities($v));
                }
            }
        }
        return new SimpleXMLResponse($response);
    }

}