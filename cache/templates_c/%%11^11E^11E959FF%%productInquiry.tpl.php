<?php /* Smarty version 2.6.26, created on 2015-12-01 13:22:37
         compiled from /home/illumin/public_html/application/view/email/en/contactForm/productInquiry.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', '/home/illumin/public_html/application/view/email/en/contactForm/productInquiry.tpl', 1, false),)), $this); ?>
<?php echo ((is_array($_tmp='STORE_NAME')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
 product inquiry
Product name: <?php echo $this->_tpl_vars['product']['name_lang']; ?>

SKU: <?php echo $this->_tpl_vars['product']['sku']; ?>


<?php echo $this->_tpl_vars['message']; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:email/en/signature.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>