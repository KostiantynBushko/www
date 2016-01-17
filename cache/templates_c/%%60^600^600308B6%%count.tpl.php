<?php /* Smarty version 2.6.26, created on 2015-12-02 13:11:48
         compiled from custom:backend/userGroup/count.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/userGroup/count.tpl', 3, false),)), $this); ?>
<span class="activeGridItemsCount">
	<span id="userCount_<?php echo $this->_tpl_vars['userGroupID']; ?>
">
		<span class="rangeCount" style="display: none;"><?php echo smarty_function_translate(array('text' => '_listing_users'), $this);?>
</span>
		<span class="notFound" style="display: none;"><?php echo smarty_function_translate(array('text' => '_no_users'), $this);?>
</span>
	</span>
</span>