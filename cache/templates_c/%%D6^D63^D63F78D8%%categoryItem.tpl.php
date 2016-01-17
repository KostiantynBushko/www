<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:33
         compiled from custom:category/block/categoryItem.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'sect', 'custom:category/block/categoryItem.tpl', 1, false),array('block', 'header', 'custom:category/block/categoryItem.tpl', 2, false),array('block', 'content', 'custom:category/block/categoryItem.tpl', 4, false),array('block', 'footer', 'custom:category/block/categoryItem.tpl', 20, false),array('function', 'productUrl', 'custom:category/block/categoryItem.tpl', 10, false),array('function', 'categoryUrl', 'custom:category/block/categoryItem.tpl', 16, false),array('function', 'img', 'custom:category/block/categoryItem.tpl', 17, false),array('function', 'translate', 'custom:category/block/categoryItem.tpl', 37, false),array('modifier', 'truncate', 'custom:category/block/categoryItem.tpl', 10, false),array('modifier', 'config', 'custom:category/block/categoryItem.tpl', 15, false),array('modifier', 'escape', 'custom:category/block/categoryItem.tpl', 17, false),array('modifier', 'default', 'custom:category/block/categoryItem.tpl', 29, false),)), $this); ?>
<?php $this->_tag_stack[] = array('sect', array()); $_block_repeat=true;smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php $this->_tag_stack[] = array('header', array()); $_block_repeat=true;smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<div class="subCatImage">
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php $this->_tag_stack[] = array('content', array()); $_block_repeat=true;smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php if ($this->_tpl_vars['sub']['featuredProduct']['ID']): ?>
			<div class="categoryFeaturedProduct">
				<div class="price">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/productPrice.tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['sub']['featuredProduct'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
				<a href="<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['sub']['featuredProduct']), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['sub']['featuredProduct']['name_lang'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 25) : smarty_modifier_truncate($_tmp, 25)); ?>
</a>
				<?php if ($this->_tpl_vars['sub']['featuredProduct']['DefaultImage']['ID']): ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/smallImage.tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['sub']['featuredProduct'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>
			</div>
		<?php elseif ($this->_tpl_vars['sub']['DefaultImage']['paths']['1'] && ((is_array($_tmp='CAT_MENU_IMAGE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
			<a href="<?php echo smarty_function_categoryUrl(array('data' => $this->_tpl_vars['sub']), $this);?>
">
				<?php echo smarty_function_img(array('src' => $this->_tpl_vars['sub']['DefaultImage']['paths']['1'],'alt' => ((is_array($_tmp=$this->_tpl_vars['sub']['name_lang'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))), $this);?>

			</a>
		<?php endif; ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php $this->_tag_stack[] = array('footer', array()); $_block_repeat=true;smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<div class="details<?php if (($this->_foreach['subcats']['iteration']-1) < ( $this->_foreach['subcats']['total'] / 2 )): ?> verticalSep<?php endif; ?><?php if (! $this->_tpl_vars['sub']['subCategories']): ?> noSubCats<?php endif; ?>">
	<div class="subCatContainer">
		<div class="subCatContainer">
			<div class="subCatContainer">
				<div class="subCatName">
					<a href="<?php echo smarty_function_categoryUrl(array('data' => $this->_tpl_vars['sub'],'filters' => $this->_tpl_vars['filters']), $this);?>
"><?php echo $this->_tpl_vars['sub']['name_lang']; ?>
</a>
					<span class="count">(&rlm;<?php echo ((is_array($_tmp=@$this->_tpl_vars['sub']['searchCount'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['sub']['count']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['sub']['count'])); ?>
)</span>
				</div>

				<?php if ($this->_tpl_vars['sub']['subCategories']): ?>
				<ul class="subSubCats">
					<?php $_from = $this->_tpl_vars['sub']['subCategories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['subSub'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['subSub']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['subSub']):
        $this->_foreach['subSub']['iteration']++;
?>
						<?php if ($this->_foreach['subSub']['iteration'] > ((is_array($_tmp='CAT_MENU_SUBS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
							<li class="moreSubCats">
								<a href="<?php echo smarty_function_categoryUrl(array('data' => $this->_tpl_vars['sub'],'filters' => $this->_tpl_vars['filters']), $this);?>
"><?php echo smarty_function_translate(array('text' => '_more_subcats'), $this);?>
</a>
							</li>
							<?php break; ?>
						<?php endif; ?>
						<li>
							<a href="<?php echo smarty_function_categoryUrl(array('data' => $this->_tpl_vars['subSub']), $this);?>
"><?php echo $this->_tpl_vars['subSub']['name_lang']; ?>
</a>
							<span class="count">(&rlm;<?php echo $this->_tpl_vars['subSub']['count']; ?>
)</span>
						</li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
				<?php endif; ?>

				<?php if (((is_array($_tmp='CAT_MENU_DESCR')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
					<div class="subCatDescr">
						<?php echo $this->_tpl_vars['sub']['description_lang']; ?>

					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>