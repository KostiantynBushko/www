<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from /home/illumin/public_html/application/view///onePageCheckout/shippingAddress.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///onePageCheckout/shippingAddress.tpl', 2, false),array('block', 'form', '/home/illumin/public_html/application/view///onePageCheckout/shippingAddress.tpl', 8, false),)), $this); ?>
<?php if ($this->_tpl_vars['order']['isShippingRequired']): ?>
	<h2><span class="step"><?php echo $this->_tpl_vars['steps']['shippingAddress']; ?>
</span><?php echo smarty_function_translate(array('text' => '_shipping_address'), $this);?>
</h2>
<?php else: ?>
	<h2><span class="step"><?php echo $this->_tpl_vars['steps']['shippingAddress']; ?>
</span><?php echo smarty_function_translate(array('text' => '_billing_address'), $this);?>
</h2>
<?php endif; ?>

<?php if ($this->_tpl_vars['user']['ID'] > 0): ?>
	<?php $this->_tag_stack[] = array('form', array('action' => "controller=onePageCheckout action=doSelectShippingAddress",'method' => 'POST','handle' => $this->_tpl_vars['form'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/block/selectAddress.tpl", 'smarty_include_vars' => array('confirmButton' => true,'addresses' => $this->_tpl_vars['shippingAddresses'],'prefix' => 'shipping','states' => $this->_tpl_vars['shipping_states'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/orderFields.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<input type="hidden" name="sameAsShipping" />
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:onePageCheckout/register.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>