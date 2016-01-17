<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from /home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'meta', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 8, false),array('modifier', 'config', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 9, false),array('modifier', 'strip_tags', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 28, false),array('function', 'renderBlock', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 23, false),array('function', 'baseUrl', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 34, false),array('function', 'liveCustomization', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 35, false),array('function', 'self', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 42, false),array('function', 'includeCss', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 48, false),array('function', 'isRTL', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 51, false),array('function', 'compiledCss', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 55, false),array('function', 'loadJs', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 65, false),array('function', 'compiledJs', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 66, false),array('function', 'link', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 78, false),array('function', 'localeCode', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 99, false),array('block', 'canonical', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//layout/frontend.tpl', 42, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta name="Keywords" content="<?php echo smarty_modifier_meta($this->_tpl_vars['metaKeywords']); ?>
" />
	<?php $this->assign('defaultMeta', ((is_array($_tmp='DEFAULT_META_DESCR')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))); ?>
	<meta name="Description" content="<?php echo smarty_modifier_meta($this->_tpl_vars['metaDescription'], $this->_tpl_vars['defaultMeta']); ?>
" />
	<meta http-equiv="X-UA-Compatible" content="IE=100" />
	<meta name=viewport content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,600italic' rel='stylesheet' type='text/css'>
	<!--link rel="stylesheet" href="upload/theme/IlluminataV3/bootstrap.min.css"-->
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> 

	<title>
		<?php if (! $this->_tpl_vars['PAGE_TITLE']): ?>
			<?php ob_start(); ?>
				<?php echo smarty_function_renderBlock(array('block' => 'BREADCRUMB_TITLE'), $this);?>

			<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('PAGE_TITLE', ob_get_contents());ob_end_clean(); ?>
		<?php endif; ?>

		<?php if (((is_array($_tmp='TITLE_FORMAT')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) == 'NAME_FIRST'): ?>
			<?php echo ((is_array($_tmp='STORE_NAME')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
 <?php echo ((is_array($_tmp='TITLE_SEPARATOR')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
 <?php echo smarty_modifier_strip_tags($this->_tpl_vars['PAGE_TITLE']); ?>

		<?php else: ?>
			<?php echo smarty_modifier_strip_tags($this->_tpl_vars['PAGE_TITLE']); ?>
 <?php echo ((is_array($_tmp='TITLE_SEPARATOR')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
 <?php echo ((is_array($_tmp='STORE_NAME')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>

		<?php endif; ?>
	</title>

	<base href="<?php echo smarty_function_baseUrl(array(), $this);?>
"></base>
	<?php echo smarty_function_liveCustomization(array(), $this);?>


	<?php if (((is_array($_tmp='FAVICON')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<link href="<?php echo ((is_array($_tmp='FAVICON')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
" rel="shortcut icon" />
	<?php endif; ?>

	<?php if (! $this->_tpl_vars['CANONICAL']): ?>
		<?php $this->_tag_stack[] = array('canonical', array()); $_block_repeat=true;smarty_block_canonical($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_self(array(), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_canonical($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>

	<link rel="canonical" href="<?php echo $this->_tpl_vars['CANONICAL']; ?>
" />

	<!-- Css includes -->
	<?php echo smarty_function_includeCss(array('file' => "frontend/Frontend.css"), $this);?>

	<?php echo smarty_function_includeCss(array('file' => "backend/stat.css"), $this);?>


	<?php ob_start(); ?><?php echo smarty_function_isRTL(array(), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php if ($this->_tpl_vars['blockAsParamValue']): ?>
		<?php echo smarty_function_includeCss(array('file' => "frontend/FrontendRTL.css"), $this);?>

	<?php endif; ?>

	<?php echo smarty_function_compiledCss(array('glue' => true,'nameMethod' => 'hash'), $this);?>

	<!--[if lt IE 8]>
		<link href="stylesheet/frontend/FrontendIE.css" rel="Stylesheet" type="text/css"/>
		<?php if ($this->_tpl_vars['ieCss']): ?>
			<link href="<?php echo $this->_tpl_vars['ieCss']; ?>
" rel="Stylesheet" type="text/css"/>
		<?php endif; ?>
	<![endif]-->

	<!-- JavaScript includes -->
		<?php echo smarty_function_loadJs(array(), $this);?>

	<?php echo smarty_function_compiledJs(array('glue' => true,'nameMethod' => 'hash'), $this);?>


		<script type="text/javascript">
		Router.setUrlTemplate('<?php echo smarty_function_link(array('controller' => 'controller','action' => 'action'), $this);?>
');
	</script>
	
	<!--Google Analytics start -->
	<?php echo '
	<script>
  (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

  ga(\'create\', \'UA-37656918-1\', \'auto\');
  ga(\'send\', \'pageview\');

</script>
'; ?>

<!-- Google Analytics end-->
</head>

<body class="<?php echo $this->_tpl_vars['request']['controller']; ?>
Con <?php echo $this->_tpl_vars['request']['controller']; ?>
-<?php echo $this->_tpl_vars['request']['action']; ?>
<?php ob_start(); ?><?php echo smarty_function_isRTL(array(), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php if ($this->_tpl_vars['blockAsParamValue']): ?> rtl<?php endif; ?><?php if ($this->_tpl_vars['bodyClass']): ?> <?php echo $this->_tpl_vars['bodyClass']; ?>
<?php endif; ?>">
	<?php echo smarty_function_liveCustomization(array('action' => 'menu'), $this);?>

	<div id="container" class="lang_<?php echo smarty_function_localeCode(array(), $this);?>
">
		<div id="containerWrapper1">
		<div id="containerWrapper2">
		<div id="containerWrapper3">
			<?php echo smarty_function_renderBlock(array('block' => "PAGE-TOP"), $this);?>

			<?php echo $this->_tpl_vars['ACTION_VIEW']; ?>

			<?php echo smarty_function_renderBlock(array('block' => "PAGE-BOTTOM"), $this);?>

		</div>
		</div>
		</div>
	</div>
	<?php echo smarty_function_renderBlock(array('block' => 'TRACKING'), $this);?>

	<?php echo smarty_function_liveCustomization(array('action' => 'lang'), $this);?>


	<?php if (! ((is_array($_tmp='DISABLE_AJAX')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<script type="text/javascript">
			new Frontend.AjaxInit(document.body);
			<?php echo smarty_function_loadJs(array(), $this);?>

		</script>
	<?php endif; ?>


		<?php if (! ((is_array($_tmp='DISABLE_TOOLBAR')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
			<?php echo smarty_function_renderBlock(array('block' => 'FOOTER_TOOLBAR'), $this);?>

		<?php endif; ?>
	</body>
</html>