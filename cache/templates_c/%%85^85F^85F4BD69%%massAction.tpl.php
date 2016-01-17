<?php /* Smarty version 2.6.26, created on 2015-12-01 12:14:53
         compiled from backend/newsletterSubscriber/massAction.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', 'backend/newsletterSubscriber/massAction.tpl', 3, false),array('function', 'translate', 'backend/newsletterSubscriber/massAction.tpl', 9, false),array('modifier', 'escape', 'backend/newsletterSubscriber/massAction.tpl', 16, false),)), $this); ?>
<span id="newsletterSubscriberMass_0" class="activeGridMass">

	<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.newsletterSubscriber action=processMass",'method' => 'POST','handle' => $this->_tpl_vars['massForm'],'onsubmit' => "return false;")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

	<input type="hidden" name="filters" value="" />
	<input type="hidden" name="selectedIDs" value="" />
	<input type="hidden" name="isInverse" value="" />

	<?php echo smarty_function_translate(array('text' => '_with_selected'), $this);?>
:
	<select name="act" class="select">
		<option value="enable_isEnabled"><?php echo smarty_function_translate(array('text' => '_enable'), $this);?>
</option>
		<option value="disable_isEnabled"><?php echo smarty_function_translate(array('text' => '_disable'), $this);?>
</option>
		<option value="delete"><?php echo smarty_function_translate(array('text' => '_delete'), $this);?>
</option>
	</select>

	<input type="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_process','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" class="submit" />
	<span class="massIndicator progressIndicator" style="display: none;"></span>

	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</span>