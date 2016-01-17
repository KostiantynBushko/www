<?php /* Smarty version 2.6.26, created on 2015-12-01 15:10:26
         compiled from /home/illumin/public_html/storage/customize/view//theme/IlluminataV3//user/login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadJs', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//user/login.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//user/login.tpl', 9, false),array('function', 'link', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//user/login.tpl', 25, false),)), $this); ?>
<?php echo smarty_function_loadJs(array('form' => true), $this);?>


<div class="userLogin">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/layout.tpl", 'smarty_include_vars' => array('hideLeft' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content" class="left">

	<h1><?php echo smarty_function_translate(array('text' => '_login'), $this);?>
</h1>

	<div class="returningCustomer">
		<h2><?php echo smarty_function_translate(array('text' => '_returning'), $this);?>
</h2>

		<p>
			<?php if ($this->_tpl_vars['failed']): ?>
				<div class="errorMsg failed">
					<?php echo smarty_function_translate(array('text' => '_login_failed'), $this);?>

				</div>
			<?php else: ?>
				<label class="empty"></label>
				<?php echo smarty_function_translate(array('text' => '_please_sign_in'), $this);?>

			<?php endif; ?>
		</p>

		<?php ob_start(); ?><?php echo smarty_function_link(array('controller' => 'user'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/loginForm.tpl", 'smarty_include_vars' => array('return' => $this->_tpl_vars['return'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>

	<div class="newCustomer">
		<h2><?php echo smarty_function_translate(array('text' => '_new_cust'), $this);?>
</h2>

			<label class="empty"></label>
			<?php echo smarty_function_translate(array('text' => '_not_registered'), $this);?>


		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/regForm.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>

	<div class="clear"></div>

</div>

<?php echo '
	<script type="text/javascript">
		Event.observe(window, \'load\', function() {$(\'email\').focus()});
	</script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>