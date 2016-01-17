<?php /* Smarty version 2.6.26, created on 2015-12-01 10:58:04
         compiled from /home/illumin/public_html/application/view///backend/staticPage/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///backend/staticPage/edit.tpl', 2, false),array('function', 'textfield', '/home/illumin/public_html/application/view///backend/staticPage/edit.tpl', 29, false),array('function', 'checkbox', '/home/illumin/public_html/application/view///backend/staticPage/edit.tpl', 39, false),array('function', 'textarea', '/home/illumin/public_html/application/view///backend/staticPage/edit.tpl', 61, false),array('block', 'form', '/home/illumin/public_html/application/view///backend/staticPage/edit.tpl', 21, false),array('block', 'language', '/home/illumin/public_html/application/view///backend/staticPage/edit.tpl', 78, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/staticPage/edit.tpl', 112, false),)), $this); ?>
<?php if (! $this->_tpl_vars['page']['ID']): ?>
	<h1><?php echo smarty_function_translate(array('text' => '_add_new_title'), $this);?>
</h1>
<?php else: ?>
	<h1><?php echo $this->_tpl_vars['page']['title_lang']; ?>
</h1>
	<ul class="menu" id="staticPageMenu">
		<li id="codeMenu">
			<a href="#" class="menu" onclick="pageHandler.showTemplateCode(); return false;"><?php echo smarty_function_translate(array('text' => '_show_template_code'), $this);?>
</a>
		</li>
	</ul>
<?php endif; ?>

<fieldset id="templateCode" style="display: none;">
	<legend><?php echo smarty_function_translate(array('text' => '_template_code'), $this);?>
</legend>
	<?php echo smarty_function_translate(array('text' => '_code_explain'), $this);?>
:
	<br /><br />
	<?php echo '
		&lt;a href="<strong>{pageUrl id='; ?>
<?php echo $this->_tpl_vars['page']['ID']; ?>
<?php echo '}</strong>"&gt;<strong>{pageName id='; ?>
<?php echo $this->_tpl_vars['page']['ID']; ?>
<?php echo '}</strong>&lt;/a&gt;
	'; ?>

</fieldset>

<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.staticPage action=save",'handle' => $this->_tpl_vars['form'],'onsubmit' => "pageHandler.save(this); return false;",'method' => 'post','role' => "page.update(edit),page.create(add)")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

<fieldset class="container" id="editContainer">

	<p>
		<label for="title_<?php echo $this->_tpl_vars['page']['ID']; ?>
" class="wide"><?php echo smarty_function_translate(array('text' => '_title'), $this);?>
:</label>
		<fieldset class="error">
			<?php if ($this->_tpl_vars['page']['ID']): ?>
				<?php echo smarty_function_textfield(array('name' => 'title','class' => 'wider','id' => "title_".($this->_tpl_vars['page']['ID'])), $this);?>

			<?php else: ?>
				<?php echo smarty_function_textfield(array('name' => 'title','class' => 'wider','id' => "title_".($this->_tpl_vars['page']['ID']),'onkeyup' => "$('handle').value = ActiveForm.prototype.generateHandle(this.value);"), $this);?>

			<?php endif; ?>
			<div class="errorText hidden"></div>
		</fieldset>
	</p>

	<fieldset class="error">
		<label><?php echo smarty_function_translate(array('text' => '_add_page_to_menu'), $this);?>
:</label>
		<?php echo smarty_function_checkbox(array('name' => 'menuInformation','class' => 'checkbox','id' => "menuInformation_".($this->_tpl_vars['page']['ID'])), $this);?>

		<label for="menuInformation_<?php echo $this->_tpl_vars['page']['ID']; ?>
" class="checkbox"><?php echo smarty_function_translate(array('text' => '_information_menu'), $this);?>
</label>
	</fieldset>

	<fieldset class="error">
		<label></label>
		<?php echo smarty_function_checkbox(array('name' => 'menuRootCategories','class' => 'checkbox','id' => "menuRootCategories_".($this->_tpl_vars['page']['ID'])), $this);?>

		<label for="menuRootCategories_<?php echo $this->_tpl_vars['page']['ID']; ?>
" class="checkbox"><?php echo smarty_function_translate(array('text' => '_main_header_menu'), $this);?>
</label>
	</fieldset>

	<p>
		<label for="handle" class="wide"><?php echo smarty_function_translate(array('text' => '_handle'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => 'handle','id' => 'handle'), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</p>

	<p>
		<label for="text_<?php echo $this->_tpl_vars['page']['ID']; ?>
" class="wide"><?php echo smarty_function_translate(array('text' => '_text'), $this);?>
:</label>
		<fieldset class="error">
			<div class="textarea" id="textContainer">
				<?php echo smarty_function_textarea(array('class' => 'tinyMCE longDescr','name' => 'text','id' => "text_".($this->_tpl_vars['page']['ID']),'style' => "width: 100%;"), $this);?>

				<div class="errorText hidden" style="margin-top: 5px;"></div>
			</div>
		</fieldset>
	</p>

	<p>
		<label for="metaDecription_<?php echo $this->_tpl_vars['page']['ID']; ?>
" class="wide"><?php echo smarty_function_translate(array('text' => '_meta_description'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_textarea(array('class' => 'longDescr','name' => 'metaDescription','id' => "metaDecription_".($this->_tpl_vars['page']['ID']),'style' => "width: 100%; height: 4em;"), $this);?>

			<div class="errorText hidden" style="margin-top: 5px;"></div>
		</fieldset>
	</p>
	
	
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/fields.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['page'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<p>
			<label for="title_<?php echo $this->_tpl_vars['lang']['ID']; ?>
" class="wide"><?php echo smarty_function_translate(array('text' => '_title'), $this);?>
:</label>
			<fieldset class="error">
				<?php echo smarty_function_textfield(array('name' => "title_".($this->_tpl_vars['lang']['ID']),'class' => 'wider'), $this);?>

				<div class="errorText hidden"></div>
			</fieldset>
		</p>

		<p>
			<label for="text_<?php echo $this->_tpl_vars['lang']['ID']; ?>
" class="wide"><?php echo smarty_function_translate(array('text' => '_text'), $this);?>
:</label>
			<fieldset class="error">
				<div class="textarea" id="textContainer">
					<?php echo smarty_function_textarea(array('class' => 'tinyMCE longDescr','name' => "text_".($this->_tpl_vars['lang']['ID']),'style' => "width: 100%;"), $this);?>

					<div class="errorText hidden" style="margin-top: 5px;"></div>
				</div>
			</fieldset>
		</p>

		<p>
			<label for="metaDecription_<?php echo $this->_tpl_vars['page']['ID']; ?>
_<?php echo $this->_tpl_vars['lang']['ID']; ?>
" class="wide"><?php echo smarty_function_translate(array('text' => '_meta_description'), $this);?>
:</label>
			<fieldset class="error">
				<?php ob_start(); ?><?php echo $this->_tpl_vars['lang']['ID']; ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_textarea(array('class' => 'longDescr','name' => "metaDescription_".($this->_tpl_vars['blockAsParamValue']),'id' => "metaDecription_".($this->_tpl_vars['page']['ID'])."_".($this->_tpl_vars['lang']['ID']),'style' => "width: 100%; height: 4em;"), $this);?>

				<div class="errorText hidden" style="margin-top: 5px;"></div>
			</fieldset>
		</p>

	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</fieldset>

<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['page']['ID']; ?>
" />
<fieldset class="controls">
	<span class="progressIndicator" id="saveIndicator" style="display: none;"></span>
	<input type="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_save','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" class="submit" />
	<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

	<a class="cancel" id="cancel" onclick="return false;" href="#"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
</fieldset>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>