<?php /* Smarty version 2.6.26, created on 2015-12-08 07:48:18
         compiled from /home/illumin/public_html/application/view///user/orders.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///user/orders.tpl', 8, false),array('function', 'maketext', '/home/illumin/public_html/application/view///user/orders.tpl', 13, false),array('function', 'link', '/home/illumin/public_html/application/view///user/orders.tpl', 27, false),array('function', 'paginate', '/home/illumin/public_html/application/view///user/orders.tpl', 29, false),)), $this); ?>
<div class="userOrders">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/userMenu.tpl", 'smarty_include_vars' => array('current' => 'orderMenu')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content">

	<h1><?php echo smarty_function_translate(array('text' => '_your_orders'), $this);?>
</h1>

		<div class="resultStats">
			<?php if ($this->_tpl_vars['orders']): ?>
				<?php if ($this->_tpl_vars['count'] > $this->_tpl_vars['perPage']): ?>
					<?php echo smarty_function_maketext(array('text' => '_displaying_orders','params' => ($this->_tpl_vars['from']).",".($this->_tpl_vars['to']).",".($this->_tpl_vars['count'])), $this);?>

				<?php else: ?>
					<?php echo smarty_function_maketext(array('text' => '_orders_found','params' => $this->_tpl_vars['count']), $this);?>

				<?php endif; ?>
			<?php else: ?>
				<?php echo smarty_function_translate(array('text' => '_no_orders_found'), $this);?>

			<?php endif; ?>
		</div>

		<?php $_from = $this->_tpl_vars['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/orderEntry.tpl", 'smarty_include_vars' => array('order' => $this->_tpl_vars['order'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>

		<?php if ($this->_tpl_vars['count'] > $this->_tpl_vars['perPage']): ?>
			<?php ob_start(); ?><?php echo smarty_function_link(array('controller' => 'user','action' => 'orders','id' => 0), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('url', ob_get_contents());ob_end_clean(); ?>
			<div class="resultPages">
				Pages: <?php echo smarty_function_paginate(array('current' => $this->_tpl_vars['currentPage'],'count' => $this->_tpl_vars['count'],'perPage' => $this->_tpl_vars['perPage'],'url' => $this->_tpl_vars['url']), $this);?>

			</div>
		<?php endif; ?>

	</div>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>