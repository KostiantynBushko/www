<?php /* Smarty version 2.6.26, created on 2015-12-03 18:12:27
         compiled from /home/illumin/public_html/application/view///backend/cssEditor/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///backend/cssEditor/edit.tpl', 6, false),array('function', 'textfield', '/home/illumin/public_html/application/view///backend/cssEditor/edit.tpl', 13, false),array('function', 'textarea', '/home/illumin/public_html/application/view///backend/cssEditor/edit.tpl', 21, false),array('function', 'hidden', '/home/illumin/public_html/application/view///backend/cssEditor/edit.tpl', 22, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/cssEditor/edit.tpl', 33, false),array('function', 'baseUrl', '/home/illumin/public_html/application/view///backend/cssEditor/edit.tpl', 46, false),array('block', 'form', '/home/illumin/public_html/application/view///backend/cssEditor/edit.tpl', 8, false),array('block', 'error', '/home/illumin/public_html/application/view///backend/cssEditor/edit.tpl', 15, false),array('block', 'denied', '/home/illumin/public_html/application/view///backend/cssEditor/edit.tpl', 28, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/cssEditor/edit.tpl', 30, false),)), $this); ?>
<h1><?php echo $this->_tpl_vars['fileName']; ?>
</h1>

<div 
	onclick="<?php echo 'TabControl.prototype.getInstance(\'tabContainer\').activateTab($(\'tabColors\'));'; ?>
"
	class="warning cssAndStyleTab" id="notice_changes_colors_and_styles_tab_<?php echo $this->_tpl_vars['tabid']; ?>
" style="display:none;"
><?php echo smarty_function_translate(array('text' => '_notice_changes_colors_and_styles_tab'), $this);?>
</div>

<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['form'],'action' => "controller=backend.cssEditor action=save",'method' => 'POST','class' => 'templateForm','id' => "templateForm_".($this->_tpl_vars['tabid']))); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($this->_tpl_vars['new'] || $this->_tpl_vars['template']['isCustomFile']): ?>
		<p>
			
				<label style="margin-top: 9px;"><?php echo smarty_function_translate(array('text' => '_template_file_name'), $this);?>
:</label>
				<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'fileName','class' => 'text'), $this);?>

			
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'fileName')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'fileName')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
		</p>
		<div class="clear" style="margin-bottom: 1em;"></div>
	<?php endif; ?>

	<?php ob_start(); ?><?php echo $this->_tpl_vars['tabid']; ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_textarea(array('name' => 'code','id' => "code_".($this->_tpl_vars['blockAsParamValue']),'class' => 'code'), $this);?>

	<?php ob_start(); ?><?php echo $this->_tpl_vars['tabid']; ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_hidden(array('name' => 'file','id' => "file_".($this->_tpl_vars['blockAsParamValue'])), $this);?>


	<?php if ($this->_tpl_vars['new']): ?>
		<?php echo smarty_function_hidden(array('name' => 'new','value' => 'true'), $this);?>

	<?php endif; ?>

	<fieldset class="controls" <?php $this->_tag_stack[] = array('denied', array('role' => "template.save")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none;"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_save_css','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
		<?php if (isset ( $this->_tpl_vars['noTabHandling'] ) == false): ?>
			<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

			<a id="cancel_<?php echo $this->_tpl_vars['tabid']; ?>
" class="cancel" href="<?php echo smarty_function_link(array('controller' => "backend.cssEditor"), $this);?>
"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
		<?php endif; ?>
	</fieldset>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php echo '
	<script type="text/javascript">
		Backend.isCssEdited["'; ?>
<?php echo $this->_tpl_vars['tabid']; ?>
<?php echo '"] = false;
		if (Backend.Theme.prototype.isStyleTabChanged("'; ?>
<?php echo $this->_tpl_vars['tabid']; ?>
<?php echo '"))
		{
			Backend.Theme.prototype.styleTabChanged("'; ?>
<?php echo $this->_tpl_vars['tabid']; ?>
<?php echo '");
		}
		$(\'code_'; ?>
<?php echo $this->_tpl_vars['tabid']; ?>
<?php echo '\').value = '; ?>
decode64("<?php echo $this->_tpl_vars['code']; ?>
");<?php echo ';
		editAreaLoader.baseURL = "'; ?>
<?php echo smarty_function_baseUrl(array(), $this);?>
javascript/library/editarea/<?php echo '";
	</script>
'; ?>


<?php if ($this->_tpl_vars['noTabHandling']): ?>
	<script type="text/javascript">
		new Backend.CssEditorHandler($('templateForm_<?php echo $this->_tpl_vars['tabid']; ?>
'), null, '<?php echo $this->_tpl_vars['tabid']; ?>
');
	</script>
<?php endif; ?>