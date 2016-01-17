<?php /* Smarty version 2.6.26, created on 2015-12-01 16:51:53
         compiled from custom:backend/csvImport/preview.tpl */ ?>
<table id="#previewTable">
<?php $_from = $this->_tpl_vars['preview']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['csvPreview'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['csvPreview']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['row']):
        $this->_foreach['csvPreview']['iteration']++;
?>
	<tr<?php if (($this->_foreach['csvPreview']['iteration'] <= 1)): ?> id="previewFirstRow"<?php endif; ?>>
	<?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['cell']):
?>
		<td class="column_<?php echo $this->_tpl_vars['index']; ?>
">
			<?php if (($this->_foreach['csvPreview']['iteration'] <= 1)): ?>
				<a class="selectLink" href="#" onclick="Backend.CsvImport.showSelect(<?php echo $this->_tpl_vars['index']; ?>
); return false;"><?php echo $this->_tpl_vars['cell']; ?>
</a>
				<span class="selectLink"><?php echo $this->_tpl_vars['cell']; ?>
</span>
			<?php else: ?>
				<?php echo $this->_tpl_vars['cell']; ?>

			<?php endif; ?>
		</td>
	<?php endforeach; endif; unset($_from); ?>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>