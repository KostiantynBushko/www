<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:36
         compiled from custom:block/message.tpl */ ?>
<?php if ($this->_tpl_vars['message']): ?>
	<div style="clear: left;"></div>
	<div class="confirmationMessage message"><?php echo $this->_tpl_vars['message']; ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['errorMessage']): ?>
	<div style="clear: left;"></div>
	<div class="errorMessage message"><?php echo $this->_tpl_vars['errorMessage']; ?>
</div>
<?php endif; ?>