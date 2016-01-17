<?php /* Smarty version 2.6.26, created on 2015-12-01 11:26:53
         compiled from custom:search/block/allResults.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'maketext', 'custom:search/block/allResults.tpl', 4, false),array('function', 'link', 'custom:search/block/allResults.tpl', 14, false),array('modifier', 'config', 'custom:search/block/allResults.tpl', 12, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['modelSearch']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['results']):
?>
	<?php if ($this->_tpl_vars['results']['count']): ?>
		<div class="modelSearchResults">
			<div class="resultStats"><?php echo smarty_function_maketext(array('text' => '_found_x','params' => $this->_tpl_vars['results']['meta']['name']), $this);?>
 <span class="count">(<?php echo $this->_tpl_vars['results']['count']; ?>
)</span></div>

			<ol>
				<?php $_from = $this->_tpl_vars['results']['records']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['record']):
?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['results']['meta']['template'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endforeach; endif; unset($_from); ?>
			</ol>

			<?php if ($this->_tpl_vars['results']['count'] > $this->_plugins['modifier']['config'][0][0]->config('SEARCH_MODEL_PREVIEW')): ?>
				<div class="allResults">
					<a href="<?php echo smarty_function_link(array('controller' => 'search','action' => 'index','query' => "type=".($this->_tpl_vars['results']['meta']['class'])."&q=".($this->_tpl_vars['request']['q'])), $this);?>
"><?php echo smarty_function_maketext(array('text' => '_all_results','params' => $this->_tpl_vars['results']['count']), $this);?>
</a>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>