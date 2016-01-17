<?php /* Smarty version 2.6.26, created on 2015-12-01 10:53:47
         compiled from /home/illumin/public_html/application/view//block/backend/userMenu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view//block/backend/userMenu.tpl', 1, false),array('function', 'link', '/home/illumin/public_html/application/view//block/backend/userMenu.tpl', 1, false),)), $this); ?>
<?php echo smarty_function_translate(array('text' => '_logged_as'), $this);?>
: <span id="headerUserName"><?php echo $this->_tpl_vars['user']['fullName']; ?>
</span> <a href="<?php echo smarty_function_link(array('controller' => "backend.session",'action' => 'logout'), $this);?>
">(<?php echo smarty_function_translate(array('text' => '_logout'), $this);?>
)</a>