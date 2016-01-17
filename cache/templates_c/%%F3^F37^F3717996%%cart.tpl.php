<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from /home/illumin/public_html/application/view///onePageCheckout/cart.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', '/home/illumin/public_html/application/view///onePageCheckout/cart.tpl', 1, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///onePageCheckout/cart.tpl', 10, false),array('modifier', 'str_split', '/home/illumin/public_html/application/view///onePageCheckout/cart.tpl', 12, false),array('function', 'translate', '/home/illumin/public_html/application/view///onePageCheckout/cart.tpl', 4, false),array('block', 'form', '/home/illumin/public_html/application/view///onePageCheckout/cart.tpl', 15, false),)), $this); ?>
<?php if (((is_array($_tmp='SHOW_SKU_CART')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
	<?php $this->assign('extraColspanSize', "1+".($this->_tpl_vars['extraColspanSize'])); ?>
<?php endif; ?>
<h2><?php echo smarty_function_translate(array('text' => '_shopping_cart'), $this);?>
</h2>

<a href="#" id="checkout-return-to-overview"><?php echo smarty_function_translate(array('text' => '_return_to_overview'), $this);?>
</a>
<div class="clear"></div>

<?php ob_start(); ?>
	<td id="cartUpdate"><input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_update','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" /></td>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('cartUpdate', ob_get_contents());ob_end_clean(); ?>
<?php $this->assign('cartUpdate', str_split($this->_tpl_vars['cartUpdate'], 10000)); ?>
<?php $GLOBALS['cartUpdate'] = $this->get_template_vars('cartUpdate'); $this->assign_by_ref('GLOBALS', $GLOBALS); ?>

<?php $this->_tag_stack[] = array('form', array('action' => "controller=onePageCheckout action=updateCart",'method' => 'POST','enctype' => "multipart/form-data",'handle' => $this->_tpl_vars['form'],'id' => 'cartItems')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<table id="cart">
	<thead>
		<tr>
			<th colspan="<?php if (((is_array($_tmp='SHOW_SKU_CART')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>4<?php else: ?>3<?php endif; ?>" class="cartListTitle"></th>
			<th class="cartPrice"><?php echo smarty_function_translate(array('text' => '_price'), $this);?>
</th>
			<th class="cartQuant"><?php echo smarty_function_translate(array('text' => '_quantity'), $this);?>
</th>
		</tr>
	</thead>
	<tbody>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/block/items.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/block/discounts.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/block/shipping.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php if (! ((is_array($_tmp='HIDE_TAXES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/block/taxes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/block/total.tpl", 'smarty_include_vars' => array('extraColspanSize' => $this->_tpl_vars['extraColspanSize'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/block/customFields.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/block/coupons.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	</tbody>
</table>
<input type="hidden" name="return" value="<?php echo $this->_tpl_vars['return']; ?>
" />

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>