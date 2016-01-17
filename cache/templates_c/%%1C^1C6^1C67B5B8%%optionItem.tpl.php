<?php /* Smarty version 2.6.26, created on 2015-12-01 10:25:08
         compiled from custom:product/optionItem.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'checkbox', 'custom:product/optionItem.tpl', 16, false),array('function', 'uniqid', 'custom:product/optionItem.tpl', 49, false),array('function', 'textfield', 'custom:product/optionItem.tpl', 67, false),array('function', 'filefield', 'custom:product/optionItem.tpl', 70, false),array('function', 'hidden', 'custom:product/optionItem.tpl', 71, false),array('function', 'link', 'custom:product/optionItem.tpl', 81, false),array('block', 'error', 'custom:product/optionItem.tpl', 28, false),)), $this); ?>
<?php if (!function_exists('smarty_fun_optionPrice')) { function smarty_fun_optionPrice(&$smarty, $params) { $_fun_tpl_vars = $smarty->_tpl_vars; $smarty->assign($params);  ?>
	<?php if ($smarty->_tpl_vars['choice'] && $smarty->_tpl_vars['choice']['priceDiff'] != 0): ?>
		<?php if ($smarty->_tpl_vars['choice']['Option']['isPriceIncluded'] && $smarty->_tpl_vars['choice']['formattedTotalPrice'][$smarty->_tpl_vars['currency']]): ?>
			- <span class="optionFullPrice"><?php echo $smarty->_tpl_vars['choice']['formattedTotalPrice'][$smarty->_tpl_vars['currency']]; ?>
</span>
		<?php else: ?>
			(<?php if ($smarty->_tpl_vars['choice'] && $smarty->_tpl_vars['choice']['priceDiff'] > 0): ?>+<?php endif; ?><?php echo $smarty->_tpl_vars['choice']['formattedPrice'][$smarty->_tpl_vars['currency']]; ?>
)
		<?php endif; ?>
	<?php endif; ?>
<?php  $smarty->_tpl_vars = $_fun_tpl_vars; }} smarty_fun_optionPrice($this, array('choice'=>null));  ?>

<div<?php if ($this->_tpl_vars['option']['isRequired']): ?> class="required"<?php endif; ?> class="productOption">
	<?php if ($this->_tpl_vars['option']['fieldName']): ?><?php $this->assign('fieldName', $this->_tpl_vars['option']['fieldName']); ?><?php else: ?><?php $this->assign('fieldName', "option_".($this->_tpl_vars['option']['ID'])); ?><?php endif; ?>
	<?php $this->assign('fieldName', ($this->_tpl_vars['optionPrefix']).($this->_tpl_vars['fieldName'])); ?>
	<?php if (0 == $this->_tpl_vars['option']['type']): ?>
		
			<fieldset class="error"><?php echo smarty_function_checkbox(array('name' => ($this->_tpl_vars['fieldName']),'class' => 'checkbox'), $this);?>

			<label for=<?php echo $this->_tpl_vars['fieldName']; ?>
 class="checkbox">
				<?php echo $this->_tpl_vars['option']['name_lang']; ?>

				<?php smarty_fun_optionPrice($this, array('choice'=>$this->_tpl_vars['option']['DefaultChoice']));  ?>
			</label>

			<?php if ($this->_tpl_vars['option']['description_lang']): ?>
				<p class="description">
					<?php echo $this->_tpl_vars['option']['description_lang']; ?>

				</p>
			<?php endif; ?>
		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['fieldName']))); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['fieldName']))); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	<?php else: ?>
		<label class="field" style="padding: 5px !important; font-weight: normal;"><?php echo $this->_tpl_vars['option']['name_lang']; ?>
</label>
			
			<?php if (1 == $this->_tpl_vars['option']['type']): ?>
				<?php if (0 == $this->_tpl_vars['option']['displayType']): ?>
					<fieldset class="error">
					<select name="<?php echo $this->_tpl_vars['fieldName']; ?>
">
						<option value=""><?php echo $this->_tpl_vars['option']['selectMessage_lang']; ?>
</option>
						<?php $_from = $this->_tpl_vars['option']['choices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['choice']):
?>
							<option value="<?php echo $this->_tpl_vars['choice']['ID']; ?>
"<?php if ($this->_tpl_vars['selectedChoice']['Choice']['ID'] == $this->_tpl_vars['choice']['ID']): ?> selected="selected"<?php endif; ?>>
								<?php echo $this->_tpl_vars['choice']['name_lang']; ?>

								<?php smarty_fun_optionPrice($this, array('choice'=>$this->_tpl_vars['choice']));  ?>
							</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				<?php else: ?>
					<div class="radioOptions">
						<?php if ($this->_tpl_vars['option']['selectMessage_lang']): ?>
							<p>
								<input name="<?php echo $this->_tpl_vars['fieldName']; ?>
" type="radio" class="radio" id="<?php echo smarty_function_uniqid(array(), $this);?>
" value=""<?php if (! $this->_tpl_vars['selectedChoice']['Choice']['ID']): ?> checked="checked"<?php endif; ?> />
								<label class="radio" for="<?php echo smarty_function_uniqid(array('last' => true), $this);?>
"><?php echo $this->_tpl_vars['option']['selectMessage_lang']; ?>
</label>
							</p>
						<?php endif; ?>

						<?php $_from = $this->_tpl_vars['option']['choices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['choice']):
?>
							<p>
								<input name="<?php echo $this->_tpl_vars['fieldName']; ?>
" type="radio" class="radio" id="<?php echo smarty_function_uniqid(array(), $this);?>
" value="<?php echo $this->_tpl_vars['choice']['ID']; ?>
"<?php if ($this->_tpl_vars['selectedChoice']['Choice']['ID'] == $this->_tpl_vars['choice']['ID']): ?> checked="checked"<?php endif; ?> />
								<label class="radio" for="<?php echo smarty_function_uniqid(array('last' => true), $this);?>
">
									<?php echo $this->_tpl_vars['choice']['name_lang']; ?>

									<?php smarty_fun_optionPrice($this, array('choice'=>$this->_tpl_vars['choice']));  ?>
								</label>
							</p>
						<?php endforeach; endif; unset($_from); ?>
						<div class="clear"></div>
					</div>
				<?php endif; ?>
			<?php elseif (2 == $this->_tpl_vars['option']['type']): ?>
				<fieldset class="error"><?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['fieldName']),'class' => 'text'), $this);?>

			<?php elseif (3 == $this->_tpl_vars['option']['type']): ?>
				<?php echo smarty_function_uniqid(array('assign' => 'uniq','noecho' => true), $this);?>

				<?php echo smarty_function_filefield(array('name' => "upload_".($this->_tpl_vars['fieldName']),'id' => $this->_tpl_vars['uniq']), $this);?>

				<?php echo smarty_function_hidden(array('name' => $this->_tpl_vars['fieldName']), $this);?>

				<?php $this->_tag_stack[] = array('error', array('for' => "upload_".($this->_tpl_vars['fieldName']))); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><div class="errorText"><?php echo $this->_tpl_vars['msg']; ?>
</div><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<div class="optionFileInfo" style="display: none;">
					<div class="optionFileName"></div>
					<div class="optionFileImage">
						<img src="" class="optionThumb" alt="" />
					</div>
				</div>
				<script type="text/javascript">
					var upload = $('<?php echo $this->_tpl_vars['uniq']; ?>
');
					new LiveCart.FileUpload(upload, '<?php echo smarty_function_link(array('controller' => 'order','action' => 'uploadOptionFile','id' => $this->_tpl_vars['option']['ID'],'query' => "uniq=".($this->_tpl_vars['uniq'])."&field=".($this->_tpl_vars['fieldName'])."&productID=".($this->_tpl_vars['product']['ID'])), $this);?>
', Order.previewOptionImage);
				</script>
			<?php elseif (4 == $this->_tpl_vars['option']['type']): ?>
				
			<?php endif; ?>

			<?php if ($this->_tpl_vars['option']['description_lang']): ?>
				<p class="description">
					<?php echo $this->_tpl_vars['option']['description_lang']; ?>

				</p>
			<?php endif; ?>

		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['fieldName']))); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['fieldName']))); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	<?php endif; ?>
</div>
<div class="clear"></div>