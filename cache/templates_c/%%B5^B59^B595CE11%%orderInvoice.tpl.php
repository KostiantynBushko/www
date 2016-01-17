<?php /* Smarty version 2.6.26, created on 2015-12-30 12:20:50
         compiled from /home/illumin/public_html/application/view///user/orderInvoice.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'pageTitle', '/home/illumin/public_html/application/view///user/orderInvoice.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/application/view///user/orderInvoice.tpl', 1, false),array('function', 'img', '/home/illumin/public_html/application/view///user/orderInvoice.tpl', 40, false),array('modifier', 'config', '/home/illumin/public_html/application/view///user/orderInvoice.tpl', 39, false),array('modifier', 'default', '/home/illumin/public_html/application/view///user/orderInvoice.tpl', 40, false),)), $this); ?>
<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_invoice'), $this);?>
 <?php echo $this->_tpl_vars['order']['invoiceNumber']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<div class="userOrderInvoice">

<?php if (!function_exists('smarty_fun_address')) { function smarty_fun_address(&$smarty, $params) { $_fun_tpl_vars = $smarty->_tpl_vars; $smarty->assign($params);  ?>
<?php if ($smarty->_tpl_vars['address']): ?>
	<p>
		<?php echo $smarty->_tpl_vars['address']['fullName']; ?>

	</p>
	<p>
		<?php echo $smarty->_tpl_vars['address']['companyName']; ?>

	</p>
	<p>
		<?php echo $smarty->_tpl_vars['address']['address1']; ?>

	</p>
	<p>
		<?php echo $smarty->_tpl_vars['address']['address2']; ?>

	</p>
	<p>
		<?php echo $smarty->_tpl_vars['address']['city']; ?>

	</p>
	<p>
		<?php if ($smarty->_tpl_vars['address']['stateName']): ?><?php echo $smarty->_tpl_vars['address']['stateName']; ?>
, <?php endif; ?><?php echo $smarty->_tpl_vars['address']['postalCode']; ?>

	</p>
	<p>
		<?php echo $smarty->_tpl_vars['address']['countryName']; ?>

	</p>
	<p>
		<?php $_smarty_tpl_vars = $smarty->_tpl_vars;
$smarty->_smarty_include(array('smarty_include_tpl_file' => "custom:order/addressFieldValues.tpl", 'smarty_include_vars' => array('showLabels' => false)));
$smarty->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</p>
<?php endif; ?>
<?php  $smarty->_tpl_vars = $_fun_tpl_vars; }} smarty_fun_address($this, array());  ?>

<div id="content" class="left right">

	<div id="invoice">

		<div id="invoiceHeader">

			<?php $this->assign('logo', ((is_array($_tmp='LOGO')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))); ?>
			<?php echo smarty_function_img(array('src' => ((is_array($_tmp=((is_array($_tmp='INVOICE_LOGO')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['logo']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['logo'])),'id' => 'invoiceLogo','alt' => 'Invoice Logo'), $this);?>


			<h1><?php echo smarty_function_translate(array('text' => '_invoice'), $this);?>
 <?php echo $this->_tpl_vars['order']['invoiceNumber']; ?>
</h1>
			<div id="invoiceDate"><?php echo $this->_tpl_vars['order']['formatted_dateCompleted']['date_long']; ?>
</div>

		</div>

		<div id="invoiceContacts">

			<div class="addressContainer">
				<h2><?php echo smarty_function_translate(array('text' => '_buyer'), $this);?>
</h2>
				<?php smarty_fun_address($this, array('address'=>$this->_tpl_vars['order']['BillingAddress']));  ?>
				<?php $_from = $this->_tpl_vars['order']['User']['attributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attr']):
?>
					<?php if ($this->_tpl_vars['attr']['EavField']['isDisplayedInList'] && ( $this->_tpl_vars['attr']['value'] || $this->_tpl_vars['attr']['values'] )): ?>
						<p>
							<?php echo $this->_tpl_vars['attr']['EavField']['name_lang']; ?>
:
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/attributeValue.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						</p>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			</div>

			<div class="addressContainer">
				<h2><?php echo smarty_function_translate(array('text' => '_seller'), $this);?>
</h2>
				<p>
					<?php echo ((is_array($_tmp='INVOICE_SELLER_INFO')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>

				</p>
			</div>

		</div>
		<div class="clear"></div>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/orderFieldValues.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div class="clear"></div>

		<?php $_from = $this->_tpl_vars['order']['shipments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['shipments'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['shipments']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['shipment']):
        $this->_foreach['shipments']['iteration']++;
?>

			<?php if ($this->_tpl_vars['shipment']['items']): ?>

				<?php if (! $this->_tpl_vars['shipment']['isShippable']): ?>
					<h2><?php echo smarty_function_translate(array('text' => '_downloads'), $this);?>
</h2>
				<?php else: ?>
					<h2><?php echo smarty_function_translate(array('text' => '_shipment'), $this);?>
 #<?php echo $this->_foreach['shipments']['iteration']; ?>
</h2>
				<?php endif; ?>

				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/shipmentEntry.tpl", 'smarty_include_vars' => array('sku' => true,'showTaxes' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<?php endif; ?>

		<?php endforeach; endif; unset($_from); ?>

		<?php if (((is_array($_tmp='INVOICE_SHOW_PAYMENT_INFO')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<h2><?php echo smarty_function_translate(array('text' => '_payment_info'), $this);?>
</h2>

		<table id="invoicePaymentInfo">
			<tr class="itemSubtotal">
				<td><?php echo smarty_function_translate(array('text' => '_item_subtotal'), $this);?>
:</td>
				<td class="amount"><?php echo $this->_tpl_vars['order']['formatted_itemSubtotalWithoutTax']; ?>
</td>
			</tr>
			<tr class="shippingSubtotal">
				<td><?php echo smarty_function_translate(array('text' => '_shipping_handling'), $this);?>
:</td>
				<td class="amount"><?php echo $this->_tpl_vars['order']['formatted_shippingSubtotal']; ?>
</td>
			</tr>
			<?php if ($this->_tpl_vars['order']['taxes']): ?>
				<tr class="beforeTaxSubtotal">
					<td><?php echo smarty_function_translate(array('text' => '_before_tax'), $this);?>
:</td>
					<td class="amount"><?php echo $this->_tpl_vars['order']['formatted_subtotalBeforeTaxes']; ?>
</td>
				</tr>
				<?php $_from = $this->_tpl_vars['order']['taxes'][$this->_tpl_vars['order']['Currency']['ID']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax']):
?>
					<tr class="taxSubtotal">
						<td><?php echo $this->_tpl_vars['tax']['name_lang']; ?>
:</td>
						<td class="amount"><?php echo $this->_tpl_vars['tax']['formattedAmount']; ?>
</td>
					</tr>
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['order']['discountAmount']): ?>
				<tr class="discountAmount">
					<td><?php echo smarty_function_translate(array('text' => '_discount'), $this);?>
:</td>
					<td class="amount"><?php echo $this->_tpl_vars['order']['formatted_discountAmount']; ?>
</td>
				</tr>
			<?php endif; ?>

			<tr class="grandTotal">
				<td><?php echo smarty_function_translate(array('text' => '_grand_total'), $this);?>
:</td>
				<td class="amount"><?php echo $this->_tpl_vars['order']['formatted_totalAmount']; ?>
</td>
			</tr>
			<tr class="amountPaid">
				<td><?php echo smarty_function_translate(array('text' => '_amount_paid'), $this);?>
:</td>
				<td class="amount"><?php echo $this->_tpl_vars['order']['formatted_amountPaid']; ?>
</td>
			</tr>
			<tr class="amountDue">
				<td><?php echo smarty_function_translate(array('text' => '_amount_due'), $this);?>
:</td>
				<td class="amount"><?php echo $this->_tpl_vars['order']['formatted_amountDue']; ?>
</td>
			</tr>
		</table>
		<?php endif; ?>

	</div>

</div>


</div>

<script type="text/javascript">
</script>