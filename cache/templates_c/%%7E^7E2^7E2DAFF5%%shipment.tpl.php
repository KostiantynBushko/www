<?php /* Smarty version 2.6.26, created on 2015-12-11 14:39:31
         compiled from custom:backend/shipment/shipment.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/shipment/shipment.tpl', 3, false),)), $this); ?>
<fieldset class="shipmentContainer">
<?php if ($this->_tpl_vars['shipment']['isShippable']): ?>
	<legend><?php echo smarty_function_translate(array('text' => '_shipment'), $this);?>
 #<?php echo $this->_tpl_vars['shipment']['ID']; ?>
</legend>
<?php endif; ?>

	<div class="shipmentStatus_<?php echo $this->_tpl_vars['shipment']['status']; ?>
">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/shipment/shipmentControls.tpl", 'smarty_include_vars' => array('status' => $this->_tpl_vars['shipment']['status'],'notShippable' => $this->_tpl_vars['notShippable'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<table class="orderShipmentsItem_info shipmentTableHeading" style="font-size: smaller; display: table;">
			<tbody>
			  <tr>
				<td class="orderShipmentsItem_info_sku_td">
					<div class="orderShipmentsItem_info_sku">
						<?php echo smarty_function_translate(array('text' => '_sku'), $this);?>

					</div>
				</td>
				<td class="orderShipmentsItem_info_name_td">
					<div class="orderShipmentsItem_info_name">
						<?php echo smarty_function_translate(array('text' => '_name'), $this);?>

					</div>
				</td>
				<td class="orderShipmentsItem_info_price_td">
					<div class="orderShipmentsItem_info_price">
						<?php echo smarty_function_translate(array('text' => '_item_price'), $this);?>

					</div>
				</td>
				<td class="orderShipmentsItem_info_count_td">
					<div class="orderShipmentsItem_info_count">
						<?php echo smarty_function_translate(array('text' => '_quantity'), $this);?>

					</div>
				</td>
				<td class="orderShipmentsItem_info_total_td">
					<div class="orderShipmentsItem_info_total item_subtotal">
						<?php echo smarty_function_translate(array('text' => '_subtotal'), $this);?>

					</div>
				</td>
			  </tr>
			</tbody>
		</table>

		<ul id="orderShipmentsItems_list_<?php echo $this->_tpl_vars['orderID']; ?>
_<?php echo $this->_tpl_vars['shipment']['ID']; ?>
" class="<?php if ($this->_tpl_vars['shipment']['status'] != 3 && $this->_tpl_vars['shipableShipmentsCount'] > 1 && $this->_tpl_vars['shipment']['isShippable']): ?>activeList_add_sort<?php endif; ?> activeList_add_delete orderShipmentsItem activeList_accept_orderShipmentsItem ohoho_<?php echo $this->_tpl_vars['shipment']['ID']; ?>
">
		<?php $_from = $this->_tpl_vars['shipment']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<li id="orderShipmentsItems_list_<?php echo $this->_tpl_vars['orderID']; ?>
_<?php echo $this->_tpl_vars['shipment']['ID']; ?>
_<?php echo $this->_tpl_vars['item']['ID']; ?>
" >
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/shipment/itemAmount.tpl", 'smarty_include_vars' => array('shipped' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</li>
		<?php endforeach; endif; unset($_from); ?>
		</ul>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/shipment/shipmentTotal.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>

</fieldset>