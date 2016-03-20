<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/6/16
 * Time: 10:27
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.user.UserApnToken');
ClassLoader::import('application.model.datasync.api.reader.XmlUserApnTokenApiReader');

class UserApnTokenApi extends ModelApi {

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlUserApnTokenApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'UserApnToken',
            array() // fields to ignore in  model
        );
        $this->addSupportedApiActionName('save');
    }

    public function save() {
        $request = $this->application->getRequest();
        $userID = $request->get('userID');
        $token = $request->get('token');

        if(!isset($token)) {
            throw new Exception('Token is required');
        }

        if(isset($userID) && intval($userID) > 0 ) {
            $user_apn_token = UserApnToken::getInstanceByUserID($userID);
            if(!isset($user_apn_token)) {
                $user_apn_token = UserApnToken::getInstanceByToken($token);
                if(!isset($user_apn_token)) {
                    $user_apn_token = UserApnToken::getNewInstance($userID, $token);
                    $user_apn_token->save();
                } else {
                    $user_apn_token->userID->set($userID);
                    $user_apn_token->save();
                }
            } else {
                $user_apn_token = UserApnToken::getNewInstance($userID, $token);
                $user_apn_token->save();
            }
        } else {
            $token = UserApnToken::getNewInstance(null, $token);
            $token->save();
        }

        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        return new SimpleXMLResponse($response);
    }

    public function filter($emptyListIsException = false) {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $parser->loadDataInRequest($request);
        $f = new ARSelectFilter();
        $userID = $request->get('userID');

        if(!empty($userID)) {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('UserApnToken', 'userID'), $userID));
        } /*else {
            throw new Exception('userID is required');
        }*/

        $user_tokens = ActiveRecordModel::getRecordSetArray('UserApnToken', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        if($emptyListIsException && count($user_tokens) == 0)
        {
            throw new Exception('UserApnToken not found');
        }
        while($user_token = array_shift($user_tokens))
        {
            $xmlToken = $response->addChild('user_apn_token');
            foreach($user_token as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $xmlToken->addChild($k, $v);
                }
            }
        }
        return new SimpleXMLResponse($response);
    }
}
?>