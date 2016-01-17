<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:33
         compiled from custom:news/newsEntry.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'newsUrl', 'custom:news/newsEntry.tpl', 1, false),array('function', 'translate', 'custom:news/newsEntry.tpl', 6, false),)), $this); ?>
<h3><a href="<?php echo smarty_function_newsUrl(array('news' => $this->_tpl_vars['entry']), $this);?>
"><?php echo $this->_tpl_vars['entry']['title_lang']; ?>
</a></h3>
<div class="newsDate"><?php echo $this->_tpl_vars['entry']['formatted_time']['date_medium']; ?>
</div>
<div><?php echo $this->_tpl_vars['entry']['text_lang']; ?>
</div>
<?php if ($this->_tpl_vars['entry']['moreText_lang']): ?>
	<div class="newsReadMore">
		<center><a href="<?php echo smarty_function_newsUrl(array('news' => $this->_tpl_vars['entry']), $this);?>
" class="hvr-sweep-to-left"><?php echo smarty_function_translate(array('text' => '_read_more'), $this);?>
</a></center>
	</div>
<?php endif; ?>
