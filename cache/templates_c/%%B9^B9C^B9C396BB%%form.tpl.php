<?php /* Smarty version 2.6.26, created on 2015-12-03 23:19:16
         compiled from /home/illumin/public_html/application/view///backend/category/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', '/home/illumin/public_html/application/view///backend/category/form.tpl', 2, false),array('block', 'language', '/home/illumin/public_html/application/view///backend/category/form.tpl', 70, false),array('function', 'checkbox', '/home/illumin/public_html/application/view///backend/category/form.tpl', 6, false),array('function', 'toolTip', '/home/illumin/public_html/application/view///backend/category/form.tpl', 6, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/category/form.tpl', 10, false),array('function', 'textfield', '/home/illumin/public_html/application/view///backend/category/form.tpl', 11, false),array('function', 'textarea', '/home/illumin/public_html/application/view///backend/category/form.tpl', 16, false),array('function', 'selectfield', '/home/illumin/public_html/application/view///backend/category/form.tpl', 54, false),array('function', 'renderBlock', '/home/illumin/public_html/application/view///backend/category/form.tpl', 68, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/category/form.tpl', 96, false),)), $this); ?>
<?php $this->assign('action', 'create'); ?>
<?php $this->_tag_stack[] = array('form', array('id' => "categoryForm_".($this->_tpl_vars['categoryId']),'handle' => $this->_tpl_vars['catalogForm'],'action' => "controller=backend.category action=update id=".($this->_tpl_vars['categoryId']),'method' => 'post','onsubmit' => "Backend.Category.updateBranch(this); return false;",'role' => "category.update")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<fieldset class="container">

		<p class="checkbox">
			<?php echo smarty_function_checkbox(array('name' => 'isEnabled','id' => "isEnabled_".($this->_tpl_vars['categoryId']),'class' => 'checkbox'), $this);?>
 <label class="checkbox" for="isEnabled_<?php echo $this->_tpl_vars['categoryId']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_active'), $this);?>
</label>
		</p>

		<p class="required">
			<label for="name_<?php echo $this->_tpl_vars['categoryId']; ?>
"><?php echo smarty_function_translate(array('text' => '_category_name'), $this);?>
:</label>
			<?php echo smarty_function_textfield(array('name' => 'name','id' => "name_".($this->_tpl_vars['categoryId'])), $this);?>

		</p>

		<p>
			<label for="details_<?php echo $this->_tpl_vars['categoryId']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_descr'), $this);?>
:</label>
			<?php echo smarty_function_textarea(array('name' => 'description','id' => "details_".($this->_tpl_vars['categoryId']),'class' => 'tinyMCE'), $this);?>

		</p>

		<p>
			<label for="keywords_<?php echo $this->_tpl_vars['categoryId']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_keywords'), $this);?>
:</label>
			<?php echo smarty_function_textarea(array('name' => 'keywords','id' => "keywords_".($this->_tpl_vars['categoryId']),'class' => 'categoryKeywords'), $this);?>

		</p>

		<p>
			<label for="pageTitle_<?php echo $this->_tpl_vars['categoryId']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_pageTitle','hint' => '_hint_pageTitle'), $this);?>
:</label>
			<?php echo smarty_function_textfield(array('name' => 'pageTitle','id' => "pageTitle_".($this->_tpl_vars['categoryId']),'class' => 'wide'), $this);?>

		</p>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/fields.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['category'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<fieldset>
			<legend><?php echo smarty_function_translate(array('text' => '_presentation'), $this);?>
</legend>

			<p>
				<label></label>
				<?php echo smarty_function_checkbox(array('name' => 'isSubcategories','class' => 'checkbox','id' => "isSubcategories_".($this->_tpl_vars['categoryId'])), $this);?>

				<label class="checkbox" for="isSubcategories_<?php echo $this->_tpl_vars['categoryId']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_theme_subcategories'), $this);?>
</label>
			</p>

			<p>
				<label></label>
				<?php echo smarty_function_checkbox(array('name' => 'isVariationImages','class' => 'checkbox','id' => "isVariationImages_".($this->_tpl_vars['categoryId'])), $this);?>

				<label class="checkbox" for="isVariationImages_<?php echo $this->_tpl_vars['categoryId']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_show_variation_images'), $this);?>
</label>
			</p>

			<p>
				<label></label>
				<?php echo smarty_function_checkbox(array('name' => 'isAllVariations','class' => 'checkbox','id' => "product_".($this->_tpl_vars['categoryId'])."_isAllVariations"), $this);?>

				<label for="product_<?php echo $this->_tpl_vars['categoryId']; ?>
_isAllVariations" class="checkbox"><?php echo smarty_function_toolTip(array('label' => '_allow_all_variations'), $this);?>
</label>
			</p>

			<p>
				<label for="listStyle_<?php echo $this->_tpl_vars['categoryId']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_list_style'), $this);?>
:</label>
				<?php echo smarty_function_selectfield(array('name' => 'listStyle','id' => "listStyle_".($this->_tpl_vars['categoryId']),'options' => $this->_tpl_vars['listStyles']), $this);?>

			</p>

			<div style="float: left; width: 550px;">
				<p>
					<label for="theme_<?php echo $this->_tpl_vars['categoryId']; ?>
"><?php echo smarty_function_toolTip(array('label' => '_theme'), $this);?>
:</label>
					<?php echo smarty_function_selectfield(array('name' => 'theme','id' => "theme_".($this->_tpl_vars['categoryId']),'options' => $this->_tpl_vars['themes']), $this);?>

				</p>
			</div>

			<div style="float: left;" id="categoryThemePreview_<?php echo $this->_tpl_vars['categoryId']; ?>
"></div>

		</fieldset>

		<?php echo smarty_function_renderBlock(array('block' => "FORM-CATEGORY-BOTTOM"), $this);?>


		<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<p>
				<label><?php echo smarty_function_translate(array('text' => '_category_name'), $this);?>
:</label>
				<?php echo smarty_function_textfield(array('name' => "name_".($this->_tpl_vars['lang']['ID'])), $this);?>

			</p>
			<p>
				<label><?php echo smarty_function_translate(array('text' => '_descr'), $this);?>
:</label>
				<?php echo smarty_function_textarea(array('name' => "description_".($this->_tpl_vars['lang']['ID']),'class' => 'tinyMCE'), $this);?>

			</p>
			<p>
				<label><?php echo smarty_function_translate(array('text' => '_keywords'), $this);?>
:</label>
				<?php echo smarty_function_textarea(array('name' => "keywords_".($this->_tpl_vars['lang']['ID']),'class' => 'categoryKeywords'), $this);?>

			</p>
			<p>
				<label><?php echo smarty_function_translate(array('text' => '_pageTitle'), $this);?>
:</label>
				<?php echo smarty_function_textfield(array('name' => "pageTitle_".($this->_tpl_vars['lang']['ID']),'class' => 'wide'), $this);?>

			</p>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/language.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['category'],'language' => $this->_tpl_vars['lang']['ID'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	</fieldset>

	<fieldset class="controls">
		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" class="submit" id="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_save','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
"/> or
		<a href="#" class="cancel" onClick="$('categoryForm_<?php echo $this->_tpl_vars['categoryId']; ?>
').reset(); return false;"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
		<div class="clear"></div>
	</fieldset>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php echo '
<script type="text/javascript">
'; ?>

	new Backend.ThemePreview($('categoryThemePreview_<?php echo $this->_tpl_vars['categoryId']; ?>
'), $('theme_<?php echo $this->_tpl_vars['categoryId']; ?>
'));
	ActiveForm.prototype.initTinyMceFields("categoryForm_<?php echo $this->_tpl_vars['categoryId']; ?>
");
</script>