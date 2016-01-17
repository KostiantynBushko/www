<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from /home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/shoppingCart.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/shoppingCart.tpl', 4, false),array('function', 'translate', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/shoppingCart.tpl', 4, false),array('function', 'maketext', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/shoppingCart.tpl', 12, false),array('modifier', 'config', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/shoppingCart.tpl', 7, false),)), $this); ?>
<div id="smallCart">

	<span class="menuItem yourAccount">
		<a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'index'), $this);?>
" class="menu_yourAccount"><?php echo smarty_function_translate(array('text' => '_your_account'), $this);?>
</a>
	</span>

	<?php if (((is_array($_tmp='ENABLE_CART')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<span class="sep">|</span>
		<?php if (( $this->_tpl_vars['request']['controller'] == 'product' ) || ( $this->_tpl_vars['request']['controller'] == 'category' )): ?><?php $this->assign('returnPath', true); ?><?php endif; ?>

		<span class="menuItem shoppingCart">
			<a href="<?php echo smarty_function_link(array('controller' => 'order','returnPath' => $this->_tpl_vars['returnPath']), $this);?>
" class="menu_shoppingCart"><?php echo smarty_function_translate(array('text' => '_shopping_cart'), $this);?>
</a> <span class="menu_cartItemCount" style="<?php if (! $this->_tpl_vars['order']['basketCount']): ?>display: none;<?php endif; ?>">(<span><?php echo smarty_function_maketext(array('text' => '_cart_item_count','params' => $this->_tpl_vars['order']['basketCount']), $this);?>
</span>)</span>
		</span>

		<span class="menu_isOrderable" style="<?php if (! $this->_tpl_vars['order']['isOrderable']): ?>display: none;<?php endif; ?>">
			<span class="sep">|</span>

			<span class="menuItem checkout">
				<a href="<?php echo smarty_function_link(array('controller' => 'checkout','returnPath' => true), $this);?>
" class="checkout"><?php echo smarty_function_translate(array('text' => '_checkout'), $this);?>
</a>
			</span>
		</span>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['user']['ID'] > 0): ?>
		<span class="logout">
			<span class="menuItem yourAccount">
				| <a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'logout'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_sign_out'), $this);?>
</a>
			</span>
		</span>
	<?php endif; ?>

</div>

<script type="text/javascript">
	Observer.add('orderSummary', Frontend.SmallCart, 'smallCart');
</script>