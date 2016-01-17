{includeJs file="library/livecart.js"}
{includeJs file="library/KeyboardEvent.js"}
{includeJs file="library/ActiveGrid.js"}
{includeJs file="library/ActiveList.js"}
{includeJs file="library/form/ActiveForm.js"}
{includeJs file="library/form/State.js"}
{includeJs file="library/form/Validator.js"}
{includeJs file="library/TabControl.js"}
{includeJs file="library/rico/ricobase.js"}
{includeJs file="library/rico/ricoLiveGrid.js"}

{includeJs file="/module/store-cloning/javascript/backend/jquery.min.js"}
{includeJs file="/module/store-cloning/javascript/backend/jquery-ui.custom.min.js"}
{includeJs file="/module/store-cloning/javascript/backend/jquery-cookie.js"}
{includeJs file="/module/store-cloning/javascript/backend/jquery.dynatree.min.js"}

{includeJs file="/module/store-cloning/javascript/backend/ClonedStore.js"}
{includeCss file="/module/store-cloning/stylesheet/backend/ClonedStore.css"}
{includeCss file="/module/store-cloning/stylesheet/backend/ui.dynatree.css"}

{includeCss file="library/ActiveList.css"}
{includeCss file="library/ActiveGrid.css"}
{includeCss file="library/TabControl.css"}
{includeCss file="library/dhtmlxtree/dhtmlXTree.css"}
{includeCss file="library/lightbox/lightbox.css"}

{include file="backend/eav/includes.tpl"}

{pageTitle}Manage Stores{/pageTitle}
{include file="layout/backend/header.tpl"}

<div id="mainAdvContainer">

	<div id="managerContainer" class="maxHeight h--60">

		<div id="loadingClonedStore" style="display: none; position: absolute; text-align: center; width: 100%; padding-top: 200px; z-index: 50000;">
			<span style="padding: 40px; background-color: white; border: 1px solid black;">{t _loading_clonedStore}<span class="progressIndicator"></span></span>
		</div>

		<div>
			<ul class="menu">
				<li><a href="{link controller=backend.clonedStore action=add}" onclick="Backend.ClonedStore.prototype.add(event);">Add new store</a></li>
			</ul>

			<div class="clonedStoreGrid" id="clonedStoreGrid" class="maxHeight h--50">

				{include file="module/store-cloning/backend/clonedStore/grid.tpl"}

			</div>
		</div>
	</div>
</div>

{* Editors *}
<div id="clonedStoreManagerContainer" style="display: none;">
	<fieldset class="container">
		<ul class="menu">
			<li class="done"><a href="#cancelEditing" id="cancel_user_edit" class="cancel">Cancel editing store</a></li>
		</ul>
	</fieldset>

	<div class="tabContainer">
		{tabControl id="clonedStoreTabList" noHidden=true}
			{tab id="tabUserInfo"}<a href="{link controller=backend.clonedStore action=edit id=_id_}"}">Basic Information</a>{/tab}
			{tab id="tabCategories"}<a href="{link controller=backend.clonedStore action=categories id=_id_ }">Categories</a>{/tab}
			{tab id="tabTextRules"}<a href="{link controller=backend.clonedStore action=textRules id=_id_ }">Text Replace Rules</a>{/tab}
			{tab id="sqlRules"}<a href="{link controller=backend.clonedStore action=sqlRules id=_id_ }">SQL Queries</a>{/tab}
		{/tabControl}
	</div>
	<div class="sectionContainer maxHeight h--50"></div>

	{literal}
	<script type="text/javascript">
		Event.observe($("cancel_user_edit"), "click", function(e) {
			Event.stop(e);
			var editor = Backend.ClonedStore.Editor.prototype.getInstance(Backend.ClonedStore.Editor.prototype.getCurrentId(), false);
			editor.cancelForm();
		});
	</script>
	{/literal}
</div>

{include file="layout/backend/footer.tpl"}
