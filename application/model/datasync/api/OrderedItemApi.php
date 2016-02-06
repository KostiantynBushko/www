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
    }

    public function add_to_cart() {
        $request = $this->application->getRequest();
        $productID = $request->get('productID');
        $customerOrderID = $request->get('customerOrderID');
        $count = $request->get('count');

        $order = CustomerOrder::getInstanceById($customerOrderID);
        $product = Product::getInstanceByID($productID);

        if(!$product->isAvailable()) {
            throw new Exception('Product '.$productID. ' is not Available ');   
        } else {
            //$order->loadAll();
            if ($count < $product->getMinimumQuantity())
            {
                $count = $product->getMinimumQuantity();
            }
            ActiveRecordModel::beginTransaction();
            $item = $order->addProduct($product,$count);
            $item->save();
            //$order->mergeItems();
            ActiveRecordModel::commit();
        }
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        return new SimpleXMLResponse($response);
    }
}