<?php /* Smarty version 2.6.26, created on 2015-12-01 10:59:03
         compiled from /home/illumin/public_html/application/view///staticPage/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'pageTitle', '/home/illumin/public_html/application/view///staticPage/view.tpl', 1, false),array('modifier', 'strip_tags', '/home/illumin/public_html/application/view///staticPage/view.tpl', 2, false),array('modifier', 'count', '/home/illumin/public_html/application/view///staticPage/view.tpl', 30, false),array('function', 'translate', '/home/illumin/public_html/application/view///staticPage/view.tpl', 12, false),array('function', 'pageUrl', '/home/illumin/public_html/application/view///staticPage/view.tpl', 15, false),)), $this); ?>
<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['page']['title_lang']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->assign('metaDescription', smarty_modifier_strip_tags($this->_tpl_vars['page']['metaDescription_lang'])); ?>

<div class="staticPageView staticPage_<?php echo $this->_tpl_vars['page']['ID']; ?>
">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content">
	<h1><?php echo $this->_tpl_vars['page']['title_lang']; ?>
</h1>
	<?php if ($this->_tpl_vars['subPages']): ?>
		<div class="staticSubpages">
			<h2><?php echo smarty_function_translate(array('text' => '_subpages'), $this);?>
</h2>
			<ul>
				<?php $_from = $this->_tpl_vars['subPages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subPage']):
?>
					<li id="static_<?php echo $this->_tpl_vars['subPage']['ID']; ?>
"><a href="<?php echo smarty_function_pageUrl(array('data' => $this->_tpl_vars['subPage']), $this);?>
"><?php echo $this->_tpl_vars['subPage']['title_lang']; ?>
</a></li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
	<?php endif; ?>

	<div class="staticPageText">
		<?php echo $this->_tpl_vars['page']['text_lang']; ?>

	</div>

	<?php $_from = $this->_tpl_vars['page']['attributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attr']):
?>
		<div class="eavAttr eav-<?php echo $this->_tpl_vars['attr']['EavField']['handle']; ?>
">
		<h3 class="attributeTitle"><?php echo $this->_tpl_vars['attr']['EavField']['name_lang']; ?>
</h3>
		<p class="attributeValue">
			<?php if ($this->_tpl_vars['attr']['values']): ?>
				<ul class="attributeList<?php if (count($this->_tpl_vars['attr']['values']) == 1): ?> singleValue<?php endif; ?>">
					<?php $_from = $this->_tpl_vars['attr']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
						<li class="fieldDescription"> <?php echo $this->_tpl_vars['value']['value_lang']; ?>
</li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
				<?php elseif ($this->_tpl_vars['attr']['value_lang']): ?>
					<?php echo $this->_tpl_vars['attr']['value_lang']; ?>

				<?php elseif ($this->_tpl_vars['attr']['value']): ?>
					<?php echo $this->_tpl_vars['attr']['EavField']['valuePrefix_lang']; ?>
<?php echo $this->_tpl_vars['attr']['value']; ?>
<?php echo $this->_tpl_vars['attr']['EavField']['valueSuffix_lang']; ?>

				<?php endif; ?>
		</p>
		</div>
	<?php endforeach; endif; unset($_from); ?>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>