<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from custom:layout/frontend/layout.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:layout/frontend/layout.tpl', 1, false),array('modifier', 'escape', 'custom:layout/frontend/layout.tpl', 2, false),array('function', 'translate', 'custom:layout/frontend/layout.tpl', 4, false),array('function', 'link', 'custom:layout/frontend/layout.tpl', 4, false),)), $this); ?>
<?php $this->assign('enabledFeeds', ((is_array($_tmp='ENABLED_FEEDS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))); ?>
<?php $this->assign('storeName', ((is_array($_tmp=((is_array($_tmp='STORE_NAME')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))); ?>
<?php if (array_key_exists ( 'NEWS_POSTS' , $this->_tpl_vars['enabledFeeds'] )): ?>
	<link rel="alternate" type="application/rss+xml" title="<?php echo $this->_tpl_vars['storeName']; ?>
 | <?php echo smarty_function_translate(array('text' => '_news_posts_feed'), $this);?>
" href="<?php echo smarty_function_link(array('controller' => 'rss','action' => 'news'), $this);?>
"/>
<?php endif; ?>
<?php if (array_key_exists ( 'CATEGORY_PRODUCTS' , $this->_tpl_vars['enabledFeeds'] ) && ! empty ( $this->_tpl_vars['category']['ID'] )): ?>
	<link rel="alternate" type="application/rss+xml" title="<?php echo $this->_tpl_vars['storeName']; ?>
 | <?php echo smarty_function_translate(array('text' => '_category_products_feed'), $this);?>
 (<?php echo ((is_array($_tmp=$this->_tpl_vars['category']['name_lang'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)" href="<?php echo smarty_function_link(array('controller' => 'rss','action' => 'products','id' => $this->_tpl_vars['category']['ID']), $this);?>
"/>
<?php endif; ?>
<?php if (array_key_exists ( 'ALL_PRODUCTS' , $this->_tpl_vars['enabledFeeds'] )): ?>
	<link rel="alternate" type="application/rss+xml" title="<?php echo $this->_tpl_vars['storeName']; ?>
 | <?php echo smarty_function_translate(array('text' => '_all_products_feed'), $this);?>
" href="<?php echo smarty_function_link(array('controller' => 'rss','action' => 'products'), $this);?>
"/>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if (! $this->_tpl_vars['hideLeft']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/leftSide.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>