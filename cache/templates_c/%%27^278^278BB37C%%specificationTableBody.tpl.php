<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from custom:product/specificationTableBody.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'zebra', 'custom:product/specificationTableBody.tpl', 9, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['attributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['attributes'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['attributes']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['attr']):
        $this->_foreach['attributes']['iteration']++;
?>

	<?php if ($this->_tpl_vars['prevAttr'][$this->_tpl_vars['field']][$this->_tpl_vars['group']]['ID'] != $this->_tpl_vars['attr'][$this->_tpl_vars['field']][$this->_tpl_vars['group']]['ID']): ?>
		<tr class="specificationGroup heading<?php if (($this->_foreach['attributes']['iteration'] <= 1)): ?> first<?php endif; ?>">
			<td class="param"><?php echo $this->_tpl_vars['attr'][$this->_tpl_vars['field']][$this->_tpl_vars['group']]['name_lang']; ?>
</td>
			<td class="value"></td>
		</tr>
	<?php endif; ?>
	<tr class="<?php echo smarty_function_zebra(array('loop' => 'attributes'), $this);?>
">
		<td class="param"><?php echo $this->_tpl_vars['attr'][$this->_tpl_vars['field']]['name_lang']; ?>
</td>
		<td class="value">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/attributeValue.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
	<?php $this->assign('prevAttr', $this->_tpl_vars['attr']); ?>

<?php endforeach; endif; unset($_from); ?>