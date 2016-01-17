<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:36
         compiled from custom:order/changeMessages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'custom:order/changeMessages.tpl', 5, false),array('function', 'translate', 'custom:order/changeMessages.tpl', 6, false),array('function', 'maketext', 'custom:order/changeMessages.tpl', 12, false),)), $this); ?>
<?php if ($this->_tpl_vars['changes']): ?>
	<?php $_from = $this->_tpl_vars['changes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['type'] => $this->_tpl_vars['items']):
?>
		<div style="clear: left;"></div>
		<div class="infoMessage message">
			<?php if (count($this->_tpl_vars['items']) > 1): ?>
				<div><?php echo smarty_function_translate(array('text' => "_order_auto_changes_".($this->_tpl_vars['type'])), $this);?>
:</div>
				<ul>
					<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<li>
							<?php echo $this->_tpl_vars['itemsById'][$this->_tpl_vars['item']['id']]['Product']['name_lang']; ?>

							<?php if ('count' == $this->_tpl_vars['type']): ?>
								- <?php echo smarty_function_maketext(array('text' => '_order_quantity_change','params' => ($this->_tpl_vars['item']['from']).",".($this->_tpl_vars['item']['to'])), $this);?>

							<?php endif; ?>
						</li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
			<?php else: ?>
				<?php echo smarty_function_maketext(array('text' => "_order_auto_changes_single_".($this->_tpl_vars['type']),'params' => ($this->_tpl_vars['itemsById'][$this->_tpl_vars['items']['0']['id']]['Product']['name_lang']).",".($this->_tpl_vars['items']['0']['from']).",".($this->_tpl_vars['items']['0']['to'])), $this);?>

			<?php endif; ?>
		</div>
	<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>