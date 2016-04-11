<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/1/16
 * Time: 09:12
 */

ClassLoader::import('application.model.order.OrderedItemOption');
ClassLoader::import('application.model.product.ProductOptionChoice');
ClassLoader::import("application.model.order.OrderItem");
ClassLoader::import('application.model.product.ProductOption');
ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');
ClassLoader::import('application.model.order.OrderedItem');

class OrderedItemOptionApi extends ModelApi {
    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlOrderedItemOptionApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'OrderedItemOption',
            array() // fields to ignore in Product model
        );
        $this->addSupportedApiActionName('set');
    }

    public function filter($emptyListIsException = false) {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $parser->loadDataInRequest($request);

        $f = $parser->getARSelectFilter();

        $orderedItemOptions = ActiveRecordModel::getRecordSetArray('OrderedItemOption', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        if($emptyListIsException && count($orderedItemOptions) == 0)
        {
            throw new Exception('Ordered Item Option not found');
        }

        while($option = array_shift($orderedItemOptions))
        {
            $xml = $response->addChild('option');
            foreach($option as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $xml->addChild($k, $v);
                }
            }
        }
        return new SimpleXMLResponse($response);
    }

    public function set() {
        $request = $this->application->getRequest();
        $orderedItemID = $request->get('orderedItemID');
        $choiceID = $request->get('choiceID');
        $optionText = $request->get('optionText');

        if(!isset($orderedItemID)) {
            throw new Exception("Ordered item is required");
        }
        if(!isset($choiceID)) {
            throw new Exception("Choice item is required");
        }

        //throw new Exception(" response : " . $orderedItemID);
        //$orderItem = ActiveRecordModel::getInstanceByID('OrderedItem', $orderedItemID, ActiveRecordModel::LOAD_DATA, array('Product'));
        $orderItem = OrderedItem::getInstanceByID('OrderedItem', $orderedItemID,true, true);
        $orderItem->load(true);
        $orderItem->loadOptions();


        $product_option_choice = ProductOptionChoice::getInstanceByID($choiceID,true,true);
        $product_option_choice->load(true);


        if(!isset($product_option_choice)) {
            throw new Exception('Option not loaded');
        }
        $choice = $orderItem->addOptionChoice($product_option_choice);
        $orderItem->save();
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        $response->addChild("message","Success");


        if(isset($choice)) {
            $choice->load(true);
            if(isset($optionText)) {
                $choice->optionText->set($optionText);
                $choice->save();
            }
        }
        return new SimpleXMLResponse($response);
        
        //good
        /*$ordered_item = OrderedItemOption::getNewInstance($orderItem,$product_option_choice);
        $ordered_item->load(true);
        //$ordered_item->updatePriceDiff();
        $ordered_item->save();
        throw new Exception('is set --- ');*/


        /*$productOption = ProductOption::getInstanceByID($product_option_choice->optionID->get(), true);
        $productOption->load(true);

        $choice = $orderItem->getOptionChoice($productOption);

        if(isset($choice)) {
            $choice->load(true);
            $orderItem->removeOptionChoice($choice->choice->get());
            $orderItem->save();
            //$orderItem->removeOption($productOption);
            //$orderItem->addOptionChoice($choice);
            //$orderItem->save();
            throw new Exception('is set');
            //throw new Exception('is set ' . $choice->choice->get()->option->get()->getID());
        } else {
            //$orderItem->addOption($productOption->option->get());
            //$orderItem->addOptionChoice($productOption->getChoiceByID($product_option_choice->ID->get()));
            //$orderItem->save();

            $orderItem->addOptionChoice($product_option_choice);
            $orderItem->save();
            throw new Exception('is not set ');
        }*/
    }
}