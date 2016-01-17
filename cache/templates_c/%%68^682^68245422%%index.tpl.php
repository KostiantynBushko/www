<?php /* Smarty version 2.6.26, created on 2015-12-02 13:11:46
         compiled from /home/illumin/public_html/application/view///backend/userGroup/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeJs', '/home/illumin/public_html/application/view///backend/userGroup/index.tpl', 1, false),array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/userGroup/index.tpl', 12, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/userGroup/index.tpl', 30, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/userGroup/index.tpl', 68, false),array('function', 'json', '/home/illumin/public_html/application/view///backend/userGroup/index.tpl', 85, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/userGroup/index.tpl', 30, false),array('block', 'denied', '/home/illumin/public_html/application/view///backend/userGroup/index.tpl', 41, false),array('block', 'allowed', '/home/illumin/public_html/application/view///backend/userGroup/index.tpl', 57, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/userGroup/index.tpl', 69, false),)), $this); ?>
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


<?php echo smarty_function_includeCss(array('file' => "library/dhtmlxtree/dhtmlXTree.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/TabControl.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/ActiveList.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/ActiveGrid.css"), $this);?>


<?php echo smarty_function_includeCss(array('file' => "backend/CustomerOrder.css"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/CustomerOrder.js"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "backend/User.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/User.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "backend/Roles.js"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "library/ActiveList.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/ActiveGrid.css"), $this);?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->_tag_stack[] = array('pageTitle', array('help' => 'userGroups')); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_livecart_users'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
	Backend.UserGroup.userGroups = <?php echo $this->_tpl_vars['userGroups']; ?>
;
</script>

<div id="userGroupsWrapper" class="maxHeight h--50">
	<div id="userGroupsBrowserWithControlls" class="treeContainer maxHeight">
		<div id="userGroupsBrowser" class="treeBrowser"></div>
		<ul id="userGroupsBrowserControls" class="verticalMenu">
			<li class="addTreeNode" <?php $this->_tag_stack[] = array('denied', array('role' => "userGroup.create")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none;"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>><a id="userGroups_add" href="#add"><?php echo smarty_function_translate(array('text' => '_add_group'), $this);?>
</a></li>
			<li class="removeTreeNode" <?php $this->_tag_stack[] = array('denied', array('role' => "userGroup.remove")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none;"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>><a id="userGroups_delete" href="#delete"><?php echo smarty_function_translate(array('text' => '_delete_group'), $this);?>
</a></li>
		</ul>
	</div>

	<span id="fromUsersPage">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/customerOrder/orderContainer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/userGroup/groupContainer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/userGroup/userContainer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</span>

<?php echo '
<script type="text/javascript">
	window.ordersActiveGrid = {};
	Backend.showContainer("userGroupsManagerContainer");
	'; ?>

		<?php $this->_tag_stack[] = array('allowed', array('role' => 'order')); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			Backend.CustomerOrder.prototype.ordersMiscPermission = true;
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php echo '

	Backend.UserGroup.prototype.Messages.confirmUserDelete = \''; ?>
<?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_to_delete_this_user'), $this);?>
<?php echo '\';
	Backend.UserGroup.prototype.Messages.confirmUserGroupRemove = \''; ?>
<?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_to_delete_this_user_group'), $this);?>
<?php echo '\';
	Backend.UserGroup.prototype.Messages.defaultUserName = \''; ?>
<?php echo smarty_function_translate(array('text' => '_default_user'), $this);?>
<?php echo '\';
	Backend.UserGroup.prototype.Messages.youCanntoDeleteThisGroup = \''; ?>
<?php echo smarty_function_translate(array('text' => '_you_cannot_delete_this_group'), $this);?>
<?php echo '\';
	Backend.User.Group.prototype.Messages.savedMessage = \''; ?>
<?php echo smarty_function_translate(array('text' => '_form_has_been_successfully_saved'), $this);?>
<?php echo '\';

	Backend.CustomerOrder.Links.selectCustomer = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'selectCustomer'), $this);?>
<?php echo '\';
	Backend.CustomerOrder.Editor.prototype.Messages.orderNum = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_order_number'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__order_number', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__order_number'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo '\';
	Backend.CustomerOrder.Messages.selecCustomerTitle = \''; ?>
<?php echo smarty_function_translate(array('text' => '_select_customer_title'), $this);?>
<?php echo '\';
	Backend.CustomerOrder.Links.createOrder = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'create'), $this);?>
<?php echo '\';

	Backend.User.Group.prototype.Links.save = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.userGroup",'action' => 'save'), $this);?>
<?php echo '\';
	Backend.User.Group.prototype.Links.remove = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.userGroup",'action' => 'delete'), $this);?>
<?php echo '\';
	Backend.User.Group.prototype.Links.createNewUserGroup = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.userGroup",'action' => 'create'), $this);?>
<?php echo '\';
	Backend.User.Group.prototype.Links.removeNewGroup = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.userGroup",'action' => 'remove'), $this);?>
<?php echo '\';
	Backend.User.Group.prototype.Links.create = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.userGroup",'action' => 'create'), $this);?>
<?php echo '\';

	Backend.User.Editor.prototype.Links.create = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.user",'action' => 'create'), $this);?>
<?php echo '\';
	Backend.User.Editor.prototype.Links.update = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.user",'action' => 'update'), $this);?>
<?php echo '\';
	Backend.User.Editor.prototype.Links.generatePassword = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.user",'action' => 'generatePassword'), $this);?>
<?php echo '\';

	Backend.UserGroup.prototype.usersMiscPermision = '; ?>
<?php $this->_tag_stack[] = array('allowed', array('role' => 'user')); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>true<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php $this->_tag_stack[] = array('denied', array('role' => 'user')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>false<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo ';

	var users = new Backend.UserGroup('; ?>
<?php echo smarty_function_json(array('array' => $this->_tpl_vars['userGroups']), $this);?>
<?php echo ');
	window.ordersActiveGrid = {};
	window.usersActiveGrid = {};
</script>
'; ?>



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>