<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:01
         compiled from custom:order/block/expressCheckout.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', 'custom:order/block/expressCheckout.tpl', 4, false),)), $this); ?>
<?php if ($this->_tpl_vars['expressMethods'] && $this->_tpl_vars['cart']['isOrderable'] && ! $this->_tpl_vars['cart']['isMultiAddress']): ?>
	<div id="expressCheckoutMethods">
		<?php $_from = $this->_tpl_vars['expressMethods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['method']):
?>
			<a href="<?php echo smarty_function_link(array('controller' => 'checkout','action' => 'express','id' => $this->_tpl_vars['method']), $this);?>
"><img src="image/payment/<?php echo $this->_tpl_vars['method']; ?>
.gif" /></a>
		<?php endforeach; endif; unset($_from); ?>
	</div>
<?php endif; ?>