<?php /* Smarty version 2.6.26, created on 2015-12-11 06:43:36
         compiled from custom:email/blockOrderAddresses.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:email/blockOrderAddresses.tpl', 3, false),)), $this); ?>

<?php if ($this->_tpl_vars['order']['BillingAddress']): ?>
<br /><b><?php echo smarty_function_translate(array('text' => '_billing_address'), $this);?>
:</b>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/blockAddress.tpl", 'smarty_include_vars' => array('address' => $this->_tpl_vars['order']['BillingAddress'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['order']['ShippingAddress']): ?>
<b><?php echo smarty_function_translate(array('text' => '_shipping_address'), $this);?>
:</b>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/blockAddress.tpl", 'smarty_include_vars' => array('address' => $this->_tpl_vars['order']['ShippingAddress'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>