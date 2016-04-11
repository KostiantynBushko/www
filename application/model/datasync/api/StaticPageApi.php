<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/8/16
 * Time: 00:37
 */
ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.staticpage.StaticPage');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class StaticPageApi extends ModelApi {
    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlStaticPageApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'StaticPage',
            array() // fields to ignore in NewsPost model
        );
    }

    public function filter($emptyListIsException = false)
    {
        $request = $this->application->getRequest();
        $parser = $this->getParser();
        $apiFieldNames = $parser->getApiFieldNames();
        $parser->loadDataInRequest($request);
        $f = new ARSelectFilter();
        $id = $request->get('ID');
        if(intval($id) > 0) // get action
        {
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('StaticPage', 'ID'), $id));
        }
        //$f->setOrder(new ARExpressionHandle(('NewsPost.ID')), 'DESC');

        $static_page = ActiveRecordModel::getRecordSetArray('StaticPage', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        if($emptyListIsException && count($static_page) == 0)
        {
            throw new Exception('News post not found');
        }
        while($category = array_shift($static_page))
        {
            $xmlPage = $response->addChild('static_page');
            foreach($category as $k => $v)
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
?>