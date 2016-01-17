{if $product.hasMirror && 'ENABLE_VIRTUAL_MIRROR'|config}
	<a href="#" value="Try On" id="try-on" onclick="showMirror({$product.ID}, event)" style="position: relative; top: -2px;"><img src="upload/theme/IlluminataV3/tryon.jpg"></a>
{/if}