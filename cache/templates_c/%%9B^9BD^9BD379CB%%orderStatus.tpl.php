<?php /* Smarty version 2.6.26, created on 2015-12-11 06:45:04
         compiled from custom:user/orderStatus.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:user/orderStatus.tpl', 2, false),array('function', 'link', 'custom:user/orderStatus.tpl', 6, false),)), $this); ?>
<?php if ($this->_tpl_vars['order']['isCancelled']): ?>
	<span class="cancelled"><?php echo smarty_function_translate(array('text' => '_cancelled'), $this);?>
</span>
<?php elseif (! $this->_tpl_vars['order']['isPaid']): ?>
	<span class="awaitingPayment"><?php echo smarty_function_translate(array('text' => '_awaiting_payment'), $this);?>

	<strong><?php echo $this->_tpl_vars['order']['formattedTotal'][$this->_tpl_vars['order']['Currency']['ID']]; ?>
</strong></span>.
	<a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'pay','id' => $this->_tpl_vars['order']['ID']), $this);?>
"><?php echo smarty_function_translate(array('text' => '_make_payment'), $this);?>
</a>.
<?php else: ?>
	<?php if ($this->_tpl_vars['order']['isReturned']): ?>
		<span class="returned"><?php echo smarty_function_translate(array('text' => '_returned'), $this);?>
</span>
	<?php elseif ($this->_tpl_vars['order']['isShipped']): ?>
		<span class="mailed"><?php echo smarty_function_translate(array('text' => '_shipped'), $this);?>
</span>
	<?php elseif ($this->_tpl_vars['order']['isAwaitingShipment']): ?>
		<span class="mailed"><?php echo smarty_function_translate(array('text' => '_awaiting'), $this);?>
</span>
	<?php else: ?>
		<span class="processing"><?php echo smarty_function_translate(array('text' => '_order_processing'), $this);?>
</span>
	<?php endif; ?>
<?php endif; ?>