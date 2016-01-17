<?php /* Smarty version 2.6.26, created on 2015-12-02 00:06:30
         compiled from custom:search/block/result_StaticPage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'pageUrl', 'custom:search/block/result_StaticPage.tpl', 2, false),)), $this); ?>
<li>
	<a href="<?php echo smarty_function_pageUrl(array('id' => $this->_tpl_vars['record']['ID']), $this);?>
"><?php echo $this->_tpl_vars['record']['title_lang']; ?>
</a>
</li>