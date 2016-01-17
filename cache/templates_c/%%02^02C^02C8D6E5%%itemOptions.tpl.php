<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from custom:user/itemOptions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:user/itemOptions.tpl', 7, false),array('function', 'link', 'custom:user/itemOptions.tpl', 11, false),array('modifier', 'htmlspecialchars', 'custom:user/itemOptions.tpl', 18, false),)), $this); ?>
<?php if ($this->_tpl_vars['options']): ?>
	<ul class="itemOptions">
	<?php $_from = $this->_tpl_vars['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
		<li>
			<?php echo $this->_tpl_vars['option']['Choice']['Option']['name_lang']; ?>
:
			<?php if (0 == $this->_tpl_vars['option']['Choice']['Option']['type']): ?>
				<?php echo smarty_function_translate(array('text' => '_option_yes'), $this);?>

			<?php elseif (1 == $this->_tpl_vars['option']['Choice']['Option']['type']): ?>
				<?php echo $this->_tpl_vars['option']['Choice']['name_lang']; ?>

			<?php elseif (3 == $this->_tpl_vars['option']['Choice']['Option']['type']): ?>
				<a href="<?php echo smarty_function_link(array('controller' => 'order','action' => 'downloadOptionFile','id' => $this->_tpl_vars['item']['ID'],'query' => "option=".($this->_tpl_vars['option']['Choice']['Option']['ID'])), $this);?>
"><?php echo $this->_tpl_vars['option']['fileName']; ?>
</a>
				<?php if ($this->_tpl_vars['option']['small_url']): ?>
					<div class="optionImage">
						<a href="<?php echo $this->_tpl_vars['option']['large_url']; ?>
" rel="lightbox"><img src="<?php echo $this->_tpl_vars['option']['small_url']; ?>
" /></a>
					</div>
				<?php endif; ?>
			<?php else: ?>
				<?php echo htmlspecialchars($this->_tpl_vars['option']['optionText']); ?>

			<?php endif; ?>

			<?php if ($this->_tpl_vars['option']['priceDiff'] != 0): ?>
				<span class="optionPrice">(<?php echo $this->_tpl_vars['option']['formattedPrice']; ?>
)</span>
			<?php endif; ?>
		</li>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
<?php endif; ?>