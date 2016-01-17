<?php

class LoadPaymentFailureMessage extends ControllerPlugin
{
	public function process()
	{
		if (!empty($_SESSION['paymentError']))
		{
			$this->response->set('paymentError', $_SESSION['paymentError']);
			unset($_SESSION['paymentError']);
		}
	}
}

?>