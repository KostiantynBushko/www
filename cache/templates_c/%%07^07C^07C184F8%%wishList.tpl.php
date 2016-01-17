<?php /* Smarty version 2.6.26, created on 2015-12-03 21:20:03
         compiled from custom:order/wishList.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:order/wishList.tpl', 1, false),array('function', 'zebra', 'custom:order/wishList.tpl', 12, false),array('function', 'link', 'custom:order/wishList.tpl', 14, false),array('function', 'productUrl', 'custom:order/wishList.tpl', 19, false),array('function', 'img', 'custom:order/wishList.tpl', 20, false),array('modifier', 'escape', 'custom:order/wishList.tpl', 20, false),)), $this); ?>
<h2><?php echo smarty_function_translate(array('text' => '_wish_list_items'), $this);?>
</h2>
<fieldset class="container" id="wishList">
<table>
	<thead>
		<tr>
			<th colspan="3" class="cartListTitle"></th>
			<th class="cartPrice"><?php echo smarty_function_translate(array('text' => '_price'), $this);?>
</th>
		</tr>
	</thead>
	<tbody>
	<?php $_from = $this->_tpl_vars['cart']['wishListItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['wishList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['wishList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['wishList']['iteration']++;
?>
		<tr class="<?php echo smarty_function_zebra(array('loop' => 'wishList'), $this);?>
">
			<td class="cartControl">
				<a href="<?php echo smarty_function_link(array('controller' => 'order','action' => 'moveToCart','id' => $this->_tpl_vars['item']['ID'],'query' => "return=".($this->_tpl_vars['return'])), $this);?>
"><?php echo smarty_function_translate(array('text' => '_move_to_cart'), $this);?>
</a>
				<a href="<?php echo smarty_function_link(array('controller' => 'order','action' => 'delete','id' => $this->_tpl_vars['item']['ID'],'query' => "return=".($this->_tpl_vars['return'])), $this);?>
"><?php echo smarty_function_translate(array('text' => '_remove'), $this);?>
</a>
			</td>
			<td class="cartImage">
				<?php if ($this->_tpl_vars['item']['Product']['DefaultImage']['paths']['1']): ?>
				<a href="<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['item']['Product']), $this);?>
">
					<?php echo smarty_function_img(array('src' => $this->_tpl_vars['item']['Product']['DefaultImage']['paths']['1'],'alt' => ((is_array($_tmp=$this->_tpl_vars['item']['Product']['name_lang'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))), $this);?>

				</a>
				<?php endif; ?>
			</td>
			<td class="cartName">
				<a href="<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['item']['Product']), $this);?>
"><?php echo $this->_tpl_vars['item']['Product']['name_lang']; ?>
</a>
			</td>
			<td class="cartPrice">
				<?php echo $this->_tpl_vars['item']['Product']['formattedPrice'][$this->_tpl_vars['currency']]; ?>

			</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
	</tbody>
</table>
<a href="<?php echo smarty_function_link(array('route' => $this->_tpl_vars['return']), $this);?>
" class="continueShopping"><?php echo smarty_function_translate(array('text' => '_continue_shopping'), $this);?>
</a>
</fieldset>