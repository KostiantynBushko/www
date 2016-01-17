<?php /* Smarty version 2.6.26, created on 2015-12-13 16:28:12
         compiled from /home/illumin/public_html/application/view///backend/customerOrder/orders.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'denied', '/home/illumin/public_html/application/view///backend/customerOrder/orders.tpl', 4, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/customerOrder/orders.tpl', 4, false),array('function', 'json', '/home/illumin/public_html/application/view///backend/customerOrder/orders.tpl', 9, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/customerOrder/orders.tpl', 11, false),array('function', 'backendOrderUrl', '/home/illumin/public_html/application/view///backend/customerOrder/orders.tpl', 43, false),array('function', 'activeGrid', '/home/illumin/public_html/application/view///backend/customerOrder/orders.tpl', 60, false),array('modifier', 'addslashes', '/home/illumin/public_html/application/view///backend/customerOrder/orders.tpl', 98, false),)), $this); ?>
<div>

	<ul class="menu" >
		<li class="createNewOrder"><a href="#" id="createNewOrderLink_<?php echo $this->_tpl_vars['orderGroupID']; ?>
"  <?php $this->_tag_stack[] = array('denied', array('role' => 'order.create')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>><?php echo smarty_function_translate(array('text' => '_create_order'), $this);?>
</a><span class="progressIndicator" style="display: none;"></span></li>
	</ul>

	<?php echo '
	<script type="text/javascript">
		if ('; ?>
<?php echo smarty_function_json(array('array' => $this->_tpl_vars['userID']), $this);?>
<?php echo ' != null)
		{
			Backend.CustomerOrder.Links.createOrder = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'create'), $this);?>
<?php echo '\';
			Event.observe($("'; ?>
createNewOrderLink_<?php echo $this->_tpl_vars['orderGroupID']; ?>
<?php echo '"), "click", function(e)
			{
				Backend.CustomerOrder.prototype.createUserOrder(\''; ?>
<?php echo $this->_tpl_vars['userID']; ?>
<?php echo '\', $("'; ?>
createNewOrderLink_<?php echo $this->_tpl_vars['orderGroupID']; ?>
"), '<?php echo smarty_function_link(array('controller' => "backend.customerOrder"), $this);?>
');
				<?php echo '
				Event.stop(e);
			});
		}
		else
		{
			Event.observe($("'; ?>
createNewOrderLink_<?php echo $this->_tpl_vars['orderGroupID']; ?>
<?php echo '"), "click", function(e)
			{
				Event.stop(e);

				Backend.CustomerOrder.prototype.customerPopup = new Backend.SelectPopup(
					Backend.CustomerOrder.Links.selectCustomer,
					Backend.CustomerOrder.Messages.selecCustomerTitle,
					{
						onObjectSelect: function()
						{
						   this.popup.document.getElementById(\'userIndicator_\' + this.objectID).show();
						   Backend.CustomerOrder.prototype.instance.createNewOrder(this.objectID);
						}
					}
				);
			});
		}
	</script>
	'; ?>


<?php echo '
<script type="text/javascript">
	Backend.CustomerOrder.GridFormatter.orderUrl = \''; ?>
<?php echo smarty_function_backendOrderUrl(array(), $this);?>
<?php echo '\';
	Backend.User.OrderGridFormatter.orderUrl = \''; ?>
<?php echo smarty_function_backendOrderUrl(array(), $this);?>
<?php echo '\';
'; ?>


<?php if ($this->_tpl_vars['userID']): ?>
	<?php $this->assign('dataFormatter', "Backend.User.OrderGridFormatter"); ?>;
<?php else: ?>
	<?php $this->assign('dataFormatter', "Backend.CustomerOrder.GridFormatter"); ?>;
<?php endif; ?>

<?php if ($this->_tpl_vars['request']['userOrderID']): ?>
	Backend.User.OrderGridFormatter = Backend.CustomerOrder.GridFormatter;
<?php endif; ?>

</script>


<?php echo smarty_function_activeGrid(array('prefix' => 'orders','id' => $this->_tpl_vars['orderGroupID'],'role' => "order.mass",'controller' => "backend.customerOrder",'action' => 'lists','displayedColumns' => $this->_tpl_vars['displayedColumns'],'availableColumns' => $this->_tpl_vars['availableColumns'],'totalCount' => $this->_tpl_vars['totalCount'],'rowCount' => 15,'showID' => true,'container' => 'tabPageContainer','filters' => $this->_tpl_vars['filters'],'dataFormatter' => $this->_tpl_vars['dataFormatter'],'count' => "backend/customerOrder/count.tpl",'massAction' => "backend/customerOrder/massAction.tpl",'advancedSearch' => true), $this);?>


<li class="detailedExport" id="detailedExportContainer_<?php echo $this->_tpl_vars['orderGroupID']; ?>
">
	<a href="#" onclick="var grid = window.activeGrids['<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
']; window.location.href='<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'exportDetailed'), $this);?>
?' + grid.ricoGrid.getQueryString()+ '&selectedIDs=' + grid.getSelectedIDs().toJSON() + '&isInverse=' + (grid.isInverseSelection() ? 1 : 0); return false;"><?php echo smarty_function_translate(array('text' => '_detailed_export'), $this);?>
</a>
</li>

<?php echo '
<script type="text/javascript">

	var detailedExport = $(\'detailedExportContainer_'; ?>
<?php echo $this->_tpl_vars['orderGroupID']; ?>
<?php echo '\');
	var menu = detailedExport.up(\'.tabPageContainer\').down(\'.activeGridColumns\').down(\'.menu\', 1);
	menu.insertBefore(detailedExport, menu.firstChild);

	var massHandler = new ActiveGrid.MassActionHandler($(\''; ?>
orderMass_<?php echo $this->_tpl_vars['orderGroupID']; ?>
<?php echo '\'),
													   window.activeGrids[\''; ?>
orders_<?php echo $this->_tpl_vars['orderGroupID']; ?>
<?php echo '\'],
														{
															onComplete:
																function()
																{
																	Backend.CustomerOrder.Editor.prototype.resetEditors();
																}
														}
													   );
	massHandler.deleteConfirmMessage = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_to_delete_this_order'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_sure_you_want_to_delete_this_order', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_sure_you_want_to_delete_this_order'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\' ;
	massHandler.nothingSelectedMessage = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_nothing_selected'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__nothing_selected', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__nothing_selected'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\' ;
	ordersActiveGrid[\''; ?>
<?php echo $this->_tpl_vars['orderGroupID']; ?>
<?php echo '\'] = window.activeGrids[\''; ?>
orders_<?php echo $this->_tpl_vars['orderGroupID']; ?>
<?php echo '\'];
</script>
'; ?>
