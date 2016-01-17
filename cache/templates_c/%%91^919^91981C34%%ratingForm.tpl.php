<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from custom:product/ratingForm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:product/ratingForm.tpl', 1, false),array('function', 'maketext', 'custom:product/ratingForm.tpl', 3, false),array('function', 'translate', 'custom:product/ratingForm.tpl', 3, false),array('function', 'link', 'custom:product/ratingForm.tpl', 6, false),)), $this); ?>
<?php if (((is_array($_tmp='ENABLE_RATINGS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) && ! $this->_tpl_vars['isRated']): ?>
<div id="ratingSection" class="productSection ratingSection">
<h2><?php echo smarty_function_maketext(array('text' => '_rate_product_name','params' => $this->_tpl_vars['product']['name_lang']), $this);?>
<small><?php echo smarty_function_translate(array('text' => '_rate'), $this);?>
</small></h2>
<div id="rateProduct">
	<?php if ($this->_tpl_vars['isLoginRequiredToRate']): ?>
		<p><?php ob_start(); ?><?php echo smarty_function_link(array('controller' => 'user','action' => 'login'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_maketext(array('text' => '_msg_rating_login_required','params' => $this->_tpl_vars['blockAsParamValue']), $this);?>
</p>
	<?php elseif ($this->_tpl_vars['isPurchaseRequiredToRate']): ?>
		<p><?php echo smarty_function_translate(array('text' => '_msg_rating_purchase_required'), $this);?>
</p>
	<?php else: ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/rate.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>
</div>
<?php endif; ?>