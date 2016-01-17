{if $product.isAvailable && 'ENABLE_CART'|config}
	<a href="{link controller=order action=addToCart id=$product.ID returnPath=true}" rel="nofollow" class="addToCart tooltip" title="Add To Cart"><span title="More">Buy Now <img src="upload/theme/IlluminataV3Lenses/carticon.png"></span></a>
{else}
<div class="soldOut">
Sold Out
</div>
{/if}
