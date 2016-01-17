<?php /* Smarty version 2.6.26, created on 2015-12-13 16:27:46
         compiled from /home/illumin/public_html/application/view///backend/productImage/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'img', '/home/illumin/public_html/application/view///backend/productImage/index.tpl', 3, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/productImage/index.tpl', 10, false),array('function', 'filefield', '/home/illumin/public_html/application/view///backend/productImage/index.tpl', 44, false),array('function', 'maketext', '/home/illumin/public_html/application/view///backend/productImage/index.tpl', 45, false),array('function', 'textfield', '/home/illumin/public_html/application/view///backend/productImage/index.tpl', 52, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/productImage/index.tpl', 107, false),array('block', 'denied', '/home/illumin/public_html/application/view///backend/productImage/index.tpl', 8, false),array('block', 'form', '/home/illumin/public_html/application/view///backend/productImage/index.tpl', 34, false),array('block', 'language', '/home/illumin/public_html/application/view///backend/productImage/index.tpl', 55, false),array('block', 'allowed', '/home/illumin/public_html/application/view///backend/productImage/index.tpl', 89, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/productImage/index.tpl', 64, false),array('modifier', 'addslashes', '/home/illumin/public_html/application/view///backend/productImage/index.tpl', 112, false),)), $this); ?>
<ul style="display: none;">
	<li class="imageTemplate">
		<?php echo smarty_function_img(array('class' => 'image','src' => ""), $this);?>

		<span class="imageTitle"></span>
	</li>
</ul>

<fieldset class="container" <?php $this->_tag_stack[] = array('denied', array('role' => "product.update")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
	<ul class="menu" id="prodImgMenu_<?php echo $this->_tpl_vars['ownerId']; ?>
">
		<li class="prodImageAdd"><a href="#" id="prodImageAdd_<?php echo $this->_tpl_vars['ownerId']; ?>
_add" class="pageMenu"><?php echo smarty_function_translate(array('text' => '_add_new'), $this);?>
</a></li>	
		<li class="prodImageAddCancel done" style="display: none;"><a href="#" id="prodImageAdd_<?php echo $this->_tpl_vars['ownerId']; ?>
_cancel"><?php echo smarty_function_translate(array('text' => '_cancel_new'), $this);?>
</a></li>   
	</ul>
</fieldset>

<?php echo '
<script type="text/javascript">
	Event.observe("'; ?>
prodImageAdd_<?php echo $this->_tpl_vars['ownerId']; ?>
_add<?php echo '", "click", function(e)
	{
		Event.stop(e);
		var form = new ActiveForm.Slide(this.up("ul"));
		form.show("prodImageAdd", "'; ?>
prodImgAdd_<?php echo $this->_tpl_vars['ownerId']; ?>
<?php echo '");
	});
	
	Event.observe("'; ?>
prodImageAdd_<?php echo $this->_tpl_vars['ownerId']; ?>
_cancel<?php echo '", "click", function(e)
	{
		Event.stop(e);
		var form = new ActiveForm.Slide(this.up("ul"));
		form.hide("prodImageAdd", "'; ?>
prodImgAdd_<?php echo $this->_tpl_vars['ownerId']; ?>
<?php echo '");
	});
</script>
'; ?>


<div id="prodImgAdd_<?php echo $this->_tpl_vars['ownerId']; ?>
" class="prodImageEditForm" style="display: none;">
<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['form'],'action' => "controller=backend.productImage action=upload",'method' => 'POST','onsubmit' => "$('prodImageList_".($this->_tpl_vars['ownerId'])."').handler.upload(this);",'target' => "prodImgUpload_".($this->_tpl_vars['ownerId']),'enctype' => "multipart/form-data",'role' => "product.update")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	
	<input type="hidden" name="ownerId" value="<?php echo $this->_tpl_vars['ownerId']; ?>
" />
	<input type="hidden" name="imageId" value="" />
		
	<fieldset class="addForm">	
		<legend><?php echo smarty_function_translate(array('text' => '_add_new_title'), $this);?>
</legend>
		<p class="required">
			<label for="image"><?php echo smarty_function_translate(array('text' => '_image_file'), $this);?>
</label>
			<fieldset class="error">
				<?php echo smarty_function_filefield(array('name' => 'image','id' => 'image'), $this);?>

				<span class="maxFileSize"><?php echo smarty_function_maketext(array('text' => '_max_file_size','params' => $this->_tpl_vars['maxSize']), $this);?>
</span>
				<div class="errorText" style="display: none;"></div>
			</fieldset>
		</p>
			
		<p>
			<label for="title"><?php echo smarty_function_translate(array('text' => '_image_title'), $this);?>
:</label>
			<?php echo smarty_function_textfield(array('name' => 'title','id' => 'title'), $this);?>
	
		</p>		
		
		<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<p>
				<label><?php echo smarty_function_translate(array('text' => '_image_title'), $this);?>
:</label>
				<?php echo smarty_function_textfield(array('name' => "title_".($this->_tpl_vars['lang']['ID'])), $this);?>

			</p>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>		
	
		<fieldset class="controls">	
			<span class="progressIndicator" style="display: none;"></span>
			<input type="submit" name="upload" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_upload','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
"> 
			<?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 
			<a href="#" class="cancel" ><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
		</fieldset>
	</fieldset>
	
	<?php echo '
	<script type="text/javascript">
		Element.observe($(\''; ?>
prodImgAdd_<?php echo $this->_tpl_vars['ownerId']; ?>
<?php echo '\').down("a.cancel"), "click", function(e) 
		{
			Event.stop(e);
			var form = (\''; ?>
prodImgAdd_<?php echo $this->_tpl_vars['ownerId']; ?>
<?php echo '\');
			
			$("'; ?>
prodImageList_<?php echo $this->_tpl_vars['ownerId']; ?>
<?php echo '").handler.cancelAdd();
			
			var menu = new ActiveForm.Slide(\''; ?>
prodImgMenu_<?php echo $this->_tpl_vars['ownerId']; ?>
<?php echo '\');
			menu.hide("prodImageAdd", form);
		});
	</script>
	'; ?>

	
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<iframe name="prodImgUpload_<?php echo $this->_tpl_vars['ownerId']; ?>
" id="prodImgUpload_<?php echo $this->_tpl_vars['ownerId']; ?>
" style="display: none;"></iframe>
</div>

<ul id="prodImageList_<?php echo $this->_tpl_vars['ownerId']; ?>
" class="prodImageList <?php $this->_tag_stack[] = array('allowed', array('role' => "product.update")); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>activeList_add_sort activeList_add_delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> activeList_add_edit">
	<li class="activeList_remove_sort activeList_remove_delete activeList_remove_edit ignore main">
		<?php echo smarty_function_translate(array('text' => '_main_image'), $this);?>

	</li>
	<li class="activeList_remove_sort activeList_remove_delete activeList_remove_edit ignore supplemental">
		<?php echo smarty_function_translate(array('text' => '_supplemental_images'), $this);?>

	</li>
</ul>

<div class="noRecords">
	<div><?php echo smarty_function_translate(array('text' => '_no_images'), $this);?>
</div>
</div>

<?php echo '
<script type="text/javascript">
	var handler = new Backend.ObjectImage($("'; ?>
prodImageList_<?php echo $this->_tpl_vars['ownerId']; ?>
<?php echo '"), \'prod\');	
	handler.initList('; ?>
<?php echo $this->_tpl_vars['images']; ?>
<?php echo ');
	
	handler.setDeleteUrl(\''; ?>
<?php echo smarty_function_link(array('controller' => "backend.productImage",'action' => 'delete'), $this);?>
<?php echo '\');	
	handler.setSortUrl(\''; ?>
<?php echo smarty_function_link(array('controller' => "backend.productImage",'action' => 'saveOrder'), $this);?>
<?php echo '\');	
	handler.setEditUrl(\''; ?>
<?php echo smarty_function_link(array('controller' => "backend.productImage",'action' => 'edit'), $this);?>
<?php echo '\');		
	handler.setSaveUrl(\''; ?>
<?php echo smarty_function_link(array('controller' => "backend.productImage",'action' => 'save'), $this);?>
<?php echo '\');		
	   
	handler.setDeleteMessage(\''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_delete_confirm'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__delete_confirm', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__delete_confirm'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\');	
	handler.setEditCaption(\''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_edit_image'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__edit_image', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__edit_image'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\');	
	handler.setSaveCaption(\''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_save'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__save', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__save'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\');	
	
	handler.activeListMessages = 
	{ 
		_activeList_edit:	\''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_activeList_edit'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__activeList_edit', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__activeList_edit'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\',
		_activeList_delete:  \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_activeList_delete'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__activeList_delete', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__activeList_delete'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\'
	}
</script>
'; ?>