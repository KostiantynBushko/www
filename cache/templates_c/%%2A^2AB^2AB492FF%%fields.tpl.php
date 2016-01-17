<?php /* Smarty version 2.6.26, created on 2015-12-01 10:58:04
         compiled from custom:backend/eav/fields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'rand', 'custom:backend/eav/fields.tpl', 2, false),array('block', 'sect', 'custom:backend/eav/fields.tpl', 4, false),array('block', 'header', 'custom:backend/eav/fields.tpl', 5, false),array('block', 'content', 'custom:backend/eav/fields.tpl', 8, false),array('block', 'error', 'custom:backend/eav/fields.tpl', 29, false),array('block', 'footer', 'custom:backend/eav/fields.tpl', 36, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->assign('containerId', ((is_array($_tmp=$this->_tpl_vars['blah'])) ? $this->_run_mod_handler('rand', true, $_tmp, 1000000) : rand($_tmp, 1000000))); ?>

<?php $this->_tag_stack[] = array('sect', array()); $_block_repeat=true;smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php $this->_tag_stack[] = array('header', array()); $_block_repeat=true;smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<div id="eavContainer_<?php echo $this->_tpl_vars['containerId']; ?>
" class="eavContainer">
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php $this->_tag_stack[] = array('content', array()); $_block_repeat=true;smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_from = $this->_tpl_vars['specFieldList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['groupID'] => $this->_tpl_vars['fieldList']):
?>

			<?php $this->_tag_stack[] = array('sect', array()); $_block_repeat=true;smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php $this->_tag_stack[] = array('header', array()); $_block_repeat=true;smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<?php if ($this->_tpl_vars['groupID']): ?>
						<fieldset class="eavGroup">
							<legend><?php echo $this->_tpl_vars['fieldList']['0'][$this->_tpl_vars['groupClass']]['name_lang']; ?>
</legend>
					<?php endif; ?>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_header($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php $this->_tag_stack[] = array('content', array()); $_block_repeat=true;smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<?php $_from = $this->_tpl_vars['fieldList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
						<?php if (! $this->_tpl_vars['filter'] || ( $this->_tpl_vars['filter'] && ( $this->_tpl_vars['field'][$this->_tpl_vars['filter']] || ( $this->_tpl_vars['field']['handle'] == $this->_tpl_vars['filter'] ) ) )): ?>
							<div class="eavField field_<?php echo $this->_tpl_vars['field']['fieldName']; ?>
 eavHandle_<?php echo $this->_tpl_vars['field']['handle']; ?>
">
							<p class="<?php if ($this->_tpl_vars['field']['isRequired']): ?>required<?php endif; ?> <?php if (! $this->_tpl_vars['field']['isDisplayed']): ?>notDisplayed<?php endif; ?>">
								<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_<?php echo $this->_tpl_vars['field']['fieldName']; ?>
"><span><?php echo $this->_tpl_vars['field']['name_lang']; ?>
:</span></label>
								<fieldset class="error">
									<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/specFieldFactory.tpl", 'smarty_include_vars' => array('field' => $this->_tpl_vars['field'],'cat' => $this->_tpl_vars['cat'],'autocompleteController' => "backend.eavFieldValue")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									<?php if ($this->_tpl_vars['field']['description']): ?>
										<div class="fieldDescription"><?php echo $this->_tpl_vars['field']['description_lang']; ?>
</div>
									<?php endif; ?>
									<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => $this->_tpl_vars['field']['fieldName'])); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => $this->_tpl_vars['field']['fieldName'])); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
								</fieldset>
							</p>
							</div>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php $this->_tag_stack[] = array('footer', array()); $_block_repeat=true;smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<?php if ($this->_tpl_vars['groupID']): ?>
						</fieldset>
					<?php endif; ?>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php endforeach; endif; unset($_from); ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_content($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	<?php $this->_tag_stack[] = array('footer', array()); $_block_repeat=true;smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		</div>

		<?php echo '
		<script type="text/javascript">
			new Backend.Eav($(\'eavContainer_'; ?>
<?php echo $this->_tpl_vars['containerId']; ?>
'));
		</script>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_footer($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_sect($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>