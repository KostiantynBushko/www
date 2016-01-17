<?php /* Smarty version 2.6.26, created on 2015-12-15 11:46:08
         compiled from custom:backend/customerOrder/block/shippingLabel.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'custom:backend/customerOrder/block/shippingLabel.tpl', 36, false),)), $this); ?>
<div style="padding: 3em; border: none;">
	
		<div class="labelCompany" style="font-size: 90%">
			Illuminata Eyewear<br>
			1750 The Queensway<br>
			Unit 4<br>
			Etobicoke, ON<br>
			M9C 5H5<br>
			Canada

		</div>
		<br><br>
	
<div style="font-size: 120%; font-weight: bold; margin-left: 250px;">
	To:<br>
	<?php if ($this->_tpl_vars['address']['fullName']): ?>
		<div class="labelName">
			<?php echo $this->_tpl_vars['address']['fullName']; ?>

		</div>
	<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['address']['companyName']; ?>

</div>
	<div class="labelAddress1">
		<?php echo $this->_tpl_vars['address']['address1']; ?>

	</div>
	<div class="labelAddress2">
		<?php echo $this->_tpl_vars['address']['address2']; ?>

	</div>

	<div class="labelCity">
		<?php echo $this->_tpl_vars['address']['city']; ?>

	</div>

	<div class="labelState">
		<?php echo ((is_array($_tmp=@$this->_tpl_vars['address']['stateName'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['address']['State']['name']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['address']['State']['name'])); ?>
<?php if ($this->_tpl_vars['address']['postalCode']): ?>, <?php echo $this->_tpl_vars['address']['postalCode']; ?>
<?php endif; ?>
	</div>

	<div class="labelCountry">
		<?php echo $this->_tpl_vars['address']['countryName']; ?>

	</div>
	<div style="font-size: 150%; font-weight: bold; margin-top: 40px; margin-left: -50px;">
	DO NOT DROP AT DOOR
	</div>
</div>



</div>