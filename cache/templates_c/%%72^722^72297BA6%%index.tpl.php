<?php /* Smarty version 2.6.26, created on 2015-12-02 13:45:52
         compiled from /home/illumin/public_html/application/view///backend/product/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', '/home/illumin/public_html/application/view///backend/product/index.tpl', 4, false),array('function', 'backendProductUrl', '/home/illumin/public_html/application/view///backend/product/index.tpl', 5, false),array('function', 'renderBlock', '/home/illumin/public_html/application/view///backend/product/index.tpl', 9, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/product/index.tpl', 17, false),array('function', 'activeGrid', '/home/illumin/public_html/application/view///backend/product/index.tpl', 24, false),array('block', 'denied', '/home/illumin/public_html/application/view///backend/product/index.tpl', 13, false),array('modifier', 'addslashes', '/home/illumin/public_html/application/view///backend/product/index.tpl', 91, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
	Backend.Product.Editor.prototype.links = {};
	Backend.Product.Editor.prototype.links.countTabsItems = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.product",'action' => 'countTabsItems'), $this);?>
<?php echo '\';
	Backend.Product.GridFormatter.productUrl = \''; ?>
<?php echo smarty_function_backendProductUrl(array(), $this);?>
<?php echo '\';
</script>
'; ?>


<?php echo smarty_function_renderBlock(array('block' => 'TRANSLATIONS'), $this);?>


<div>

<fieldset class="container" <?php $this->_tag_stack[] = array('denied', array('role' => "product.create")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
	<ul class="menu">
		<li class="addProduct">
			<a href="#" onclick="Backend.Product.showAddForm(<?php echo $this->_tpl_vars['categoryID']; ?>
, this); return false;">
				<?php echo smarty_function_translate(array('text' => '_add_product'), $this);?>

			</a>
			<span class="progressIndicator" style="display: none;"></span>
		</li>
	</ul>
</fieldset>

<?php echo smarty_function_activeGrid(array('prefix' => 'products','id' => $this->_tpl_vars['categoryID'],'role' => "product.mass",'controller' => "backend.product",'action' => 'lists','displayedColumns' => $this->_tpl_vars['displayedColumns'],'availableColumns' => $this->_tpl_vars['availableColumns'],'totalCount' => $this->_tpl_vars['totalCount'],'filters' => $this->_tpl_vars['filters'],'container' => 'tabProducts','dataFormatter' => "Backend.Product.GridFormatter",'count' => "backend/product/count.tpl",'massAction' => "backend/product/massAction.tpl",'advancedSearch' => true), $this);?>


<li class="detailedExport" id="detailedExportContainer_<?php echo $this->_tpl_vars['categoryID']; ?>
">
	<a href="#" onclick="var grid = window.activeGrids['products_<?php echo $this->_tpl_vars['categoryID']; ?>
']; window.location.href='<?php echo smarty_function_link(array('controller' => "backend.product",'action' => 'exportDetailed'), $this);?>
?' + grid.ricoGrid.getQueryString()+ '&selectedIDs=' + grid.getSelectedIDs().toJSON() + '&isInverse=' + (grid.isInverseSelection() ? 1 : 0); return false;">Export Variations</a>
</li>

<?php echo '
<script type="text/javascript">

	var detailedExport = $(\'detailedExportContainer_'; ?>
<?php echo $this->_tpl_vars['categoryID']; ?>
<?php echo '\');
	var menu = detailedExport.up(\'.tabPageContainer\').down(\'.activeGridColumns\').down(\'.menu\', 1);
	menu.insertBefore(detailedExport, menu.firstChild);
</script>
'; ?>


</div>

<?php echo '
<script type="text/javascript">
'; ?>


	var massHandler = new ActiveGrid.MassActionHandler(
						$('productMass_<?php echo $this->_tpl_vars['categoryID']; ?>
'),
						window.activeGrids['products_<?php echo $this->_tpl_vars['categoryID']; ?>
'],
<?php echo '
						{
							\'onComplete\':
								function()
								{
									Backend.Product.resetEditors();

									var parentId = '; ?>
<?php echo $this->_tpl_vars['categoryID']; ?>
<?php echo ';
									var massForm = $(\'productMass_\' + parentId).down(\'form\');
									parentId = Backend.Category.treeBrowser.getParentId(parentId);

									do
									{
										Backend.Product.reloadGrid(parentId);
										parentId = Backend.Category.treeBrowser.getParentId(parentId);
									}
									while(parentId != 0);

									// reload grid of target category if products were moved
									var movedCat = massForm.elements.namedItem(\'categoryID\');
									if (movedCat.value)
									{
										Backend.Product.reloadGrid(movedCat.value);
									}

									movedCat.value = null;
								}
						}
'; ?>

						);
	massHandler.deleteConfirmMessage = '<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_delete_conf'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__delete_conf', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__delete_conf'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
' ;
	massHandler.nothingSelectedMessage = '<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_nothing_selected'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__nothing_selected', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__nothing_selected'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
' ;
<?php echo '
</script>
'; ?>