<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:33
         compiled from custom:product/block/cartButton.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:product/block/cartButton.tpl', 1, false),array('function', 'link', 'custom:product/block/cartButton.tpl', 2, false),)), $this); ?>
<?php if ($this->_tpl_vars['product']['isAvailable'] && ((is_array($_tmp='ENABLE_CART')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
	<a href="<?php echo smarty_function_link(array('controller' => 'order','action' => 'addToCart','id' => $this->_tpl_vars['product']['ID'],'returnPath' => true), $this);?>
" rel="nofollow" class="addToCart tooltip" title="Add To Cart"><span title="More">Buy Now <img src="upload/theme/IlluminataV3/carticon.png"></span></a>
<?php else: ?>
<div class="soldOut">
Sold Out
</div>
<?php endif; ?>