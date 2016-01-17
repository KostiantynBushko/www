<?php

class ActivateUSD extends ControllerPlugin
{
	public function process()
	{
		try
		{
			$usd = Currency::getInstanceByID('USD', true);
		}
		catch (Exception $e)
		{
			return;
		}

		if (!$usd->isEnabled->get())
		{
			return;
		}

		$app = ActiveRecordModel::getApplication();

		$request = $app->getRequest();
		$request->set('currency', $usd->getID());

		$app->getRouter()->removeAutoAppendVariable('currency');
	}
}

?>