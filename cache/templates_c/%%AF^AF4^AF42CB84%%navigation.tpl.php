<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:01
         compiled from custom:order/block/navigation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'custom:order/block/navigation.tpl', 2, false),array('function', 'link', 'custom:order/block/navigation.tpl', 7, false),array('function', 'translate', 'custom:order/block/navigation.tpl', 7, false),array('modifier', 'config', 'custom:order/block/navigation.tpl', 14, false),)), $this); ?>
<tr>
	<td colspan="<?php echo smarty_function_math(array('equation' => ($this->_tpl_vars['extraColspanSize'])." + 4"), $this);?>
"></td>
	<td class="cartQuant"></td>
</tr>
<tr>
	<td colspan="<?php echo smarty_function_math(array('equation' => ($this->_tpl_vars['extraColspanSize'])." + 5"), $this);?>
">
		<a href="<?php echo smarty_function_link(array('route' => $this->_tpl_vars['return']), $this);?>
" class="continueShopping"><span><span><span><span><?php echo smarty_function_translate(array('text' => '_continue_shopping'), $this);?>
</span></span></span></span></a>
		<?php if ($this->_tpl_vars['cart']['isOrderable']): ?>
			<div class="checkoutButtons">
				<a href="<?php echo smarty_function_link(array('controller' => 'checkout'), $this);?>
" class="proceedToCheckout" onclick="return Order.submitCartForm(this);"><span><span><span><span><?php echo smarty_function_translate(array('text' => '_proceed_checkout'), $this);?>
</span></span></span></span></a>

				<div class="clear"></div>

				<?php if (((is_array($_tmp='REQUIRE_TOS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) && ! ((is_array($_tmp='TOS_OPC_ONLY')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/block/tos.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>

				<?php if (((is_array($_tmp='ENABLE_MULTIADDRESS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
					<?php if (! $this->_tpl_vars['multi']): ?>
						<a href="<?php echo smarty_function_link(array('controller' => 'order','action' => 'setMultiAddress'), $this);?>
" class="multiAddressCheckout"><?php echo smarty_function_translate(array('text' => '_ship_to_multiple'), $this);?>
</a>
					<?php else: ?>
						<a href="<?php echo smarty_function_link(array('controller' => 'order','action' => 'setSingleAddress'), $this);?>
" class="multiAddressCheckout"><?php echo smarty_function_translate(array('text' => '_ship_to_single'), $this);?>
</a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</td>
</tr>