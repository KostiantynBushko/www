<?php /* Smarty version 2.6.26, created on 2015-12-01 10:57:43
         compiled from custom:backend/report/intervalSelect.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/report/intervalSelect.tpl', 3, false),)), $this); ?>
<?php if ($this->_tpl_vars['chartType'] < 2): ?>
	<div class="intervalSelector">
		<span><?php echo smarty_function_translate(array('text' => '_interval'), $this);?>
:</span>
		<select class="intervalSelect">
			<option value="day"><?php echo smarty_function_translate(array('text' => '_daily'), $this);?>
</option>
			<option value="month"><?php echo smarty_function_translate(array('text' => '_monthly'), $this);?>
</option>
			<option value="year"><?php echo smarty_function_translate(array('text' => '_yearly'), $this);?>
</option>
			<option value="hour"><?php echo smarty_function_translate(array('text' => '_hourly'), $this);?>
</option>
			<option value="week"><?php echo smarty_function_translate(array('text' => '_weekly'), $this);?>
</option>
		</select>
	</div>
<?php endif; ?>