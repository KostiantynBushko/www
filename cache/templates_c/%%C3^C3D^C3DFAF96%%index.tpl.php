<?php /* Smarty version 2.6.26, created on 2015-12-02 13:45:48
         compiled from /home/illumin/public_html/application/view///backend/category/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeJs', '/home/illumin/public_html/application/view///backend/category/index.tpl', 1, false),array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/category/index.tpl', 36, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/category/index.tpl', 56, false),array('function', 'img', '/home/illumin/public_html/application/view///backend/category/index.tpl', 69, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/category/index.tpl', 154, false),array('function', 'json', '/home/illumin/public_html/application/view///backend/category/index.tpl', 206, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/category/index.tpl', 56, false),array('block', 'allowed', '/home/illumin/public_html/application/view///backend/category/index.tpl', 106, false),array('block', 'tabControl', '/home/illumin/public_html/application/view///backend/category/index.tpl', 153, false),array('block', 'tab', '/home/illumin/public_html/application/view///backend/category/index.tpl', 154, false),array('modifier', 'addslashes', '/home/illumin/public_html/application/view///backend/category/index.tpl', 198, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/category/index.tpl', 201, false),)), $this); ?>
<?php echo smarty_function_includeJs(array('file' => "library/livecart.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/KeyboardEvent.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/ActiveGrid.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/ActiveList.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/ActiveForm.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/State.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/Validator.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlxtree/dhtmlXCommon.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlxtree/dhtmlXTree.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/TabControl.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/lightbox/lightbox.js"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "library/rico/ricobase.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/rico/ricoLiveGrid.js"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "backend/Product.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/Category.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/SpecField.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/Filter.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/ObjectImage.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/Product.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/abstract/ProductListCommon.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/RelatedProduct.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/ProductCategory.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/CategoryRelationship.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/ProductList.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/ProductFile.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/ProductOption.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/ProductBundle.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/ProductVariation.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/RatingType.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/Review.js"), $this);?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo smarty_function_includeCss(array('file' => "library/ActiveList.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/ActiveGrid.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/Category.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/Product.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/SpecField.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/ProductRelationship.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/ProductBundle.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/ProductCategory.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/ProductFile.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/ProductOption.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/ProductVariation.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/Filter.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/CategoryImage.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/RatingType.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/Review.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/TabControl.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/Eav.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/dhtmlxtree/dhtmlXTree.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/lightbox/lightbox.css"), $this);?>


<?php $this->_tag_stack[] = array('pageTitle', array('help' => 'cat')); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><span id="activeCategoryPath"></span><span id="activeProductPath" style="display: none;"><span id="productCategoryPath"></span><span id="activeProductName"></span></span><span style="display: none;"><?php echo smarty_function_translate(array('text' => '_products_and_categories'), $this);?>
</span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="specField_item_blank" class="dom_template"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/specField/form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<div id="specField_group_blank" class="dom_template"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/specField/group.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<div id="filter_item_blank" class="dom_template"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/filterGroup/form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<div id="productFileGroup_item_blank"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/productFileGroup/form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<div id="productFile_item_blank"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/productFile/form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<div id="productOption_item_blank" class="dom_template"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/productOption/form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>

<div id="confirmations">
	<div id="redZone">
		<div id="productRelationshipCreateFailure" class="redMessage" style="display: none;">
			<?php echo smarty_function_img(array('class' => 'closeMessage','src' => "image/silk/cancel.png"), $this);?>

			<div><?php echo smarty_function_translate(array('text' => '_could_not_create_product_relationship'), $this);?>
</div>
		</div>
		<div id="productFileSaveFailure" class="redMessage" style="display: none;">
			<?php echo smarty_function_img(array('class' => 'closeMessage','src' => "image/silk/cancel.png"), $this);?>

			<div><?php echo smarty_function_translate(array('text' => '_could_not_save_product_file'), $this);?>
</div>
		</div>
		<div id="productImageSaveFailure" class="redMessage" style="display: none;">
			<?php echo smarty_function_img(array('class' => 'closeMessage','src' => "image/silk/cancel.png"), $this);?>

			<div><?php echo smarty_function_translate(array('text' => '_could_not_save_product_image'), $this);?>
</div>
		</div>
	</div>
	<div id="yellowZone">
		<div id="categoryImageSaved" class="yellowMessage" style="display: none;">
			<?php echo smarty_function_img(array('class' => 'closeMessage','src' => "image/silk/cancel.png"), $this);?>

			<div><?php echo smarty_function_translate(array('text' => '_category_image_was_successfully_saved'), $this);?>
</div>
		</div>
		<div id="productImageSaved" class="yellowMessage" style="display: none;">
			<?php echo smarty_function_img(array('class' => 'closeMessage','src' => "image/silk/cancel.png"), $this);?>

			<div><?php echo smarty_function_translate(array('text' => '_product_image_was_successfully_saved'), $this);?>
</div>
		</div>
		<div id="productFileSaved" class="yellowMessage" style="display: none;">
			<?php echo smarty_function_img(array('class' => 'closeMessage','src' => "image/silk/cancel.png"), $this);?>

			<div><?php echo smarty_function_translate(array('text' => '_product_file_was_successfully_saved'), $this);?>
</div>
		</div>
		<div id="productRelationshipCreated" class="yellowMessage" style="display: none;">
			<?php echo smarty_function_img(array('class' => 'closeMessage','src' => "image/silk/cancel.png"), $this);?>

			<div><?php echo smarty_function_translate(array('text' => '_a_relationship_between_products_was_successfully_created'), $this);?>
</div>
		</div>
	</div>
</div>

<div id="catgegoryContainer" class="treeContainer  maxHeight h--60">
	<div id="categoryBrowser" class="treeBrowser"></div>

	<br />

	<?php $this->_tag_stack[] = array('allowed', array('role' => "category.create,category.remove,category.sort")); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php echo smarty_function_translate(array('text' => '_with_selected_category'), $this);?>
:

		<ul id="categoryBrowserActions" class="verticalMenu">

			<?php $this->_tag_stack[] = array('allowed', array('role' => "category.create")); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<li class="addTreeNode">
					<a href="#" id="createNewCategoryLink">
						<?php echo smarty_function_translate(array('text' => '_create_subcategory'), $this);?>

					</a>
				</li>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

			<?php $this->_tag_stack[] = array('allowed', array('role' => "category.sort")); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<li class="moveUpTreeNode">
					<a href="#" id="moveCategoryUp">
						<?php echo smarty_function_translate(array('text' => '_move_category_up'), $this);?>

					</a>
				</li>
				<li class="moveDownTreeNode">
					<a href="#" id="moveCategoryDown">
						<?php echo smarty_function_translate(array('text' => '_move_category_down'), $this);?>

					</a>
				</li>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

			<?php $this->_tag_stack[] = array('allowed', array('role' => "category.remove")); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<li class="removeTreeNode">
					<a href="#" id="removeCategoryLink">
						<?php echo smarty_function_translate(array('text' => '_remove_category'), $this);?>

					</a>
				</li>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</ul>

	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</div>

<div id="managerContainer" class="treeManagerContainer maxHeight h--60">

	<div id="loadingProduct" style="display: none; position: absolute; text-align: center; width: 100%; padding-top: 200px; z-index: 50000;">
		<span style="padding: 40px; background-color: white; border: 1px solid black;"><?php echo smarty_function_translate(array('text' => '_loading_product'), $this);?>
<span class="progressIndicator"></span></span>
	</div>

	<div id="categoryTabs">
		<div id="tabContainer" class="tabContainer">
			<?php $this->_tag_stack[] = array('tabControl', array('id' => 'tabList')); $_block_repeat=true;smarty_block_tabControl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php $this->_tag_stack[] = array('tab', array('id' => 'tabProducts','role' => 'product','help' => 'products')); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.product",'action' => 'index','id' => '_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_products'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php $this->_tag_stack[] = array('tab', array('id' => 'tabMainDetails','role' => 'category','help' => "categories.details")); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.category",'action' => 'form','id' => '_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_category_details'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php $this->_tag_stack[] = array('tab', array('id' => 'tabFields','role' => 'category','help' => "categories.attributes")); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.specField",'action' => 'index','id' => '_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_attributes'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php $this->_tag_stack[] = array('tab', array('id' => 'tabFilters','role' => 'filter','help' => "categories.filters")); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.filterGroup",'action' => 'index','id' => '_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_filters'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php $this->_tag_stack[] = array('tab', array('id' => 'tabImages','role' => 'category','help' => "categories.images")); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.categoryImage",'action' => 'index','id' => '_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_images'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php $this->_tag_stack[] = array('tab', array('id' => 'tabOptions','role' => 'option','help' => 'categories')); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.productOption",'action' => 'index','id' => '_id_','query' => "category=true"), $this);?>
"><?php echo smarty_function_translate(array('text' => '_options'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php $this->_tag_stack[] = array('tab', array('id' => 'tabRatingCategories','role' => 'ratingcategory','help' => 'categories','hidden' => true)); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.ratingType",'action' => 'index','id' => '_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_rating_categories'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php $this->_tag_stack[] = array('tab', array('id' => 'tabReviews','role' => 'ratingcategory','help' => 'categories','hidden' => true)); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.review",'action' => 'index','id' => '_id_','query' => "category=true"), $this);?>
"><?php echo smarty_function_translate(array('text' => '_reviews'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php $this->_tag_stack[] = array('tab', array('id' => 'tabProductLists','role' => 'ratingcategory','help' => 'categories','hidden' => true)); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.productList",'action' => 'index','id' => '_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_product_lists'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php $this->_tag_stack[] = array('tab', array('id' => 'tabRelatedCategory','role' => 'category','help' => 'categories','hidden' => true)); $_block_repeat=true;smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo smarty_function_link(array('controller' => "backend.categoryRelationship",'action' => 'index','id' => '_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_related_categories'), $this);?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tab($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tabControl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</div>
		<div id="sectionContainer" class="sectionContainer maxHeight  h--50">
		</div>
	</div>

	<div id="addProductContainer" style="display: none;"></div>
</div>

<script type="text/javascript">
	<?php $this->_tag_stack[] = array('allowed', array('role' => "category.sort")); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		Backend.Category.allowSorting = true;
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	<?php $this->_tag_stack[] = array('allowed', array('role' => 'product')); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		Backend.Product.productsMiscPermision = true;
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	Backend.showContainer('managerContainer');

	/**
	 * URL assigment for internal javascript requests
	 */
	Backend.Category.links = <?php echo '{}'; ?>
