<?php /* Smarty version 2.6.26, created on 2015-12-01 10:56:32
         compiled from /home/illumin/public_html/application/view///backend/settings/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeJs', '/home/illumin/public_html/application/view///backend/settings/index.tpl', 1, false),array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/settings/index.tpl', 9, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/settings/index.tpl', 13, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/settings/index.tpl', 35, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/settings/index.tpl', 13, false),array('modifier', 'branding', '/home/illumin/public_html/application/view///backend/settings/index.tpl', 13, false),)), $this); ?>
<?php echo smarty_function_includeJs(array('file' => "library/dhtmlxtree/dhtmlXCommon.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlxtree/dhtmlXTree.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/Validator.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/ActiveForm.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/Settings.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/User.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/lightbox/lightbox.js"), $this);?>


<?php echo smarty_function_includeCss(array('file' => "library/dhtmlxtree/dhtmlXTree.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/Settings.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/lightbox/lightbox.css"), $this);?>


<?php $this->_tag_stack[] = array('pageTitle', array('help' => "settings.configuration")); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_livecart_settings'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__livecart_settings', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__livecart_settings'])) ? $this->_run_mod_handler('branding', true, $_tmp) : $this->_plugins['modifier']['branding'][0][0]->branding($_tmp)); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="settingsContainer" class="maxHeight h--50">
	<div class="treeContainer">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/quickSearch/form.tpl", 'smarty_include_vars' => array('limit' => 10,'hint' => '_hint_settings_search','formid' => 'SettingsSearch','classNames' => 'SearchableItem')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div id="settingsBrowser" class="treeBrowser"></div>
	</div>

	<span id="settingsIndicator"></span>

	<div id="settingsContent" class="treeManagerContainer maxHeight">
		<span class="progressIndicator"></span>
	</div>

</div>

<div id="activeSettingsPath" ></div>

<?php echo '
<script type="text/javascript">
	var settings = new Backend.Settings('; ?>
<?php echo $this->_tpl_vars['categories']; ?>
, <?php echo $this->_tpl_vars['settings']; ?>
<?php echo ');
	settings.urls[\'edit\'] = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.settings",'action' => 'edit'), $this);?>
?id=_id_<?php echo '\';
	Event.observe(window, \'load\', function() {settings.init();})
</script>
'; ?>


<div id="handlers" style="display: none;">
	<div id="handler_ENABLED_COUNTRIES" style="position: absolute; right: 0; z-index: 10; padding-right: 5px;">
		<a href="#" class="countrySelect"><?php echo smarty_function_translate(array('text' => '_select_all'), $this);?>
</a> | <a href="#" class="countryDeselect"><?php echo smarty_function_translate(array('text' => '_deselect_all'), $this);?>
</a>
	</div>

	<div id="handler_ENABLE_SITEMAPS">
		<a href="<?php echo smarty_function_link(array('controller' => 'sitemap','action' => 'ping'), $this);?>
" id="siteMapPing" class="menu"><?php echo smarty_function_translate(array('text' => '_sitemap_ping'), $this);?>
</a> |
		<a href="<?php echo smarty_function_link(array('controller' => 'sitemap'), $this);?>
" class="menu" target="_blank"><?php echo smarty_function_translate(array('text' => '_view_sitemap'), $this);?>
</a>
		<span class="progressIndicator" id="siteMapFeedback" style="display: none;"></span>
		<div id="siteMapSubmissionResult"></div>
	</div>

	<div id="handler_ENABLED_FEEDS">
		<a href="<?php echo smarty_function_link(array('controller' => 'xml','action' => 'export','module' => 'module','query' => "key=accessKey"), $this);?>
" target="_blank" style="margin-left: 0.5em;"><span style="font-size: smaller;">[<?php echo smarty_function_translate(array('text' => '_open_feed'), $this);?>
]</a></a>
	</div>

	<div id="handler_SOFT_NAME">
		<a href="<?php echo smarty_function_link(array('controller' => "backend.settings",'action' => 'disablePrivateLabel'), $this);?>
" id="disablePrivateLabel" class="menu"><?php echo smarty_function_translate(array('text' => '_disable_private_label_change'), $this);?>
</a>
		<span class="progressIndicator" style="display: none;"></span>
	</div>

	<div id="handler_UPDATE_COPY_METHOD">
		<a href="<?php echo smarty_function_link(array('controller' => "backend.update",'action' => 'testCopy'), $this);?>
" id="testUpdateCopy" class="menu"><?php echo smarty_function_translate(array('text' => '_test_update_copy'), $this);?>
</a>
		<span class="progressIndicator" style="display: none;"></span>
		<div id="testUpdateCopyResult"></div>
	</div>
</div>

<iframe id="upload" name="upload"></iframe>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>