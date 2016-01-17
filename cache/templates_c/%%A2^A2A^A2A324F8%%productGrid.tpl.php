<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:33
         compiled from custom:category/productGrid.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:category/productGrid.tpl', 3, false),)), $this); ?>
<table class="productGrid">
<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['productList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['productList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['productList']['iteration']++;
?>
	<?php if (0 == ($this->_foreach['productList']['iteration']-1) % $this->_plugins['modifier']['config'][0][0]->config('LAYOUT_GRID_COLUMNS')): ?>
		<tr class="<?php if (( ($this->_foreach['productList']['iteration']-1) + $this->_plugins['modifier']['config'][0][0]->config('LAYOUT_GRID_COLUMNS') ) >= $this->_foreach['productList']['total']): ?>last<?php endif; ?><?php if (($this->_foreach['productList']['iteration'] <= 1)): ?> first<?php endif; ?>">
	<?php endif; ?>

	<td class="<?php if ($this->_tpl_vars['product']['isFeatured']): ?>featured<?php endif; ?><?php if (1 == ( ($this->_foreach['productList']['iteration']-1) + 1 ) % $this->_plugins['modifier']['config'][0][0]->config('LAYOUT_GRID_COLUMNS')): ?> first<?php endif; ?><?php if (0 == ( ($this->_foreach['productList']['iteration']-1) + 1 ) % $this->_plugins['modifier']['config'][0][0]->config('LAYOUT_GRID_COLUMNS')): ?> last<?php endif; ?>">
		<div class="gridItemWrap1"><div class="gridItemWrap2"><div class="gridItemWrap3"><div class="gridItemWrap4">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/productGridItem.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div></div></div></div>
	</td>

	<?php if (0 == ( ( ($this->_foreach['productList']['iteration']-1) + 1 ) % $this->_plugins['modifier']['config'][0][0]->config('LAYOUT_GRID_COLUMNS') )): ?>
		</tr>
	<?php elseif (($this->_foreach['productList']['iteration'] == $this->_foreach['productList']['total'])): ?>
		<td class="last empty"></td>
		</tr>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</table>
