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
        $this->addSupportedApiActionName('save','send');
    }

    public function send() {
        $request = $this->application->getRequest();

        /*$userID = $request->get('userID');
        $user_apn_token = UserApnToken::getInstanceByUserID($userID);

        if(!isset($user_apn_token)) {
            throw new Exception('Token for user ' . $userID . ' does not exist');
        }
        $user_apn_token->load(true);

        $deviceToken = str_replace(' ', '', $user_apn_token->token->get()); '6c4766aaae648924b3d08511984bff348edcc1c478da50b2156d0729c7d04575';
        $passphrase = 'illuminata';

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', getcwd() . '/apple_apn/IlluminataDevCerAndKey.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp) {
            throw new Exception("Failed to connect: $err $errstr" . PHP_EOL);
        }

        //throw new Exception('Connected to APNS' . PHP_EOL);

        $body['aps'] = array(
            'alert' => 'Illuminata notification.',
            'type' => '2',
            'targetID' => '50292',
            'url' => 'http://www.illuminataeyewear.ca',
            'sound' => 'default'
        );
        $payload = json_encode($body);
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        $result = fwrite($fp, $msg, strlen($msg));

        fclose($fp);

        if (!$result)
            throw new Exception('Message not delivered' . PHP_EOL);
        else
            throw new Exception('Message successfully delivered' . PHP_EOL);*/

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
                $current_token = UserApnToken::getInstanceByToken($token);
                if(isset($current_token)) {
                    $current_token->delete();
                    $current_token->save();
                }
                //$user_apn_token = UserApnToken::getNewInstance($userID, $token);
                $user_apn_token->token->set($token);
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