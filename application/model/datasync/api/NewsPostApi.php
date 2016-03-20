<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/23/16
 * Time: 18:24
 */

ClassLoader::import('application.model.datasync.ModelApi');
ClassLoader::import('application.model.sitenews.NewsPost');
ClassLoader::import('application.helper.LiveCartSimpleXMLElement');

class NewsPostApi extends ModelApi
{

    public static function canParse(Request $request)
    {
        return parent::canParse($request, array('XmlNewsPostApiReader'));
    }

    public function __construct(LiveCart $application)
    {
        parent::__construct(
            $application,
            'NewsPost',
            array() // fields to ignore in NewsPost model
        );
    }

    public function get()
    {
        $parser = $this->getParser();
        $id = $this->getRequestID();
        $categories = ActiveRecordModel::getRecordSetArray('NewsPost',
            select(eq(f('NewsPost.ID'), $id))
        );
        if(count($categories) == 0)
        {
            throw new Exception('NewsPost not found');
        }
        $apiFieldNames = $parser->getApiFieldNames();

        // --
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        $responseCategory = $response->addChild('newspost');
        while($category = array_shift($categories))
        {
            foreach($category as $k => $v)
            {
                if(in_array($k, $apiFieldNames))
                {
                    $responseCategory->addChild($k, $v);
                }
            }
        }
        return new SimpleXMLResponse($response);
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
            $f->mergeCondition(new EqualsCond(new ARFieldHandle('NewsPost', 'ID'), $id));
        }
        $f->setOrder(new ARExpressionHandle(('NewsPost.ID')), 'DESC');

        $newspost = ActiveRecordModel::getRecordSetArray('NewsPost', $f);
        $response = new LiveCartSimpleXMLElement('<response datetime="'.date('c').'"></response>');
        if($emptyListIsException && count($newspost) == 0)
        {
            throw new Exception('News post not found');
        }
        while($category = array_shift($newspost))
        {
            $xmlNewsPost = $response->addChild('newspost');
            foreach($category as $k => $v)
            {
                if(in_array($k, $apiFieldNames))                 // those who are allowed fields ($this->apiFieldNames) ?
                {
                    $xmlNewsPost->addChild($k, htmlentities($v));
                }
            }
        }
        return new SimpleXMLResponse($response);
    }

}
?>