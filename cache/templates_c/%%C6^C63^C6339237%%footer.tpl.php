<?php /* Smarty version 2.6.26, created on 2015-12-01 10:53:47
         compiled from custom:layout/backend/footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:layout/backend/footer.tpl', 8, false),array('function', 'translate', 'custom:layout/backend/footer.tpl', 25, false),array('function', 'renderBlock', 'custom:layout/backend/footer.tpl', 30, false),)), $this); ?>

	<div class="clear"></div>
	</div>

	</div>
	<div id="pageFooter">
		<div style="float: left;">
			<?php echo ((is_array($_tmp='POWERED_BY_BACKEND')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>

		</div>
		<?php if (((is_array($_tmp='BACKEND_SHOW_FOOTER_LINKS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
			<div id="supportLinks" style="float: right; padding-left: 50px;">
				<a href="http://support.livecart.com" target="_blank">Customer Support</a>
				/
				<a href="http://forums.livecart.com" target="_blank">Forums</a>
			</div>
		<?php endif; ?>
		<div id="footerStretch">
			&nbsp;
		</div>
	</div>
</div>


<script type="text/javascript">
	Backend.internalErrorMessage = '<?php echo smarty_function_translate(array('text' => '_internal_error_have_accurred'), $this);?>
';
	new Backend.LayoutManager();
</script>

<?php if (! ((is_array($_tmp='DISABLE_TOOLBAR')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
	<?php echo smarty_function_renderBlock(array('block' => 'FOOTER_TOOLBAR'), $this);?>

<?php endif; ?>

</body>
</html>

