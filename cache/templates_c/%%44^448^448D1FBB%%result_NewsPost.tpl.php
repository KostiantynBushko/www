<?php /* Smarty version 2.6.26, created on 2015-12-02 00:06:30
         compiled from custom:search/block/result_NewsPost.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'newsUrl', 'custom:search/block/result_NewsPost.tpl', 2, false),)), $this); ?>
<li>
	<a href="<?php echo smarty_function_newsUrl(array('news' => $this->_tpl_vars['record']), $this);?>
"><?php echo $this->_tpl_vars['record']['title_lang']; ?>
</a> <span class="date">(<?php echo $this->_tpl_vars['record']['formatted_time']['date_long']; ?>
)</span>
</li>