<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from custom:order/itemProductInfo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', 'custom:order/itemProductInfo.tpl', 3, false),array('function', 'productUrl', 'custom:order/itemProductInfo.tpl', 5, false),array('block', 'sect', 'custom:order/itemProductInfo.tpl', 19, false),array('block', 'header', 'custom:order/itemProductInfo.tpl', 20, false),array('block', 'content', 'custom:order/itemProductInfo.tpl', 23, false),array('block', 'footer', 'custom:order/itemProductInfo.tpl', 33, false),)), $this); ?>
<?php if ($this->_tpl_vars['item']['Product']['ID']): ?>
	<?php if ($this->_tpl_vars['item']['Product']['isDownloadable'] && $this->_tpl_vars['downloadLinks']): ?>
		<a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'item','id' => $this->_tpl_vars['item']['ID']), $this);?>
"><?php echo $this->_tpl_vars['item']['Product']['name_lang']; ?>
</a>
	<?php else: ?>
		<a href="<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['item']['Product']), $this);?>
"><?php echo $this->_tpl_vars['item']['Product']['name_lang']; ?>
</a>
	<?php endif; ?>
<?php else: ?>
	<span><?php echo $this->_tpl_vars['item']['Product']['name_lang']; ?>
</span>
<?php endif; ?>

<?php if ($this->_tpl_vars['item']['Product']['variations']): ?>
	<span class="variations">
		(&rlm;<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/itemVariationsList.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>)
	</span>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/itemOptions.tpl", 'smarty_include_vars' => array('options' => $this->_tpl_vars['item']['options'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->_tag_stack[] = array('sect', array()); $_block_repeat=true;smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php $this->_tag_stack[] = array('header', array()); $_block_repeat=true;smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<ul class="subItemList">
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php $this->_tag_stack[] = array('content', array()); $_block_repeat=true;smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_from = $this->_tpl_vars['item']['subItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subItem']):
?>
			<?php if ($this->_tpl_vars['subItem']['Product']['isDownloadable']): ?>
				<li>
					<a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'item','id' => $this->_tpl_vars['subItem']['ID']), $this);?>
"><?php echo $this->_tpl_vars['subItem']['Product']['name_lang']; ?>
</a>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/itemOptions.tpl", 'smarty_include_vars' => array('options' => $this->_tpl_vars['subItem']['options'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</li>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php $this->_tag_stack[] = array('footer', array()); $_block_repeat=true;smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		</ul>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>