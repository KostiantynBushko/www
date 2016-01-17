<?php /* Smarty version 2.6.26, created on 2015-12-11 14:39:31
         compiled from backend/customerOrder/address.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'backend/customerOrder/address.tpl', 5, false),array('function', 'selectfield', 'backend/customerOrder/address.tpl', 6, false),array('block', 'denied', 'backend/customerOrder/address.tpl', 27, false),)), $this); ?>
<fieldset id="<?php echo $this->_tpl_vars['type']; ?>
_edit" class="orderAddress_edit error" style="display: none">
	<input name="orderID" type="hidden" value="<?php echo $this->_tpl_vars['order']['ID']; ?>
" />

	<fieldset class="error">
		<label for="<?php echo $this->_tpl_vars['type']; ?>
_existingAddress_select"><?php echo smarty_function_translate(array('text' => '_use_existing_address'), $this);?>
</label>
		<?php echo smarty_function_selectfield(array('options' => $this->_tpl_vars['existingUserAddressOptions'],'id' => ($this->_tpl_vars['type'])."_existingAddress_select",'name' => 'existingUserAddress'), $this);?>

	</fieldset>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/user/address_edit.tpl", 'smarty_include_vars' => array('idPrefix' => $this->_tpl_vars['type'],'states' => $this->_tpl_vars['states'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<fieldset class="controls">
		<span style="display: none;" class="progressIndicator"></span>

		<input type="submit" class="button submit" value="<?php echo smarty_function_translate(array('text' => '_save'), $this);?>
" />
		<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

		<a href="#cancel" class="cancel"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
	</fieldset>
</fieldset>

<fieldset id="<?php echo $this->_tpl_vars['type']; ?>
_view" class="container orderAddress_view">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "backend/user/address_view.tpl", 'smarty_include_vars' => array('idPrefix' => $this->_tpl_vars['type'],'address' => $this->_tpl_vars['address'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</fieldset>


<ul class="menu orderAddress_showEdit">
	<li class="order_editAddress">
		<a href="#edit" <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> ><?php echo smarty_function_translate(array('text' => '_edit'), $this);?>
</a>
	</li>
	<li class="done order_cancelEditAddress" style="display: none;">
		<a href="#cancel"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
	</li>
</ul>
<div class="clear"></div>