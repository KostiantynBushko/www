<?php /* Smarty version 2.6.26, created on 2015-12-08 07:44:37
         compiled from /home/illumin/public_html/application/view///user/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///user/index.tpl', 9, false),array('function', 'link', '/home/illumin/public_html/application/view///user/index.tpl', 27, false),)), $this); ?>
<div class="userIndex">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/userMenu.tpl", 'smarty_include_vars' => array('current' => 'homeMenu')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content">

	<h1><?php echo smarty_function_translate(array('text' => '_your_account'), $this);?>
 (<?php echo $this->_tpl_vars['user']['fullName']; ?>
)</h1>

	<?php if ($this->_tpl_vars['userConfirm']): ?>
	<div class="confirmationMessage">
		<?php echo $this->_tpl_vars['userConfirm']; ?>

	</div>
	<?php endif; ?>

	<fieldset class="container">

		<?php if ($this->_tpl_vars['message']): ?>
			<div class="confirmationMessage"><?php echo $this->_tpl_vars['message']; ?>
</div>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['notes']): ?>
			<h2 id="unreadMessages"><?php echo smarty_function_translate(array('text' => '_unread_msg'), $this);?>
</h2>
			<ul class="notes">
				<?php $_from = $this->_tpl_vars['notes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['note']):
?>
				   <a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'viewOrder','id' => ($this->_tpl_vars['note']['orderID'])), $this);?>
#msg"><?php echo smarty_function_translate(array('text' => '_order'), $this);?>
 #<?php echo $this->_tpl_vars['note']['orderID']; ?>
</a>
				   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/orderNote.tpl", 'smarty_include_vars' => array('note' => $this->_tpl_vars['note'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['files']): ?>
			<h2 id="recentDownloads"><?php echo smarty_function_translate(array('text' => '_download_recent'), $this);?>
</h2>

			<?php $_from = $this->_tpl_vars['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<h3>
					<a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'item','id' => $this->_tpl_vars['item']['ID']), $this);?>
"><?php echo $this->_tpl_vars['item']['Product']['name_lang']; ?>
</a>
				</h3>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/fileList.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['item'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<div class="clear"></div>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['orders']): ?>
			<h2 id="recentOrders"><?php echo smarty_function_translate(array('text' => '_recent_orders'), $this);?>
</h2>
			<?php $_from = $this->_tpl_vars['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/orderEntry.tpl", 'smarty_include_vars' => array('order' => $this->_tpl_vars['order'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			<p>
				<?php echo smarty_function_translate(array('text' => '_no_orders_placed'), $this);?>

			</p>
		<?php endif; ?>

		<div class="clear"></div>

	</fieldset>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>