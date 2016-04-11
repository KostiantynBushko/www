<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/30/16
 * Time: 04:56
 */

ClassLoader::import('application.model.product.ProductOptionChoice');
ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class ProductOptionChoiceApi extends ModelApi {
    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlProductOptionChoiceApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'ProductOptionChoice',
            array() // fields to ignore in Product model
        );
    }

    public function filter($emptyListIsException = false) {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $parser->loadDataInRequest($request);

        $f = $parser->getARSelectFilter();
        $f->setOrder(new ARExpressionHandle(('ProductOptionChoice.position')), 'ASC');

        $productOptionsChoice = ActiveRecordModel::getRecordSetArray('ProductOptionChoice', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');

        if($emptyListIsException && count($productOptionsChoice) == 0)
        {
            throw new Exception('Product option choice not found');
        }

        while($optionChoice = array_shift($productOptionsChoice))
        {
            $xml = $response->addChild('product_option_choice');
            foreach($optionChoice as $k => $v)
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