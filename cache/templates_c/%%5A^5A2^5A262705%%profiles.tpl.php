<?php /* Smarty version 2.6.26, created on 2015-12-01 16:51:53
         compiled from custom:backend/csvImport/profiles.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/csvImport/profiles.tpl', 2, false),array('function', 'selectfield', 'custom:backend/csvImport/profiles.tpl', 3, false),)), $this); ?>
<div>
	<label><?php echo smarty_function_translate(array('text' => '_use_profile'), $this);?>
</label>
	<?php echo smarty_function_selectfield(array('id' => 'profile','options' => $this->_tpl_vars['profiles']), $this);?>

	<span class="delete" id="deleteProfile">&nbsp;</span>
</div>