<?php /* Smarty version 2.6.26, created on 2015-12-13 16:27:42
         compiled from /home/illumin/public_html/application/view///backend/product/basicData.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', '/home/illumin/public_html/application/view///backend/product/basicData.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/product/basicData.tpl', 13, false),array('function', 'toolTip', '/home/illumin/public_html/application/view///backend/product/basicData.tpl', 17, false),array('function', 'selectfield', '/home/illumin/public_html/application/view///backend/product/basicData.tpl', 18, false),array('function', 'checkbox', '/home/illumin/public_html/application/view///backend/product/basicData.tpl', 27, false),array('function', 'json', '/home/illumin/public_html/application/view///backend/product/basicData.tpl', 55, false),)), $this); ?>
<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['productForm'],'action' => "controller=backend.product action=update id=".($this->_tpl_vars['product']['ID']),'id' => "product_".($this->_tpl_vars['product']['ID'])."_form",'onsubmit' => "Backend.Product.Editor.prototype.getInstance(".($this->_tpl_vars['product']['ID']).", false).submitForm(); return false;",'method' => 'post','role' => "product.update")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

	<input type="hidden" name="categoryID" value="<?php echo $this->_tpl_vars['cat']; ?>
" />
	<table class="panelGrid"><tr><td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/product/form/main.tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['product'],'cat' => $this->_tpl_vars['cat'],'productTypes' => $this->_tpl_vars['productTypes'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php if ($this->_tpl_vars['specFieldList']): ?>
		<div class="specFieldContainer">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/product/form/specFieldList.tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['product'],'cat' => $this->_tpl_vars['cat'],'specFieldList' => $this->_tpl_vars['specFieldList'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	<?php endif; ?>

	<fieldset>
		<legend><?php echo smarty_function_translate(array('text' => '_presentation'), $this);?>
</legend>

		<div style="float: left; width: 550px;">
			<p>
				<label for="productTheme_<?php echo $this->_tpl_vars['product']['ID']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_theme'), $this);?>
:</label>
				<?php echo smarty_function_selectfield(array('name' => 'theme','id' => "productTheme_".($this->_tpl_vars['product']['ID']),'options' => $this->_tpl_vars['themes']), $this);?>

			</p>
		</div>

		<div style="float: left;" id="productThemePreview_<?php echo $this->_tpl_vars['product']['ID']; ?>
"></div>
		<div class="clear"></div>

		<p>
			<label></label>
			<?php echo smarty_function_checkbox(array('name' => 'isVariationImages','class' => 'checkbox','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_isVariationImages"), $this);?>

			<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_isVariationImages" class="checkbox"><?php echo smarty_function_toolTip(array('label' => '_show_variation_images'), $this);?>
</label>
		</p>

		<p>
			<label></label>
			<?php echo smarty_function_checkbox(array('name' => 'isAllVariations','class' => 'checkbox','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_isAllVariations"), $this);?>

			<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_isAllVariations" class="checkbox"><?php echo smarty_function_toolTip(array('label' => '_allow_all_variations'), $this);?>
</label>
		</p>
	</fieldset>
	</td><td>
	<div class="productForm <?php if (1 == $this->_tpl_vars['product']['type']): ?>intangible<?php endif; ?>">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/product/form/inventory.tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['product'],'cat' => $this->_tpl_vars['product']['Category']['ID'],'baseCurrency' => $this->_tpl_vars['baseCurrency'],'form' => $this->_tpl_vars['productForm'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/product/form/pricing.tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['product'],'cat' => $this->_tpl_vars['product']['Category']['ID'],'baseCurrency' => $this->_tpl_vars['baseCurrency'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/product/form/shipping.tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['product'],'cat' => $this->_tpl_vars['product']['Category']['ID'],'baseCurrency' => $this->_tpl_vars['baseCurrency'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	</td></tr></table>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/product/form/translations.tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['product'],'cat' => $this->_tpl_vars['cat'],'multiLingualSpecFields' => $this->_tpl_vars['multiLingualSpecFields'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<fieldset class="controls">
		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" name="save" class="submit" value="<?php echo smarty_function_translate(array('text' => '_save'), $this);?>
">
		<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

		<a class="cancel" href="#"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
	</fieldset>

	<script type="text/javascript">
		var editor = Backend.Product.Editor.prototype.getInstance(<?php echo $this->_tpl_vars['product']['ID']; ?>
, true, <?php echo smarty_function_json(array('array' => $this->_tpl_vars['path']), $this);?>
, <?php echo $this->_tpl_vars['counters']; ?>
);
		new Backend.ThemePreview($('productThemePreview_<?php echo $this->_tpl_vars['product']['ID']; ?>
'), $('productTheme_<?php echo $this->_tpl_vars['product']['ID']; ?>
'));
				var qp=$("quantityPricingViewPort_<?php echo $this->_tpl_vars['product']['ID']; ?>
");
		qp.style.width=(qp.up("fieldset").getWidth()-4)+"px";
	</script>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>