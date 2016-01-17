<?php /* Smarty version 2.6.26, created on 2015-12-03 18:16:34
         compiled from custom:backend/discount/grid.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', 'custom:backend/discount/grid.tpl', 3, false),array('function', 'activeGrid', 'custom:backend/discount/grid.tpl', 7, false),array('function', 'translate', 'custom:backend/discount/grid.tpl', 23, false),array('modifier', 'addslashes', 'custom:backend/discount/grid.tpl', 23, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
	Backend.Discount.GridFormatter.url = \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.discount"), $this);?>
<?php echo '\';
</script>
'; ?>


<?php echo smarty_function_activeGrid(array('prefix' => 'discount','id' => 0,'role' => "product.mass",'controller' => "backend.discount",'action' => 'lists','displayedColumns' => $this->_tpl_vars['displayedColumns'],'availableColumns' => $this->_tpl_vars['availableColumns'],'totalCount' => $this->_tpl_vars['totalCount'],'container' => 'discountGrid','dataFormatter' => "Backend.Discount.GridFormatter",'massAction' => "backend/discount/massAction.tpl",'count' => "backend/discount/gridCount.tpl"), $this);?>


<?php echo '
<script type="text/javascript">
	var massHandler = new ActiveGrid.MassActionHandler($(\'discountMass\'), window.activeGrids[\'discount_0\']);
	massHandler.deleteConfirmMessage = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_are_you_sure_you_want_to_delete_rule'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__are_you_sure_you_want_to_delete_rule', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__are_you_sure_you_want_to_delete_rule'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\' ;
	massHandler.nothingSelectedMessage = \''; ?>
<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_nothing_selected'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__nothing_selected', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__nothing_selected'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
<?php echo '\' ;
</script>
'; ?>
