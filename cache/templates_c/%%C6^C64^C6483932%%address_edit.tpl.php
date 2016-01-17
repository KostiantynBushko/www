<?php /* Smarty version 2.6.26, created on 2015-12-11 14:39:31
         compiled from custom:backend/user/address_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'hidden', 'custom:backend/user/address_edit.tpl', 1, false),array('function', 'translate', 'custom:backend/user/address_edit.tpl', 5, false),array('function', 'textfield', 'custom:backend/user/address_edit.tpl', 6, false),array('function', 'selectfield', 'custom:backend/user/address_edit.tpl', 25, false),array('function', 'link', 'custom:backend/user/address_edit.tpl', 71, false),)), $this); ?>
<?php echo smarty_function_hidden(array('name' => ($this->_tpl_vars['namePrefix'])."ID"), $this);?>


<?php if (! $this->_tpl_vars['hideName']): ?>
<fieldset class="error">
	<label for="<?php echo $this->_tpl_vars['idPrefix']; ?>
_firstName"><?php echo smarty_function_translate(array('text' => '_first_name'), $this);?>
</label>
	<?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['namePrefix'])."firstName",'id' => ($this->_tpl_vars['idPrefix'])."_firstName",'class' => 'text'), $this);?>

	<div class="errorText" style="display: none" ></div>
</fieldset>

<fieldset class="error">
	<label for="<?php echo $this->_tpl_vars['idPrefix']; ?>
_lastName"><?php echo smarty_function_translate(array('text' => '_last_name'), $this);?>
</label>
	<?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['namePrefix'])."lastName",'id' => ($this->_tpl_vars['idPrefix'])."_lastName",'class' => 'text'), $this);?>

	<div class="errorText" style="display: none" ></div>
</fieldset>

<fieldset class="error">
	<label for="<?php echo $this->_tpl_vars['idPrefix']; ?>
_companyName"><?php echo smarty_function_translate(array('text' => '_company'), $this);?>
</label>
	<?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['namePrefix'])."companyName",'id' => ($this->_tpl_vars['idPrefix'])."_companyName",'class' => 'text'), $this);?>

	<div class="errorText" style="display: none" ></div>
</fieldset>
<?php endif; ?>

<fieldset class="error">
	<label for="<?php echo $this->_tpl_vars['idPrefix']; ?>
_countryID"><?php echo smarty_function_translate(array('text' => '_country'), $this);?>
</label>
	<?php echo smarty_function_selectfield(array('name' => ($this->_tpl_vars['namePrefix'])."countryID",'options' => $this->_tpl_vars['countries'],'id' => ($this->_tpl_vars['idPrefix'])."_countryID",'class' => 'country'), $this);?>

	<div class="errorText" style="display: none" ></div>
</fieldset>

<fieldset class="error">
	<label for="<?php echo $this->_tpl_vars['idPrefix']; ?>
_stateID"><?php echo smarty_function_translate(array('text' => '_state'), $this);?>
</label>
	<?php echo smarty_function_selectfield(array('name' => ($this->_tpl_vars['namePrefix'])."stateID",'options' => $this->_tpl_vars['states'],'id' => ($this->_tpl_vars['idPrefix'])."_stateID",'class' => 'state'), $this);?>

	<?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['namePrefix'])."stateName",'id' => ($this->_tpl_vars['idPrefix'])."_stateName",'class' => 'text'), $this);?>

</fieldset>

<fieldset class="error">
	<label for="<?php echo $this->_tpl_vars['idPrefix']; ?>
_city"><?php echo smarty_function_translate(array('text' => '_city'), $this);?>
</label>
	<?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['namePrefix'])."city",'id' => ($this->_tpl_vars['idPrefix'])."_city",'class' => 'text'), $this);?>

	<div class="errorText" style="display: none" ></div>
</fieldset>

<fieldset class="error">
	<label for="<?php echo $this->_tpl_vars['idPrefix']; ?>
_address1"><?php echo smarty_function_translate(array('text' => '_address'), $this);?>
 1</label>
	<?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['namePrefix'])."address1",'id' => ($this->_tpl_vars['idPrefix'])."_address1",'class' => 'text'), $this);?>

	<div class="errorText" style="display: none" ></div>
</fieldset>

<fieldset class="error">
	<label for="<?php echo $this->_tpl_vars['idPrefix']; ?>
_address2"><?php echo smarty_function_translate(array('text' => '_address'), $this);?>
 2</label>
	<?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['namePrefix'])."address2",'id' => ($this->_tpl_vars['idPrefix'])."_address2",'class' => 'text'), $this);?>

	<div class="errorText" style="display: none" ></div>
</fieldset>

<fieldset class="error">
	<label for="<?php echo $this->_tpl_vars['idPrefix']; ?>
_postalCode"><?php echo smarty_function_translate(array('text' => '_postal_code'), $this);?>
</label>
	<?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['namePrefix'])."postalCode",'id' => ($this->_tpl_vars['idPrefix'])."_postalCode",'class' => 'text'), $this);?>

	<div class="errorText" style="display: none" ></div>
</fieldset>

<fieldset class="error">
	<label for="<?php echo $this->_tpl_vars['idPrefix']; ?>
_phone"><?php echo smarty_function_translate(array('text' => '_phone'), $this);?>
</label>
	<?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['namePrefix'])."phone",'id' => ($this->_tpl_vars['idPrefix'])."_phone",'class' => 'text'), $this);?>

</fieldset>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:block/eav/fields.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['address'],'fieldList' => $this->_tpl_vars['specFieldListByOwner']['UserAddress'][$this->_tpl_vars['address']['ID']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
$('<?php echo $this->_tpl_vars['idPrefix']; ?>
_stateID').stateSwitcher = new Backend.User.StateSwitcher(
		$('<?php echo $this->_tpl_vars['idPrefix']; ?>
_countryID'),
		$('<?php echo $this->_tpl_vars['idPrefix']; ?>
_stateID'),
		$('<?php echo $this->_tpl_vars['idPrefix']; ?>
_stateName'),
		'<?php echo smarty_function_link(array('controller' => "backend.user",'action' => 'states'), $this);?>
'
	);
</script>