<?php /* Smarty version 2.6.26, created on 2015-12-01 10:29:42
         compiled from /home/illumin/public_html/application/view///rss/products.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'categoryUrl', '/home/illumin/public_html/application/view///rss/products.tpl', 5, false),array('function', 'productUrl', '/home/illumin/public_html/application/view///rss/products.tpl', 12, false),)), $this); ?>
<?php ob_end_clean(); ?>
<rss version="2.0">
	<channel>
		<title><![CDATA[<?php echo $this->_tpl_vars['category']['name_lang']; ?>
]]></title>     
		<link><![CDATA[<?php echo smarty_function_categoryUrl(array('data' => $this->_tpl_vars['category']), $this);?>
]]></link>
		<description><?php echo $this->_tpl_vars['category']['description_lang']; ?>
</description>

		<?php $_from = $this->_tpl_vars['feed']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
			<?php if ($this->_tpl_vars['product']['ID']): ?>
				<item>
					<title><![CDATA[<?php echo $this->_tpl_vars['product']['name_lang_safe']; ?>
]]></title>
					<link><![CDATA[<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['product'],'full' => true), $this);?>
]]></link> 
					<description><![CDATA[<?php echo $this->_tpl_vars['product']['shortDescription_lang']; ?>
]]></description>
									</item>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</channel>
</rss>