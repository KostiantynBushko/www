<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from /home/illumin/public_html/application/view///onePageCheckout/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadJs', '/home/illumin/public_html/application/view///onePageCheckout/index.tpl', 1, false),array('function', 'link', '/home/illumin/public_html/application/view///onePageCheckout/index.tpl', 4, false),array('function', 'translate', '/home/illumin/public_html/application/view///onePageCheckout/index.tpl', 17, false),array('function', 'json', '/home/illumin/public_html/application/view///onePageCheckout/index.tpl', 64, false),array('modifier', 'config', '/home/illumin/public_html/application/view///onePageCheckout/index.tpl', 63, false),)), $this); ?>
<?php echo smarty_function_loadJs(array('form' => true), $this);?>


<noscript>
	<meta http-equiv="refresh" content="0;<?php echo smarty_function_link(array('controller' => 'onePageCheckout','action' => 'fallback'), $this);?>
" />
</noscript>

<script type="text/javascript">
	if (Prototype.Browser.IE6)
	{
		window.location.href = '<?php echo smarty_function_link(array('controller' => 'onePageCheckout','action' => 'fallback'), $this);?>
';
	}
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content" class="left right orderIndex">
	<h1><?php echo smarty_function_translate(array('text' => '_checkout'), $this);?>
</h1>

	<?php if ($this->_tpl_vars['paymentError']): ?>
		<div class="errorMessage" style="margin-bottom: 1em;">
			Your payment was declined: <?php echo $this->_tpl_vars['paymentError']; ?>
<br />
			Please try again.
		</div>
	<?php endif; ?>

	<div id="checkout-right">
		<div id="checkout-cart">
			<?php echo $this->_tpl_vars['cart']; ?>

		</div>

		<div id="checkout-overview">
			<?php echo $this->_tpl_vars['overview']; ?>

		</div>
	</div>

	<?php if (! $this->_tpl_vars['user']['ID']): ?>
	<div id="checkout-login">
		<?php echo $this->_tpl_vars['login']; ?>

	</div>
	<?php endif; ?>

	<div id="checkout-shipping">
		<div id="checkout-shipping-address">
			<?php echo $this->_tpl_vars['shippingAddress']; ?>

		</div>
		<div id="checkout-shipping-method">
			<?php echo $this->_tpl_vars['shippingMethods']; ?>

		</div>
	</div>

	<div id="checkout-billing">
		<?php echo $this->_tpl_vars['billingAddress']; ?>

	</div>

	<div id="checkout-payment">
		<?php echo $this->_tpl_vars['payment']; ?>

	</div>

	<div class="clear"></div>

</div>
	<script type="text/javascript">
		var checkout = new Frontend.OnePageCheckout({OPC_SHOW_CART: <?php echo ((is_array($_tmp='OPC_SHOW_CART')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
});
		checkout.updateCompletedSteps(<?php echo smarty_function_json(array('array' => $this->_tpl_vars['completedSteps']), $this);?>
);
		checkout.updateEditableSteps(<?php echo smarty_function_json(array('array' => $this->_tpl_vars['editableSteps']), $this);?>
);
		Observer.process('order', <?php echo smarty_function_json(array('array' => $this->_tpl_vars['orderValues']), $this);?>
);
<?php echo '
		new User.ShippingFormToggler($(\'sameAsShipping\'), $(\'billingAddressForm\'));
		new User.ShippingFormToggler($(\'sameAsShipping\'), $(\'checkout-billing\').down(\'.addressSelector\'));
	</script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>