<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/26/16
 * Time: 21:43
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application/model.order.OrderCoupon');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');
ClassLoader::import('application.model.discount.DiscountCondition');

class OrderCouponApi extends ModelApi {

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlOrderCouponApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'OrderCoupon',
            array() // fields to ignore in NewsPost model
        );
        $this->addSupportedApiActionName('add_coupon');
    }

    public function filter($emptyListIsException = false)
    {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $parser->loadDataInRequest($request);
        $f = new ARSelectFilter();
        $orderID = $request->get('orderID');
        if(intval($orderID) > 0)
        {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('OrderCoupon', 'orderID'), $orderID));
        } else {
            throw new Exception("Order ID is required");
        }
        $f->setOrder(new ARExpressionHandle(('OrderCoupon.ID')), 'DESC');

        $orderCoupon = ActiveRecordModel::getRecordSetArray('OrderCoupon', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        if($emptyListIsException && count($orderCoupon) == 0)
        {
            throw new Exception('Order Coupon not found');
        }
        while($coupon = array_shift($orderCoupon))
        {
            $xmlOrderCoupon = $response->addChild('coupon');
            foreach($coupon as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $xmlOrderCoupon->addChild($k, htmlentities($v));
                }
            }
        }
        return new SimpleXMLResponse($response);
    }

    public function add_coupon() {
        $request = $this->application->getRequest();

        $code = $request->get('couponCode');
        $orderID = $request->get('orderID');
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        if (strlen($code))
        {
            $order = CustomerOrder::getInstanceByID($orderID, CustomerOrder::LOAD_DATA);
            $condition = DiscountCondition::getInstanceByCoupon($code);

            if ($condition) {
                if (!$order->hasCoupon($code)) {

                    $coupon = OrderCoupon::getNewInstance($order, $code);
                    $coupon->save();
                    $order->getCoupons(true);

                    if ($order->hasCoupon($code)) {
                        $order->loadAll();
                        $order->getTotal(true);
                        $order->totalAmount->set($order->getTotal(true));
                        $order->getTaxAmount();
                        $order->save();
                        $response->addChild('message', 'Coupon ' . $code . ' was successfully added');
                    } else  {
                        throw new Exception("Cant add coupon " . $code);
                    }
                } else  {
                    throw new Exception("The coupon " . $code . " already added");
                }
            } else {
                throw new Exception("Cant add coupon " . $code);
            }
            $order->getCoupons(true);
        } else {
            throw new Exception("Incorrect coupon code" . $code);
        }

        return new SimpleXMLResponse($response);
    }
}

?>