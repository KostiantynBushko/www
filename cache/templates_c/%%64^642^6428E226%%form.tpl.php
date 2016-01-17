<?php /* Smarty version 2.6.26, created on 2015-12-02 13:45:48
         compiled from custom:backend/specField/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/specField/form.tpl', 2, false),array('function', 'link', 'custom:backend/specField/form.tpl', 6, false),array('function', 'toolTip', 'custom:backend/specField/form.tpl', 15, false),array('block', 'denied', 'custom:backend/specField/form.tpl', 6, false),array('block', 'language', 'custom:backend/specField/form.tpl', 109, false),array('block', 'allowed', 'custom:backend/specField/form.tpl', 142, false),array('modifier', 'escape', 'custom:backend/specField/form.tpl', 155, false),)), $this); ?>
<ul class="tabs tabList">
	<li class="active"><a href="#step_main" class="specField_change_state" ><?php echo smarty_function_translate(array('text' => '_SpecField_main'), $this);?>
</a></li>
	<li class=""><a href="#step_values" class="specField_change_state" ><?php echo smarty_function_translate(array('text' => '_SpecField_values'), $this);?>
</a></li>
</ul>

<form action="<?php echo smarty_function_link(array('controller' => "backend.specField",'action' => 'save'), $this);?>
" method="post" class="specField <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>formReadonly<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
	<!-- STEP 1 -->
	<fieldset class="specField_step_lev1 specField_step_main">
	<legend><?php echo smarty_function_translate(array('text' => '_SpecField_step_one'), $this);?>
</legend>

		<input type="hidden" name="ID" class="hidden specField_form_id" />
		<input type="hidden" name="categoryID" class="hidden specField_form_categoryID" />

		<p>
			<label class="specField_form_type_label"><?php echo smarty_function_toolTip(array('label' => '_SpecField_type'), $this);?>
</label>
			<fieldset class="error">
				<select name="type" class="specField_form_type" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>disabled="disabled"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
					<optgroup label="<?php echo smarty_function_translate(array('text' => '_SpecField_text'), $this);?>
">
						<option value="5"><?php echo smarty_function_translate(array('text' => '_SpecField_type_text_selector'), $this);?>
</option>
						<option value="3"><?php echo smarty_function_translate(array('text' => '_SpecField_type_simple_text'), $this);?>
</option>
					</optgroup>
					<optgroup label="<?php echo smarty_function_translate(array('text' => '_SpecField_numbers'), $this);?>
">
						<option value="1"><?php echo smarty_function_translate(array('text' => '_SpecField_type_numbers_selector'), $this);?>
</option>
						<option value="2"><?php echo smarty_function_translate(array('text' => '_SpecField_type_numbers'), $this);?>
</option>
					</optgroup>
					<option value="6"><?php echo smarty_function_translate(array('text' => '_SpecField_type_date'), $this);?>
</option>
				</select>
				<span class="errorText hidden"> </span>
			</fieldset>
		</p>

		<p class="checkbox">
			<input type="checkbox" value="1" name="isMultiValue" class="checkbox specField_form_multipleSelector" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>disabled="disabled"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
			<input type="hidden" value="1" name="checkbox_isMultiValue" />
			<label class="specField_form_multipleSelector_label"><?php echo smarty_function_toolTip(array('label' => '_SpecField_select_multiple'), $this);?>
</label>
		</p>

		<p class="checkbox specField_form_advancedText">
			<input type="checkbox" value="1" name="advancedText" class="checkbox" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>disabled="disabled"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
			<label class="specField_form_advancedText_label"><?php echo smarty_function_toolTip(array('label' => '_SpecField_formated_text'), $this);?>
</label>
		</p>

		<div>
			<p class="required">
				<label class="specField_form_name_label"><?php echo smarty_function_toolTip(array('label' => '_SpecField_title'), $this);?>
</label>
				<fieldset class="error">
					<input type="text" name="name" class="specField_form_name" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
					<span class="errorText hidden"> </span>
				</fieldset>
			</p>

			<p class="specField_handle">
				<label  class="specField_form_handle_label"><?php echo smarty_function_toolTip(array('label' => '_SpecField_handle'), $this);?>
</label>
				<fieldset class="error">
					<input type="text" name="handle" class="specField_form_handle" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
					<span class="errorText hidden"> </span>
				</fieldset>
			</p>

			<p>
				<label  class="specField_form_valuePrefix_label sufixAndPrefix"><?php echo smarty_function_toolTip(array('label' => '_SpecField_valuePrefix'), $this);?>
</label>
				<fieldset class="error sufixAndPrefix">
					<input type="text" name="valuePrefix" class="specField_form_valuePrefix" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
					<span class="errorText hidden"> </span>
				</fieldset>
			</p>

			<p>
				<label  class="specField_form_valueSuffix_label sufixAndPrefix"><?php echo smarty_function_toolTip(array('label' => '_SpecField_valueSuffix'), $this);?>
</label>
				<fieldset class="error sufixAndPrefix">
					<input type="text" name="valueSuffix" class="specField_form_valueSuffix" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
					<span class="errorText hidden"> </span>
				</fieldset>
			</p>

			<p>
				<label class="specField_form_description_label"><?php echo smarty_function_translate(array('text' => '_SpecField_description'), $this);?>
</label>

				<fieldset class="error">
					<textarea name="description" class="specField_form_description" rows="5" cols="40" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>></textarea>
					<span class="errorText hidden"> </span>
				</fieldset>
			</p>

		</div>

		<p class="checkbox">
			<input type="checkbox" value="1" name="isRequired" class="checkbox specField_form_isRequired" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>disabled="disabled"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
			<label class="specField_form_isRequired_label"><?php echo smarty_function_toolTip(array('label' => '_SpecField_is_required'), $this);?>
</label>
		</p>

		<p class="checkbox isDisplayed">
			<input type="checkbox" value="1" name="isDisplayed" class="checkbox specField_form_isDisplayed" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>disabled="disabled"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
			<label class="specField_form_isDisplayed_label"><?php echo smarty_function_toolTip(array('label' => '_SpecField_displayed_on_front_page'), $this);?>
</label>
		</p>

		<p class="checkbox isDisplayedInList">
			<input type="checkbox" value="1" name="isDisplayedInList" class="checkbox specField_form_isDisplayedInList" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>disabled="disabled"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
			<label class="specField_form_isDisplayedInList_label"><?php echo smarty_function_toolTip(array('label' => '_SpecField_displayed_in_product_list'), $this);?>
</label>
		</p>

		<p class="checkbox isSortable">
			<input type="checkbox" value="1" name="isSortable" class="checkbox specField_form_isSortable" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>disabled="disabled"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
			<label class="specField_form_isSortable_label"><?php echo smarty_function_toolTip(array('label' => '_SpecField_sortable'), $this);?>
</label>
		</p>

		<div class="clear"></div>

		<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

			<p>
				<label class="translation_name_label"><?php echo smarty_function_translate(array('text' => '_SpecField_title'), $this);?>
</label>
				<input type="text" name="name_<?php echo $this->_tpl_vars['lang']['ID']; ?>
" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
			</p>
			<p>
				<label class="translation_valuePrefix_label sufixAndPrefix"><?php echo smarty_function_toolTip(array('label' => '_SpecField_valuePrefix'), $this);?>
</label>
				<input type="text" class="sufixAndPrefix" name="valuePrefix_<?php echo $this->_tpl_vars['lang']['ID']; ?>
" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
			</p>
			<p>
				<label class="translation_valueSuffix_label sufixAndPrefix"><?php echo smarty_function_toolTip(array('label' => '_SpecField_valueSuffix'), $this);?>
</label>
				<input type="text" class="sufixAndPrefix" name="valueSuffix_<?php echo $this->_tpl_vars['lang']['ID']; ?>
" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
			</p>
			<p>
				<label class="translation_description_label"><?php echo smarty_function_translate(array('text' => '_SpecField_description'), $this);?>
</label>
				<textarea name="description_<?php echo $this->_tpl_vars['lang']['ID']; ?>
" rows="5" cols="40" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>></textarea>
			</p>

		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	</fieldset>

	<!-- STEP 2 -->
	<fieldset class="specField_step_lev1 specField_step_values">
	<legend><?php echo smarty_function_translate(array('text' => '_SpecField_step_two'), $this);?>
</legend>
		<a href="#mergeValues" class="specField_mergeValuesLink menu"><?php echo smarty_function_translate(array('text' => '_specField_merge_values'), $this);?>
</a>
		<a href="#mergeValues" class="specField_mergeValuesCancelLink cancel" style="display: none;"><?php echo smarty_function_translate(array('text' => '_specField_cancel_merge_values'), $this);?>
</a>

		<p>
		<fieldset class="group specField_form_values_group">
			<div class="specField_values">
				<p>
					<ul class="<?php $this->_tag_stack[] = array('allowed', array('role' => "category.update")); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>activeList_add_sort activeList_add_delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
						<li class="dom_template specField_form_values_value singleInput specField_update" id="specField_form_values_" style="display: block;">
							<input type="checkbox" value="1" class="specField_mergeCheckbox checkbox" style="display: none;"  <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>disabled="disabled"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
							<input type="text" class="specField_update specField_valueName" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
							<span class="errorText hidden"> </span>
							<br class="clear" />
						</li>
					</ul>
				</p>
				<p class="specField_values_controls">
					<a href="#add" class="specField_add_field"><?php echo smarty_function_translate(array('text' => '_SpecField_add_values'), $this);?>
</a>
					<span class="specField_mergeValuesControls controls" style="display: none">
						<span class="progressIndicator" style="display: none;"></span>
						<input type="button" class="submit specField_mergeValuesSubmit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_specField_merge_values','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
						<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

						<a href="#" class="cancel specField_mergeValuesCancel"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
					</span>
				</p>

				<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<ul>
						<li class="dom_template specField_form_values_value" id="specField_form_values_">
							<fieldset class="error">
								<label class="specField_update"> </label>
								<input class="specField_update" type="text" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
							</fieldset>
						</li>
					</ul>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>


			</div>

			<div class="clear"></div>
		</fieldset>
		</p>

	</fieldset>


	<fieldset class="specField_controls controls">
		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" class="specField_save button submit" value="<?php echo smarty_function_translate(array('text' => '_save'), $this);?>
" />
		<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

		<a href="#cancel" class="specField_cancel cancel"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
	</fieldset>

</form>