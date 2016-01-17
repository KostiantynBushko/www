<?php /* Smarty version 2.6.26, created on 2015-12-11 14:39:31
         compiled from backend/user/address_view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'backend/user/address_view.tpl', 7, false),)), $this); ?>
<p><label class="addressFullName"><?php echo $this->_tpl_vars['address']['fullName']; ?>
</label></p>

<p><label class="addressCompanyName"><?php echo $this->_tpl_vars['address']['companyName']; ?>
</label></p>

<p><label class="addressCountryName"><?php echo $this->_tpl_vars['address']['countryName']; ?>
</label></p>

<p><label class="addressStateName"><?php echo ((is_array($_tmp=@$this->_tpl_vars['address']['State']['name'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['address']['stateName']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['address']['stateName'])); ?>
</label></p>

<p><label class="addressCity"><?php echo $this->_tpl_vars['address']['city']; ?>
</label></p>

<p><label class="addressAddress1"><?php echo $this->_tpl_vars['address']['address1']; ?>
</label></p>

<p><label class="addressAddress2"><?php echo $this->_tpl_vars['address']['address2']; ?>
</label></p>

<p><label class="addressPostalCode"><?php echo $this->_tpl_vars['address']['postalCode']; ?>
</label></p>

<p><label class="addressPhone"><?php echo $this->_tpl_vars['address']['phone']; ?>
</label></p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/view.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['address'],'format' => 'row')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>