<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:33
         compiled from custom:category/subcategoriesColumns.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:category/subcategoriesColumns.tpl', 1, false),array('modifier', 'count', 'custom:category/subcategoriesColumns.tpl', 2, false),array('function', 'math', 'custom:category/subcategoriesColumns.tpl', 2, false),)), $this); ?>
<?php $this->assign('columns', ((is_array($_tmp='CATEGORY_COLUMNS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))); ?>
<?php echo smarty_function_math(array('count' => count($this->_tpl_vars['subCategories']),'equation' => "max(1, ceil(count / ".($this->_tpl_vars['columns'])."))",'assign' => 'rows'), $this);?>


<table class="subCategories">
<?php unset($this->_sections['rows']);
$this->_sections['rows']['name'] = 'rows';
$this->_sections['rows']['start'] = (int)0;
$this->_sections['rows']['loop'] = is_array($_loop=$this->_tpl_vars['rows']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rows']['show'] = true;
$this->_sections['rows']['max'] = $this->_sections['rows']['loop'];
$this->_sections['rows']['step'] = 1;
if ($this->_sections['rows']['start'] < 0)
    $this->_sections['rows']['start'] = max($this->_sections['rows']['step'] > 0 ? 0 : -1, $this->_sections['rows']['loop'] + $this->_sections['rows']['start']);
else
    $this->_sections['rows']['start'] = min($this->_sections['rows']['start'], $this->_sections['rows']['step'] > 0 ? $this->_sections['rows']['loop'] : $this->_sections['rows']['loop']-1);
if ($this->_sections['rows']['show']) {
    $this->_sections['rows']['total'] = min(ceil(($this->_sections['rows']['step'] > 0 ? $this->_sections['rows']['loop'] - $this->_sections['rows']['start'] : $this->_sections['rows']['start']+1)/abs($this->_sections['rows']['step'])), $this->_sections['rows']['max']);
    if ($this->_sections['rows']['total'] == 0)
        $this->_sections['rows']['show'] = false;
} else
    $this->_sections['rows']['total'] = 0;
if ($this->_sections['rows']['show']):

            for ($this->_sections['rows']['index'] = $this->_sections['rows']['start'], $this->_sections['rows']['iteration'] = 1;
                 $this->_sections['rows']['iteration'] <= $this->_sections['rows']['total'];
                 $this->_sections['rows']['index'] += $this->_sections['rows']['step'], $this->_sections['rows']['iteration']++):
$this->_sections['rows']['rownum'] = $this->_sections['rows']['iteration'];
$this->_sections['rows']['index_prev'] = $this->_sections['rows']['index'] - $this->_sections['rows']['step'];
$this->_sections['rows']['index_next'] = $this->_sections['rows']['index'] + $this->_sections['rows']['step'];
$this->_sections['rows']['first']      = ($this->_sections['rows']['iteration'] == 1);
$this->_sections['rows']['last']       = ($this->_sections['rows']['iteration'] == $this->_sections['rows']['total']);
?><?php $this->assign('row', $this->_sections['rows']); ?>

	<tr class="subCategoryRow <?php if ($this->_tpl_vars['row']['first']): ?> first<?php endif; ?><?php if ($this->_tpl_vars['row']['last']): ?> last<?php endif; ?>">
	<?php unset($this->_sections['columns']);
$this->_sections['columns']['name'] = 'columns';
$this->_sections['columns']['start'] = (int)0;
$this->_sections['columns']['loop'] = is_array($_loop=$this->_tpl_vars['columns']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['columns']['show'] = true;
$this->_sections['columns']['max'] = $this->_sections['columns']['loop'];
$this->_sections['columns']['step'] = 1;
if ($this->_sections['columns']['start'] < 0)
    $this->_sections['columns']['start'] = max($this->_sections['columns']['step'] > 0 ? 0 : -1, $this->_sections['columns']['loop'] + $this->_sections['columns']['start']);
else
    $this->_sections['columns']['start'] = min($this->_sections['columns']['start'], $this->_sections['columns']['step'] > 0 ? $this->_sections['columns']['loop'] : $this->_sections['columns']['loop']-1);
if ($this->_sections['columns']['show']) {
    $this->_sections['columns']['total'] = min(ceil(($this->_sections['columns']['step'] > 0 ? $this->_sections['columns']['loop'] - $this->_sections['columns']['start'] : $this->_sections['columns']['start']+1)/abs($this->_sections['columns']['step'])), $this->_sections['columns']['max']);
    if ($this->_sections['columns']['total'] == 0)
        $this->_sections['columns']['show'] = false;
} else
    $this->_sections['columns']['total'] = 0;
if ($this->_sections['columns']['show']):

            for ($this->_sections['columns']['index'] = $this->_sections['columns']['start'], $this->_sections['columns']['iteration'] = 1;
                 $this->_sections['columns']['iteration'] <= $this->_sections['columns']['total'];
                 $this->_sections['columns']['index'] += $this->_sections['columns']['step'], $this->_sections['columns']['iteration']++):
$this->_sections['columns']['rownum'] = $this->_sections['columns']['iteration'];
$this->_sections['columns']['index_prev'] = $this->_sections['columns']['index'] - $this->_sections['columns']['step'];
$this->_sections['columns']['index_next'] = $this->_sections['columns']['index'] + $this->_sections['columns']['step'];
$this->_sections['columns']['first']      = ($this->_sections['columns']['iteration'] == 1);
$this->_sections['columns']['last']       = ($this->_sections['columns']['iteration'] == $this->_sections['columns']['total']);
?><?php $this->assign('col', $this->_sections['columns']); ?>

		<?php if ('CAT_HOR' == ((is_array($_tmp='CATEGORY_COL_DIRECTION')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
			<?php $this->assign('colOffset', $this->_tpl_vars['row']['index']*$this->_tpl_vars['columns']); ?>
			<?php $this->assign('index', $this->_tpl_vars['colOffset']+$this->_tpl_vars['col']['index']); ?>
		<?php else: ?>
			<?php $this->assign('colOffset', $this->_tpl_vars['col']['index']*$this->_tpl_vars['rows']); ?>
			<?php $this->assign('index', $this->_tpl_vars['colOffset']+$this->_tpl_vars['row']['index']); ?>
		<?php endif; ?>

		<?php $this->assign('cat', $this->_tpl_vars['subCategories'][$this->_tpl_vars['index']]); ?>

		<td class="<?php if (! $this->_tpl_vars['cat']): ?>empty<?php endif; ?> <?php if ($this->_tpl_vars['col']['first']): ?> first<?php endif; ?><?php if ($this->_tpl_vars['col']['last']): ?> last<?php endif; ?> subCategoryItem">
			<?php if ($this->_tpl_vars['cat']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/block/categoryItem.tpl", 'smarty_include_vars' => array('sub' => $this->_tpl_vars['cat'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		</td>

	<?php endfor; endif; ?>
	</tr>
<?php endfor; endif; ?>
</table>