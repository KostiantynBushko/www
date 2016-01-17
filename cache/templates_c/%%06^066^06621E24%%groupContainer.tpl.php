<?php /* Smarty version 2.6.26, created on 2015-12-11 14:39:30
         compiled from custom:backend/customerOrder/groupContainer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/customerOrder/groupContainer.tpl', 3, false),array('function', 'link', 'custom:backend/customerOrder/groupContainer.tpl', 8, false),)), $this); ?>
<div id="orderGroupsManagerContainer" class="treeManagerContainer maxHeight h--20">   
	<div id="loadingOrder" style="display: none; position: absolute; text-align: center; width: 100%; padding-top: 200px; z-index: 50000;">
		<span style="padding: 40px; background-color: white; border: 1px solid black;"><?php echo smarty_function_translate(array('text' => '_loading_order'), $this);?>
<span class="progressIndicator"></span></span>
	</div>
	<div class="tabContainer" id="orderGroupsTabContainer">
		<ul class="tabList tabs">
			<li id="tabOrders" class="tab inactive">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'orders'), $this);?>
?id=_id_"><?php echo smarty_function_translate(array('text' => '_orders'), $this);?>
</a>
				<span class="tabHelp">orders</span>
			</li>
		</ul>
	</div>
	<div class="sectionContainer maxHeight h--50"></div>
</div>