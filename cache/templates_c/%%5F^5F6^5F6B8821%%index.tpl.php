<?php /* Smarty version 2.6.26, created on 2015-12-01 10:53:37
         compiled from /home/illumin/public_html/application/view///backend/session/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/session/index.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/session/index.tpl', 2, false),array('function', 'img', '/home/illumin/public_html/application/view///backend/session/index.tpl', 9, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/session/index.tpl', 16, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/session/index.tpl', 2, false),array('modifier', 'branding', '/home/illumin/public_html/application/view///backend/session/index.tpl', 2, false),array('modifier', 'config', '/home/illumin/public_html/application/view///backend/session/index.tpl', 9, false),array('modifier', 'or', '/home/illumin/public_html/application/view///backend/session/index.tpl', 9, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/session/index.tpl', 19, false),)), $this); ?>
<?php echo smarty_function_includeCss(array('file' => "backend/Session.css"), $this);?>

<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_backend_login'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__backend_login', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__backend_login'])) ? $this->_run_mod_handler('branding', true, $_tmp) : $this->_plugins['modifier']['branding'][0][0]->branding($_tmp)); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/meta.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1 id="loginHeader"><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_backend_login'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__backend_login', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__backend_login'])) ? $this->_run_mod_handler('branding', true, $_tmp) : $this->_plugins['modifier']['branding'][0][0]->branding($_tmp)); ?>
</h1>

<div id="logoContainer">
	<?php echo smarty_function_img(array('src' => smarty_modifier_or(((is_array($_tmp='BACKEND_LOGIN_LOGO')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)), "image/promo/transparentlogo.png")), $this);?>

</div>

<div id="loginContainer">
<?php if ($this->_tpl_vars['request']['failed']): ?>
	<div class="loginFailed"><?php echo smarty_function_translate(array('text' => '_login_failed'), $this);?>
</div>
<?php endif; ?>
<form action="<?php echo smarty_function_link(array('controller' => "backend.session",'action' => 'doLogin'), $this);?>
" method="post" />
	<p>
	   <label for="email"><?php echo smarty_function_translate(array('text' => '_email'), $this);?>
:</label>
	   <input type="text" class="text" id="email" name="email" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	</p>
	<p>
		<label for="password"><?php echo smarty_function_translate(array('text' => '_password'), $this);?>
:</label>
		<fieldset class="container">
			<input type="password" class="text" id="password" name="password" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['password'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
			<a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'remindPassword','query' => "return=".($this->_tpl_vars['return'])), $this);?>
" class="forgottenPassword">
				<?php echo smarty_function_translate(array('text' => '_remind_password'), $this);?>

			</a>
		</fieldset>
	</p>

   	<p>
		<label></label>
		<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_login','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
	</p>

	<input type="hidden" name="return" value="<?php echo $this->_tpl_vars['return']; ?>
" />

</form>

</div>

<?php echo '
	<script type="text/javascript">
		Event.observe(window, \'load\', function() {$(\'email\').focus()});
	</script>
'; ?>


</body>
</html>
