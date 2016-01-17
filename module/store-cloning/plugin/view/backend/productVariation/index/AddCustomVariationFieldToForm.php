<?php

class AddCustomVariationFieldToForm extends ViewPlugin
{
	public function process($source)
	{
		$source = str_replace('<th class="stockCount">{tip _inventory}</th>', '
		<th class="stockCount">{tip _inventory}</th>
		<th class="custom">Custom</th>', $source);

		$source = str_replace('stockCount[]" /></td>', 'stockCount[]" /></td>
		<td class="custom"><textarea name="custom[]"></textarea></td>', $source);

		return $source;
	}
}

?>
