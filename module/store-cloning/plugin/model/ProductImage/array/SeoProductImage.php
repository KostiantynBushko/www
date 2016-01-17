<?php
ClassLoader::import("module.store-cloning.plugin.model.SeoImagePlugin");

class SeoProductImage extends SeoImagePlugin
{
	public function process()
	{
			if (empty($this->object['Product']))
			{
//				var_dump($this->object);
			}

		if (empty($this->object['title_lang']) && !empty($this->object['Product']))
		{
			if (empty($this->object['Product']['name_lang']))
			{
				$this->object['Product']['name_lang'] = $this->object['Product']['name']['en'];
			}
			
			$this->object['title_lang'] = $this->object['Product']['name_lang'];
		}

		if(array_key_exists('paths', $this->object))
		{
			$this->applyKeywords($this->object);
		}
    }
}

?>
