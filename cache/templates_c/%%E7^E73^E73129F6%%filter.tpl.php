<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:33
         compiled from /home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/filter.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/filter.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/filter.tpl', 13, false),array('function', 'categoryUrl', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/filter.tpl', 20, false),array('block', 'sect', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/filter.tpl', 27, false),array('block', 'header', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/filter.tpl', 27, false),array('block', 'content', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/filter.tpl', 34, false),array('block', 'footer', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/filter.tpl', 63, false),)), $this); ?>
<?php $this->assign('FILTER_STYLE', ((is_array($_tmp='FILTER_STYLE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))); ?>

<?php if ('FILTER_STYLE_CHECKBOXES' == $this->_tpl_vars['FILTER_STYLE']): ?>
	<?php $this->assign('FILTER_STYLE_TEMPLATE', 'category/block/filterCheckboxes.tpl'); ?>
	<?php echo '<script type="text/javascript">var _checkboxFilterLoadHookObserved = false;</script>'; ?>

<?php else: ?>
	<?php $this->assign('FILTER_STYLE_TEMPLATE', 'category/block/filterLinks.tpl'); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['filters'] && $this->_tpl_vars['FILTER_STYLE'] == 'FILTER_STYLE_LINKS'): ?>
	<div class="box expandResults">
		<div class="title">
			<div><?php echo smarty_function_translate(array('text' => '_expand'), $this);?>
</div>
		</div>

		<div class="content filterGroup">
			<h4><?php echo smarty_function_translate(array('text' => '_remove_filter'), $this);?>
:</h4>
			<ul>
			<?php $_from = $this->_tpl_vars['filters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['filter']):
?>
				<li><a href="<?php echo smarty_function_categoryUrl(array('data' => $this->_tpl_vars['category'],'filters' => $this->_tpl_vars['filters'],'removeFilter' => $this->_tpl_vars['filter']), $this);?>
"><?php echo $this->_tpl_vars['filter']['filterGroup']['name_lang']; ?>
 <?php echo $this->_tpl_vars['filter']['name_lang']; ?>
</a></li>
			<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
	</div>
<?php endif; ?>

<?php $this->_tag_stack[] = array('sect', array()); $_block_repeat=true;smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $this->_tag_stack[] = array('header', array()); $_block_repeat=true;smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div class="box narrowResults" style="border-left: 1px solid #ebebeb; border-right: 1px solid #ebebeb;">
	<div class="title">
		<div><?php echo smarty_function_translate(array('text' => '_narrow_results'), $this);?>
</div>
	</div>

	<div class="content">
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php $this->_tag_stack[] = array('content', array()); $_block_repeat=true;smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

	<?php if ('FILTER_STYLE_CHECKBOXES' == $this->_tpl_vars['FILTER_STYLE']): ?>
		<form id='multipleChoiceFilterForm' action="<?php echo smarty_function_categoryUrl(array('data' => $this->_tpl_vars['category']), $this);?>
" method="post">

		<div id="multipleChoiceFilter_top" class="hidden">
			<input type="submit" value="<?php echo smarty_function_translate(array('text' => '_filter'), $this);?>
" />
			<a href="javascript:void(0);" onclick="Filter.reset();" class="cancel"><?php echo smarty_function_translate(array('text' => '_clear'), $this);?>
</a>
		</div>
		
	<?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['FILTER_STYLE_TEMPLATE'], 'smarty_include_vars' => array('sectionFilters' => $this->_tpl_vars['manGroup'],'title' => '_by_brand','allLink' => $this->_tpl_vars['allManufacturers'],'allTitle' => '_show_all_brands')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['FILTER_STYLE_TEMPLATE'], 'smarty_include_vars' => array('sectionFilters' => $this->_tpl_vars['priceGroup'],'title' => '_by_price')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
			<?php if ($this->_tpl_vars['group']['displayLocation'] == 0): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['FILTER_STYLE_TEMPLATE'], 'smarty_include_vars' => array('sectionFilters' => $this->_tpl_vars['group'],'title' => $this->_tpl_vars['group']['name_lang'],'allLink' => $this->_tpl_vars['group']['more'],'allTitle' => '_show_all')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

	<?php if ('FILTER_STYLE_CHECKBOXES' == $this->_tpl_vars['FILTER_STYLE']): ?>
	
		<div id="multipleChoiceFilter_bottom" class="hidden">
			<input type="submit" value="<?php echo smarty_function_translate(array('text' => '_filter'), $this);?>
" />
			<a href="javascript:void(0);" onclick="Filter.reset();" class="cancel"><?php echo smarty_function_translate(array('text' => '_clear'), $this);?>
</a>
		</div>
		</form>
	<?php endif; ?>
	
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php $this->_tag_stack[] = array('footer', array()); $_block_repeat=true;smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	</div>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>