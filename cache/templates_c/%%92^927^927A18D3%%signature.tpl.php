<?php /* Smarty version 2.6.26, created on 2015-12-01 11:02:36
         compiled from custom:email/en/signature.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:email/en/signature.tpl', 12, false),array('function', 'link', 'custom:email/en/signature.tpl', 13, false),)), $this); ?>
<?php if (! $this->_tpl_vars['html']): ?>

Illuminata Eyewear
1750 The Queensway, Unit 4
Etobicoke, ON
M9C 5H5

Tel. 416-620-8028
E-mail: sales@illuminataeyewear.com


<?php echo ((is_array($_tmp='STORE_NAME')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>

<?php echo smarty_function_link(array('url' => true), $this);?>

<?php endif; ?><?php if ($this->_tpl_vars['html']): ?>
<hr />
Illuminata Eyewear
1750 The Queensway, Unit 4
Etobicoke, ON
M9C 5H5

Tel. 416-620-8028
E-mail: sales@illuminataeyewear.com<br>


<a href="<?php echo smarty_function_link(array('url' => true), $this);?>
"><?php echo ((is_array($_tmp='STORE_NAME')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
</a>
<?php endif; ?>