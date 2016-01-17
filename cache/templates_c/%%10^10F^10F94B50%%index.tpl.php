<?php /* Smarty version 2.6.26, created on 2015-12-02 11:34:10
         compiled from /home/illumin/public_html/module/store-cloning/application/view/mirror/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', '/home/illumin/public_html/module/store-cloning/application/view/mirror/index.tpl', 15, false),)), $this); ?>
<?php echo '
<style>
#mirror
{
	top: 50px;
	width: 630px;
	height: 370px;
	border: 0;
	overflow: hidden;
	display: inline-block;
}
</style>
'; ?>


<iframe id="mirror" src="<?php echo smarty_function_link(array(), $this);?>
virtual_mirror/popup.php?file=<?php echo $this->_tpl_vars['mirror']; ?>
"></iframe>