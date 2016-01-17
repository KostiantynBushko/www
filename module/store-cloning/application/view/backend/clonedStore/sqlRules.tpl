<div id="sqlRuleTemplate" style="display: none;" class="rule">
	<span class="field" style="display: none;">
		Field: {include file="module/store-cloning/backend/clonedStore/field.tpl"}
	</span>
	<span class="query">
		SQL query: <textarea class="text" name="query[]"></textarea>
	</span>

	<a href="#" class="moveUp"></a>
	<a href="#" class="moveDown"></a>
	<a href="#" class="delete"></a>
</div>

<form action="{link controller=backend.clonedStore action=saveSqlRules id=$store.ID}" method="POST" onSubmit="event.preventDefault(); Backend.ClonedStore.saveRules(this);">
	<div class="rules" id="{uniqid assign=contID}"></div>

	<fieldset class="controls">
		<input type="submit" class="submit" value="Save" />
		<span class="progressIndicator" style="display: none;"></span>
	</fieldset>
</form>

<script type="text/javascript">
	Backend.ClonedStore.initSqlRules('{$contID}', {json array=$rules});
</script>
