<?php /* Smarty version 2.6.26, created on 2015-12-01 12:14:49
         compiled from custom:backend/newsletter/count.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/newsletter/count.tpl', 3, false),)), $this); ?>
<span class="activeGridItemsCount">
	<span id="newsletterCount_0">
		<span class="rangeCount"><?php echo smarty_function_translate(array('text' => '_listing_messages'), $this);?>
</span>
		<span class="notFound"><?php echo smarty_function_translate(array('text' => '_no_messages_found'), $this);?>
</span>
	</span>
</span>