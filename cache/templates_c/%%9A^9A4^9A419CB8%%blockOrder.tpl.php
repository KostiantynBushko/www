<?php /* Smarty version 2.6.26, created on 2015-12-11 06:43:36
         compiled from custom:email/blockOrder.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:email/blockOrder.tpl', 4, false),array('modifier', 'str_pad_left', 'custom:email/blockOrder.tpl', 5, false),array('modifier', 'count', 'custom:email/blockOrder.tpl', 40, false),array('function', 'translate', 'custom:email/blockOrder.tpl', 5, false),)), $this); ?>
<?php if (! $this->_tpl_vars['html']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/blockOrderItems.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['order']['taxes'][$this->_tpl_vars['order']['Currency']['ID']] && ! ((is_array($_tmp='HIDE_TAXES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_subtotal'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__subtotal', ob_get_contents());ob_end_clean(); ?><?php echo smarty_modifier_str_pad_left($this->_tpl_vars['translation__subtotal'], 49); ?>
: <?php echo $this->_tpl_vars['order']['formatted_itemSubtotalWithoutTax']; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['order']['formatted_shippingSubtotal']): ?>
<?php if ($this->_tpl_vars['SHOW_SKU']): ?><?php echo smarty_modifier_str_pad_left('', 10); ?>
<?php endif; ?><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_shipping'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__shipping', ob_get_contents());ob_end_clean(); ?><?php echo smarty_modifier_str_pad_left($this->_tpl_vars['translation__shipping'], 49); ?>
: <?php echo $this->_tpl_vars['order']['formatted_shippingSubtotal']; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['order']['taxes'][$this->_tpl_vars['order']['Currency']['ID']] && ! ((is_array($_tmp='HIDE_TAXES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
<?php if ($this->_tpl_vars['SHOW_SKU']): ?><?php echo smarty_modifier_str_pad_left('', 10); ?>
<?php endif; ?><?php echo smarty_modifier_str_pad_left('', 27); ?>
---------------------------------
<?php $_from = $this->_tpl_vars['order']['taxes'][$this->_tpl_vars['order']['Currency']['ID']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax']):
?>
<?php if ($this->_tpl_vars['SHOW_SKU']): ?><?php echo smarty_modifier_str_pad_left('', 10); ?>
<?php endif; ?><?php echo smarty_modifier_str_pad_left($this->_tpl_vars['tax']['name_lang'], 49); ?>
: <?php echo $this->_tpl_vars['tax']['formattedAmount']; ?>

<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['order']['discounts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['discount']):
?>
<?php if ($this->_tpl_vars['discount']['amount'] != 0): ?>
<?php if ($this->_tpl_vars['SHOW_SKU']): ?><?php echo smarty_modifier_str_pad_left('', 10); ?>
<?php endif; ?><?php echo smarty_modifier_str_pad_left($this->_tpl_vars['discount']['description'], 49); ?>
: <?php echo $this->_tpl_vars['discount']['formatted_amount']; ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['SHOW_SKU']): ?><?php echo smarty_modifier_str_pad_left('', 10); ?>
<?php endif; ?><?php echo smarty_modifier_str_pad_left('', 27); ?>
---------------------------------
<?php if ($this->_tpl_vars['SHOW_SKU']): ?><?php echo smarty_modifier_str_pad_left('', 10); ?>
<?php endif; ?><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_grand_total'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__grand_total', ob_get_contents());ob_end_clean(); ?><?php echo smarty_modifier_str_pad_left($this->_tpl_vars['translation__grand_total'], 49); ?>
: <?php echo $this->_tpl_vars['order']['formattedTotal'][$this->_tpl_vars['order']['Currency']['ID']]; ?>

<?php if ($this->_tpl_vars['SHOW_SKU']): ?><?php echo smarty_modifier_str_pad_left('', 10); ?>
<?php endif; ?><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_amount_paid'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__amount_paid', ob_get_contents());ob_end_clean(); ?><?php echo smarty_modifier_str_pad_left($this->_tpl_vars['translation__amount_paid'], 49); ?>
: <?php echo $this->_tpl_vars['order']['formatted_amountPaid']; ?>

<?php if ($this->_tpl_vars['order']['amountDue']): ?>
<?php if ($this->_tpl_vars['SHOW_SKU']): ?><?php echo smarty_modifier_str_pad_left('', 10); ?>
<?php endif; ?><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_amount_due'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__amount_due', ob_get_contents());ob_end_clean(); ?><?php echo smarty_modifier_str_pad_left($this->_tpl_vars['translation__amount_due'], 49); ?>
: <?php echo $this->_tpl_vars['order']['formatted_amountDue']; ?>

<?php endif; ?>
<?php endif; ?><?php if ($this->_tpl_vars['html']): ?>
<table border="1" cellpadding="10">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/blockOrderItems.tpl", 'smarty_include_vars' => array('noTable' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['order']['taxes'][$this->_tpl_vars['order']['Currency']['ID']] && ! ((is_array($_tmp='HIDE_TAXES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
<tr><td colspan="4"><?php echo smarty_function_translate(array('text' => '_subtotal'), $this);?>
</td><td align="right"><?php echo $this->_tpl_vars['order']['formatted_itemSubtotalWithoutTax']; ?>
</td></tr>
<?php endif; ?>
<?php if ($this->_tpl_vars['order']['taxes'][$this->_tpl_vars['order']['Currency']['ID']] && ! ((is_array($_tmp='HIDE_TAXES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
<?php $_from = $this->_tpl_vars['order']['taxes'][$this->_tpl_vars['order']['Currency']['ID']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax']):
?>
<tr><td colspan="4"><?php echo $this->_tpl_vars['tax']['name_lang']; ?>
</td><td align="right"><?php echo $this->_tpl_vars['tax']['formattedAmount']; ?>
</td></tr>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['order']['formatted_shippingSubtotal']): ?>
	<?php if (count($this->_tpl_vars['order']['shipments']) == 1): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/blockShippingCost.tpl", 'smarty_include_vars' => array('shipment' => $this->_tpl_vars['order']['shipments']['0'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<tr><td colspan="4"><?php echo smarty_function_translate(array('text' => '_shipping'), $this);?>
</td><td align="right"><?php echo $this->_tpl_vars['order']['formatted_shippingSubtotal']; ?>
</td></tr>
	<?php endif; ?>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['order']['discounts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['discount']):
?>
<?php if ($this->_tpl_vars['discount']['amount'] != 0): ?>
<tr><td colspan="4"><?php echo $this->_tpl_vars['discount']['description']; ?>
</td><td align="right"><?php echo $this->_tpl_vars['discount']['formatted_amount']; ?>
</td></tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<tr><td colspan="4"><?php echo smarty_function_translate(array('text' => '_grand_total'), $this);?>
</td><td align="right"><b><?php echo $this->_tpl_vars['order']['formattedTotal'][$this->_tpl_vars['order']['Currency']['ID']]; ?>
</b></td></tr>
<tr><td colspan="4"><?php echo smarty_function_translate(array('text' => '_amount_paid'), $this);?>
</td><td align="right"><?php echo $this->_tpl_vars['order']['formatted_amountPaid']; ?>
</td></tr>
<?php if ($this->_tpl_vars['order']['amountDue']): ?>
<tr><td colspan="4"><?php echo smarty_function_translate(array('text' => '_amount_due'), $this);?>
</td><td align="right"><?php echo $this->_tpl_vars['order']['formatted_amountDue']; ?>
</td></tr>
<?php endif; ?>
</table>
<?php endif; ?>