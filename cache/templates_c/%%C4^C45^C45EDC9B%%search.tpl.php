<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from /home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'categoryUrl', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/search.tpl', 3, false),array('function', 'hidden', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/search.tpl', 6, false),array('function', 'selectfield', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/search.tpl', 8, false),array('function', 'textfield', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/search.tpl', 10, false),array('function', 'renderBlock', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/search.tpl', 15, false),array('block', 'form', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/search.tpl', 4, false),array('modifier', 'config', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/search.tpl', 5, false),)), $this); ?>
<div id="searchContainer">
	<div class="wrapper">
		<?php ob_start(); ?><?php echo smarty_function_categoryUrl(array('data' => $this->_tpl_vars['category']), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('searchUrl', ob_get_contents());ob_end_clean(); ?>
		<?php $this->_tag_stack[] = array('form', array('action' => "controller=category",'class' => 'quickSearch','handle' => $this->_tpl_vars['form'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php if (((is_array($_tmp='HIDE_SEARCH_CATS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
				<?php echo smarty_function_hidden(array('name' => 'id','value' => '1'), $this);?>

			<?php else: ?>
				<?php echo smarty_function_selectfield(array('name' => 'id','options' => $this->_tpl_vars['categories']), $this);?>

			<?php endif; ?>
<?php echo smarty_function_textfield(array('class' => 'text searchQuery','name' => 'q','placeholder' => "Search...",'style' => "border: none; position: relative;"), $this);?>

<input type="submit" class="submit" style="position: relative; right: 29px; border: none; background-image: url('upload/theme/IlluminataV3/searchicon.jpg'); background-position: right; background-repeat: no-repeat; background-color: white; color: gray;" value="|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" />
			<input type="hidden" name="cathandle" value="search" />
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		
		<?php echo smarty_function_renderBlock(array('block' => 'CURRENCY'), $this);?>

		<?php echo smarty_function_renderBlock(array('block' => 'LANGUAGE'), $this);?>


		<div class="clear"></div>
	</div>
</div>