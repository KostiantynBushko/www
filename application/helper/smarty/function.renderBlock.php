<?php

/**
 * Renders and displays a page content block
 *
 * @param array $params
 * @param Smarty $smarty
 * @return string
 *
 * @package application.helper.smarty
 * @author Integry Systems
 */
function smarty_function_renderBlock($params, LiveCartSmarty $smarty)
{
	return $smarty->getApplication()->getBlockContent($params['block']);
}

?>