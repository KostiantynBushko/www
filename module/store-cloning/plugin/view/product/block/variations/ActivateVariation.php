<?php

class ActivateVariation extends ViewPlugin
{
	public function process($source)
	{
		return $source . '
		<script type="text/javascript">
			{if $request.activeVariationID}
				window.productVariationHandler.setVariation({$request.activeVariationID});
			{/if}
		</script>
		';
	}
}

?>
