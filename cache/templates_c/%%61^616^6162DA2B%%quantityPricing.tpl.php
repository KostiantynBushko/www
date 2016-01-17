<?php /* Smarty version 2.6.26, created on 2015-12-13 16:27:42
         compiled from custom:backend/product/form/quantityPricing.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'toolTip', 'custom:backend/product/form/quantityPricing.tpl', 5, false),array('function', 'selectfield', 'custom:backend/product/form/quantityPricing.tpl', 11, false),array('function', 'json', 'custom:backend/product/form/quantityPricing.tpl', 18, false),)), $this); ?>
<div class="quantityPricing" style="display: none;" id="quantityPricingViewPort_<?php echo $this->_tpl_vars['product']['ID']; ?>
">
<table id="quantityPricing_<?php echo $this->_tpl_vars['currency']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
">
	<thead>
		<tr class="quantityRow"><td>
				<div class="quantityLabel"><?php echo smarty_function_toolTip(array('label' => '_quantity'), $this);?>
 ▸</div>
				<div class="groupLabel">▾ <?php echo smarty_function_toolTip(array('label' => '_group'), $this);?>
</div>
			</td>
			<td><input type="text" class="text quantity number" name="qQuantity[<?php echo $this->_tpl_vars['currency']; ?>
][]" /></td></tr>
	</thead>
	<tbody>
		<tr><td class="groupColumn"><?php ob_start(); ?><?php echo $this->_tpl_vars['currency']; ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_selectfield(array('name' => "qGroup[".($this->_tpl_vars['blockAsParamValue'])."][]",'options' => $this->_tpl_vars['userGroups']), $this);?>
</td><td><input type="text" name="qPrice[<?php echo $this->_tpl_vars['currency']; ?>
][]" class="text qprice number" /></td></tr>
	</tbody>
</table>
<input type="hidden" class="hiddenValue" name="quantityPricing[<?php echo $this->_tpl_vars['currency']; ?>
]" />
</div>

<script type="text/javascript">
	new Backend.Product.QuantityPrice($('quantityPricing_<?php echo $this->_tpl_vars['currency']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
'), <?php echo smarty_function_json(array('array' => $this->_tpl_vars['prices'][$this->_tpl_vars['currency']]), $this);?>
);
</script>