<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:01
         compiled from custom:order/block/coupons.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'custom:order/block/coupons.tpl', 3, false),array('function', 'translate', 'custom:order/block/coupons.tpl', 5, false),array('modifier', 'escape', 'custom:order/block/coupons.tpl', 5, false),)), $this); ?>
<?php if ($this->_tpl_vars['isCouponCodes']): ?>
	<tr id="couponCodes">
		<td colspan="<?php echo smarty_function_math(array('equation' => ($this->_tpl_vars['extraColspanSize'])." + 5"), $this);?>
">
			<div class="container">
				<?php echo smarty_function_translate(array('text' => '_have_coupon'), $this);?>
: <input type="text" class="text coupon" name="coupon" /> <input type="submit" class="submit coupon" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_add_coupon','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
				<?php if ($this->_tpl_vars['cart']['coupons']): ?>
					<p class="appliedCoupons">
						<?php echo smarty_function_translate(array('text' => '_applied_coupons'), $this);?>
:
						<?php $_from = $this->_tpl_vars['cart']['coupons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['coupons'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['coupons']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['coupon']):
        $this->_foreach['coupons']['iteration']++;
?>
							<strong><?php echo $this->_tpl_vars['coupon']['couponCode']; ?>
</strong><?php if (! ($this->_foreach['coupons']['iteration'] == $this->_foreach['coupons']['total'])): ?>, <?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					</p>
				<?php endif; ?>
			</div>
		</td>
	<tr>
<?php endif; ?>