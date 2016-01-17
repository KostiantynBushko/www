<?php /* Smarty version 2.6.26, created on 2015-12-01 16:51:06
         compiled from custom:backend/csvImport/wizardProgress.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/csvImport/wizardProgress.tpl', 2, false),)), $this); ?>
<ul id="wizardProgress" class="wizardProgress <?php echo $this->_tpl_vars['class']; ?>
">
	<li id="progressSelect"><?php echo smarty_function_translate(array('text' => '_select_file'), $this);?>
</li>
	<li id="progressDelimiters"><?php echo smarty_function_translate(array('text' => '_delimiters'), $this);?>
</li>
	<li id="progressArrange"><?php echo smarty_function_translate(array('text' => '_arrange'), $this);?>
</li>
	<li id="progressImport"><?php echo smarty_function_translate(array('text' => '_import'), $this);?>
</li>
	<div class="clear"></div>
</ul>
<div class="clear"></div>