;
	Backend.Category.links.popup  = '<?php echo smarty_function_link(array('controller' => "backend.category",'action' => 'popup'), $this);?>
';
	Backend.Category.links.create  = '<?php echo smarty_function_link(array('controller' => "backend.category",'action' => 'create','id' => '_id_'), $this);?>
';
	Backend.Category.links.remove  = '<?php echo smarty_function_link(array('controller' => "backend.category",'action' => 'remove','id' => '_id_'), $this);?>
';
	Backend.Category.links.countTabsItems = '<?php echo smarty_function_link(array('controller' => "backend.category",'action' => 'countTabsItems','id' => '_id_'), $this);?>
';
	Backend.Category.links.reorder = '<?php echo smarty_function_link(array('controller' => "backend.category",'action' => 'reorder','id' => '_id_','query' => "parentId=_pid_&direction=_direction_"), $this);?>
';
	Backend.Category.links.categoryAutoloading = '<?php echo smarty_function_link(array('controller' => "backend.category",'action' => 'xmlBranch'), $this);?>
';
	Backend.Category.links.categoryRecursiveAutoloading = '<?php echo smarty_function_link(array('controller' => "backend.category",'action' => 'xmlRecursivePath'), $this);?>
';
	Backend.Category.links.addProduct  = '<?php echo smarty_function_link(array('controller' => "backend.product",'action' => 'add','id' => '_id_'), $this);?>
