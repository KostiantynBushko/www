<?php

class FixVariationImageFlicker extends ControllerPlugin
{
	public function process()
	{
		$this->application->getRouter()->removeAutoAppendVariable('currency');

		$product = $this->response->get('product');
		$product['URL'] = '';
		$this->response->set('product', $product);

		if (!$this->request->get('activeVariationID') || !($this->response instanceof ActionResponse))
		{
			return;
		}

		$images = $this->response->get('images');
		if (!$images)
		{
			return;
		}

		foreach ($images as $image)
		{
			if ($image['productID'] == $this->request->get('activeVariationID'))
			{
				$product['DefaultImage'] = $image;
			}
		}

		$this->response->set('product', $product);
	}
}

?>
