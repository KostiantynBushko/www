<?php /* Smarty version 2.6.26, created on 2015-12-02 13:11:46
         compiled from custom:backend/userGroup/userContainer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/userGroup/userContainer.tpl', 5, false),array('function', 'link', 'custom:backend/userGroup/userContainer.tpl', 12, false),array('function', 'renderBlock', 'custom:backend/userGroup/userContainer.tpl', 19, false),)), $this); ?>
<div id="userManagerContainer" class="treeManagerContainer" style="display: none;">
	<fieldset class="container">
		<ul class="menu">
			<li class="done"><a href="#cancelEditing" id="cancel_user_edit" class="cancel"><?php echo smarty_function_translate(array('text' => '_cancel_editing_user_info'), $this);?>
</a></li>
		</ul>
	</fieldset>

	<div class="tabContainer">
		<ul class="tabList tabs">
			<li id="tabUserInfo" class="tab active">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.user",'action' => 'info','id' => '_id_'), $this);?>
"}"><?php echo smarty_function_translate(array('text' => '_user_info'), $this);?>
</a>
				<span class="tabHelp">users.edit</span>
			</li>
			<li id="tabOrdersList" class="tab">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'orders','id' => 1,'query' => 'userID=_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_orders'), $this);?>
</a>
				<span class="tabHelp">customerOrders.orders</span>
			</li>
			<?php echo smarty_function_renderBlock(array('block' => 'USER_TABS'), $this);?>

		</ul>
	</div>
	<div class="sectionContainer maxHeight h--50"></div>

	<?php echo '
	<script type="text/javascript">
		Event.observe($("cancel_user_edit"), "click", function(e) {
			Event.stop(e);
			var user = Backend.User.Editor.prototype.getInstance(Backend.User.Editor.prototype.getCurrentId(), false);
			user.cancelForm();
		});
	</script>
	'; ?>

</div>