<?php /* Smarty version 2.6.26, created on 2015-12-02 13:11:46
         compiled from custom:backend/customerOrder/orderContainer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/customerOrder/orderContainer.tpl', 6, false),array('function', 'link', 'custom:backend/customerOrder/orderContainer.tpl', 14, false),)), $this); ?>
<fieldset id="orderManagerContainer" class="treeManagerContainer maxHeight h--100" style="display: none;">

	<fieldset class="container">
		<ul class="menu">
			<li class="done">
				<a href="#cancelEditing" id="cancel_order_edit" class="cancel"><?php echo smarty_function_translate(array('text' => '_cancel_editing_order_info'), $this);?>
</a>
			</li>
		</ul>
	</fieldset>

	<div class="tabContainer">
		<ul class="tabList tabs">
			<li id="tabOrderInfo" class="tab active">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'info','id' => '_id_'), $this);?>
"}"><?php echo smarty_function_translate(array('text' => '_order_info'), $this);?>
</a>
				<span class="tabHelp">orders.edit</span>
			</li>
			<li id="tabOrderPayments" class="tab active">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.payment",'id' => '_id_'), $this);?>
"}"><?php echo smarty_function_translate(array('text' => '_order_payments'), $this);?>
</a>
				<span class="tabHelp">orders.edit</span>
			</li>
			<li id="tabOrderCommunication" class="tab active">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.orderNote",'id' => '_id_'), $this);?>
"}"><?php echo smarty_function_translate(array('text' => '_order_communication'), $this);?>
</a>
				<span class="tabHelp">orders.edit</span>
			</li>
			<li id="tabOrderLog" class="tab active">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.orderLog",'id' => '_id_'), $this);?>
"}"><?php echo smarty_function_translate(array('text' => '_order_log'), $this);?>
</a>
				<span class="tabHelp">orders.edit</span>
			</li>
			<li id="tabPreviousOrders" class="tab active">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.customerOrder",'action' => 'orders','query' => "userOrderID=_id_"), $this);?>
"}"><?php echo smarty_function_translate(array('text' => '_previous_orders'), $this);?>
</a>
				<span class="tabHelp">orders.edit</span>
			</li>
		</ul>
	</div>
	<fieldset class="sectionContainer maxHeight h--50"></fieldset>


	<?php echo '
	<script type="text/javascript">
		Event.observe($("cancel_order_edit"), "click", function(e) {
			Event.stop(e);
			var order = Backend.CustomerOrder.Editor.prototype.getInstance(Backend.CustomerOrder.Editor.prototype.getCurrentId(), false);
			order.cancelForm();
		});
	</script>
	'; ?>

</fieldset>