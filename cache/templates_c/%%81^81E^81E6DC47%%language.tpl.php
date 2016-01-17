<?php /* Smarty version 2.6.26, created on 2015-12-03 23:19:16
         compiled from custom:backend/eav/language.tpl */ ?>
<?php $_from = $this->_tpl_vars['multiLingualSpecFieldss']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['item']['ID']; ?>
_<?php echo $this->_tpl_vars['field']['fieldName']; ?>
_<?php echo $this->_tpl_vars['lang']['ID']; ?>
"><?php echo $this->_tpl_vars['field']['name_lang']; ?>
:</label>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/specFieldFactory.tpl", 'smarty_include_vars' => array('field' => $this->_tpl_vars['field'],'language' => $this->_tpl_vars['lang']['ID'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</p>
<?php endforeach; endif; unset($_from); ?>