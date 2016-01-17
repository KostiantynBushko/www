<?php /* Smarty version 2.6.26, created on 2015-12-01 21:46:36
         compiled from custom:product/ratingBreakdown.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'round', 'custom:product/ratingBreakdown.tpl', 4, false),)), $this); ?>
<?php if ($this->_tpl_vars['ratings'] && $this->_tpl_vars['ratings']['0']['RatingType']['ID']): ?>
	<ul class="ratingBreakdown">
	<?php $_from = $this->_tpl_vars['ratings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rating']):
?>
		<li><?php echo $this->_tpl_vars['rating']['RatingType']['name_lang']; ?>
: <img src="image/rating/category_<?php ob_start(); ?><?php echo round($this->_tpl_vars['rating']['rating']*2); ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo $this->_tpl_vars['blockAsParamValue']/2; ?>
.gif" /></li>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
<?php endif; ?>