<?php /* Smarty version 2.6.26, created on 2015-12-01 10:53:47
         compiled from /home/illumin/public_html/application/view//block/backend/toolbar.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'renderBlock', '/home/illumin/public_html/application/view//block/backend/toolbar.tpl', 4, false),array('function', 'link', '/home/illumin/public_html/application/view//block/backend/toolbar.tpl', 6, false),array('function', 'translate', '/home/illumin/public_html/application/view//block/backend/toolbar.tpl', 6, false),)), $this); ?>

<div id="footpanel">
	<ul id="mainpanel">
		<?php echo smarty_function_renderBlock(array('block' => "BACKEND-TOOLBAR-BEFORE-ALL"), $this);?>


		<li><a href="<?php echo smarty_function_link(array('controller' => 'index'), $this);?>
" class="storeFrontend" target="_blank"><?php echo smarty_function_translate(array('text' => '_store_frontend'), $this);?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_store_frontend'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?></a></li>
		<li><a href="<?php echo smarty_function_link(array('controller' => "backend.index"), $this);?>
" class="storeBackend"><?php echo smarty_function_translate(array('text' => '_admin_dashboard'), $this);?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_admin_dashboard'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?></a></li>

		<?php echo smarty_function_renderBlock(array('block' => "BACKEND-TOOLBAR-BEFORE-BUTTONS"), $this);?>


		<?php $_from = $this->_tpl_vars['dropButtons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<li class="uninitializedDropButton" style="" id="button<?php echo $this->_tpl_vars['item']['menuID']; ?>
">
				<a href="">
					<small></small>
				</a>
			</li>
		<?php endforeach; else: ?>
			<li id="noToolbarButtons"><?php echo smarty_function_translate(array('text' => '_tip_toolbar_drag'), $this);?>
</li>
		<?php endif; unset($_from); ?>

		<?php echo smarty_function_renderBlock(array('block' => "BACKEND-TOOLBAR-AFTER-BUTTONS"), $this);?>


		<li id="toolbarQS">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/quickSearch/form.tpl", 'smarty_include_vars' => array('formid' => 'TBQuickSearch')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</li>

		<?php echo smarty_function_renderBlock(array('block' => "BACKEND-TOOLBAR-BEFORE-LASTVIEWED"), $this);?>


		<li id="lastviewed" class="lastviewed invalid"><a href="#" class="lastviewed"><?php echo smarty_function_translate(array('text' => '_last_viewed'), $this);?>
</a>
			<div class="subpanel">
				<h3><span> &ndash; </span><?php echo smarty_function_translate(array('text' => '_last_viewed'), $this);?>
</h3>
				<div id="lastViewedIndicator" class="progressIndicator" style="display:none;"></div>
				<ul>
				</ul>
			</div>
		</li>

		<?php echo smarty_function_renderBlock(array('block' => "BACKEND-TOOLBAR-AFTER-LASTVIEWED"), $this);?>


	</ul>

	<li style="display:none;" class="uninitializedDropButton" id="dropButtonTemplate">
		<a href="">
			<small></small>
		</a>
	</li>
</div>

<?php echo '
<script type="text/javascript">
// global variable footerToolbar
	footerToolbar = new BackendToolbar("footpanel",
		{
			addIcon: "'; ?>
<?php echo smarty_function_link(array('controller' => "backend.backendToolbar",'action' => 'addIcon'), $this);?>
?id=_id_&position=_position_<?php echo '",
			removeIcon: "'; ?>
<?php echo smarty_function_link(array('controller' => "backend.backendToolbar",'action' => 'removeIcon'), $this);?>
?id=_id_&position=_position_<?php echo '",
			sortIcons: "'; ?>
<?php echo smarty_function_link(array('controller' => "backend.backendToolbar",'action' => 'sortIcons'), $this);?>
?order=_order_<?php echo '",
			lastViewed: "'; ?>
<?php echo smarty_function_link(array('controller' => "backend.backendToolbar",'action' => 'lastViewed'), $this);?>
<?php echo '"
		}
	);

</script>
'; ?>
