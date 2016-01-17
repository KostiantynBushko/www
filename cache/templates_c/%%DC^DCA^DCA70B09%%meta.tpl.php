<?php /* Smarty version 2.6.26, created on 2015-12-01 10:53:37
         compiled from custom:layout/backend/meta.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:layout/backend/meta.tpl', 7, false),array('function', 'baseUrl', 'custom:layout/backend/meta.tpl', 8, false),array('function', 'includeCss', 'custom:layout/backend/meta.tpl', 15, false),array('function', 'compiledCss', 'custom:layout/backend/meta.tpl', 18, false),array('function', 'includeJs', 'custom:layout/backend/meta.tpl', 21, false),array('function', 'compiledJs', 'custom:layout/backend/meta.tpl', 39, false),array('function', 'localeCode', 'custom:layout/backend/meta.tpl', 92, false),array('function', 'link', 'custom:layout/backend/meta.tpl', 131, false),array('function', 'renderBlock', 'custom:layout/backend/meta.tpl', 134, false),array('function', 'img', 'custom:layout/backend/meta.tpl', 146, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title><?php echo ((is_array($_tmp='SOFT_NAME')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
 Admin - <?php echo $this->_tpl_vars['TITLE']; ?>
</title>
	<base href="<?php echo smarty_function_baseUrl(array(), $this);?>
" />

	<?php if (((is_array($_tmp='FAVICON')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<link href="<?php echo ((is_array($_tmp='FAVICON')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
" rel="shortcut icon" />
	<?php endif; ?>

	<!-- Css includes -->
	<?php echo smarty_function_includeCss(array('file' => "../javascript/library/tinymce/themes/advanced/css/editor_ui.css",'front' => true), $this);?>

	<?php echo smarty_function_includeCss(array('file' => "backend/stat.css",'front' => true), $this);?>

	<?php echo smarty_function_includeCss(array('file' => "backend/Backend.css",'front' => true), $this);?>

	<?php echo smarty_function_compiledCss(array('glue' => true,'nameMethod' => 'hash'), $this);?>


	<?php if (! ((is_array($_tmp='DISABLE_WYSIWYG')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<?php echo smarty_function_includeJs(array('file' => "library/tinymce/tiny_mce.js",'inline' => true), $this);?>

	<?php endif; ?>

	<?php echo smarty_function_includeJs(array('file' => "library/KeyboardEvent.js",'front' => true), $this);?>

	<?php echo smarty_function_includeJs(array('file' => "backend/Backend.js",'front' => true), $this);?>

	<?php echo smarty_function_includeJs(array('file' => "backend/QuickSearch.js"), $this);?>

	<?php echo smarty_function_includeJs(array('file' => "library/FooterToolbar.js",'front' => true), $this);?>

	<?php echo smarty_function_includeJs(array('file' => "library/livecart.js",'front' => true), $this);?>

	<?php echo smarty_function_includeJs(array('file' => "library/dhtmlHistory/dhtmlHistory.js"), $this);?>

	<?php echo smarty_function_includeJs(array('file' => "library/scriptaculous/dragdrop.js",'front' => true), $this);?>

	<?php echo smarty_function_includeJs(array('file' => "library/scriptaculous/slider.js",'front' => true), $this);?>

	<?php echo smarty_function_includeJs(array('file' => "library/scriptaculous/controls.js",'front' => true), $this);?>

	<?php echo smarty_function_includeJs(array('file' => "library/scriptaculous/builder.js",'front' => true), $this);?>

	<?php echo smarty_function_includeJs(array('file' => "library/scriptaculous/effects.js",'front' => true), $this);?>

	<?php echo smarty_function_includeJs(array('file' => "library/prototype/prototype.js",'front' => true), $this);?>


	<?php echo smarty_function_includeJs(array('file' => "backend/BackendToolbar.js"), $this);?>


	<?php echo smarty_function_compiledJs(array('glue' => true,'nameMethod' => 'hash'), $this);?>


	<?php echo '
	<script language="javascript" type="text/javascript">
	if(window.opener)
	{
	   try
	   {
			window.opener.selectPopupWindow = window;
	   }
	   catch (e)
	   {
			window.opener = null;
			// Permission denied to set property Window.selectPopupWindow
	   }
	}

	if (window.tinyMCE)
	{
		tinyMCE.init({
			theme : "advanced",
			mode : "exact",
			plugins: "table,contextmenu,paste",
			paste_insert_word_content_callback : "convertWord",
			paste_auto_cleanup_on_paste : true,
			elements : "",
			auto_reset_designmode : true,
			theme_advanced_resizing_use_cookie : false,
			theme_advanced_toolbar_location : "top",
			theme_advanced_resizing : true,
			theme_advanced_path_location : "bottom",
			document_base_url : "'; ?>
<?php echo smarty_function_baseUrl(array(), $this);?>
<?php echo '",
			remove_script_host : "true",
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,fontselect,fontsizeselect,formatselect,separator,forecolor,backcolor",
			theme_advanced_buttons2 : "bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,link,unlink,anchor,image,cleanup,separator,code,separator,table,separator,sub,sup,separator,charmap",
			theme_advanced_buttons3 : "",
			content_css: "'; ?>
<?php echo smarty_function_baseUrl(array(), $this);?>
<?php echo 'stylesheet/library/TinyMCE.css",
			forced_root_block : \'\',
			relative_urls : true,
			remove_linebreaks : false,
			extended_valid_elements : \'iframe[src|width|height|name|align|frameborder|scrolling|marginheight|marginwidth],embed[width|height|name|flashvars|src|bgcolor|align|play|loop|quality|allowscriptaccess|type|pluginspage]\',
			entities: \'\',
			file_browser_callback : "ajaxfilemanager"
		});
	}

	if (window.jscolor)
	{
		window.jscolor.dir = \'javascript/library/jscolor/\';
	}

	function onLoad()
	{
		Backend.locale = \''; ?>
<?php echo smarty_function_localeCode(array(), $this);?>
<?php echo '\';
		Backend.onLoad();
	}

	function ajaxfilemanager(field_name, url, type, win)
	{
		var

			ajaxfilemanagerurl = tinyMCE.baseURI.getURI()+"/../ajaxfilemanager/ajaxfilemanager.php?editor=tinymce";

		switch (type)
		{
			case "image":
			case "media":
			case "flash":
			case "file":
				break;
			default:
				return false;
		}
		tinyMCE.activeEditor.windowManager.open(
			{
                url: ajaxfilemanagerurl,
                width: 782,
                height: 440,
                inline : "yes",
                close_previous : "yes"
            }
            ,
            {
				window : win,
				input : field_name
			}
		);
	}
	'; ?>


	window.onload = onLoad;

	Router.setUrlTemplate('<?php echo smarty_function_link(array('controller' => 'controller','action' => 'action'), $this);?>
');
	</script>

	<?php echo smarty_function_renderBlock(array('block' => 'TRANSLATIONS'), $this);?>


</head>
<body>
<script type="text/javascript">
<?php echo '
	window.historyStorage.init();
	window.dhtmlHistory.create();
'; ?>

</script>

<!-- Preload images -->
<?php echo smarty_function_img(array('src' => "image/silk/bullet_arrow_up.png",'style' => "display: none",'id' => 'bullet_arrow_up'), $this);?>

<?php echo smarty_function_img(array('src' => "image/silk/bullet_arrow_down.png",'style' => "display: none",'id' => 'bullet_arrow_down'), $this);?>
