<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from custom:product/variations.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:product/variations.tpl', 5, false),array('function', 'link', 'custom:product/variations.tpl', 17, false),array('block', 'error', 'custom:product/variations.tpl', 11, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['variations']['variations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['variationType']):
?>
	<div>
		<label style="color: white;"><?php echo $this->_tpl_vars['variationType']['name_lang']; ?>
</label>
		<select name="variation_<?php echo $this->_tpl_vars['variationType']['ID']; ?>
">
			<option value=""><?php echo smarty_function_translate(array('text' => '_choose'), $this);?>
</option>
			<?php $_from = $this->_tpl_vars['variationType']['selectOptions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
				<option value="<?php echo $this->_tpl_vars['id']; ?>
"><?php echo $this->_tpl_vars['name']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
		<div class="errorText hidden"></div>
		<?php $this->_tag_stack[] = array('error', array('for' => "variation_".($this->_tpl_vars['variationType']['ID']))); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><div class="errorText"><?php echo $this->_tpl_vars['msg']; ?>
</div><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</div>
<?php endforeach; endif; unset($_from); ?>

<span id="variationOptionTemplate" style="display: none;">%name (%price)</span>

<script type="text/javascript" src="<?php echo smarty_function_link(array('controller' => 'product','action' => 'variations','id' => $this->_tpl_vars['product']['ID']), $this);?>
"></script>