<?php /* Smarty version 2.6.26, created on 2015-12-11 06:43:36
         compiled from /home/illumin/public_html/application/view/email/en/notify/order.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', '/home/illumin/public_html/application/view/email/en/notify/order.tpl', 1, false),array('function', 'backendOrderUrl', '/home/illumin/public_html/application/view/email/en/notify/order.tpl', 5, false),)), $this); ?>
New Order Placed at <?php echo ((is_array($_tmp='STORE_NAME')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>

Order ID: <?php echo $this->_tpl_vars['order']['invoiceNumber']; ?>


Order administration:
<?php echo smarty_function_backendOrderUrl(array('order' => $this->_tpl_vars['order'],'url' => true), $this);?>


The following items have been ordered:
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/blockOrder.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/blockOrderAddresses.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/en/signature.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>