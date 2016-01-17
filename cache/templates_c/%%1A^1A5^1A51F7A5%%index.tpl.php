<?php /* Smarty version 2.6.26, created on 2015-12-01 10:57:02
         compiled from /home/illumin/public_html/application/view///backend/theme/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeJs', '/home/illumin/public_html/application/view///backend/theme/index.tpl', 1, false),array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/theme/index.tpl', 12, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/theme/index.tpl', 25, false),array('function', 'textfield', '/home/illumin/public_html/application/view///backend/theme/index.tpl', 38, false),array('function', 'filefield', '/home/illumin/public_html/application/view///backend/theme/index.tpl', 61, false),array('function', 'maketext', '/home/illumin/public_html/application/view///backend/theme/index.tpl', 63, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/theme/index.tpl', 110, false),array('function', 'renderBlock', '/home/illumin/public_html/application/view///backend/theme/index.tpl', 121, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/theme/index.tpl', 25, false),array('block', 'form', '/home/illumin/public_html/application/view///backend/theme/index.tpl', 35, false),array('block', 'error', '/home/illumin/public_html/application/view///backend/theme/index.tpl', 40, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/theme/index.tpl', 45, false),)), $this); ?>
<?php echo smarty_function_includeJs(array('file' => "library/dhtmlxtree/dhtmlXCommon.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlxtree/dhtmlXTree.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/Validator.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/ActiveForm.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/TabControl.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/jscolor/jscolor.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "frontend/Customize.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/Theme.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/editarea/edit_area_full.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/CssEditor.js"), $this);?>


<?php echo smarty_function_includeCss(array('file' => "library/dhtmlxtree/dhtmlXTree.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/TabControl.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/Theme.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/CssEditor.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "library/ActiveList.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/ActiveList.css"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/ThemeFile.js"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "library/lightbox/lightbox.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/lightbox/lightbox.css"), $this);?>



<?php $this->_tag_stack[] = array('pageTitle', array('help' => "content.pages")); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_themes'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="themeContainer">
	<div class="treeContainer">
		<div id="pageBrowser" class="treeBrowser"></div>

		<ul class="verticalMenu">
			<li id="addMenu" class="addTreeNode"><a href="" onclick="pageHandler.showAddForm(); return false;"><?php echo smarty_function_translate(array('text' => '_add_new'), $this);?>
</a></li>
			<fieldset id="addForm" style="display: none;">
				<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.theme action=add",'method' => 'POST','handle' => $this->_tpl_vars['addForm'],'onsubmit' => "pageHandler.addTheme(); return false;")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					
						<label for="name"><span class="label"><?php echo smarty_function_translate(array('text' => '_theme_name'), $this);?>
 </span></label>:
						<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'name','class' => 'text themeName'), $this);?>

					
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'name')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'name')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>

					<div>
						<span class="progressIndicator" style="display: none;"></span>
						<input type="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_add','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" class="submit" />
						<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

						<a class="cancel" href="#" onclick="pageHandler.hideAddForm(); return false;"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
					</div>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</fieldset>

			<li id="importMenu" class="importTreeNode"><a href="" onclick="pageHandler.importTheme(); return false;"><?php echo smarty_function_translate(array('text' => '_import_theme'), $this);?>
</a></li>
			<fieldset id="importForm" style="display: none;">
				<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['importForm'],'action' => "controller=backend.theme action=import",'target' => 'themeImportTarget','method' => 'POST','enctype' => "multipart/form-data",'autocomplete' => 'off')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<span class="progressIndicator" style="display: none;"></span>
					<p class="required">
						
							<label for="file"><span class="label"><?php echo smarty_function_translate(array('text' => '_select_file'), $this);?>
: </span></label>
							<fieldset class="error"><?php echo smarty_function_filefield(array('name' => 'theme','value' => ""), $this);?>

							<br />
							<span class="maxFileSize"><?php echo smarty_function_maketext(array('text' => '_max_file_size','params' => $this->_tpl_vars['maxSize']), $this);?>
</span>
						
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'file')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'file')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
					</p>
					
					<fieldset class="controls">
						<span class="progressIndicator" style="display: none;"></span>
						<input type="submit" name="upload" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_import','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
"> 
						<?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 
						<a class="cancel" href="#" onclick="pageHandler.hideImportForm(); return false;"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
					</fieldset>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<iframe name="themeImportTarget" id="themeImportTarget" style="display:none"></iframe>
			</fieldset>

			<li id="copyMenu" class="exportTreeNode"><a href="" onclick="pageHandler.showCopyForm(); return false;"><?php echo smarty_function_translate(array('text' => '_copy_theme'), $this);?>
</a></li>
			<fieldset id="copyForm" style="display: none;">
				<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.theme action=copyTheme",'method' => 'POST','handle' => $this->_tpl_vars['copyForm'],'onsubmit' => "pageHandler.copyTheme(); return false;")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<input type="hidden" name="id" value="" id="copyFromID" />
					
						<label for="name"><span class="label"><?php echo smarty_function_translate(array('text' => '_theme_name'), $this);?>
 </span></label>:
						<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'name','class' => 'text themeName'), $this);?>

					
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'name')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'name')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>

					<div>
						<span class="progressIndicator" id="copyFormProgressIndicator" style="display: none;"></span>
						<input type="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_copy','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" class="submit" />
						<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

						<a class="cancel" href="#" onclick="pageHandler.hideCopyForm(); return false;"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
					</div>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</fieldset>

			<li id="exportMenu" class="exportTreeNode"><a href="" onclick="pageHandler.exportSelected(); return false;"><?php echo smarty_function_translate(array('text' => '_export_theme'), $this);?>
</a></li>
			<li id="removeMenu" class="removeTreeNode"><a href="" onclick="pageHandler.deleteSelected(); return false;"><?php echo smarty_function_translate(array('text' => '_remove'), $this);?>
</a></li>

		</ul>
	</div>

	<div class="treeManagerContainer maxHeight h--100">
		<div id="tabContainer">
			<div class="tabContainer">
				<ul class="tabList tabs">
					<li id="tabSettings" class="tab active">
						<a href="<?php echo smarty_function_link(array('controller' => "backend.theme",'action' => 'edit','query' => 'id=_id_'), $this);?>
"}"><?php echo smarty_function_translate(array('text' => '_settings'), $this);?>
</a>
					</li>
					<li id="tabColors" class="tab">
						<a href="<?php echo smarty_function_link(array('controller' => "backend.theme",'action' => 'colors','query' => 'id=_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_colors'), $this);?>
</a>
					</li>
					<li id="tabCss" class="tab">
						<a href="<?php echo smarty_function_link(array('controller' => "backend.cssEditor",'action' => 'edit','query' => 'file=_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_css'), $this);?>
</a>
					</li>
					<li id="tabFiles" class="tab">
						<a href="<?php echo smarty_function_link(array('controller' => "backend.themeFile",'action' => 'index','query' => 'id=_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_files'), $this);?>
</a>
					</li>
					<?php echo smarty_function_renderBlock(array('block' => 'THEME_TABS'), $this);?>

				</ul>
			</div>
			<div class="sectionContainer maxHeight h--50"></div>
		</div>
	</div>
</div>

<?php echo '
<script type="text/javascript">
	var pageHandler = new Backend.Theme('; ?>
<?php echo $this->_tpl_vars['themes']; ?>
<?php echo ');
	pageHandler.urls[\'edit\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.theme",'action' => 'edit'), $this);?>
?id=_id_<?php echo '\';
	pageHandler.urls[\'add\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.theme",'action' => 'add'), $this);?>
<?php echo '\';
	pageHandler.urls[\'delete\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.theme",'action' => 'delete'), $this);?>
?id=_id_<?php echo '\';
	pageHandler.urls[\'moveup\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.theme",'action' => 'reorder'), $this);?>
?order=up&id=_id_<?php echo '\';
	pageHandler.urls[\'movedown\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.theme",'action' => 'reorder'), $this);?>
?order=down&id=_id_<?php echo '\';
	pageHandler.urls[\'empty\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.theme",'action' => 'emptyPage'), $this);?>
<?php echo '\';
	pageHandler.urls[\'create\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.theme",'action' => 'create'), $this);?>
<?php echo '\';
	pageHandler.urls[\'update\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.theme",'action' => 'update'), $this);?>
<?php echo '\';
	pageHandler.urls[\'export\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.theme",'action' => 'export'), $this);?>
?id=_id_<?php echo '\';
</script>
'; ?>


<div class="clear"></div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>