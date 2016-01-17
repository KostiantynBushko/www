<?php
/**
 * Display a tip block
 *
 * @package application.helper.smarty
 * @author Integry Systems
 *
 * @package application.helper.smarty
 */
function smarty_block_denied($params, $content, LiveCartSmarty $smarty, &$repeat)
{
	if (!$repeat)
	{
		ClassLoader::import('application.helper.AccessStringParser');
		if(!AccessStringParser::run($params['role']))
		{
			return $content;
		}
	}
}
?>