<?php /* Smarty version 2.6.26, created on 2015-12-01 15:19:37
         compiled from /home/illumin/public_html/application/view///user/remindPassword.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadJs', '/home/illumin/public_html/application/view///user/remindPassword.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/application/view///user/remindPassword.tpl', 2, false),array('function', 'textfield', '/home/illumin/public_html/application/view///user/remindPassword.tpl', 16, false),array('function', 'link', '/home/illumin/public_html/application/view///user/remindPassword.tpl', 27, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///user/remindPassword.tpl', 2, false),array('block', 'form', '/home/illumin/public_html/application/view///user/remindPassword.tpl', 12, false),array('block', 'error', '/home/illumin/public_html/application/view///user/remindPassword.tpl', 18, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///user/remindPassword.tpl', 24, false),)), $this); ?>
<?php echo smarty_function_loadJs(array('form' => true), $this);?>

<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_remind_pass'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="userRemindPassword">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content">

	<h1><?php echo smarty_function_translate(array('text' => '_remind_pass'), $this);?>
</h1>

	<?php $this->_tag_stack[] = array('form', array('action' => "controller=user action=doRemindPassword",'method' => 'post','style' => "float: left; width: 100%;",'handle' => $this->_tpl_vars['form'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<p>
			
				<label for="email"><span class="label"><?php echo smarty_function_translate(array('text' => '_your_email'), $this);?>
: </span></label>
				<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'email','class' => 'text'), $this);?>

			
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'email')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'email')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
		</p>

		<p>
			<label></label>
			<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_continue','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
		   	<label class="cancel">
				<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

				<a class="cancel" href="<?php echo smarty_function_link(array('route' => $this->_tpl_vars['return'],'controller' => 'user'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
			</label>
		</p>

		<input type="hidden" name="return" value="<?php echo $this->_tpl_vars['return']; ?>
" />

	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>