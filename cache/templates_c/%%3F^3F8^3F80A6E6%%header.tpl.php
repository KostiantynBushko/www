<?php /* Smarty version 2.6.26, created on 2015-12-01 10:53:47
         compiled from custom:layout/backend/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'renderBlock', 'custom:layout/backend/header.tpl', 4, false),array('function', 'link', 'custom:layout/backend/header.tpl', 13, false),array('function', 'translate', 'custom:layout/backend/header.tpl', 13, false),array('function', 'backendLangMenu', 'custom:layout/backend/header.tpl', 21, false),array('function', 'img', 'custom:layout/backend/header.tpl', 28, false),array('function', 'backendMenu', 'custom:layout/backend/header.tpl', 34, false),array('modifier', 'config', 'custom:layout/backend/header.tpl', 12, false),array('modifier', 'or', 'custom:layout/backend/header.tpl', 28, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/meta.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="topAuthInfo">
	<?php echo smarty_function_renderBlock(array('block' => 'USER_MENU'), $this);?>

</div>

<div id="pageContainer">

	<div id="pageHeader">

		<div id="systemMenu">
				<?php if (((is_array($_tmp='BACKEND_SHOW_HELP')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
					<a id="updates-link" <?php if (((is_array($_tmp='MODULE_STATS_NEED_UPDATING')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>class="updateAvailable"<?php endif; ?> href="<?php echo smarty_function_link(array('controller' => "backend.module"), $this);?>
"><?php echo smarty_function_translate(array('text' => '_modules_updates'), $this);?>
</a>
					<?php if (((is_array($_tmp='MODULE_STATS_NEED_UPDATING')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
						<span id="moduleUpdateAvailable">(<?php echo ((is_array($_tmp='MODULE_STATS_NEED_UPDATING')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
)</span>
					<?php endif; ?>
					|
				<?php endif; ?>
				<a id="help" href="#" target="_blank" <?php if (! ((is_array($_tmp='BACKEND_SHOW_HELP')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>style="display:none;"<?php endif; ?>><?php echo smarty_function_translate(array('text' => '_base_help'), $this);?>
</a>
				<?php if (((is_array($_tmp='BACKEND_SHOW_HELP')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?> | <?php endif; ?>
				<?php echo smarty_function_backendLangMenu(array(), $this);?>

				<a href="<?php echo smarty_function_link(array(), $this);?>
" target="_blank"><?php echo smarty_function_translate(array('text' => '_frontend'), $this);?>
</a> |
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/quickSearch/form.tpl", 'smarty_include_vars' => array('formid' => 'QuickSearch','hint' => '_hint_quick_search')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

		<div id="topLogoImageContainer">
			<a href="<?php echo smarty_function_link(array('controller' => "backend.index",'action' => 'index'), $this);?>
">
				<?php echo smarty_function_img(array('src' => smarty_modifier_or(((is_array($_tmp='BACKEND_LOGO_SMALL')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)), "image/promo/transparentlogo_small.png"),'id' => 'topLogoImage'), $this);?>

			</a>
		</div>

		<div id="navContainer">
			<div id="nav"></div>
			<?php echo smarty_function_backendMenu(array(), $this);?>

			<div class="clear"></div>
		</div>

	</div>

	<div id="pageTitleContainer">
		<div id="pageTitle"><?php echo $this->_tpl_vars['PAGE_TITLE']; ?>
</div>
		<div id="breadcrumb_template" class="dom_template">
			<span class="breadcrumb_item"><a href=""></a></span>
			<span class="breadcrumb_separator"> &gt; </span>
			<span class="breadcrumb_lastItem"></span>
		</div>
		<div id="breadcrumb"></div>
	</div>

	<div id="pageContentContainer">

		<div id="pageContentInnerContainer" class="maxHeight h--20"  >