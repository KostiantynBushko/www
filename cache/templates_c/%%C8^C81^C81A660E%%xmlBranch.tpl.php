<?php /* Smarty version 2.6.26, created on 2015-12-02 13:45:50
         compiled from /home/illumin/public_html/application/view///backend/category/xmlBranch.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/category/xmlBranch.tpl', 6, false),)), $this); ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="UTF-8"<?php echo '?>'; ?>

<tree id="<?php echo $this->_tpl_vars['rootID']; ?>
">
	<?php $_from = $this->_tpl_vars['categoryList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
	<item child="<?php echo $this->_tpl_vars['category']['childrenCount']; ?>
" id="<?php echo $this->_tpl_vars['category']['ID']; ?>
" text="<?php echo ((is_array($_tmp=$this->_tpl_vars['category']['name_lang'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"<?php if (! $this->_tpl_vars['category']['isEnabled']): ?> style="color: #999;"<?php endif; ?>></item>
	<?php endforeach; endif; unset($_from); ?>
</tree>