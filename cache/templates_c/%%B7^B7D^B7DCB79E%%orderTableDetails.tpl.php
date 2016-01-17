<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from custom:order/orderTableDetails.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'or', 'custom:order/orderTableDetails.tpl', 1, false),array('modifier', 'default', 'custom:order/orderTableDetails.tpl', 42, false),array('function', 'zebra', 'custom:order/orderTableDetails.tpl', 4, false),array('function', 'translate', 'custom:order/orderTableDetails.tpl', 31, false),)), $this); ?>
<?php $this->assign('colspan', smarty_modifier_or($this->_tpl_vars['colspan'], 4)); ?>

<?php $_from = $this->_tpl_vars['shipment']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['shipment'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['shipment']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['shipment']['iteration']++;
?>
	<tr class="<?php echo smarty_function_zebra(array('loop' => 'shipment'), $this);?>
<?php if ($this->_tpl_vars['productsInSeparateLine']): ?> topLine<?php endif; ?>">
		<td class="sku">
			<?php echo $this->_tpl_vars['item']['Product']['sku']; ?>

		</td>
		<?php if (! $this->_tpl_vars['productsInSeparateLine']): ?>
			<td class="productName">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/itemProductInfo.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</td>
		<?php endif; ?>

		<td class="itemPrice <?php if (( string ) $this->_tpl_vars['item']['itemBasePrice'] > ( string ) $this->_tpl_vars['item']['itemPrice']): ?>discount<?php endif; ?>">
			<span class="basePrice"><?php echo $this->_tpl_vars['item']['formattedBasePrice']; ?>
</span><span class="actualPrice"><?php echo $this->_tpl_vars['item']['formattedPrice']; ?>
</span>
		</td>
		<td class="itemCount"><?php echo $this->_tpl_vars['item']['count']; ?>
</td>
		<td class="amount"><?php echo $this->_tpl_vars['item']['formattedDisplaySubTotal']; ?>
</td>
	</tr>
	<?php if ($this->_tpl_vars['productsInSeparateLine']): ?>
		<tr class="<?php echo smarty_function_zebra(array('loop' => 'shipment','stop' => true), $this);?>
">
			<td class="productName" colspan="<?php echo $this->_tpl_vars['colspan']+1; ?>
">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/itemProductInfo.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</td>
		</tr>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php if (( $this->_tpl_vars['order']['taxAmount'] > 0 )): ?>
	<tr>
		<td colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" class="subTotalCaption beforeTax"><?php echo smarty_function_translate(array('text' => '_subtotal_before_tax'), $this);?>
:</td>
		<td class="amount"><?php echo $this->_tpl_vars['order']['formatted_itemSubtotalWithoutTax']; ?>
</td>
	</tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['order']['isShippingRequired'] && $this->_tpl_vars['shipment']['isShippable'] && $this->_tpl_vars['shipment']['ShippingService']): ?>
	<tr class="overviewShippingInfo">
		<td colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" class="subTotalCaption">
			<?php echo smarty_function_translate(array('text' => '_shipping'), $this);?>
 (<?php echo $this->_tpl_vars['shipment']['ShippingService']['name_lang']; ?>
):
		</td>
		<td>
			<?php echo ((is_array($_tmp=@$this->_tpl_vars['shipment']['selectedRate']['taxPrice'][$this->_tpl_vars['order']['Currency']['ID']])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['shipment']['selectedRate']['formattedPrice'][$this->_tpl_vars['order']['Currency']['ID']]) : smarty_modifier_default($_tmp, @$this->_tpl_vars['shipment']['selectedRate']['formattedPrice'][$this->_tpl_vars['order']['Currency']['ID']])); ?>

		</td>
	</tr>
<?php endif; ?>