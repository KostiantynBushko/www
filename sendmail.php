<?php

$admin_email = 'sales@illuminataeyewear.com';
$admin_name = 'Tenny';

$subject = 'Eye Exam Booking';
$message = "<html><body>
<p>Name: {name}</p>
<p>Email: {email}</p>
<p>Phone: {phone}</p>
<p>Date: August 2, 2016, {time}</p>
</body></html>";

if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
	require_once('mail.php');

	$name = isset($_POST['name']) ? $_POST['name'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$phone = isset($_POST['phone']) ? $_POST['phone'] : '';

	$time = isset($_POST['time']) ? $_POST['time'] : 0;

	switch($time){
		case 1:
		$time_text = '11:00 am';
		break;
		case 2:
		$time_text = '11:30 am';
		break;
		case 3:
		$time_text = '12:00 pm';
		break;
		case 4:
		$time_text = '12:30 pm';
		break;
		case 5:
		$time_text = '1:00 pm';
		break;
		case 6:
		$time_text = '1:30';
		break;
		default:
		$time_text = '';
	
	}

	$message = str_replace('{name}', $name, $message);
	$message = str_replace('{email}', $email, $message);
	$message = str_replace('{phone}', $phone, $message);
	$message = str_replace('{time}', $time_text, $message);

	$mail = new Mail();
	$mail->protocol = "mail";
	$mail->parameter = "";
	$mail->hostname = "";
	$mail->username = "";
	$mail->password = "";
	$mail->port = "25";
	$mail->timeout = "5";

	$mail->setFrom($admin_email);
	$mail->setSender($admin_name);

	$mail->setSubject($subject);

	$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));

	$mail->setTo($admin_email);
	$mail->send();

	$mail->setTo($email);
	$mail->send();

	if(isset($_POST['redirect']) && $_POST['redirect']){
		header('Location:' . $_POST['redirect']);
	}
}
?>
<form method="post" action="">
	<input type="text" name="name">
	<input type="text" name="email">
	<input type="text" name="phone">
	<input type="submit" name="send">
</form>