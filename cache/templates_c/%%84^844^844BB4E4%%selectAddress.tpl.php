<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from custom:checkout/block/selectAddress.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucfirst', 'custom:checkout/block/selectAddress.tpl', 1, false),array('function', 'radio', 'custom:checkout/block/selectAddress.tpl', 11, false),array('function', 'link', 'custom:checkout/block/selectAddress.tpl', 15, false),array('function', 'translate', 'custom:checkout/block/selectAddress.tpl', 15, false),)), $this); ?>
<?php $this->assign('actionPrefix', ucfirst($this->_tpl_vars['prefix'])); ?>
<?php if (! $this->_tpl_vars['addresses']): ?>
	<div id="<?php echo $this->_tpl_vars['prefix']; ?>
AddressForm">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/addressForm.tpl", 'smarty_include_vars' => array('prefix' => ($this->_tpl_vars['prefix'])."_",'states' => $this->_tpl_vars['states'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
<?php else: ?>
	<table class="addressSelector">
		<?php $_from = $this->_tpl_vars['addresses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<tr>
				<td class="selector">
					<?php echo smarty_function_radio(array('class' => 'radio','name' => ($this->_tpl_vars['prefix'])."Address",'id' => ($this->_tpl_vars['prefix'])."_".($this->_tpl_vars['item']['UserAddress']['ID']),'value' => $this->_tpl_vars['item']['UserAddress']['ID']), $this);?>

				</td>
				<td class="address" onclick="var el = $('<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['item']['UserAddress']['ID']; ?>
'); el.checked = true; el.form.onchange(); sendEvent(el, 'click'); sendEvent(el, 'change'); ">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/address.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<a href="<?php echo smarty_function_link(array('controller' => 'user','action' => "edit".($this->_tpl_vars['actionPrefix'])."Address",'id' => $this->_tpl_vars['item']['ID'],'returnPath' => true), $this);?>
"><?php echo smarty_function_translate(array('text' => '_edit_address'), $this);?>
</a>
				</td>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
		<tr>
			<td class="selector addAddress">
				<?php echo smarty_function_radio(array('class' => 'radio','name' => ($this->_tpl_vars['prefix'])."Address",'id' => ($this->_tpl_vars['prefix'])."_new",'value' => ""), $this);?>

			</td>
			<td class="address addAddress">
				<label for="<?php echo $this->_tpl_vars['prefix']; ?>
_new" class="radio"><?php echo smarty_function_translate(array('text' => "_new_".($this->_tpl_vars['prefix'])."_address"), $this);?>
</label>
				<div class="address">
					<div class="addressBlock">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/addressForm.tpl", 'smarty_include_vars' => array('prefix' => ($this->_tpl_vars['prefix'])."_",'states' => $this->_tpl_vars['states'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</div>
			</td>
		</tr>
	</table>
<?php endif; ?>