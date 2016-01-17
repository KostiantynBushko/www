<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:01
         compiled from custom:order/block/items.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'zebra', 'custom:order/block/items.tpl', 2, false),array('function', 'link', 'custom:order/block/items.tpl', 5, false),array('function', 'translate', 'custom:order/block/items.tpl', 5, false),array('function', 'productUrl', 'custom:order/block/items.tpl', 12, false),array('function', 'img', 'custom:order/block/items.tpl', 13, false),array('function', 'textfield', 'custom:order/block/items.tpl', 52, false),array('modifier', 'config', 'custom:order/block/items.tpl', 4, false),array('modifier', 'escape', 'custom:order/block/items.tpl', 13, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['cart']['cartItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cart'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cart']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['cart']['iteration']++;
?>
	<tr class="<?php echo smarty_function_zebra(array('loop' => 'cart'), $this);?>
">
		<td class="cartControl">
			<?php if (((is_array($_tmp='ENABLE_WISHLISTS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
				<a href="<?php echo smarty_function_link(array('controller' => 'order','action' => 'moveToWishList','id' => $this->_tpl_vars['item']['ID'],'query' => "return=".($this->_tpl_vars['return'])), $this);?>
"><?php echo smarty_function_translate(array('text' => '_move_to_wishlist'), $this);?>
</a>
			<?php endif; ?>
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

		<?php if (((is_array($_tmp='SHOW_SKU_CART')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Product']['sku'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
		<?php endif; ?>

		<td class="cartName">
			<div>
				<?php if ($this->_tpl_vars['item']['Product']['ID']): ?>
					<a href="<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['item']['Product']), $this);?>
"><?php echo $this->_tpl_vars['item']['Product']['name_lang']; ?>
</a>
				<?php else: ?>
					<span><?php echo $this->_tpl_vars['item']['Product']['name_lang']; ?>
</span>
				<?php endif; ?>
				<small class="categoryName">(&rlm;<?php echo $this->_tpl_vars['item']['Product']['Category']['name_lang']; ?>
)</small>
			</div>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/itemVariations.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/block/itemOptions.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<?php if ($this->_tpl_vars['multi']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/selectItemAddress.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['item'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		</td>

		<td class="cartPrice <?php if ($this->_tpl_vars['item']['itemBasePrice'] != $this->_tpl_vars['item']['itemPrice']): ?>discount<?php endif; ?>">
			<?php if ($this->_tpl_vars['item']['count'] == 1): ?>
				<span class="basePrice"><?php echo $this->_tpl_vars['item']['formattedBasePrice']; ?>
</span><span class="actualPrice"><?php echo $this->_tpl_vars['item']['formattedPrice']; ?>
</span>
			<?php else: ?>
				<?php echo $this->_tpl_vars['item']['formattedDisplaySubTotal']; ?>

				<div class="subTotalCalc">
					<?php echo $this->_tpl_vars['item']['count']; ?>
 x <span class="basePrice"><?php echo $this->_tpl_vars['item']['formattedBasePrice']; ?>
</span><span class="actualPrice"><?php echo $this->_tpl_vars['item']['formattedPrice']; ?>
</span>
				</div>
			<?php endif; ?>
		</td>

		<td class="cartQuant">
			<?php echo smarty_function_textfield(array('name' => "item_".($this->_tpl_vars['item']['ID']),'class' => 'text'), $this);?>

		</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>