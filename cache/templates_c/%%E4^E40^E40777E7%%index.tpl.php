<?php /* Smarty version 2.6.26, created on 2015-12-01 10:53:47
         compiled from /home/illumin/public_html/application/view///backend/index/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/index/index.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/index/index.tpl', 1, false),array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/index/index.tpl', 3, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/index/index.tpl', 11, false),array('function', 'maketext', '/home/illumin/public_html/application/view///backend/index/index.tpl', 12, false),array('function', 'zebra', '/home/illumin/public_html/application/view///backend/index/index.tpl', 58, false),array('function', 'backendOrderUrl', '/home/illumin/public_html/application/view///backend/index/index.tpl', 59, false),array('modifier', 'branding', '/home/illumin/public_html/application/view///backend/index/index.tpl', 1, false),array('modifier', 'strtolower', '/home/illumin/public_html/application/view///backend/index/index.tpl', 25, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/index/index.tpl', 59, false),)), $this); ?>
<?php $this->_tag_stack[] = array('pageTitle', array('help' => "")); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_livecart_backend'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__livecart_backend', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__livecart_backend'])) ? $this->_run_mod_handler('branding', true, $_tmp) : $this->_plugins['modifier']['branding'][0][0]->branding($_tmp)); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php echo smarty_function_includeCss(array('file' => "backend/Index.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/User.css"), $this);?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<fieldset>
	<legend><?php echo smarty_function_translate(array('text' => '_order_overview'), $this);?>
</legend>
	<span class="orderPeriod">
	<select id="period" onchange="$('count').innerHTML = ''; new LiveCart.AjaxUpdater('<?php echo smarty_function_link(array('controller' => "backend.index",'action' => 'totalOrders'), $this);?>
?period=' + this.value, $('count'), $('periodProgress'));">
				<option value="-1 hours | now" selected="selected"><?php echo smarty_function_maketext(array('text' => '_last_hours','params' => 1), $this);?>
</option>
				<option value="-3 hours | now" selected="selected"><?php echo smarty_function_maketext(array('text' => '_last_hours','params' => 3), $this);?>
</option>
				<option value="-6 hours | now" selected="selected"><?php echo smarty_function_maketext(array('text' => '_last_hours','params' => 6), $this);?>
</option>
				<option value="-12 hours | now" selected="selected"><?php echo smarty_function_maketext(array('text' => '_last_hours','params' => 12), $this);?>
</option>
				<option value="-24 hours | now" selected="selected"><?php echo smarty_function_maketext(array('text' => '_last_hours','params' => 24), $this);?>
</option>
				<option value="-3 days | now"><?php echo smarty_function_maketext(array('text' => '_last_days','params' => 3), $this);?>
</option>
				<option value="w:Monday ~ -1 week | w:Monday"><?php echo smarty_function_translate(array('text' => '_last_week'), $this);?>
</option>
				<option value="January 1 | now"><?php echo smarty_function_translate(array('text' => '_this_year'), $this);?>
</option>
				<option value="January 1 last year | January 1"><?php echo smarty_function_translate(array('text' => '_last_year'), $this);?>
</option>
			</select>:
			<label class="checkbox"><span class="progressIndicator" style="display: none;" id="periodProgress"></span></label>
			<label class="periodCount" id="count"><?php echo $this->_tpl_vars['orderCount']['last']; ?>
</label><span class="sep"> | </span>

	<span class="orderPeriod"><?php echo strtolower(smarty_function_translate(array('text' => '_this_week'), $this));?>
:</span> <span class="periodCount"><?php echo $this->_tpl_vars['ordersThisWeek']; ?>
</span><span class="sep"> | </span>
	<span class="orderPeriod"><?php echo strtolower(smarty_function_translate(array('text' => '_this_month'), $this));?>
:</span> <span class="periodCount"><?php echo $this->_tpl_vars['ordersThisMonth']; ?>
</span><span class="sep"> | </span>
	<span class="orderPeriod"><?php echo strtolower(smarty_function_translate(array('text' => '_last_month'), $this));?>
:</span> <span class="periodCount"><?php echo $this->_tpl_vars['ordersLastMonth']; ?>
</span><span class="sep"> | </span>

	<span class="orderStat"><a href="<?php echo smarty_function_link(array('controller' => "backend.customerOrder"), $this);?>
#group_3#tabOrders__"><?php echo smarty_function_translate(array('text' => '_status_new'), $this);?>
</a>:</span>
	<span class="statCount"><?php echo $this->_tpl_vars['orderCount']['new']; ?>
</span>
	<span class="sep"> | </span>

	<span class="orderStat"><a href="<?php echo smarty_function_link(array('controller' => "backend.customerOrder"), $this);?>
#group_4#tabOrders__"><?php echo smarty_function_translate(array('text' => '_status_processing'), $this);?>
</a>:</span>
	<span class="statCount"><?php echo $this->_tpl_vars['orderCount']['processing']; ?>
</span>
	<span class="sep"> | </span>

	<span class="orderStat"><?php echo smarty_function_translate(array('text' => '_unread_msg'), $this);?>
:</span>
	<span class="statCount"><?php echo $this->_tpl_vars['orderCount']['messages']; ?>
</span>

</fieldset>

<?php if ($this->_tpl_vars['lastOrders']): ?>
<fieldset class="dashboardOrders stats">
	<legend><?php echo smarty_function_translate(array('text' => '_last_orders'), $this);?>
</legend>
	<div class="quickEditContainer3">
		<?php if ($this->_tpl_vars['lastOrders']): ?>
			<table class="qeOrders">
				<thead>
					<tr>
						<th><?php echo smarty_function_translate(array('text' => '_invoice_number'), $this);?>
</th>
						<th><?php echo smarty_function_translate(array('text' => '_date'), $this);?>
</th>
						<th><?php echo smarty_function_translate(array('text' => '_ammount'), $this);?>
</th>
						<th><?php echo smarty_function_translate(array('text' => '_status'), $this);?>
</th>
					</tr>
				</thead>
				<tbody>
					<?php $_from = $this->_tpl_vars['lastOrders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['lastOrders'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['lastOrders']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['order']):
        $this->_foreach['lastOrders']['iteration']++;
?>
						<tr class="<?php echo smarty_function_zebra(array('loop' => 'lastOrders'), $this);?>
">
							<td><a href="<?php echo smarty_function_backendOrderUrl(array('order' => $this->_tpl_vars['order']), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['order']['invoiceNumber'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></td>
							<td title="<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['formatted_dateCreated']['date_medium'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['order']['formatted_dateCreated']['time_short'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['order']['formatted_dateCreated']['date_short'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
							<td><?php echo ((is_array($_tmp=$this->_tpl_vars['order']['formatted_totalAmount'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
							<td><?php echo smarty_function_translate(array('text' => ($this->_tpl_vars['order']['status_name'])), $this);?>
</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
</fieldset>
<?php endif; ?>

<fieldset class="stats">
	<legend><?php echo smarty_function_translate(array('text' => '_inventory'), $this);?>
</legend>

	<form>
		<p>
			<label><?php echo smarty_function_translate(array('text' => '_low_stock'), $this);?>
:</label>
			<label><?php echo $this->_tpl_vars['inventoryCount']['lowStock']; ?>
</label>
		</p>

		<p>
			<label><?php echo smarty_function_translate(array('text' => '_out_stock'), $this);?>
:</label>
			<label><?php echo $this->_tpl_vars['inventoryCount']['outOfStock']; ?>
</label>
		</p>
	</form>
</fieldset>

<fieldset class="stats">
	<legend><?php echo smarty_function_translate(array('text' => '_overall'), $this);?>
</legend>

	<form>
		<p>
			<label><?php echo smarty_function_translate(array('text' => '_active_pr'), $this);?>
:</label>
			<label><?php echo $this->_tpl_vars['rootCat']['activeProductCount']; ?>
</label>
		</p>

		<p>
			<label><?php echo smarty_function_translate(array('text' => '_inactive_pr'), $this);?>
:</label>
			<label><?php echo $this->_tpl_vars['rootCat']['inactiveProductCount']; ?>
</label>
		</p>

		<p>
			<label><?php echo smarty_function_translate(array('text' => '_total_orders'), $this);?>
:</label>
			<label><?php echo $this->_tpl_vars['orderCount']['total']; ?>
</label>
		</p>

	</form>
</fieldset>

<div class="clear"></div>

<?php ob_start(); ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/index/tips.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('tips', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['tips'])) ? $this->_run_mod_handler('branding', true, $_tmp) : $this->_plugins['modifier']['branding'][0][0]->branding($_tmp)); ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>