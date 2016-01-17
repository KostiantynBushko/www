<?php

/**
 * Set page title
 *
 * @package application.helper.smarty
 * @author Integry Systems
 */
function smarty_block_pageTitle($params, $content, LiveCartSmarty $smarty, &$repeat)
{
	if (!$repeat)
	{
		$smarty->assign('TITLE', strip_tags($content));

		if (isset($params['help']))
		{
			$content .= '<script type="text/javascript">Backend.setHelpContext("' . $params['help'] . '")</script>';
		}
		$GLOBALS['PAGE_TITLE'] = $content;

		$smarty->assign('PAGE_TITLE', $content);
		$smarty->_smarty_vars['PAGE_TITLE'] = $content;
	}
}

?>