<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/14/16
 * Time: 04:22
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.order.Transaction');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');
ClassLoader::import('library.payment.TransactionResult');
ClassLoader::import('application.model.order.CustomerOrder');
ClassLoader::import('application.model.Currency');
ClassLoader::import('application.model.order.CustomerOrder');
ClassLoader::import('application.model.order.ExpressCheckout');
ClassLoader::import('application.model.order.LiveCartTransaction');
ClassLoader::import('application.model.order.SessionOrder');
ClassLoader::import('application.model.order.OfflineTransactionHandler');
ClassLoader::import('application.model.eav.EavSpecificationManager');
ClassLoader::import('application.model.eav.EavObject');


class TransactionApi extends ModelApi{

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlTransactionApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'Transaction',
            array() // fields to ignore in NewsPost model
        );
        $this->addSupportedApiActionName('update');
        $this->addSupportedApiActionName('create');
    }

    public function create() {
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        $request = $this->application->getRequest();
        $orderID = $request->get('orderID');
        $currencyID = $request->get('currencyID');
        $amount = $request->get('amount');
        $method = $request->get('method');
        $gatewayTransactionID = $request->get('gatewayTransactionID');
        if(intval($orderID) <= 0) {
            throw new Exception('Order ID is required');
        }
        if(!isset($currencyID) || !isset($method) || !isset($gatewayTransactionID)) {
            throw new Exception('Complete required fields : currencyID, method, gatewayTransactionID');
        }

        $transaction_result = new TransactionResult();
        $transaction_result->currency->set($currencyID);// = $currencyID;
        $transaction_result->amount->set($amount); //= $amount;
        $transaction_result->gatewayTransactionID->set($gatewayTransactionID); // = $gatewayTransactionID;
        $transaction_result->setTransactionType(TransactionResult::TYPE_SALE);

        $order = CustomerOrder::getInstanceById($orderID);
        $order->loadAll();
        $order_array = $order->toArray();

        $user = User::getInstanceByID($order_array['userID']);
        $user->load();
        $order->user->set($user);

        if ($current_transaction = Transaction::getInstance($order, $gatewayTransactionID)) {
            $current_transaction->method->set($method);
            $current_transaction->save();
        } else {
            $new_transaction = Transaction::getNewInstance($order, $transaction_result);
            $new_transaction->method->set($method);
            $new_transaction->save();
            if(!$this->finalizeOrder($order, $user)) {
                // Create new order for current user
                $new_order = CustomerOrder::getNewInstance($user);
                $new_order->beginTransaction();
                $new_order->save();
                $new_order->commit();
            }
        }

        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $f = new ARSelectFilter();
        $f->mergeCondition(new EqualsCond(new ARFieldHandle('Transaction', 'orderID'), $orderID));

        $transactions = ActiveRecordModel::getRecordSetArray('Transaction', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        if(false && count($transactions) == 0)
        {
            throw new Exception('Transactions not found');
        }
        while($transaction = array_shift($transactions))
        {
            $transaction_response = $response->addChild('transaction');
            foreach($transaction as $k => $v)
            {
                if(in_array($k, $apiFieldNames))
                {
                    $transaction_response->addChild($k, htmlentities($v));
                }
            }
        }
        return new SimpleXMLResponse($response);
    }

    public function filter($emptyListIsException = false)
    {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $parser->loadDataInRequest($request);
        $f = new ARSelectFilter();
        $id = $request->get('orderID');
        if(intval($id) > 0) // get action
        {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('Transaction', 'orderID'), $id));
        } else {
            throw new Exception('Order ID is required');
        }

        $f->setOrder(new ARExpressionHandle(('CustomerOrder.ID')), 'DESC');
        $transactions = ActiveRecordModel::getRecordSetArray('Transaction', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        if($emptyListIsException && count($transactions) == 0)
        {
            throw new Exception('Transactions not found');
        }
        while($transaction = array_shift($transactions))
        {
            $transaction_response = $response->addChild('transaction');
            foreach($transaction as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $transaction_response->addChild($k, htmlentities($v));
                }
            }
        }
        return new SimpleXMLResponse($response);
    }


    protected function finalizeOrder(CustomerOrder $customer_order, User $user)
    {
        $user->load();
        /*if (!count($customer_order->getShipments()))
        {
            throw new Exception('No shipments in order');
        }*/
        $newOrder = $customer_order->finalize();

        $orderArray = $customer_order->toArray(array('payments' => true));

        // send order confirmation email
        if ($this->application->config->get('EMAIL_NEW_ORDER'))
        {
            $email = new Email($this->application);
            $email->setUser($user);
            $email->setTemplate('order.new');
            $email->set('order', $orderArray);
            $email->send();
        }

        // notify store admin
        if ($this->application->config->get('NOTIFY_NEW_ORDER'))
        {
            $email = new Email($this->application);
            $email->setTo($this->application->config->get('NOTIFICATION_EMAIL'), $this->application->config->get('STORE_NAME'));
            $email->setTemplate('notify.order');
            $email->set('order', $orderArray);
            $email->set('user', $user->toArray());
            $email->send();
        }

        // if user hasn't wish list items order->finalize() will return null, saving null with SessionOrder causes fatal error!
        if($newOrder instanceof CustomerOrder) {
            return true;
        }

        return false;
    }
}