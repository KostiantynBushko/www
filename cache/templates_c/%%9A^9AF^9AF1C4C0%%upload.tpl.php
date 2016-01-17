<?php /* Smarty version 2.6.26, created on 2015-12-03 18:05:06
         compiled from /home/illumin/public_html/application/view///backend/themeFile/upload.tpl */ ?>
var
	result = <?php echo $this->_tpl_vars['result']; ?>
,
	container = parent.$('filesList_<?php echo $this->_tpl_vars['theme']; ?>
'),
	tf;

container.innerHTML = '';
tf = new parent.Backend.ThemeFile(
	parent.$A(result),
	container,
	parent.$('filesList_template_<?php echo $this->_tpl_vars['theme']; ?>
')
);
tf.cancelOpened(container, "<?php echo $this->_tpl_vars['theme']; ?>
");

<?php if ($this->_tpl_vars['highlightFileName']): ?>
	parent.ActiveList.prototype.highlight(parent.$('filesList_<?php echo $this->_tpl_vars['theme']; ?>
_<?php echo $this->_tpl_vars['highlightFileName']; ?>
'), 'yellow');
<?php endif; ?>