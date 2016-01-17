<?php /* Smarty version 2.6.26, created on 2015-12-01 10:57:40
         compiled from /home/illumin/public_html/application/view///backend/report/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeJs', '/home/illumin/public_html/application/view///backend/report/index.tpl', 1, false),array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/report/index.tpl', 6, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/report/index.tpl', 8, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/report/index.tpl', 15, false),array('function', 'renderBlock', '/home/illumin/public_html/application/view///backend/report/index.tpl', 41, false),array('function', 'maketext', '/home/illumin/public_html/application/view///backend/report/index.tpl', 43, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/report/index.tpl', 8, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/report/index.tpl', 45, false),)), $this); ?>
<?php echo smarty_function_includeJs(array('file' => "library/form/Validator.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/ActiveForm.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/Report.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/openFlashChart/js/swfobject.js"), $this);?>


<?php echo smarty_function_includeCss(array('file' => "backend/Report.css"), $this);?>


<?php $this->_tag_stack[] = array('pageTitle', array('help' => "content.pages")); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_reports'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="staticPageContainer">
	<div class="treeContainer">
		<ul class="verticalMenu" id="reportTypeSelector">
			<li id="menuSales">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.report",'action' => 'sales'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_sales'), $this);?>
</a>
			</li>
			<li id="menuBest">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.report",'action' => 'bestsellers'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_bestsellers'), $this);?>
</a>
			</li>
			<li id="menuCarts">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.report",'action' => 'conversion'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_conversion'), $this);?>
</a>
			</li>
			<li id="menuCustomers">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.report",'action' => 'customers'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_customers'), $this);?>
</a>
			</li>
			<li id="menuSearch">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.report",'action' => 'search'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_search'), $this);?>
</a>
			</li>
					</ul>

	</div>

	<div class="treeManagerContainer maxHeight h--100">
		<div id="reportDateRange">
			Report period:
			<?php echo smarty_function_renderBlock(array('block' => "backend.components/DATE_RANGE_SELECTOR",'class' => 'reportDateSelector'), $this);?>

			<select class="reportDateSelector">
				<option value="-30 days | now"><?php echo smarty_function_maketext(array('text' => '_last_days','params' => 30), $this);?>
</option>
				<option value="-24 hours | now"><?php echo smarty_function_maketext(array('text' => '_last_hours','params' => 24), $this);?>
</option>
				<option value="today | now"><?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_today','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
</option>
				<option value="yesterday | today"><?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_yesterday','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
</option>
				<option value="-7 days | now"><?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_last_7_days','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
</option>
				<option value="<?php echo $this->_tpl_vars['thisMonth']; ?>
/1 | now"><?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_this_month','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
</option>
				<option value="<?php echo $this->_tpl_vars['lastMonth']; ?>
-1 | <?php echo $this->_tpl_vars['thisMonth']; ?>
/1"><?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_last_month','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
</option>
				<option value="January 1 | now"><?php echo smarty_function_translate(array('text' => '_this_year'), $this);?>
</option>
				<option value="all"><?php echo smarty_function_translate(array('text' => '_all_time'), $this);?>
</option>
				<?php ob_start(); ?><?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_grid_date_range','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?>			</select>
		</div>

		<div id="reportIndicator" style="display: none;">
			<span class="progressIndicator"></span> Loading report
		</div>

		<div id="reportContent" class="maxHeight">

		</div>
	</div>
</div>

<script type="text/javascript">
	window.report = new Backend.Report.Controller();
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>