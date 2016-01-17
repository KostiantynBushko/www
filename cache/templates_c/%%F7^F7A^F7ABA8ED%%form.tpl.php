<?php /* Smarty version 2.6.26, created on 2015-12-02 13:45:48
         compiled from custom:backend/filterGroup/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', 'custom:backend/filterGroup/form.tpl', 1, false),array('function', 'translate', 'custom:backend/filterGroup/form.tpl', 4, false),array('function', 'toolTip', 'custom:backend/filterGroup/form.tpl', 9, false),array('function', 'img', 'custom:backend/filterGroup/form.tpl', 68, false),array('block', 'denied', 'custom:backend/filterGroup/form.tpl', 1, false),array('block', 'allowed', 'custom:backend/filterGroup/form.tpl', 44, false),array('block', 'language', 'custom:backend/filterGroup/form.tpl', 100, false),)), $this); ?>
<form action="<?php echo smarty_function_link(array('controller' => "backend.filterGroup",'action' => 'update'), $this);?>
" method="post" class="filter" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>class="formReadonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
	<!-- STEP 1 -->
	<fieldset class="filter_step_lev1 filter_step_main">
	<legend><?php echo smarty_function_translate(array('text' => '_Filter_step_one'), $this);?>
</legend>

		<input type="hidden" name="ID" class="hidden filter_form_id" />

		<p class="filter_specField">
			<label class="filter_form_specFieldID_label"><?php echo smarty_function_toolTip(array('label' => '_Filter_associated_field'), $this);?>
</label>
			<fieldset class="error">
	 			<select name="specFieldID" class="filter_form_specFieldID" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>disabled="disabled"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>></select>
				<div class="filter_form_specFieldText"></div>
				<span class="errorText hidden"> </span>
			</fieldset>
		</p>

		<p class="required">
			<label class="filter_form_name_label"><?php echo smarty_function_toolTip(array('label' => '_Filter_name'), $this);?>
</label>
			<fieldset class="error">
				<input type="text" name="name" class="filter_form_name" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
				<span class="errorText hidden"> </span>
			</fieldset>
		</p>

		<p class="required">
			<label class="filter_form_displayLocation_label"><?php echo smarty_function_toolTip(array('label' => '_Filter_displayLocation'), $this);?>
</label>
			<fieldset class="error">
				<select name="displayLocation" class="filter_form_displayLocation" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
					<option value="0"><?php echo smarty_function_translate(array('text' => '_side_menu'), $this);?>
</option>
					<option value="1"><?php echo smarty_function_translate(array('text' => '_top_menu'), $this);?>
</option>
				</select>
				<span class="errorText hidden"> </span>
			</fieldset>
		</p>

		<!-- STEP 2 -->
		<fieldset class="filter_step_lev1 filter_step_filters error">
		<legend><?php echo smarty_function_translate(array('text' => '_filters'), $this);?>
</legend>
			<p>
			<fieldset class="group filter_form_filters_group">
				<h2 class="filter_filters_title"><?php echo smarty_function_toolTip(array('label' => '_Filter_filters'), $this);?>
</h2>
				<div class="filter_filters">
					<p>
						<ul class="<?php $this->_tag_stack[] = array('allowed', array('role' => "category.update")); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>activeList_add_sort activeList_add_delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
							<li class="dom_template filter_form_filters_value filter_form_filters_value_main filter_update" id="filter_form_filters_">
								<span>
									<span class="filter_name">
										<label class="filter_update"><?php echo smarty_function_translate(array('text' => '_Filter_name'), $this);?>
</label>
										<fieldset class="error">
											<input type="text" class="filter_update" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
											<span class="errorText hidden"> </span>
										</fieldset>
									</span>

									<span class="filter_range">
										<label class="filter_update"><?php echo smarty_function_translate(array('text' => '_Filter_range'), $this);?>
</label>
										<fieldset class="error">
											<input type="text" class="filter_update" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> /> - <input type="text" class="filter_update" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
											<span class="errorText hidden"> </span>
										</fieldset>
									</span>

									<span class="filter_date_range">
										<label class="filter_update"><?php echo smarty_function_translate(array('text' => '_Filter_date_range'), $this);?>
</label>
										<fieldset class="error">
											<input type="text" class="filter_update" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
											<span <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
												<?php echo smarty_function_img(array('src' => "image/silk/calendar.png",'class' => 'calendar_button filter_update'), $this);?>

											</span>

											-

											<input type="text" class="filter_update"  <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
											<span <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
												<?php echo smarty_function_img(array('src' => "image/silk/calendar.png",'class' => 'calendar_button'), $this);?>

											</span>

											<input type="hidden" class="hidden filter_date_start_real filter_update"  <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
											<input type="hidden" class="hidden filter_date_end_real filter_update"  <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
											<span class="errorText hidden"> </span>
										</fieldset>
									</span>
									<br />
								</span>
							</li>
						</ul>
					</p>
					<p class="filter_crate_filters">
						<a href="#add" class="filter_add_filter menu" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>><?php echo smarty_function_translate(array('text' => '_Filter_add_filter'), $this);?>
</a>
					</p>
				</div>

				<br class="clear" />
			</fieldset>
			</p>
		</fieldset>

		<!-- STEP 3 -->
		<fieldset class="filter_step_translations container">
		<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<fieldset class="activeForm_translation_values filter_language_translation">
				<fieldset class="error">
					<label><?php echo smarty_function_translate(array('text' => '_Filter_name'), $this);?>
</label>
					<input type="text" name="name_<?php echo $this->_tpl_vars['lang']['ID']; ?>
" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
				</fieldset>
			</fieldset>

			<h5 class="filter_filters_title"><?php echo smarty_function_translate(array('text' => '_Filter_filters'), $this);?>
:</h5>
			<fieldset class="filters_translations_fieldset">
				<ul class="filters_translations_<?php echo $this->_tpl_vars['lang']['ID']; ?>
">
					<li class="dom_template filter_form_filters_value" id="filter_form_filters_">
						<label class="filter_update"> </label>
						<input type="text" class="filter_update"  <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
						<br />
					</li>
				</ul>
			</fieldset>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</fieldset>
	</fieldset>


	<fieldset class="filter_controls controls">
		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" class="filter_save button submit" value="<?php echo smarty_function_translate(array('text' => '_save'), $this);?>
" />
		<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

		<a href="#cancel" class="filter_cancel cancel"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
	</fieldset>
</form>