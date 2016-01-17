<?php /* Smarty version 2.6.26, created on 2015-12-03 18:13:35
         compiled from /home/illumin/public_html/application/view///backend/theme/cssIframe.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'baseUrl', '/home/illumin/public_html/application/view///backend/theme/cssIframe.tpl', 7, false),array('function', 'math', '/home/illumin/public_html/application/view///backend/theme/cssIframe.tpl', 8, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/theme/cssIframe.tpl', 16, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/theme/cssIframe.tpl', 16, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<base href="<?php echo smarty_function_baseUrl(array(), $this);?>
"></base>
	<link href="upload/css/<?php echo $this->_tpl_vars['file']; ?>
?<?php echo smarty_function_math(array('equation' => 'rand(1,100000)'), $this);?>
" rel="Stylesheet" type="text/css" />
	<link href="stylesheet/frontend/Frontend.css?<?php echo smarty_function_math(array('equation' => 'rand(1,100000)'), $this);?>
" rel="Stylesheet" type="text/css" />
</head>

<body>
<script type="text/javascript">
	new this.parent.Backend.ThemeColor('<?php echo $this->_tpl_vars['theme']; ?>
');
	<?php if ($this->_tpl_vars['request']['saved']): ?>
		this.parent.Backend.SaveConfirmationMessage.prototype.showMessage('<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_colors_saved','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
');
		this.parent.Backend.Theme.prototype.styleTabNotChanged('<?php echo $this->_tpl_vars['theme']; ?>
');
		this.parent.TabControl.prototype.getInstance("tabContainer").reloadTabContent(this.parent.$("tabCss"));
		this.parent.Backend.Theme.prototype.cssTabNotChanged('<?php echo $this->_tpl_vars['theme']; ?>
');
	<?php endif; ?>
</script>
</body>

</html>