<?php /* Smarty version 2.6.26, created on 2015-12-01 10:57:57
         compiled from custom:backend/eav/includes.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeJs', 'custom:backend/eav/includes.tpl', 2, false),array('function', 'includeCss', 'custom:backend/eav/includes.tpl', 6, false),)), $this); ?>
<?php echo smarty_function_includeJs(array('file' => "library/dhtmlCalendar/calendar.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlCalendar/lang/calendar-en.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlCalendar/lang/calendar-".($this->_tpl_vars['curLanguageCode']).".js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlCalendar/calendar-setup.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/dhtmlCalendar/calendar-win2k-cold-2.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "library/prototype/prototype.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/livecart.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/Validator.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/ActiveForm.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/State.js"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "backend/Eav.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/Eav.css"), $this);?>
