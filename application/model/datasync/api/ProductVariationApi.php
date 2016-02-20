<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/9/16
 * Time: 15:13
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.product.ProductVariation');
ClassLoader::import('application.model.category.Category');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class ProductVariationApi extends ModelApi{

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlProductVariationApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'ProductVariation',
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
        $id = $request->get('ID');

        if(!empty($id)) // get action
        {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('ProductVariation', 'ID'), $id));
        } else {
            throw new Exception('Product variation ID is required');
        }

        $product_variations = ActiveRecordModel::getRecordSetArray('ProductVariation', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        if($emptyListIsException && count($product_variations) == 0)
        {
            throw new Exception('Product variation not found');
        }
        while($variation = array_shift($product_variations))
        {
            $xml = $response->addChild('product_variation');
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

?>