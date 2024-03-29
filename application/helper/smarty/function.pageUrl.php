<?php

/**
 * Generates static page URL
 *
 * @param array $params
 * @param Smarty $smarty
 * @return string
 *
 * @package application.helper.smarty
 * @author Integry Systems
 */
function smarty_function_pageUrl($params, LiveCartSmarty $smarty)
{
	if (!class_exists('StaticPage', false))
	{
		ClassLoader::import('application.model.staticpage.StaticPage');
	}

	if (isset($params['id']))
	{
		$params['data'] = StaticPage::getInstanceById($params['id'], StaticPage::LOAD_DATA)->toArray();
	}

	$urlParams = array('controller' => 'staticPage',
					   'action' => 'view',
					   'handle' => $params['data']['handle'],
					   );

	return $smarty->getApplication()->getRouter()->createUrl($urlParams, true);
}

?>