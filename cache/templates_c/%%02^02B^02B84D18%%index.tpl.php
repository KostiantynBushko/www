<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:40
         compiled from /home/illumin/public_html/application/view///product/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadJs', '/home/illumin/public_html/application/view///product/index.tpl', 1, false),array('function', 'includeJs', '/home/illumin/public_html/application/view///product/index.tpl', 4, false),array('function', 'productUrl', '/home/illumin/public_html/application/view///product/index.tpl', 9, false),array('function', 'link', '/home/illumin/public_html/application/view///product/index.tpl', 20, false),array('function', 'translate', '/home/illumin/public_html/application/view///product/index.tpl', 42, false),array('function', 'maketext', '/home/illumin/public_html/application/view///product/index.tpl', 46, false),array('modifier', 'config', '/home/illumin/public_html/application/view///product/index.tpl', 3, false),array('modifier', 'strip_tags', '/home/illumin/public_html/application/view///product/index.tpl', 7, false),array('modifier', 'default', '/home/illumin/public_html/application/view///product/index.tpl', 10, false),array('modifier', 'count', '/home/illumin/public_html/application/view///product/index.tpl', 45, false),array('block', 'canonical', '/home/illumin/public_html/application/view///product/index.tpl', 9, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///product/index.tpl', 10, false),)), $this); ?>
<?php echo smarty_function_loadJs(array('form' => true), $this);?>


<?php if (((is_array($_tmp='PRODUCT_TABS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
	<?php echo smarty_function_includeJs(array('file' => "library/tabber/tabber.js"), $this);?>

<?php endif; ?>

<?php $this->assign('metaDescription', smarty_modifier_strip_tags($this->_tpl_vars['product']['shortDescription_lang'])); ?>
<?php $this->assign('metaKeywords', $this->_tpl_vars['product']['keywords']); ?>
<?php $this->_tag_stack[] = array('canonical', array()); $_block_repeat=true;smarty_block_canonical($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['product']), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_canonical($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo ((is_array($_tmp=@$this->_tpl_vars['product']['pageTitle_lang'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['product']['name_lang']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['product']['name_lang'])); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="productIndex productCategory_<?php echo $this->_tpl_vars['product']['Category']['ID']; ?>
 product_<?php echo $this->_tpl_vars['product']['ID']; ?>
">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content" class="left">
	<fieldset class="container">

		<div class="returnToCategory">
			<a href="<?php echo smarty_function_link(array('route' => $this->_tpl_vars['catRoute']), $this);?>
"><?php echo $this->_tpl_vars['product']['Category']['name_lang']; ?>
</a>
		</div>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<div id="productContent" class="productContent">
			<?php if ($this->_tpl_vars['product']['type'] == 2): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/bundle.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/files.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/details.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<?php if (((is_array($_tmp='PRODUCT_INQUIRY_FORM')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/contactForm.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/ratingForm.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<?php if ($this->_tpl_vars['reviews']): ?>
				<div id="reviewSection" class="productSection reviewSection">
					<h2><?php echo smarty_function_translate(array('text' => '_reviews'), $this);?>
<small><?php echo smarty_function_translate(array('text' => '_tab_reviews'), $this);?>
</small></h2>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/reviewList.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<?php if ($this->_tpl_vars['product']['reviewCount'] > count($this->_tpl_vars['reviews'])): ?>
						<a href="<?php echo smarty_function_link(array('controller' => 'product','action' => 'reviews','id' => $this->_tpl_vars['product']['ID']), $this);?>
" class="readAllReviews"><?php echo smarty_function_maketext(array('text' => '_read_all_reviews','params' => $this->_tpl_vars['product']['reviewCount']), $this);?>
</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="clear"></div>
		</div>

	</fieldset>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>