<?php /* Smarty version 2.6.26, created on 2015-12-01 10:57:43
         compiled from /home/illumin/public_html/application/view///backend/report/sales.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///backend/report/sales.tpl', 1, false),)), $this); ?>
<h1><?php echo smarty_function_translate(array('text' => '_sales'), $this);?>
</h1>

<div class="chartMenu" id="menu_sales">
	<div class="typeSelector">
		<a href="#" id="number_orders"><?php echo smarty_function_translate(array('text' => '_num_orders'), $this);?>
</a> | <a id="total_orders" href="#"><?php echo smarty_function_translate(array('text' => '_order_totals'), $this);?>
</a> | <a id="number_items" href="#"><?php echo smarty_function_translate(array('text' => '_items_sold'), $this);?>
</a> |
		<select class="moreTypes">
			<option value=""><?php echo smarty_function_translate(array('text' => '_more_reports'), $this);?>
</option>
			<option value="avg_total"><?php echo smarty_function_translate(array('text' => '_avg_order_total'), $this);?>
</option>
			<option value="avg_items"><?php echo smarty_function_translate(array('text' => '_avg_items_per_order'), $this);?>
</option>
			<option value="payment_methods"><?php echo smarty_function_translate(array('text' => '_payment_methods'), $this);?>
</option>
			<option value="currencies"><?php echo smarty_function_translate(array('text' => '_currencies'), $this);?>
</option>
			<option value="status"><?php echo smarty_function_translate(array('text' => '_statuses'), $this);?>
</option>
			<option value="cancelled"><?php echo smarty_function_translate(array('text' => '_cancelled_ratio'), $this);?>
</option>
			<option value="unpaid"><?php echo smarty_function_translate(array('text' => '_unpaid_ratio'), $this);?>
</option>
		</select>
	</div>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/report/intervalSelect.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<div class="clear"></div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/report/chart.tpl", 'smarty_include_vars' => array('activeMenu' => $this->_tpl_vars['type'],'width' => "100%")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>