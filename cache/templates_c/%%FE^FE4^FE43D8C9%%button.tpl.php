<?php /* Smarty version 2.6.26, created on 2015-12-01 11:07:23
         compiled from custom:module/store-cloning/mirror/button.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:module/store-cloning/mirror/button.tpl', 1, false),)), $this); ?>
<?php if ($this->_tpl_vars['product']['hasMirror'] && ((is_array($_tmp='ENABLE_VIRTUAL_MIRROR')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
	<a href="#" value="Try On" id="try-on" onclick="showMirror(<?php echo $this->_tpl_vars['product']['ID']; ?>
, event)" style="position: relative; top: -2px;"><img src="upload/theme/IlluminataV3/tryon.jpg"></a>
<?php endif; ?>