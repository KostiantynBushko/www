<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from /home/illumin/public_html/application/view//block/box/currency.tpl */ ?>
<?php if ($this->_tpl_vars['currencies']): ?>
	<div id="currency">
		<?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['currency']):
?>
			<a href="<?php echo $this->_tpl_vars['currency']['url']; ?>
"><?php echo $this->_tpl_vars['currency']['ID']; ?>
</a>
		<?php endforeach; endif; unset($_from); ?>
	</div>
<?php endif; ?>