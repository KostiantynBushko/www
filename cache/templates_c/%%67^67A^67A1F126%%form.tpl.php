<?php /* Smarty version 2.6.26, created on 2015-12-01 12:15:16
         compiled from custom:backend/newsletter/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:backend/newsletter/form.tpl', 1, false),array('function', 'translate', 'custom:backend/newsletter/form.tpl', 3, false),array('function', 'textfield', 'custom:backend/newsletter/form.tpl', 20, false),array('function', 'textarea', 'custom:backend/newsletter/form.tpl', 29, false),)), $this); ?>
<?php if (((is_array($_tmp='HTML_EMAIL')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
	<p class="required">
		<label for="newsletter_<?php echo $this->_tpl_vars['newsletter']['ID']; ?>
_format"><?php echo smarty_function_translate(array('text' => '_message_format'), $this);?>
:</label>
		<fieldset class="error">
			<select id="newsletter_<?php echo $this->_tpl_vars['newsletter']['ID']; ?>
_format" name="newsletter_<?php echo $this->_tpl_vars['newsletter']['ID']; ?>
_format">
				<option value="1"><?php echo smarty_function_translate(array('text' => '_html_with_auto_generated_plaintext_version'), $this);?>
</option>
				<option value="2" <?php if ($this->_tpl_vars['newsletter']['format'] == 2): ?>selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('text' => '_html_with_manualy_edited_plaintext_version'), $this);?>
</option>
				<option value="3" <?php if ($this->_tpl_vars['newsletter']['format'] == 3): ?>selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('text' => '_html_only'), $this);?>
</option>
				<option value="4" <?php if ($this->_tpl_vars['newsletter']['format'] == 4): ?>selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('text' => '_plaintext_only'), $this);?>
</option>
			</select>
		</fieldset>
	</p>
<?php else: ?>
	<input type="hidden" id="newsletter_<?php echo $this->_tpl_vars['newsletter']['ID']; ?>
_format" name="newsletter_<?php echo $this->_tpl_vars['newsletter']['ID']; ?>
_format" value="4" />
<?php endif; ?>

<p class="required">
	<label for="newsletter_<?php echo $this->_tpl_vars['newsletter']['ID']; ?>
_name"><?php echo smarty_function_translate(array('text' => '_subject'), $this);?>
:</label>
	<fieldset class="error">
		<?php echo smarty_function_textfield(array('name' => 'subject','id' => "newsletter_".($this->_tpl_vars['newsletter']['ID'])."_name",'class' => 'wide'), $this);?>

		<div class="errorText hidden"></div>
	</fieldset>
</p>

<p class="required">
	<label for="newsletter_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['newsletter']['ID']; ?>
_html"><?php echo smarty_function_translate(array('text' => '_message_text_html'), $this);?>
:</label>
	<div class="textarea">
		<fieldset class="error">
			<?php echo smarty_function_textarea(array('id' => "newsletter_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['newsletter']['ID'])."_html",'name' => 'html','class' => 'tinyMCE'), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</div>
</p>

<p class="required">
	<label for="newsletter_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['newsletter']['ID']; ?>
_shortdes"><?php echo smarty_function_translate(array('text' => '_text'), $this);?>
:</label>
	<div class="textarea">
		<fieldset class="error">
			<?php echo smarty_function_textarea(array('id' => "newsletter_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['newsletter']['ID'])."_shortdes",'name' => 'text'), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</div>
</p>




