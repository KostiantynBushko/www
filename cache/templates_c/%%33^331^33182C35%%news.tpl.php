<?php /* Smarty version 2.6.26, created on 2015-12-01 10:49:53
         compiled from /home/illumin/public_html/application/view///rss/news.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///rss/news.tpl', 4, false),array('function', 'link', '/home/illumin/public_html/application/view///rss/news.tpl', 5, false),array('function', 'newsUrl', '/home/illumin/public_html/application/view///rss/news.tpl', 10, false),)), $this); ?>
<?php ob_end_clean(); ?>
<rss version="2.0">
	<channel>
		<title><?php echo smarty_function_translate(array('text' => '_news'), $this);?>
</title>     
		<link><?php echo smarty_function_link(array('controller' => 'news','action' => 'index','url' => true), $this);?>
</link>
		<description></description>
		<?php $_from = $this->_tpl_vars['feed']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
			<item>
				<title><![CDATA[<?php echo $this->_tpl_vars['entry']['title_lang']; ?>
]]></title>
				<link><![CDATA[<?php echo smarty_function_newsUrl(array('news' => $this->_tpl_vars['entry'],'full' => true), $this);?>
]]></link> 
				<description><![CDATA[<?php echo $this->_tpl_vars['entry']['text_lang']; ?>
]]></description>
			</item>
		<?php endforeach; endif; unset($_from); ?>
	</channel>
</rss>