<?php /* Smarty version 2.6.26, created on 2015-12-02 13:11:48
         compiled from custom:backend/user/info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', 'custom:backend/user/info.tpl', 1, false),array('function', 'checkbox', 'custom:backend/user/info.tpl', 4, false),array('function', 'translate', 'custom:backend/user/info.tpl', 5, false),array('function', 'selectfield', 'custom:backend/user/info.tpl', 13, false),array('function', 'textfield', 'custom:backend/user/info.tpl', 21, false),array('function', 'password', 'custom:backend/user/info.tpl', 56, false),array('modifier', 'default', 'custom:backend/user/info.tpl', 95, false),)), $this); ?>
<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['form'],'action' => "controller=backend.user action=update",'id' => "userInfo_".($this->_tpl_vars['someUser']['UserGroup']['ID'])."_".($this->_tpl_vars['someUser']['ID'])."_form",'onsubmit' => "Backend.User.Editor.prototype.getInstance(".($this->_tpl_vars['someUser']['ID']).", false).submitForm(); return false;",'method' => 'post','role' => "user.create(backend.userGroup/index),user.update(backend.user/info)")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<p>
		<fieldset class="error checkbox">
			<?php echo smarty_function_checkbox(array('name' => 'isEnabled','id' => "user_".($this->_tpl_vars['someUser']['UserGroup']['ID'])."_".($this->_tpl_vars['someUser']['ID'])."_isEnabled",'class' => 'checkbox'), $this);?>

			<label for="user_<?php echo $this->_tpl_vars['someUser']['UserGroup']['ID']; ?>
_<?php echo $this->_tpl_vars['someUser']['ID']; ?>
_isEnabled" class="checkbox"><?php echo smarty_function_translate(array('text' => '_is_enabled'), $this);?>
</label>
			<div class="errorText" style="display: none" ></span>
		</fieldset>
	</p>

	<p class="required">
		<label for="user_<?php echo $this->_tpl_vars['someUser']['UserGroup']['ID']; ?>
_<?php echo $this->_tpl_vars['someUser']['ID']; ?>
_userGroup" class="user_userGroupLabel"><?php echo smarty_function_translate(array('text' => '_user_group'), $this);?>
</label>
		<fieldset class="error user_userGroup">
			<?php echo smarty_function_selectfield(array('name' => 'UserGroup','options' => $this->_tpl_vars['availableUserGroups'],'id' => "user_".($this->_tpl_vars['someUser']['UserGroup']['ID'])."_".($this->_tpl_vars['someUser']['ID'])."_userGroup"), $this);?>

			<div class="errorText hidden"> </div>
		</fieldset>
	</p>

	<p class="required">
		<label for="user_<?php echo $this->_tpl_vars['someUser']['UserGroup']['ID']; ?>
_<?php echo $this->_tpl_vars['someUser']['ID']; ?>
_firstName"><?php echo smarty_function_translate(array('text' => '_first_name'), $this);?>
</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => 'firstName','id' => "user_".($this->_tpl_vars['someUser']['UserGroup']['ID'])."_".($this->_tpl_vars['someUser']['ID'])."_firstName"), $this);?>

			<div class="errorText" style="display: none" ></span>
		</fieldset>
	</p>

	<p class="required">
		<label for="user_<?php echo $this->_tpl_vars['someUser']['UserGroup']['ID']; ?>
_<?php echo $this->_tpl_vars['someUser']['ID']; ?>
_lastName"><?php echo smarty_function_translate(array('text' => '_last_name'), $this);?>
</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => 'lastName','id' => "user_".($this->_tpl_vars['someUser']['UserGroup']['ID'])."_".($this->_tpl_vars['someUser']['ID'])."_lastName"), $this);?>

			<div class="errorText" style="display: none" ></span>
		</fieldset>
	</p>

	<p>
		<label for="user_<?php echo $this->_tpl_vars['someUser']['UserGroup']['ID']; ?>
_<?php echo $this->_tpl_vars['someUser']['ID']; ?>
_companyName"><?php echo smarty_function_translate(array('text' => '_company_name'), $this);?>
</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => 'companyName','id' => "user_".($this->_tpl_vars['someUser']['UserGroup']['ID'])."_".($this->_tpl_vars['someUser']['ID'])."_companyName"), $this);?>

			<div class="errorText" style="display: none" ></span>
		</fieldset>
	</p>

	<p class="required">
		<label for="user_<?php echo $this->_tpl_vars['someUser']['UserGroup']['ID']; ?>
_<?php echo $this->_tpl_vars['someUser']['ID']; ?>
_email"><?php echo smarty_function_translate(array('text' => '_email'), $this);?>
</label>
		<fieldset class="error">
			<?php echo smarty_function_textfield(array('name' => 'email','id' => "user_".($this->_tpl_vars['someUser']['UserGroup']['ID'])."_".($this->_tpl_vars['someUser']['ID'])."_email"), $this);?>

			<div class="errorText" style="display: none" ></span>
		</fieldset>
	</p>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/fields.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['someUser'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<p <?php if (! $this->_tpl_vars['someUser']['ID']): ?>class="required"<?php endif; ?>>
		<label for="user_<?php echo $this->_tpl_vars['someUser']['UserGroup']['ID']; ?>
_<?php echo $this->_tpl_vars['someUser']['ID']; ?>
_password"><?php echo smarty_function_translate(array('text' => '_password'), $this);?>
</label>
		<fieldset class="error userPasswordBlock">
			<span class="progressIndicator generatePasswordProgressIndicator" style="display: none;"></span>
			<?php echo smarty_function_password(array('name' => 'password','id' => "user_".($this->_tpl_vars['someUser']['UserGroup']['ID'])."_".($this->_tpl_vars['someUser']['ID'])."_password",'class' => 'user_password'), $this);?>

			<a href="#generate" class="user_password_generate"><?php echo smarty_function_translate(array('text' => '_generate_password'), $this);?>
</a>
			<fieldset class="error showPassword">
				<input type="checkbox" id="user_<?php echo $this->_tpl_vars['someUser']['UserGroup']['ID']; ?>
_<?php echo $this->_tpl_vars['someUser']['ID']; ?>
_password_show" class="checkbox user_password_show"/>
				<label for="user_<?php echo $this->_tpl_vars['someUser']['UserGroup']['ID']; ?>
_<?php echo $this->_tpl_vars['someUser']['ID']; ?>
_password_show" class="checkbox"><?php echo smarty_function_translate(array('text' => '_show_password'), $this);?>
</label>
			</fieldset >
			<div class="errorText" style="display: none" ></span>
		</fieldset>
	</p>

	<p class="sameAddress">
		<?php echo smarty_function_checkbox(array('name' => 'sameAddresses','id' => "user_".($this->_tpl_vars['someUser']['UserGroup']['ID'])."_".($this->_tpl_vars['someUser']['ID'])."_sameAddresses",'class' => 'checkbox'), $this);?>

		<label for="user_<?php echo $this->_tpl_vars['someUser']['UserGroup']['ID']; ?>
_<?php echo $this->_tpl_vars['someUser']['ID']; ?>
_sameAddresses" class="checkbox"><?php echo smarty_function_translate(array('text' => "_same_billing_and_shipping_addresses?"), $this);?>
</label>
	</p>

	<br class="clear" />

	<fieldset id="user_<?php echo $this->_tpl_vars['someUser']['UserGroup']['ID']; ?>
_<?php echo $this->_tpl_vars['someUser']['ID']; ?>
_billingAddress" class="user_billingAddress">
		<legend><?php echo smarty_function_translate(array('text' => '_billing_address'), $this);?>
</legend>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "backend/user/address_edit.tpl", 'smarty_include_vars' => array('namePrefix' => 'billingAddress_','eavPrefix' => 'billingAddress_','idPrefix' => "user_".($this->_tpl_vars['someUser']['UserGroup']['ID'])."_".($this->_tpl_vars['someUser']['ID'])."_billingAddress",'address' => $this->_tpl_vars['someUser']['defaultBillingAddress'],'states' => $this->_tpl_vars['billingAddressStates'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</fieldset>

	<fieldset id="user_<?php echo $this->_tpl_vars['someUser']['UserGroup']['ID']; ?>
_<?php echo $this->_tpl_vars['someUser']['ID']; ?>
_shippingAddress" class="user_shippingAddress">
		<legend><?php echo smarty_function_translate(array('text' => '_shipping_address'), $this);?>
</legend>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "backend/user/address_edit.tpl", 'smarty_include_vars' => array('namePrefix' => 'shippingAddress_','eavPrefix' => 'shippingAddress_','idPrefix' => "user_".($this->_tpl_vars['someUser']['UserGroup']['ID'])."_".($this->_tpl_vars['someUser']['ID'])."_shippingAddress",'address' => $this->_tpl_vars['someUser']['defaultShippingAddress'],'states' => $this->_tpl_vars['shippingAddressStates'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</fieldset>


	<fieldset class="controls">
		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" name="save" class="submit" value="<?php echo smarty_function_translate(array('text' => '_save'), $this);?>
" id="user_<?php echo $this->_tpl_vars['someUser']['UserGroup']['ID']; ?>
_<?php echo $this->_tpl_vars['someUser']['ID']; ?>
_submit">
		<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

		<a class="cancel" href="#"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
	</fieldset>

	<script type="text/javascript">
		<?php echo '
		if('; ?>
<?php echo $this->_tpl_vars['someUser']['ID']; ?>
<?php echo ' > 0)
		{
			Backend.UserGroup.prototype.treeBrowser.selectItem('; ?>
<?php echo ((is_array($_tmp=@$this->_tpl_vars['someUser']['UserGroup']['ID'])) ? $this->_run_mod_handler('default', true, $_tmp, -1) : smarty_modifier_default($_tmp, -1)); ?>
<?php echo ', false);
			Backend.User.Editor.prototype.getInstance('; ?>
<?php echo $this->_tpl_vars['someUser']['ID']; ?>
<?php echo ');
		}
		else
		{
//				Backend.User.Add.prototype.getInstance('; ?>
<?php echo $this->_tpl_vars['someUser']['UserGroup']['ID']; ?>
<?php echo ');
		}
		'; ?>

	</script>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>