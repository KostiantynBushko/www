<?php /* Smarty version 2.6.26, created on 2015-12-02 13:11:46
         compiled from custom:backend/userGroup/groupContainer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/userGroup/groupContainer.tpl', 4, false),array('function', 'link', 'custom:backend/userGroup/groupContainer.tpl', 9, false),)), $this); ?>
<div id="userGroupsManagerContainer" class="treeManagerContainer maxHeight">   
	<div id="loadingUser" style="display: none;">
		<span id="loadingUserMsg"><?php echo smarty_function_translate(array('text' => '_loading_user'), $this);?>
<span class="progressIndicator"></span></span>
	</div>
	<div class="tabContainer">
		<ul class="tabList tabs">
			<li id="tabUsers" class="tab inactive">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.userGroup",'action' => 'users'), $this);?>
?id=_id_"><?php echo smarty_function_translate(array('text' => '_group_users'), $this);?>
</a>
				<span class="tabHelp">users</span>
			</li>
			
			<li id="tabUserGroup" class="tab active">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.userGroup",'action' => 'edit'), $this);?>
?id=_id_"><?php echo smarty_function_translate(array('text' => '_group_info'), $this);?>
</a>
				<span class="tabHelp">users</span>
			</li>
			
			<li id="tabRoles" class="tab inactive">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.roles",'action' => 'index'), $this);?>
?id=_id_"><?php echo smarty_function_translate(array('text' => '_group_permissions'), $this);?>
</a>
				<span class="tabHelp">users</span>
			</li>
		</ul>
	</div>
	<div class="sectionContainer maxHeight h--50"></div>
</div>