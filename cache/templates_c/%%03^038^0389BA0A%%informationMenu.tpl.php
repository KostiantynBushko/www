<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from /home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/informationMenu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'pageUrl', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/informationMenu.tpl', 10, false),)), $this); ?>
<?php if ($this->_tpl_vars['pages']): ?>
<div class="box informationMenu" style="border-left: 1px solid #ebebeb; border-right: 1px solid #ebebeb;">
	<div class="title">
		<div>Shipping Info</div>
	</div>

	<div class="content">
		<ul>
		<?php $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
			<li id="static_<?php echo $this->_tpl_vars['page']['ID']; ?>
" class="aboutUsMenu"><a href="<?php echo smarty_function_pageUrl(array('data' => $this->_tpl_vars['page']), $this);?>
"><?php echo $this->_tpl_vars['page']['title_lang']; ?>
</a></li>
			<?php if ($this->_tpl_vars['page']['children']): ?>
				<ul>
					<?php $_from = $this->_tpl_vars['page']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
						<li id="static_<?php echo $this->_tpl_vars['page']['ID']; ?>
" class="aboutUsMenuLi"><a href="<?php echo smarty_function_pageUrl(array('data' => $this->_tpl_vars['page']), $this);?>
"><?php echo $this->_tpl_vars['page']['title_lang']; ?>
</a></li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
	</div>
</div>
<?php endif; ?>