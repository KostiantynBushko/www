<?php /* Smarty version 2.6.26, created on 2015-12-13 16:27:42
         compiled from custom:backend/product/form/pricing.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/product/form/pricing.tpl', 2, false),array('function', 'toolTip', 'custom:backend/product/form/pricing.tpl', 4, false),array('function', 'textfield', 'custom:backend/product/form/pricing.tpl', 6, false),)), $this); ?>
<fieldset class="pricing">
	<legend><?php echo smarty_function_translate(array('text' => '_pricing'), $this);?>
</legend>
	<p class="required">
		<label for="product_price_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_<?php echo $this->_tpl_vars['baseCurrency']; ?>
"><?php echo smarty_function_toolTip(array('label' => $this->_tpl_vars['baseCurrency'],'hint' => '_tip_main_currency_price'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => "price_".($this->_tpl_vars['baseCurrency']),'class' => 'money price','id' => "product_price_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_".($this->_tpl_vars['baseCurrency'])), $this);?>
 <?php echo $this->_tpl_vars['baseCurrency']; ?>

			<span class="listPrice">
				<?php echo smarty_function_toolTip(array('label' => '_list_price'), $this);?>
:
				<?php echo smarty_function_textfield(array('name' => "listPrice_".($this->_tpl_vars['baseCurrency']),'class' => 'money','id' => "product_listPrice_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_".($this->_tpl_vars['baseCurrency'])), $this);?>

			</span>
			<a href="" class="menu setQuantPrice" style="display: none;"><?php echo smarty_function_translate(array('text' => '_set_quant'), $this);?>
</a>
			<div class="errorText hidden"></div>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/product/form/quantityPricing.tpl", 'smarty_include_vars' => array('currency' => $this->_tpl_vars['baseCurrency'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		</fieldset>
	</p>
	<?php $_from = $this->_tpl_vars['otherCurrencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['currency']):
?>
	<p>
		<label for="product_price_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_<?php echo $this->_tpl_vars['currency']; ?>
"><?php echo smarty_function_toolTip(array('label' => $this->_tpl_vars['currency'],'hint' => '_tip_secondary_currency_price'), $this);?>
:</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => "price_".($this->_tpl_vars['currency']),'class' => 'money price','id' => "product_price_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_".($this->_tpl_vars['currency'])), $this);?>
 <?php echo $this->_tpl_vars['currency']; ?>

			<span class="listPrice">
				<?php echo smarty_function_toolTip(array('label' => '_list_price'), $this);?>
:
				<?php echo smarty_function_textfield(array('name' => "listPrice_".($this->_tpl_vars['currency']),'class' => 'money','id' => "product_listPrice_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_".($this->_tpl_vars['currency'])), $this);?>

			</span>
			<a href="" class="menu setQuantPrice" style="display: none;"><?php echo smarty_function_translate(array('text' => '_set_quant'), $this);?>
</a>
			<div class="errorText hidden"></div>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/product/form/quantityPricing.tpl", 'smarty_include_vars' => array('currency' => $this->_tpl_vars['currency'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</fieldset>
	</p>
	<?php endforeach; endif; unset($_from); ?>
</fieldset>