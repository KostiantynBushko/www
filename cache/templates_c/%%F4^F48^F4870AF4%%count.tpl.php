<?php /* Smarty version 2.6.26, created on 2015-12-01 12:14:53
         compiled from custom:backend/newsletterSubscriber/count.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/newsletterSubscriber/count.tpl', 3, false),)), $this); ?>
<span class="activeGridItemsCount">
	<span id="newsletterCount_0">
		<span class="rangeCount"><?php echo smarty_function_translate(array('text' => '_listing_subscribers'), $this);?>
</span>
		<span class="notFound"><?php echo smarty_function_translate(array('text' => '_no_subscribers_found'), $this);?>
</span>
	</span>
</span>