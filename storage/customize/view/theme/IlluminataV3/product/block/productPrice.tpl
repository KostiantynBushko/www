{if 'DISPLAY_PRICES'|config}
<div class="price">
	{$product.formattedPrice.$currency}
	{*if $product.formattedListPrice.$currency}
		<span class="listPrice">
			{$product.formattedListPrice.$currency}
		</span>
	{/if*}
</div>
{/if}