<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:01
         compiled from custom:order/itemVariations.tpl */ ?>
<?php if ($this->_tpl_vars['item']['Product']['variations']): ?>
	<p class="variations">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/itemVariationsList.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</p>
<?php endif; ?>