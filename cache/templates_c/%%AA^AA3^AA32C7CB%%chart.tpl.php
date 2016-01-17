<?php /* Smarty version 2.6.26, created on 2015-12-01 10:57:43
         compiled from custom:backend/report/chart.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'custom:backend/report/chart.tpl', 5, false),)), $this); ?>
<script type="text/javascript">
	window.report.setActiveMenu('<?php echo $this->_tpl_vars['activeMenu']; ?>
');
	window.report.setData(<?php echo $this->_tpl_vars['chart']; ?>
);
	<?php if ($this->_tpl_vars['chartType'] < 100): ?>
		swfobject.embedSWF("javascript/library/openFlashChart/open-flash-chart.swf", "flashChart", "<?php echo ((is_array($_tmp=@$this->_tpl_vars['width'])) ? $this->_run_mod_handler('default', true, $_tmp, 700) : smarty_modifier_default($_tmp, 700)); ?>
", "<?php echo ((is_array($_tmp=@$this->_tpl_vars['height'])) ? $this->_run_mod_handler('default', true, $_tmp, 400) : smarty_modifier_default($_tmp, 400)); ?>
", "9.0.0");
	<?php endif; ?>
</script>

<?php if (( $this->_tpl_vars['chartType'] > 100 ) && $this->_tpl_vars['reportData']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/report/table.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<div id="flashChart"></div>