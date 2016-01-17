<?php /* Smarty version 2.6.26, created on 2015-12-01 10:53:59
         compiled from custom:backend/module/list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/module/list.tpl', 3, false),)), $this); ?>
<?php if ($this->_tpl_vars['sortedModules'][$this->_tpl_vars['type']]): ?>
	<fieldset class="type_<?php echo $this->_tpl_vars['type']; ?>
">
		<legend><?php echo smarty_function_translate(array('text' => "_module_type_".($this->_tpl_vars['type'])), $this);?>
</legend>
		<?php $_from = $this->_tpl_vars['sortedModules'][$this->_tpl_vars['type']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module']):
?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/module/node.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>
	</fieldset>
<?php endif; ?>