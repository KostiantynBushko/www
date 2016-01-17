<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from /home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/toCart.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/toCart.tpl', 1, false),array('modifier', 'escape', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/toCart.tpl', 10, false),array('function', 'renderBlock', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/toCart.tpl', 3, false),array('function', 'translate', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/toCart.tpl', 7, false),array('function', 'hidden', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/toCart.tpl', 11, false),)), $this); ?>
<?php if ($this->_tpl_vars['product']['isAvailable'] && ((is_array($_tmp='ENABLE_CART')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>

	<?php echo smarty_function_renderBlock(array('block' => "PRODUCT-OPTIONS"), $this);?>

	<?php echo smarty_function_renderBlock(array('block' => "PRODUCT-VARIATIONS"), $this);?>


	<tr id="productToCart" class="cartLinks">
		<td class="param"><?php echo smarty_function_translate(array('text' => '_quantity'), $this);?>
:</td>
		<td class="value">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/quantity.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_add_to_cart','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
			<?php echo smarty_function_hidden(array('name' => 'return','value' => $this->_tpl_vars['catRoute']), $this);?>


		</td>
	</tr>
	
<?php endif; ?>
