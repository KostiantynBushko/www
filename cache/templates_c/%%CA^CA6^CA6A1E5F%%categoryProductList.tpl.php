<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:33
         compiled from custom:category/categoryProductList.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'maketext', 'custom:category/categoryProductList.tpl', 5, false),array('function', 'translate', 'custom:category/categoryProductList.tpl', 12, false),array('function', 'selectfield', 'custom:category/categoryProductList.tpl', 14, false),array('function', 'link', 'custom:category/categoryProductList.tpl', 24, false),array('function', 'paginate', 'custom:category/categoryProductList.tpl', 31, false),array('modifier', 'count', 'custom:category/categoryProductList.tpl', 11, false),array('block', 'form', 'custom:category/categoryProductList.tpl', 13, false),)), $this); ?>
<?php if ($this->_tpl_vars['products']): ?>
	<div class="resultStats">
		<fieldset class="container">
		<div class="pagingInfo">
			<?php echo smarty_function_maketext(array('text' => '_showing_products','params' => ($this->_tpl_vars['offsetStart']).",".($this->_tpl_vars['offsetEnd']).",".($this->_tpl_vars['count'])), $this);?>

		</div>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/block/switchListLayout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<div class="sortOptions">
			<?php if ($this->_tpl_vars['sortOptions'] && ( count($this->_tpl_vars['sortOptions']) > 1 )): ?>
				<?php echo smarty_function_translate(array('text' => '_sort_by'), $this);?>

				<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['sortForm'],'action' => 'self','method' => 'get')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php echo smarty_function_selectfield(array('id' => 'productSort','name' => 'sort','options' => $this->_tpl_vars['sortOptions'],'onchange' => "this.form.submit();"), $this);?>

				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php endif; ?>
			&nbsp;
		</div>

		</fieldset>
	</div>

	<?php if ($this->_tpl_vars['products']): ?>
		<form action="<?php echo smarty_function_link(array('controller' => 'category','action' => 'listAction','returnPath' => true), $this);?>
" method="post">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/productListLayout.tpl", 'smarty_include_vars' => array('products' => $this->_tpl_vars['products'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</form>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['count'] > $this->_tpl_vars['perPage']): ?>
		<div class="resultPages">
			<span><?php echo smarty_function_translate(array('text' => '_pages'), $this);?>
:</span> <?php echo smarty_function_paginate(array('current' => $this->_tpl_vars['currentPage'],'count' => $this->_tpl_vars['count'],'perPage' => $this->_tpl_vars['perPage'],'url' => $this->_tpl_vars['url']), $this);?>

		</div>
	<?php endif; ?>
<?php endif; ?>