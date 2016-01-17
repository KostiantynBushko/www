<?php /* Smarty version 2.6.26, created on 2015-12-16 11:22:56
         compiled from custom:backend/payment/transactions.tpl */ ?>
<ul class="transactions">

	<?php $_from = $this->_tpl_vars['transactions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['transaction']):
?>
		
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/payment/transaction.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
	<?php endforeach; endif; unset($_from); ?>

</ul>   