<?php /* Smarty version 2.6.26, created on 2015-12-11 14:39:36
         compiled from /home/illumin/public_html/application/view/email/en/order/cancel.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', '/home/illumin/public_html/application/view/email/en/order/cancel.tpl', 1, false),array('function', 'link', '/home/illumin/public_html/application/view/email/en/order/cancel.tpl', 7, false),)), $this); ?>
<?php echo ((is_array($_tmp='STORE_NAME')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
 Order Cancelled
Dear <?php echo $this->_tpl_vars['user']['fullName']; ?>
,

Your order <b class="orderID">#<?php echo $this->_tpl_vars['order']['invoiceNumber']; ?>
</b>, placed at <?php echo ((is_array($_tmp='STORE_NAME')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
, has been cancelled.

If you have any questions regarding this order, you can send us an email message or contact from the following page:
<?php echo smarty_function_link(array('controller' => 'user','action' => 'viewOrder','id' => $this->_tpl_vars['order']['ID'],'url' => true), $this);?>


Items in the cancelled order:
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/blockOrderItems.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/en/signature.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>