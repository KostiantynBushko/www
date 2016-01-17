<?php /* Smarty version 2.6.26, created on 2015-12-08 07:48:16
         compiled from /home/illumin/public_html/application/view///user/files.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///user/files.tpl', 8, false),array('function', 'maketext', '/home/illumin/public_html/application/view///user/files.tpl', 12, false),array('function', 'link', '/home/illumin/public_html/application/view///user/files.tpl', 20, false),array('modifier', 'count', '/home/illumin/public_html/application/view///user/files.tpl', 12, false),)), $this); ?>
<div class="userOrders">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/userMenu.tpl", 'smarty_include_vars' => array('current' => 'fileMenu')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content">

	<h1><?php echo smarty_function_translate(array('text' => '_your_files'), $this);?>
</h1>

		<div class="resultStats">
			<?php if ($this->_tpl_vars['files']): ?>
				<?php echo smarty_function_maketext(array('text' => '_files_found','params' => count($this->_tpl_vars['files'])), $this);?>

			<?php else: ?>
				<?php echo smarty_function_translate(array('text' => '_no_files_found'), $this);?>

			<?php endif; ?>
		</div>

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
		<?php endforeach; endif; unset($_from); ?>

	</div>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>