<?php /* Smarty version 2.6.26, created on 2015-12-03 18:16:34
         compiled from custom:backend/discount/gridCount.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/discount/gridCount.tpl', 3, false),)), $this); ?>
<span class="activeGridItemsCount">
	<span id="userCount_<?php echo $this->_tpl_vars['userGroupID']; ?>
">
		<span class="rangeCount" style="display: none;"><?php echo smarty_function_translate(array('text' => '_listing_rules'), $this);?>
</span>
		<span class="notFound" style="display: none;"><?php echo smarty_function_translate(array('text' => '_no_rules'), $this);?>
</span>
	</span>
</span>