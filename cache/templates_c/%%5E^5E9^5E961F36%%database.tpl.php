<?php /* Smarty version 2.6.26, created on 2015-12-03 07:10:19
         compiled from /home/illumin/public_html/application/view///err/database.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///err/database.tpl', 1, false),)), $this); ?>
<h1><?php echo smarty_function_translate(array('text' => '_database_connection_error'), $this);?>
</h1>
<p>
	<?php echo smarty_function_translate(array('text' => '_db_error'), $this);?>

</p>

<div style="margin-top: 1em; border: 1px solid red; padding: 1em; font-weight: bold;">
	<?php echo $this->_tpl_vars['error']; ?>

</div>