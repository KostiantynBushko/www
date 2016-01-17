<?php /* Smarty version 2.6.26, created on 2015-12-13 16:27:42
         compiled from custom:backend/product/form/inventory.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:backend/product/form/inventory.tpl', 1, false),array('modifier', 'isRequired', 'custom:backend/product/form/inventory.tpl', 10, false),array('function', 'translate', 'custom:backend/product/form/inventory.tpl', 2, false),array('function', 'checkbox', 'custom:backend/product/form/inventory.tpl', 5, false),array('function', 'toolTip', 'custom:backend/product/form/inventory.tpl', 6, false),array('function', 'textfield', 'custom:backend/product/form/inventory.tpl', 13, false),)), $this); ?>
<fieldset class="inventory <?php if (((is_array($_tmp='INVENTORY_TRACKING_DOWNLOADABLE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>downloadableInventory<?php endif; ?>">
	<legend><?php echo smarty_function_translate(array('text' => '_inventory'), $this);?>
</legend>
	<p>
		<label></label>
		<?php echo smarty_function_checkbox(array('name' => 'isUnlimitedStock','class' => 'checkbox isUnlimitedStock','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_isUnlimitedStock"), $this);?>

		<label class="checkbox" for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_isUnlimitedStock"><?php echo smarty_function_toolTip(array('label' => '_unlimited_stock'), $this);?>
</label>
	</p>

	<div class="stockCount">
		<p <?php if (((is_array($_tmp=$this->_tpl_vars['form'])) ? $this->_run_mod_handler('isRequired', true, $_tmp, 'stockCount') : smarty_modifier_isRequired($_tmp, 'stockCount'))): ?>class="required"<?php endif; ?>>
			<label for="product_stockCount_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_items_in_stock'), $this);?>
:</label>
			<fieldset class="error">
				<?php echo smarty_function_textfield(array('name' => 'stockCount','class' => 'number','id' => "product_stockCount_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])), $this);?>

				<div class="errorText hidden"></div>
			</fieldset>
		</p>
	</div>
</fieldset>