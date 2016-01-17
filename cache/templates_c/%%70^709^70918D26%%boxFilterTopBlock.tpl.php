<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:45
         compiled from /home/illumin/public_html/application/view//category/boxFilterTopBlock.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadJs', '/home/illumin/public_html/application/view//category/boxFilterTopBlock.tpl', 1, false),array('function', 'uniqid', '/home/illumin/public_html/application/view//category/boxFilterTopBlock.tpl', 3, false),array('function', 'categoryUrl', '/home/illumin/public_html/application/view//category/boxFilterTopBlock.tpl', 4, false),array('function', 'translate', '/home/illumin/public_html/application/view//category/boxFilterTopBlock.tpl', 23, false),array('block', 'sect', '/home/illumin/public_html/application/view//category/boxFilterTopBlock.tpl', 2, false),array('block', 'header', '/home/illumin/public_html/application/view//category/boxFilterTopBlock.tpl', 2, false),array('block', 'content', '/home/illumin/public_html/application/view//category/boxFilterTopBlock.tpl', 5, false),array('block', 'footer', '/home/illumin/public_html/application/view//category/boxFilterTopBlock.tpl', 21, false),array('modifier', 'config', '/home/illumin/public_html/application/view//category/boxFilterTopBlock.tpl', 7, false),array('modifier', 'escape', '/home/illumin/public_html/application/view//category/boxFilterTopBlock.tpl', 23, false),)), $this); ?>
<?php echo smarty_function_loadJs(array(), $this);?>

<?php $this->_tag_stack[] = array('sect', array()); $_block_repeat=true;smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $this->_tag_stack[] = array('header', array()); $_block_repeat=true;smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div class="filterTop" id="filterTop_<?php echo smarty_function_uniqid(array(), $this);?>
">
<form action="<?php echo smarty_function_categoryUrl(array('data' => $this->_tpl_vars['category'],'filters' => $this->_tpl_vars['filters']), $this);?>
" method="post" id="<?php echo smarty_function_uniqid(array('last' => true), $this);?>
">
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php $this->_tag_stack[] = array('content', array()); $_block_repeat=true;smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

	<?php if (((is_array($_tmp='TOP_FILTER_PRICE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/block/filterSelect.tpl", 'smarty_include_vars' => array('sectionFilters' => $this->_tpl_vars['priceGroup'],'title' => '_by_price')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<?php if (((is_array($_tmp='TOP_FILTER_MANUFACTURER')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/block/filterSelect.tpl", 'smarty_include_vars' => array('sectionFilters' => $this->_tpl_vars['manGroup'],'title' => '_by_brand')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
		<?php if ($this->_tpl_vars['group']['displayLocation'] == 1): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/block/filterSelect.tpl", 'smarty_include_vars' => array('sectionFilters' => $this->_tpl_vars['group'],'title' => $this->_tpl_vars['group']['name_lang'],'allLink' => $this->_tpl_vars['group']['more'],'allTitle' => '_show_all')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php $this->_tag_stack[] = array('footer', array()); $_block_repeat=true;smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if (! ((is_array($_tmp='TOP_FILTER_RELOAD')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
	<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_search','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
<?php endif; ?>
</form>
</div>

<script type="text/javascript">
	var filters = new Filter.SelectorMenu($("filterTop_<?php echo smarty_function_uniqid(array('last' => true), $this);?>
"), <?php echo ((is_array($_tmp='TOP_FILTER_RELOAD')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
);
</script>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>