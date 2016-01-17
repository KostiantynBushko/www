<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from /home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/price.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/price.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/price.tpl', 3, false),)), $this); ?>
<?php if (((is_array($_tmp='DISPLAY_PRICES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
	<tr id="productPrice">
		<td class="param" style="padding: 8px;"><?php echo smarty_function_translate(array('text' => '_price'), $this);?>
:</td>
		<td class="value price">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/productPagePrice.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
	<?php if ($this->_tpl_vars['quantityPricing']): ?>
		<tr>
			<td colspan="2">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/quantityPrice.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</td>
		</tr>
	<?php endif; ?>
<?php endif; ?>