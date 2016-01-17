<?php /* Smarty version 2.6.26, created on 2015-12-11 14:39:31
         compiled from custom:backend/eav/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'zebra', 'custom:backend/eav/view.tpl', 22, false),array('modifier', 'count', 'custom:backend/eav/view.tpl', 26, false),)), $this); ?>
<?php if ('row' != $this->_tpl_vars['format']): ?>
	<?php $this->assign('container', 'table'); ?>
	<?php $this->assign('row', 'tr'); ?>
	<?php $this->assign('cell', 'td'); ?>
<?php else: ?>
	<?php $this->assign('container', 'div'); ?>
	<?php $this->assign('row', 'p'); ?>
	<?php $this->assign('cell', 'label'); ?>
<?php endif; ?>

<<?php echo $this->_tpl_vars['container']; ?>
>
	<?php $_from = $this->_tpl_vars['item']['attributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['attributes'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['attributes']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['attr']):
        $this->_foreach['attributes']['iteration']++;
?>

		<?php if ($this->_tpl_vars['attr']['values'] || $this->_tpl_vars['attr']['value'] || $this->_tpl_vars['attr']['value_lang']): ?>

			<?php if ($this->_tpl_vars['prevAttr']['EavField']['EavFieldGroup']['ID'] != $this->_tpl_vars['attr']['EavField']['EavFieldGroup']['ID']): ?>
				<<?php echo $this->_tpl_vars['row']; ?>
 class="specificationGroup<?php if (($this->_foreach['attributes']['iteration'] <= 1)): ?> first<?php endif; ?>">
					<<?php echo $this->_tpl_vars['cell']; ?>
 class="param"><?php echo $this->_tpl_vars['attr']['EavField']['EavFieldGroup']['name_lang']; ?>
</<?php echo $this->_tpl_vars['cell']; ?>
>
					<<?php echo $this->_tpl_vars['cell']; ?>
 class="value"></<?php echo $this->_tpl_vars['cell']; ?>
>
				</<?php echo $this->_tpl_vars['row']; ?>
>
			<?php endif; ?>
			<<?php echo $this->_tpl_vars['row']; ?>
 class="<?php echo smarty_function_zebra(array('loop' => 'attributes'), $this);?>
">
				<<?php echo $this->_tpl_vars['cell']; ?>
 class="param"><?php echo $this->_tpl_vars['attr']['EavField']['name_lang']; ?>
</<?php echo $this->_tpl_vars['cell']; ?>
>
				<<?php echo $this->_tpl_vars['cell']; ?>
 class="value">
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
				</<?php echo $this->_tpl_vars['cell']; ?>
>
			</<?php echo $this->_tpl_vars['row']; ?>
>
			<?php $this->assign('prevAttr', $this->_tpl_vars['attr']); ?>

		<?php endif; ?>

	<?php endforeach; endif; unset($_from); ?>
</<?php echo $this->_tpl_vars['container']; ?>
>