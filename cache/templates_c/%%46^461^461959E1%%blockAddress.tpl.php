<?php /* Smarty version 2.6.26, created on 2015-12-11 06:43:36
         compiled from custom:email/blockAddress.tpl */ ?>
<?php if ($this->_tpl_vars['address']): ?>
<?php echo $this->_tpl_vars['address']['fullName']; ?>

<?php if ($this->_tpl_vars['address']['companyName']): ?>
<?php echo $this->_tpl_vars['address']['companyName']; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['address']['address1']): ?>
<?php echo $this->_tpl_vars['address']['address1']; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['address']['address2']): ?>
<?php echo $this->_tpl_vars['address']['address2']; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['address']['city']): ?>
<?php echo $this->_tpl_vars['address']['city']; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['address']['stateName']): ?><?php echo $this->_tpl_vars['address']['stateName']; ?>
<?php if ($this->_tpl_vars['address']['postalCode']): ?>, <?php endif; ?><?php endif; ?><?php echo $this->_tpl_vars['address']['postalCode']; ?>

<?php if ($this->_tpl_vars['address']['countryName']): ?>
<?php echo $this->_tpl_vars['address']['countryName']; ?>

<?php endif; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/addressFieldValues.tpl", 'smarty_include_vars' => array('showLabels' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>