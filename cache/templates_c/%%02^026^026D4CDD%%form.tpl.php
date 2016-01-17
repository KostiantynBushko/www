<?php /* Smarty version 2.6.26, created on 2015-12-01 10:53:47
         compiled from custom:backend/quickSearch/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', 'custom:backend/quickSearch/form.tpl', 2, false),array('function', 'translate', 'custom:backend/quickSearch/form.tpl', 8, false),array('modifier', 'escape', 'custom:backend/quickSearch/form.tpl', 8, false),)), $this); ?>
<div id="<?php echo $this->_tpl_vars['formid']; ?>
Container">
	<form id="<?php echo $this->_tpl_vars['formid']; ?>
Form" method="post" action="<?php echo smarty_function_link(array('controller' => "backend.quickSearch",'action' => 'search'), $this);?>
" onsubmit="return false;">
		<input
			id="<?php echo $this->_tpl_vars['formid']; ?>
Query"
			autocomplete="off"
			name="q"
			type="text"
			value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => $this->_tpl_vars['hint']), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
"
			class="text quickSearchInput hasHint"
		/>
		<input type="hidden" value="<?php echo $this->_tpl_vars['limit']; ?>
" name="limit" />
		<input type="hidden" value="" name="class" id="<?php echo $this->_tpl_vars['formid']; ?>
Class" />
		<input type="hidden" value="" name="from" id="<?php echo $this->_tpl_vars['formid']; ?>
From" />
		<input type="hidden" value="" name="to" id="<?php echo $this->_tpl_vars['formid']; ?>
To" />
		<input type="hidden" value="" name="direction" id="<?php echo $this->_tpl_vars['formid']; ?>
Direction" />
		<input type="hidden" value='<?php echo $this->_tpl_vars['resultTemplates']; ?>
' name="resultTemplates" id="<?php echo $this->_tpl_vars['formid']; ?>
ResultTemplates" />

		<div id="<?php echo $this->_tpl_vars['formid']; ?>
ResultOuterContainer" class="QuickSearchResultOuterContainer" style="display: none;">
			<div id="<?php echo $this->_tpl_vars['formid']; ?>
Result" class="QuickSearchResult"></div>
		</div>
	</form>
</div>

<script type="text/javascript">
	Backend.QuickSearch.createInstance("<?php echo $this->_tpl_vars['formid']; ?>
", <?php echo '{'; ?>
cn:"<?php echo $this->_tpl_vars['classNames']; ?>
"<?php echo '}'; ?>
);
</script>