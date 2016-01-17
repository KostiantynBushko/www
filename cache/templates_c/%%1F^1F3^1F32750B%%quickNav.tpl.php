<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from /home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/quickNav.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'categoryUrl', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/quickNav.tpl', 4, false),array('function', 'translate', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/quickNav.tpl', 15, false),array('modifier', 'str_repeat', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/quickNav.tpl', 4, false),)), $this); ?>
<?php if (!function_exists('smarty_fun_dynamicCategoryTree')) { function smarty_fun_dynamicCategoryTree(&$smarty, $params) { $_fun_tpl_vars = $smarty->_tpl_vars; $smarty->assign($params);  ?>
	<?php if ($smarty->_tpl_vars['node']): ?>
		<?php $_from = $smarty->_tpl_vars['node']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $smarty->_tpl_vars['category']):
?>
			<option value="<?php echo smarty_function_categoryUrl(array('data' => $smarty->_tpl_vars['category']), $smarty);?>
"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;', $smarty->_tpl_vars['level']); ?>
 <?php echo $smarty->_tpl_vars['category']['name_lang']; ?>
</option>
			<?php if ($smarty->_tpl_vars['category']['subCategories']): ?>
				<?php smarty_fun_dynamicCategoryTree($smarty, array('node'=>$smarty->_tpl_vars['category']['subCategories'],'level'=>$smarty->_tpl_vars['level']+1));  ?>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
<?php  $smarty->_tpl_vars = $_fun_tpl_vars; }} smarty_fun_dynamicCategoryTree($this, array('node'=>false,'level'=>0));  ?>

<?php if ($this->_tpl_vars['manufacturers'] || $this->_tpl_vars['categories']): ?>
<div class="box quick-nav" style="border-left: 1px solid #ebebeb; border-right: 1px solid #ebebeb;">
	<div class="title">
		<div><?php echo smarty_function_translate(array('text' => '_quick_nav'), $this);?>
</div>
	</div>

	<div class="content">

		<?php if ($this->_tpl_vars['manufacturers']): ?>
			<p>
				<select onchange="window.location.href = this.value;" style="width: 100%; color: #5c318c; background-color: white; font-size: 12px; margin-top:20px;">
					<option><?php echo smarty_function_translate(array('text' => '_manufacturers'), $this);?>
</option>
					<?php $_from = $this->_tpl_vars['manufacturers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['man']):
?>
						<option value="<?php echo $this->_tpl_vars['man']['url']; ?>
"><?php echo $this->_tpl_vars['man']['name']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			</p>
		<?php endif; ?>

		
	</div>
</div>
<?php endif; ?>