<?php

/**
 * Set canonical URL
 *
 * @package application.helper.smarty
 * @author Integry Systems
 * @see http://googlewebmastercentral.blogspot.com/2009/02/specify-your-canonical.html
 */
function smarty_block_canonical($params, $content, LiveCartSmarty $smarty, &$repeat)
{
	if (!$repeat)
	{
        /*
		$parsed = parse_url($content);
		if (!empty($parsed['query']))
		{
			$pairs = array();
			foreach (explode('&amp;', $parsed['query']) as $pair)
			{
				$values = explode('=', $pair, 2);
				if (count($values) != 2)
				{
					continue;
				}

				$pairs[$values[0]] = $values[1];
			}

			$pairs = array_diff_key($pairs, array_flip(array('currency', 'sort')));
			$parsed['query'] = http_build_query($pairs);
		}

		$content = $parsed['path'] . (!empty($parsed['query']) ? '?' . $parsed['query'] : '');
        */

        $content = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

        $queryStartPos = strpos($content, '&');
        $content =  ($queryStartPos !== false) ? substr($content, 0, $queryStartPos) : $content;

        $queryStartPos = strpos($content, '?');
        $content =  ($queryStartPos !== false) ? substr($content, 0, $queryStartPos) : $content;

        $content =
        $GLOBALS['CANONICAL'] = $content;
		$smarty->assign('CANONICAL', $content);
		$smarty->_smarty_vars['CANONICAL'] = $content;
	}
}

?>