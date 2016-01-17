<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:01
         compiled from custom:order/block/taxes.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'custom:order/block/taxes.tpl', 3, false),array('modifier', 'array_shift', 'custom:order/block/taxes.tpl', 5, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['cart']['taxes'][$this->_tpl_vars['currency']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax']):
?>
	<tr>
		<td colspan="<?php echo smarty_function_math(array('equation' => ($this->_tpl_vars['extraColspanSize'])." + 3"), $this);?>
" class="subTotalCaption"><?php echo $this->_tpl_vars['tax']['name_lang']; ?>
:</td>
		<td class="amount taxAmount"><?php echo $this->_tpl_vars['tax']['formattedAmount']; ?>
</td>
		<?php echo array_shift($this->_tpl_vars['GLOBALS']['cartUpdate']); ?>

	</tr>
<?php endforeach; endif; unset($_from); ?>