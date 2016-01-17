<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from /home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/rootCategory.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'categoryUrl', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/rootCategory.tpl', 5, false),array('function', 'pageUrl', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/rootCategory.tpl', 26, false),)), $this); ?>
<?php if (!function_exists('smarty_fun_rootdynamicCategoryTree')) { function smarty_fun_rootdynamicCategoryTree(&$smarty, $params) { $_fun_tpl_vars = $smarty->_tpl_vars; $smarty->assign($params);  ?>
	<?php if ($smarty->_tpl_vars['node']): ?>
		<?php $_from = $smarty->_tpl_vars['node']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $smarty->_tpl_vars['category']):
?>
				<div class="li <?php if ($smarty->_tpl_vars['category']['parentNodeID'] == 1): ?>top<?php endif; ?> <?php if ($smarty->_tpl_vars['category']['lft'] <= $smarty->_tpl_vars['currentCategory']['lft'] && $smarty->_tpl_vars['category']['rgt'] >= $smarty->_tpl_vars['currentCategory']['rgt']): ?> dynCurrent<?php endif; ?><?php if ($smarty->_tpl_vars['category']['subCategories']): ?> hasSubs<?php else: ?> noSubs<?php endif; ?>">
					<a href="<?php echo smarty_function_categoryUrl(array('data' => $smarty->_tpl_vars['category'],'filters' => $smarty->_tpl_vars['category']['filters']), $smarty);?>
"><?php echo $smarty->_tpl_vars['category']['name_lang']; ?>
</a>
					<?php if ($smarty->_tpl_vars['category']['subCategories']): ?>
						<div class="wrapper">
							<div class="block"><div class="block">
								<div class="ul">
				   					<?php smarty_fun_rootdynamicCategoryTree($smarty, array('node'=>$smarty->_tpl_vars['category']['subCategories']));  ?>
				   				</div>
				   			</div></div>
				   		</div>
					<?php endif; ?>
				</div>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
<?php  $smarty->_tpl_vars = $_fun_tpl_vars; }} smarty_fun_rootdynamicCategoryTree($this, array('node'=>false,'filters'=>false));  ?>

<div class="rootCategoriesWrapper1">
	<div class="rootCategoriesWrapper2">
		<div class="ul rootCategories<?php if ($this->_tpl_vars['currentId'] == $this->_tpl_vars['categories']['0']['ID']): ?> firstActive<?php endif; ?>" id="rootCategories">
			<?php smarty_fun_rootdynamicCategoryTree($this, array('node'=>$this->_tpl_vars['categories']));  ?>

			<?php $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['pages'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pages']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['page']):
        $this->_foreach['pages']['iteration']++;
?>
				<div class="li top <?php if (($this->_foreach['pages']['iteration'] == $this->_foreach['pages']['total'])): ?>last <?php endif; ?><?php if ($this->_tpl_vars['page']['ID'] == $this->_tpl_vars['currentId']): ?>current<?php endif; ?><?php if (! $this->_tpl_vars['subPages'][$this->_tpl_vars['page']['ID']]): ?>noSubs<?php endif; ?>"><a href="<?php echo smarty_function_pageUrl(array('data' => $this->_tpl_vars['page']), $this);?>
"><span class="name"><?php echo $this->_tpl_vars['page']['title_lang']; ?>
</span></a>
				<?php if ($this->_tpl_vars['subPages'][$this->_tpl_vars['page']['ID']]): ?>
					<div class="wrapper">
						<div class="block"><div class="block">
							<div class="ul">
								<?php $_from = $this->_tpl_vars['subPages'][$this->_tpl_vars['page']['ID']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
									<div class="li"><a href="<?php echo smarty_function_pageUrl(array('data' => $this->_tpl_vars['page']), $this);?>
"><span><?php echo $this->_tpl_vars['page']['title_lang']; ?>
</span></a></div>
								<?php endforeach; endif; unset($_from); ?>
							</div>
						</div></div>
					</div>
				<?php endif; ?>
				</div>
			<?php endforeach; endif; unset($_from); ?>
		</div>
	</div>
</div>



<div class="brands-menu">
	<div class="brands-link">Brands</div>
	<div class="wrapper">

	</div>	

<?php echo '
<script>
jQuery(function() {

	if ( jQuery(window).width() < 768 ) {
	
		jQuery(\'.brands-menu .wrapper\').html(\'<ul>\'+jQuery(\'.box.categories ul\').html()+\'</ul>\');
	
	};
	
	jQuery(\'.brands-link\')
		.bind(\'click\', function(event) {
				
		jQuery(this).closest(\'.brands-menu\')
			    .toggleClass(\'open\');
	 });

});
</script>
'; ?>

</div>

<?php echo '
<!--[if lte IE 6]>
<script type="text/javascript">
	$A($(\'rootCategories\').getElementsBySelector(\'.top\')).each(function(li)
	{
		Event.observe(li, \'mouseover\', function()
		{
			li.addClassName(\'hover\');
			var wrapper = li.down(\'div.wrapper\');
			if (wrapper)
			{
				wrapper.style.width = 120;
			}
		});
		Event.observe(li, \'mouseout\', function() { li.removeClassName(\'hover\'); });
	});
</script>
<![endif]-->
'; ?>