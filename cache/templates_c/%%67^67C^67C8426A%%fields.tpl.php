<?php /* Smarty version 2.6.26, created on 2015-12-01 16:52:01
         compiled from /home/illumin/public_html/application/view///backend/csvImport/fields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///backend/csvImport/fields.tpl', 4, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/csvImport/fields.tpl', 12, false),)), $this); ?>
<input type="hidden" name="options" value="<?php echo $this->_tpl_vars['options']; ?>
" />
<p>
	<input type="checkbox" name="firstHeader" id="firstHeader" value="ON" class="checkbox" onclick="Backend.CsvImport.toggleHeaderRow(this.checked, $('previewFirstRow'));"/>
	<label for="firstHeader" class="checkbox"><?php echo smarty_function_translate(array('text' => '_first_header'), $this);?>
</label>
</p>
<?php $_from = $this->_tpl_vars['columns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['column']):
?>
	<p id="column_select_<?php echo $this->_tpl_vars['index']; ?>
">
		<label><a href="#" onclick="Backend.CsvImport.showColumn(<?php echo $this->_tpl_vars['index']; ?>
); return false;"><?php echo $this->_tpl_vars['column']; ?>
</a></label>
		<select name="column[<?php echo $this->_tpl_vars['index']; ?>
]">
			<option></option>
			<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['groupName'] => $this->_tpl_vars['group']):
?>
				<optgroup label="<?php echo smarty_function_translate(array('text' => ((is_array($_tmp=($this->_tpl_vars['groupName']))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))), $this);?>
">
					<?php $_from = $this->_tpl_vars['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['fieldName']):
?>
						<option value="<?php echo $this->_tpl_vars['field']; ?>
"><?php echo $this->_tpl_vars['fieldName']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</optgroup>
			<?php endforeach; endif; unset($_from); ?>
		</select>
		<span class="fieldConfigContainer"></span>
	</p>
<?php endforeach; endif; unset($_from); ?>