<?php /* Smarty version 2.6.26, created on 2015-12-13 16:27:42
         compiled from custom:backend/product/form/specFieldList.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/product/form/specFieldList.tpl', 2, false),)), $this); ?>
<fieldset class="specification">
	<legend><?php echo smarty_function_translate(array('text' => '_product_specification'), $this);?>
</legend>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/fields.tpl", 'smarty_include_vars' => array('fields' => $this->_tpl_vars['specFieldList'],'item' => $this->_tpl_vars['product'],'cat' => $this->_tpl_vars['cat'],'textFieldClass' => 'wide')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</fieldset>