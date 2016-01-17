<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from custom:checkout/completeOverview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:checkout/completeOverview.tpl', 2, false),array('function', 'link', 'custom:checkout/completeOverview.tpl', 41, false),array('modifier', 'config', 'custom:checkout/completeOverview.tpl', 46, false),)), $this); ?>
<fieldset class="container completeOverview">
<h2><?php echo smarty_function_translate(array('text' => '_order_overview'), $this);?>
</h2>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/orderOverview.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (!function_exists('smarty_fun_address')) { function smarty_fun_address(&$smarty, $params) { $_fun_tpl_vars = $smarty->_tpl_vars; $smarty->assign($params);  ?>
	<?php if ($smarty->_tpl_vars['address']): ?>
		<p>
			<?php echo $smarty->_tpl_vars['address']['fullName']; ?>

		</p>
		<p>
			<?php echo $smarty->_tpl_vars['address']['companyName']; ?>

		</p>
		<p>
			<?php echo $smarty->_tpl_vars['address']['address1']; ?>

		</p>
		<p>
			<?php echo $smarty->_tpl_vars['address']['address2']; ?>

		</p>
		<p>
			<?php echo $smarty->_tpl_vars['address']['city']; ?>

		</p>
		<p>
			<?php if ($smarty->_tpl_vars['address']['stateName']): ?><?php echo $smarty->_tpl_vars['address']['stateName']; ?>
, <?php endif; ?><?php echo $smarty->_tpl_vars['address']['postalCode']; ?>

		</p>
		<p>
			<?php echo $smarty->_tpl_vars['address']['countryName']; ?>

		</p>
		<p>
			<?php $_smarty_tpl_vars = $smarty->_tpl_vars;
$smarty->_smarty_include(array('smarty_include_tpl_file' => "custom:order/addressFieldValues.tpl", 'smarty_include_vars' => array('showLabels' => true)));
$smarty->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</p>
	<?php endif; ?>
<?php  $smarty->_tpl_vars = $_fun_tpl_vars; }} smarty_fun_address($this, array());  ?>

<div id="overviewAddresses">
	<?php if ($this->_tpl_vars['order']['ShippingAddress'] && ! $this->_tpl_vars['order']['isMultiAddress']): ?>
		<div class="addressContainer">
			<h3><?php echo smarty_function_translate(array('text' => '_will_ship_to'), $this);?>
:</h3>
			<?php smarty_fun_address($this, array('address'=>$this->_tpl_vars['order']['ShippingAddress']));  ?>
			<?php if (! $this->_tpl_vars['nochanges']): ?>
				<a href="<?php echo smarty_function_link(array('controller' => 'checkout','action' => 'selectAddress'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_change'), $this);?>
</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['order']['BillingAddress'] && ! ((is_array($_tmp='REQUIRE_SAME_ADDRESS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) && ( $this->_tpl_vars['order']['ShippingAddress']['compact'] != $this->_tpl_vars['order']['BillingAddress']['compact'] )): ?>
	<div class="addressContainer">
		<h3><?php echo smarty_function_translate(array('text' => '_will_bill_to'), $this);?>
:</h3>
		<?php smarty_fun_address($this, array('address'=>$this->_tpl_vars['order']['BillingAddress']));  ?>
		<?php if (! $this->_tpl_vars['nochanges']): ?>
			<a href="<?php echo smarty_function_link(array('controller' => 'checkout','action' => 'selectAddress'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_change'), $this);?>
</a>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<div class="clear"></div>
</div>

</fieldset>