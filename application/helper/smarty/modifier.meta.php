<?php

/**
 *  Meta-keywords/description field cleanup
 *
 *  @package application.helper.smarty
 *  @author Integry Systems
 */
function smarty_modifier_meta($value, $default = '')
{
	if (!$value)
	{
		$value = $default;
	}

	$value = preg_replace('/\<script.*\<\/script\>/msU', 'XXX', $value);
	$value = strip_tags($value);
	$value = str_replace(array("\n"), ' ', $value);
	$value = str_replace(" // ", ' ', $value);
	$value = preg_replace('/[ ]+/', ' ', $value);
	$value = trim($value);

	if (function_exists('mb_strlen'))
	{
		if (mb_strlen($value, 'UTF-8') > 163)
		{
			$value = mb_substr($value, 0, 160, 'UTF-8') . '...';
		}
	}
	else
	{
		if (strlen($value) > 163)
		{
			$value = substr($value, 0, 160) . '...';
		}
	}

	return htmlspecialchars($value);
}

?>