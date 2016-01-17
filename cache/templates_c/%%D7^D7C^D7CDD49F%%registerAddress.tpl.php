<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from custom:user/block/registerAddress.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:user/block/registerAddress.tpl', 1, false),array('function', 'renderBlock', 'custom:user/block/registerAddress.tpl', 3, false),array('function', 'translate', 'custom:user/block/registerAddress.tpl', 8, false),array('function', 'textfield', 'custom:user/block/registerAddress.tpl', 9, false),array('function', 'selectfield', 'custom:user/block/registerAddress.tpl', 105, false),array('function', 'link', 'custom:user/block/registerAddress.tpl', 128, false),array('block', 'error', 'custom:user/block/registerAddress.tpl', 11, false),)), $this); ?>
<?php $this->assign('fields', ((is_array($_tmp='USER_FIELDS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))); ?>

<?php echo smarty_function_renderBlock(array('block' => "FORM-NEW-CUSTOMER-TOP"), $this);?>


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

<p class="required">
	
		<label for="email"><span class="label"><?php echo smarty_function_translate(array('text' => '_your_email'), $this);?>
:</span></label>
		<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'email','class' => 'text'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'email')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'email')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</p>

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

<?php if (((is_array($_tmp='PASSWORD_GENERATION')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) != 'PASSWORD_AUTO'): ?>
	<?php if (((is_array($_tmp='PASSWORD_GENERATION')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) == 'PASSWORD_REQUIRE'): ?>
		<?php $this->assign('passRequired', true); ?>
	<?php endif; ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/block/passwordFields.tpl", 'smarty_include_vars' => array('required' => $this->_tpl_vars['passRequired'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:block/eav/fields.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['user'],'filter' => 'isDisplayed')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:block/eav/fields.tpl", 'smarty_include_vars' => array('eavPrefix' => $this->_tpl_vars['prefix'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['showHeading'] && $this->_tpl_vars['order']['isShippingRequired'] && ! ((is_array($_tmp='REQUIRE_SAME_ADDRESS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
	<h3><?php echo smarty_function_translate(array('text' => '_billing_address'), $this);?>
</h3>
<?php endif; ?>

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
	<label></label>
	<?php echo smarty_function_textfield(array('name' => 'billing_address2','class' => 'text'), $this);?>

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
		<fieldset class="error"><?php echo smarty_function_selectfield(array('name' => ($this->_tpl_vars['prefix'])."country",'options' => $this->_tpl_vars['countries'],'id' => ($this->_tpl_vars['prefix'])."country"), $this);?>

		<span class="progressIndicator" style="display: none;"></span>
	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."country")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."country")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['fields']['STATE']): ?>
<?php if (! ((is_array($_tmp='DISABLE_STATE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
	<p class="required">
		
			<label for="<?php echo $this->_tpl_vars['prefix']; ?>
state_select"><span class="label"><?php echo smarty_function_translate(array('text' => '_state'), $this);?>
:</span></label>
			<fieldset class="error"><?php echo smarty_function_selectfield(array('name' => ($this->_tpl_vars['prefix'])."state_select",'style' => "display: none;",'options' => $this->_tpl_vars['states'],'id' => ($this->_tpl_vars['prefix'])."state_select"), $this);?>

			<?php echo smarty_function_textfield(array('name' => 'billing_state_text','class' => 'text','id' => ($this->_tpl_vars['prefix'])."state_text"), $this);?>

		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."state_select")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."state_select")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>

		<?php echo '
		<script type="text/javascript">
		'; ?>

			new User.StateSwitcher($('<?php echo $this->_tpl_vars['prefix']; ?>
country'), $('<?php echo $this->_tpl_vars['prefix']; ?>
state_select'), $('<?php echo $this->_tpl_vars['prefix']; ?>
state_text'),
					'<?php echo smarty_function_link(array('controller' => 'user','action' => 'states'), $this);?>
');
		</script>
	</p>
<?php endif; ?>
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