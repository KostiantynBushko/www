<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from custom:product/attributeValue.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'custom:product/attributeValue.tpl', 1, false),array('modifier', 'count', 'custom:product/attributeValue.tpl', 3, false),)), $this); ?>
<?php $this->assign('field', ((is_array($_tmp=@$this->_tpl_vars['field'])) ? $this->_run_mod_handler('default', true, $_tmp, 'SpecField') : smarty_modifier_default($_tmp, 'SpecField'))); ?>
<?php if ($this->_tpl_vars['attr']['values']): ?>
	<ul class="attributeList<?php if (count($this->_tpl_vars['attr']['values']) == 1): ?> singleValue<?php endif; ?>">
		<?php $_from = $this->_tpl_vars['attr']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
			<li> <?php echo $this->_tpl_vars['value']['value_lang']; ?>
</li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
<?php elseif ($this->_tpl_vars['attr']['value_lang']): ?>
	<?php echo $this->_tpl_vars['attr']['value_lang']; ?>

<?php elseif ($this->_tpl_vars['attr']['value']): ?>
	<?php echo $this->_tpl_vars['attr'][$this->_tpl_vars['field']]['valuePrefix_lang']; ?>
<?php echo $this->_tpl_vars['attr']['value']; ?>
<?php echo $this->_tpl_vars['attr'][$this->_tpl_vars['field']]['valueSuffix_lang']; ?>

<?php endif; ?>