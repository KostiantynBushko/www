{form id="clonedStoreForm_`$clonedStore.ID`" handle=$form action="controller=backend.clonedStore action=save id=`$clonedStore.ID`" method="post" onsubmit="Backend.ClonedStore.prototype.save(this); return false;"}
	<fieldset>

		<p>
			{{err for="domain"}}
				{{label {t ClonedStore.domain} }}
				{textfield class="text"}
			{/err}
		</p>

		<p>
			{{err for="apiKey"}}
				{{label {t ClonedStore.apiKey} }}
				{textfield class="text"}
			{/err}
		</p>

	</fieldset>

	<fieldset class="controls">
		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" class="submit" id="submit" value="{tn _save}"/> or
		<a href="#" class="cancel" onClick="$('clonedStoreForm_{$clonedStore.ID}').reset(); return false;">{t _cancel}</a>
		<div class="clear"></div>
	</fieldset>

{/form}

<script type="text/javascript">
	var camp = new Backend.ClonedStore({json array=$clonedStore});
</script>
