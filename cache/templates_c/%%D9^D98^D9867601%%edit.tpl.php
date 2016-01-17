<?php /* Smarty version 2.6.26, created on 2015-12-01 10:54:38
         compiled from /home/illumin/public_html/application/view///backend/template/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', '/home/illumin/public_html/application/view///backend/template/edit.tpl', 2, false),array('block', 'error', '/home/illumin/public_html/application/view///backend/template/edit.tpl', 15, false),array('block', 'denied', '/home/illumin/public_html/application/view///backend/template/edit.tpl', 29, false),array('function', 'selectfield', '/home/illumin/public_html/application/view///backend/template/edit.tpl', 5, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/template/edit.tpl', 12, false),array('function', 'textfield', '/home/illumin/public_html/application/view///backend/template/edit.tpl', 13, false),array('function', 'textarea', '/home/illumin/public_html/application/view///backend/template/edit.tpl', 22, false),array('function', 'hidden', '/home/illumin/public_html/application/view///backend/template/edit.tpl', 23, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/template/edit.tpl', 37, false),array('function', 'baseUrl', '/home/illumin/public_html/application/view///backend/template/edit.tpl', 41, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/template/edit.tpl', 35, false),)), $this); ?>
<h1><?php echo $this->_tpl_vars['fileName']; ?>
</h1>
<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['form'],'action' => "controller=backend.template action=save",'method' => 'POST','class' => 'templateForm','id' => "templateForm_".($this->_tpl_vars['tabid']))); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<div class="minimenu" id="minimenu_<?php echo $this->_tpl_vars['tabid']; ?>
">
		<span class="progressIndicator" style="display:none;"></span>
		<?php echo smarty_function_selectfield(array('class' => 'version','id' => "version_".($this->_tpl_vars['tabid']),'options' => $this->_tpl_vars['template']['backups']), $this);?>

		<?php echo smarty_function_selectfield(array('class' => 'othertheme','id' => "othertheme_".($this->_tpl_vars['tabid']),'options' => $this->_tpl_vars['template']['otherThemes']), $this);?>

	</div>

	<?php if ($this->_tpl_vars['new'] || $this->_tpl_vars['template']['isCustomFile']): ?>
		<p>
			
				<label style="margin-top: 9px;"><?php echo smarty_function_translate(array('text' => '_template_file_name'), $this);?>
:</label>
				<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'fileName','class' => 'text wide'), $this);?>

			
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'fileName')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'fileName')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
		</p>
		<div class="clear" style="margin-bottom: 1em;"></div>
	<?php endif; ?>
	<input type="hidden" value="<?php echo $this->_tpl_vars['tabid']; ?>
" name="tabid" />

	<?php echo smarty_function_textarea(array('name' => 'code','class' => 'code','id' => "code_".($this->_tpl_vars['tabid'])), $this);?>

	<?php echo smarty_function_hidden(array('name' => 'file','id' => 'file'), $this);?>


	<?php if ($this->_tpl_vars['new']): ?>
		<?php echo smarty_function_hidden(array('name' => 'new','value' => 'true'), $this);?>

	<?php endif; ?>

	<fieldset class="controls" <?php $this->_tag_stack[] = array('denied', array('role' => "template.save")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none;"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
		<div class="saveThemeSelector" style="float: right;">
			<?php echo smarty_function_translate(array('text' => '_save_for_theme'), $this);?>
: <?php echo smarty_function_selectfield(array('name' => 'theme','options' => $this->_tpl_vars['themes'],'blank' => true,'id' => "theme_".($this->_tpl_vars['tabid'])), $this);?>

		</div>

		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_save_template','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
		<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

		<a id="cancel_<?php echo $this->_tpl_vars['tabid']; ?>
" class="cancel" href="<?php echo smarty_function_link(array('controller' => "backend.template"), $this);?>
"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
	</fieldset>
	<script type="text/javascript">
		<?php echo '$'; ?>
('code_<?php echo $this->_tpl_vars['tabid']; ?>
').value = decode64("<?php echo $this->_tpl_vars['code']; ?>
");
		editAreaLoader.baseURL = "<?php echo smarty_function_baseUrl(array(), $this);?>
javascript/library/editarea/";
	</script>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>