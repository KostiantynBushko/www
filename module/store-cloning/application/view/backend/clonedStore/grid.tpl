<fieldset class="container activeGridControls" style="float: left;">

	<span class="activeGridMass" id="clonedStoreMass" >

		{form action="controller=backend.clonedStore action=processMass" method="POST" handle=$massForm onsubmit="return false;"}

		<input type="hidden" name="filters" value="" />
		<input type="hidden" name="selectedIDs" value="" />
		<input type="hidden" name="isInverse" value="" />

		{t _with_selected}:
		<select name="act" class="select">
			<option value="delete">{t _delete}</option>
		</select>

		<span class="bulkValues" style="display: none;"></span>

		<input type="submit" value="{tn _process}" class="submit" />
		<span class="progressIndicator" style="display: none;"></span>

		{/form}

	</span>

	<span class="activeGridItemsCount">
		<span id="userCount_{$userGroupID}">
			<span class="rangeCount" style="display: none;">{t _listing_stores}</span>
			<span class="notFound" style="display: none;">No stores found</span>
		</span>
	</span>

</fieldset>

{activeGrid
	prefix="clonedStore"
	controller="backend.clonedStore" action="lists"
	displayedColumns=$displayedColumns
	availableColumns=$availableColumns
	totalCount=$totalCount
	container="clonedStoreGrid"
	dataFormatter="Backend.ClonedStore.GridFormatter"
}

<script type="text/javascript">
	var massHandler = new ActiveGrid.MassActionHandler($('clonedStoreMass'), window.activeGrids['clonedStore_']);
	massHandler.deleteConfirmMessage = 'Really delete the selected store(s)?' ;
	massHandler.nothingSelectedMessage = 'Please select at least one store first' ;
</script>
