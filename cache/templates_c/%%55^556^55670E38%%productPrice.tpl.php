<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:33
         compiled from custom:product/block/productPrice.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:product/block/productPrice.tpl', 1, false),)), $this); ?>
<?php if (((is_array($_tmp='DISPLAY_PRICES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
<div class="price">
	<?php echo $this->_tpl_vars['product']['formattedPrice'][$this->_tpl_vars['currency']]; ?>

	</div>
<?php endif; ?>