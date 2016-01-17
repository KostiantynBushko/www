<?php
ClassLoader::importNow("application.helper.CreateHandleString");

abstract class SeoImagePlugin extends ModelPlugin
{
	protected function applyKeywords(&$array)
    {
		if(array_key_exists('-seo-image-has-keywords', $array))
		{
			return null;
		}
		$keywords = $this->getKeywordsString($array);
		if($keywords)
		{
			$keywords .= '-';
		}

		foreach(array('urls', 'paths') as $key)
		{
			foreach($array[$key] as &$url)
			{
				$position = strrpos($url,'/') + 1;
				$url = substr($url, 0, $position) . $keywords . substr($url, $position);
			}
		}

		$array['-seo-image-has-keywords'] = true;
	}

    protected function getKeywordsString($array)
    {
		if (isset($array['Product']))
		{
			$array = $array['Product'];
		}

		if (empty($array['sku']))
		{
			return null;
		}

		if (is_string($array['name']))
		{
			$array['name_lang'] = $array['name'];
		}

		if (isset($array['DefaultImage']) && is_array($array['DefaultImage']['Product']['name']) && !empty($array['DefaultImage']['Product']['name']['en']))
		{
			$array['name_lang'] = $array['DefaultImage']['Product']['name']['en'];
		}

		if (!empty($array['parentID']) && empty($array['Parent']))
		{
			$array['Parent'] = Product::getInstanceByID($array['parentID'], true)->toArray();
		}

		if (!empty($array['Parent']['name_lang']) && empty($array['name_lang']))
		{
			$array['name_lang'] = $array['Parent']['name_lang'];
		}

		$name = isset($array['name_lang']) ? $array['name_lang'] : array_shift($array['name']);
		//if (!$name) { var_dump($array); exit; }
		$str = $name . '-' . $array['sku'];

		//var_dump($str);

		if($str)
		{
			$str = preg_replace('/[^a-zA-Z0-9_\-]/', '', urldecode(createHandleString($str)));
		}

		return $str && strlen($str) > 0 ? $str : null;
	}

	private function getValueFromLocaleArray($array)
	{
		if(is_array($array))
		{
			foreach(array($this->application->localeName, $this->application->defaultLanguageCode) as $localeCode)
			{
				if(isset($array[$localeCode]) && $array[$localeCode] != '')
				{
					return $array[$localeCode];
				}
			}
		}
		else if(is_string($array) && strlen($array))
		{
			return $array;
		}
		return null;
	}
}

?>
