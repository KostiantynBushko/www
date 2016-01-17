<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from /home/illumin/public_html/application/view//block/compareMenu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadJs', '/home/illumin/public_html/application/view//block/compareMenu.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/application/view//block/compareMenu.tpl', 5, false),array('function', 'link', '/home/illumin/public_html/application/view//block/compareMenu.tpl', 16, false),)), $this); ?>
<?php echo smarty_function_loadJs(array(), $this);?>

<?php if ($this->_tpl_vars['products']): ?>
	<div class="box compare" id="compareMenu">
		<div class="title">
			<div><?php echo smarty_function_translate(array('text' => '_compared_products'), $this);?>
</div>
		</div>

		<div class="content">
			<ul>
			<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:compare/block/item.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endforeach; endif; unset($_from); ?>
			</ul>

			<div class="compareBoxMenu">
				<a href="<?php echo smarty_function_link(array('controller' => 'compare','action' => 'index','returnPath' => true,'query' => "return=".($this->_tpl_vars['return'])), $this);?>
"><?php echo smarty_function_translate(array('text' => '_view_comparison'), $this);?>
</a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		new Compare.Menu($('compareMenu'));
	</script>
<?php endif; ?>
<div id="compareMenuContainer"></div>