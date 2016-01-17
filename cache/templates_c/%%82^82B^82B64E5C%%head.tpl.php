<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:44
         compiled from custom:category/head.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'custom:category/head.tpl', 1, false),array('modifier', 'config', 'custom:category/head.tpl', 23, false),array('function', 'renderBlock', 'custom:category/head.tpl', 30, false),)), $this); ?>
<?php if ($this->_tpl_vars['manufacturerFilter'] && ( count($this->_tpl_vars['appliedFilters']) == 1 ) && ( $this->_tpl_vars['currentPage'] == 1 )): ?>
	<h1><?php echo $this->_tpl_vars['manufacturerFilter']['name_lang']; ?>
</h1>

	<?php if ($this->_tpl_vars['products']['0']['Manufacturer']['attributes'] || $this->_tpl_vars['products']['0']['Manufacturer']['DefaultImage']['ID']): ?>
		<fieldset class="container" style="margin-bottom: 1em;">
			<?php if ($this->_tpl_vars['products']['0']['Manufacturer']['attributes']): ?>
				<div id="productSpecification" class="manufacturerAttributes">
					<table class="productTable">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/specificationTableBody.tpl", 'smarty_include_vars' => array('attributes' => $this->_tpl_vars['products']['0']['Manufacturer']['attributes'],'field' => 'EavField','group' => 'EavFieldGroup')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</table>
				</div>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['products']['0']['Manufacturer']['DefaultImage']['ID']): ?>
				<img src="<?php echo $this->_tpl_vars['products']['0']['Manufacturer']['DefaultImage']['paths']['3']; ?>
" alt="<?php echo $this->_tpl_vars['products']['0']['Manufacturer']['name_lang']; ?>
" class="manufacturerImage" />
			<?php endif; ?>
		</fieldset>
	<?php endif; ?>
<?php else: ?>
	<h1><?php echo $this->_tpl_vars['category']['name_lang']; ?>
<?php if ($this->_tpl_vars['searchQuery']): ?> &gt;&gt; "<span class="keywords"><?php echo $this->_tpl_vars['searchQuery']; ?>
</span>"<?php endif; ?></h1>
<?php endif; ?>

<?php if (((is_array($_tmp='DISPLAY_CATEGORY_DESC')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) && $this->_tpl_vars['category']['description_lang']): ?>
	<div class="descr categoryDescr" style="background-color: white;
    margin-bottom: 20px; padding: 10px;">
		<?php echo $this->_tpl_vars['category']['description_lang']; ?>

	</div>
<?php endif; ?>

<?php echo smarty_function_renderBlock(array('block' => 'RELATED_CATEGORIES'), $this);?>