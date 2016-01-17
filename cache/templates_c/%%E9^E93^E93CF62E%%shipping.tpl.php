<?php /* Smarty version 2.6.26, created on 2015-12-13 16:27:42
         compiled from custom:backend/product/form/shipping.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/product/form/shipping.tpl', 2, false),array('function', 'checkbox', 'custom:backend/product/form/shipping.tpl', 5, false),array('function', 'toolTip', 'custom:backend/product/form/shipping.tpl', 6, false),array('function', 'metricsfield', 'custom:backend/product/form/shipping.tpl', 26, false),array('function', 'textfield', 'custom:backend/product/form/shipping.tpl', 34, false),)), $this); ?>
<fieldset class="shipping">
	<legend><?php echo smarty_function_translate(array('text' => '_shipping'), $this);?>
</legend>

	<p class="checkbox">
		<?php echo smarty_function_checkbox(array('name' => 'isSeparateShipment','class' => 'checkbox','id' => "product_issep_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])), $this);?>

		<label for="product_issep_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
" class="checkbox"><?php echo smarty_function_toolTip(array('label' => '_requires_separate_shipment'), $this);?>
</label>
	</p>
	<p class="checkbox">
		<?php echo smarty_function_checkbox(array('name' => 'isFreeShipping','class' => 'checkbox','id' => "product_isFreeShipping_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])), $this);?>

		<label class="checkbox" for="product_isFreeShipping_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_qualifies_for_free_shipping'), $this);?>
</label>
	</p>
	<p class="checkbox">
		<?php echo smarty_function_checkbox(array('name' => 'isBackOrderable','class' => 'checkbox','id' => "product_isBackOrderable_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])), $this);?>

		<label for="product_isBackOrderable_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_allow_back_ordering'), $this);?>
</label>
	</p>
	<p class="checkbox">
		<label></label>
		<?php echo smarty_function_checkbox(array('name' => 'isFractionalUnit','class' => 'checkbox','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_isFractionalUnit"), $this);?>

		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_isFractionalUnit" class="checkbox"><?php echo smarty_function_toolTip(array('label' => '_allow_fractional_quantities'), $this);?>
</label>
	</p>

	<p>
		<label for="product_shippingWeight_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_shipping_weight'), $this);?>
:</label>
		<fieldset class="error" >

			<?php echo smarty_function_metricsfield(array('name' => 'shippingWeight'), $this);?>


			<div class="errorText hidden"></div>
		</fieldset>
	</p>
	<p>
		<label for="product_shippingSurcharge_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_shipping_surcharge'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => 'shippingSurchargeAmount','id' => "product_shippingSurcharge_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID']),'class' => 'number'), $this);?>
 <?php echo $this->_tpl_vars['baseCurrency']; ?>

			<div class="errorText hidden"></div>
		</fieldset>
	</p>
	<p>
		<label for="product_minimumQuantity_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_minimum_order_quantity'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => 'minimumQuantity','id' => "product_minimumQuantity_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID']),'class' => 'number'), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</p>
	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_fractionalStep"><?php echo smarty_function_toolTip(array('label' => '_fractionalStep','hint' => '_hint_fractionalStep'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => 'fractionalStep','class' => 'number','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_fractionalStep"), $this);?>

			<div class="errorText hidden"></div>
		</fieldset>
	</p>

</fieldset>