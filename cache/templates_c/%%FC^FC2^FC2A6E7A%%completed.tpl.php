<?php /* Smarty version 2.6.26, created on 2015-12-11 06:43:38
         compiled from /home/illumin/public_html/application/view///checkout/completed.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'pageTitle', '/home/illumin/public_html/application/view///checkout/completed.tpl', 3, false),array('function', 'translate', '/home/illumin/public_html/application/view///checkout/completed.tpl', 3, false),array('modifier', 'substr', '/home/illumin/public_html/application/view///checkout/completed.tpl', 17, false),)), $this); ?>
<div class="checkoutCompleted">

<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_order_completed'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content">

	<h1><?php echo smarty_function_translate(array('text' => '_order_completed'), $this);?>
</h1>

	<?php if ($this->_tpl_vars['order']['isPaid']): ?>
		<?php echo smarty_function_translate(array('text' => '_completed_paid'), $this);?>

	<?php else: ?>
		<?php echo smarty_function_translate(array('text' => '_completed_offline'), $this);?>


		<?php if ($this->_tpl_vars['transactions']['0']['serializedData']['handlerID']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/offlineMethodInfo.tpl", 'smarty_include_vars' => array('method' => substr($this->_tpl_vars['transactions']['0']['serializedData']['handlerID'], -1))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/completeOverview.tpl", 'smarty_include_vars' => array('nochanges' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:checkout/orderDownloads.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>