<?php

class SaveCustomVariationFields extends ControllerPlugin
{
	public function process()
	{
		$custom = $this->request->get('custom');
		foreach (json_decode($this->request->get('items')) as $key => $id)
		{
			$prod = Product::getInstanceByID($id, true);
			$prod->custom->set($custom[$key]);
			$prod->save();
		}
	}
}

?>
