<?php /* Smarty version 2.6.26, created on 2015-12-13 16:28:12
         compiled from custom:backend/customerOrder/count.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/customerOrder/count.tpl', 3, false),)), $this); ?>
<span class="activeGridItemsCount">
	<span class="orderCount" id="orderCount_<?php echo $this->_tpl_vars['orderGroupID']; ?>
" >
		<span class="rangeCount" style="display: none;"><?php echo smarty_function_translate(array('text' => '_listing_orders'), $this);?>
</span>
		<span class="notFound" style="display: none;"><?php echo smarty_function_translate(array('text' => '_no_orders'), $this);?>
</span>
	</span>
</span>