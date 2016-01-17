<?php /* Smarty version 2.6.26, created on 2015-12-02 13:45:52
         compiled from custom:backend/product/count.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/product/count.tpl', 3, false),)), $this); ?>
<span class="activeGridItemsCount">
	<span id="productCount_<?php echo $this->_tpl_vars['categoryID']; ?>
">
		<span class="rangeCount" style="display: none;"><?php echo smarty_function_translate(array('text' => '_listing_products'), $this);?>
</span>
		<span class="notFound" style="display: none;"><?php echo smarty_function_translate(array('text' => '_no_products_found'), $this);?>
</span>
	</span>
</span>