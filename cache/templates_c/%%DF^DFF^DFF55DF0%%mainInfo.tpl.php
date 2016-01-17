<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from /home/illumin/public_html/application/view//product/block/mainInfo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'renderBlock', '/home/illumin/public_html/application/view//product/block/mainInfo.tpl', 3, false),array('function', 'blocks', '/home/illumin/public_html/application/view//product/block/mainInfo.tpl', 5, false),)), $this); ?>
<div id="mainInfo">
	<?php if ($this->_tpl_vars['presentation']['isAllVariations'] && $this->_tpl_vars['variations']): ?>
		<?php echo smarty_function_renderBlock(array('block' => "PRODUCT-PURCHASE-VARIATIONS"), $this);?>

	<?php else: ?>
		<?php echo smarty_function_blocks(array('id' => "PRODUCT-MAININFO-CONTAINER",'blocks' => "
				PRODUCT-PURCHASE
				PRODUCT-OVERVIEW"), $this);?>

	<?php endif; ?>
</div>