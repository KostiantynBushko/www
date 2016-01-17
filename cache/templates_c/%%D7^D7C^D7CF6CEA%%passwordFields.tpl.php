<?php /* Smarty version 2.6.26, created on 2015-12-01 15:10:26
         compiled from custom:user/block/passwordFields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:user/block/passwordFields.tpl', 3, false),array('function', 'textfield', 'custom:user/block/passwordFields.tpl', 4, false),array('block', 'error', 'custom:user/block/passwordFields.tpl', 6, false),)), $this); ?>
<p <?php if ($this->_tpl_vars['required']): ?>class="required"<?php endif; ?>>
	
		<label for="password"><span class="label"><?php echo smarty_function_translate(array('text' => '_password'), $this);?>
:</span></label>
		<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'password','type' => 'password','class' => 'text'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'password')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'password')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</p>

<p <?php if ($this->_tpl_vars['required']): ?>class="required"<?php endif; ?>>
	
		<label for="confpassword"><span class="label"><?php echo smarty_function_translate(array('text' => '_conf_password'), $this);?>
:</span></label>
		<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'confpassword','type' => 'password','class' => 'text'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'confpassword')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'confpassword')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</p>