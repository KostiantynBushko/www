<?php /* Smarty version 2.6.26, created on 2015-12-01 10:53:59
         compiled from /home/illumin/public_html/application/view///backend/module/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeJs', '/home/illumin/public_html/application/view///backend/module/index.tpl', 1, false),array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/module/index.tpl', 5, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/module/index.tpl', 7, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/module/index.tpl', 13, false),array('function', 'json', '/home/illumin/public_html/application/view///backend/module/index.tpl', 20, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/module/index.tpl', 7, false),)), $this); ?>
<?php echo smarty_function_includeJs(array('file' => "library/form/ActiveForm.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/Validator.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/State.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/Module.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/Module.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/ActiveList.css"), $this);?>

<?php $this->_tag_stack[] = array('pageTitle', array('help' => "settings.modules")); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_modules'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<ul class="menu" id="module-menu">
	<li id="download-modules" class="download-modules"><a href="#"><?php echo smarty_function_translate(array('text' => '_add_modules'), $this);?>
</a></li>
	<li id="manage-repos"><a href="<?php echo smarty_function_link(array('controller' => "backend.settings"), $this);?>
#section_095-updates__"><?php echo smarty_function_translate(array('text' => '_manage_module_repositories'), $this);?>
</a></li>
	<li class="cancel download-modulesCancel" style="display: none;"><a href="#" class="cancel"><?php echo smarty_function_translate(array('text' => '_cancel_adding_modules'), $this);?>
</a></li>
</ul>

<div id="download-modules-container" class="slideForm"></div>

<script type="text/javascript">
	new Backend.Module.downloadManager('<?php echo smarty_function_json(array('array' => $this->_tpl_vars['repos']), $this);?>
');
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:block/message.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<ul id="moduleList" class="activeList">
	<fieldset id="just-installed" class="type_justInstalled" style="display: none;">
		<legend><?php echo smarty_function_translate(array('text' => '_module_type_justInstalled'), $this);?>
</legend>
	</fieldset>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/module/list.tpl", 'smarty_include_vars' => array('type' => 'needUpdate')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/module/list.tpl", 'smarty_include_vars' => array('type' => 'enabled')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/module/list.tpl", 'smarty_include_vars' => array('type' => 'notEnabled')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/module/list.tpl", 'smarty_include_vars' => array('type' => 'notInstalled')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div class="clear"></div>
</ul>
<div class="clear"></div>

<?php echo '
	<script type="text/javascript">
		window.moduleManager = new Backend.Module($(\'moduleList\'));
	</script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>