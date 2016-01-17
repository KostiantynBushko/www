<?php /* Smarty version 2.6.26, created on 2015-12-01 10:29:24
         compiled from custom:category/narrowByCategory.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'custom:category/narrowByCategory.tpl', 1, false),array('function', 'translate', 'custom:category/narrowByCategory.tpl', 7, false),array('modifier', 'count', 'custom:category/narrowByCategory.tpl', 1, false),)), $this); ?>
<?php echo smarty_function_math(array('count' => count($this->_tpl_vars['categoryNarrow']),'equation' => "max(1, ceil(count / 2))",'assign' => 'perColumn'), $this);?>


<fieldset class="container">

<div class="narrowByCat">
	<div class="resultStats">
		<?php echo smarty_function_translate(array('text' => '_narrow_by_cat'), $this);?>

	</div>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/subcategoriesColumns.tpl", 'smarty_include_vars' => array('subCategories' => $this->_tpl_vars['categoryNarrow'],'filters' => $this->_tpl_vars['appliedFilters'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>

</fieldset>