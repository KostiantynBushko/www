<?php /* Smarty version 2.6.26, created on 2015-12-01 16:51:06
         compiled from /home/illumin/public_html/application/view///backend/csvImport/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/csvImport/index.tpl', 1, false),array('function', 'includeJs', '/home/illumin/public_html/application/view///backend/csvImport/index.tpl', 4, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/csvImport/index.tpl', 12, false),array('function', 'selectfield', '/home/illumin/public_html/application/view///backend/csvImport/index.tpl', 25, false),array('function', 'filefield', '/home/illumin/public_html/application/view///backend/csvImport/index.tpl', 34, false),array('function', 'textfield', '/home/illumin/public_html/application/view///backend/csvImport/index.tpl', 48, false),array('function', 'hidden', '/home/illumin/public_html/application/view///backend/csvImport/index.tpl', 68, false),array('function', 'checkbox', '/home/illumin/public_html/application/view///backend/csvImport/index.tpl', 90, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/csvImport/index.tpl', 101, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/csvImport/index.tpl', 12, false),array('block', 'form', '/home/illumin/public_html/application/view///backend/csvImport/index.tpl', 20, false),array('block', 'error', '/home/illumin/public_html/application/view///backend/csvImport/index.tpl', 36, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/csvImport/index.tpl', 48, false),)), $this); ?>
<?php echo smarty_function_includeCss(array('file' => "backend/DatabaseImport.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/CsvImport.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "library/ActiveList.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/ActiveForm.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/State.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/Validator.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/SelectFile.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/Category.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/CsvImport.js"), $this);?>


<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_import_csv'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="import">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/csvImport/wizardProgress.tpl", 'smarty_include_vars' => array('class' => 'stepSelect')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.csvImport action=setFile",'method' => 'POST','handle' => $this->_tpl_vars['form'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

	<fieldset>
		<legend><?php echo smarty_function_translate(array('text' => '_data_type'), $this);?>
</legend>
		<label></label>
		<?php echo smarty_function_selectfield(array('name' => 'type','options' => $this->_tpl_vars['types']), $this);?>

	</fieldset>

	<fieldset>
		<legend><?php echo smarty_function_translate(array('text' => '_select_file'), $this);?>
</legend>

		<p class="required">
			
				<label for="upload"><span class="label"><?php echo smarty_function_translate(array('text' => '_upload_file'), $this);?>
 </span></label>
				<fieldset class="error"><?php echo smarty_function_filefield(array('name' => 'upload'), $this);?>

			
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'upload')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'upload')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
		</p>

		<p>
			<label></label>
			- <?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 -
		</p>

		<p class="required">
			
				<label for="atServer"><span class="label"><?php echo smarty_function_translate(array('text' => '_select_at_server'), $this);?>
 </span></label>
				<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'atServer','id' => 'atServer','class' => 'file'), $this);?>
<input type="button" class="button browse" id="selectAtServer" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_browse','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
			
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'atServer')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'atServer')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
		</p>
	</fieldset>

	<fieldset>
		<legend><?php echo smarty_function_translate(array('text' => '_options'), $this);?>
</legend>

		<p class="required">
			<label><?php echo smarty_function_translate(array('text' => '_target_category'), $this);?>
</label>
			<label id="targetCategory">
				<?php $_from = $this->_tpl_vars['catPath']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['catPath'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['catPath']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['node']):
        $this->_foreach['catPath']['iteration']++;
?>
					<a href="#" onclick="Backend.CsvImport.showCategorySelector(<?php echo $this->_tpl_vars['node']['ID']; ?>
); return false;"><?php echo $this->_tpl_vars['node']['name_lang']; ?>
</a>
					<?php if (! ($this->_foreach['catPath']['iteration'] == $this->_foreach['catPath']['total'])): ?>
						&gt;
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			</label>
			<?php echo smarty_function_hidden(array('id' => 'categoryID','name' => 'category'), $this);?>

		</p>

		<div class="options">
			<p>
				<label><?php echo smarty_function_translate(array('text' => '_import_action'), $this);?>
</label>
				<select name="options[action]">
					<option value="both"><?php echo smarty_function_translate(array('text' => '_add_and_update'), $this);?>
</option>
					<option value="add"><?php echo smarty_function_translate(array('text' => '_add_only'), $this);?>
</option>
					<option value="update"><?php echo smarty_function_translate(array('text' => '_update_only'), $this);?>
</option>
				</select>
			</p>
			<p>
				<label><?php echo smarty_function_translate(array('text' => '_import_missing_products'), $this);?>
</label>
				<select name="options[missing]">
					<option value="keep"><?php echo smarty_function_translate(array('text' => '_keep_intact'), $this);?>
</option>
					<option value="disable"><?php echo smarty_function_translate(array('text' => '_disable'), $this);?>
</option>
					<option value="delete"><?php echo smarty_function_translate(array('text' => '_delete'), $this);?>
</option>
				</select>
			</p>
			<p>
				<label></label>
				<?php echo smarty_function_checkbox(array('name' => "options[transaction]",'id' => 'options_transaction','class' => 'checkbox'), $this);?>

				<label class="checkbox acronym" for="options_transaction"><a><?php echo smarty_function_translate(array('text' => '_enclose_transaction'), $this);?>
<div><?php echo smarty_function_translate(array('text' => '_transaction_descr'), $this);?>
</div></a></label>
			</p>
		</div>

	</fieldset>

	<fieldset class="controls">
		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_continue','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
		<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

		<a class="cancel" href="<?php echo smarty_function_link(array('controller' => "backend.csvImport"), $this);?>
"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
	</fieldset>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>

<?php echo '
	<script type="text/javascript">
		Backend.SelectFile.url = '; ?>
'<?php echo smarty_function_link(array('controller' => "backend.selectFile"), $this);?>
'<?php echo ';
		Backend.Category.links.popup = '; ?>
'<?php echo smarty_function_link(array('controller' => "backend.category",'action' => 'popup'), $this);?>
'<?php echo ';
		Event.observe($(\'selectAtServer\'), \'click\', function() {new Backend.SelectFile($(\'atServer\')); });
	</script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>