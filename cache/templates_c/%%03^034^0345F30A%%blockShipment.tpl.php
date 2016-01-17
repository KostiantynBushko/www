<?php /* Smarty version 2.6.26, created on 2015-12-11 06:43:36
         compiled from custom:email/blockShipment.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'str_pad_iconv', 'custom:email/blockShipment.tpl', 4, false),array('modifier', 'truncate', 'custom:email/blockShipment.tpl', 4, false),array('modifier', 'str_pad', 'custom:email/blockShipment.tpl', 4, false),array('modifier', 'htmlspecialchars', 'custom:email/blockShipment.tpl', 7, false),array('modifier', 'escape', 'custom:email/blockShipment.tpl', 19, false),array('modifier', 'count', 'custom:email/blockShipment.tpl', 35, false),array('function', 'translate', 'custom:email/blockShipment.tpl', 7, false),)), $this); ?>
<?php if (! $this->_tpl_vars['html']): ?>
<?php $_from = $this->_tpl_vars['shipment']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>

<?php if ($this->_tpl_vars['SHOW_SKU']): ?><?php echo smarty_modifier_str_pad_iconv($this->_tpl_vars['item']['Product']['sku'], 10); ?>
<?php endif; ?><?php echo smarty_modifier_str_pad_iconv(((is_array($_tmp=$this->_tpl_vars['item']['Product']['name_lang'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 29, "...", 'true') : smarty_modifier_truncate($_tmp, 29, "...", 'true')), 31); ?>
<?php echo str_pad(((is_array($_tmp=$this->_tpl_vars['item']['formattedDisplayPrice'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 9, "...") : smarty_modifier_truncate($_tmp, 9, "...")), 10); ?>
<?php echo str_pad(((is_array($_tmp=$this->_tpl_vars['item']['count'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 8, "...") : smarty_modifier_truncate($_tmp, 8, "...")), 9); ?>
<?php echo $this->_tpl_vars['item']['formattedDisplaySubTotal']; ?>

<?php if ($this->_tpl_vars['item']['options']): ?>
<?php $_from = $this->_tpl_vars['item']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
<?php echo $this->_tpl_vars['option']['Choice']['Option']['name_lang']; ?>
: <?php if (0 == $this->_tpl_vars['option']['Choice']['Option']['type']): ?><?php echo smarty_function_translate(array('text' => '_option_yes'), $this);?>
<?php elseif (1 == $this->_tpl_vars['option']['Choice']['Option']['type']): ?><?php echo $this->_tpl_vars['option']['Choice']['name_lang']; ?>
<?php else: ?><?php echo htmlspecialchars($this->_tpl_vars['option']['optionText']); ?>
<?php endif; ?> <?php if ($this->_tpl_vars['option']['priceDiff'] != 0): ?>(<?php echo $this->_tpl_vars['option']['formattedPrice']; ?>
)<?php endif; ?>

<?php endforeach; endif; unset($_from); ?>

<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?><?php if ($this->_tpl_vars['html']): ?>
<?php $_from = $this->_tpl_vars['shipment']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
	
	<td>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Product']['sku'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

	</td>
	
	<td>
		<?php echo $this->_tpl_vars['item']['Product']['name_lang']; ?>

		<?php if ($this->_tpl_vars['item']['options']): ?>
			<?php $_from = $this->_tpl_vars['item']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
				<small><?php echo $this->_tpl_vars['option']['Choice']['Option']['name_lang']; ?>
: <?php if (0 == $this->_tpl_vars['option']['Choice']['Option']['type']): ?><?php echo smarty_function_translate(array('text' => '_option_yes'), $this);?>
<?php elseif (1 == $this->_tpl_vars['option']['Choice']['Option']['type']): ?><?php echo $this->_tpl_vars['option']['Choice']['name_lang']; ?>
<?php else: ?><?php echo htmlspecialchars($this->_tpl_vars['option']['optionText']); ?>
<?php endif; ?> <?php if ($this->_tpl_vars['option']['priceDiff'] != 0): ?>(<?php echo $this->_tpl_vars['option']['formattedPrice']; ?>
)<?php endif; ?></small><br />
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	</td>
	<td align="center"><?php echo $this->_tpl_vars['item']['formattedDisplayPrice']; ?>
</td>
	<td align="center"><?php echo $this->_tpl_vars['item']['count']; ?>
</td>
	<td align="right"><?php echo $this->_tpl_vars['item']['formattedDisplaySubTotal']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['shipment']['isShippable'] && $this->_tpl_vars['shipment']['ShippingService'] && ( count($this->_tpl_vars['shipment']['CustomerOrder']['shipments']) > 1 )): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/blockShippingCost.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<?php if (! $this->_tpl_vars['noTable']): ?></table><?php endif; ?>
<?php endif; ?>