<?php /* Smarty version 2.6.26, created on 2015-12-01 10:54:13
         compiled from /home/illumin/public_html/application/view///backend/template/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeJs', '/home/illumin/public_html/application/view///backend/template/index.tpl', 1, false),array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/template/index.tpl', 9, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/template/index.tpl', 15, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/template/index.tpl', 24, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/template/index.tpl', 15, false),)), $this); ?>
<?php echo smarty_function_includeJs(array('file' => "library/livecart.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/ActiveForm.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/State.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/Validator.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlxtree/dhtmlXCommon.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlxtree/dhtmlXTree.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/Template.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/TabControl.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/TabControl.css"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/editarea/edit_area_full.js"), $this);?>


<?php echo smarty_function_includeCss(array('file' => "backend/Template.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/dhtmlxtree/dhtmlXTree.css"), $this);?>


<?php $this->_tag_stack[] = array('pageTitle', array('help' => "customize.templates")); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_edit_templates'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="templatePageContainer">
	<div class="treeContainer">
		<div id="templateBrowser" class="treeBrowser"></div>

		<ul id="categoryBrowserActions" class="verticalMenu">
			<li class="addTreeNode" id="createTemplate">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.template",'action' => 'add','query' => "tabid=_tabid_"), $this);?>
">
					<?php echo smarty_function_translate(array('text' => '_create_template'), $this);?>

				</a>
			</li>
			<li class="removeTreeNode" id="deleteTemplate" style="display: none;">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.template",'action' => 'delete','query' => "file=_id_"), $this);?>
">
					<?php echo smarty_function_translate(array('text' => '_delete_template'), $this);?>

				</a>
			</li>
		</ul>

	</div>

	<div class="treeManagerContainer">
		<div class="templateContent">
			<div id="templateTabContainer" class="tabContainer" style="height:100%">
				<div id="loadingNewsletter" style="display: none; position: absolute; text-align: center; width: 100%; padding-top: 200px; z-index: 50000;">
					<span style="padding: 40px; background-color: white; border: 1px solid black;"><?php echo smarty_function_translate(array('text' => '_loading_newsletter'), $this);?>
<span class="progressIndicator"></span></span>
				</div>
				<ul class="tabList tabs">
				</ul>
				<div class="sectionContainer" style="display:none;">
				</div>
				<div class="notabsContainer">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/template/emptyPage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo '
<script type="text/javascript">
	var settings = new Backend.Template('; ?>
<?php echo $this->_tpl_vars['categories']; ?>
<?php echo ');
	settings.urls[\'edit\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.template",'action' => 'edit','query' => "file=_id_&tabid=_tabid_"), $this);?>
<?php echo '\';
	settings.urls[\'empty\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.template",'action' => 'emptyPage'), $this);?>
<?php echo '\';
	settings.urls[\'templateData\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.template",'action' => 'templateData','query' => "file=_id_&tabid=_tabid_&theme=_theme_&version=_version_"), $this);?>
<?php echo '\';
	settings.translations[\'_tab_title_new\'] = "'; ?>
<?php echo smarty_function_translate(array('text' => '_tab_title_new'), $this);?>
<?php echo '";
	settings.setTabControlInstance(
		TabControl.prototype.getInstance(
			\'templateTabContainer\',
			Backend.Template.prototype.getTabUrl,
			Backend.Template.prototype.getContentTabId,
			{
				afterClick:settings.tabAfterClickCallback.bind(settings)
			}
		)
	);
</script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>