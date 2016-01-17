<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:01
         compiled from custom:order/block/discounts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'custom:order/block/discounts.tpl', 4, false),array('function', 'translate', 'custom:order/block/discounts.tpl', 4, false),array('modifier', 'array_shift', 'custom:order/block/discounts.tpl', 6, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['cart']['discounts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['discount']):
?>
	<?php if ($this->_tpl_vars['discount']['amount'] != 0): ?>
		<tr>
			<td colspan="<?php echo smarty_function_math(array('equation' => ($this->_tpl_vars['extraColspanSize'])." + 3"), $this);?>
" class="subTotalCaption"><span class="discountLabel"><?php if ($this->_tpl_vars['discount']['amount'] > 0): ?><?php echo smarty_function_translate(array('text' => '_discount'), $this);?>
<?php else: ?><?php echo smarty_function_translate(array('text' => '_surcharge'), $this);?>
<?php endif; ?>:</span> <span class="discountDesc"><?php echo $this->_tpl_vars['discount']['description']; ?>
</span></td>
			<td class="amount discountAmount"><?php echo $this->_tpl_vars['discount']['formatted_amount']; ?>
</td>
			<?php echo array_shift($this->_tpl_vars['GLOBALS']['cartUpdate']); ?>

		</tr>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['cart']['itemDiscountReverse']): ?>
	<?php if ($this->_tpl_vars['discount']['amount'] != 0): ?>
		<tr>
			<td colspan="<?php echo smarty_function_math(array('equation' => ($this->_tpl_vars['extraColspanSize'])." + 3"), $this);?>
" class="subTotalCaption"><span class="discountLabel"><?php if ($this->_tpl_vars['cart']['itemDiscountReverse'] < 0): ?><?php echo smarty_function_translate(array('text' => '_discount'), $this);?>
<?php else: ?><?php echo smarty_function_translate(array('text' => '_surcharge'), $this);?>
<?php endif; ?>:</span></td>
			<td class="amount discountAmount"><?php echo $this->_tpl_vars['cart']['formatted_itemDiscountReverse']; ?>
</td>
			<?php echo array_shift($this->_tpl_vars['GLOBALS']['cartUpdate']); ?>

		</tr>
	<?php endif; ?>
<?php endif; ?>