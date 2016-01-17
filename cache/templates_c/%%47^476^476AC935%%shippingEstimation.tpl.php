<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:01
         compiled from custom:order/block/shippingEstimation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:order/block/shippingEstimation.tpl', 1, false),array('modifier', 'escape', 'custom:order/block/shippingEstimation.tpl', 34, false),array('function', 'math', 'custom:order/block/shippingEstimation.tpl', 3, false),array('function', 'translate', 'custom:order/block/shippingEstimation.tpl', 5, false),array('function', 'uniqid', 'custom:order/block/shippingEstimation.tpl', 11, false),array('function', 'selectfield', 'custom:order/block/shippingEstimation.tpl', 11, false),array('function', 'textfield', 'custom:order/block/shippingEstimation.tpl', 21, false),)), $this); ?>
<?php if (! $this->_tpl_vars['hideShippingEstimationForm'] && ((is_array($_tmp='ENABLE_SHIPPING_ESTIMATE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
<tr id="shippingEstimation">
	<td colspan="<?php echo smarty_function_math(array('equation' => ($this->_tpl_vars['extraColspanSize'])." + 5"), $this);?>
">
		<div class="container">
			<h2><?php echo smarty_function_translate(array('text' => '_estimate_shipping'), $this);?>
</h2>

			<?php $this->assign('fields', ((is_array($_tmp='SHIP_ESTIMATE_FIELDS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))); ?>

			<p <?php if (! $this->_tpl_vars['fields']['COUNTRY']): ?>style="display: none;"<?php endif; ?>>
				<label><?php echo smarty_function_translate(array('text' => '_country'), $this);?>
</label>
				<?php ob_start(); ?><?php echo smarty_function_uniqid(array('assign' => 'id_country'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_selectfield(array('name' => 'estimate_country','options' => $this->_tpl_vars['countries'],'id' => ($this->_tpl_vars['blockAsParamValue'])), $this);?>

			</p>

			<?php if ($this->_tpl_vars['fields']['STATE']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/addressFormState.tpl", 'smarty_include_vars' => array('states' => $this->_tpl_vars['states'],'notRequired' => true,'prefix' => 'estimate_')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['fields']['POSTALCODE']): ?>
				<p>
					<label><?php echo smarty_function_translate(array('text' => '_postal_code'), $this);?>
</label>
					<?php echo smarty_function_textfield(array('name' => 'estimate_postalCode'), $this);?>

				</p>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['fields']['CITY']): ?>
				<p>
					<label><?php echo smarty_function_translate(array('text' => '_city'), $this);?>
</label>
					<?php echo smarty_function_textfield(array('name' => 'estimate_city'), $this);?>

				</p>
			<?php endif; ?>

			<p>
				<label></label>
				<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_update_address','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" name="updateEstimateAddress" />
			</p>
		</div>
	</td>
</tr>
<?php endif; ?>