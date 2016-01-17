<?php /* Smarty version 2.6.26, created on 2015-12-13 16:28:12
         compiled from backend/customerOrder/massAction.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'denied', 'backend/customerOrder/massAction.tpl', 1, false),array('block', 'form', 'backend/customerOrder/massAction.tpl', 3, false),array('function', 'translate', 'backend/customerOrder/massAction.tpl', 9, false),array('modifier', 'escape', 'backend/customerOrder/massAction.tpl', 32, false),)), $this); ?>
<span style="<?php $this->_tag_stack[] = array('denied', array('role' => "order.mass")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>visibility: hidden;<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" id="orderMass_<?php echo $this->_tpl_vars['orderGroupID']; ?>
" class="activeGridMass">

	<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.customerOrder action=processMass id=".($this->_tpl_vars['orderGroupID']),'method' => 'POST','handle' => $this->_tpl_vars['massForm'],'onsubmit' => "return false;")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

	<input type="hidden" name="filters" value="" />
	<input type="hidden" name="selectedIDs" value="" />
	<input type="hidden" name="isInverse" value="" />

	<?php echo smarty_function_translate(array('text' => '_with_selected'), $this);?>
:
	<select name="act" class="select">
		<?php if ($this->_tpl_vars['orderGroupID'] == 8): ?>
			<option value="setFinalized"><?php echo smarty_function_translate(array('text' => '_mark_completed'), $this);?>
</option>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['orderGroupID'] < 8): ?>
			<option value="printLabels" rel="blank"><?php echo smarty_function_translate(array('text' => '_print_shipping_labels'), $this);?>
</option>
			<optgroup label="<?php echo smarty_function_translate(array('text' => '_order_status'), $this);?>
" class="massStatus">
				<option value="setNew"><?php echo smarty_function_translate(array('text' => '_set_new'), $this);?>
</option>
				<option value="setProcessing"><?php echo smarty_function_translate(array('text' => '_set_processing'), $this);?>
</option>
				<option value="setAwaitingShipment"><?php echo smarty_function_translate(array('text' => '_set_awaiting_shipment'), $this);?>
</option>
				<option value="setShipped"><?php echo smarty_function_translate(array('text' => '_set_shipped'), $this);?>
</option>
				<option value="setReturned"><?php echo smarty_function_translate(array('text' => '_set_returned'), $this);?>
</option>
			</optgroup>
			<option value="setCancel" class="massCancel"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</option>
		<?php endif; ?>
		<option value="delete" class="delete"><?php echo smarty_function_translate(array('text' => '_delete'), $this);?>
</option>
	</select>

	<span class="bulkValues" style="display: none;">

	</span>

	<input type="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_process','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" class="submit" />
	<span class="progressIndicator" style="display: none;"></span>

	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</span>