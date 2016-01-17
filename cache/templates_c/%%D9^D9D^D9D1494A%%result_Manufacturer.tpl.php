<?php /* Smarty version 2.6.26, created on 2015-12-08 10:59:10
         compiled from custom:search/block/result_Manufacturer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', 'custom:search/block/result_Manufacturer.tpl', 2, false),)), $this); ?>
<li>
	<a href="<?php echo smarty_function_link(array('controller' => 'manufacturers','action' => 'view','id' => $this->_tpl_vars['record']['ID']), $this);?>
"><?php echo $this->_tpl_vars['record']['name']; ?>
</a>
</li>