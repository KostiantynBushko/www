<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from custom:order/fieldValues.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'sect', 'custom:order/fieldValues.tpl', 1, false),array('block', 'header', 'custom:order/fieldValues.tpl', 2, false),array('block', 'content', 'custom:order/fieldValues.tpl', 5, false),array('block', 'footer', 'custom:order/fieldValues.tpl', 15, false),)), $this); ?>
<?php $this->_tag_stack[] = array('sect', array()); $_block_repeat=true;smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php $this->_tag_stack[] = array('header', array()); $_block_repeat=true;smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<form class="eavAttributes">
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php $this->_tag_stack[] = array('content', array()); $_block_repeat=true;smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_from = $this->_tpl_vars['order']['attributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attr']):
?>
			<?php if ($this->_tpl_vars['attr']['EavField']['isDisplayedInList'] && ( $this->_tpl_vars['attr']['values'] || $this->_tpl_vars['attr']['value'] || $this->_tpl_vars['attr']['value_lang'] )): ?>
				<p>
					<label class="attrName"><?php echo $this->_tpl_vars['attr']['EavField']['name_lang']; ?>
:</label>
					<label class="attrValue"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/attributeValue.tpl", 'smarty_include_vars' => array('attr' => $this->_tpl_vars['attr'],'field' => 'EavField')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></label>
				</p>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php $this->_tag_stack[] = array('footer', array()); $_block_repeat=true;smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		</form>
		<div class="clear"></div>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>