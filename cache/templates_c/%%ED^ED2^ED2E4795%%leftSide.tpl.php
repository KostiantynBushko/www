<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from custom:layout/frontend/leftSide.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'renderBlock', 'custom:layout/frontend/leftSide.tpl', 4, false),array('modifier', 'config', 'custom:layout/frontend/leftSide.tpl', 6, false),)), $this); ?>
<div id="leftSide">
	<div id="contentWrapperLeft"></div>

	<?php echo smarty_function_renderBlock(array('block' => 'LEFT_SIDE'), $this);?>


	<?php if (((is_array($_tmp='CATEGORY_MENU_TYPE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) == 'CAT_MENU_FLYOUT'): ?>
		<?php echo smarty_function_renderBlock(array('block' => 'DYNAMIC_CATEGORIES'), $this);?>

	<?php elseif (((is_array($_tmp='CATEGORY_MENU_TYPE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) == 'CAT_MENU_STANDARD'): ?>
		<?php echo smarty_function_renderBlock(array('block' => 'CATEGORY_BOX'), $this);?>

	<?php endif; ?>
	<?php echo smarty_function_renderBlock(array('block' => 'INFORMATION'), $this);?>

	<?php echo smarty_function_renderBlock(array('block' => 'COMPARE'), $this);?>

	<?php echo smarty_function_renderBlock(array('block' => 'FILTER_BOX'), $this);?>


	<?php echo smarty_function_renderBlock(array('block' => 'NEWSLETTER'), $this);?>

	<?php echo smarty_function_renderBlock(array('block' => 'QUICKNAV'), $this);?>


	<div class="clear"></div>
</div>