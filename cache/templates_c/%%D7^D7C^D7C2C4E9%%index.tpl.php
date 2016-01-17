<?php /* Smarty version 2.6.26, created on 2015-12-11 14:39:30
         compiled from /home/illumin/public_html/application/view///backend/customerOrder/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeJs', '/home/illumin/public_html/application/view///backend/customerOrder/index.tpl', 1, false),array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/customerOrder/index.tpl', 14, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/customerOrder/index.tpl', 46, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/customerOrder/index.tpl', 60, false),array('function', 'json', '/home/illumin/public_html/application/view///backend/customerOrder/index.tpl', 70, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/customerOrder/index.tpl', 46, false),array('block', 'allowed', '/home/illumin/public_html/application/view///backend/customerOrder/index.tpl', 73, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/customerOrder/index.tpl', 65, false),)), $this); ?>
<?php echo smarty_function_includeJs(array('file' => "library/dhtmlxtree/dhtmlXCommon.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlxtree/dhtmlXTree.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlxtree/dhtmlXTree_start.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/rico/ricobase.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/rico/ricoLiveGrid.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/Validator.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/ActiveForm.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/State.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/ActiveGrid.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/TabControl.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/SectionExpander.js"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "library/lightbox/lightbox.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/lightbox/lightbox.css"), $this);?>


<?php echo smarty_function_includeCss(array('file' => "library/dhtmlxtree/dhtmlXTree.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/TabControl.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/ActiveList.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "library/ActiveList.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/ActiveGrid.css"), $this);?>


<?php echo smarty_function_includeCss(array('file' => "backend/Backend.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "backend/Shipment.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/Shipment.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "backend/User.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/User.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "backend/Payment.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/Payment.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "backend/OrderNote.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/OrderNote.css"), $this);?>


<?php echo smarty_function_includeCss(array('file' => "backend/OrderLog.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "backend/CustomerOrder.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/CustomerOrder.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "frontend/Frontend.js"), $this);?>
 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->_tag_stack[] = array('pageTitle', array('help' => 'order')); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_livecart_orders'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="orderGroupsWrapper" class="treeContainer maxHeight h--50">
	<div id="orderGroupsBrowser" class="treeBrowser"></div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/customerOrder/orderContainer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/customerOrder/groupContainer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/userGroup/userContainer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<?php echo '
<script type="text/javascript">
	Backend.CustomerOrder.Editor.prototype.Links.switchCancelled = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'switchCancelled'), $this);?>
<?php echo '\';

	Backend.CustomerOrder.Links.selectCustomer = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'selectCustomer'), $this);?>
<?php echo '\';
	Backend.CustomerOrder.Links.createOrder = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'create'), $this);?>
<?php echo '\';
	Backend.CustomerOrder.Messages.selecCustomerTitle = \''; ?>
<?php echo smarty_function_translate(array('text' => '_select_customer_title'), $this);?>
<?php echo '\';
	Backend.CustomerOrder.Messages.areYouSureYouWantToUpdateOrderStatus = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_to_update_order_status'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_sure_you_want_to_update_order_status', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_sure_you_want_to_update_order_status'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo '\';

	Backend.CustomerOrder.Editor.prototype.Messages.areYouSureYouWantToActivateThisOrder = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_activate_this_order'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_sure_you_want_activate_this_order', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_sure_you_want_activate_this_order'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo '\';
	Backend.CustomerOrder.Editor.prototype.Messages.areYouSureYouWantToCancelThisOrder = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_cancel_this_order'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_sure_you_want_cancel_this_order', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_sure_you_want_cancel_this_order'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo '\';
	Backend.CustomerOrder.Editor.prototype.Messages.orderNum = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_order_number'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__order_number', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__order_number'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo '\';
	new Backend.CustomerOrder('; ?>
<?php echo smarty_function_json(array('array' => $this->_tpl_vars['orderGroups']), $this);?>
<?php echo ');

	'; ?>

		<?php $this->_tag_stack[] = array('allowed', array('role' => 'order')); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			Backend.CustomerOrder.prototype.ordersMiscPermission = true;
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

		<?php $this->_tag_stack[] = array('allowed', array('role' => 'user')); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			Backend.CustomerOrder.prototype.usersMiscPermission = true;
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php echo '
	Backend.showContainer("orderGroupsManagerContainer");
	window.ordersActiveGrid = {};
</script>
'; ?>



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>