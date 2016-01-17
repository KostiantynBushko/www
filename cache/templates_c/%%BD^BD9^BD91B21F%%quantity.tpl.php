<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from custom:product/block/quantity.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:product/block/quantity.tpl', 1, false),array('modifier', 'default', 'custom:product/block/quantity.tpl', 2, false),array('function', 'textfield', 'custom:product/block/quantity.tpl', 2, false),array('function', 'selectfield', 'custom:product/block/quantity.tpl', 4, false),)), $this); ?>
<?php if ($this->_tpl_vars['product']['isFractionalUnit'] || ((is_array($_tmp='QUANT_FIELD_TYPE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) == 'QUANT_INPUT'): ?>
	<?php echo smarty_function_textfield(array('name' => ((is_array($_tmp=@$this->_tpl_vars['field'])) ? $this->_run_mod_handler('default', true, $_tmp, 'count') : smarty_modifier_default($_tmp, 'count')),'class' => 'text number'), $this);?>

<?php else: ?>
	<?php echo smarty_function_selectfield(array('name' => ((is_array($_tmp=@$this->_tpl_vars['field'])) ? $this->_run_mod_handler('default', true, $_tmp, 'count') : smarty_modifier_default($_tmp, 'count')),'options' => $this->_tpl_vars['quantity'],'class' => 'quantity','style' => "color: black"), $this);?>

<?php endif; ?>