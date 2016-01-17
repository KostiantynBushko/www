<?php /* Smarty version 2.6.26, created on 2015-12-01 12:15:16
         compiled from /home/illumin/public_html/application/view///backend/newsletter/add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///backend/newsletter/add.tpl', 4, false),array('function', 'json', '/home/illumin/public_html/application/view///backend/newsletter/add.tpl', 30, false),array('block', 'form', '/home/illumin/public_html/application/view///backend/newsletter/add.tpl', 8, false),array('modifier', 'capitalize', '/home/illumin/public_html/application/view///backend/newsletter/add.tpl', 11, false),)), $this); ?>
<div class="newsletterForm">
	<fieldset class="container">
		<ul class="menu">
			<li class="done"><a class="cancel" href="#" onclick="Backend.Newsletter.cancelAdd(); return false;"><?php echo smarty_function_translate(array('text' => '_cancel_create_newsletter'), $this);?>
</a></li>
		</ul>
	</fieldset>

	<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['form'],'action' => "controller=backend.newsletter action=save",'method' => 'POST','onsubmit' => "Backend.Newsletter.saveForm(this); return false;",'onreset' => "Backend.Newsletter.resetAddForm(this);")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

		<fieldset>
			<legend><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_create_message'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__create_message', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__create_message'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</legend>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/newsletter/form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</fieldset>

		<fieldset class="controls">

			<input type="checkbox" name="afterAdding" value="new" style="display: none;" />

			<span class="progressIndicator" style="display: none;"></span>
			<input type="submit" name="adAd_continue" class="submit" value="<?php echo smarty_function_translate(array('text' => '_save_and_continue'), $this);?>
" onclick="this.form.elements.namedItem('afterAdding').checked = false;" />
			<?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 <a class="cancel" href="#" onclick="Backend.Newsletter.cancelAdd(); return false;"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>

		</fieldset>

	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	<?php echo '
	<script type="text/javascript">
		Backend.Newsletter.initAddForm();
		// Backend.Product.setPath('; ?>
<?php echo $this->_tpl_vars['product']['Category']['ID']; ?>
, <?php echo smarty_function_json(array('array' => $this->_tpl_vars['path']), $this);?>
<?php echo ')
	</script>
	'; ?>


</div>