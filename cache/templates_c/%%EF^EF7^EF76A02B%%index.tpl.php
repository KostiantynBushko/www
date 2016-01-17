<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:44
         compiled from /home/illumin/public_html/application/view///category/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'pageTitle', '/home/illumin/public_html/application/view///category/index.tpl', 1, false),array('modifier', 'default', '/home/illumin/public_html/application/view///category/index.tpl', 1, false),array('modifier', 'strip_tags', '/home/illumin/public_html/application/view///category/index.tpl', 2, false),array('modifier', 'config', '/home/illumin/public_html/application/view///category/index.tpl', 27, false),array('function', 'translate', '/home/illumin/public_html/application/view///category/index.tpl', 33, false),array('function', 'renderBlock', '/home/illumin/public_html/application/view///category/index.tpl', 44, false),)), $this); ?>
<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo ((is_array($_tmp=@$this->_tpl_vars['category']['pageTitle_lang'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['category']['name_lang']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['category']['name_lang'])); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->assign('metaDescription', smarty_modifier_strip_tags($this->_tpl_vars['category']['description_lang'])); ?>
<?php $this->assign('metaKeywords', $this->_tpl_vars['category']['keywords_lang']); ?>

<div class="categoryIndex category_<?php echo $this->_tpl_vars['category']['ID']; ?>
">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php if ($this->_tpl_vars['allFilters']['filters']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/allFilters.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['foundCategories']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/foundCategories.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['modelSearch']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:search/block/allResults.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['categoryNarrow']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/narrowByCategory.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php elseif (! $this->_tpl_vars['searchQuery'] && $this->_tpl_vars['subCategories'] && ! ((is_array($_tmp='HIDE_SUBCATS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/subcategoriesColumns.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['searchQuery'] && ! $this->_tpl_vars['products']): ?>
		<p class="notFound">
			<?php echo smarty_function_translate(array('text' => '_not_found'), $this);?>

		</p>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['appliedFilters'] && ! $this->_tpl_vars['products']): ?>
		<p class="notFound">
			<span class='notFoundMain'><?php echo smarty_function_translate(array('text' => '_no_products'), $this);?>
</span>
		</p>
	<?php endif; ?>

	<?php if (! $this->_tpl_vars['searchQuery'] && 1 == $this->_tpl_vars['currentPage']): ?>
		<?php echo smarty_function_renderBlock(array('block' => 'PRODUCT_LISTS'), $this);?>

	<?php endif; ?>

	<?php if ($this->_tpl_vars['subCatFeatured']): ?>
		<h2><?php echo smarty_function_translate(array('text' => '_featured_products'), $this);?>
</h2>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/productListLayout.tpl", 'smarty_include_vars' => array('layout' => ((is_array($_tmp=((is_array($_tmp='FEATURED_LAYOUT')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['layout']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['layout'])),'products' => $this->_tpl_vars['subCatFeatured'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<?php echo smarty_function_renderBlock(array('block' => 'FILTER_TOP'), $this);?>


	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/categoryProductList.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>