<?php /* Smarty version 2.6.26, created on 2015-12-01 11:00:55
         compiled from custom:category/productListItem.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:category/productListItem.tpl', 11, false),array('function', 'translate', 'custom:category/productListItem.tpl', 12, false),array('function', 'productUrl', 'custom:category/productListItem.tpl', 20, false),array('function', 'renderBlock', 'custom:category/productListItem.tpl', 28, false),array('function', 'link', 'custom:category/productListItem.tpl', 43, false),)), $this); ?>
<fieldset class="container" style="position: relative; height: 150px;">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/smallImage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<div class="descr">
		<div class="descrWrapper1"><div class="descrWrapper2"><div class="descrWrapper3"><div class="descrWrapper4">

		<div class="pricingInfo"><div><div>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/cartButton.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<?php if (((is_array($_tmp='DISPLAY_PRICES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
				<span><?php echo smarty_function_translate(array('text' => '_our_price'), $this);?>
:</span>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/productPrice.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>

			<br class="clear" />
		</div></div></div>

		<div class="title" style="position: relative; left: 100px; width: 200px;">
			<a href="<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['product'],'filterChainHandle' => $this->_tpl_vars['filterChainHandle']), $this);?>
"><?php echo $this->_tpl_vars['product']['name_lang']; ?>
</a>
		</div>

		<?php if ($this->_tpl_vars['product']['attributes']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/block/productListAttributes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>

		<div class="shortDescr" style="position: relative; left: 100px;">
			<?php echo smarty_function_renderBlock(array('block' => "PRODUCT-LIST-DESCR-BEFORE"), $this);?>

			<?php echo $this->_tpl_vars['product']['shortDescription_lang']; ?>

			<?php echo smarty_function_renderBlock(array('block' => "PRODUCT-LIST-DESCR-AFTER"), $this);?>

		</div>

		<div class="order">
			<div class="orderingControls">
				<?php $this->assign('sep', false); ?>
				<?php if ($this->_tpl_vars['product']['rating'] && ((is_array($_tmp='ENABLE_RATINGS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/productListRating.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $this->assign('sep', true); ?>
				<?php endif; ?>
			
				<?php if (((is_array($_tmp='ENABLE_WISHLISTS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
					<?php if ($this->_tpl_vars['sep']): ?><span class="listItemSeparator">|</span><?php endif; ?>
					<a href="<?php echo smarty_function_link(array('controller' => 'order','action' => 'addToWishList','id' => $this->_tpl_vars['product']['ID'],'returnPath' => true), $this);?>
" rel="nofollow" class="addToWishListList" style="float:right; font-size: smaller;">Add To Wishlist&nbsp;<img src='upload/theme/IlluminataV3/wishicon.png'></a>
					<?php $this->assign('sep', false); ?>
				<?php endif; ?>
			
				<?php if (((is_array($_tmp='ENABLE_PRODUCT_COMPARE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
					<?php if ($this->_tpl_vars['sep']): ?><span class="listItemSeparator">|</span><?php endif; ?>
					<span class="listItemSeparator">|</span>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:compare/block/compareLink.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>
			</div>
		</div>

		</div></div></div></div>
	</div>

</fieldset>