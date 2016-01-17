<?php /* Smarty version 2.6.26, created on 2015-12-01 15:10:26
         compiled from custom:user/loginForm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', 'custom:user/loginForm.tpl', 1, false),array('function', 'translate', 'custom:user/loginForm.tpl', 3, false),array('modifier', 'escape', 'custom:user/loginForm.tpl', 4, false),)), $this); ?>
<form action="<?php echo smarty_function_link(array('controller' => 'user','action' => 'doLogin'), $this);?>
" method="post" id="loginForm" />
	<p>
	   <label for="email"><?php echo smarty_function_translate(array('text' => '_your_email'), $this);?>
:</label>
	   <input type="text" class="text" id="email" name="email" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	</p>
	<p>
		<label for="password"><?php echo smarty_function_translate(array('text' => '_your_pass'), $this);?>
:</label>
		<fieldset class="container" style="padding-left: 0px !important;">
			<input type="password" class="text" id="password" name="password" />
			<a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'remindPassword','query' => "return=".($this->_tpl_vars['return'])), $this);?>
" class="forgottenPassword">
				<?php echo smarty_function_translate(array('text' => '_remind_password'), $this);?>

			</a>
		</fieldset>
	</p>

   	<p class="submit">
		<label class="empty"></label>
		<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_login','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
	</p>

	<input type="hidden" name="return" value="<?php echo $this->_tpl_vars['return']; ?>
" />

</form>