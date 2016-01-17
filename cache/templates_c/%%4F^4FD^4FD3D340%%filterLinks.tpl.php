<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:33
         compiled from category/block/filterLinks.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'category/block/filterLinks.tpl', 1, false),array('modifier', 'hasFilters', 'category/block/filterLinks.tpl', 2, false),array('function', 'translate', 'category/block/filterLinks.tpl', 4, false),array('function', 'categoryUrl', 'category/block/filterLinks.tpl', 10, false),)), $this); ?>
<?php $this->assign('maxFilters', ((is_array($_tmp='MAX_FILTER_CRITERIA_COUNT')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))); ?>
<?php if (hasFilters($this->_tpl_vars['sectionFilters']['filters'])): ?>
	<div class="filterGroup">
		<h4><?php echo smarty_function_translate(array('text' => $this->_tpl_vars['title']), $this);?>
</h4>
		<ul>
			<?php $_from = $this->_tpl_vars['sectionFilters']['filters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['filters'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['filters']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['filter']):
        $this->_foreach['filters']['iteration']++;
?>
				<?php if ($this->_tpl_vars['filter']['count'] && ( ! $this->_tpl_vars['allLink'] || ( $this->_tpl_vars['allLink'] && ($this->_foreach['filters']['iteration']-1) < $this->_tpl_vars['maxFilters'] ) )): ?>
					<li>
						<div>
							<a href="<?php echo smarty_function_categoryUrl(array('data' => $this->_tpl_vars['category'],'filters' => $this->_tpl_vars['filters'],'addFilter' => $this->_tpl_vars['filter'],'removeFilters' => $this->_tpl_vars['sectionFilters']['filters']), $this);?>
"><?php echo $this->_tpl_vars['filter']['name_lang']; ?>
</a>
							<?php if (((is_array($_tmp='DISPLAY_NUM_FILTER')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
								 <span class="count">(&rlm;<?php echo $this->_tpl_vars['filter']['count']; ?>
)</span>
							<?php endif; ?>
						</div>
					</li>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>

			<?php if ($this->_tpl_vars['allLink']): ?>
				<li class="showAll"><a href="<?php echo $this->_tpl_vars['allLink']; ?>
"><?php echo smarty_function_translate(array('text' => $this->_tpl_vars['allTitle']), $this);?>
</a></li>
			<?php endif; ?>
		</ul>
	</div>
<?php endif; ?>