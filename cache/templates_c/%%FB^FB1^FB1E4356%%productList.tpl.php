<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:45
         compiled from /home/illumin/public_html/application/view//block/productList.tpl */ ?>
<?php $_from = $this->_tpl_vars['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
	<h2><?php echo $this->_tpl_vars['list']['0']['ProductList']['name_lang']; ?>
</h2>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/productGrid.tpl", 'smarty_include_vars' => array('products' => $this->_tpl_vars['list'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endforeach; endif; unset($_from); ?>