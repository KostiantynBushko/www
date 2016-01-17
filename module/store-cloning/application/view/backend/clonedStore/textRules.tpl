<div id="textRuleTemplate" style="display: none;" class="rule">
	<span class="field">
		Field: {include file="module/store-cloning/backend/clonedStore/field.tpl"}
	</span>

	<fieldset class="container">
		<span class="find">
			<label>find:</label><textarea value="" name="find[]"></textarea>
			<span class="hint">Leave the <em>replace</em> field empty to enter a template. For example: <em>The beautiful %name% (%sku%) have been manufactured since %field_year%</em></span>
		</span>
		<br />
		<span class="repl">
			<label>replace:</label><textarea value="" name="repl[]"></textarea>
			<span class="hint">Leave the <em>find</em> field empty to enter a default value in <em>replace</em> field</span>
		</span>
		<span class="query">
			<label>WHERE condition:</label><textarea value="" name="query[]"></textarea>
			<span class="hint">For example: <em>manufacturerID=123</em></span>
		</span>
	</fieldset>
	<a href="#" class="moveUp"></a>
	<a href="#" class="moveDown"></a>
	<a href="#" class="delete"></a>
</div>

<form action="{link controller="backend.clonedStore" action=saveTextRules id=$store.ID}" method="POST" onSubmit="event.preventDefault(); Backend.ClonedStore.saveRules(this);">
	<div class="rules" id="{uniqid assign=contID}"></div>

	<fieldset class="controls">
		<input type="submit" class="submit" value="Save" />
		<span class="progressIndicator" style="display: none;"></span>
	</fieldset>
</form>

<script type="text/javascript">
	Backend.ClonedStore.initTextRules('{$contID}', {json array=$rules});
</script>
