<script type="text/javascript">
	var tree = {$tree};

		jQuery("#storeCategories_{$store.ID}").dynatree({literal}{
			checkbox: true,
			selectMode: 3,
			children: tree,
			onDblClick: function(node, event) {
				node.toggleSelect();
			},
			onSelect: function(select, node) {
				var $ = jQuery;

				var selKeys = $.map(node.tree.getSelectedNodes(), function(node){
					return node.data.key;
				});
				// Get a list of all selected TOP nodes
				var selRootNodes = node.tree.getSelectedNodes(true);
				// ... and convert to a key array:
				var selRootKeys = $.map(selRootNodes, function(node){
					return node.data.key;
				});

				$('form input.hidden', node.tree.divTree.parentNode).val(selRootKeys.join(","));
			},
			onKeydown: function(node, event) {
				if( event.which == 32 ) {
					node.toggleSelect();
					return false;
				}
			}
		});
</script>
{/literal}

<div class="categorytreeContainer">
	<div id="storeCategories_{$store.ID}"></div>

	<form action="{link controller=backend.clonedStore action=saveCategories id=$store.ID}" method="POST" onSubmit="event.preventDefault(); Backend.ClonedStore.saveCategories(this);">
		<fieldset class="controls">
			<input type="submit" class="submit" value="Save" />
			<input type="hidden" class="hidden" name="categories" value="nochange" />
			<span class="progressIndicator" style="display: none;"></span>
		</fieldset>
	</form>
</div>