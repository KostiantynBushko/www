<?php /* Smarty version 2.6.26, created on 2015-12-01 21:46:36
         compiled from custom:product/ratingImage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'round', 'custom:product/ratingImage.tpl', 1, false),)), $this); ?>
<img src="image/rating/<?php ob_start(); ?><?php echo round($this->_tpl_vars['rating']*2); ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo $this->_tpl_vars['blockAsParamValue']/2; ?>
.gif" />