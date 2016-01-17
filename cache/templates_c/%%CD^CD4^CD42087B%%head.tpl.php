<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from custom:product/head.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'renderBlock', 'custom:product/head.tpl', 5, false),array('function', 'blocks', 'custom:product/head.tpl', 11, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:block/message.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1><?php echo $this->_tpl_vars['product']['name_lang']; ?>
</h1>

<?php echo smarty_function_renderBlock(array('block' => "PRODUCT-ATTRIBUTE-SUMMARY"), $this);?>


<div class="clear"></div>

<div class="head-product">

<?php echo smarty_function_blocks(array('id' => "PRODUCT-HEAD",'blocks' => "
		PRODUCT-IMAGES
		PRODUCT-SUMMARY"), $this);?>

		
</div>

<div class="clear"></div>