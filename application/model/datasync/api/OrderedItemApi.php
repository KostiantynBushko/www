<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/1/16
 * Time: 20:22
 */


ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.order.OrderedItem');
ClassLoader::import('application.model.datasync.api.reader.XmlOrderedItemApiReader');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class OrderedItemApi extends ModelApi{
    private $listFilterMapping = null;
    protected $application;

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlOrderedItemApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'OrderedItem',
            array() // fields to ignore in  model
        );
        $this->addSupportedApiActionName('add_to_cart');
        $this->addSupportedApiActionName('delete_item');
    }

    public function add_to_cart() {
        $request = $this->application->getRequest();
        $productID = $request->get('productID');
        $customerOrderID = $request->get('customerOrderID');
        $count = $request->get('count');

        if(!isset($customerOrderID) && intval($customerOrderID == 0)) {
            throw new Exception('Order ID is required');
        }

        $order = CustomerOrder::getInstanceById($customerOrderID);
        $order->load(true);
        $order->loadAll();
        $product = Product::getInstanceByID($productID);

        if(!$product->isAvailable()) {
            throw new Exception('Product '.$productID. ' is not Available ');   
        } else {
            if ($count < $product->getMinimumQuantity())
            {
                $count = $product->getMinimumQuantity();
            }
            ActiveRecordModel::beginTransaction();

            $item = $order->addProduct($product,$count);
            if ($item instanceof OrderedItem)
            {

                if ($order->isMultiAddress->get())
                {
                    $item->save();
                }
            }
            $order->mergeItems();
            $order->getTotal(true);
            $order->totalAmount->set($order->getTotal(true));
            $order->getTaxAmount();
            $order->save(true);

            ActiveRecordModel::commit();
        }

        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        return new SimpleXMLResponse($response);
    }

    public function delete_item() {
        $request = $this->application->getRequest();
        $itemID = $request->get('ID');
        $customerOrderID = $request->get('customerOrderID');

        if(!isset($customerOrderID) && intval($customerOrderID == 0)) {
            throw new Exception('Order ID is required');
        }

        if(!isset($itemID) && intval($itemID == 0)) {
            throw new Exception('OrderedItem ID is required');
        }

        $item = ActiveRecordModel::getInstanceByID('OrderedItem', $itemID, ActiveRecordModel::LOAD_DATA, array('Product'));
        $order = CustomerOrder::getInstanceById($customerOrderID);
        $order->load(true);
        $order->loadAll();

        $order->removeItem($item);
        $order->save(true);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        return new SimpleXMLResponse($response);
    }
}