<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:33
         compiled from custom:product/block/smallImage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'productUrl', 'custom:product/block/smallImage.tpl', 2, false),array('function', 'img', 'custom:product/block/smallImage.tpl', 4, false),array('modifier', 'escape', 'custom:product/block/smallImage.tpl', 4, false),array('modifier', 'config', 'custom:product/block/smallImage.tpl', 6, false),)), $this); ?>
<div class="image">
	<a href="<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['product'],'filterChainHandle' => $this->_tpl_vars['filterChainHandle']), $this);?>
">
	<?php if ($this->_tpl_vars['product']['DefaultImage']['ID']): ?>
		<?php echo smarty_function_img(array('src' => $this->_tpl_vars['product']['DefaultImage']['paths']['2'],'alt' => ((is_array($_tmp=$this->_tpl_vars['product']['name_lang'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))), $this);?>

	<?php else: ?>
		<?php echo smarty_function_img(array('src' => ((is_array($_tmp='MISSING_IMG_SMALL')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)),'alt' => ((is_array($_tmp=$this->_tpl_vars['product']['name_lang'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))), $this);?>

	<?php endif; ?>
	</a>
</div>