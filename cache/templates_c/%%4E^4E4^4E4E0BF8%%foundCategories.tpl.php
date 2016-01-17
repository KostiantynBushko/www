<?php /* Smarty version 2.6.26, created on 2015-12-01 13:58:04
         compiled from custom:category/foundCategories.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'categoryUrl', 'custom:category/foundCategories.tpl', 7, false),array('function', 'translate', 'custom:category/foundCategories.tpl', 13, false),array('modifier', 'count', 'custom:category/foundCategories.tpl', 13, false),)), $this); ?>
<?php if (!function_exists('smarty_fun_categoryNode')) { function smarty_fun_categoryNode(&$smarty, $params) { $_fun_tpl_vars = $smarty->_tpl_vars; $smarty->assign($params);  ?>

	<?php if ($smarty->_tpl_vars['node']['ParentNode']): ?>

		<?php smarty_fun_categoryNode($smarty, array('node'=>$smarty->_tpl_vars['node']['ParentNode']));  ?>
		<?php if ($smarty->_tpl_vars['node']['ParentNode']['ID'] > 1): ?>&gt;<?php endif; ?>
		<a href="<?php echo smarty_function_categoryUrl(array('data' => $smarty->_tpl_vars['node']), $smarty);?>
"><?php echo $smarty->_tpl_vars['node']['name_lang']; ?>
</a>

	<?php endif; ?>

<?php  $smarty->_tpl_vars = $_fun_tpl_vars; }} smarty_fun_categoryNode($this, array('node'=>null));  ?>

<div class="resultStats"><?php echo smarty_function_translate(array('text' => '_found_cats'), $this);?>
 <span class="count">(<?php echo count($this->_tpl_vars['foundCategories']); ?>
)</span></div>
<ul class="foundCategories">
	<?php $_from = $this->_tpl_vars['foundCategories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>

		<li><?php smarty_fun_categoryNode($this, array('node'=>$this->_tpl_vars['category']));  ?></li>

	<?php endforeach; endif; unset($_from); ?>
</ul>