<?php /* Smarty version 2.6.26, created on 2015-12-01 12:14:53
         compiled from /home/illumin/public_html/application/view///backend/newsletterSubscriber/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'activeGrid', '/home/illumin/public_html/application/view///backend/newsletterSubscriber/index.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/newsletterSubscriber/index.tpl', 22, false),array('modifier', 'addslashes', '/home/illumin/public_html/application/view///backend/newsletterSubscriber/index.tpl', 22, false),)), $this); ?>
<?php echo smarty_function_activeGrid(array('prefix' => 'newsletterSubscriber','id' => 0,'controller' => "backend.newsletterSubscriber",'action' => 'lists','displayedColumns' => $this->_tpl_vars['displayedColumns'],'availableColumns' => $this->_tpl_vars['availableColumns'],'totalCount' => 0,'filters' => $this->_tpl_vars['filters'],'container' => 'tabSubscribers','count' => "backend/newsletterSubscriber/count.tpl",'massAction' => "backend/newsletterSubscriber/massAction.tpl"), $this);?>



<?php echo '
<script type="text/javascript">
'; ?>


	var massHandler = new ActiveGrid.MassActionHandler(
						$('newsletterSubscriberMass_0'),
						window.activeGrids['newsletterSubscriber_0']
						);
	massHandler.deleteConfirmMessage = '<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_newsletter_delete_confirm'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__newsletter_delete_confirm', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__newsletter_delete_confirm'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
' ;
	massHandler.nothingSelectedMessage = '<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_nothing_selected'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__nothing_selected', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__nothing_selected'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
' ;
<?php echo '
</script>
'; ?>