<?php /* Smarty version 2.6.26, created on 2015-12-01 15:10:26
         compiled from custom:block/eav/fields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'is_null', 'custom:block/eav/fields.tpl', 1, false),)), $this); ?>
<?php if (is_null($this->_tpl_vars['fieldList'])): ?>
	<?php $this->assign('fieldList', $this->_tpl_vars['specFieldList_prefix'][$this->_tpl_vars['eavPrefix']]); ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/fields.tpl", 'smarty_include_vars' => array('field' => 'EavField','specFieldList' => $this->_tpl_vars['fieldList'],'disableNewOptionValues' => true,'disableAutocomplete' => true,'prefix' => $this->_tpl_vars['eavPrefix'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>