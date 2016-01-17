<?php /* Smarty version 2.6.26, created on 2015-12-11 14:39:31
         compiled from custom:backend/shipment/shipmentTotal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'custom:backend/shipment/shipmentTotal.tpl', 3, false),array('modifier', 'string_format', 'custom:backend/shipment/shipmentTotal.tpl', 19, false),array('function', 'zebra', 'custom:backend/shipment/shipmentTotal.tpl', 9, false),array('function', 'translate', 'custom:backend/shipment/shipmentTotal.tpl', 12, false),array('block', 'denied', 'custom:backend/shipment/shipmentTotal.tpl', 31, false),)), $this); ?>
<form>

<input type="hidden" name="ID" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['shipment']['ID'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['shipmentID']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['shipmentID'])); ?>
" />
<input type="hidden" name="orderID" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['shipment']['Order']['ID'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['orderID']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['orderID'])); ?>
" />
<input type="hidden" name="shippingServiceID" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['shipment']['ShippingService']['ID'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['shippingServiceID']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['shippingServiceID'])); ?>
" />
<input type="hidden" name="downloadable" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['downloadable'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
" />

<table class="orderShipmentsItem_info orderShipment_info">
	<tr class="orderShipment_info_first_row orderShipment_info_subtotal_row <?php echo smarty_function_zebra(array(), $this);?>
">
		<td class="orderShipmentsItem_info_report_td">
			<div class="orderShipmentsItem_info_report">
				<?php echo smarty_function_translate(array('text' => '_subtotal_price'), $this);?>
:
			</div>
		</td>
		<td class="orderShipmentsItem_info_total_td">
			<div class="orderShipmentsItem_info_total">
				<span class="orderShipment_info_subtotal shipment_amount">
					<span class="pricePrefix"><?php echo $this->_tpl_vars['shipment']['AmountCurrency']['pricePrefix']; ?>
</span>
					<span class="price"><?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['shipment']['amount'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)))) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</span>
					<span class="priceSuffix"><?php echo $this->_tpl_vars['shipment']['AmountCurrency']['priceSuffix']; ?>
</span>
				</span>
			</div>
		</td>
	</tr>

	<tr class="orderShipment_info_shipping_row <?php echo smarty_function_zebra(array(), $this);?>
">
		<td class="orderShipmentsItem_info_report_td">
			<div class="orderShipmentsItem_info_report">
				<span class="progressIndicator" style="display: none;"></span>
				<?php echo smarty_function_translate(array('text' => '_shipping'), $this);?>
:
				<a href="#change" class="orderShipment_change_usps" id="orderShipment_change_usps_<?php echo $this->_tpl_vars['shipment']['ID']; ?>
"  style="<?php if ($this->_tpl_vars['shipment']['status'] == 3): ?>display: none;<?php endif; ?> <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>display: none<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php echo ((is_array($_tmp=@$this->_tpl_vars['shipment']['ShippingService']['name_lang'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['shippingServiceIsNotSelected']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['shippingServiceIsNotSelected'])); ?>
</a>
				<?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><b><?php echo ((is_array($_tmp=@$this->_tpl_vars['shipment']['ShippingService']['name_lang'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['shippingServiceIsNotSelected']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['shippingServiceIsNotSelected'])); ?>
</b><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<span class="controls" id="orderShipment_USPS_<?php echo $this->_tpl_vars['shipment']['ID']; ?>
" style="display: none">
					<select name="USPS" id="orderShipment_USPS_<?php echo $this->_tpl_vars['shipment']['ID']; ?>
_select" class="orderShipment_USPS_select">
						<?php if (((is_array($_tmp=@$this->_tpl_vars['shipment']['ShippingService']['ID'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['shippingServiceID']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['shippingServiceID']))): ?>
						<option value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['shipment']['ShippingService']['ID'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['shippingServiceID']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['shippingServiceID'])); ?>
" selected="selected"><?php echo ((is_array($_tmp=@$this->_tpl_vars['shipment']['ShippingService']['name_lang'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['shippingServiceIsNotSelected']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['shippingServiceIsNotSelected'])); ?>
</option>
						<?php endif; ?>
					</select>

					<span class="progressIndicator" style="display: none;"></span>
					<input type="submit" value="<?php echo smarty_function_translate(array('text' => '_save'), $this);?>
" class="button submit"  id="orderShipment_USPS_<?php echo $this->_tpl_vars['shipment']['ID']; ?>
_submit" />
					or
					<a class="cancel" href="#cancel"  id="orderShipment_USPS_<?php echo $this->_tpl_vars['shipment']['ID']; ?>
_cancel" >Cancel</a>
				</span>
			</div>
		</td>
		<td class="orderShipmentsItem_info_total_td">
			<div class="orderShipmentsItem_info_total">
				<span class="orderShipment_info_shippingAmount shipment_shippingAmount">
					<span class="pricePrefix"><?php echo $this->_tpl_vars['shipment']['AmountCurrency']['pricePrefix']; ?>
</span>
					<span class="price">
						<input type="text" class="text number shippingAmount" name="shippingAmount[<?php echo $this->_tpl_vars['shipment']['ID']; ?>
]" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['shipment']['shippingAmount'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)))) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
" />
					</span>
					<span class="priceSuffix"><?php echo $this->_tpl_vars['shipment']['AmountCurrency']['priceSuffix']; ?>
</span>
				</span>
			</div>
		</td>
	</tr>

	<tr class="orderShipment_info_tax_row <?php echo smarty_function_zebra(array(), $this);?>
">
		<td class="orderShipmentsItem_info_report_td">
			<div class="orderShipmentsItem_info_report">
				<?php echo smarty_function_translate(array('text' => '_taxes'), $this);?>
:
			</div>
		</td>
		<td class="orderShipmentsItem_info_tax_td">
			<div class="orderShipmentsItem_info_tax">
				<span class="orderShipment_info_subtotal shipment_taxAmount">
					<span class="pricePrefix"><?php echo $this->_tpl_vars['shipment']['AmountCurrency']['pricePrefix']; ?>
</span>
					<span class="price"><?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['shipment']['taxAmount'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)))) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</span>
					<span class="priceSuffix"><?php echo $this->_tpl_vars['shipment']['AmountCurrency']['priceSuffix']; ?>
</span>
				</span>
			</div>
		</td>
	</tr>

	<tr class="orderShipment_info_total_row <?php echo smarty_function_zebra(array(), $this);?>
">
		<td class="orderShipmentsItem_info_report_td">
			<div class="orderShipmentsItem_info_report">
				<?php echo smarty_function_translate(array('text' => '_price'), $this);?>
:
			</div>
		</td>
		<td class="orderShipmentsItem_info_total_td">
			<div class="orderShipmentsItem_info_total orderShipment_totalSum">
				<span class="orderShipment_info_total shipment_total">
					<span class="pricePrefix"><?php echo $this->_tpl_vars['shipment']['AmountCurrency']['pricePrefix']; ?>
</span>
					<span class="price"><?php $this->assign('price', $this->_tpl_vars['shipment']['totalAmount']); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['price'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</span>
					<span class="priceSuffix"><?php echo $this->_tpl_vars['shipment']['AmountCurrency']['priceSuffix']; ?>
</span>
				</span>
			</div>
		</td>
	</tr>
</table>

</form>