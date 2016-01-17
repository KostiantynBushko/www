<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from /home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/category.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'categoryUrl', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/category.tpl', 10, false),array('modifier', 'config', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/category.tpl', 12, false),)), $this); ?>
<?php if (!function_exists('smarty_fun_categoryTree')) { function smarty_fun_categoryTree(&$smarty, $params) { $_fun_tpl_vars = $smarty->_tpl_vars; $smarty->assign($params);  ?>
	<?php if ($smarty->_tpl_vars['node']): ?>
		<ul>
		<?php $_from = $smarty->_tpl_vars['node']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $smarty->_tpl_vars['category']):
?>
			<?php if ($smarty->_tpl_vars['category']['ID'] == $smarty->_tpl_vars['currentId']): ?>
				<li class="current">
					<span class="currentName"><?php echo $smarty->_tpl_vars['category']['name_lang']; ?>
</span>
			<?php else: ?>
				<li>
					<a href="<?php echo smarty_function_categoryUrl(array('data' => $smarty->_tpl_vars['category'],'filters' => $smarty->_tpl_vars['category']['filters']), $smarty);?>
"><?php echo $smarty->_tpl_vars['category']['name_lang']; ?>
</a>
			<?php endif; ?>
					<?php if (((is_array($_tmp='DISPLAY_NUM_CAT')) ? $smarty->_run_mod_handler('config', true, $_tmp) : $smarty->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
						<span class="count">(&rlm;<?php echo $smarty->_tpl_vars['category']['count']; ?>
)</span>
					<?php endif; ?>
					<?php if ($smarty->_tpl_vars['category']['subCategories']): ?>
		   				<?php smarty_fun_categoryTree($smarty, array('node'=>$smarty->_tpl_vars['category']['subCategories']));  ?>
					<?php endif; ?>
				</li>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
	<?php endif; ?>
<?php  $smarty->_tpl_vars = $_fun_tpl_vars; }} smarty_fun_categoryTree($this, array('node'=>false,'filters'=>false));  ?>

<div class="box categories" style="border-left: 1px solid #ebebeb; border-right: 1px solid #ebebeb;">
	<div class="title">
		<div>Our Glasses Brands</div>
	</div>

	<div class="content">
		<?php smarty_fun_categoryTree($this, array('node'=>$this->_tpl_vars['categories']));  ?>
	</div>
</div>