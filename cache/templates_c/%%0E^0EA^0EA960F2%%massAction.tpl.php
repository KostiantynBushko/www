<?php /* Smarty version 2.6.26, created on 2015-12-02 13:45:52
         compiled from backend/product/massAction.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'denied', 'backend/product/massAction.tpl', 1, false),array('block', 'form', 'backend/product/massAction.tpl', 3, false),array('function', 'translate', 'backend/product/massAction.tpl', 9, false),array('function', 'textfield', 'backend/product/massAction.tpl', 56, false),array('function', 'checkbox', 'backend/product/massAction.tpl', 64, false),array('function', 'selectfield', 'backend/product/massAction.tpl', 77, false),array('modifier', 'escape', 'backend/product/massAction.tpl', 82, false),)), $this); ?>
<span <?php $this->_tag_stack[] = array('denied', array('role' => "product.mass")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none;"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> id="productMass_<?php echo $this->_tpl_vars['categoryID']; ?>
" class="activeGridMass">

	<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.product action=processMass id=".($this->_tpl_vars['categoryID']),'method' => 'POST','handle' => $this->_tpl_vars['massForm'],'onsubmit' => "return false;")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

	<input type="hidden" name="filters" value="" />
	<input type="hidden" name="selectedIDs" value="" />
	<input type="hidden" name="isInverse" value="" />

	<?php echo smarty_function_translate(array('text' => '_with_selected'), $this);?>
:
	<select name="act" class="select" onchange="Backend.Product.massActionChanged(this);">

		<option value="enable_isEnabled"><?php echo smarty_function_translate(array('text' => '_enable'), $this);?>
</option>
		<option value="disable_isEnabled"><?php echo smarty_function_translate(array('text' => '_disable'), $this);?>
</option>
		<option value="move"><?php echo smarty_function_translate(array('text' => '_move_to_category'), $this);?>
</option>
		<option value="addCat"><?php echo smarty_function_translate(array('text' => '_add_to_category'), $this);?>
</option>
		<option value="copy"><?php echo smarty_function_translate(array('text' => '_copy_to_category'), $this);?>
</option>
		<option value="delete"><?php echo smarty_function_translate(array('text' => '_delete'), $this);?>
</option>

		<option value="manufacturer"><?php echo smarty_function_translate(array('text' => '_set_manufacter'), $this);?>
</option>
		<option value="set_keywords"><?php echo smarty_function_translate(array('text' => '_set_keywords'), $this);?>
</option>
		<option value="set_URL"><?php echo smarty_function_translate(array('text' => '_set_website_address'), $this);?>
</option>
		<option value="addRelated"><?php echo smarty_function_translate(array('text' => '_add_related_product'), $this);?>
</option>
		<option value="enable_isFeatured"><?php echo smarty_function_translate(array('text' => '_set_as_featured_product'), $this);?>
</option>
		<option value="disable_isFeatured"><?php echo smarty_function_translate(array('text' => '_unset_featured_product'), $this);?>
</option>

		<optgroup label="<?php echo smarty_function_translate(array('text' => '_inventory_and_pricing'), $this);?>
">
			<option value="inc_price"><?php echo smarty_function_translate(array('text' => '_increase_price'), $this);?>
</option>
			<option value="inc_stock"><?php echo smarty_function_translate(array('text' => '_increase_stock'), $this);?>
</option>

			<option value="price"><?php echo smarty_function_translate(array('text' => '_set_price'), $this);?>
 (<?php echo $this->_tpl_vars['currency']; ?>
)</option>
			<option value="set_stockCount"><?php echo smarty_function_translate(array('text' => '_set_stock'), $this);?>
</option>
		</optgroup>

		<optgroup label="<?php echo smarty_function_translate(array('text' => '_shipping_opts'), $this);?>
">
			<option value="shippingClass"><?php echo smarty_function_translate(array('text' => '_set_shipping_class'), $this);?>
</option>
			<option value="taxClass"><?php echo smarty_function_translate(array('text' => '_set_tax_class'), $this);?>
</option>
			<option value="set_shippingWeight"><?php echo smarty_function_translate(array('text' => '_set_shipping_weight'), $this);?>
</option>
			<option value="set_minimumQuantity"><?php echo smarty_function_translate(array('text' => '_set_minimum_quantity'), $this);?>
</option>
			<option value="set_shippingSurchargeAmount"><?php echo smarty_function_translate(array('text' => '_set_shipping_surcharge'), $this);?>
</option>
			<option value="enable_isFreeShipping"><?php echo smarty_function_translate(array('text' => '_enable_free_shipping'), $this);?>
</option>
			<option value="disable_isFreeShipping"><?php echo smarty_function_translate(array('text' => '_disable_free_shipping'), $this);?>
</option>
			<option value="enable_isBackOrderable"><?php echo smarty_function_translate(array('text' => '_enable_back_ordering'), $this);?>
</option>
			<option value="disable_isBackOrderable"><?php echo smarty_function_translate(array('text' => '_disable_back_ordering'), $this);?>
</option>
			<option value="enable_isSeparateShipment"><?php echo smarty_function_translate(array('text' => '_requires_separate_shippment'), $this);?>
</option>
			<option value="disable_isSeparateShipment"><?php echo smarty_function_translate(array('text' => '_do_not_require_separate_shippment'), $this);?>
</option>
		</optgroup>

		<optgroup label="<?php echo smarty_function_translate(array('text' => '_presentation'), $this);?>
">
			<option value="theme"><?php echo smarty_function_translate(array('text' => '_set_theme'), $this);?>
</option>
		</optgroup>

	</select>

	<span class="bulkValues" style="display: none;">
		<span class="addRelated">
			<?php echo smarty_function_translate(array('text' => '_enter_sku'), $this);?>
: <?php echo smarty_function_textfield(array('class' => 'text number','id' => "massForm_related_".($this->_tpl_vars['categoryID']),'name' => 'related','autocomplete' => "controller=backend.product field=sku"), $this);?>

		</span>
		<span class="move">
			<input type="hidden" name="categoryID" />
		</span>

		<span class="inc_price">
			<?php echo smarty_function_textfield(array('id' => "inc_price_".($this->_tpl_vars['categoryID']),'class' => 'text number','name' => 'inc_price_value'), $this);?>
%
			<?php echo smarty_function_checkbox(array('id' => "inc_quant_price_".($this->_tpl_vars['categoryID']),'name' => 'inc_quant_price'), $this);?>

			<label for="inc_quant_price_<?php echo $this->_tpl_vars['categoryID']; ?>
" style="float: none;"><?php echo smarty_function_translate(array('text' => '_inc_quant_prices'), $this);?>
</label>
		</span>

		<?php echo smarty_function_textfield(array('id' => "massForm_inc_stock_".($this->_tpl_vars['categoryID']),'class' => 'text number','name' => 'inc_stock'), $this);?>

		<?php echo smarty_function_textfield(array('id' => "massForm_set_stockCount_".($this->_tpl_vars['categoryID']),'class' => 'text number','name' => 'set_stockCount'), $this);?>

		<?php echo smarty_function_textfield(array('id' => "massForm_price_".($this->_tpl_vars['categoryID']),'class' => 'text number','name' => 'price'), $this);?>

		<?php echo smarty_function_textfield(array('id' => "massForm_set_minimumQuantity_".($this->_tpl_vars['categoryID']),'class' => 'text number','name' => 'set_minimumQuantity'), $this);?>

		<?php echo smarty_function_textfield(array('id' => "massForm_shippingSurchargeAmount_".($this->_tpl_vars['categoryID']),'class' => 'text number','name' => 'set_shippingSurchargeAmount'), $this);?>

		<?php echo smarty_function_textfield(array('id' => "massForm_shippingWeight_".($this->_tpl_vars['categoryID']),'class' => 'text number','name' => 'set_shippingWeight'), $this);?>

		<?php echo smarty_function_textfield(array('id' => "set_manufacturer_".($this->_tpl_vars['categoryID']),'name' => 'manufacturer','class' => 'text','autocomplete' => "controller=backend.manufacturer field=manufacturer"), $this);?>

		<?php echo smarty_function_textfield(array('id' => "set_keywords_".($this->_tpl_vars['categoryID']),'name' => 'set_keywords','class' => 'text','autocomplete' => "controller=backend.product field=keywords"), $this);?>

		<?php echo smarty_function_textfield(array('id' => "set_url_".($this->_tpl_vars['categoryID']),'name' => 'set_URL','class' => 'text','autocomplete' => "controller=backend.product field=URL"), $this);?>

		<?php echo smarty_function_selectfield(array('id' => "massForm_theme_".($this->_tpl_vars['categoryID']),'name' => 'theme','options' => $this->_tpl_vars['themes']), $this);?>

		<?php echo smarty_function_selectfield(array('id' => "massForm_shippingClass_".($this->_tpl_vars['categoryID']),'name' => 'shippingClass','options' => $this->_tpl_vars['shippingClasses']), $this);?>

		<?php echo smarty_function_selectfield(array('id' => "massForm_taxClass_".($this->_tpl_vars['categoryID']),'name' => 'taxClass','options' => $this->_tpl_vars['taxClasses']), $this);?>

	</span>

	<input type="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_process','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" class="submit" />
	<span class="massIndicator progressIndicator" style="display: none;"></span>

	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</span>