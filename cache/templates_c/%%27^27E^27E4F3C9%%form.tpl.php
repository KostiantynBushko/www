<?php /* Smarty version 2.6.26, created on 2015-12-02 13:45:48
         compiled from custom:backend/productFile/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', 'custom:backend/productFile/form.tpl', 2, false),array('function', 'translate', 'custom:backend/productFile/form.tpl', 4, false),array('function', 'maketext', 'custom:backend/productFile/form.tpl', 16, false),array('block', 'denied', 'custom:backend/productFile/form.tpl', 2, false),array('block', 'language', 'custom:backend/productFile/form.tpl', 93, false),)), $this); ?>
<div class="productFile_form"  style="display: none;">
	<form action="<?php echo smarty_function_link(array('controller' => "backend.productFile",'action' => 'update'), $this);?>
" method="post" target="productFileUploadIFrame_" enctype="multipart/form-data" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>class="formReadonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
		<fieldset>
			<legend><?php echo smarty_function_translate(array('text' => '_add_file_title'), $this);?>
</legend>
		<!-- STEP 1 -->

		<input type="hidden" name="ID" class="hidden productFile_ID" />
		<input type="hidden" name="productID" class="hidden productFile_productID" />

		<fieldset class="productFile_main">

			<p>
				<label class="productFile_uploadFile_label required"><?php echo smarty_function_translate(array('text' => '_upload_a_file'), $this);?>
</label>
				<fieldset class="error">
					<input type="file" name="uploadFile" class="productFile_uploadFile" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>disabled="disabled"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
					<span class="maxFileSize"><?php echo smarty_function_maketext(array('text' => '_product_file_max_size','params' => $this->_tpl_vars['maxUploadSize']), $this);?>
</span>
					<span <?php $this->_tag_stack[] = array('denied', array('role' => 'product.download')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
					<a class="productFile_download_link" href="" target="_blank" style="display: none"></a>
					</span>
					<span class="errorText hidden"> </span>
				</fieldset>
			</p>

			<p>
				<label>- <?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 -</label>
			</p>

			<p>
				<label class="productFile_path_label required"><?php echo smarty_function_translate(array('text' => '_enter_path_or_url'), $this);?>
</label>
				<input type="text" class="text wide productFile_filePath" name="filePath" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>disabled="disabled"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
			</p>

			<p>
				<label class="productFile_title_label required"><?php echo smarty_function_translate(array('text' => '_productFile_title'), $this);?>
</label>
				<fieldset  class="error">
					<input type="text" name="title" class="productFile_title wide" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
					<span class="errorText hidden"> </span>
				</fieldset >
			</p>

			<fieldset class="productFile_fileName_div container">
				<label class="productFile_fileName_label"><?php echo smarty_function_translate(array('text' => '_productFile_change_fileName'), $this);?>
</label>
				<fieldset class="error">
					<div>
						<input type="text" name="fileName" class="productFile_fileName" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
						<span class="productFile_extension">.jpg</span>
					</div>
					<span class="errorText hidden"> </span>
				</fieldset>
			</fieldset>

			<p>
				<label class="productFile_description_label"><?php echo smarty_function_translate(array('text' => '_productFile_description'), $this);?>
</label>
				<fieldset class="error">
					<textarea type="text" name="description" class="productFile_description tinyMCE" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>></textarea>
					<span class="errorText hidden"> </span>
				</fieldset>
			</p>

			<p>
				<label class="productFile_allowDownloadDays_label"><?php echo smarty_function_translate(array('text' => '_productFile_allow_download_for'), $this);?>
</label>
				<fieldset class="error">
					<input type="text" name="allowDownloadDays" class="text number productFile_allowDownloadDays" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
					<?php echo smarty_function_translate(array('text' => '_days'), $this);?>

					<span class="errorText hidden"> </span>
				</fieldset>
			</p>

			<p>
				<label class="productFile_allowDownloadCount_label"><?php echo smarty_function_translate(array('text' => '_productFile_allow_download_times'), $this);?>
</label>
				<fieldset class="error">
					<input type="text" name="allowDownloadCount" class="text number productFile_allowDownloadCount" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
					<?php echo smarty_function_translate(array('text' => '_times'), $this);?>

					<span class="errorText hidden"> </span>
				</fieldset>
			</p>

			<p>
				<label></label>
				<input type="checkbox" name="isPublic" class="checkbox productFile_isPublic" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
				<label class="checkbox"><?php echo smarty_function_translate(array('text' => '_productFile_isPublic'), $this);?>
</label>
			</p>

			<p>
				<label></label>
				<input type="checkbox" name="isEmbedded" class="checkbox productFile_isEmbedded" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
				<label class="checkbox"><?php echo smarty_function_maketext(array('text' => '_productFile_embedded','params' => "FLV; SWF"), $this);?>
</label>
			</p>
		</fieldset>

			<!-- STEP 3 -->

			<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<fieldset class="error">
					<label class="productFile_title_label"><?php echo smarty_function_translate(array('text' => '_productFile_title'), $this);?>
</label>
					<input type="text" name="title_<?php echo $this->_tpl_vars['lang']['ID']; ?>
" class="productFile_title" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> />
				</fieldset>
				<fieldset class="error">
					<label class="productFile_description_label"><?php echo smarty_function_translate(array('text' => '_productFile_description'), $this);?>
</label>
					<textarea type="text" name="description_<?php echo $this->_tpl_vars['lang']['ID']; ?>
" class="tinyMCE productFile_description" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> ></textarea>
				</fieldset>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

		</fieldset>

		<fieldset class="productFile_controls controls">
			<span class="progressIndicator" style="display: none;"></span>
			<input type="submit" class="productFile_save button submit" value="<?php echo smarty_function_translate(array('text' => '_save'), $this);?>
" />
			<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

			<a href="#cancel" class="productFile_cancel cancel"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
		</fieldset>
	</form>
</div>