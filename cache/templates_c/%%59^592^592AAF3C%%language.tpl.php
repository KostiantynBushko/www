<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from /home/illumin/public_html/application/view//block/box/language.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '/home/illumin/public_html/application/view//block/box/language.tpl', 1, false),array('modifier', 'config', '/home/illumin/public_html/application/view//block/box/language.tpl', 3, false),)), $this); ?>
<?php if (count($this->_tpl_vars['allLanguages']) > 1): ?>
<div id="language">
	<?php if (((is_array($_tmp='LANG_SELECTION')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) == 'LANG_DROPDOWN'): ?>
		<select onchange="window.location.href=this.value;">
			<?php $_from = $this->_tpl_vars['allLanguages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
				<option value="<?php echo $this->_tpl_vars['language']['url']; ?>
"<?php if ($this->_tpl_vars['language']['ID'] == $this->_tpl_vars['current']['ID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['language']['originalName']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	<?php else: ?>
		<?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
			<?php if (((is_array($_tmp='LANG_SELECTION')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) == 'LANG_NAMES' || ! $this->_tpl_vars['language']['image']): ?>
				<a href="<?php echo $this->_tpl_vars['language']['url']; ?>
" class="lang-sel-<?php echo $this->_tpl_vars['language']['ID']; ?>
"><?php echo $this->_tpl_vars['language']['originalName']; ?>
</a>
			<?php else: ?>
				<a href="<?php echo $this->_tpl_vars['language']['url']; ?>
" class="lang-sel-<?php echo $this->_tpl_vars['language']['ID']; ?>
"><img src="<?php echo $this->_tpl_vars['language']['image']; ?>
" alt="<?php echo $this->_tpl_vars['language']['originalName']; ?>
" title="<?php echo $this->_tpl_vars['language']['originalName']; ?>
" /></a>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
</div>
<?php endif; ?>