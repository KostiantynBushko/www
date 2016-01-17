<?php

class VariationImageLinkToProductPage extends ViewPlugin
{
	public function process($source)
	{
		$source = str_replace('<a href="{$image.paths.4}" target="_blank" onclick="return false;">', 
		'{if $image.productID != $product.ID}
			{assign var=varID value=$image.productID}
			{php}$this->assign("varProduct", Product::getInstanceByID($this->get_template_vars("varID"))->toArray());{/php}
			{capture assign=imgLink}{productUrl product=$varProduct}{/capture}
			{assign var="isVariation" value=1}
		{else} 
			{assign var="imgLink" value=$image.paths.4}
			{assign var="isVariation" value=0}
		{/if}
		<a href="{$imgLink}" {if !$isVariation}target="_blank" onclick="return false;"{/if}>
		', $source);
		
		return $source;
	}
}

?>
