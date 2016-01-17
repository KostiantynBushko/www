<?php /* Smarty version 2.6.26, created on 2015-12-01 10:57:57
         compiled from /home/illumin/public_html/application/view///backend/staticPage/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeJs', '/home/illumin/public_html/application/view///backend/staticPage/index.tpl', 1, false),array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/staticPage/index.tpl', 7, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/staticPage/index.tpl', 10, false),array('function', 'img', '/home/illumin/public_html/application/view///backend/staticPage/index.tpl', 29, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/staticPage/index.tpl', 49, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/staticPage/index.tpl', 10, false),array('block', 'denied', '/home/illumin/public_html/application/view///backend/staticPage/index.tpl', 20, false),)), $this); ?>
<?php echo smarty_function_includeJs(array('file' => "library/dhtmlxtree/dhtmlXCommon.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlxtree/dhtmlXTree.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/Validator.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/ActiveForm.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/StaticPage.js"), $this);?>


<?php echo smarty_function_includeCss(array('file' => "library/dhtmlxtree/dhtmlXTree.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/StaticPage.css"), $this);?>


<?php $this->_tag_stack[] = array('pageTitle', array('help' => "content.pages")); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_static_pages'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="staticPageContainer">
	<div class="treeContainer">
		<div id="pageBrowser" class="treeBrowser"></div>

		<ul class="verticalMenu">
			<li id="addMenu" class="addTreeNode" <?php $this->_tag_stack[] = array('denied', array('role' => "page.create")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none;"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>><a href="" onclick="pageHandler.showAddForm(); return false;"><?php echo smarty_function_translate(array('text' => '_add_new'), $this);?>
</a></li>
			<li id="moveUpMenu" class="moveUpTreeNode" <?php $this->_tag_stack[] = array('denied', array('role' => "page.sort")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none;"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>><a href="" onclick="pageHandler.moveUp(); return false;"><?php echo smarty_function_translate(array('text' => '_move_up'), $this);?>
</a></li>
			<li id="moveDownMenu" class="moveDownTreeNode" <?php $this->_tag_stack[] = array('denied', array('role' => "page.sort")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none;"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>><a href="" onclick="pageHandler.moveDown(); return false;"><?php echo smarty_function_translate(array('text' => '_move_down'), $this);?>
</a></li>
			<li id="removeMenu" class="removeTreeNode" <?php $this->_tag_stack[] = array('denied', array('role' => "page.remove")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none;"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>><a href="" onclick="pageHandler.deleteSelected(); return false;"><?php echo smarty_function_translate(array('text' => '_remove'), $this);?>
</a></li>
		</ul>
		
		<div id="confirmations">
			<div id="yellowZone">
				<div id="staticPageAdded" class="yellowMessage" style="display: none;">
					<?php echo smarty_function_img(array('class' => 'closeMessage','src' => "image/silk/cancel.png"), $this);?>

					<div><?php echo smarty_function_translate(array('text' => '_new_page_was_successfully_added'), $this);?>
</div>
				</div>
			</div>
		</div>
	</div>

	<div class="treeManagerContainer maxHeight h--100">
		<span id="settingsIndicator" class="progressIndicator" style="display: none;"></span>
				
		<div id="pageContent" class="maxHeight">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/staticPage/emptyPage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
</div>

<?php echo '
<script type="text/javascript">
	var pageHandler = new Backend.StaticPage('; ?>
<?php echo $this->_tpl_vars['pages']; ?>
<?php echo ');

	pageHandler.urls[\'edit\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.staticPage",'action' => 'edit'), $this);?>
?id=_id_<?php echo '\';
	pageHandler.urls[\'add\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.staticPage",'action' => 'add'), $this);?>
<?php echo '\';	
	pageHandler.urls[\'delete\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.staticPage",'action' => 'delete'), $this);?>
?id=_id_<?php echo '\';
	pageHandler.urls[\'moveup\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.staticPage",'action' => 'reorder'), $this);?>
?order=up&id=_id_<?php echo '\';
	pageHandler.urls[\'movedown\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.staticPage",'action' => 'reorder'), $this);?>
?order=down&id=_id_<?php echo '\';
	pageHandler.urls[\'empty\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.staticPage",'action' => 'emptyPage'), $this);?>
<?php echo '\';	
	pageHandler.urls[\'create\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.staticPage",'action' => 'create'), $this);?>
<?php echo '\';	
	pageHandler.urls[\'update\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.staticPage",'action' => 'update'), $this);?>
<?php echo '\';	

	// methods that need urls
	pageHandler.afterInit();

//	Event.observe(window, \'load\', function() {pageHandler.activateCategory(\'00-store\');})
</script>
'; ?>


<div class="clear"></div>

<div id="pageDelConf" style="display: none;"><?php echo smarty_function_translate(array('text' => '_del_conf'), $this);?>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>