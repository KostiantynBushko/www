<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from /home/illumin/public_html/application/view///onePageCheckout/billingAddress.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///onePageCheckout/billingAddress.tpl', 1, false),array('function', 'checkbox', '/home/illumin/public_html/application/view///onePageCheckout/billingAddress.tpl', 6, false),array('block', 'form', '/home/illumin/public_html/application/view///onePageCheckout/billingAddress.tpl', 3, false),)), $this); ?>
<h2><span class="step"><?php echo $this->_tpl_vars['steps']['billingAddress']; ?>
</span><?php echo smarty_function_translate(array('text' => '_billing_address'), $this);?>
</h2>

<?php $this->_tag_stack[] = array('form', array('action' => "controller=onePageCheckout action=doSelectBillingAddress",'method' => 'POST','handle' => $this->_tpl_vars['form'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if (! $this->_tpl_vars['order']['isMultiAddress']): ?>
		<p>
			<?php echo smarty_function_checkbox(array('name' => 'sameAsShipping','class' => 'checkbox'), $this);?>

			<label for="sameAsShipping" class="checkbox"><?php echo smarty_function_translate(array('text' => '_the_same_as_shipping_address'), $this);?>
</label>
		</p>
	<?php endif; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/block/selectAddress.tpl", 'smarty_include_vars' => array('confirmButton' => true,'addresses' => $this->_tpl_vars['billingAddresses'],'prefix' => 'billing','states' => $this->_tpl_vars['billing_states'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="notAvailable">
	<p><?php echo smarty_function_translate(array('text' => '_please_enter_shipping_address'), $this);?>
</p>
</div>