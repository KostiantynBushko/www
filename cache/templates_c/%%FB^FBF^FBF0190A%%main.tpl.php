<?php /* Smarty version 2.6.26, created on 2015-12-13 16:27:42
         compiled from custom:backend/product/form/main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/product/form/main.tpl', 2, false),array('function', 'toolTip', 'custom:backend/product/form/main.tpl', 5, false),array('function', 'selectfield', 'custom:backend/product/form/main.tpl', 6, false),array('function', 'textfield', 'custom:backend/product/form/main.tpl', 12, false),array('function', 'checkbox', 'custom:backend/product/form/main.tpl', 19, false),array('function', 'textarea', 'custom:backend/product/form/main.tpl', 33, false),)), $this); ?>
<fieldset>
	<legend><?php echo smarty_function_translate(array('text' => '_main_details'), $this);?>
</legend>

	<p class="required" style="border-bottom: 1px solid #ccc; padding-bottom: 4px; margin-bottom: 4px;">
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_isEnabled"><?php echo smarty_function_toolTip(array('label' => '_availability'), $this);?>
:</label>
		<?php echo smarty_function_selectfield(array('name' => 'isEnabled','options' => $this->_tpl_vars['productStatuses']), $this);?>

	</p>

	<p class="required">
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_name"><?php echo smarty_function_translate(array('text' => '_product_name'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => 'name','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_name",'class' => 'wide','autocomplete' => "controller=backend.product field=name"), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</p>

	<p class="autoSKU">
		<label for=""></label>
		<?php echo smarty_function_checkbox(array('name' => 'autosku','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_sku_auto",'class' => 'checkbox','value' => 'on','onclick' => "Backend.Product.toggleSkuField(this);"), $this);?>

		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_sku_auto" class="checkbox"><?php echo smarty_function_translate(array('text' => '_generate_sku'), $this);?>
</label>
	</p>
	<p class="required">
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_sku"><?php echo smarty_function_toolTip(array('label' => '_sku_code','hint' => '_hint_sku'), $this);?>
:</label>
		<fieldset class="error" style="margin-bottom: 6px;">
			<?php echo smarty_function_textfield(array('name' => 'sku','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_sku",'class' => 'product_sku','autocomplete' => "controller=backend.product field=sku"), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</p>

	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_shortdes"><?php echo smarty_function_toolTip(array('label' => '_short_description','hint' => '_hint_shortdescr'), $this);?>
:</label>
		<div class="textarea">
			<?php echo smarty_function_textarea(array('class' => 'shortDescr tinyMCE','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_shortdes",'name' => 'shortDescription'), $this);?>

		</div>
	</p>
	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_longdes"><?php echo smarty_function_toolTip(array('label' => '_long_description','hint' => '_hint_longdescr'), $this);?>
:</label>
		<div class="textarea">
			<?php echo smarty_function_textarea(array('class' => 'longDescr tinyMCE','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_longdes",'name' => 'longDescription'), $this);?>

		</div>
	</p>
	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_type"><?php echo smarty_function_toolTip(array('label' => '_product_type'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_selectfield(array('options' => $this->_tpl_vars['productTypes'],'name' => 'type','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_type",'class' => 'productType'), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</p>
	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_url"><?php echo smarty_function_toolTip(array('label' => '_website_address'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => 'URL','class' => 'wide','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_url",'autocomplete' => "controller=backend.product field=URL"), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</p>
	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_manufacterer"><?php echo smarty_function_translate(array('text' => '_manufacturer'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => 'manufacturer','class' => 'wide','autocomplete' => "controller=backend.manufacturer field=manufacturer",'id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_manufacterer"), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</p>
	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_keywords"><?php echo smarty_function_toolTip(array('label' => '_keywords','hint' => '_hint_keywords'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => 'keywords','class' => 'wide','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_keywords",'autocomplete' => "controller=backend.product field=keywords"), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</p>
	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_pageTitle"><?php echo smarty_function_toolTip(array('label' => '_pageTitle','hint' => '_hint_pageTitle'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => 'pageTitle','class' => 'wide','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_pageTitle",'autocomplete' => "controller=backend.product field=pageTitle"), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</p>

	<?php if ($this->_tpl_vars['shippingClasses']): ?>
	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_shippingClassID"><?php echo smarty_function_toolTip(array('label' => '_shippingClass'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_selectfield(array('options' => $this->_tpl_vars['shippingClasses'],'name' => 'shippingClassID','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_shippingClassID",'class' => 'shippingClassID'), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</p>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['taxClasses']): ?>
	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_taxClassID"><?php echo smarty_function_toolTip(array('label' => '_taxClass'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_selectfield(array('options' => $this->_tpl_vars['taxClasses'],'name' => 'taxClassID','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_taxClassID",'class' => 'taxClassID'), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</p>
	<?php endif; ?>

	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_position"><?php echo smarty_function_toolTip(array('label' => '_sort_order','hint' => '_hint_sort_order'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => 'position','class' => 'number','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_position"), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</p>
	<p>
		<label></label>
		<?php echo smarty_function_checkbox(array('name' => 'isFeatured','class' => 'checkbox','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_isfeatured"), $this);?>

		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_isfeatured" class="checkbox"><?php echo smarty_function_toolTip(array('label' => '_mark_as_featured_product','hint' => '_hint_featured'), $this);?>
</label>
	</p>

</fieldset>