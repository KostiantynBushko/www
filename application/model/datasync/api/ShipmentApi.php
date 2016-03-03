<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/21/16
 * Time: 23:09
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.order.Shipment');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class ShipmentApi extends  ModelApi{

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlShipmentApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            "Shipment",
            array()
        );
        $this->addSupportedApiActionName('set');
    }

    public function set() {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $parser->loadDataInRequest($request);
        $f = new ARSelectFilter();
        $orderID = $request->get('orderID');
        $shippingServiceID = $request->get('shippingServiceID');

        if(intval($orderID) > 0) {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('Shipment', 'orderID'), $orderID));
        } else {
            throw new Exception("Order ID is required");
        }

        $order = CustomerOrder::getInstanceById($orderID);
        $order->load();
        $order->loadAll();

        $shipments = $order->getShipments();
        foreach ($shipments as $key => $shipment)
        {
            $shipment->setRateId($shippingServiceID);
        }
        $order->serializeShipments();
        $order->save(true);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        return new SimpleXMLResponse($response);
    }


    public function filter($emptyListIsException = false)
    {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $parser->loadDataInRequest($request);
        $f = new ARSelectFilter();
        $orderID = $request->get('orderID');

        if(intval($orderID) > 0) {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('Shipment', 'orderID'), $orderID));
        } else {
            throw new Exception("Order ID is required");
        }

        $shipment = ActiveRecordModel::getRecordSetArray('Shipment', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        if($emptyListIsException && count($shipment) == 0)
        {
            throw new Exception('Shipment not found');
        }
        while($ser = array_shift($shipment))
        {
            $xmlShipment = $response->addChild('shipment');
            foreach($ser as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $xmlShipment->addChild($k, $v);
                }
            }
        }
        return new SimpleXMLResponse($response);
    }

}