<?php /* Smarty version 2.6.26, created on 2015-12-02 13:45:48
         compiled from custom:backend/productFileGroup/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/productFileGroup/form.tpl', 2, false),array('function', 'link', 'custom:backend/productFileGroup/form.tpl', 3, false),array('block', 'denied', 'custom:backend/productFileGroup/form.tpl', 3, false),array('block', 'language', 'custom:backend/productFileGroup/form.tpl', 18, false),)), $this); ?>
<fieldset class="addForm productFileGroup_form"  style="display: none;">
	<legend><?php echo smarty_function_translate(array('text' => '_add_new_file_group_title'), $this);?>
</legend>
	<form action="<?php echo smarty_function_link(array('controller' => "backend.productFileGroup",'action' => 'save'), $this);?>
" method="post" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>class="formReadonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
		<!-- STEP 1 -->
		
			<input type="hidden" name="ID" class="hidden productFileGroup_ID" />
			<input type="hidden" name="productID" class="hidden productFileGroup_productID" />
	
			<fieldset class="productFileGroup_main">
				<label class="productFileGroup_name_label"><?php echo smarty_function_translate(array('text' => '_product_file_group_title'), $this);?>
</label>
				<fieldset class="error">
					<input type="text" name="name" class="productFileGroup_name" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
					<span class="errorText hidden"> </span>
				</fieldset>
			</fieldset>
			
			<!-- STEP 3 -->
			<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<label><?php echo smarty_function_translate(array('text' => '_product_file_group_title'), $this);?>
:</label>
				<input type="text" value="" id="name_<?php echo $this->_tpl_vars['lang']['ID']; ?>
" name="name_<?php echo $this->_tpl_vars['lang']['ID']; ?>
"/>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	
		<fieldset class="productFileGroup_controls controls">
			<span class="progressIndicator" style="display: none;"></span>
			<input type="submit" class="productFileGroup_save button submit" value="<?php echo smarty_function_translate(array('text' => '_save'), $this);?>
" />
			<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

			<a href="#cancel" class="productFileGroup_cancel cancel"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
		</fieldset>
	</form>
</fieldset>