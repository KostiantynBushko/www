<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/9/16
 * Time: 16:00
 */
ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.product.ProductVariationValue');
ClassLoader::import('application.model.product.ProductVariation');
ClassLoader::import('application.model.category.Category');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class ProductVariationValueApi extends ModelApi{

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlProductVariationValueApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'ProductVariationValue',
            array() // fields to ignore in Product model
        );
        $this->addSupportedApiActionName('import');
    }

    public function filter($emptyListIsException = false)
    {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $parser->loadDataInRequest($request);
        $f = new ARSelectFilter();
        $productID = $request->get('productID');

        if(!empty($productID)) // get action
        {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('ProductVariationValue', 'productID'), $productID));
        } else {
            throw new Exception('Product variation product id is required');
        }

        $product_variations_value = ActiveRecordModel::getRecordSetArray('ProductVariationValue', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        if($emptyListIsException && count($product_variations_value) == 0)
        {
            throw new Exception('Product variation value not found');
        }

        while($variation = array_shift($product_variations_value))
        {
            $xml = $response->addChild('product_variation_value');
            foreach($variation as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $xml->addChild($k, $v);
                }
            }
        }
        return new SimpleXMLResponse($response);
    }
}