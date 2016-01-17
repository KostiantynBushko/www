<?php /* Smarty version 2.6.26, created on 2015-12-16 11:22:56
         compiled from custom:backend/payment/totals.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/payment/totals.tpl', 2, false),)), $this); ?>
<p>
	<label><?php echo smarty_function_translate(array('text' => '_order_total'), $this);?>
:</label>
	<label><?php echo $this->_tpl_vars['order']['formattedTotal'][$this->_tpl_vars['order']['Currency']['ID']]; ?>
</label>
</p>

<p>
	<label><?php echo smarty_function_translate(array('text' => '_amount_paid'), $this);?>
:</label>
	<label><?php echo $this->_tpl_vars['order']['formatted_amountPaid']; ?>
</label>
</p>

<div class="clear amountSection"></div>

<?php if ($this->_tpl_vars['order']['amountNotCaptured'] != 0): ?>
	<p>
		<label><?php echo smarty_function_translate(array('text' => '_not_captured'), $this);?>
:</label>
		<label><?php echo $this->_tpl_vars['order']['formatted_amountNotCaptured']; ?>
</label>
	</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['order']['amountDue'] > 0): ?>	
	<p>
		<label><?php echo smarty_function_translate(array('text' => '_amount_due'), $this);?>
:</label>
		<label><?php echo $this->_tpl_vars['order']['formatted_amountDue']; ?>
</label>
	</p>
<?php endif; ?>