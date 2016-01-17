<?php /* Smarty version 2.6.26, created on 2015-12-11 06:45:04
         compiled from custom:user/shipmentEntry.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:user/shipmentEntry.tpl', 3, false),array('modifier', 'config', 'custom:user/shipmentEntry.tpl', 23, false),)), $this); ?>
<?php if ($this->_tpl_vars['order']['isMultiAddress']): ?>
	<div class="shipmentAddress">
		<span class="shipmentAddressLabel"><?php echo smarty_function_translate(array('text' => '_shipment_shipped_to'), $this);?>
:</span> <?php echo $this->_tpl_vars['shipment']['ShippingAddress']['compact']; ?>

	</div>
<?php endif; ?>

<table class="table shipment">

	<thead>
		<tr>
			<th class="sku"><?php echo smarty_function_translate(array('text' => '_sku'), $this);?>
</th>
			<th class="productName"><?php echo smarty_function_translate(array('text' => '_product'), $this);?>
</th>
			<th><?php echo smarty_function_translate(array('text' => '_price'), $this);?>
</th>
			<th><?php echo smarty_function_translate(array('text' => '_quantity'), $this);?>
</th>
			<th><?php echo smarty_function_translate(array('text' => '_subtotal'), $this);?>
</th>
		</tr>
	</thead>

	<tbody>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/orderTableDetails.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php if (! ((is_array($_tmp='HIDE_TAXES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) || $this->_tpl_vars['showTaxes']): ?>
			<?php $_from = $this->_tpl_vars['shipment']['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax']):
?>
				<tr>
					<td colspan="4" class="tax"><?php echo $this->_tpl_vars['tax']['TaxRate']['Tax']['name_lang']; ?>
:</td>
					<td><?php echo $this->_tpl_vars['tax']['formattedAmount'][$this->_tpl_vars['order']['Currency']['ID']]; ?>
</td>
				</tr>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>

		<?php if ($this->_foreach['shipments']['iteration'] == 1): ?>
			<?php $_from = $this->_tpl_vars['order']['discounts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['discount']):
?>
				<?php if ($this->_tpl_vars['discount']['amount'] != 0): ?>
					<tr>
						<td colspan="4" class="subTotalCaption"><span class="discountLabel"><?php if ($this->_tpl_vars['discount']['amount'] > 0): ?><?php echo smarty_function_translate(array('text' => '_discount'), $this);?>
<?php else: ?><?php echo smarty_function_translate(array('text' => '_surcharge'), $this);?>
<?php endif; ?>:</span> <span class="discountDesc"><?php echo $this->_tpl_vars['discount']['description']; ?>
</span></td>
						<td class="amount discountAmount"><?php echo $this->_tpl_vars['discount']['formatted_amount']; ?>
</td>
					</tr>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>

		<tr>
			<td colspan="4" class="subTotalCaption">
				<?php if ($this->_foreach['shipments']['total'] > 1): ?>
					<?php echo smarty_function_translate(array('text' => '_shipment_total'), $this);?>
:
				<?php else: ?>
					<?php echo smarty_function_translate(array('text' => '_order_total'), $this);?>
:
				<?php endif; ?>
			</td>
			<td class="subTotal">
				<?php if ($this->_foreach['shipments']['total'] == 1): ?>
					<?php echo $this->_tpl_vars['order']['formattedTotal'][$this->_tpl_vars['order']['Currency']['ID']]; ?>

				<?php else: ?>
					<?php echo $this->_tpl_vars['shipment']['formatted_totalAmount']; ?>

				<?php endif; ?>
			</td>
		</tr>

	</tbody>

</table>