<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from custom:onePageCheckout/register.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', 'custom:onePageCheckout/register.tpl', 1, false),array('function', 'translate', 'custom:onePageCheckout/register.tpl', 8, false),array('modifier', 'escape', 'custom:onePageCheckout/register.tpl', 8, false),)), $this); ?>
<?php $this->_tag_stack[] = array('form', array('action' => "controller=onePageCheckout action=doSelectShippingAddress",'method' => 'POST','handle' => $this->_tpl_vars['form'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/block/registerAddress.tpl", 'smarty_include_vars' => array('prefix' => 'shipping_')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/orderFields.tpl", 'smarty_include_vars' => array('eavPrefix' => 'order_')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<input type="hidden" name="sameAsShipping" />

	<div class="confirmButtonContainer">
		<label class="confirmAddressLabel"></label>
		<input type="button" class="button confirmAddress" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_confirm_address','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
		<span class="progressIndicator" style="display: none;"></span>
	</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>