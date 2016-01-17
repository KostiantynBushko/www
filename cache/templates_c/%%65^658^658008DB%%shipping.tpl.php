<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:01
         compiled from custom:order/block/shipping.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strlen', 'custom:order/block/shipping.tpl', 1, false),array('modifier', 'array_shift', 'custom:order/block/shipping.tpl', 11, false),array('function', 'math', 'custom:order/block/shipping.tpl', 3, false),array('function', 'translate', 'custom:order/block/shipping.tpl', 5, false),)), $this); ?>
<?php if (strlen($this->_tpl_vars['cart']['shippingSubtotal'])): ?>
	<tr>
		<td colspan="<?php echo smarty_function_math(array('equation' => ($this->_tpl_vars['extraColspanSize'])." + 3"), $this);?>
" class="subTotalCaption">
			<?php if ($this->_tpl_vars['isShippingEstimated']): ?>
				<?php echo smarty_function_translate(array('text' => '_estimated_shipping'), $this);?>
:
			<?php else: ?>
				<?php echo smarty_function_translate(array('text' => '_shipping'), $this);?>
:
			<?php endif; ?>
		</td>
		<td class="amount shippingAmount"><?php echo $this->_tpl_vars['cart']['formatted_shippingSubtotal']; ?>
</td>
		<?php echo array_shift($this->_tpl_vars['GLOBALS']['cartUpdate']); ?>

	</tr>
<?php endif; ?>