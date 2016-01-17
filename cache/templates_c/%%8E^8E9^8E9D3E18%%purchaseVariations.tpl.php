<?php /* Smarty version 2.6.26, created on 2015-12-04 07:53:46
         compiled from /home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/purchaseVariations.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/purchaseVariations.tpl', 13, false),array('modifier', 'implode', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/purchaseVariations.tpl', 15, false),array('modifier', 'escape', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/purchaseVariations.tpl', 40, false),array('function', 'translate', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/purchaseVariations.tpl', 29, false),array('function', 'renderBlock', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/purchaseVariations.tpl', 34, false),array('function', 'hidden', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/purchaseVariations.tpl', 41, false),)), $this); ?>
<?php if ($this->_tpl_vars['samePrice']): ?>
	<p>
		<label>Buy Now</label>
		<span class="price"><?php echo $this->_tpl_vars['product']['formattedPrice'][$this->_tpl_vars['currency']]; ?>
</span>
	</p>

	<?php if ($this->_tpl_vars['quantityPricing']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/quantityPrice.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
<?php endif; ?>

<?php $this->assign('parentProduct', $this->_tpl_vars['product']); ?>
<?php $this->_tag_stack[] = array('form', array('action' => "controller=order action=addToCart",'handle' => $this->_tpl_vars['cartForm'],'method' => 'POST','class' => 'purchaseVariations')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php $_from = $this->_tpl_vars['variations']['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
		<h3><?php echo implode($this->_tpl_vars['product']['variationNames'], ' / '); ?>
</h3>

		<?php if (! $this->_tpl_vars['samePrice']): ?>
			<p>
				<label>Buy Now</label>
				<span class="price"><?php echo $this->_tpl_vars['product']['finalFormattedPrice'][$this->_tpl_vars['currency']]; ?>
</span>
			</p>

			<?php if ($this->_tpl_vars['quantityPricing']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/quantityPrice.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		<?php endif; ?>

		<p>
			<label><?php echo smarty_function_translate(array('text' => '_quantity'), $this);?>
</label>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/quantity.tpl", 'smarty_include_vars' => array('field' => "product_".($this->_tpl_vars['product']['ID'])."_count",'quantity' => $this->_tpl_vars['quantities'][$this->_tpl_vars['product']['ID']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</p>

		<?php $this->assign('optionPrefix', "product_".($this->_tpl_vars['product']['ID'])."_"); ?>
		<?php echo smarty_function_renderBlock(array('block' => "PRODUCT-OPTIONS"), $this);?>

		<input type="hidden" name="productIDs[]" value="<?php echo $this->_tpl_vars['product']['ID']; ?>
" />
	<?php endforeach; endif; unset($_from); ?>

	<div id="productToCart" class="cartLinks">
		<label></label>
		<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_add_to_cart','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
		<?php echo smarty_function_hidden(array('name' => 'return','value' => $this->_tpl_vars['catRoute']), $this);?>

	</div>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $this->assign('product', $this->_tpl_vars['parentProduct']); ?>
<?php echo smarty_function_renderBlock(array('block' => "PRODUCT-OVERVIEW"), $this);?>