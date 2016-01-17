<?php /* Smarty version 2.6.26, created on 2015-12-01 10:57:27
         compiled from /home/illumin/public_html/application/view///backend/themeFile/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///backend/themeFile/index.tpl', 5, false),array('function', 'filefield', '/home/illumin/public_html/application/view///backend/themeFile/index.tpl', 26, false),array('function', 'maketext', '/home/illumin/public_html/application/view///backend/themeFile/index.tpl', 28, false),array('function', 'textfield', '/home/illumin/public_html/application/view///backend/themeFile/index.tpl', 36, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/themeFile/index.tpl', 62, false),array('function', 'json', '/home/illumin/public_html/application/view///backend/themeFile/index.tpl', 93, false),array('block', 'form', '/home/illumin/public_html/application/view///backend/themeFile/index.tpl', 14, false),array('block', 'error', '/home/illumin/public_html/application/view///backend/themeFile/index.tpl', 30, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/themeFile/index.tpl', 41, false),)), $this); ?>

<fieldset class="container">
	<ul class="menu" id="uploadMenu_<?php echo $this->_tpl_vars['theme']; ?>
">
		<li class="fileUpload">
			<a href="#" id="uploadNewFile_<?php echo $this->_tpl_vars['theme']; ?>
_upload" class="pageMenu"><?php echo smarty_function_translate(array('text' => '_upload_new_file'), $this);?>
</a>
		</li>
		<li class="fileUploadCancel done" style="display: none">
			<a href="#" id="uploadNewFile_<?php echo $this->_tpl_vars['theme']; ?>
_cancel" class="pageMenu"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
		</li>  
	</ul>
</fieldset>

<div id="themeFileForm_<?php echo $this->_tpl_vars['theme']; ?>
" class="slideForm addForm" style="display: none;">
	<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['form'],'action' => "controller=backend.themeFile action=upload",'onsubmit' => "",'target' => "fileUpload_".($this->_tpl_vars['theme']),'method' => 'POST','enctype' => "multipart/form-data",'autocomplete' => 'off')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

		<span class="progressIndicator" style="display: none;"></span>
		<input type="hidden" name="theme" value="<?php echo $this->_tpl_vars['theme']; ?>
" />
		<input type="hidden" name="orginalFileName" class="orginalFileName" value="" />
		
		<p class="required">
			
				<label for="file"><span class="label"><?php echo smarty_function_translate(array('text' => '_select_file'), $this);?>
: </span></label>
				<fieldset class="error"><?php echo smarty_function_filefield(array('name' => 'file','value' => ""), $this);?>

				<br />
				<span class="maxFileSize"><?php echo smarty_function_maketext(array('text' => '_max_file_size','params' => $this->_tpl_vars['maxSize']), $this);?>
</span>
			
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'file')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'file')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
		</p>

		<p>
			<label for="title"><?php echo smarty_function_translate(array('text' => '_change_file_name'), $this);?>
:</label>
			<?php echo smarty_function_textfield(array('name' => 'filename','class' => 'changeFileName'), $this);?>

		</p>

		<fieldset class="controls">
			<span class="progressIndicator" style="display: none;"></span>
			<input type="submit" name="upload" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_upload','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
"> 
			<?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 
			<a href="#" class="cancel"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
		</fieldset>

	</fieldset>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	<iframe name="fileUpload_<?php echo $this->_tpl_vars['theme']; ?>
" id="fileUpload_<?php echo $this->_tpl_vars['theme']; ?>
" style="display: none"></iframe>

</div>




</div>

<ul id="filesList_<?php echo $this->_tpl_vars['theme']; ?>
" class="activeList activeList_add_delete activeList_add_edit">
</ul>

<div style="display: none">
	<span id="deleteUrl"><?php echo smarty_function_link(array('controller' => "backend.themeFile",'action' => 'delete'), $this);?>
?file=__FILE__&theme=__THEME__</span>
	<span id="confirmDelete"><?php echo smarty_function_translate(array('text' => '_del_conf'), $this);?>
</span>
	<?php ob_start(); ?><?php echo smarty_function_link(array('controller' => "backend.siteNews",'action' => 'save'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?></div>

<ul style="display: none;">
	<li id="filesList_template_<?php echo $this->_tpl_vars['theme']; ?>
" style="position: relative;">
		<span class="progressIndicator" style="display: none; "></span>
		<span class="filesData">
			<input type="hidden" class="file" value="" />
			<input type="hidden" class="theme" value="" />

			<div class="thumbnailContainer">
				<a href="" rel="lightbox">
					<img src="" alt="">
				</a>
			</div>
			
			<div class="fileInfoContainer">
				<div class="fileName"></div>
				<div class="cssHintContainer">
					<?php echo smarty_function_translate(array('text' => '_including_as_css_background'), $this);?>
:<br/><code>background-image: url('../../upload/theme/<span class="cssTheme"></span>/<span class="cssFile"></span>');</code>
				</div>
			</div>
		</span>
		<div class="formContainer activeList_editContainer" style="display: none;"></div>
		<div class="clear"></div>
	</li>
</ul>

<script type="text/javascript">
	new Backend.ThemeFile(<?php echo smarty_function_json(array('array' => $this->_tpl_vars['filesList']), $this);?>
, $('filesList_<?php echo $this->_tpl_vars['theme']; ?>
'), $('filesList_template_<?php echo $this->_tpl_vars['theme']; ?>
'));
</script>