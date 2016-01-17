<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from /home/illumin/public_html/application/view//product/block/variations.tpl */ ?>
<?php if ($this->_tpl_vars['variations']['products']): ?>
	<tr id="variations">
		<td colspan="2" class="productVariations">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/variations.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
<?php endif; ?>
		<script type="text/javascript">
			<?php if ($this->_tpl_vars['request']['activeVariationID']): ?>
				window.productVariationHandler.setVariation(<?php echo $this->_tpl_vars['request']['activeVariationID']; ?>
);
			<?php endif; ?>
		</script>
		