<?php /* Smarty version 2.6.26, created on 2015-12-13 16:27:42
         compiled from custom:backend/product/form/translations.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'language', 'custom:backend/product/form/translations.tpl', 1, false),array('function', 'translate', 'custom:backend/product/form/translations.tpl', 3, false),array('function', 'textfield', 'custom:backend/product/form/translations.tpl', 4, false),array('function', 'textarea', 'custom:backend/product/form/translations.tpl', 9, false),)), $this); ?>
<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_name_<?php echo $this->_tpl_vars['lang']['ID']; ?>
"><?php echo smarty_function_translate(array('text' => '_product_name'), $this);?>
:</label>
		<?php echo smarty_function_textfield(array('name' => "name_".($this->_tpl_vars['lang']['ID']),'class' => 'wide','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_name_".($this->_tpl_vars['lang']['ID'])), $this);?>

	</p>
	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_shortdes_<?php echo $this->_tpl_vars['lang']['ID']; ?>
"><?php echo smarty_function_translate(array('text' => '_short_description'), $this);?>
:</label>
		<div class="textarea">
			<?php echo smarty_function_textarea(array('class' => 'shortDescr tinyMCE','name' => "shortDescription_".($this->_tpl_vars['lang']['ID']),'id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_shortdes_".($this->_tpl_vars['lang']['ID'])), $this);?>

		</div>
	</p>
	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_longdes_<?php echo $this->_tpl_vars['lang']['ID']; ?>
"><?php echo smarty_function_translate(array('text' => '_long_description'), $this);?>
:</label>
		<div class="textarea">
			<?php echo smarty_function_textarea(array('class' => 'longDescr tinyMCE','name' => "longDescription_".($this->_tpl_vars['lang']['ID']),'id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_longdes_".($this->_tpl_vars['lang']['ID'])), $this);?>

		</div>
	</p>
	<p>
		<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['product']['ID']; ?>
_pageTitle_<?php echo $this->_tpl_vars['lang']['ID']; ?>
"><?php echo smarty_function_translate(array('text' => '_pageTitle'), $this);?>
:</label>
		<?php echo smarty_function_textfield(array('name' => "pageTitle_".($this->_tpl_vars['lang']['ID']),'class' => 'wide','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['product']['ID'])."_pageTitle_".($this->_tpl_vars['lang']['ID'])), $this);?>

	</p>

	<?php if ($this->_tpl_vars['multiLingualSpecFieldss']): ?>
	<fieldset>
		<legend><?php echo smarty_function_translate(array('text' => '_specification_attributes'), $this);?>
</legend>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/language.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['product'],'cat' => $this->_tpl_vars['cat'],'language' => $this->_tpl_vars['lang']['ID'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</fieldset>
	<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>