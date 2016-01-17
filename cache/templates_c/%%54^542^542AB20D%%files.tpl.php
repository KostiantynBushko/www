<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from custom:product/files.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:product/files.tpl', 3, false),)), $this); ?>
<?php if ($this->_tpl_vars['files']): ?>
	<div id="filesSection" class="productSection files">
		<h2><?php echo smarty_function_translate(array('text' => '_preview_files'), $this);?>
</h2>

		<?php $_from = $this->_tpl_vars['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['file']):
?>
			<?php if ($this->_tpl_vars['file']['productFileGroupID'] && ( $this->_tpl_vars['file']['productFileGroupID'] != $this->_tpl_vars['previousFileGroupID'] )): ?>
				<h3><?php echo $this->_tpl_vars['file']['ProductFileGroup']['name']; ?>
</h3>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['file']['isEmbedded']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/files/embed.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/files/link.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</div>
<?php endif; ?>