';

	Backend.Category.messages = <?php echo '{}'; ?>
;
	Backend.Category.messages._reorder_failed = '<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_reorder_failed'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__reorder_failed', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__reorder_failed'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
';
	Backend.Category.messages._confirm_category_remove = '<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_confirm_category_remove'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__confirm_category_remove', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__confirm_category_remove'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
';
	Backend.Category.messages._confirm_category_remove = '<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_confirm_category_remove'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__confirm_category_remove', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__confirm_category_remove'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
';
	Backend.Category.messages._confirm_move = '<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_confirm_move'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__confirm_move', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__confirm_move'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
';

	Backend.Category.init();

	Backend.Category.treeBrowser.setXMLAutoLoading(Backend.Category.links.categoryAutoloading);
	Backend.Category.addCategories(<?php echo smarty_function_json(array('array' => $this->_tpl_vars['categoryList']), $this);?>
);
	CategoryTabControl.prototype.loadCategoryTabsCount(<?php echo smarty_function_json(array('array' => $this->_tpl_vars['allTabsCount']), $this);?>
);

	Backend.Category.activeCategoryId = Backend.Category.treeBrowser.getSelectedItemId();
	Backend.Category.initPage();

	Backend.Category.loadBookmarkedCategory();

	Backend.Category.showControls();
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/product/tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script>
	Backend.Category.loadBookmarkedProduct();
</script>

<div id="specFieldSection"></div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>