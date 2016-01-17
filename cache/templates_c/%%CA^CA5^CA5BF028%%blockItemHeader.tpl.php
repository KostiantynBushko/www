<?php /* Smarty version 2.6.26, created on 2015-12-11 06:43:36
         compiled from custom:email/blockItemHeader.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:email/blockItemHeader.tpl', 3, false),array('modifier', 'str_pad_iconv', 'custom:email/blockItemHeader.tpl', 3, false),)), $this); ?>
<?php if (! $this->_tpl_vars['html']): ?>
<?php if ($this->_tpl_vars['SHOW_SKU']): ?>----------<?php endif; ?>------------------------------------------------------------
<?php if ($this->_tpl_vars['SHOW_SKU']): ?><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_sku'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__sku', ob_get_contents());ob_end_clean(); ?><?php echo smarty_modifier_str_pad_iconv($this->_tpl_vars['translation__sku'], 10); ?>
<?php endif; ?><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_product'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__product', ob_get_contents());ob_end_clean(); ?><?php echo smarty_modifier_str_pad_iconv($this->_tpl_vars['translation__product'], 25); ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_price'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__price', ob_get_contents());ob_end_clean(); ?><?php echo smarty_modifier_str_pad_iconv($this->_tpl_vars['translation__price'], 11); ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_qty'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__qty', ob_get_contents());ob_end_clean(); ?><?php echo smarty_modifier_str_pad_iconv($this->_tpl_vars['translation__qty'], 9); ?>
<?php echo smarty_function_translate(array('text' => '_subtotal'), $this);?>

<?php if ($this->_tpl_vars['SHOW_SKU']): ?>----------<?php endif; ?>------------------------------------------------------------
<?php endif; ?><?php if ($this->_tpl_vars['html']): ?>
<?php if (! $this->_tpl_vars['noTable']): ?><table><?php endif; ?>
<thead>
<tr>
	<th><?php echo smarty_function_translate(array('text' => '_sku'), $this);?>
</th><th><?php echo smarty_function_translate(array('text' => '_product'), $this);?>
</th><th><?php echo smarty_function_translate(array('text' => '_price'), $this);?>
</th><th><?php echo smarty_function_translate(array('text' => '_qty'), $this);?>
</th><th><?php echo smarty_function_translate(array('text' => '_subtotal'), $this);?>
</th>
</tr>
</thead>
<?php endif; ?>