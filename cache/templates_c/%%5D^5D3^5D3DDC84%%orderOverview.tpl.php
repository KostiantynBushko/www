<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from custom:checkout/orderOverview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', 'custom:checkout/orderOverview.tpl', 8, false),array('function', 'translate', 'custom:checkout/orderOverview.tpl', 8, false),array('modifier', 'config', 'custom:checkout/orderOverview.tpl', 44, false),)), $this); ?>
<?php $this->assign('colspan', '4'); ?>
<?php if ($this->_tpl_vars['productsInSeparateLine']): ?>
	<?php $this->assign('colspan', $this->_tpl_vars['colspan']-1); ?>
<?php endif; ?>

<?php if (! $this->_tpl_vars['nochanges']): ?>
	<div class="orderOverviewControls">
		<a href="<?php echo smarty_function_link(array('controller' => 'order'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_any_changes'), $this);?>
</a>
	</div>
<?php endif; ?>

<table class="table shipment<?php if ($this->_tpl_vars['order']['isMultiAddress']): ?> multiAddress<?php endif; ?>" id="payItems">
	<thead>
		<tr>
			<th class="sku"><?php echo smarty_function_translate(array('text' => '_sku'), $this);?>
</th>
			<?php if (! $this->_tpl_vars['productsInSeparateLine']): ?>
				<th class="productName"><?php echo smarty_function_translate(array('text' => '_product'), $this);?>
</th>
			<?php endif; ?>
			<th><?php echo smarty_function_translate(array('text' => '_price'), $this);?>
</th>
			<th><?php echo smarty_function_translate(array('text' => '_quantity'), $this);?>
</th>
			<th><?php echo smarty_function_translate(array('text' => '_subtotal'), $this);?>
</th>
		</tr>
	</thead>
	<tbody>

	<?php $_from = $this->_tpl_vars['order']['shipments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['shipment']):
?>
		<?php if ($this->_tpl_vars['order']['isMultiAddress']): ?>
			<tr>
				<td colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" class="shipmentAddress">
					<?php echo $this->_tpl_vars['shipment']['ShippingAddress']['compact']; ?>

				</td>
			</tr>
		<?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/orderTableDetails.tpl", 'smarty_include_vars' => array('hideTaxes' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endforeach; endif; unset($_from); ?>

	<?php $_from = $this->_tpl_vars['order']['discounts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['discount']):
?>
		<tr>
			<td colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" class="subTotalCaption"><span class="discountLabel"><?php if ($this->_tpl_vars['discount']['amount'] > 0): ?><?php echo smarty_function_translate(array('text' => '_discount'), $this);?>
<?php else: ?><?php echo smarty_function_translate(array('text' => '_surcharge'), $this);?>
<?php endif; ?>:</span> <span class="discountDesc"><?php echo $this->_tpl_vars['discount']['description']; ?>
</span></td>
			<td class="amount discountAmount"><?php echo $this->_tpl_vars['discount']['formatted_amount']; ?>
</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>

  	<?php if (! ((is_array($_tmp='HIDE_TAXES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<?php $_from = $this->_tpl_vars['order']['taxes'][$this->_tpl_vars['currency']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax']):
?>
			<tr>
				<td colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" class="tax"><?php echo $this->_tpl_vars['tax']['name_lang']; ?>
:</td>
				<td><?php echo $this->_tpl_vars['tax']['formattedAmount']; ?>
</td>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>

	<tr>
		<td colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" class="subTotalCaption"><?php echo smarty_function_translate(array('text' => '_total'), $this);?>
:</td>
		<td class="subTotal"><?php echo $this->_tpl_vars['order']['formattedTotal'][$this->_tpl_vars['currency']]; ?>
</td>
	</tr>

	</tbody>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/fieldValues.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>