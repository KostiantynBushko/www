<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/30/16
 * Time: 04:36
 */

ClassLoader::import('application.model.product.ProductOption');
ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class ProductOptionApi extends ModelApi {

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlProductOptionApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'ProductOption',
            array() // fields to ignore in Product model
        );
    }

    public function filter($emptyListIsException = false) {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $parser->loadDataInRequest($request);

        $f = $parser->getARSelectFilter();
        $f->setOrder(new ARExpressionHandle(('ProductOption.position')), 'ASC');

        $productOptions = ActiveRecordModel::getRecordSetArray('ProductOption', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        if($emptyListIsException && count($productOptions) == 0)
        {
            throw new Exception('Product option not found');
        }

        while($option = array_shift($productOptions))
        {
            $xml = $response->addChild('product_option');
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
}
?>