<?php /* Smarty version 2.6.26, created on 2015-12-11 06:43:36
         compiled from /home/illumin/public_html/storage/customize/view/email/en/order/new.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', '/home/illumin/public_html/storage/customize/view/email/en/order/new.tpl', 1, false),array('function', 'link', '/home/illumin/public_html/storage/customize/view/email/en/order/new.tpl', 7, false),)), $this); ?>
<?php echo ((is_array($_tmp='STORE_NAME')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
 Order Confirmation
Dear <?php echo $this->_tpl_vars['user']['fullName']; ?>
,

Thank you for your order, that you just placed at <?php echo ((is_array($_tmp='STORE_NAME')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
. If you need to contact us regarding this order, please quote the order ID <b class="orderID">#<?php echo $this->_tpl_vars['order']['invoiceNumber']; ?>
</b>.

You will be able to track the progress of your order at this page:
<?php echo smarty_function_link(array('controller' => 'user','action' => 'viewOrder','id' => $this->_tpl_vars['order']['ID'],'url' => true), $this);?>


If you have any questions regarding this order, you can send us a message from the above page as well.

We remind you that the following items have been ordered:
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