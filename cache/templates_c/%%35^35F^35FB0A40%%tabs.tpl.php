<?php /* Smarty version 2.6.26, created on 2015-12-02 13:45:48
         compiled from custom:backend/product/tabs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/product/tabs.tpl', 6, false),array('function', 'link', 'custom:backend/product/tabs.tpl', 13, false),array('block', 'tabControl', 'custom:backend/product/tabs.tpl', 18, false),array('block', 'tab', 'custom:backend/product/tabs.tpl', 19, false),)), $this); ?>
<div id="productManagerContainer" class="treeManagerContainer maxHeight h--90" style="display: none;">

	<fieldset class="container">
		<ul class="menu doneProduct">
			<li class="done">
				<a href="#cancelEditing" id="cancel_product_edit" class="cancel"><?php echo smarty_function_translate(array('text' => '_done_editing_product'), $this);?>
</a>
			</li>
			<li class="clone">
				<a href="#clone" id="clone_product">Clone product</a>
			</li>
		</ul>

		<a id="productPage" onclick="Backend.Product.Editor.prototype.goToProductPage();" href="<?php echo smarty_function_link(array('controller' => 'product','action' => 'index','id' => '_id_'), $this);?>
" target="_blank" class="external"><?php echo smarty_function_translate(array('text' => '_product_page'), $this);?>
</a>

	</fieldset>

	<div class="tabContainer">
		<?php $this->_tag_stack[] = array('tabControl', array('id' => 'productTabList')); $_block_repeat=true;smarty_block_tabControl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php $this->_tag_stack[] = array('tab', array('id' => 'tabProductBasic','help' => "products.edit")); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.product",'action' => 'basicData','id' => '_id_'), $this);?>
?categoryID=_categoryID_}"><?php echo smarty_function_translate(array('text' => '_basic_data'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php $this->_tag_stack[] = array('tab', array('id' => 'tabProductBundle','help' => 'categories','hidden' => true)); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.productBundle",'action' => 'index','id' => '_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_bundled_products'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php $this->_tag_stack[] = array('tab', array('id' => 'tabProductImages','help' => "products.edit.images")); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.productImage",'action' => 'index','id' => '_id_'), $this);?>
?categoryID=_categoryID_"><?php echo smarty_function_translate(array('text' => '_images'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php $this->_tag_stack[] = array('tab', array('id' => 'tabProductVariations','help' => "products.edit")); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.productVariation",'action' => 'index','id' => '_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_variations'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php $this->_tag_stack[] = array('tab', array('id' => 'tabProductRelationship','help' => "products.edit.related")); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.productRelationship",'action' => 'index','id' => '_id_'), $this);?>
?categoryID=_categoryID_&type=0"><?php echo smarty_function_translate(array('text' => '_related'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php $this->_tag_stack[] = array('tab', array('id' => 'tabProductUpsell','help' => "products.edit.related")); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.productRelationship",'action' => 'index','id' => '_id_'), $this);?>
?categoryID=_categoryID_&type=1"><?php echo smarty_function_translate(array('text' => '_upsell'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php $this->_tag_stack[] = array('tab', array('id' => 'tabProductFiles','help' => "products.edit.files",'hidden' => true)); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.productFile",'action' => 'index','id' => '_id_'), $this);?>
?categoryID=_categoryID_"><?php echo smarty_function_translate(array('text' => '_files'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php $this->_tag_stack[] = array('tab', array('id' => 'tabProductOptions','role' => 'option','help' => "products.edit.options")); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.productOption",'action' => 'index','id' => '_id_'), $this);?>
?categoryID=_categoryID_"><?php echo smarty_function_translate(array('text' => '_options'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php $this->_tag_stack[] = array('tab', array('id' => 'tabProductReviews','help' => 'categories','hidden' => true)); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.review",'action' => 'index','id' => '_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_reviews'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php $this->_tag_stack[] = array('tab', array('id' => 'tabProductCategories','help' => "products.edit.info")); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.productCategory",'action' => 'index','id' => '_id_'), $this);?>
?categoryID=_categoryID_"><?php echo smarty_function_translate(array('text' => '_product_categories'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php $this->_tag_stack[] = array('tab', array('id' => 'tabInfo','help' => "products.edit")); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.product",'action' => 'info','id' => '_id_'), $this);?>
?categoryID=_categoryID_"><?php echo smarty_function_translate(array('text' => '_info'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tabControl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</div>
	<div class="sectionContainer maxHeight h--50"></div>
</div>
<?php echo '
<script type="text/javascript">
	Event.observe($("cancel_product_edit"), "click", function(e) {
		Event.stop(e);
		var product = Backend.Product.Editor.prototype.getInstance(Backend.Product.Editor.prototype.getCurrentProductId(), false);
		product.removeTinyMce();
		product.cancelForm();
		Backend.Product.Editor.prototype.showCategoriesContainer();
		Backend.Breadcrumb.display(Backend.Category.activeCategoryId);
	});

	Event.observe($("clone_product"), "click", function(e) {
		Event.stop(e);
		var product = Backend.Product.Editor.prototype.getInstance(Backend.Product.Editor.prototype.getCurrentProductId(), false);
		var cloneUrl = Backend.Router.createUrl(\'backend.product\', \'copy\', {id: product.id});
		new LiveCart.AjaxRequest(cloneUrl, Event.element(e), function(oR)
		{
			//Backend.Product.Editor.prototype.getInstance(oR.responseData.ID, false);
			Backend.Product.openProduct(oR.responseData.ID);
		});
	});
</script>
'; ?>