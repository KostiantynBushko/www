<?php

class DisableCurrencyBlock extends ControllerPlugin
{
	public function process()
	{
		$this->response->set('currencies', array());
		$this->response->set('allCurrencies', array());

		$this->application->getRouter()->removeAutoAppendVariable('currency');
	}
}

?>