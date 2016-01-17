<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from /home/illumin/public_html/application/view///onePageCheckout/login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///onePageCheckout/login.tpl', 1, false),array('function', 'link', '/home/illumin/public_html/application/view///onePageCheckout/login.tpl', 10, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///onePageCheckout/login.tpl', 26, false),)), $this); ?>
<h2><?php echo smarty_function_translate(array('text' => '_returning'), $this);?>
</h2>
<?php if ($this->_tpl_vars['failedLogin']): ?>
	<div class="errorMsg failed">
		<?php echo smarty_function_translate(array('text' => '_login_failed'), $this);?>

	</div>
<?php endif; ?>
<p id="login-msg">
	<?php echo smarty_function_translate(array('text' => '_opc_login_msg'), $this);?>

</p>
<form method="POST" action="<?php echo smarty_function_link(array('controller' => 'onePageCheckout','action' => 'doLogin'), $this);?>
">
	<div class="one-page-checkout-login-field">
		<label><?php echo smarty_function_translate(array('text' => '_your_email'), $this);?>
:</label>
		<input type="text" class="text" id="email" name="email" />
	</div>
	<div class="one-page-checkout-login-field">
		<label><?php echo smarty_function_translate(array('text' => '_password'), $this);?>
:</label>
		<fieldset class="container">
			<input type="password" class="text" id="password" name="password" />
			<a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'remindPassword','query' => "return=onePageCheckout"), $this);?>
" class="forgottenPassword">
				<?php echo smarty_function_translate(array('text' => '_remind_password'), $this);?>

			</a>
		</fieldset>
	</div>
	<div class="one-page-checkout-login-field">
		<label class="empty">&nbsp;</label>
		<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_login','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
	</div>
	<div class="clear"></div>
</form>