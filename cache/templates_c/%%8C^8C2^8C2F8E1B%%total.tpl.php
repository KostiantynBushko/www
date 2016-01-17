<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:01
         compiled from custom:order/block/total.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'custom:order/block/total.tpl', 2, false),array('function', 'translate', 'custom:order/block/total.tpl', 2, false),array('modifier', 'array_shift', 'custom:order/block/total.tpl', 4, false),)), $this); ?>
<tr>
	<td class="ttl" colspan="<?php echo smarty_function_math(array('equation' => ($this->_tpl_vars['extraColspanSize'])." + 3"), $this);?>
" class="subTotalCaption"><?php echo smarty_function_translate(array('text' => '_total'), $this);?>
:</td>
	<td class="subTotal"><?php echo $this->_tpl_vars['cart']['formattedTotal'][$this->_tpl_vars['currency']]; ?>
</td>
	<?php echo array_shift($this->_tpl_vars['GLOBALS']['cartUpdate']); ?>

</tr>