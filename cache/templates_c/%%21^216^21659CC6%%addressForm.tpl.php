<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from custom:user/addressForm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:user/addressForm.tpl', 1, false),array('modifier', 'escape', 'custom:user/addressForm.tpl', 116, false),array('function', 'translate', 'custom:user/addressForm.tpl', 6, false),array('function', 'textfield', 'custom:user/addressForm.tpl', 7, false),array('function', 'uniqid', 'custom:user/addressForm.tpl', 84, false),array('function', 'selectfield', 'custom:user/addressForm.tpl', 84, false),array('function', 'hidden', 'custom:user/addressForm.tpl', 91, false),array('block', 'error', 'custom:user/addressForm.tpl', 9, false),)), $this); ?>
<?php $this->assign('fields', ((is_array($_tmp='USER_FIELDS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))); ?>

<?php if ($this->_tpl_vars['fields']['FIRSTNAME']): ?>
<p class="required">
	
	   <label for="<?php echo $this->_tpl_vars['prefix']; ?>
firstName"><span class="label"><?php echo smarty_function_translate(array('text' => '_your_first_name'), $this);?>
:</span></label>
	   <fieldset class="error"><?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['prefix'])."firstName",'class' => 'text'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."firstName")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."firstName")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['fields']['LASTNAME']): ?>
<p class="required">
	
		<label for="<?php echo $this->_tpl_vars['prefix']; ?>
lastName"><span class="label"><?php echo smarty_function_translate(array('text' => '_your_last_name'), $this);?>
:</span></label>
		<fieldset class="error"><?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['prefix'])."lastName",'class' => 'text'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."lastName")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."lastName")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['fields']['COMPANYNAME']): ?>
<p>
	
		<label for="<?php echo $this->_tpl_vars['prefix']; ?>
companyName"><span class="label"><?php echo smarty_function_translate(array('text' => '_company_name'), $this);?>
:</span></label>
		<fieldset class="error"><?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['prefix'])."companyName",'class' => 'text'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."companyName")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."companyName")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['fields']['PHONE']): ?>
<p<?php if (((is_array($_tmp='REQUIRE_PHONE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?> class="required"<?php endif; ?>>
	
		<label for="<?php echo $this->_tpl_vars['prefix']; ?>
phone"><span class="label"><?php echo smarty_function_translate(array('text' => '_your_phone'), $this);?>
:</span></label>
		<fieldset class="error"><?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['prefix'])."phone",'class' => 'text'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."phone")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."phone")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</p>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:block/eav/fields.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['address'],'eavPrefix' => $this->_tpl_vars['prefix'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['fields']['ADDRESS1']): ?>
<p class="required">
	
		<label for="<?php echo $this->_tpl_vars['prefix']; ?>
address1"><span class="label"><?php echo smarty_function_translate(array('text' => '_address'), $this);?>
:</span></label>
		<fieldset class="error"><?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['prefix'])."address1",'class' => 'text'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."address1")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."address1")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['fields']['ADDRESS2']): ?>
<p>
	<label>&nbsp;</label>
	<fieldset class="error">
		<?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['prefix'])."address2",'class' => 'text'), $this);?>

	</fieldset>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['fields']['CITY']): ?>
<p class="required">
	
		<label for="<?php echo $this->_tpl_vars['prefix']; ?>
city"><span class="label"><?php echo smarty_function_translate(array('text' => '_city'), $this);?>
:</span></label>
		<fieldset class="error"><?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['prefix'])."city",'class' => 'text'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."city")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."city")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['fields']['COUNTRY']): ?>
<p class="required">
	
		<label for="<?php echo $this->_tpl_vars['prefix']; ?>
country"><span class="label"><?php echo smarty_function_translate(array('text' => '_country'), $this);?>
:</span></label>
		<fieldset class="error"><?php ob_start(); ?><?php echo smarty_function_uniqid(array('assign' => 'id_country'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_selectfield(array('name' => ($this->_tpl_vars['prefix'])."country",'options' => $this->_tpl_vars['countries'],'id' => ($this->_tpl_vars['blockAsParamValue'])), $this);?>

		<span class="progressIndicator" style="display: none;"></span>
	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."country")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."country")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</p>
<?php else: ?>
	<?php ob_start(); ?><?php echo smarty_function_uniqid(array('assign' => 'id_country'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_hidden(array('name' => ($this->_tpl_vars['prefix'])."country",'id' => ($this->_tpl_vars['blockAsParamValue'])), $this);?>

<?php endif; ?>

<?php if ($this->_tpl_vars['fields']['STATE']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/addressFormState.tpl", 'smarty_include_vars' => array('prefix' => $this->_tpl_vars['prefix'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['fields']['POSTALCODE']): ?>
<p class="required">
	
		<label for="<?php echo $this->_tpl_vars['prefix']; ?>
postalCode"><span class="label"><?php echo smarty_function_translate(array('text' => '_postal_code'), $this);?>
:</span></label>
		<fieldset class="error"><?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['prefix'])."postalCode",'class' => 'text'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."postalCode")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."postalCode")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['return']): ?>
	<input type="hidden" name="return" value="<?php echo $this->_tpl_vars['return']; ?>
" />
<?php endif; ?>

<?php if ($this->_tpl_vars['confirmButton']): ?>
	<div class="confirmButtonContainer">
		<label class="confirmAddressLabel"></label>
		<input type="button" class="button confirmAddress" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_confirm_address','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
		<span class="progressIndicator" style="display: none;"></span>
	</div>
<?php endif; ?>