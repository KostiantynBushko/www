<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/9/16
 * Time: 17:09
 */

ClassLoader::import('application/model.order.CustomerOrder');
ClassLoader::import('application.model.datasync.import.CustomerOrderImport');
ClassLoader::import("application.model.user.UserApnToken");

class AppleAPNService {

    public static $MESSAGE_TYPE_UNKNOWN = 0;
    public static $MESSAGE_TYPE_SIMPLE_MESSAGE = 1;
    public static $MESSAGE_TYPE_PRODUCT = 2;
    public static $MESSAGE_TYPE_CATEGORY = 3;
    public static $MESSAGE_TYPE_NEWS = 4;
    public static $MESSAGE_TYPE_COUPON = 5;
    public static $MESSAGE_TYPE_URL = 6;
    public static $MESSAGE_TYPE_USER_ORDER_MESSAGE = 7;

    private static $passphrase = 'illuminata';
    private $application;

    public function __construct(LiveCart $application) {
        $this->application = $application;
    }

    public function SendUserOrderMessage($order, $message) {
        $user = $order->user->get();
        $user_apn_token = UserApnToken::getInstanceByUserID($user->getID());

        if(!isset($user_apn_token)) {
            return false;
        }
        $deviceToken = str_replace(' ', '', $user_apn_token->token->get());

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', getcwd() . '/apple_apn/IlluminataDevCerAndKey.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', AppleAPNService::$passphrase);

        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp) {
            throw new Exception("Failed to connect: $err $errstr" . PHP_EOL);
        }


        $body['aps'] = array(
            'alert' => $message,
            'title' => 'Order message',
            'type' => strval(AppleAPNService::$MESSAGE_TYPE_USER_ORDER_MESSAGE),
            'targetID' => $order->getID(),
            'url' => 'http://www.illuminataeyewear.com',
            'sound' => 'default'
        );


        $payload = json_encode($body);
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        $result = fwrite($fp, $msg, strlen($msg));

        fclose($fp);

        if (!$result)
            return false; //throw new Exception('Message not delivered' . PHP_EOL);
        else
            return true; //throw new Exception('Message successfully delivered' . PHP_EOL);
    }
}
?>