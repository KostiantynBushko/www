<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from /home/illumin/public_html/application/view//product/block/upsell.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view//product/block/upsell.tpl', 6, false),)), $this); ?>
<?php $this->assign('SHOW_UPSELL_GROUPS', false); ?>
<?php if ($this->_tpl_vars['upsell']): ?>
<tr>
	<td colspan="2" id="upsellProducts">
		<fieldset id="upsellProducts">
			<legend><?php echo smarty_function_translate(array('text' => '_you_may_also_like'), $this);?>
</legend>
			<?php $_from = $this->_tpl_vars['upsell']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>

				<?php if ($this->_tpl_vars['SHOW_UPSELL_GROUPS']): ?>
					<fieldset>
						<?php if ($this->_tpl_vars['group']['0']['ProductRelationshipGroup']['name_lang']): ?>
							<legend><?php echo $this->_tpl_vars['group']['0']['ProductRelationshipGroup']['name_lang']; ?>
</legend>
						<?php endif; ?>
				<?php endif; ?>

				<ul class="productList">
					<?php $_from = $this->_tpl_vars['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['productList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['productList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['productList']['iteration']++;
?>
						<li class="<?php if ($this->_tpl_vars['product']['isFeatured']): ?>featured<?php endif; ?>">
							<div class="checkProduct">
								<input type="checkbox" name="productIDs[]" value="<?php echo $this->_tpl_vars['product']['ID']; ?>
" />
								<input type="hidden" name="product_<?php echo $this->_tpl_vars['product']['ID']; ?>
_count" value="1" />
							</div>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:/block/box/menuProductListItem.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
							<?php if (! ($this->_foreach['productList']['iteration'] == $this->_foreach['productList']['total']) && $this->_tpl_vars['SHOW_UPSELL_GROUPS']): ?>
								<div class="productSeparator"></div>
							<?php endif; ?>
						</li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>

				<?php if ($this->_tpl_vars['SHOW_UPSELL_GROUPS']): ?>
					</fieldset>
				<?php endif; ?>

			<?php endforeach; endif; unset($_from); ?>
		</fieldset>
	</td>
</tr>
<?php endif; ?>