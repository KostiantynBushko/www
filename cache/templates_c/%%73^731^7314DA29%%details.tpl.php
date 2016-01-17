<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from custom:product/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:product/details.tpl', 5, false),array('modifier', 'config', 'custom:product/details.tpl', 11, false),)), $this); ?>
<?php if ($this->_tpl_vars['product']['longDescription_lang'] || $this->_tpl_vars['product']['shortDescription_lang']): ?>
<div id="descriptionSection" class="productSection description">
	<?php if ($this->_tpl_vars['related']): ?>
<div id="relatedSection" class="productSection related">
<h2><?php echo $this->_tpl_vars['product']['name_lang']; ?>
 Sold Out. See similar available <?php echo $this->_tpl_vars['product']['Manufacturer']['name']; ?>
 <?php echo $this->_tpl_vars['product']['byHandle']['type']['value_lang']; ?>
<small><?php echo smarty_function_translate(array('text' => '_tab_recommended'), $this);?>
</small></h2>
<div id="relatedProducts">
	<?php $_from = $this->_tpl_vars['related']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
	   <?php if ($this->_tpl_vars['group']['0']['ProductRelationshipGroup']['name_lang']): ?>
		   <h3><?php echo $this->_tpl_vars['group']['0']['ProductRelationshipGroup']['name_lang']; ?>
</h3>
	   <?php endif; ?>
	   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/productListLayout.tpl", 'smarty_include_vars' => array('layout' => ((is_array($_tmp='PRODUCT_PAGE_LIST_LAYOUT')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)),'products' => $this->_tpl_vars['group'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endforeach; endif; unset($_from); ?>
</div>
</div>
<?php endif; ?>
	
	<h2><?php echo smarty_function_translate(array('text' => '_description'), $this);?>
</h2>
	<div id="productDescription">
		<?php if ($this->_tpl_vars['product']['longDescription_lang']): ?>
			<?php echo $this->_tpl_vars['product']['longDescription_lang']; ?>

		<?php else: ?>
			<?php echo $this->_tpl_vars['product']['shortDescription_lang']; ?>

		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['product']['attributes']): ?>
<div id="specificationSection" class="productSection specification">
<h2><?php echo smarty_function_translate(array('text' => '_spec'), $this);?>
<small><?php echo smarty_function_translate(array('text' => '_tab_specification'), $this);?>
</small></h2>
<div id="productSpecification">
	<table class="productDetailsTable">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/specificationTableBody.tpl", 'smarty_include_vars' => array('attributes' => $this->_tpl_vars['product']['attributes'],'field' => 'SpecField','group' => 'SpecFieldGroup')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</table>
</div>
</div>
<?php endif; ?>




<?php if ($this->_tpl_vars['together']): ?>
<div id="purchasedTogetherSection" class="productSection purchasedTogether">
<h2><?php echo smarty_function_translate(array('text' => '_purchased_together'), $this);?>
<small><?php echo smarty_function_translate(array('text' => '_tab_purchased'), $this);?>
</small></h2>
<div id="purchasedTogether">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/productListLayout.tpl", 'smarty_include_vars' => array('layout' => ((is_array($_tmp='PRODUCT_PAGE_LIST_LAYOUT')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)),'products' => $this->_tpl_vars['together'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
</div>
<?php endif; ?>

<?php echo '
		<!-- AddThis Smart Layers BEGIN -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize -->

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5277150f0ea19ad7"></script>


<script type="text/javascript">
  addthis.layers({
    \'theme\' : \'transparent\',
    \'share\' : {
      \'position\' : \'right\',
      \'numPreferredServices\' : 5
    }, 
    \'follow\' : {
      \'services\' : [
        {\'service\': \'twitter\', \'id\': \'trendeyewear\'}
      ]
    }   
  });
</script>

<!-- AddThis Smart Layers END -->

		
		'; ?>