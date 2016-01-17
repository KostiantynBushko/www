<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from /home/illumin/public_html/application/view//product/block/purchase.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', '/home/illumin/public_html/application/view//product/block/purchase.tpl', 1, false),array('function', 'blocks', '/home/illumin/public_html/application/view//product/block/purchase.tpl', 4, false),)), $this); ?>
<?php $this->_tag_stack[] = array('form', array('action' => "controller=order action=addToCart id=".($this->_tpl_vars['product']['ID']),'handle' => $this->_tpl_vars['cartForm'],'method' => 'POST')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

	<table id="productPurchaseLinks">
	<?php echo smarty_function_blocks(array('id' => "PRODUCT-PURCHASE-CONTAINER",'blocks' => "
		PRODUCT-PRICE
		PRODUCT-UP-SELL
		PRODUCT-TO-CART
		PRODUCT-ACTIONS"), $this);?>

	</table>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>