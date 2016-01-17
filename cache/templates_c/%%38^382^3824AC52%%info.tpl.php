<?php /* Smarty version 2.6.26, created on 2015-12-11 14:39:31
         compiled from /home/illumin/public_html/application/view///backend/customerOrder/info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 3, false),array('block', 'denied', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 18, false),array('function', 'hidden', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 4, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 6, false),array('function', 'selectfield', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 7, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 20, false),array('function', 'zebra', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 77, false),array('function', 'backendUserUrl', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 86, false),array('function', 'uniqid', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 99, false),array('function', 'calendar', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 113, false),array('function', 'json', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 322, false),array('modifier', 'default', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 79, false),array('modifier', 'string_format', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 96, false),array('modifier', 'count', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 248, false),array('modifier', 'addslashes', '/home/illumin/public_html/application/view///backend/customerOrder/info.tpl', 325, false),)), $this); ?>
<ul class="menu">
	<li>
		<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['form'],'class' => 'orderStatus','action' => "controller=backend.customerOrder action=update",'id' => "orderInfo_".($this->_tpl_vars['order']['ID'])."_form",'onsubmit' => "Backend.CustomerOrder.Editor.prototype.getInstance(".($this->_tpl_vars['order']['ID']).", false).submitForm(); return false;",'method' => 'post','role' => "order.update")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php echo smarty_function_hidden(array('name' => 'ID'), $this);?>

			<?php echo smarty_function_hidden(array('name' => 'isCancelled'), $this);?>

				<label for="order_<?php echo $this->_tpl_vars['order']['ID']; ?>
_status" style="width: auto; float: none;"><?php echo smarty_function_translate(array('text' => '_status'), $this);?>
: </label>
				<?php echo smarty_function_selectfield(array('options' => $this->_tpl_vars['statuses'],'id' => "order_".($this->_tpl_vars['order']['ID'])."_status",'name' => 'status','class' => 'status'), $this);?>

				<div class="errorText hidden"></div>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<div class="order_acceptanceStatus" >
			<?php echo smarty_function_translate(array('text' => '_this_order_is'), $this);?>

			<span class="order_acceptanceStatusValue" id="order_acceptanceStatusValue_<?php echo $this->_tpl_vars['order']['ID']; ?>
" style="color: <?php if ($this->_tpl_vars['order']['isCancelled']): ?>red<?php else: ?>green<?php endif; ?>">
				<?php if ($this->_tpl_vars['order']['isCancelled']): ?><?php echo smarty_function_translate(array('text' => '_canceled'), $this);?>
<?php else: ?><?php echo smarty_function_translate(array('text' => '_accepted'), $this);?>
<?php endif; ?>
			</span>
		</div>
	</li>
	<?php if (! $this->_tpl_vars['order']['isFinalized']): ?>
	<li <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> class="order_unfinalized">
		<span style="display: none;" id="order_<?php echo $this->_tpl_vars['order']['ID']; ?>
_isFinalizedIndicator" class="progressIndicator"></span>
		<a id="order_<?php echo $this->_tpl_vars['order']['ID']; ?>
_isFinalized" href="<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'finalize','id' => $this->_tpl_vars['order']['ID']), $this);?>
">
			<?php echo smarty_function_translate(array('text' => '_finalize'), $this);?>

		</a>
	</li>
	<?php endif; ?>
	<li class="order_printInvoice">
		<a href="<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'printInvoice','id' => $this->_tpl_vars['order']['ID']), $this);?>
" target="_blank"><?php echo smarty_function_translate(array('text' => '_print_invoice'), $this);?>
</a>
	</li>

	<li class="order_printLabel">
		<a href="<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'printLabels','id' => $this->_tpl_vars['order']['ID']), $this);?>
" target="_blank"><?php echo smarty_function_translate(array('text' => '_print_shipping_labels'), $this);?>
</a>
	</li>

	<li <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		class="<?php if ($this->_tpl_vars['order']['isCancelled']): ?>order_accept<?php else: ?>order_cancel<?php endif; ?>">
		<span style="display: none;" id="order_<?php echo $this->_tpl_vars['order']['ID']; ?>
_isCanceledIndicator" class="progressIndicator"></span>
		<a id="order_<?php echo $this->_tpl_vars['order']['ID']; ?>
_isCanceled" href="<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'setIsCanceled','id' => $this->_tpl_vars['order']['ID']), $this);?>
">
			<?php if ($this->_tpl_vars['order']['isCancelled']): ?><?php echo smarty_function_translate(array('text' => '_accept_order'), $this);?>
<?php else: ?><?php echo smarty_function_translate(array('text' => '_cancel_order'), $this);?>
<?php endif; ?>
		</a>
	</li>

	<li <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> class="addCoupon">
		<span style="display: none;" id="order_<?php echo $this->_tpl_vars['order']['ID']; ?>
_addCouponIndicator" class="progressIndicator"></span>
		<a id="order_<?php echo $this->_tpl_vars['order']['ID']; ?>
_addCoupon" href="<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'addCoupon','id' => $this->_tpl_vars['order']['ID']), $this);?>
?coupon=_coupon_"><?php echo smarty_function_translate(array('text' => '_add_coupon'), $this);?>
</a>
	</li>
	
	<?php if ($this->_tpl_vars['order']['isFinalized']): ?>
		<li <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> class="order_recalculateDiscounts">
			<a id="order_<?php echo $this->_tpl_vars['order']['ID']; ?>
_recalculateDiscounts" href="<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'recalculateDiscounts','id' => $this->_tpl_vars['order']['ID']), $this);?>
">
				<?php echo smarty_function_translate(array('text' => '_recalculate_discounts'), $this);?>

			</a>
		</li>
	<?php endif; ?>

</ul>
<div class="clear"></div>


<div class="addressContainer">
	<?php if ($this->_tpl_vars['formShippingAddress'] || ! $this->_tpl_vars['formBillingAddress']): ?>
		<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['formShippingAddress'],'action' => "controller=backend.customerOrder action=updateAddress",'id' => "orderInfo_".($this->_tpl_vars['order']['ID'])."_shippingAddress_form",'onsubmit' => "Backend.CustomerOrder.Address.prototype.getInstance(this, false).submitForm(); return false;",'method' => 'post','role' => "order.update")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<fieldset class="order_shippingAddress">
				<legend><?php echo smarty_function_translate(array('text' => '_shipping_address'), $this);?>
</legend>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "backend/customerOrder/address.tpl", 'smarty_include_vars' => array('type' => "order_".($this->_tpl_vars['order']['ID'])."_shippingAddress",'address' => $this->_tpl_vars['order']['ShippingAddress'],'states' => $this->_tpl_vars['shippingStates'],'order' => $this->_tpl_vars['order'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</fieldset>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['formBillingAddress'] || ! $this->_tpl_vars['formShippingAddress']): ?>
		<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['formBillingAddress'],'action' => "controller=backend.customerOrder action=updateAddress",'id' => "orderInfo_".($this->_tpl_vars['order']['ID'])."_billingAddress_form",'onsubmit' => "Backend.CustomerOrder.Address.prototype.getInstance(this, false).submitForm(); return false;",'method' => 'post','role' => "order.update")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<fieldset class="order_billingAddress">
				<legend><?php echo smarty_function_translate(array('text' => '_billing_address'), $this);?>
</legend>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "backend/customerOrder/address.tpl", 'smarty_include_vars' => array('type' => "order_".($this->_tpl_vars['order']['ID'])."_billingAddress",'address' => $this->_tpl_vars['order']['BillingAddress'],'states' => $this->_tpl_vars['billingStates'],'order' => $this->_tpl_vars['order'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</fieldset>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>
</div>
<fieldset class="order_info">
	<div class="<?php echo smarty_function_zebra(array(), $this);?>
 clearfix invoiceNumber">
		<label class="param"><?php echo smarty_function_translate(array('text' => '_order_id'), $this);?>
</label>
		<label class="value"><?php echo ((is_array($_tmp=@$this->_tpl_vars['order']['invoiceNumber'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['order']['ID']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['order']['ID'])); ?>
</label>
	</div>

	<?php if ($this->_tpl_vars['order']['User']): ?>
	<div class="<?php echo smarty_function_zebra(array(), $this);?>
 clearfix">
		<label class="param"><?php echo smarty_function_translate(array('text' => '_user'), $this);?>
</label>
		<label class="value">
			<a href="<?php echo smarty_function_backendUserUrl(array('user' => $this->_tpl_vars['order']['User']), $this);?>
">
				<?php echo $this->_tpl_vars['order']['User']['fullName']; ?>

			</a>
		</label>
	</div>
	<?php endif; ?>

	<div class="<?php echo smarty_function_zebra(array(), $this);?>
 clearfix orderAmount <?php if (! $this->_tpl_vars['order']['isPaid']): ?>unpaid<?php endif; ?>">
		<label class="param"><?php echo smarty_function_translate(array('text' => '_amount'), $this);?>
</label>
		<label class="value">
			<?php echo $this->_tpl_vars['order']['Currency']['pricePrefix']; ?>
<span class="order_totalAmount"><?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['order']['totalAmount'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)))) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</span><?php echo $this->_tpl_vars['order']['Currency']['priceSuffix']; ?>

		</label>
		<span class="notPaid">
			<input type="checkbox" class="checkbox" id="<?php echo smarty_function_uniqid(array(), $this);?>
" value="1" onchange="Backend.CustomerOrder.prototype.changePaidStatus(this, '<?php echo smarty_function_link(array('controller' => "backend.payment",'action' => 'changeOrderPaidStatus','id' => $this->_tpl_vars['order']['ID'],'query' => 'status=_stat_'), $this);?>
');">
			<label for="<?php echo smarty_function_uniqid(array('last' => true), $this);?>
" class="checkbox"><?php echo smarty_function_translate(array('text' => '_mark_as_paid'), $this);?>
</label>
		</span>
	</div>

	<?php if ($this->_tpl_vars['order']['dateCompleted']): ?>
		<div class="<?php echo smarty_function_zebra(array(), $this);?>
 clearfix">
			<label class="param" for="order_<?php echo $this->_tpl_vars['order']['ID']; ?>
_dateCreated"><?php echo smarty_function_translate(array('text' => '_date_created'), $this);?>
</label>
			<label id="dateCreatedLabel">
				<a class="menu order_editFields orderDate" href="#edit" id="editDateCompleted"></a>
				<span id="dateCreatedVisible"><?php echo $this->_tpl_vars['order']['dateCompleted']; ?>
</span>
			</label>

			<?php $this->_tag_stack[] = array('form', array('id' => 'calendarForm','handle' => $this->_tpl_vars['dateForm'],'class' => 'hidden','action' => "controller=backend.customerOrder action=updateDate",'method' => 'POST')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php echo smarty_function_calendar(array('name' => 'dateCompleted','id' => 'dateCompleted'), $this);?>


				<span class="progressIndicator" id="indicatorDateCompleted" style="display: none;"></span>

				<span class="menu">
					<a href="#save" id="saveDateCompleted"><?php echo smarty_function_translate(array('text' => '_save'), $this);?>
</a>
					<a href="#cancel" id="cancelDateCompleted"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
				</span>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</div>
	<?php endif; ?>

	<div class="<?php echo smarty_function_zebra(array(), $this);?>
 clearfix">
		<label class="param" for="order_<?php echo $this->_tpl_vars['order']['ID']; ?>
)_isMultiAddress"><?php echo smarty_function_translate(array('text' => "CustomerOrder.isMultiAddress"), $this);?>
</label>
		<select style="width: auto; float: left;" onchange="Backend.CustomerOrder.prototype.setMultiAddress(this, '<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'setMultiAddress','id' => $this->_tpl_vars['order']['ID'],'query' => 'status=_stat_'), $this);?>
', <?php echo $this->_tpl_vars['order']['ID']; ?>
);"><option value=0><?php echo smarty_function_translate(array('text' => '_no'), $this);?>
</option><option value=1<?php if ($this->_tpl_vars['order']['isMultiAddress']): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('text' => '_yes'), $this);?>
</option></select>
		<span class="progressIndicator" style="display: none; float: left; padding-top: 0; padding-left: 0;"></span>
	</div>
</fieldset>


<br class="clear" />

<?php if ($this->_tpl_vars['specFieldList']): ?>
<div class="customFields">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/customerOrder/saveFields.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>


<?php $this->assign('shipmentCount', 0); ?>
<?php $_from = $this->_tpl_vars['shipments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipment']):
?>
	<?php if ($this->_tpl_vars['shipment']['status'] != 3 && $this->_tpl_vars['shipment']['isShippable']): ?>
		<?php $this->assign('shipmentCount', $this->_tpl_vars['shipmentCount']+1); ?>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<fieldset class="container" <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
	<ul class="menu" id="orderShipments_menu_<?php echo $this->_tpl_vars['orderID']; ?>
">
		<li class="order_addProduct" id="order<?php echo $this->_tpl_vars['orderID']; ?>
_addProduct_li">
			<span <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
				<a href="#newProduct" id="order<?php echo $this->_tpl_vars['orderID']; ?>
_openProductMiniform"><?php echo smarty_function_translate(array('text' => '_add_new_product'), $this);?>
</a>
			</span>
		</li>
		<li class="order_addShipment" id="order<?php echo $this->_tpl_vars['orderID']; ?>
_addShipment_li">
			<span id="orderShipments_new_<?php echo $this->_tpl_vars['orderID']; ?>
_indicator" class="progressIndicator" style="display: none"> </span>
			<a href="#new" id="orderShipments_new_<?php echo $this->_tpl_vars['orderID']; ?>
_show"><?php echo smarty_function_translate(array('text' => '_add_new_shipment'), $this);?>
</a>
		</li>
		<li class="controls" id="orderShipments_new_<?php echo $this->_tpl_vars['orderID']; ?>
_controls" style="display:none; padding: 0; margin: 0;">
			<fieldset class="controls">
				<?php echo smarty_function_translate(array('text' => '_do_you_want_to_create_new_shipment'), $this);?>

				<input type="submit" value="<?php echo smarty_function_translate(array('text' => '_yes'), $this);?>
" class="submit" id="orderShipments_new_<?php echo $this->_tpl_vars['orderID']; ?>
_submit">
				<?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 <a href="#new" id="orderShipments_new_<?php echo $this->_tpl_vars['orderID']; ?>
_cancel"><?php echo smarty_function_translate(array('text' => '_no'), $this);?>
</a>
			</fieldset>
		</li>
	</ul>
</fieldset>

<fieldset class="addProductsContainer" style="display:none;" id="order<?php echo $this->_tpl_vars['orderID']; ?>
_productMiniform">
	<legend><?php echo smarty_function_translate(array('text' => '_add_new_product'), $this);?>
 <a class="cancel" href="#" id="order<?php echo $this->_tpl_vars['orderID']; ?>
_cancelProductMiniform"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a></legend>
	<ul class="menu" id="orderShipments_menu_<?php echo $this->_tpl_vars['orderID']; ?>
">
		<li class="addProductAdvanced">
			<span <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
				<a href="#newProduct" id="order<?php echo $this->_tpl_vars['orderID']; ?>
_addProduct" class="cancel"><?php echo smarty_function_translate(array('text' => '_advanced_product_search'), $this);?>
</a>
			</span>
		</li>
	</ul>

	<label for="ProductSearchQuery"><?php echo smarty_function_translate(array('text' => '_search_product'), $this);?>
:</label>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "backend/quickSearch/form.tpl", 'smarty_include_vars' => array('formid' => 'ProductSearch','classNames' => 'Product','resultTemplates' => "Product:ProductAddToShippment")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div class="controls" id="miniformControls<?php echo $this->_tpl_vars['orderID']; ?>
" style="display:none;">
		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" name="save" class="submit" value="<?php echo smarty_function_translate(array('text' => '_add_to_order'), $this);?>
" id="order<?php echo $this->_tpl_vars['orderID']; ?>
_addSearchResultToOrder" />
		<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

		<a class="cancel" href="#cancel" id="order<?php echo $this->_tpl_vars['orderID']; ?>
_cancelProductMiniform2"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
	</div>
	<div class="clear" />
	<div class="tip"><?php echo smarty_function_translate(array('text' => '_search_product_tip1'), $this);?>
<br /><?php echo smarty_function_translate(array('text' => '_search_product_tip2'), $this);?>
</div>

	<div class="<?php if ($this->_tpl_vars['shipmentCount'] <= 1): ?>singleShipment<?php endif; ?>">
		<label><?php echo smarty_function_translate(array('text' => '_add_to_shipment'), $this);?>
:</label>
		<select id="order<?php echo $this->_tpl_vars['orderID']; ?>
_addToShipment" class="addToShipment">
			<?php $_from = $this->_tpl_vars['shipments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipment']):
?>
				<?php if ($this->_tpl_vars['shipment']['status'] != 3 && $this->_tpl_vars['shipment']['isShippable']): ?>
					<option value="<?php echo $this->_tpl_vars['shipment']['ID']; ?>
"><?php echo smarty_function_translate(array('text' => '_shipment'), $this);?>
 #<?php echo $this->_tpl_vars['shipment']['ID']; ?>
</option>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</div>

	<div class="hidden" id="order<?php echo $this->_tpl_vars['orderID']; ?>
_cannotAddEmptyResult"><?php echo smarty_function_translate(array('text' => '_cannot_add_empty_result'), $this);?>
</div>
	<div class="hidden" id="order<?php echo $this->_tpl_vars['orderID']; ?>
_addAllFoundProducts"><?php echo smarty_function_translate(array('text' => '_add_all_found_products'), $this);?>
</div>
</fieldset>

<fieldset id="orderShipments_new_<?php echo $this->_tpl_vars['orderID']; ?>
_form" style="display: none;"> </fieldset>
<div id="orderShipment_<?php echo $this->_tpl_vars['orderID']; ?>
_controls_empty" style="display: none"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/shipment/shipmentControls.tpl", 'smarty_include_vars' => array('shipment' => null)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<div id="orderShipment_<?php echo $this->_tpl_vars['orderID']; ?>
_total_empty" style="display: none"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/shipment/shipmentTotal.tpl", 'smarty_include_vars' => array('shipment' => null)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<div id="orderShipmentItem_<?php echo $this->_tpl_vars['orderID']; ?>
_empty" style="display: none"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/shipment/itemAmount.tpl", 'smarty_include_vars' => array('shipment' => null)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>


<?php if ($this->_tpl_vars['order']['discounts'] || $this->_tpl_vars['order']['coupons']): ?>
	<fieldset class="discounts">
		<legend><?php echo smarty_function_translate(array('text' => '_discounts'), $this);?>
</legend>

		<?php if ($this->_tpl_vars['order']['coupons']): ?>
			<div class="appliedCoupons">
				<?php echo smarty_function_translate(array('text' => '_coupons'), $this);?>
:
				<?php $_from = $this->_tpl_vars['order']['coupons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['coupons'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['coupons']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['coupon']):
        $this->_foreach['coupons']['iteration']++;
?>
					<strong><?php echo $this->_tpl_vars['coupon']['couponCode']; ?>
</strong><?php if (! ($this->_foreach['coupons']['iteration'] == $this->_foreach['coupons']['total'])): ?>, <?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			</div>
		<?php endif; ?>

		<table class="discounts">
			<?php $_from = $this->_tpl_vars['order']['discounts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['discounts'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['discounts']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['discount']):
        $this->_foreach['discounts']['iteration']++;
?>
				<tr class="<?php echo smarty_function_zebra(array('loop' => 'discounts'), $this);?>
">
					<td><?php echo $this->_tpl_vars['discount']['description']; ?>
</td>
					<td class="amount"><?php echo $this->_tpl_vars['discount']['formatted_amount']; ?>
</td>
				</tr>
			<?php endforeach; endif; unset($_from); ?>
		</table>
	</fieldset>
<?php endif; ?>

<div id="order<?php echo $this->_tpl_vars['orderID']; ?>
_downloadableShipments" class="downloadableShipments shipmentCategoty" style="display: none;">
	<h2 class="notShippedShipmentsTitle"><?php echo smarty_function_translate(array('text' => '_downloadable'), $this);?>
</h2>
	<div id="orderShipments_list_<?php echo $this->_tpl_vars['orderID']; ?>
_downloadable" class="downloadableShipment"  <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
		<ul id="orderShipmentsItems_list_<?php echo $this->_tpl_vars['orderID']; ?>
_downloadable" class="activeList_add_delete orderShipmentsItem activeList">
			<li id="orderShipments_list_<?php echo $this->_tpl_vars['orderID']; ?>
_<?php echo $this->_tpl_vars['downloadableShipment']['ID']; ?>
" class="orderShipment" >
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/shipment/shipment.tpl", 'smarty_include_vars' => array('shipment' => $this->_tpl_vars['downloadableShipment'],'notShippable' => true,'downloadable' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<?php if (count($this->_tpl_vars['downloadableShipment']['items']) > 0): ?>
					<script type="text/javascript">
						Element.show("order<?php echo $this->_tpl_vars['orderID']; ?>
_downloadableShipments");
					</script>
				<?php endif; ?>
			</li>
		</ul>
	</div>
</div>


<div id="order<?php echo $this->_tpl_vars['orderID']; ?>
_shippableShipments" class="shippableShipments shipmentCategoty" style="display: none">
	<h2 class="notShippedShipmentsTitle"><?php echo smarty_function_translate(array('text' => '_not_shipped'), $this);?>
</h2>
	<ul id="orderShipments_list_<?php echo $this->_tpl_vars['orderID']; ?>
" class="orderShipments <?php if ($this->_tpl_vars['shipmentCount'] <= 1): ?>singleShipment<?php endif; ?>">
		<?php $_from = $this->_tpl_vars['shipments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipment']):
?>
			<?php if ($this->_tpl_vars['shipment']['status'] != 3 && $this->_tpl_vars['shipment']['isShippable']): ?>
				<li id="orderShipments_list_<?php echo $this->_tpl_vars['orderID']; ?>
_<?php echo $this->_tpl_vars['shipment']['ID']; ?>
" class="orderShipment downloadableOrder">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/shipment/shipment.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<script type="text/javascript">
						Element.show("order<?php echo $this->_tpl_vars['orderID']; ?>
_shippableShipments");
					</script>
				</li>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>


<div id="order<?php echo $this->_tpl_vars['orderID']; ?>
_shippedShipments" class="shippedShipments shipmentCategoty" style="display: none">
	<h2 class="shippedShipmentsTitle"><?php echo smarty_function_translate(array('text' => '_shipped'), $this);?>
</h2>
	<?php $this->assign('shipmentCount', 0); ?>
	<?php $_from = $this->_tpl_vars['shipments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipment']):
?>
		<?php if ($this->_tpl_vars['shipment']['status'] == 3 && $this->_tpl_vars['shipment']['isShippable']): ?>
			<?php $this->assign('shipmentCount', $this->_tpl_vars['shipmentCount']+1); ?>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<ul id="orderShipments_list_<?php echo $this->_tpl_vars['orderID']; ?>
_shipped" class="orderShippedShipments <?php if ($this->_tpl_vars['shipmentCount'] <= 1): ?>singleShipment<?php endif; ?>">
		<?php $_from = $this->_tpl_vars['shipments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipment']):
?>
			<?php if ($this->_tpl_vars['shipment']['status'] == 3 && $this->_tpl_vars['shipment']['isShippable']): ?>
				<li id="orderShipments_list_<?php echo $this->_tpl_vars['orderID']; ?>
_shipped_<?php echo $this->_tpl_vars['shipment']['ID']; ?>
" class="orderShipment">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/shipment/shipment.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<script type="text/javascript">Element.show("order<?php echo $this->_tpl_vars['orderID']; ?>
_shippedShipments");</script>
				</li>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>

<div class="hidden" style="display:none;" id="order<?php echo $this->_tpl_vars['orderID']; ?>
_tmpContainer"></div>


<?php echo '
<script type="text/javascript">
	Backend.OrderedItem.Links = {};
	Backend.OrderedItem.Links.remove = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.orderedItem",'action' => 'delete'), $this);?>
<?php echo '\';
	Backend.OrderedItem.Links.changeShipment = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.orderedItem",'action' => 'changeShipment'), $this);?>
<?php echo '\';
	Backend.OrderedItem.Links.addProduct = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.orderedItem",'action' => 'selectProduct'), $this);?>
/<?php echo $this->_tpl_vars['orderID']; ?>
<?php echo '\';
	Backend.OrderedItem.Links.createNewItem = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.orderedItem",'action' => 'create'), $this);?>
<?php echo '\';
	// Backend.OrderedItem.Links.createFromSearchQuery = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.orderedItem",'action' => 'createFromSearchQuery'), $this);?>
<?php echo '\';
	Backend.OrderedItem.Links.changeItemCount = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.orderedItem",'action' => 'changeCount'), $this);?>
<?php echo '\';

	Backend.Shipment.Links = {};
	Backend.Shipment.Links.update = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.shipment",'action' => 'update'), $this);?>
<?php echo '\';
	Backend.Shipment.Links.create = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.shipment",'action' => 'create'), $this);?>
<?php echo '\';
	Backend.Shipment.Links.remove = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.shipment",'action' => 'delete'), $this);?>
<?php echo '\';
	Backend.Shipment.Links.edit = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.shipment",'action' => 'edit'), $this);?>
<?php echo '\';
	Backend.Shipment.Links.getAvailableServices = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.shipment",'action' => 'getAvailableServices'), $this);?>
<?php echo '\';
	Backend.Shipment.Links.changeService = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.shipment",'action' => 'changeService'), $this);?>
<?php echo '\';
	Backend.Shipment.Links.changeStatus = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.shipment",'action' => 'changeStatus'), $this);?>
<?php echo '\';
	Backend.Shipment.Links.removeEmptyShipments = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'removeEmptyShipments'), $this);?>
<?php echo '\';


	Backend.Shipment.Statuses = '; ?>
<?php echo smarty_function_json(array('array' => $this->_tpl_vars['statuses']), $this);?>
<?php echo ';

	Backend.Shipment.Messages = {};
	Backend.Shipment.Messages.areYouSureYouWantToDelete = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_to_delete_group'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_sure_you_want_to_delete_group', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_sure_you_want_to_delete_group'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\';
	Backend.Shipment.Messages.shippingServiceIsNotSelected = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_shipping_service_is_not_selected'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__shipping_service_is_not_selected', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__shipping_service_is_not_selected'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\';
	Backend.Shipment.Messages.areYouSureYouWantToChangeShimentStatusToAwaiting = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_to_change_shipment_status_to_awaiting'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_sure_you_want_to_change_shipment_status_to_awaiting', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_sure_you_want_to_change_shipment_status_to_awaiting'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\';
	Backend.Shipment.Messages.areYouSureYouWantToChangeShimentStatusToPending = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_to_change_shipment_status_to_pending'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_sure_you_want_to_change_shipment_status_to_pending', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_sure_you_want_to_change_shipment_status_to_pending'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\';
	Backend.Shipment.Messages.areYouSureYouWantToChangeShimentStatusToNew = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_to_change_shipment_status_to_new'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_sure_you_want_to_change_shipment_status_to_new', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_sure_you_want_to_change_shipment_status_to_new'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\';
	Backend.Shipment.Messages.areYouSureYouWantToChangeShimentStatusToShipped = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_to_change_shipment_status_to_shipped'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_sure_you_want_to_change_shipment_status_to_shipped', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_sure_you_want_to_change_shipment_status_to_shipped'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\';
	Backend.Shipment.Messages.areYouSureYouWantToChangeShimentStatusToReturned = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_to_change_shipment_status_to_returned'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_sure_you_want_to_change_shipment_status_to_returned', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_sure_you_want_to_change_shipment_status_to_returned'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\';
	Backend.Shipment.Messages.youWontBeAableToRevertStatusFromShipped = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_you_wont_be_able_to_revert_status_from_shipped'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__you_wont_be_able_to_revert_status_from_shipped', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__you_wont_be_able_to_revert_status_from_shipped'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\';
	Backend.Shipment.Messages.youWontBeAbleToUndelete = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_you_wont_be_able_to_undelete_this_shipment'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__you_wont_be_able_to_undelete_this_shipment', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__you_wont_be_able_to_undelete_this_shipment'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\';
	Backend.Shipment.Messages.areYouSureYouWantToDeleteThisShipment = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_to_delete_this_shipment'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_sure_you_want_to_delete_this_shipment', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_sure_you_want_to_delete_this_shipment'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\';
	Backend.Shipment.Messages.emptyShipmentsWillBeRemoved = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_you_have_count_empty_shipments_do_you_want_to_proceed_to_the_next_page'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__you_have_count_empty_shipments_do_you_want_to_proceed_to_the_next_page', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__you_have_count_empty_shipments_do_you_want_to_proceed_to_the_next_page'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\'
	Backend.Shipment.Messages.shipment = \''; ?>
<?php echo smarty_function_translate(array('text' => '_shipment'), $this);?>
<?php echo '\';
	Backend.Shipment.Messages.addCouponCode = \''; ?>
<?php echo smarty_function_translate(array('text' => '_add_coupon_code'), $this);?>
<?php echo '\';

	Backend.OrderedItem.Messages = {};
	Backend.OrderedItem.Messages.areYouSureYouWantToDelete = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_to_delete_this_item'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_sure_you_want_to_delete_this_item', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_sure_you_want_to_delete_this_item'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\';
	Backend.OrderedItem.Messages.selectProductTitle = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_select_product'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__select_product', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__select_product'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\';
	Backend.OrderedItem.Messages.areYouRealyWantToUpdateItemsCount = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_realy_want_to_update_items_count'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_realy_want_to_update_items_count', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_realy_want_to_update_items_count'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\';

	Backend.Shipment.prototype.initializePage("'; ?>
<?php echo $this->_tpl_vars['orderID']; ?>
<?php echo '", "'; ?>
<?php echo $this->_tpl_vars['downloadableShipment']['ID']; ?>
<?php echo '")
	ActiveList.prototype.getInstance("'; ?>
orderShipmentsItems_list_<?php echo $this->_tpl_vars['orderID']; ?>
_<?php echo $this->_tpl_vars['downloadableShipment']['ID']; ?>
<?php echo '", Backend.OrderedItem.activeListCallbacks);
	var groupList = ActiveList.prototype.getInstance(\''; ?>
orderShipments_list_<?php echo $this->_tpl_vars['orderID']; ?>
<?php echo '\', Backend.Shipment.Callbacks);

	'; ?>
<?php $_from = $this->_tpl_vars['shipments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipment']):
?><?php echo '
		'; ?>
<?php if ($this->_tpl_vars['shipment']['isShippable']): ?><?php echo '
			var shipment = Backend.Shipment.prototype.getInstance(\''; ?>
orderShipments_list_<?php echo $this->_tpl_vars['orderID']; ?>
<?php if ($this->_tpl_vars['shipment']['isShipped']): ?>_shipped<?php endif; ?>_<?php echo $this->_tpl_vars['shipment']['ID']; ?>
<?php echo '\', {isShipped: '; ?>
<?php if ($this->_tpl_vars['shipment']['isShipped']): ?>true<?php else: ?>false<?php endif; ?><?php echo '});
		'; ?>
<?php else: ?><?php echo '
			var shipment = Backend.Shipment.prototype.getInstance(\''; ?>
orderShipments_list_<?php echo $this->_tpl_vars['orderID']; ?>
_<?php echo $this->_tpl_vars['shipment']['ID']; ?>
<?php echo '\');
		'; ?>
<?php endif; ?><?php echo '
	'; ?>
<?php endforeach; endif; unset($_from); ?><?php echo '

	groupList.createSortable(true);
	</script>
'; ?>


<script type="text/javascript">
	Backend.CustomerOrder.prototype.treeBrowser.selectItem(<?php echo ((is_array($_tmp=@$this->_tpl_vars['type'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
, false);

	Backend.CustomerOrder.Editor.prototype.existingUserAddresses = <?php echo smarty_function_json(array('array' => $this->_tpl_vars['existingUserAddresses']), $this);?>

	<?php echo '
	var status = Backend.CustomerOrder.Editor.prototype.getInstance('; ?>
<?php echo $this->_tpl_vars['order']['ID']; ?>
, true, <?php echo smarty_function_json(array('array' => $this->_tpl_vars['hideShipped']), $this);?>
, <?php echo $this->_tpl_vars['order']['isCancelled']; ?>
, <?php echo $this->_tpl_vars['order']['isFinalized']; ?>
, <?php echo smarty_function_json(array('array' => $this->_tpl_vars['order']['invoiceNumber']), $this);?>
<?php echo ');

	'; ?>
<?php if ($this->_tpl_vars['formShippingAddress']): ?><?php echo '
		var shippingAddress = Backend.CustomerOrder.Address.prototype.getInstance($(\''; ?>
orderInfo_<?php echo $this->_tpl_vars['order']['ID']; ?>
_shippingAddress_form<?php echo '\'), \'shippingAddress\');
	'; ?>
<?php endif; ?><?php echo '

	'; ?>
<?php if ($this->_tpl_vars['formBillingAddress']): ?><?php echo '
		var billingAddress = Backend.CustomerOrder.Address.prototype.getInstance($(\''; ?>
orderInfo_<?php echo $this->_tpl_vars['order']['ID']; ?>
_billingAddress_form<?php echo '\'), \'billingAddress\');
	'; ?>
<?php endif; ?>

	<?php if ($this->_tpl_vars['order']['dateCompleted']): ?>
		var dateComplededEditor = new Backend.CustomerOrder.DateCompletedEditor();
	<?php endif; ?>

</script>