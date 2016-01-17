<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:33
         compiled from custom:category/productGridItem.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'productUrl', 'custom:category/productGridItem.tpl', 4, false),array('function', 'link', 'custom:category/productGridItem.tpl', 29, false),array('modifier', 'config', 'custom:category/productGridItem.tpl', 22, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/smallImage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="title">
	<a href="<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['product'],'filterChainHandle' => $this->_tpl_vars['filterChainHandle']), $this);?>
"><?php echo $this->_tpl_vars['product']['name_lang']; ?>
</a>
</div>

<div class="pricingInfo"><div><div><div>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/cartButton.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div class="priceAboveCart">
	<?php if ($this->_tpl_vars['product']['isAvailable']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/productPrice.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	</div>
	
	<?php if ($this->_tpl_vars['hasMirror'][$this->_tpl_vars['product']['ID']]): ?>
		<div style="display: none;>"<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:module/store-cloning/mirror/button.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
	<?php endif; ?>
	<div class="clear"></div>
</div></div></div></div>

<div class="order">
		<?php if ($this->_tpl_vars['product']['rating'] && ((is_array($_tmp='ENABLE_RATINGS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/productListRating.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
		
	<div class="orderingControls">

		<?php if (((is_array($_tmp='ENABLE_WISHLISTS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
			<a href="<?php echo smarty_function_link(array('controller' => 'order','action' => 'addToWishList','id' => $this->_tpl_vars['product']['ID'],'returnPath' => true), $this);?>
" rel="nofollow" class="addToWishList tooltip" title="Add To Wishlist"><span title="More"><img src="upload/theme/IlluminataV3/wishicon.png"></span></a>
		<?php endif; ?>
	</div>
</div>

<?php if (((is_array($_tmp='ENABLE_PRODUCT_COMPARE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
<div class="compare">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:compare/block/compareLink.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>