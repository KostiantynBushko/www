<?php

class FindMirrorImage extends ControllerPlugin
{
	public function process()
	{
		$images = $this->response->get('images');
		$product = $this->response->get('product');
		
		foreach ($images as $key => $image)
		{
			if ($image['title_lang'] == 'Virtual Mirror')
			{
				unset($images[$key]);
				$product['hasMirror'] = true;
			}
		}
		
		$this->response->set('images', $images);
		$this->response->set('product', $product);
    }
}
?>
