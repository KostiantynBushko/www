<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:45
         compiled from custom:category/block/switchListLayout.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:category/block/switchListLayout.tpl', 1, false),array('modifier', 'count', 'custom:category/block/switchListLayout.tpl', 2, false),array('modifier', 'escape', 'custom:category/block/switchListLayout.tpl', 5, false),array('function', 'translate', 'custom:category/block/switchListLayout.tpl', 5, false),)), $this); ?>
<?php $this->assign('layouts', ((is_array($_tmp='ENABLED_LIST_LAYOUTS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))); ?>
<?php if ($this->_plugins['modifier']['config'][0][0]->config('ALLOW_SWITCH_LAYOUT') && ( count($this->_tpl_vars['layouts']) > 1 )): ?>
	<div class="categoryLayoutSwitch">
		<?php if ($this->_tpl_vars['layouts']['LIST']): ?>
			<a class="layoutSetList <?php if ($this->_tpl_vars['layout'] == 'LIST'): ?>active<?php endif; ?>" href="<?php echo $this->_tpl_vars['layoutUrl']; ?>
list" title="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_view_as_list','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
"></a>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['layouts']['GRID']): ?>
			<a class="layoutSetGrid <?php if ($this->_tpl_vars['layout'] == 'GRID'): ?>active<?php endif; ?>" href="<?php echo $this->_tpl_vars['layoutUrl']; ?>
grid" title="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_view_as_grid','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
"></a>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['layouts']['TABLE']): ?>
			<a class="layoutSetTable <?php if ($this->_tpl_vars['layout'] == 'TABLE'): ?>active<?php endif; ?>" href="<?php echo $this->_tpl_vars['layoutUrl']; ?>
table" title="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_view_as_table','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
"></a>
		<?php endif; ?>
	</div>
<?php endif; ?>