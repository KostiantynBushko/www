<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:36
         compiled from /home/illumin/public_html/application/view///order/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadJs', '/home/illumin/public_html/application/view///order/index.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/application/view///order/index.tpl', 8, false),array('function', 'link', '/home/illumin/public_html/application/view///order/index.tpl', 20, false),array('modifier', 'config', '/home/illumin/public_html/application/view///order/index.tpl', 28, false),)), $this); ?>
<?php echo smarty_function_loadJs(array('form' => true), $this);?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content" class="left orderIndex">

	<div class="checkoutHeader">
		<h1><?php echo smarty_function_translate(array('text' => '_your_basket'), $this);?>
</h1>

		<?php if ($this->_tpl_vars['cart']['cartItems'] && ! $this->_tpl_vars['isOnePageCheckout']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/checkoutProgress.tpl", 'smarty_include_vars' => array('progress' => 'progressCart','order' => 'cart')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
	</div>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:block/message.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/changeMessages.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php if (! $this->_tpl_vars['cart']['cartItems'] && ! $this->_tpl_vars['cart']['wishListItems']): ?>
		<div style="clear: left;">
			<?php echo smarty_function_translate(array('text' => '_empty_basket'), $this);?>
. <a href="<?php echo smarty_function_link(array('route' => $this->_tpl_vars['return']), $this);?>
"><?php echo smarty_function_translate(array('text' => '_continue_shopping'), $this);?>
</a>.
		</div>
	<?php else: ?>

	<?php if ($this->_tpl_vars['cart']['cartItems']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/cartItems.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['cart']['wishListItems'] && ((is_array($_tmp='ENABLE_WISHLISTS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<div style="clear: left;">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/wishList.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	<?php endif; ?>

	<?php endif; ?>

	<div class="clear"></div>

</div>

<script type="text/javascript">
	new Order.OptionLoader($('cart'));
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>