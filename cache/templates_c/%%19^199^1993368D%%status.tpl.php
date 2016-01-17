<?php /* Smarty version 2.6.26, created on 2015-12-13 16:06:17
         compiled from /home/illumin/public_html/storage/customize/view/email/en/order/status.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', '/home/illumin/public_html/storage/customize/view/email/en/order/status.tpl', 1, false),array('modifier', 'count', '/home/illumin/public_html/storage/customize/view/email/en/order/status.tpl', 4, false),array('function', 'link', '/home/illumin/public_html/storage/customize/view/email/en/order/status.tpl', 11, false),)), $this); ?>
<?php echo ((is_array($_tmp='STORE_NAME')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
 Order Status Update
Dear <?php echo $this->_tpl_vars['user']['fullName']; ?>
,

<?php if (count($this->_tpl_vars['order']['shipments']) == 1): ?>
Status has been updated for your order <b class="orderID">#<?php echo $this->_tpl_vars['order']['invoiceNumber']; ?>
</b>.
<?php else: ?>
Status has been updated for one or more shipments from your order <b class="orderID">#<?php echo $this->_tpl_vars['order']['invoiceNumber']; ?>
</b>.
<?php endif; ?>

If you have any questions regarding this order, you can send us an email message or contact from the following page:
<?php echo smarty_function_link(array('controller' => 'user','action' => 'viewOrder','id' => $this->_tpl_vars['order']['ID'],'url' => true), $this);?>


<?php $_from = $this->_tpl_vars['order']['shipments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipment']):
?>
New status: <?php if ($this->_tpl_vars['shipment']['status'] == 2): ?>awaiting shipment<?php elseif ($this->_tpl_vars['shipment']['status'] == 3): ?>shipped<?php elseif ($this->_tpl_vars['shipment']['status'] == 4): ?>returned<?php else: ?>acknowledged<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/blockItemHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/blockShipment.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
------------------------------------------------------------

<?php endforeach; endif; unset($_from); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/en/signature.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>