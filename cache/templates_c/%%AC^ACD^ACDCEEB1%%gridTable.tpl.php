<?php /* Smarty version 2.6.26, created on 2015-12-01 12:14:49
         compiled from block/activeGrid/gridTable.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'block/activeGrid/gridTable.tpl', 7, false),array('function', 'link', 'block/activeGrid/gridTable.tpl', 35, false),array('function', 'img', 'block/activeGrid/gridTable.tpl', 70, false),array('function', 'calendar', 'block/activeGrid/gridTable.tpl', 132, false),array('function', 'json', 'block/activeGrid/gridTable.tpl', 220, false),array('block', 'denied', 'block/activeGrid/gridTable.tpl', 45, false),array('modifier', 'replace', 'block/activeGrid/gridTable.tpl', 54, false),array('modifier', 'escape', 'block/activeGrid/gridTable.tpl', 61, false),array('modifier', 'config', 'block/activeGrid/gridTable.tpl', 225, false),)), $this); ?>
<?php $this->assign('advancedSearch', true); ?>

<fieldset class="container activeGridControls">
	<?php if ($this->_tpl_vars['advancedSearch']): ?>
		<div id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_AdvancedSearch" class="activeGridAdvancedSearch">
			<a href="javascript:void(0);" class="cancel advancedSearchLink">
				<?php echo smarty_function_translate(array('text' => '_advanced_search'), $this);?>

			</a>
			<div id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_QueryContainer" class="advancedSearchQueryContainer">
				<ul class="advancedQueryItems">
				</ul>
			</div>
		</div>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['massAction']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['massAction'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</fieldset>

<div style="position: relative;">
	<div style="display: none;" class="activeGrid_loadIndicator" id="<?php echo $this->_tpl_vars['prefix']; ?>
LoadIndicator_<?php echo $this->_tpl_vars['id']; ?>
">
		<div>
			<?php echo smarty_function_translate(array('text' => '_loading'), $this);?>
<span class="progressIndicator"></span>
		</div>
	</div>

	<div class="activeGrid_massActionProgress" id="<?php echo $this->_tpl_vars['prefix']; ?>
MassActionProgress_<?php echo $this->_tpl_vars['id']; ?>
" style="display: none;">
		<fieldset class="container">
			<div class="progressBarIndicator"></div>
			<div class="progressBar">
				<span class="progressCount"></span>
				<span class="progressSeparator"> / </span>
				<span class="progressTotal"></span>
			</div>
			<a class="cancel" href="<?php echo smarty_function_link(array('controller' => $this->_tpl_vars['controller'],'action' => 'isMassCancelled'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
		</fieldset>
	</div>
</div>

<div class="activeGridContainer">

<div class="activeGridCellContent" style="display: none; position:absolute;"></div>

<div class="quickEditContainer"></div>
<table class="activeGrid <?php echo $this->_tpl_vars['prefix']; ?>
List <?php $this->_tag_stack[] = array('denied', array('role' => $this->_tpl_vars['role'])); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonlyGrid<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
">

<thead>
	<tr class="headRow">

		<th class="cell_cb"><input type="checkbox" class="checkbox" /></th>

		<?php $_from = $this->_tpl_vars['displayedColumns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['columns'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['columns']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['column'] => $this->_tpl_vars['type']):
        $this->_foreach['columns']['iteration']++;
?>
			<?php if (! ($this->_foreach['columns']['iteration'] <= 1)): ?>
				<th class="first cellt_<?php echo $this->_tpl_vars['type']; ?>
 cell_<?php echo ((is_array($_tmp=$this->_tpl_vars['column'])) ? $this->_run_mod_handler('replace', true, $_tmp, '.', '_') : smarty_modifier_replace($_tmp, '.', '_')); ?>
">
					<div style="position: relative;">
					<span class="fieldName"><?php echo $this->_tpl_vars['column']; ?>
</span>

					<?php if ('bool' == $this->_tpl_vars['type']): ?>

						<select id="filter_<?php echo $this->_tpl_vars['column']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
">
							<option value=""><?php echo ((is_array($_tmp=$this->_tpl_vars['availableColumns'][$this->_tpl_vars['column']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</option>
							<option value="1"><?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_yes','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
</option>
							<option value="0"><?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_no','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
</option>
						</select>

					<?php elseif ('numeric' == $this->_tpl_vars['type']): ?>

						<div class="filterMenuContainer">

							<?php echo smarty_function_img(array('src' => "image/silk/zoom.png",'class' => 'filterIcon','onclick' => "Event.stop(event);"), $this);?>


							<div class="filterMenu">

								<ul onclick="$('filter_<?php echo $this->_tpl_vars['column']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
').filter.initFilter(event);">
									<li class="rangeFilterReset" symbol="">
										<span class="sign">&nbsp;</span>
										<span class="signLabel"><?php echo smarty_function_translate(array('text' => '_grid_show_all'), $this);?>
</span>
									</li>
									<li symbol="=">
										<span class="sign">=</span>
										<span class="signLabel"><?php echo smarty_function_translate(array('text' => '_grid_equals'), $this);?>
</span>
									</li>
									<li symbol="<>">
										<span class="sign">&ne;</span>
										<span class="signLabel"><?php echo smarty_function_translate(array('text' => '_grid_not_equal'), $this);?>
</span>
									</li>
									<li symbol=">">
										<span class="sign">&gt;</span>
										<span class="signLabel"><?php echo smarty_function_translate(array('text' => '_grid_greater'), $this);?>
</span>
									</li>
									<li symbol="<">
										<span class="sign">&lt;</span>
										<span class="signLabel"><?php echo smarty_function_translate(array('text' => '_grid_less'), $this);?>
</span>
									</li>
									<li symbol=">=">
										<span class="sign">&ge;</span>
										<span class="signLabel"><?php echo smarty_function_translate(array('text' => '_grid_greater_or_equal'), $this);?>
</span>
									</li>
									<li symbol="<=">
										<span class="sign">&le;</span>
										<span class="signLabel"><?php echo smarty_function_translate(array('text' => '_grid_less_or_equal'), $this);?>
</span>
									</li>
									<li symbol="><">
										<span class="sign">&#8812;</span>
										<span class="signLabel"><?php echo smarty_function_translate(array('text' => '_grid_range'), $this);?>
</span>
									</li>
								</ul>

							</div>

						</div>

						<input type="text" class="text <?php echo $this->_tpl_vars['type']; ?>
" id="filter_<?php echo $this->_tpl_vars['column']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['availableColumns'][$this->_tpl_vars['column']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onkeyup="RegexFilter(this, { regex : '[^=<>.0-9]' });" />

						<div class="rangeFilter" style="display: none;">
							<input type="text" class="text numeric min" onclick="event.stopPropagation();" onchange="$('filter_<?php echo $this->_tpl_vars['column']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
').filter.updateRangeFilter(event);" onkeyup="RegexFilter(this, { regex : '[^.0-9]' });" />
							<span class="rangeTo">-</span>
							<input type="text" class="text numeric max" onclick="event.stopPropagation();" onchange="$('filter_<?php echo $this->_tpl_vars['column']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
').filter.updateRangeFilter(event);" onkeyup="RegexFilter(this, { regex : '[^.0-9]' });" />
						</div>
					<?php elseif ('date' == $this->_tpl_vars['type']): ?>
						<select id="filter_<?php echo $this->_tpl_vars['column']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
">
							<option value=""><?php echo ((is_array($_tmp=$this->_tpl_vars['availableColumns'][$this->_tpl_vars['column']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
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
							<option value="daterange"><?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_grid_date_range','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
</option>
						</select>
						<div style="display: none;" class="dateRange">
							<div>
								<?php echo smarty_function_calendar(array('nobutton' => 'true','noform' => 'true','class' => "min text ".($this->_tpl_vars['type']),'id' => "filter_".($this->_tpl_vars['column'])."_".($this->_tpl_vars['id'])."_from",'onchange' => "document.getElementById('filter_".($this->_tpl_vars['column'])."_".($this->_tpl_vars['id'])."').filter.updateDateRangeFilter(this);"), $this);?>

							</div>
							<div>
								<?php echo smarty_function_translate(array('text' => '_to'), $this);?>

							</div>
							<div>
								<?php echo smarty_function_calendar(array('nobutton' => 'true','noform' => 'true','class' => "max text ".($this->_tpl_vars['type']),'id' => "filter_".($this->_tpl_vars['column'])."_".($this->_tpl_vars['id'])."_to",'onchange' => "document.getElementById('filter_".($this->_tpl_vars['column'])."_".($this->_tpl_vars['id'])."').filter.updateDateRangeFilter(this);"), $this);?>

							</div>
						</div>
					<?php else: ?>
						<input type="text" class="text <?php echo $this->_tpl_vars['type']; ?>
" id="filter_<?php echo $this->_tpl_vars['column']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['availableColumns'][$this->_tpl_vars['column']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  />
					<?php endif; ?>
					<?php echo smarty_function_img(array('src' => "image/silk/bullet_arrow_up.png",'class' => 'sortPreview'), $this);?>

					</div>
				</th>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</tr>
</thead>
<tbody>
	<?php unset($this->_sections['createRows']);
$this->_sections['createRows']['name'] = 'createRows';
$this->_sections['createRows']['start'] = (int)0;
$this->_sections['createRows']['loop'] = is_array($_loop=$this->_tpl_vars['rowCount']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['createRows']['show'] = true;
$this->_sections['createRows']['max'] = $this->_sections['createRows']['loop'];
$this->_sections['createRows']['step'] = 1;
if ($this->_sections['createRows']['start'] < 0)
    $this->_sections['createRows']['start'] = max($this->_sections['createRows']['step'] > 0 ? 0 : -1, $this->_sections['createRows']['loop'] + $this->_sections['createRows']['start']);
else
    $this->_sections['createRows']['start'] = min($this->_sections['createRows']['start'], $this->_sections['createRows']['step'] > 0 ? $this->_sections['createRows']['loop'] : $this->_sections['createRows']['loop']-1);
if ($this->_sections['createRows']['show']) {
    $this->_sections['createRows']['total'] = min(ceil(($this->_sections['createRows']['step'] > 0 ? $this->_sections['createRows']['loop'] - $this->_sections['createRows']['start'] : $this->_sections['createRows']['start']+1)/abs($this->_sections['createRows']['step'])), $this->_sections['createRows']['max']);
    if ($this->_sections['createRows']['total'] == 0)
        $this->_sections['createRows']['show'] = false;
} else
    $this->_sections['createRows']['total'] = 0;
if ($this->_sections['createRows']['show']):

            for ($this->_sections['createRows']['index'] = $this->_sections['createRows']['start'], $this->_sections['createRows']['iteration'] = 1;
                 $this->_sections['createRows']['iteration'] <= $this->_sections['createRows']['total'];
                 $this->_sections['createRows']['index'] += $this->_sections['createRows']['step'], $this->_sections['createRows']['iteration']++):
$this->_sections['createRows']['rownum'] = $this->_sections['createRows']['iteration'];
$this->_sections['createRows']['index_prev'] = $this->_sections['createRows']['index'] - $this->_sections['createRows']['step'];
$this->_sections['createRows']['index_next'] = $this->_sections['createRows']['index'] + $this->_sections['createRows']['step'];
$this->_sections['createRows']['first']      = ($this->_sections['createRows']['iteration'] == 1);
$this->_sections['createRows']['last']       = ($this->_sections['createRows']['iteration'] == $this->_sections['createRows']['total']);
?>
		<tr class="<?php if (!(1 & $this->_sections['createRows']['index'])): ?>even<?php else: ?>odd<?php endif; ?>">
			<td class="cell_cb"></td>
		<?php $_from = $this->_tpl_vars['displayedColumns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['columns'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['columns']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['column'] => $this->_tpl_vars['type']):
        $this->_foreach['columns']['iteration']++;
?>
		 	<?php if (! ($this->_foreach['columns']['iteration'] <= 1)): ?>
				<td class="cellt_<?php echo $this->_tpl_vars['type']; ?>
 cell_<?php echo ((is_array($_tmp=$this->_tpl_vars['column'])) ? $this->_run_mod_handler('replace', true, $_tmp, '.', '_') : smarty_modifier_replace($_tmp, '.', '_')); ?>
"></td>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</tr>
	<?php endfor; endif; ?>
</tbody>

	</table>
</div>

<div class="activeGridColumns" >
	<ul class="menu" style="float: left;">
		<?php if ($this->_tpl_vars['count']): ?>
			<li class="gridCount">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:".($this->_tpl_vars['count']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</li>
		<?php endif; ?>

		<li class="reload">
			<a href="#" onclick="window.activeGrids['<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
'].reloadGrid(); return false;"><?php echo smarty_function_translate(array('text' => '_grid_reload'), $this);?>
</a>
		</li>
	</ul>

	<ul class="menu" style="float: right;">
		<li class="export">
			<a href="#" onclick="var grid = window.activeGrids['<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
']; window.location.href='<?php echo smarty_function_link(array('controller' => $this->_tpl_vars['controller'],'action' => 'export'), $this);?>
?' + grid.ricoGrid.getQueryString() + '&selectedIDs=' + grid.getSelectedIDs().toJSON() + '&isInverse=' + (grid.isInverseSelection() ? 1 : 0); return false;"><?php echo smarty_function_translate(array('text' => '_grid_export'), $this);?>
</a>
		</li>
		<li class="selectColumns">
		   <a href="#" onclick="Element.show($('<?php echo $this->_tpl_vars['prefix']; ?>
ColumnMenu_<?php echo $this->_tpl_vars['id']; ?>
')); return false;"><?php echo smarty_function_translate(array('text' => '_columns'), $this);?>
</a>
		</li>
	</ul>

	<div class="clear"></div>
</div>

<div id="<?php echo $this->_tpl_vars['prefix']; ?>
ColumnMenu_<?php echo $this->_tpl_vars['id']; ?>
" class="activeGridColumnsRoot" style="display: none; position: relative;">
  <form action="<?php echo smarty_function_link(array('controller' => $this->_tpl_vars['controller'],'action' => 'changeColumns'), $this);?>
" onsubmit="new LiveCart.AjaxUpdater(this, this.up('.<?php echo $this->_tpl_vars['container']; ?>
'), document.getElementsByClassName('progressIndicator', this)[0]); return false;" method="post">

	<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />

	<div class="activeGridColumnsSelect">
		<div class="activeGridColumnsSelectControls">
			<span class="progressIndicator" style="display: none;"></span>
			<input type="submit" class="submit" name="sm" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_change_columns','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" /> <?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 <a class="cancel" onclick="Element.hide($('<?php echo $this->_tpl_vars['prefix']; ?>
ColumnMenu_<?php echo $this->_tpl_vars['id']; ?>
')); return false;" href="#cancel"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
		</div>
		<div class="activeGridColumnsList">
			<?php $_from = $this->_tpl_vars['availableColumns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['column'] => $this->_tpl_vars['item']):
?>
			<p class="activeGridcolumn_<?php echo ((is_array($_tmp=$this->_tpl_vars['column'])) ? $this->_run_mod_handler('replace', true, $_tmp, '.', '_') : smarty_modifier_replace($_tmp, '.', '_')); ?>
">
				<input type="checkbox" name="col[<?php echo $this->_tpl_vars['column']; ?>
]" class="checkbox" id="column_<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['column']; ?>
"<?php if ($this->_tpl_vars['displayedColumns'][$this->_tpl_vars['column']]): ?>checked="checked"<?php endif; ?> />
				<label for="column_<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['column']; ?>
" class="checkbox" id="column_<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['column']; ?>
_label">
					<?php echo $this->_tpl_vars['item']['name']; ?>

				</label>
			</p>
			<?php endforeach; endif; unset($_from); ?>
		</div>
	</div>
  </form>
</div>

<?php echo '
<script type="text/javascript">
	if(!window.activeGrids) window.activeGrids = {};
'; ?>
;
	window.activeGrids['<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
'] = new ActiveGrid($('<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
'), '<?php echo $this->_tpl_vars['url']; ?>
', <?php echo $this->_tpl_vars['totalCount']; ?>
, $("<?php echo $this->_tpl_vars['prefix']; ?>
LoadIndicator_<?php echo $this->_tpl_vars['id']; ?>
"), <?php echo $this->_tpl_vars['rowCount']; ?>
, <?php echo smarty_function_json(array('array' => $this->_tpl_vars['filters']), $this);?>
);
	<?php if ($this->_tpl_vars['dataFormatter']): ?>
		window.activeGrids['<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
'].setDataFormatter(<?php echo $this->_tpl_vars['dataFormatter']; ?>
);
	<?php endif; ?>
	window.activeGrids['<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
'].setInitialData(<?php echo smarty_function_json(array('array' => $this->_tpl_vars['data']), $this);?>
);
	<?php if ($this->_tpl_vars['isQuickEdit'] && ! ((is_array($_tmp='DISABLE_QUICKEDIT')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		window.activeGrids['<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
'].initQuickEdit("<?php echo $this->_tpl_vars['quickEditUrl']; ?>
", "<?php echo $this->_tpl_vars['quickEditUrlIdentificatorToken']; ?>
");
	<?php endif; ?>
	<?php $_from = $this->_tpl_vars['displayedColumns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['columns'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['columns']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['column'] => $this->_tpl_vars['index']):
        $this->_foreach['columns']['iteration']++;
?>
		<?php if (! ($this->_foreach['columns']['iteration'] <= 1)): ?>
			new ActiveGridFilter($('filter_<?php echo $this->_tpl_vars['column']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
'), window.activeGrids['<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
']);
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php if ($this->_tpl_vars['advancedSearch']): ?>



		window.activeGrids['<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
'].initAdvancedSearch(
			"<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
",
			<?php echo smarty_function_json(array('array' => $this->_tpl_vars['availableColumns']), $this);?>
,
			<?php echo smarty_function_json(array('array' => $this->_tpl_vars['advancedSearchColumns']), $this);?>
,

			/* misc properties */
			<?php echo '
			{
				dateFilterValues:
				{
			'; ?>

					_today:"today | now",
					_yesterday:"yesterday | today",
					_last_7_days:"-7 days | now",
					_this_month:"<?php echo $this->_tpl_vars['thisMonth']; ?>
/1 | now",
					_last_month:"<?php echo $this->_tpl_vars['lastMonth']; ?>
-1 | <?php echo $this->_tpl_vars['thisMonth']; ?>
/1"
			<?php echo '
				}
			}
			'; ?>

		);
	<?php endif; ?>

	// register translations
	$T("_yes","<?php echo smarty_function_translate(array('text' => '_yes'), $this);?>
");
	$T("_no","<?php echo smarty_function_translate(array('text' => '_no'), $this);?>
");
	$T("_grid_show_all","<?php echo smarty_function_translate(array('text' => '_grid_show_all'), $this);?>
");
	$T("_grid_equals","<?php echo smarty_function_translate(array('text' => '_grid_equals'), $this);?>
");
	$T("_grid_not_equal","<?php echo smarty_function_translate(array('text' => '_grid_not_equal'), $this);?>
");
	$T("_grid_greater","<?php echo smarty_function_translate(array('text' => '_grid_greater'), $this);?>
");
	$T("_grid_less","<?php echo smarty_function_translate(array('text' => '_grid_less'), $this);?>
");
	$T("_grid_greater_or_equal","<?php echo smarty_function_translate(array('text' => '_grid_greater_or_equal'), $this);?>
");
	$T("_grid_less_or_equal","<?php echo smarty_function_translate(array('text' => '_grid_less_or_equal'), $this);?>
");
	$T("_grid_range","<?php echo smarty_function_translate(array('text' => '_grid_range'), $this);?>
");
	$T("_today","<?php echo smarty_function_translate(array('text' => '_today'), $this);?>
");
	$T("_yesterday","<?php echo smarty_function_translate(array('text' => '_yesterday'), $this);?>
");
	$T("_last_7_days","<?php echo smarty_function_translate(array('text' => '_last_7_days'), $this);?>
");
	$T("_this_month","<?php echo smarty_function_translate(array('text' => '_this_month'), $this);?>
");
	$T("_last_month","<?php echo smarty_function_translate(array('text' => '_last_month'), $this);?>
");
	$T("_grid_date_range","<?php echo smarty_function_translate(array('text' => '_grid_date_range'), $this);?>
");

<?php echo '
</script>
'; ?>