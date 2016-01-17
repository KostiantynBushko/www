<?php /* Smarty version 2.6.26, created on 2015-12-02 13:11:48
         compiled from /home/illumin/public_html/application/view///backend/userGroup/users.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'denied', '/home/illumin/public_html/application/view///backend/userGroup/users.tpl', 3, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/userGroup/users.tpl', 6, false),array('function', 'backendUserUrl', '/home/illumin/public_html/application/view///backend/userGroup/users.tpl', 43, false),array('function', 'activeGrid', '/home/illumin/public_html/application/view///backend/userGroup/users.tpl', 47, false),array('modifier', 'capitalize', '/home/illumin/public_html/application/view///backend/userGroup/users.tpl', 21, false),array('modifier', 'addslashes', '/home/illumin/public_html/application/view///backend/userGroup/users.tpl', 66, false),)), $this); ?>
<div>

<fieldset class="container" <?php $this->_tag_stack[] = array('denied', array('role' => "user.create")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none;"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
	<ul id="userGroup_<?php echo $this->_tpl_vars['userGroupID']; ?>
_addUser_menu" class="menu">
		<li class="addUser">
			<a id="userGroup_<?php echo $this->_tpl_vars['userGroupID']; ?>
_addUser" href="#addUser"><?php echo smarty_function_translate(array('text' => '_add_new_user'), $this);?>
</a>
			<span class="progressIndicator" style="display: none;"></span>
		</li>
		<li class="done addUserCancel">
			<a id="userGroup_<?php echo $this->_tpl_vars['userGroupID']; ?>
_addUserCancel" href="#cancelAddingUser" class="hidden"><?php echo smarty_function_translate(array('text' => '_cancel_adding_new_user'), $this);?>
 </a>
		</li>
	</ul>

	<div id="newUserForm_<?php echo $this->_tpl_vars['userGroupID']; ?>
" style="display: none;">
		<ul class="menu" style="margin-left: 270px;">
			<li class="done">
				<a class="cancel" href="#"><?php echo smarty_function_translate(array('text' => '_cancel_adding_new_user'), $this);?>
</a>
			</li>
		</ul>
		<fieldset  class="addForm treeManagerContainer newUserForm">
			<legend><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_add_new_user'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__add_new_user', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__add_new_user'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</legend>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/user/info.tpl", 'smarty_include_vars' => array('someUser' => $this->_tpl_vars['newUser'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</fieldset>
	</div>

	<script type="text/javascript">
		$("fromUsersPage").appendChild($("newUserForm_<?php echo $this->_tpl_vars['userGroupID']; ?>
"))
	</script>

	<?php echo '
	<script type="text/javascript">
		Element.observe($("'; ?>
userGroup_<?php echo $this->_tpl_vars['userGroupID']; ?>
_addUser<?php echo '"), \'click\', function(e)
		{
			Event.stop(e);
			Backend.User.Add.prototype.getInstance('; ?>
<?php echo $this->_tpl_vars['userGroupID']; ?>
<?php echo ').showAddForm('; ?>
<?php echo $this->_tpl_vars['userGroupID']; ?>
<?php echo ');
		});
	</script>
	'; ?>

</fieldset>

<?php echo '
<script type="text/javascript">
	Backend.UserGroup.GridFormatter.userUrl = \''; ?>
<?php echo smarty_function_backendUserUrl(array(), $this);?>
<?php echo '\';
</script>
'; ?>


<?php echo smarty_function_activeGrid(array('prefix' => 'users','id' => $this->_tpl_vars['userGroupID'],'role' => "user.mass",'controller' => "backend.userGroup",'action' => 'lists','displayedColumns' => $this->_tpl_vars['displayedColumns'],'availableColumns' => $this->_tpl_vars['availableColumns'],'totalCount' => $this->_tpl_vars['totalCount'],'container' => 'tabPageContainer','dataFormatter' => "Backend.UserGroup.GridFormatter",'count' => "backend/userGroup/count.tpl",'massAction' => "backend/userGroup/massAction.tpl",'advancedSearch' => true), $this);?>


</div>

<?php echo '
<script type="text/javascript">
	var massHandler = new Backend.UserGroup.massActionHandler($(\''; ?>
userMass_<?php echo $this->_tpl_vars['userGroupID']; ?>
<?php echo '\'), window.activeGrids[\''; ?>
users_<?php echo $this->_tpl_vars['userGroupID']; ?>
<?php echo '\']);
	massHandler.deleteConfirmMessage = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_to_delete_this_user'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_sure_you_want_to_delete_this_user', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_sure_you_want_to_delete_this_user'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\' ;
	massHandler.nothingSelectedMessage = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_nothing_selected'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__nothing_selected', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__nothing_selected'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\' ;

	usersActiveGrid['; ?>
<?php echo $this->_tpl_vars['userGroupID']; ?>
<?php echo '] = window.activeGrids[\''; ?>
users_<?php echo $this->_tpl_vars['userGroupID']; ?>
<?php echo '\'];
</script>
'; ?>