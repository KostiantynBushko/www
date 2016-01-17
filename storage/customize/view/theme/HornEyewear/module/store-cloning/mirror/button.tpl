{if $product.hasMirror && 'ENABLE_VIRTUAL_MIRROR'|config}
	<a href="#" value="Try On" id="try-on" onclick="showMirror({$product.ID}, event)">Try On</a>
{/if}