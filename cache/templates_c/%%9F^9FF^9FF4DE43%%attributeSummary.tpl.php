<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from /home/illumin/public_html/application/view//product/block/attributeSummary.tpl */ ?>
<?php if ($this->_tpl_vars['product']['listAttributes']): ?>
	<div class="specSummary spec">
		<?php $_from = $this->_tpl_vars['product']['listAttributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['attr'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['attr']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['attr']):
        $this->_foreach['attr']['iteration']++;
?>
			<?php if ($this->_tpl_vars['attr']['values']): ?>
				<?php $_from = $this->_tpl_vars['attr']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['values'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['values']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['value']):
        $this->_foreach['values']['iteration']++;
?>
					<?php echo $this->_tpl_vars['value']['value_lang']; ?>

					<?php if (! ($this->_foreach['values']['iteration'] == $this->_foreach['values']['total'])): ?>
					/
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			<?php elseif ($this->_tpl_vars['attr']['value']): ?>
				<?php echo $this->_tpl_vars['attr']['SpecField']['valuePrefix_lang']; ?>
<?php echo $this->_tpl_vars['attr']['value']; ?>
<?php echo $this->_tpl_vars['attr']['SpecField']['valueSuffix_lang']; ?>

			<?php elseif ($this->_tpl_vars['attr']['value_lang']): ?>
				<?php echo $this->_tpl_vars['attr']['value_lang']; ?>

			<?php endif; ?>

			<?php if (! ($this->_foreach['attr']['iteration'] == $this->_foreach['attr']['total'])): ?>
			/
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</div>

	<div style="clear: right;"></div>

<?php endif; ?>