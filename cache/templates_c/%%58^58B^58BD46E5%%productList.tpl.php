<?php /* Smarty version 2.6.26, created on 2015-12-01 11:00:55
         compiled from custom:category/productList.tpl */ ?>
<ul class="productList">
<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['productList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['productList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['productList']['iteration']++;
?>
	<li class="<?php if ($this->_tpl_vars['product']['isFeatured']): ?>featured<?php endif; ?>">

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/productListItem.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php if (! ($this->_foreach['productList']['iteration'] == $this->_foreach['productList']['total'])): ?>
			<div class="productSeparator"></div>
		<?php endif; ?>

	</li>
<?php endforeach; endif; unset($_from); ?>
</ul>