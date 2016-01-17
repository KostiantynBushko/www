<?php /* Smarty version 2.6.26, created on 2015-12-02 13:16:42
         compiled from /home/illumin/public_html/application/view/email/en/newsletter/template.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', '/home/illumin/public_html/application/view/email/en/newsletter/template.tpl', 9, false),)), $this); ?>
<?php echo $this->_tpl_vars['subject']; ?>

<?php if ($this->_tpl_vars['html']): ?><?php echo $this->_tpl_vars['htmlMessage']; ?>

<?php else: ?><?php echo $this->_tpl_vars['text']; ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/en/signature.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

-----------------------------------------------
If you do not want to receive any more newsletter messages from us, please visit the link below to remove yourself from our mailing list:
<?php echo smarty_function_link(array('controller' => 'newsletter','action' => 'unsubscribe','query' => "email=".($this->_tpl_vars['email']),'url' => true), $this);?>