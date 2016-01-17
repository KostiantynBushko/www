<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:45
         compiled from /home/illumin/public_html/application/view//block/box/paginate.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view//block/box/paginate.tpl', 2, false),)), $this); ?>
<?php if ($this->_tpl_vars['urls']['previous']): ?>
	<a class="previous" href="<?php echo $this->_tpl_vars['urls']['previous']; ?>
"><?php echo smarty_function_translate(array('text' => '_previous'), $this);?>
</a>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
	<?php if ($this->_tpl_vars['last'] < $this->_tpl_vars['page'] - 1): ?>
		<span>...</span>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['current']): ?>
		<span class="page currentPage"><?php echo $this->_tpl_vars['page']; ?>
</span>
	<?php else: ?>
		<a class="page" href="<?php echo $this->_tpl_vars['urls'][$this->_tpl_vars['page']]; ?>
"><?php echo $this->_tpl_vars['page']; ?>
</a>
	<?php endif; ?>

	<?php $this->assign('last', $this->_tpl_vars['page']); ?>
<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['urls']['next']): ?>
	<a class="next" href="<?php echo $this->_tpl_vars['urls']['next']; ?>
"><?php echo smarty_function_translate(array('text' => '_next'), $this);?>
</a>
<?php endif; ?>