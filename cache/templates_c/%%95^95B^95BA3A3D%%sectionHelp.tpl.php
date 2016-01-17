<?php /* Smarty version 2.6.26, created on 2015-12-01 10:56:40
         compiled from custom:backend/settings/sectionHelp.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'explode', 'custom:backend/settings/sectionHelp.tpl', 1, false),array('modifier', 'default', 'custom:backend/settings/sectionHelp.tpl', 2, false),array('function', 'translate', 'custom:backend/settings/sectionHelp.tpl', 3, false),)), $this); ?>
<?php $this->assign('key', ((is_array($_tmp="-")) ? $this->_run_mod_handler('explode', true, $_tmp, $this->_tpl_vars['key']) : explode($_tmp, $this->_tpl_vars['key']))); ?>
<?php $this->assign('key', ((is_array($_tmp=@$this->_tpl_vars['key'][1])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['key'][0]) : smarty_modifier_default($_tmp, @$this->_tpl_vars['key'][0]))); ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => ($this->_tpl_vars['key'])."_help",'eval' => true,'noDefault' => true), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('hlp', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['hlp']): ?>
	<div class="sectionHelp">
		<?php echo $this->_tpl_vars['hlp']; ?>

	</div>
<?php endif; ?>