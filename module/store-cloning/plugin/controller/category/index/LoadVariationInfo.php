<?php

class LoadVariationInfo extends ControllerPlugin
{
	public function process()
	{
		$this->application->getRouter()->removeAutoAppendVariable('currency');

		if (!($this->response instanceof ActionResponse))
		{
			return;
		}

		$products = $this->response->get('products');

		$parents = $variations = array();
		foreach ($products as $key => $product)
		{
			if ($product['parentID'])
			{
				$parents[$product['parentID']] = true;
				$variations[$key] = $product;
			}
		}

		if (!$parents)
		{
			return;
		}

		$loadedParents = array();
		foreach (ActiveRecordModel::getRecordSetArray('Product', select(in(f('Product.ID'), array_keys($parents))), array('Manufacturer', 'DefaultImage' => 'ProductImage', 'Category')) as $parent)
		{
			$loadedParents[$parent['ID']] = $parent;
		}

		ProductSpecification::loadSpecificationForRecordSetArray($loadedParents);
		ProductPrice::loadPricesForRecordSetArray($loadedParents);

		foreach ($products as $key => $product)
		{
			if ($product['parentID'])
			{
				$parent = $loadedParents[$product['parentID']];
				foreach ($parent as $field => $value)
				{
					if (empty($product[$field]))
					{
						$product[$field] = $parent[$field];
					}
				}

				foreach (array('price_USD', 'price_CAD', 'formattedPrice', 'formattedListPrice') as $field)
				{
					if (isset($parent[$field]))
					{
						$product[$field] = $parent[$field];
					}
				}

				///var_dump($parent);exit;

				$products[$key] = $product;
			}
		}

		ProductSet::loadVariationsForProductArray($variations);

		foreach ($variations as $key => $variation)
		{
			$vars = array();
			foreach ($variation['variationTypes'] as $type)
			{
				$vars[] = $type['name_lang'];
			}

			if ($vars)
			{
				$products[$key]['name_lang'] .= ' (' . implode(' / ', $vars) . ')';
			}
		}

		$this->response->set('products', $products);
	}
}

?>
