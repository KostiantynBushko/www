<?php /* Smarty version 2.6.26, created on 2015-12-11 06:43:38
         compiled from custom:checkout/orderDownloads.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:checkout/orderDownloads.tpl', 3, false),)), $this); ?>
<?php if ($this->_tpl_vars['files']): ?>
	<div id="orderDownloads">
		<h2><?php echo smarty_function_translate(array('text' => '_download'), $this);?>
</h2>
		<?php $_from = $this->_tpl_vars['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/fileList.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['item'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>
	</div>
<?php endif; ?>