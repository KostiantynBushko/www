<?php /* Smarty version 2.6.26, created on 2015-12-11 06:43:36
         compiled from custom:email/blockShippingCost.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:email/blockShippingCost.tpl', 1, false),array('modifier', 'default', 'custom:email/blockShippingCost.tpl', 2, false),array('function', 'translate', 'custom:email/blockShippingCost.tpl', 1, false),)), $this); ?>
<tr><td colspan="<?php if (((is_array($_tmp='SHOW_SKU_EMAIL')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>4<?php else: ?>3<?php endif; ?>"><?php echo smarty_function_translate(array('text' => '_shipping'), $this);?>
 (<?php echo $this->_tpl_vars['shipment']['ShippingService']['name_lang']; ?>
):</td>
	<td align="right"><?php echo ((is_array($_tmp=@$this->_tpl_vars['shipment']['selectedRate']['taxPrice'][$this->_tpl_vars['order']['Currency']['ID']])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['shipment']['selectedRate']['formattedPrice'][$this->_tpl_vars['order']['Currency']['ID']]) : smarty_modifier_default($_tmp, @$this->_tpl_vars['shipment']['selectedRate']['formattedPrice'][$this->_tpl_vars['order']['Currency']['ID']])); ?>
</td>
</tr>