<?php

class GetPaymentFailureMessage extends ControllerPlugin
{
	public function process()
	{
		$req = $this->application->getRequest();
		if ($req->get('cvdId') == 2)
		{
			$_SESSION['paymentError'] = 'CVD mismatch';
		}

		else if ($req->get('avsProcessed') && !$req->get('avsResult') && $req->get('avsMessage'))
		{
			$_SESSION['paymentError'] = $req->get('avsMessage');
		}
	}
}

?>