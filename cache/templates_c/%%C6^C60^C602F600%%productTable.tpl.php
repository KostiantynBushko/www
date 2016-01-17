<?php /* Smarty version 2.6.26, created on 2015-12-01 10:23:36
         compiled from custom:category/productTable.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'explode', 'custom:category/productTable.tpl', 3, false),array('modifier', 'array_pop', 'custom:category/productTable.tpl', 3, false),array('modifier', 'default', 'custom:category/productTable.tpl', 3, false),array('modifier', 'config', 'custom:category/productTable.tpl', 12, false),array('modifier', 'escape', 'custom:category/productTable.tpl', 50, false),array('function', 'link', 'custom:category/productTable.tpl', 9, false),array('function', 'translate', 'custom:category/productTable.tpl', 9, false),array('function', 'zebra', 'custom:category/productTable.tpl', 44, false),array('function', 'productUrl', 'custom:category/productTable.tpl', 48, false),array('function', 'img', 'custom:category/productTable.tpl', 50, false),)), $this); ?>
<?php if (!function_exists('smarty_fun_headLink')) { function smarty_fun_headLink(&$smarty, $params) { $_fun_tpl_vars = $smarty->_tpl_vars; $smarty->assign($params);  ?>
	<?php if ($smarty->_tpl_vars['title']): ?>
		<?php $smarty->assign('sortOrder', ((is_array($_tmp=array_pop(explode('_', $smarty->_tpl_vars['sortField'])))) ? $smarty->_run_mod_handler('default', true, $_tmp, 'asc') : smarty_modifier_default($_tmp, 'asc'))); ?>
		<?php if (( $smarty->_tpl_vars['sortOrder'] != 'asc' ) && ( $smarty->_tpl_vars['sortOrder'] != 'desc' )): ?><?php $smarty->assign('sortOrder', 'asc'); ?><?php endif; ?>
		<?php if ($smarty->_tpl_vars['sortField'] == ($smarty->_tpl_vars['sortVar'])."_".($smarty->_tpl_vars['sortOrder'])): ?>
			<?php $smarty->assign('currentOrder', $smarty->_tpl_vars['sortOrder']); ?>
			<?php if ($smarty->_tpl_vars['sortOrder'] == 'asc'): ?><?php $smarty->assign('sortOrder', 'desc'); ?><?php else: ?><?php $smarty->assign('sortOrder', 'asc'); ?><?php endif; ?>
		<?php endif; ?>
		<a href="<?php echo smarty_function_link(array('self' => true,'sort' => ($smarty->_tpl_vars['sortVar'])."_".($smarty->_tpl_vars['sortOrder'])), $smarty);?>
" class="<?php if ($smarty->_tpl_vars['currentOrder']): ?>direction_<?php echo $smarty->_tpl_vars['currentOrder']; ?>
<?php endif; ?>"><?php echo smarty_function_translate(array('text' => $smarty->_tpl_vars['title']), $smarty);?>
</a>
	<?php endif; ?>
<?php  $smarty->_tpl_vars = $_fun_tpl_vars; }} smarty_fun_headLink($this, array('title'=>"",'sortVar'=>""));  ?>
<?php $this->assign('columns', ((is_array($_tmp='TABLE_VIEW_COLUMNS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))); ?>

<table class="table productTable">
	<thead>
		<tr>
			<?php if ($this->_tpl_vars['columns']['IMAGE']): ?>
				<th class="productImage"><?php echo smarty_function_translate(array('text' => '_image'), $this);?>
</th>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['columns']['SKU']): ?>
				<th class="productSku"><?php smarty_fun_headLink($this, array('title'=>'_sku','sortVar'=>'sku'));  ?></th>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['columns']['NAME']): ?>
				<th class="productName"><?php smarty_fun_headLink($this, array('title'=>'_name','sortVar'=>'product_name'));  ?></th>
			<?php endif; ?>

			<?php $_from = $this->_tpl_vars['listAttributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attribute']):
?>
				<th class="attr_<?php echo $this->_tpl_vars['attribute']['ID']; ?>
"><?php smarty_fun_headLink($this, array('title'=>$this->_tpl_vars['attribute']['name_lang'],'sortVar'=>($this->_tpl_vars['attribute']['ID'])."-".($this->_tpl_vars['attribute']['handle'])));  ?></th>
			<?php endforeach; endif; unset($_from); ?>

			<?php if ($this->_tpl_vars['columns']['PRICE'] && ((is_array($_tmp='DISPLAY_PRICES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
				<th class="productPrice"><?php smarty_fun_headLink($this, array('title'=>'_price','sortVar'=>'price'));  ?></th>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['columns']['DETAILS']): ?>
				<th class="productDetails"><?php echo smarty_function_translate(array('text' => '_view_details'), $this);?>
</th>
			<?php endif; ?>
		</tr>
	</thead>
	<tbody>
		<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['productList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['productList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['productList']['iteration']++;
?>
			<tr class="<?php echo smarty_function_zebra(array('loop' => 'productList'), $this);?>
 <?php if (! ($this->_foreach['productList']['iteration'] == $this->_foreach['productList']['total'])): ?>last<?php endif; ?>">

				<?php if ($this->_tpl_vars['columns']['IMAGE']): ?>
					<td class="productImage">
						<a href="<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['product']), $this);?>
">
						<?php if ($this->_tpl_vars['product']['DefaultImage']['ID']): ?>
							<?php echo smarty_function_img(array('src' => $this->_tpl_vars['product']['DefaultImage']['paths']['1'],'alt' => ((is_array($_tmp=$this->_tpl_vars['product']['name_lang'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))), $this);?>

						<?php else: ?>
							<?php echo smarty_function_img(array('src' => ((is_array($_tmp='MISSING_IMG_THUMB')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)),'alt' => ((is_array($_tmp=$this->_tpl_vars['product']['name_lang'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))), $this);?>

						<?php endif; ?>
						</a>
					</td>
				<?php endif; ?>

				<?php if ($this->_tpl_vars['columns']['SKU']): ?>
					<td class="productSku text"><a href="<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['product'],'filterChainHandle' => $this->_tpl_vars['filterChainHandle']), $this);?>
"><?php echo $this->_tpl_vars['product']['sku']; ?>
</a></td>
				<?php endif; ?>

				<?php if ($this->_tpl_vars['columns']['NAME']): ?>
					<td class="productName text"><a href="<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['product'],'filterChainHandle' => $this->_tpl_vars['filterChainHandle']), $this);?>
"><?php echo $this->_tpl_vars['product']['name_lang']; ?>
</a></td>
				<?php endif; ?>

				<?php $_from = $this->_tpl_vars['listAttributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attribute']):
?>
					<td class="attribute attr_<?php echo $this->_tpl_vars['attribute']['ID']; ?>
"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/attributeValue.tpl", 'smarty_include_vars' => array('attr' => $this->_tpl_vars['product']['attributes'][$this->_tpl_vars['attribute']['ID']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
				<?php endforeach; endif; unset($_from); ?>

				<?php if ($this->_tpl_vars['columns']['PRICE'] && ((is_array($_tmp='DISPLAY_PRICES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
					<td class="productPrice"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/block/productPrice.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
				<?php endif; ?>

				<?php if ($this->_tpl_vars['columns']['DETAILS']): ?>
					<td class="productDetails"><a href="<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['product'],'filterChainHandle' => $this->_tpl_vars['filterChainHandle']), $this);?>
"><?php echo smarty_function_translate(array('text' => '_view_details'), $this);?>
</a></td>
				<?php endif; ?>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
	</tbody>
</table>