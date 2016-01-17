<?php /* Smarty version 2.6.26, created on 2015-12-01 10:56:40
         compiled from /home/illumin/public_html/application/view///backend/settings/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', '/home/illumin/public_html/application/view///backend/settings/edit.tpl', 3, false),array('block', 'language', '/home/illumin/public_html/application/view///backend/settings/edit.tpl', 74, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/settings/edit.tpl', 17, false),array('function', 'textfield', '/home/illumin/public_html/application/view///backend/settings/edit.tpl', 30, false),array('function', 'filefield', '/home/illumin/public_html/application/view///backend/settings/edit.tpl', 32, false),array('function', 'textarea', '/home/illumin/public_html/application/view///backend/settings/edit.tpl', 35, false),array('function', 'checkbox', '/home/illumin/public_html/application/view///backend/settings/edit.tpl', 39, false),array('function', 'selectfield', '/home/illumin/public_html/application/view///backend/settings/edit.tpl', 53, false),array('modifier', 'config', '/home/illumin/public_html/application/view///backend/settings/edit.tpl', 33, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/settings/edit.tpl', 95, false),)), $this); ?>
<h1><?php echo $this->_tpl_vars['title']; ?>
</h1>

<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.settings action=save",'method' => 'post','handle' => $this->_tpl_vars['form'],'onsubmit' => "return settings.save(this);",'role' => "settings.update",'id' => 'settings','type' => "multipart/form-data",'target' => 'upload')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/settings/sectionHelp.tpl", 'smarty_include_vars' => array('key' => ($this->_tpl_vars['sectionKey']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_from = $this->_tpl_vars['layout']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['groups'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['groups']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['groupName'] => $this->_tpl_vars['fields']):
        $this->_foreach['groups']['iteration']++;
?>

	<?php if (! $this->_tpl_vars['fields'] && ! ($this->_foreach['groups']['iteration'] <= 1)): ?>
		<?php $this->assign('subsections', false); ?>
		</fieldset>
	<?php endif; ?>

	<fieldset class="settings">

		<?php if ($this->_tpl_vars['groupName']): ?>
			<legend><?php echo smarty_function_translate(array('text' => ($this->_tpl_vars['groupName'])), $this);?>
</legend>
		<?php endif; ?>

		<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fieldName'] => $this->_tpl_vars['foo']):
?>
			<div class="setting" id="setting_<?php echo $this->_tpl_vars['fieldName']; ?>
" <?php if ('bool' != $this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['type']): ?>style="margin-top: 7px; margin-bottom: 7px;"<?php endif; ?>>
			<p<?php if ('bool' == $this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['type']): ?> class="checkbox"<?php endif; ?>>

				<?php if ('bool' != $this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['type']): ?>
					<label for="<?php echo $this->_tpl_vars['fieldName']; ?>
" class="setting"><?php echo smarty_function_translate(array('text' => ($this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['title'])), $this);?>
:</label>
				<?php endif; ?>

			<fieldset class="error">
				<?php if ('string' == $this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['type']): ?>
					<?php echo smarty_function_textfield(array('class' => 'text wide','name' => ($this->_tpl_vars['fieldName']),'id' => ($this->_tpl_vars['fieldName'])), $this);?>

				<?php elseif ('image' == $this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['type']): ?>
					<?php echo smarty_function_filefield(array('name' => ($this->_tpl_vars['fieldName']),'id' => ($this->_tpl_vars['fieldName'])), $this);?>

					<image class="settingImage" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['fieldName'])) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
" />
				<?php elseif ('longtext' == $this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['type']): ?>
					<?php echo smarty_function_textarea(array('class' => 'tinyMCE','name' => ($this->_tpl_vars['fieldName']),'id' => ($this->_tpl_vars['fieldName'])), $this);?>

				<?php elseif ('num' == $this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['type'] || 'float' == $this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['type']): ?>
					<?php echo smarty_function_textfield(array('class' => 'text number','name' => ($this->_tpl_vars['fieldName']),'id' => ($this->_tpl_vars['fieldName'])), $this);?>

				<?php elseif ('bool' == $this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['type']): ?>
					<?php echo smarty_function_checkbox(array('class' => 'checkbox','name' => ($this->_tpl_vars['fieldName']),'id' => ($this->_tpl_vars['fieldName']),'value' => '1'), $this);?>

					<label class="checkbox" for="<?php echo $this->_tpl_vars['fieldName']; ?>
"><?php echo smarty_function_translate(array('text' => ($this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['title'])), $this);?>
</label>
				<?php elseif (is_array ( $this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['type'] )): ?>
					<?php if ('multi' == $this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['extra']): ?>
						<div class="multi">
						<?php $_from = $this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
							<p>
							<?php echo smarty_function_checkbox(array('name' => ($this->_tpl_vars['fieldName'])."[".($this->_tpl_vars['key'])."]",'class' => 'checkbox','value' => 1), $this);?>

							<label for="<?php echo $this->_tpl_vars['fieldName']; ?>
[<?php echo $this->_tpl_vars['key']; ?>
]" class="checkbox"><?php echo $this->_tpl_vars['value']; ?>
</label>
							</p>
						<?php endforeach; endif; unset($_from); ?>
							<div class="clear"></div>
						</div>
					<?php else: ?>
						<?php echo smarty_function_selectfield(array('options' => $this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['type'],'name' => ($this->_tpl_vars['fieldName']),'id' => ($this->_tpl_vars['fieldName'])), $this);?>

					<?php endif; ?>
				<?php endif; ?>
				<div class="errorText hidden"></div>
			</fieldset>
			</p>
			</div>
		<?php endforeach; else: ?>
			<?php $this->assign('subsections', true); ?>
		<?php endif; unset($_from); ?>

	<?php if ($this->_tpl_vars['fields'] || ($this->_foreach['groups']['iteration'] == $this->_foreach['groups']['total'])): ?>
		</fieldset>
	<?php endif; ?>

<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['subsections']): ?>
	</fieldset>
<?php endif; ?>

<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php $_from = $this->_tpl_vars['multiLingualValues']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fieldName'] => $this->_tpl_vars['foo']):
?>
	<p>
		<label for="<?php echo $this->_tpl_vars['fieldName']; ?>
_<?php echo $this->_tpl_vars['lang']['ID']; ?>
" class="setting"><?php echo smarty_function_translate(array('text' => ($this->_tpl_vars['values'][$this->_tpl_vars['fieldName']]['title'])), $this);?>
:</label>

		<fieldset class="error">
			<?php if ($this->_tpl_vars['types'][$this->_tpl_vars['fieldName']] == 'longtext'): ?>
				<?php echo smarty_function_textarea(array('class' => 'tinyMCE','name' => ($this->_tpl_vars['fieldName'])."_".($this->_tpl_vars['lang']['ID']),'id' => ($this->_tpl_vars['fieldName'])."_".($this->_tpl_vars['lang']['ID'])), $this);?>

			<?php else: ?>
				<?php echo smarty_function_textfield(array('class' => 'text wide','name' => ($this->_tpl_vars['fieldName'])."_".($this->_tpl_vars['lang']['ID']),'id' => ($this->_tpl_vars['fieldName'])."_".($this->_tpl_vars['lang']['ID'])), $this);?>

			<?php endif; ?>
			<div class="errorText hidden"></div>
		</fieldset>
	</p>
	<?php endforeach; endif; unset($_from); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />

<fieldset class="controls">
	<span class="progressIndicator" style="display: none;"></span>
	<input type="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_save','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" class="submit" />
	<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

	<a class="cancel" href="#" onclick="return false;"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
</fieldset>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php echo '
<script type="text/javascript">
	new Backend.Settings.Editor($(\'settings\'), window.settings);
</script>
'; ?>