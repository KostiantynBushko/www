<?php /* Smarty version 2.6.26, created on 2015-12-01 14:12:04
         compiled from /home/illumin/public_html/storage/customize/view//theme/IlluminataV3//news/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'pageTitle', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//news/index.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//news/index.tpl', 1, false),array('function', 'renderBlock', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//news/index.tpl', 9, false),)), $this); ?>
<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_news'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->assign('metaDescription', $this->_tpl_vars['category']['description_lang']); ?>
<?php $this->assign('metaKeywords', $this->_tpl_vars['category']['keywords_lang']); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content">
	<h1><?php echo smarty_function_translate(array('text' => '_news'), $this);?>
</h1>
<?php echo smarty_function_renderBlock(array('block' => 'NEWSLETTER'), $this);?>

	<ul class="news">
		<?php $_from = $this->_tpl_vars['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
			<li class="newsEntry">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:news/newsEntry.tpl", 'smarty_include_vars' => array('entry' => $this->_tpl_vars['entry'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>