<?php /* Smarty version 2.6.26, created on 2015-12-02 13:45:48
         compiled from custom:backend/productOption/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/productOption/form.tpl', 2, false),array('function', 'link', 'custom:backend/productOption/form.tpl', 6, false),array('function', 'toolTip', 'custom:backend/productOption/form.tpl', 17, false),array('function', 'maketext', 'custom:backend/productOption/form.tpl', 102, false),array('block', 'language', 'custom:backend/productOption/form.tpl', 135, false),)), $this); ?>
<ul class="tabs">
	<li class="active"><a href="#step_main" class="productOption_change_state" ><?php echo smarty_function_translate(array('text' => '_ProductOption_main'), $this);?>
</a></li>
	<li><a href="#step_values" class="productOption_change_state" ><?php echo smarty_function_translate(array('text' => '_ProductOption_values'), $this);?>
</a></li>
</ul>

<form action="<?php echo smarty_function_link(array('controller' => "backend.productOption",'action' => 'save'), $this);?>
" method="post" class="productOption">
	<!-- STEP 1 -->
	<fieldset class="productOption_step_lev1 productOption_step_main">
	<legend><?php echo smarty_function_translate(array('text' => '_ProductOption_step_one'), $this);?>
</legend>

		<input type="hidden" name="ID" class="hidden productOption_form_id" />
		<input type="hidden" name="parentID" class="hidden productOption_form_parentID" />

		<p class="checkbox">
			<input type="checkbox" value="1" name="isRequired" class="checkbox productOption_form_isRequired" />
			<input type="hidden" value="1" name="checkbox_isRequired" />
			<label class="productOption_form_isRequired_label"><?php echo smarty_function_toolTip(array('label' => '_ProductOption_is_required'), $this);?>
</label>
		</p>

		<p class="checkbox">
			<input type="checkbox" value="1" name="isDisplayed" class="checkbox productOption_form_isDisplayed" />
			<input type="hidden" value="1" name="checkbox_isDisplayed" />
			<label class="productOption_form_isDisplayed_label"><?php echo smarty_function_toolTip(array('label' => '_ProductOption_displayed_in_product_page'), $this);?>
</label>
		</p>

		<p class="checkbox" style="display: none;">
			<input type="checkbox" value="1" name="isDisplayedInList" class="checkbox productOption_form_isDisplayedInList" />
			<input type="hidden" value="1" name="checkbox_isDisplayedInList" />
			<label class="productOption_form_isDisplayedInList_label"><?php echo smarty_function_translate(array('text' => '_ProductOption_displayed_in_list'), $this);?>
</label>
		</p>

		<p class="checkbox">
			<input type="checkbox" value="1" name="isDisplayedInCart" class="checkbox productOption_form_isDisplayedInCart" />
			<input type="hidden" value="1" name="checkbox_isDisplayedInCart" />
			<label class="productOption_form_isDisplayedInCart_label"><?php echo smarty_function_toolTip(array('label' => '_ProductOption_displayed_in_cart'), $this);?>
</label>
		</p>

		<p class="checkbox">
			<input type="checkbox" value="1" name="isPriceIncluded" class="checkbox productOption_form_isPriceIncluded" />
			<input type="hidden" value="1" name="checkbox_isPriceIncluded" />
			<label class="productOption_form_isPriceIncluded_label"><?php echo smarty_function_toolTip(array('label' => '_ProductOption_price_included'), $this);?>
</label>
		</p>

		<p class="required">
			<label class="productOption_form_type_label"><?php echo smarty_function_toolTip(array('label' => '_ProductOption_type'), $this);?>
</label>
			<fieldset class="error">
				<select name="type" class="productOption_form_type">
					<option value="0"><?php echo smarty_function_translate(array('text' => '_ProductOption_type_bool'), $this);?>
</option>
					<option value="1"><?php echo smarty_function_translate(array('text' => '_ProductOption_type_select'), $this);?>
</option>
					<option value="2"><?php echo smarty_function_translate(array('text' => '_ProductOption_type_text'), $this);?>
</option>
					<option value="3"><?php echo smarty_function_translate(array('text' => '_ProductOption_type_file'), $this);?>
</option>
					<option value="4">HTML code</option>
				</select>
				<span class="errorText hidden"> </span>
			</fieldset>
		</p>

		<div>
			<p class="required">
				<label class="productOption_form_name_label"><?php echo smarty_function_translate(array('text' => '_ProductOption_title'), $this);?>
</label>
				<fieldset class="error">
					<input type="text" name="name" class="productOption_form_name"  />
					<span class="errorText hidden"> </span>
				</fieldset>
			</p>
		</div>

		<div class="optionSelectMessage">
			<p>
				<label class="productOption_form_displayType_label"><?php echo smarty_function_toolTip(array('label' => '_ProductOption_display_as'), $this);?>
</label>
				<fieldset class="error">
					<select name="displayType" class="productOption_form_displayType">
						<option value="0"><?php echo smarty_function_translate(array('text' => '_ProductOption_displayType_selectBox'), $this);?>
</option>
						<option value="1"><?php echo smarty_function_translate(array('text' => '_ProductOption_displayType_radioButtons'), $this);?>
</option>
					</select>
					<span class="errorText hidden"> </span>
				</fieldset>
			</p>

			<p>
				<label class="productOption_form_selectMessage_label"><?php echo smarty_function_toolTip(array('label' => '_ProductOption_selectMessage'), $this);?>
</label>
				<fieldset class="error">
					<input type="text" name="selectMessage" class="productOption_form_selectMessage"  />
					<span class="errorText hidden"> </span>
				</fieldset>
			</p>
		</div>

		<div class="optionFile">
			<p>
				<label class="productOption_form_fileExtensions_label">
						<?php echo smarty_function_toolTip(array('label' => '_ProductOption_fileExtensions','hint' => '_ProductOption_fileExtensions_help'), $this);?>

				</label>
				<fieldset class="error">
					<input type="text" name="fileExtensions" class="productOption_form_fileExtensions"  />
					<span class="errorText hidden"> </span>
				</fieldset>
			</p>

			<p>
				<label class="productOption_form_maxFileSize_label">
					<?php ob_start(); ?><?php echo smarty_function_maketext(array('text' => '_ProductOption_maxFileSize_help','params' => $this->_tpl_vars['maxUploadSize']), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('maxTip', ob_get_contents());ob_end_clean(); ?>
					<?php echo smarty_function_toolTip(array('label' => '_ProductOption_maxFileSize','hint' => $this->_tpl_vars['maxTip']), $this);?>

				</label>
				<fieldset class="error">
					<input type="text" name="maxFileSize" class="number productOption_form_maxFileSize"  /> <?php echo smarty_function_translate(array('text' => '_ProductOption_megabytes'), $this);?>

					<span class="errorText hidden"> </span>
				</fieldset>
			</p>
		</div>

		<div class="optionPriceContainer">
			<p>
				<label class="productOption_form_priceDiff_label"><?php echo smarty_function_toolTip(array('label' => '_option_price_diff'), $this);?>
</label>
				<fieldset class="error">
					<input type="text" name="priceDiff" class="number productOption_form_priceDiff"  />
					<?php echo $this->_tpl_vars['defaultCurrencyCode']; ?>

					<span class="errorText hidden"> </span>
				</fieldset>
			</p>
		</div>

		<div>
			<p>
				<label class="productOption_form_description_label"><?php echo smarty_function_toolTip(array('label' => '_ProductOption_description'), $this);?>
</label>
				<fieldset class="error">
					<textarea name="description" class="productOption_form_description" ></textarea>
					<span class="errorText hidden"> </span>
				</fieldset>
			</p>
		</div>

		<div class="clear"></div>

		<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<p>
				<label class="translation_name_label"><?php echo smarty_function_translate(array('text' => '_ProductOption_title'), $this);?>
</label>
				<input type="text" name="name_<?php echo $this->_tpl_vars['lang']['ID']; ?>
"  />
			</p>

			<p class="optionSelectMessage">
				<label class="translation_name_label"><?php echo smarty_function_toolTip(array('label' => '_ProductOption_selectMessage','hint' => '_tip_ProductOption_selectMessage'), $this);?>
</label>
				<input type="text" name="selectMessage_<?php echo $this->_tpl_vars['lang']['ID']; ?>
"  />

			</p>

			<p>
				<label class="translation_description_label"><?php echo smarty_function_toolTip(array('label' => '_ProductOption_description'), $this);?>
</label>
				<textarea name="description_<?php echo $this->_tpl_vars['lang']['ID']; ?>
" ></textarea>
			</p>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	</fieldset>

	<!-- STEP 2 -->
	<fieldset class="productOption_step_lev1 productOption_step_values">
	<legend><?php echo smarty_function_translate(array('text' => '_ProductOption_step_two'), $this);?>
</legend>

		<p>
		<fieldset class="group productOption_form_values_group">
			<div class="productOption_values">
				<p>
					<ul class="activeList_add_sort activeList_add_delete">
						<li class="dom_template productOption_form_values_value singleInput productOption_update" id="productOption_form_values_" style="display: block;">
							<p>
								<label><?php echo smarty_function_toolTip(array('label' => '_option_name'), $this);?>
</label>
								<fieldset class="container">
									<input type="text" class="productOption_update productOption_valueName"  />
									<span class="errorText hidden"> </span>
								</fieldset>
							<p>
								<label><?php echo smarty_function_toolTip(array('label' => '_option_price_diff'), $this);?>
</label>
								<input type="text" class="number productOption_valuePrice"  />
								<?php echo $this->_tpl_vars['defaultCurrencyCode']; ?>

							</p>
							<br class="clear" />
						</li>
					</ul>
				</p>
				<p class="productOption_values_controls">
					<a href="#add" class="productOption_add_field"><?php echo smarty_function_translate(array('text' => '_ProductOption_add_values'), $this);?>
</a>
				</p>

				<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<ul>
						<li class="dom_template productOption_form_values_value" id="productOption_form_values_">
							<fieldset class="error">
								<label class="productOption_update"> </label>
								<input class="productOption_update" type="text"  />
							</fieldset>
						</li>
					</ul>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>


			</div>

			<div class="clear"></div>
		</fieldset>
		</p>

	</fieldset>


	<fieldset class="productOption_controls controls">
		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" class="productOption_save button submit" value="<?php echo smarty_function_translate(array('text' => '_save'), $this);?>
" />
		<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

		<a href="#cancel" class="productOption_cancel cancel"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
	</fieldset>

</form>