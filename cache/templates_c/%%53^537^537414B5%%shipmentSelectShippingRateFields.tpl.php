<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from custom:checkout/block/shipmentSelectShippingRateFields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'radio', 'custom:checkout/block/shipmentSelectShippingRateFields.tpl', 3, false),array('function', 'translate', 'custom:checkout/block/shipmentSelectShippingRateFields.tpl', 31, false),array('modifier', 'count', 'custom:checkout/block/shipmentSelectShippingRateFields.tpl', 12, false),array('modifier', 'escape', 'custom:checkout/block/shipmentSelectShippingRateFields.tpl', 28, false),array('block', 'error', 'custom:checkout/block/shipmentSelectShippingRateFields.tpl', 45, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['rates'][$this->_tpl_vars['key']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rates'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rates']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rate']):
        $this->_foreach['rates']['iteration']++;
?>
	<p>
		<?php echo smarty_function_radio(array('name' => "shipping_".($this->_tpl_vars['key']),'id' => "shipping_".($this->_tpl_vars['key'])."_".($this->_tpl_vars['rate']['serviceID']),'value' => $this->_tpl_vars['rate']['serviceID'],'class' => 'radio'), $this);?>

		<label for="shipping_<?php echo $this->_tpl_vars['key']; ?>
_<?php echo $this->_tpl_vars['rate']['serviceID']; ?>
" class="radio">
			<?php echo $this->_tpl_vars['rate']['ShippingService']['name_lang']; ?>

			(&rlm;<strong><?php echo $this->_tpl_vars['rate']['taxPrice'][$this->_tpl_vars['currency']]; ?>
</strong>)
			<?php $_from = $this->_tpl_vars['rate']['ShippingService']['attributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attr']):
?>
				<p class="fieldDescription">
					<label class="attrName fieldDescription"><?php echo $this->_tpl_vars['attr']['EavField']['name_lang']; ?>
:</label>
					<label class="attrValue fieldDescription">
						<?php if ($this->_tpl_vars['attr']['values']): ?>
							<ul class="attributeList<?php if (count($this->_tpl_vars['attr']['values']) == 1): ?> singleValue<?php endif; ?>">
								<?php $_from = $this->_tpl_vars['attr']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
									<li class="fieldDescription"> <?php echo $this->_tpl_vars['value']['value_lang']; ?>
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
				</p>
			<?php endforeach; endif; unset($_from); ?>
				
			<p class="fieldDescription">
				<?php if ($this->_tpl_vars['rate']['ShippingService']['description_lang']): ?>
					<?php echo ((is_array($_tmp=$this->_tpl_vars['rate']['ShippingService']['description_lang'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
				<?php endif; ?>
				<?php if ($this->_tpl_vars['rate']['ShippingService']['formatted_deliveryTimeMaxDays'] && $this->_tpl_vars['rate']['ShippingService']['formatted_deliveryTimeMinDays']): ?>
					<?php echo smarty_function_translate(array('text' => '_deliveryDate_between'), $this);?>
:
					<strong><?php echo ((is_array($_tmp=$this->_tpl_vars['rate']['ShippingService']['formatted_deliveryTimeMinDays']['date_long'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</strong>
						<?php echo smarty_function_translate(array('text' => '_and'), $this);?>

					<strong><?php echo ((is_array($_tmp=$this->_tpl_vars['rate']['ShippingService']['formatted_deliveryTimeMaxDays']['date_long'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</strong>
				<?php elseif ($this->_tpl_vars['rate']['ShippingService']['formatted_deliveryTimeMaxDays']): ?>
					<?php echo smarty_function_translate(array('text' => '_deliveryDate_before'), $this);?>
: <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['rate']['ShippingService']['formatted_deliveryTimeMaxDays']['date_long'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</strong>
				<?php elseif ($this->_tpl_vars['rate']['ShippingService']['formatted_deliveryTimeMinDays']): ?>
					<?php echo smarty_function_translate(array('text' => '_deliveryDate_after'), $this);?>
: <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['rate']['ShippingService']['formatted_deliveryTimeMinDays']['date_long'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</strong>
				<?php endif; ?>
			</p>
		</label>
	</p>
<?php endforeach; endif; unset($_from); ?>

<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => "shipping_".($this->_tpl_vars['key']))); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" style="clear: both;">
	<div><?php $this->_tag_stack[] = array('error', array('for' => "shipping_".($this->_tpl_vars['key']))); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
</div>