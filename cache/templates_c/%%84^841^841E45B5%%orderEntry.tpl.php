<?php /* Smarty version 2.6.26, created on 2015-12-30 15:39:08
         compiled from custom:user/orderEntry.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', 'custom:user/orderEntry.tpl', 2, false),array('function', 'maketext', 'custom:user/orderEntry.tpl', 8, false),array('function', 'translate', 'custom:user/orderEntry.tpl', 14, false),array('modifier', 'config', 'custom:user/orderEntry.tpl', 24, false),array('block', 'sect', 'custom:user/orderEntry.tpl', 57, false),array('block', 'header', 'custom:user/orderEntry.tpl', 58, false),array('block', 'content', 'custom:user/orderEntry.tpl', 61, false),array('block', 'footer', 'custom:user/orderEntry.tpl', 68, false),)), $this); ?>
<h3>
	<a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'viewOrder','id' => $this->_tpl_vars['order']['ID']), $this);?>
"><?php echo $this->_tpl_vars['order']['formatted_dateCompleted']['date_long']; ?>
</a>
</h3>

<?php if ($this->_tpl_vars['order']['unreadMessageCount']): ?>
	<p class="messages">
		<a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'viewOrder','id' => $this->_tpl_vars['order']['ID']), $this);?>
#msg" class="messages">
			<?php echo smarty_function_maketext(array('text' => '_unread_messages','params' => $this->_tpl_vars['order']['unreadMessageCount']), $this);?>

		</a>
	</p>
<?php endif; ?>

<div class="orderStatus">
	<?php echo smarty_function_translate(array('text' => '_status'), $this);?>
:
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/orderStatus.tpl", 'smarty_include_vars' => array('order' => $this->_tpl_vars['order'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<div class="orderDetails">

   <div class="orderMenu">

		<ul>
			<li><a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'viewOrder','id' => $this->_tpl_vars['order']['ID']), $this);?>
" class="viewOrder"><?php echo smarty_function_translate(array('text' => '_view_details'), $this);?>
</a></li>
			<?php if (! $this->_tpl_vars['order']['isCancelled'] && ! ((is_array($_tmp='DISABLE_INVOICES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
				<li><a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'orderInvoice','id' => $this->_tpl_vars['order']['ID']), $this);?>
" class="invoice"><?php echo smarty_function_translate(array('text' => '_order_invoice'), $this);?>
</a></li>
			<?php endif; ?>
			<li><a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'reorder','id' => $this->_tpl_vars['order']['ID']), $this);?>
" class="reorder"><?php echo smarty_function_translate(array('text' => '_reorder'), $this);?>
</a></li>
		</ul>

	   <div class="orderID">
		   <?php echo smarty_function_translate(array('text' => '_order_id'), $this);?>
: <?php echo $this->_tpl_vars['order']['invoiceNumber']; ?>

	   </div>

	   <?php if ($this->_tpl_vars['order']['ShippingAddress']): ?>
		   <div class="orderRecipient">
			   <?php echo smarty_function_translate(array('text' => '_recipient'), $this);?>
: <?php echo $this->_tpl_vars['order']['ShippingAddress']['fullName']; ?>

		   </div>
	   <?php endif; ?>

	   <div class="orderTotal">
		   <?php echo smarty_function_translate(array('text' => '_total'), $this);?>
: <strong><?php echo $this->_tpl_vars['order']['formattedTotal'][$this->_tpl_vars['order']['Currency']['ID']]; ?>
</strong>
	   </div>

   </div>

   <div class="orderContent">

		<ul>
		<?php $_from = $this->_tpl_vars['order']['cartItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<li><?php echo $this->_tpl_vars['item']['count']; ?>
 x
				<?php if ($this->_tpl_vars['item']['Product']['isDownloadable']): ?>
					<a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'item','id' => $this->_tpl_vars['item']['ID']), $this);?>
"><?php echo $this->_tpl_vars['item']['Product']['name_lang']; ?>
</a>
				<?php else: ?>
					<?php echo $this->_tpl_vars['item']['Product']['name_lang']; ?>

				<?php endif; ?>

				<?php $this->_tag_stack[] = array('sect', array()); $_block_repeat=true;smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<?php $this->_tag_stack[] = array('header', array()); $_block_repeat=true;smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
						<ul>
					<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php $this->_tag_stack[] = array('content', array()); $_block_repeat=true;smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
						<?php $_from = $this->_tpl_vars['item']['subItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subItem']):
?>
							<?php if ($this->_tpl_vars['subItem']['Product']['isDownloadable']): ?>
								<li><a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'item','id' => $this->_tpl_vars['subItem']['ID']), $this);?>
"><?php echo $this->_tpl_vars['subItem']['Product']['name_lang']; ?>
</a></li>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php $this->_tag_stack[] = array('footer', array()); $_block_repeat=true;smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
						</ul>
					<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</li>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
	</div>

</div>