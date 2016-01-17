<?php /* Smarty version 2.6.26, created on 2015-12-01 11:14:08
         compiled from custom:category/productListRating.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'round', 'custom:category/productListRating.tpl', 2, false),array('function', 'productUrl', 'custom:category/productListRating.tpl', 4, false),)), $this); ?>
<span class="productListRating">
	<img src="image/rating/<?php ob_start(); ?><?php echo round($this->_tpl_vars['product']['rating']*2); ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo $this->_tpl_vars['blockAsParamValue']/2; ?>
.gif" />
	<?php if ($this->_tpl_vars['product']['reviewCount']): ?>
		<a href="<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['product'],'filterChainHandle' => $this->_tpl_vars['filterChainHandle']), $this);?>
#reviews">(<?php echo $this->_tpl_vars['product']['reviewCount']; ?>
)</a>
	<?php endif; ?>
</span>