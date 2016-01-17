<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

list($site, $order) = explode('_', $_POST['xxxVar1']);

$domain = base64_decode($site);

if (!$domain) { $domain = 'test.com'; }

$url = 'http://' . $domain . '/checkout/notify/InternetSecureMerchantLink?' . http_build_query($_POST);

$vars = http_build_query($_POST);

foreach (array('http', 'https') as $method)
{
	$url = $method . '://' . $domain . '/checkout/notify/InternetSecureMerchantLink';
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $vars);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $ch, CURLOPT_HEADER, 0);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec( $ch );
	
	$info = curl_getinfo($ch);
	
	// no https needed
	if ((substr($info['url'], 0, 5) != 'https') && ('http' == $method))
	{
		break;
	}
}

file_put_contents(dirname(__FILE__) . '/cache/internetsecure-params.php', var_export($url, true) . "\n" . var_export($vars, true));
file_put_contents(dirname(__FILE__) . '/cache/internetsecure.php', var_export(curl_getinfo($ch), true) . $response);

//copy($url, '/dev/null');

?>
