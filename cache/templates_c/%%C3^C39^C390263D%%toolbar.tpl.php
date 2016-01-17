<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from /home/illumin/public_html/application/view//block/toolbar.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'renderBlock', '/home/illumin/public_html/application/view//block/toolbar.tpl', 5, false),)), $this); ?>

<div id="footpanel">
	<ul id="mainpanel">
		<?php echo smarty_function_renderBlock(array('block' => "FRONTEND-TOOLBAR-LEFT"), $this);?>

		<?php echo smarty_function_renderBlock(array('block' => "FRONTEND-TOOLBAR-CENTER"), $this);?>

		<?php echo smarty_function_renderBlock(array('block' => "FRONTEND-TOOLBAR-RIGHT"), $this);?>

	</ul>
</div>

<?php echo '
<script type="text/javascript">
	// global variable footerToolbar
	footerToolbar = new FrontendToolbar("footpanel");
</script>
'; ?>
