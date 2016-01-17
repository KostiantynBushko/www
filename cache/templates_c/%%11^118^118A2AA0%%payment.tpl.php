<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from /home/illumin/public_html/application/view///onePageCheckout/payment.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///onePageCheckout/payment.tpl', 1, false),array('function', 'link', '/home/illumin/public_html/application/view///onePageCheckout/payment.tpl', 26, false),array('block', 'form', '/home/illumin/public_html/application/view///onePageCheckout/payment.tpl', 2, false),array('block', 'sect', '/home/illumin/public_html/application/view///onePageCheckout/payment.tpl', 72, false),array('block', 'header', '/home/illumin/public_html/application/view///onePageCheckout/payment.tpl', 73, false),array('block', 'content', '/home/illumin/public_html/application/view///onePageCheckout/payment.tpl', 76, false),array('modifier', 'config', '/home/illumin/public_html/application/view///onePageCheckout/payment.tpl', 7, false),)), $this); ?>
<h2><span class="step"><?php echo $this->_tpl_vars['steps']['payment']; ?>
</span><?php echo smarty_function_translate(array('text' => '_payment_info'), $this);?>
</h2>
<?php $this->_tag_stack[] = array('form', array('action' => "controller=onePageCheckout action=setPaymentMethod",'method' => 'POST','handle' => $this->_tpl_vars['form'],'id' => "checkout-select-payment-method")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<p class="selectMethodMsg">
		<?php echo smarty_function_translate(array('text' => '_select_payment_method'), $this);?>

	</p>

	<?php if (((is_array($_tmp='CC_ENABLE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<p>
			<input type="radio" class="radio" name="payMethod" value="cc" id="pay_cc" <?php if ($this->_tpl_vars['selectedMethod'] == 'cc'): ?>checked="checked"<?php endif; ?> />
			<label class="radio" for="pay_cc"><?php echo smarty_function_translate(array('text' => '_credit_card'), $this);?>
</label>
		</p>
	<?php endif; ?>

	<?php $_from = $this->_tpl_vars['offlineMethods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['method']):
?>
		<p>
			<input type="radio" class="radio" name="payMethod" value="<?php echo $this->_tpl_vars['method']; ?>
" id="<?php echo $this->_tpl_vars['method']; ?>
"  <?php if ($this->_tpl_vars['selectedMethod'] == $this->_tpl_vars['method']): ?>checked="checked"<?php endif; ?> />
			<label class="radio" for="<?php echo $this->_tpl_vars['method']; ?>
"><?php echo ((is_array($_tmp="OFFLINE_NAME_".($this->_tpl_vars['key']))) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
</label>
		</p>
	<?php endforeach; endif; unset($_from); ?>

	<?php if ($this->_tpl_vars['otherMethods']): ?>
		<table class="checkout-otherMethods">
			<?php $_from = $this->_tpl_vars['otherMethods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['method']):
?>
				<tr>
					<td style="vertical-align: middle;">
						<input type="radio" class="radio" name="payMethod" value="<?php echo smarty_function_link(array('controller' => 'onePageCheckout','action' => 'redirect','query' => "id=".($this->_tpl_vars['method'])), $this);?>
" id="<?php echo $this->_tpl_vars['method']; ?>
" <?php if ($this->_tpl_vars['selectedMethod'] == $this->_tpl_vars['method']): ?>checked="checked"<?php endif; ?> />
					</td>
					<td>
						<label class="radio" for="<?php echo $this->_tpl_vars['method']; ?>
">
							<img src="image/payment/<?php echo $this->_tpl_vars['method']; ?>
.gif" class="paymentLogo" alt="<?php echo $this->_tpl_vars['method']; ?>
" />
						</label>
					</td>
				</p>
			<?php endforeach; endif; unset($_from); ?>
		</table>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['requireTos']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/block/tos.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="form">
	<div id="paymentForm"></div>

	<div id="checkout-place-order">
		<div class="errorText hidden" id="no-payment-method-selected">
			<?php echo smarty_function_translate(array('text' => '_no_payment_method_selected'), $this);?>

		</div>

		<div class="completeOrderButton">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:onePageCheckout/block/submitButton.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

		<div class="grandTotal">
			<?php echo smarty_function_translate(array('text' => '_total'), $this);?>
:
			<span class="orderTotal"><?php echo $this->_tpl_vars['order']['formattedTotal'][$this->_tpl_vars['currency']]; ?>
</span>
		</div>
	</div>
</div>

<div id="paymentMethodForms" style="display: none;">
	<?php if (((is_array($_tmp='CC_ENABLE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<div id="payForm_cc">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/block/ccForm.tpl", 'smarty_include_vars' => array('controller' => 'onePageCheckout')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	<?php endif; ?>

	<?php $_from = $this->_tpl_vars['offlineMethods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['method']):
?>
		<div id="payForm_<?php echo $this->_tpl_vars['method']; ?>
">
			<?php $this->_tag_stack[] = array('form', array('action' => "controller=onePageCheckout action=payOffline query=id=".($this->_tpl_vars['method']),'handle' => $this->_tpl_vars['offlineForms'][$this->_tpl_vars['method']],'method' => 'POST')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php $this->_tag_stack[] = array('sect', array()); $_block_repeat=true;smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<?php $this->_tag_stack[] = array('header', array()); $_block_repeat=true;smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
						<h2><?php echo ((is_array($_tmp="OFFLINE_NAME_".($this->_tpl_vars['key']))) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
</h2>
					<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php $this->_tag_stack[] = array('content', array()); $_block_repeat=true;smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/offlineMethodInfo.tpl", 'smarty_include_vars' => array('method' => $this->_tpl_vars['key'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:block/eav/fields.tpl", 'smarty_include_vars' => array('fieldList' => $this->_tpl_vars['offlineVars'][$this->_tpl_vars['method']]['specFieldList'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</div>
	<?php endforeach; endif; unset($_from); ?>
</div>

<div class="notAvailable">
	<p><?php echo smarty_function_translate(array('text' => '_payment_not_ready'), $this);?>
</p>
</div>

<div class="clear"></div>