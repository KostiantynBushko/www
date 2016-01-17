<?php

include_once(dirname(__file__).'/../../abstract/CreditCardPayment.php');

/**
 *
 * @package library.payment.method.cc
 * @author Integry Systems
 */
class BeanstreamCC extends CreditCardPayment
{
	private $fields = array();

	public function isCreditable()
	{
		return true;
	}

	public function isCardTypeNeeded()
	{
		return false;
	}

	public function isMultiCapture()
	{
		return false;
	}

	public function isCapturedVoidable()
	{
		return true;
	}

	public function authorizeAndCapture()
	{
		return $this->authorize();
	}

	public function authorize()
	{
		$params = array();

		$params['requestType'] = 'BACKEND';

		// vendor account number.
		$params['merchant_id'] = $this->getConfigValue('merchant_id');

		// a unique order id from your program. (128 characters max)
		$params['trnOrderNumber'] = $this->details->invoiceID->get() . rand(1, 100000) . time();

		// the total amount to be billed, in decimal form, without a currency symbol.
		$params['trnAmount'] = $this->details->amount->get();
		$params['trnCardNumber'] = $this->getCardNumber();
		$params['trnExpMonth'] = ($this->getExpirationMonth() < 10 ? '0' : '') . $this->getExpirationMonth();
		$params['trnExpYear'] = substr($this->getExpirationYear(), 2);

		if ($this->getCardCode())
		{
			$params['trnCardCvd'] = $this->getCardCode();
		}

		// customer information
		$params['trnCardOwner'] = $this->details->getName();
		$params['ordName'] = $this->details->getName();

		$params['ordAddress1'] = $this->details->address->get();
		$params['ordCity'] = $this->details->city->get();
		$params['ordProvince'] = $this->details->state->get();
		$params['ordPostalCode'] = $this->details->postalCode->get();
		$params['ordCountry'] = $this->details->country->get();
		$params['ordEmailAddress'] = $this->details->email->get();
		$params['ordPhoneNumber'] = $this->details->phone->get();

		$params['trnType'] = 'PA';

		$index = 0;
		foreach ($this->details->getLineItems() as $key => $item)
		{
			//$items[] = array($item['price'], $item['quantity'], $item['sku'], $item['name'], $flags);
			$index++;
			$params['prod_name_' . $index] = $item['name'];
			$params['prod_quantity_' . $index] = $item['quantity'];
			$params['prod_cost_' . $index] = $item['price'];
		}

		$pairs = array();
		foreach ($params as $key => $value)
		{
			$pairs[] = $key . '=' . urlencode($value);
		}

		$url = 'https://www.beanstream.com/scripts/process_transaction.asp?' . $this->generateHash(implode('&', $pairs));

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		$res = curl_exec($ch);
		$info = curl_getinfo($ch);

		curl_close($ch);

		parse_str($res, $res);

		if (empty($res['trnApproved']))
		{
			//var_dump($res);exit;
			return new TransactionError($res['messageText'], $res);
		}

		$result = new TransactionResult();
		$result->gatewayTransactionID->set($res['trnId']);
		$result->amount->set($this->details->amount->get());
		$result->currency->set(ActiveRecordModel::getApplication()->getDefaultCurrencyCode());
		$result->rawResponse->set($res);
		$result->setTransactionType(TransactionResult::TYPE_AUTH);
		$result->details->set('IP: ' . ActiveRecordModel::getApplication()->getRequest()->getIP());

		return $result;
	}

	public function getValidCurrency($currentCurrencyCode)
	{
		return ActiveRecordModel::getApplication()->getDefaultCurrencyCode();
	}

	public function isVoidable()
	{
		return false;
	}

	public function void()
	{
		return false;
	}

	public function capture()
	{
		$params = array();
		$params['merchant_id'] = $this->getConfigValue('merchant_id');
		$params['trnAmount'] = $this->details->amount->get();
		$params['trnType'] = 'PAC';
		$params['adjId'] = $this->details->get('gatewayTransactionID');
		$params['errorPage'] = $this->application->getRouter()->createUrl(array('controller' => 'index', 'action' => 'index'));

		$pairs = array();
		foreach ($params as $key => $value)
		{
			$pairs[] = $key . '=' . urlencode($value);
		}

		$url = 'https://www.beanstream.com/scripts/process_transaction.asp?' . $this->generateHash(implode('&', $pairs));

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		$res = curl_exec($ch);
		$info = curl_getinfo($ch);

		curl_close($ch);

		if (strpos($res, 'Approved'))
		{
			$result = new TransactionResult();
			$result->gatewayTransactionID->set($this->details->get('gatewayTransactionID') . '-PAC');
			$result->amount->set($this->details->amount->get());
			$result->currency->set(ActiveRecordModel::getApplication()->getDefaultCurrencyCode());
			$result->rawResponse->set($info['url']);
			$result->setTransactionType(TransactionResult::TYPE_CAPTURE);

			return $result;
		}
		else
		{
			$q = array();
			parse_str(parse_url($info['url'], PHP_URL_QUERY), $q);
			return new TransactionError($q['messageText'], $info);
		}

		//var_dump($res);
	}

	protected function generateHash($params)
	{
		$key = $this->getConfigValue('hash');
		return $params . '&hashValue=' . md5($params . $key);
	}
}

?>