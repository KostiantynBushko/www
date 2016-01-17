<?php /* Smarty version 2.6.26, created on 2015-12-01 16:51:53
         compiled from /home/illumin/public_html/application/view///backend/csvImport/delimiters.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/csvImport/delimiters.tpl', 1, false),array('function', 'includeJs', '/home/illumin/public_html/application/view///backend/csvImport/delimiters.tpl', 4, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/csvImport/delimiters.tpl', 10, false),array('function', 'hidden', '/home/illumin/public_html/application/view///backend/csvImport/delimiters.tpl', 73, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/csvImport/delimiters.tpl', 81, false),array('function', 'selectfield', '/home/illumin/public_html/application/view///backend/csvImport/delimiters.tpl', 116, false),array('function', 'maketext', '/home/illumin/public_html/application/view///backend/csvImport/delimiters.tpl', 195, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/csvImport/delimiters.tpl', 10, false),array('block', 'form', '/home/illumin/public_html/application/view///backend/csvImport/delimiters.tpl', 69, false),array('block', 'error', '/home/illumin/public_html/application/view///backend/csvImport/delimiters.tpl', 119, false),array('modifier', 'branding', '/home/illumin/public_html/application/view///backend/csvImport/delimiters.tpl', 141, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/csvImport/delimiters.tpl', 165, false),)), $this); ?>
<?php echo smarty_function_includeCss(array('file' => "backend/DatabaseImport.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/CsvImport.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "library/ActiveList.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/ActiveForm.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/State.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/Validator.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/CsvImport.js"), $this);?>


<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_import_csv'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="fieldConfigTemplates" class="hidden">
	<span class="ProductPrice.price ProductPrice.listPrice config">
		<span class="block">
			<span class="title">
				<?php echo smarty_function_translate(array('text' => '_currency'), $this);?>

			</span>
			<select name="currency">
				<?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['currency']):
?>
					<option><?php echo $this->_tpl_vars['currency']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</span>
		<span class="block priceGroup">
			<span class="title">
				<?php echo smarty_function_translate(array('text' => '_group'), $this);?>

			</span>
			<select name="group">
				<option></option>
				<?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
					<option value="<?php echo $this->_tpl_vars['group']['ID']; ?>
"><?php echo $this->_tpl_vars['group']['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</span>
		<span class="block priceQuant">
			<span class="title">
				<?php echo smarty_function_translate(array('text' => '_quantity_level'), $this);?>

			</span>
			<select name="quantityLevel">
				<option></option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
			</select>
		</span>
	</span>
	<span class="Product.name Product.shortDescription Product.longDescription Product.keywords NewsPost.text NewsPost.moreText Category.name Category.description config">
		<span class="block">
			<span class="title">
				<?php echo smarty_function_translate(array('text' => '_language'), $this);?>

			</span>
			<select name="language">
				<?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
					<option value="<?php echo $this->_tpl_vars['language']['ID']; ?>
"><?php echo $this->_tpl_vars['language']['originalName']; ?>
 (<?php echo $this->_tpl_vars['language']['name']; ?>
)</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</span>
	</span>
</div>

<div id="importDelimiters">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/csvImport/wizardProgress.tpl", 'smarty_include_vars' => array('class' => 'stepDelimiters')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.csvImport action=preview",'method' => 'POST','id' => 'delimitersForm','handle' => $this->_tpl_vars['form'],'onsubmit' => "Backend.CsvImport.cont(); return false;")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

	<div id="import">

	<?php echo smarty_function_hidden(array('name' => 'file'), $this);?>

	<?php echo smarty_function_hidden(array('name' => 'category'), $this);?>

	<?php echo smarty_function_hidden(array('name' => 'type'), $this);?>

	<?php echo smarty_function_hidden(array('name' => 'continue'), $this);?>

	<?php echo smarty_function_hidden(array('name' => 'uid'), $this);?>

	<?php echo smarty_function_hidden(array('name' => 'options'), $this);?>


	<span style="display: none;">
		<span id="fieldsUrl"><?php echo smarty_function_link(array('controller' => "backend.csvImport",'action' => 'fields'), $this);?>
</span>
		<span id="importUrl"><?php echo smarty_function_link(array('controller' => "backend.csvImport",'action' => 'import'), $this);?>
</span>
		<span id="cancelUrl"><?php echo smarty_function_link(array('controller' => "backend.csvImport",'action' => 'isCancelled'), $this);?>
</span>
	</span>

	<fieldset id="info">
		<form>
			<p>
				<label><?php echo smarty_function_translate(array('text' => '_import_file'), $this);?>
</label>
				<label class="wide"><?php echo $this->_tpl_vars['file']; ?>
</label>
			</p>

			<?php if ('ProductImport' == $this->_tpl_vars['type']): ?>
			<p>
				<label><?php echo smarty_function_translate(array('text' => '_import_category'), $this);?>
</label>
				<label class="wide">
					<?php $_from = $this->_tpl_vars['catPath']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['catPath'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['catPath']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['node']):
        $this->_foreach['catPath']['iteration']++;
?>
						<a href="<?php echo smarty_function_link(array('controller' => "backend.csvImport",'action' => 'index'), $this);?>
?file=<?php echo $this->_tpl_vars['file']; ?>
&category=<?php echo $this->_tpl_vars['node']['ID']; ?>
&selectCategory=true"><?php echo $this->_tpl_vars['node']['name_lang']; ?>
</a>
						<?php if (! ($this->_foreach['catPath']['iteration'] == $this->_foreach['catPath']['total'])): ?>
							&gt;
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				</label>
			</p>
			<?php endif; ?>

		</form>
	</fieldset>

	<fieldset id="delimiters">
		<legend><?php echo smarty_function_translate(array('text' => '_set_delimiter'), $this);?>
</legend>

		<p class="required">
			
				<label for="delimiter"><span class="label"><?php echo smarty_function_translate(array('text' => '_delimiter'), $this);?>
 </span></label>
				<fieldset class="error"><?php echo smarty_function_selectfield(array('name' => 'delimiter','options' => $this->_tpl_vars['delimiters'],'onchange' => "Backend.CsvImport.updatePreview()"), $this);?>

				<span id="previewIndicator" class="progressIndicator" style="display: none;"></span>
			
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'delimiter')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'delimiter')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
		</p>
	</fieldset>

	<div class="clear"></div>

	<div id="cancelCompleteMessage" class="yellowMessage" style="display: none;">
		<div style="float: left; margin-bottom: 1em;"><?php echo smarty_function_translate(array('text' => '_import_cancelled'), $this);?>
</div>
	</div>

	<div id="cancelFailureMessage" class="redMessage" style="display: none;">
		<div style="float: left; margin-bottom: 1em;"><?php echo smarty_function_translate(array('text' => '_import_cancel_failed'), $this);?>
</div>
	</div>

	<div id="nonTransactionalMessage" class="redMessage" style="display: none;">
		<div style="float: left; margin-bottom: 1em;"><?php echo smarty_function_translate(array('text' => '_timeout_error'), $this);?>
</div>
	</div>

	<div class="clear"></div>

	<fieldset id="columns" style="display: none;">
		<legend><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_map_data'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__map_data', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__map_data'])) ? $this->_run_mod_handler('branding', true, $_tmp) : $this->_plugins['modifier']['branding'][0][0]->branding($_tmp)); ?>
</legend>

		<div id="importProfiles">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/csvImport/profiles.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

		<div id="fieldsContainer"></div>
		<div class="clear"></div>

		<fieldset class="error">
			<?php echo smarty_function_hidden(array('name' => 'err'), $this);?>

			<div class="errorText" style="display: none; margin-top: 0.5em;"></div>
		</fieldset>
	</fieldset>

	<div class="clear"></div>

	<fieldset class="controls" id="importControls">
		<p class="saveProfile" style="display: none;">
			<input type="checkbox" class="checkbox" name="saveProfile" id="saveProfile" />
			<label for="saveProfile" class="checkbox" style="margin-right: 1em;"><?php echo smarty_function_translate(array('text' => '_save_profile'), $this);?>
:</label>
			<input type="text" class="text" name="profileName" id="profileName" disabled="disabled" />
		</p>
		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_continue','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
		<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

		<a class="cancel" href="<?php echo smarty_function_link(array('controller' => "backend.csvImport"), $this);?>
"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
	</fieldset>

	<div class="clear"></div>

	<div id="completeMessage" class="yellowMessage stick" style="display: none;">
		<div style="float: left; margin-bottom: 1em;"><?php echo smarty_function_translate(array('text' => '_import_completed'), $this);?>
</div>
	</div>

	<div class="clear"></div>

	<fieldset id="progress" style="display: none;">
		<legend><?php echo smarty_function_translate(array('text' => '_importing'), $this);?>
</legend>
		<div class="progressBarIndicator"></div>
		<div class="progressBar" style="display: none;">
			<span class="progressCount"></span>
			<span class="progressSeparator"> / </span>
			<span class="progressTotal"></span>
		</div>
		<a class="cancel" href="#" onclick="Backend.CsvImport.cancel(); return false;"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
		<div class="lastName"></div>
	</fieldset>

	</div>

	<div class="clear"></div>

	<fieldset id="preview">
		<legend><?php echo smarty_function_maketext(array('text' => '_preview_count','params' => ($this->_tpl_vars['previewCount']).",".($this->_tpl_vars['total'])), $this);?>
</legend>
			<div id="previewContainer">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/csvImport/preview.tpl", 'smarty_include_vars' => array('preview' => $this->_tpl_vars['preview'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
	</fieldset>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>


</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>