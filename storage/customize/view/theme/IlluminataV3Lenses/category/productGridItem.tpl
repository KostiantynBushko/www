{include file="product/block/smallImage.tpl"}

<div class="title">
	<a href="{productUrl product=$product filterChainHandle=$filterChainHandle}">{$product.name_lang}</a>
</div>

<div class="pricingInfo"><div><div><div>
	{include file="product/block/cartButton.tpl"}
	<div class="priceAboveCart">
	{if $product.isAvailable}
	{include file="product/block/productPrice.tpl"}
	{/if}
	</div>
	
	{if $hasMirror[$product.ID]}
		<div style="display: none;>"{include file="module/store-cloning/mirror/button.tpl"}</div>
	{/if}
	<div class="clear"></div>
</div></div></div></div>

<div class="order" style="border-bottom: 1px solid #d8d8d8;">
	<div class="orderingControls">
		{if $product.rating && 'ENABLE_RATINGS'|config}
			{include file="category/productListRating.tpl"}
			{if 'ENABLE_WISHLISTS'|config}
				<span class="listItemSeparator">|</span>
			{/if}
		{/if}

		{if 'ENABLE_WISHLISTS'|config}
			<a href="{link controller=order action=addToWishList id=$product.ID returnPath=true}" rel="nofollow" class="addToWishList tooltip" title="Add To Wishlist"><span title="More"><img src="upload/theme/IlluminataV3Lenses/wishicon.png"></span></a>
		{/if}
	</div>
</div>

{if 'ENABLE_PRODUCT_COMPARE'|config}
<div class="compare">
	{include file="compare/block/compareLink.tpl"}
</div>
{/if}