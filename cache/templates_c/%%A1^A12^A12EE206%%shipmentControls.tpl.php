<?php /* Smarty version 2.6.26, created on 2015-12-11 14:39:31
         compiled from custom:backend/shipment/shipmentControls.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/shipment/shipmentControls.tpl', 3, false),array('function', 'img', 'custom:backend/shipment/shipmentControls.tpl', 9, false),array('function', 'renderBlock', 'custom:backend/shipment/shipmentControls.tpl', 27, false),array('block', 'denied', 'custom:backend/shipment/shipmentControls.tpl', 4, false),)), $this); ?>
<fieldset class="orderShipment_controls <?php if ($this->_tpl_vars['order']['isMultiAddress']): ?>multiAddress<?php endif; ?> error" <?php if ($this->_tpl_vars['notShippable']): ?>style="display: none;"<?php endif; ?>>
   <fieldset class="orderShipment_status error">
	   <label><?php echo smarty_function_translate(array('text' => '_status'), $this);?>
: </label>
	   <select name="status" id="orderShipment_status_<?php echo $this->_tpl_vars['shipment']['ID']; ?>
" <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>disabled="disabled"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
		   <?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['statusID'] => $this->_tpl_vars['status']):
?>
			   <option value="<?php echo $this->_tpl_vars['statusID']; ?>
" id="orderShipment_status_<?php echo $this->_tpl_vars['shipment']['ID']; ?>
_<?php echo $this->_tpl_vars['statusID']; ?>
" <?php if ($this->_tpl_vars['shipment']['status'] == $this->_tpl_vars['statusID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['status']; ?>
</option>
		   <?php endforeach; endif; unset($_from); ?>
	   </select>
	   <?php echo smarty_function_img(array('style' => "display: none",'id' => "orderShipment_status_".($this->_tpl_vars['shipment']['ID'])."_feedback",'src' => "image/indicator.gif"), $this);?>

   </fieldset>

   <?php if ($this->_tpl_vars['order']['isMultiAddress']): ?>
		<fieldset class="shipmentAddress">
			<legend><?php echo smarty_function_translate(array('text' => '_shipping_address'), $this);?>
</legend>
			<div class="menu">
				<a href="#" onclick="Backend.Shipment.prototype.getInstance(Event.element(event).up('.orderShipment')).editShippingAddress(); return false;"><?php echo smarty_function_translate(array('text' => '_edit_address'), $this);?>
</a>
				<span class="progressIndicator" style="display: none;"></span>
			</div>
			<div class="viewAddress">
				<?php echo $this->_tpl_vars['shipment']['ShippingAddress']['compact']; ?>

			</div>
			<div class="editAddress">
			</div>
		</fieldset>
   <?php endif; ?>

   <?php echo smarty_function_renderBlock(array('block' => "SHIPMENT-CONTROLS"), $this);?>


</fieldset>