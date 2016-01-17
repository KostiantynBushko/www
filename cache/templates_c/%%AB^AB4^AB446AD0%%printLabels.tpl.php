<?php /* Smarty version 2.6.26, created on 2015-12-15 11:46:08
         compiled from /home/illumin/public_html/application/view///backend/customerOrder/printLabels.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', '/home/illumin/public_html/application/view///backend/customerOrder/printLabels.tpl', 4, false),array('modifier', 'default', '/home/illumin/public_html/application/view///backend/customerOrder/printLabels.tpl', 4, false),)), $this); ?>
<?php ob_start(); ?>
<table style="width: 100%;">
	<?php $this->assign('index', 0); ?>
	<?php $this->assign('repeat', ((is_array($_tmp=((is_array($_tmp='SHIP_LABELS_REPEAT')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1))); ?>
	<?php $this->assign('perRow', ((is_array($_tmp=((is_array($_tmp='SHIP_LABELS_PER_ROW')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1))); ?>
	<?php $this->assign('width', "100/".($this->_tpl_vars['perRow'])); ?>
	<?php $_from = $this->_tpl_vars['feed']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipment']):
?>
		<?php unset($this->_sections['labels']);
$this->_sections['labels']['name'] = 'labels';
$this->_sections['labels']['loop'] = is_array($_loop=$this->_tpl_vars['repeat']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['labels']['show'] = true;
$this->_sections['labels']['max'] = $this->_sections['labels']['loop'];
$this->_sections['labels']['step'] = 1;
$this->_sections['labels']['start'] = $this->_sections['labels']['step'] > 0 ? 0 : $this->_sections['labels']['loop']-1;
if ($this->_sections['labels']['show']) {
    $this->_sections['labels']['total'] = $this->_sections['labels']['loop'];
    if ($this->_sections['labels']['total'] == 0)
        $this->_sections['labels']['show'] = false;
} else
    $this->_sections['labels']['total'] = 0;
if ($this->_sections['labels']['show']):

            for ($this->_sections['labels']['index'] = $this->_sections['labels']['start'], $this->_sections['labels']['iteration'] = 1;
                 $this->_sections['labels']['iteration'] <= $this->_sections['labels']['total'];
                 $this->_sections['labels']['index'] += $this->_sections['labels']['step'], $this->_sections['labels']['iteration']++):
$this->_sections['labels']['rownum'] = $this->_sections['labels']['iteration'];
$this->_sections['labels']['index_prev'] = $this->_sections['labels']['index'] - $this->_sections['labels']['step'];
$this->_sections['labels']['index_next'] = $this->_sections['labels']['index'] + $this->_sections['labels']['step'];
$this->_sections['labels']['first']      = ($this->_sections['labels']['iteration'] == 1);
$this->_sections['labels']['last']       = ($this->_sections['labels']['iteration'] == $this->_sections['labels']['total']);
?>
			<?php if (0 == $this->_tpl_vars['index']): ?>
				<tr style="page-break-inside: avoid;">
			<?php endif; ?>
			<?php $this->assign('index', $this->_tpl_vars['index']+1); ?>

			<td style="width: <?php echo $this->_tpl_vars['width']; ?>
%; page-break-inside: avoid;">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/customerOrder/block/shippingLabel.tpl", 'smarty_include_vars' => array('address' => $this->_tpl_vars['shipment']['ShippingAddress'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</td>

			<?php if ($this->_tpl_vars['perRow'] == $this->_tpl_vars['index']): ?>
				</tr>
				<?php $this->assign('index', 0); ?>
			<?php endif; ?>
		<?php endfor; endif; ?>
	<?php endforeach; endif; unset($_from); ?>
</table>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('labels', ob_get_contents());ob_end_clean(); ?>

<body onLoad="window.print()">
<?php unset($this->_sections['copies']);
$this->_sections['copies']['name'] = 'copies';
$this->_sections['copies']['loop'] = is_array($_loop=((is_array($_tmp=((is_array($_tmp='SHIP_LABELS_COPIES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1))) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['copies']['show'] = true;
$this->_sections['copies']['max'] = $this->_sections['copies']['loop'];
$this->_sections['copies']['step'] = 1;
$this->_sections['copies']['start'] = $this->_sections['copies']['step'] > 0 ? 0 : $this->_sections['copies']['loop']-1;
if ($this->_sections['copies']['show']) {
    $this->_sections['copies']['total'] = $this->_sections['copies']['loop'];
    if ($this->_sections['copies']['total'] == 0)
        $this->_sections['copies']['show'] = false;
} else
    $this->_sections['copies']['total'] = 0;
if ($this->_sections['copies']['show']):

            for ($this->_sections['copies']['index'] = $this->_sections['copies']['start'], $this->_sections['copies']['iteration'] = 1;
                 $this->_sections['copies']['iteration'] <= $this->_sections['copies']['total'];
                 $this->_sections['copies']['index'] += $this->_sections['copies']['step'], $this->_sections['copies']['iteration']++):
$this->_sections['copies']['rownum'] = $this->_sections['copies']['iteration'];
$this->_sections['copies']['index_prev'] = $this->_sections['copies']['index'] - $this->_sections['copies']['step'];
$this->_sections['copies']['index_next'] = $this->_sections['copies']['index'] + $this->_sections['copies']['step'];
$this->_sections['copies']['first']      = ($this->_sections['copies']['iteration'] == 1);
$this->_sections['copies']['last']       = ($this->_sections['copies']['iteration'] == $this->_sections['copies']['total']);
?>
	<div style="page-break-after: always;">
		<?php echo $this->_tpl_vars['labels']; ?>

	</div>
<?php endfor; endif; ?>
</body>