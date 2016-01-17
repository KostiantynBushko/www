<?php /* Smarty version 2.6.26, created on 2015-12-01 15:10:26
         compiled from custom:backend/eav/specFieldFactory.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'checkbox', 'custom:backend/eav/specFieldFactory.tpl', 15, false),array('function', 'translate', 'custom:backend/eav/specFieldFactory.tpl', 25, false),array('function', 'textfield', 'custom:backend/eav/specFieldFactory.tpl', 26, false),array('function', 'selectfield', 'custom:backend/eav/specFieldFactory.tpl', 41, false),array('function', 'textarea', 'custom:backend/eav/specFieldFactory.tpl', 59, false),array('function', 'calendar', 'custom:backend/eav/specFieldFactory.tpl', 64, false),array('modifier', 'or', 'custom:backend/eav/specFieldFactory.tpl', 52, false),)), $this); ?>
<?php if (! $this->_tpl_vars['language'] || ! is_string ( $this->_tpl_vars['language'] )): ?>
	<?php $this->assign('fieldName', $this->_tpl_vars['field']['fieldName']); ?>
<?php else: ?>
	<?php $this->assign('fieldName', ($this->_tpl_vars['field']['fieldName'])."_".($this->_tpl_vars['language'])); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['field']['type'] == 1 || $this->_tpl_vars['field']['type'] == 5): ?>
	<?php if ($this->_tpl_vars['field']['isMultiValue']): ?>
		<fieldset class="container multiValueSelect<?php if ($this->_tpl_vars['field']['type'] == 1): ?> multiValueNumeric<?php endif; ?>">

			<div class="eavCheckboxes">
				<?php $_from = $this->_tpl_vars['field']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['value']):
?>
					<?php if ('' != $this->_tpl_vars['id']): ?>
						<p>
							<?php echo smarty_function_checkbox(array('name' => ($this->_tpl_vars['prefix'])."specItem_".($this->_tpl_vars['id']),'class' => 'checkbox','value' => 'on','id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['item']['ID'])."_specItem_".($this->_tpl_vars['id'])), $this);?>

							<label class="checkbox" for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['item']['ID']; ?>
_specItem_<?php echo $this->_tpl_vars['id']; ?>
"> <?php echo $this->_tpl_vars['value']; ?>
</label>
						</p>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			</div>

		<?php if (! $this->_tpl_vars['disableNewOptionValues']): ?>
			<div class="other">
				<p>
					<label for="product_<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['item']['ID']; ?>
_specItem_other_<?php echo $this->_tpl_vars['field']['ID']; ?>
"> <?php echo smarty_function_translate(array('text' => '_other'), $this);?>
:</label>
					<?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['prefix'])."other[".($this->_tpl_vars['field']['ID'])."][]",'id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['item']['ID'])."_specItem_other_".($this->_tpl_vars['field']['ID'])), $this);?>

				</p>
			</div>
		<?php endif; ?>

		<p class="selectMenu">
			<a href="#" class="eavSelectAll"><?php echo smarty_function_translate(array('text' => '_select_all'), $this);?>
</a> | <a href="#" class="deselect eavDeselectAll"><?php echo smarty_function_translate(array('text' => '_deselect_all'), $this);?>
</a> | <a class="eavSort" href="#">A-Z</a> | <?php echo smarty_function_translate(array('text' => '_eav_filter'), $this);?>
: <input type="text" class="text filter" />
		</p>

		</fieldset>
		<input class="fieldStatus" name="<?php echo $this->_tpl_vars['fieldName']; ?>
" value="" style="display: none;" />
	<?php else: ?>
		<?php if (! $this->_tpl_vars['disableNewOptionValues']): ?>
			<?php $field = $this->get_template_vars('field'); $field['values']['other'] = $this->getApplication()->translate('_enter_other'); $this->assign('field', $field); ?>
		<?php endif; ?>
		<?php echo $this->_tpl_vars['field']['valuePrefix_lang']; ?>
<?php echo smarty_function_selectfield(array('id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['item']['ID'])."_".($this->_tpl_vars['fieldName']),'name' => ($this->_tpl_vars['prefix']).($this->_tpl_vars['fieldName']),'options' => $this->_tpl_vars['field']['values'],'class' => 'select'), $this);?>
<?php echo $this->_tpl_vars['field']['valueSuffix_lang']; ?>

		<?php if (! $this->_tpl_vars['disableNewOptionValues']): ?>
			<?php ob_start(); ?><?php echo $this->_tpl_vars['textFieldClass']; ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['prefix'])."other[".($this->_tpl_vars['field']['ID'])."]",'id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['item']['ID'])."_specItem_other_".($this->_tpl_vars['field']['ID']),'style' => "display: none",'class' => "text ".($this->_tpl_vars['blockAsParamValue'])), $this);?>

		<?php endif; ?>
	<?php endif; ?>

<?php elseif ($this->_tpl_vars['field']['type'] == 2): ?>
	<?php echo $this->_tpl_vars['field']['valuePrefix_lang']; ?>
<?php echo smarty_function_textfield(array('id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['item']['ID'])."_".($this->_tpl_vars['fieldName']),'name' => ($this->_tpl_vars['prefix']).($this->_tpl_vars['fieldName']),'class' => 'text numeric'), $this);?>
<?php echo $this->_tpl_vars['field']['valueSuffix_lang']; ?>


<?php elseif ($this->_tpl_vars['field']['type'] == 3): ?>
	<?php if (! $this->_tpl_vars['disableAutocomplete']): ?>
		<?php $this->assign('autocompleteController', smarty_modifier_or($this->_tpl_vars['autocompleteController'], 'backend.product')); ?>
		<?php $this->assign('autocomplete', "controller=".($this->_tpl_vars['autocompleteController'])." field=".($this->_tpl_vars['fieldName'])); ?>
	<?php endif; ?>
	<?php ob_start(); ?><?php echo $this->_tpl_vars['textFieldClass']; ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_textfield(array('id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['item']['ID'])."_".($this->_tpl_vars['fieldName']),'name' => ($this->_tpl_vars['prefix']).($this->_tpl_vars['fieldName']),'class' => "text ".($this->_tpl_vars['blockAsParamValue']),'autocomplete' => $this->_tpl_vars['autocomplete']), $this);?>


<?php elseif ($this->_tpl_vars['field']['type'] == 4): ?>
	<div class="textarea" style="margin-left: 0;">
		<?php echo smarty_function_textarea(array('id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['item']['ID'])."_".($this->_tpl_vars['fieldName']),'name' => ($this->_tpl_vars['prefix']).($this->_tpl_vars['fieldName']),'class' => 'tinyMCE'), $this);?>

		<div class="errorText hidden"></div>
	</div>

<?php elseif ($this->_tpl_vars['field']['type'] == 6): ?>
	<?php echo smarty_function_calendar(array('id' => "product_".($this->_tpl_vars['cat'])."_".($this->_tpl_vars['item']['ID'])."_".($this->_tpl_vars['fieldName']),'name' => ($this->_tpl_vars['prefix']).($this->_tpl_vars['fieldName'])), $this);?>

<?php endif; ?>