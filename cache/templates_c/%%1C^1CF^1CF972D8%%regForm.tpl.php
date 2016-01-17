<?php /* Smarty version 2.6.26, created on 2015-12-01 15:10:26
         compiled from custom:user/regForm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', 'custom:user/regForm.tpl', 1, false),array('block', 'error', 'custom:user/regForm.tpl', 10, false),array('function', 'translate', 'custom:user/regForm.tpl', 7, false),array('function', 'textfield', 'custom:user/regForm.tpl', 8, false),array('function', 'renderBlock', 'custom:user/regForm.tpl', 45, false),array('modifier', 'escape', 'custom:user/regForm.tpl', 49, false),)), $this); ?>
<?php $this->_tag_stack[] = array('form', array('action' => "controller=user action=doRegister",'method' => 'POST','handle' => $this->_tpl_vars['regForm'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

	
	<p class="required">
		
			<label for="firstName"><span class="label"><?php echo smarty_function_translate(array('text' => '_your_first_name'), $this);?>
:</span></label>
			<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'firstName','class' => 'text'), $this);?>

		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'firstName')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'firstName')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	</p>

	<p class="required">
		
			<label for="lastName"><span class="label"><?php echo smarty_function_translate(array('text' => '_your_last_name'), $this);?>
:</span></label>
			<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'lastName','class' => 'text'), $this);?>

		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'lastName')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'lastName')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	</p>

	<p>
		
			<label for="companyName"><span class="label"><?php echo smarty_function_translate(array('text' => '_company_name'), $this);?>
:</span></label>
			<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'companyName','class' => 'text'), $this);?>

		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'companyName')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'companyName')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	</p>

	<p class="required">
		
			<label for="email"><span class="label"><?php echo smarty_function_translate(array('text' => '_your_email'), $this);?>
:</span></label>
			<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'email','class' => 'text'), $this);?>

		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'email')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'email')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	</p>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/block/passwordFields.tpl", 'smarty_include_vars' => array('required' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:block/eav/fields.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['user'],'filter' => 'isDisplayed')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php echo smarty_function_renderBlock(array('block' => "FORM-SUBMIT-REGISTER"), $this);?>


	<p class="submit">
		<label class="empty"></label>
		<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_complete_reg','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
		<?php if ($this->_tpl_vars['request']['return']): ?>
			<input type="hidden" name="return" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['request']['return'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
		<?php endif; ?>
	</p>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>