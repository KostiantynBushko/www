<?php

class LoadMirror extends ControllerPlugin
{
	public function process()
	{
		if (!($this->response instanceof ActionResponse))
		{
			return;
		}

		$products = $this->response->get('products');
		$ids = array();

		foreach ($products as $key => $product)
		{
			$ids[$product['ID']] = !empty($product['parentID']) ? $product['parentID'] : $product['ID'];
		}

		if (!$ids)
		{
			return;
		}
		
		$f = select(in(f('ProductImage.productID'), array_values($ids)), new LikeCond(f('ProductImage.title'), '%Virtual Mirror%'));
		$hasMirror = array();
		foreach (ActiveRecordModel::getRecordSetArray('ProductImage', $f) as $mirror)
		{
			$hasMirror[$mirror['productID']] = true;
		}
		
		foreach ($ids as $realID => $parentID)
		{
			if (!empty($hasMirror[$parentID]))
			{
				$hasMirror[$realID] = true;
			}
		}
		
		foreach ($products as $key => $product)
		{
			if ($hasMirror[$product['ID']])
			{
				$products[$key]['hasMirror'] = true;
			}
		}
		
		$this->response->set('hasMirror', $hasMirror);
		$this->response->set('products', $products);
	}
}

?>
