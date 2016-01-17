<?php /* Smarty version 2.6.26, created on 2015-12-30 12:20:50
         compiled from custom:order/orderFieldValues.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'custom:order/orderFieldValues.tpl', 6, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['order']['attributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attr']):
?>
	<?php if ($this->_tpl_vars['attr']['EavField']['isDisplayedInList'] && $this->_tpl_vars['attr']['EavField'] && ( $this->_tpl_vars['attr']['values'] || $this->_tpl_vars['attr']['value'] || $this->_tpl_vars['attr']['value_lang'] )): ?>
		<label class="attrName"><?php echo $this->_tpl_vars['attr']['EavField']['name_lang']; ?>
:</label>
		<label class="attrValue">
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
				<?php echo $this->_tpl_vars['attr']['EavField']['valuePrefix_lang']; ?>
<?php echo $this->_tpl_vars['attr']['value']; ?>
<?php echo $this->_tpl_vars['attr']['EavField']['valueSuffix_lang']; ?>

			<?php endif; ?>
		</label>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>