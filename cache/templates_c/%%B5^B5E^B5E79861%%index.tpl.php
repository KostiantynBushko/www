<?php /* Smarty version 2.6.26, created on 2015-12-11 14:40:16
         compiled from /home/illumin/public_html/application/view///backend/err/index.tpl */ ?>
<?php if (! $this->_tpl_vars['ajax']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php echo $this->_tpl_vars['description']; ?>
 [Code <?php echo $this->_tpl_vars['id']; ?>
]

<?php if (! $this->_tpl_vars['ajax']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>