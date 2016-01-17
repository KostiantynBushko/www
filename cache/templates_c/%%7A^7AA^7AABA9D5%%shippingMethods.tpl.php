<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from /home/illumin/public_html/application/view///onePageCheckout/shippingMethods.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///onePageCheckout/shippingMethods.tpl', 1, false),array('block', 'form', '/home/illumin/public_html/application/view///onePageCheckout/shippingMethods.tpl', 3, false),array('modifier', 'count', '/home/illumin/public_html/application/view///onePageCheckout/shippingMethods.tpl', 11, false),)), $this); ?>
<h2><span class="step"><?php echo $this->_tpl_vars['steps']['shippingMethod']; ?>
</span><?php echo smarty_function_translate(array('text' => '_select_shipping'), $this);?>
</h2>
<div class="form">
	<?php $this->_tag_stack[] = array('form', array('action' => "controller=onePageCheckout action=doSelectShippingMethod",'method' => 'POST','handle' => $this->_tpl_vars['form'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_from = $this->_tpl_vars['shipments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['shipment']):
?>

			<?php if ($this->_tpl_vars['shipment']['isShippable']): ?>
				<?php if ($this->_tpl_vars['order']['isMultiAddress']): ?>
					<h2><?php echo $this->_tpl_vars['shipment']['ShippingAddress']['compact']; ?>
</h2>
				<?php endif; ?>

				<?php if (count($this->_tpl_vars['shipments']) > 1): ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/shipmentProductList.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>

				<?php if ($this->_tpl_vars['rates'][$this->_tpl_vars['key']]): ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/block/shipmentSelectShippingRateFields.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php else: ?>
					<span class="errorText"><?php echo smarty_function_translate(array('text' => '_err_no_rates_for_address'), $this);?>
</span>
				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php if (! $this->_tpl_vars['shipments']): ?>
		<div class="errorText"><?php echo smarty_function_translate(array('text' => '_err_no_rates_for_address'), $this);?>
</div>
	<?php endif; ?>
</div>

<div class="notAvailable">
	<p><?php echo smarty_function_translate(array('text' => '_no_shipping_address_provided'), $this);?>
</p>
</div>