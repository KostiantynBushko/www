<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:01
         compiled from custom:order/block/itemOptions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', 'custom:order/block/itemOptions.tpl', 6, false),array('function', 'translate', 'custom:order/block/itemOptions.tpl', 15, false),array('modifier', 'htmlspecialchars', 'custom:order/block/itemOptions.tpl', 26, false),)), $this); ?>
<?php if ($this->_tpl_vars['options'][$this->_tpl_vars['item']['ID']] || $this->_tpl_vars['moreOptions'][$this->_tpl_vars['item']['ID']]): ?>
	<div class="productOptions">
		<?php $_from = $this->_tpl_vars['options'][$this->_tpl_vars['item']['ID']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/optionItem.tpl", 'smarty_include_vars' => array('selectedChoice' => $this->_tpl_vars['item']['options'][$this->_tpl_vars['option']['ID']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if (3 == $this->_tpl_vars['option']['type']): ?>
				<a href="<?php echo smarty_function_link(array('controller' => 'order','action' => 'downloadOptionFile','id' => $this->_tpl_vars['item']['ID'],'query' => "option=".($this->_tpl_vars['option']['ID'])), $this);?>
"><?php echo $this->_tpl_vars['item']['options'][$this->_tpl_vars['option']['ID']]['fileName']; ?>
</a>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

		<?php $_from = $this->_tpl_vars['moreOptions'][$this->_tpl_vars['item']['ID']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
			<?php if ($this->_tpl_vars['item']['options'][$this->_tpl_vars['option']['ID']]): ?>
				<div class="nonEditableOption">
					<?php echo $this->_tpl_vars['option']['name_lang']; ?>
:
					<?php if (0 == $this->_tpl_vars['option']['type']): ?>
						<?php echo smarty_function_translate(array('text' => '_option_yes'), $this);?>

					<?php elseif (1 == $this->_tpl_vars['option']['type']): ?>
						<?php echo $this->_tpl_vars['item']['options'][$this->_tpl_vars['option']['ID']]['Choice']['name_lang']; ?>

					<?php elseif (3 == $this->_tpl_vars['option']['type']): ?>
						<a href="<?php echo smarty_function_link(array('controller' => 'order','action' => 'downloadOptionFile','id' => $this->_tpl_vars['item']['ID'],'query' => "option=".($this->_tpl_vars['option']['ID'])), $this);?>
"><?php echo $this->_tpl_vars['item']['options'][$this->_tpl_vars['option']['ID']]['fileName']; ?>
</a>
						<?php if ($this->_tpl_vars['item']['options'][$this->_tpl_vars['option']['ID']]['small_url']): ?>
							<div class="optionImage">
								<a href="<?php echo $this->_tpl_vars['item']['options'][$this->_tpl_vars['option']['ID']]['large_url']; ?>
" rel="lightbox"><img src="<?php echo $this->_tpl_vars['item']['options'][$this->_tpl_vars['option']['ID']]['small_url']; ?>
" /></a>
							</div>
						<?php endif; ?>
					<?php else: ?>
						<?php echo htmlspecialchars($this->_tpl_vars['item']['options'][$this->_tpl_vars['option']['ID']]['optionText']); ?>

					<?php endif; ?>
					<?php if ($this->_tpl_vars['item']['options'][$this->_tpl_vars['option']['ID']]['Choice']['priceDiff'] != 0): ?>
						<span class="optionPrice">
							(<?php echo $this->_tpl_vars['item']['options'][$this->_tpl_vars['option']['ID']]['Choice']['formattedPrice'][$this->_tpl_vars['currency']]; ?>
)
						</span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

		<?php if ($this->_tpl_vars['moreOptions'][$this->_tpl_vars['item']['ID']]): ?>
		<div class="productOptionsMenu">
			<a href="<?php echo smarty_function_link(array('controller' => 'order','action' => 'options','id' => $this->_tpl_vars['item']['ID']), $this);?>
" ajax="<?php echo smarty_function_link(array('controller' => 'order','action' => 'optionForm','id' => $this->_tpl_vars['item']['ID']), $this);?>
"><?php echo smarty_function_translate(array('text' => '_edit_options'), $this);?>
</a>
		</div>
		<?php endif; ?>
	</div>
<?php endif; ?>