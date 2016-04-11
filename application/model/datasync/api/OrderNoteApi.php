<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/8/16
 * Time: 06:54
 */
ClassLoader::import("application.model.order.OrderNote");
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class OrderNoteApi extends  ModelApi {
    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlOrderNoteApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'OrderNote',
            array() // fields to ignore in NewsPost model
        );
        $this->addSupportedApiActionName('send');
    }

    public function filter($emptyListIsException = false)
    {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $parser->loadDataInRequest($request);
        $id = $request->get('orderID');

        $f = new ARSelectFilter();
        if(!isset($id)) {
            throw new Exception('Order id is required');
        }

        $f->mergeCondition(new EqualsCond(new ARFieldHandle('OrderNote', 'orderID'), $id));
        $f->setOrder(new ARExpressionHandle(('OrderNote.ID')), 'ASC');

        $orderNotes = ActiveRecordModel::getRecordSetArray('OrderNote', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        if($emptyListIsException && count($orderNotes) == 0) {
            throw new Exception('Not found notes for this order');
        }

        while($notes = array_shift($orderNotes))
        {
            $xmlPage = $response->addChild('note');
            foreach($notes as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $xmlPage->addChild($k, htmlentities($v));
                }
            }
        }
        return new SimpleXMLResponse($response);
    }

    function send() {
        $parser = $this->getParser();
        $request = $this->application->getRequest();
        $apiFieldNames = $parser->getApiFieldNames();
        $orderID =  $request->get('orderID');
        $comment = $request->get('text');

        if(!isset($orderID)) {
            throw new Exception("Order ID is required");
        }

        if(!isset($comment)) {
            throw new Exception("User comment is required");
        }

        $order = CustomerOrder::getInstanceById($orderID, CustomerOrder::LOAD_DATA);
        $order->user->get()->load();


        $note = OrderNote::getNewInstance($order, $order->user->get());
        $note->isAdmin->set(false);
        $note->text->set($comment);
        $note->save();
        $note->load(true);

        /*if ($this->application->config->get('NOTIFY_NEW_NOTE'))
        {
            $order->user->get()->load();

            $email = new Email($this->application);
            $email->setTo($this->application->config->get('NOTIFICATION_EMAIL'), $this->application->config->get('STORE_NAME'));
            $email->setTemplate('notify.message');
            $email->set('order', $order->toArray(array('payments' => true)));
            $email->set('message', $note->toArray());
            $email->set('user', $order->user->toArray());
            $email->send();
        }*/

        $f = new ARSelectFilter();
        $f->mergeCondition(new EqualsCond(new ARFieldHandle('OrderNote', 'ID'), $note->getID()));
        $orderNotes = ActiveRecordModel::getRecordSetArray('OrderNote', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        while($notes = array_shift($orderNotes))
        {
            $xmlPage = $response->addChild('note');
            foreach($notes as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $xmlPage->addChild($k, htmlentities($v));
                }
            }
        }
        return new SimpleXMLResponse($response);
    }

}