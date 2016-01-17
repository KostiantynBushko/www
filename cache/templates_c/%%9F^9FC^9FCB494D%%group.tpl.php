<?php /* Smarty version 2.6.26, created on 2015-12-02 13:45:48
         compiled from custom:backend/specField/group.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', 'custom:backend/specField/group.tpl', 2, false),array('function', 'translate', 'custom:backend/specField/group.tpl', 6, false),array('block', 'denied', 'custom:backend/specField/group.tpl', 2, false),array('block', 'language', 'custom:backend/specField/group.tpl', 13, false),)), $this); ?>
<div class="specField_group_form">
	<form action="<?php echo smarty_function_link(array('controller' => "backend.specFieldGroup",'action' => 'save'), $this);?>
/" method="post" class="<?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>formReadonly<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> specField_group_form_node"> 
		<input type="hidden" name="categoryID" class="specField_group_categoryID" />
		<fieldset class="specField_group_translations specField_step_main">
			<div class="specField_group_default_language">
				<label class="specField_group_name_label"><?php echo smarty_function_translate(array('text' => '_specField_group_title'), $this);?>
</label>
				<fieldset class="error" style="display: block;">
					<input type="text" name="name" class="specField_group_name_label" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> autocomplete="off" />
					<span class="errorText hidden"> </span>
				</fieldset>
			</div>
		
			<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<fieldset class="error required">
					<label><?php echo smarty_function_translate(array('text' => '_specField_group_title'), $this);?>
</label>
					<input type="text" name="name_<?php echo $this->_tpl_vars['lang']['ID']; ?>
" <?php $this->_tag_stack[] = array('denied', array('role' => "category.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> autocomplete="off" />
				</fieldset>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</fieldset>
		
		<fieldset class="specField_group_controls controls">
			<span class="progressIndicator" style="display: none;"></span>
			<input type="submit" class="specField_save button submit" value="<?php echo smarty_function_translate(array('text' => '_save'), $this);?>
" />
			<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

			<a href="#cancel" class="specField_cancel cancel"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
		</fieldset>
	</form>
</div>