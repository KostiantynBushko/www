<?php

include_once(dirname(__file__) . '/../abstract/ExternalPayment.php');

/**
 *
 * @package library.payment.method
 * @author Integry Systems
 */
class InternetSecureMerchantLink extends ExternalPayment
{
	public function getUrl()
	{
		return 'https://secure.internetsecure.com/process.cgi';
	}

	public function getPostParams()
	{
		$params = array();

		// vendor account number.
		$params['GatewayID'] = $this->getConfigValue('account');
		$params['xxxTransType'] = '02';

		// a unique order id from your program. (128 characters max)
		$params['xxxVar1'] = base64_encode($_SERVER['SERVER_NAME']) . '_' . $this->details->invoiceID->get();

		// the total amount to be billed, in decimal form, without a currency symbol.
		$params['total'] = $this->details->amount->get();

		$params['CancelURL'] = $this->cancelUrl;
		$params['ReturnCGI'] = $this->notifyUrl;
		$params['ReturnUrl'] = $this->notifyUrl;
		$params['ReturnUrl'] = $this->returnUrl;

		// customer information
		$params['xxxName'] = $this->details->getName();
		$params['xxxAddress'] = $this->details->address->get();
		$params['xxxCity'] = $this->details->city->get();
		$params['xxxProvince'] = $this->details->state->get();
		$params['xxxPostal'] = $this->details->postalCode->get();
		$params['xxxCountry'] = $this->details->country->get();
		$params['xxxEmail'] = $this->details->email->get();
		$params['xxxPhone'] = $this->details->phone->get();

		$params['xxxSendCustomerEmailReceipt'] = 'N';
		$params['xxxSendMerchantEmailReceipt'] = 'N';

		// flags
		$flags = '';
		if ($this->getConfigValue('test'))
		{
			$flags .= '{TEST}';
		}

		if ('USD' == $this->details->currency->get())
		{
			$flags .= '{USD}';
		}

		// product string
		$items = array(array('Price', 'Qty', 'Code', 'Description', 'Flags'));
		foreach ($this->details->getLineItems() as $item)
		{
			$items[] = array($item['price'], $item['quantity'], $item['sku'], $item['name'], $flags);
		}

		$lineItems = array();
		foreach ($items as &$item)
		{
			foreach ($item as &$el)
			{
				$el = substr($el, 0, 150);
				$el = str_replace(array('"', '`'), "'", $el);
				$el = str_replace(':', '-', $el);
			}

			$lineItems[] = implode('::', $item);
		}

		$params['Products'] = implode('|', $lineItems);

		return $params;
	}

	public function notify($requestArray)
	{
		//$this->saveDebug($requestArray);

		// test transactions enabled?
		if (($requestArray['Live'] != 1) && !$this->getConfigValue('test'))
		{
			return new TransactionError('Test transactions disabled', $requestArray);
		}

		$result = new TransactionResult();
		$result->gatewayTransactionID->set($requestArray['receiptnumber']);
		$result->amount->set($requestArray['xxxAmount']);
		$result->currency->set(0 == $requestArray['Currency'] ? 'CAD' : 'USD');
		$result->rawResponse->set($requestArray);
		$result->setTransactionType(TransactionResult::TYPE_AUTH);

		return $result;
	}

	public function getOrderIdFromRequest($requestArray)
	{
		list($site, $order) = explode('_', $requestArray['xxxVar1']);

		return $order;
	}

	public function isPostRedirect()
	{
		return true;
	}

	public function isHtmlResponse()
	{
		return false;
	}

	public function getValidCurrency($currentCurrencyCode)
	{
		$currentCurrencyCode = strtoupper($currentCurrencyCode);
		return in_array($currentCurrencyCode, array('CAD', 'USD')) ? $currentCurrencyCode : 'CAD';
	} 

	public function isVoidable()
	{
		return false;
	}

	public function void()
	{
		return false;
	}
}

?>
