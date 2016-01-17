<?php /* Smarty version 2.6.26, created on 2015-12-01 12:15:49
         compiled from /home/illumin/public_html/application/view///backend/newsletter/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', '/home/illumin/public_html/application/view///backend/newsletter/edit.tpl', 1, false),array('function', 'hidden', '/home/illumin/public_html/application/view///backend/newsletter/edit.tpl', 4, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/newsletter/edit.tpl', 7, false),array('function', 'checkbox', '/home/illumin/public_html/application/view///backend/newsletter/edit.tpl', 40, false),array('modifier', 'capitalize', '/home/illumin/public_html/application/view///backend/newsletter/edit.tpl', 7, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/newsletter/edit.tpl', 41, false),)), $this); ?>
<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['form'],'action' => "controller=backend.newsletter action=save",'method' => 'POST','onsubmit' => "Backend.Newsletter.saveForm(this); return false;",'onreset' => "Backend.Newsletter.resetAddForm(this);")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div class="newsletterForm">

	<?php echo smarty_function_hidden(array('name' => 'id','value' => $this->_tpl_vars['newsletter']['ID']), $this);?>


	<fieldset>
		<legend><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_edit_message'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__edit_message', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__edit_message'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</legend>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/newsletter/form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</fieldset>

	<fieldset class="controls">

		<input type="checkbox" name="afterAdding" value="new" style="display: none;" />

		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" name="save" class="submit" value="<?php echo smarty_function_translate(array('text' => '_save_message'), $this);?>
" onclick="this.form.elements.namedItem('sendFlag').value = '';" />
		<?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 <a class="cancel" href="#" onclick="Backend.Newsletter.cancelAdd(); return false;"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>

	</fieldset>

</div>

<div class="confirmations">
	<div class="yellowMessage messageSaved" style="display: none;">
		<div><?php echo smarty_function_translate(array('text' => '_message_successfully_saved'), $this);?>
</div>
	</div>
	<div class="yellowMessage messageComplete stick" style="display: none;">
		<div><?php echo smarty_function_translate(array('text' => '_message_successfully_sent'), $this);?>
</div>
	</div>
</div>

<div class="sendContainer">
	<fieldset>
		<legend><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_send_message'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__send_message', ob_get_contents());ob_end_clean(); ?><?php echo smarty_modifier_capitalize($this->_tpl_vars['translation__send_message']); ?>
</legend>
		<p>
			<label class="sendLabel"><?php echo smarty_function_translate(array('text' => '_send_to'), $this);?>
:</label>
			<div style="float: left;">
				<?php $_from = $this->_tpl_vars['groupsArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['groupItem']):
?>
					<p>
						<?php ob_start(); ?><?php echo $this->_tpl_vars['groupItem']['ID']; ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_checkbox(array('class' => 'checkbox userGroupCheckbox','name' => "group_".($this->_tpl_vars['blockAsParamValue']),'onchange' => "Backend.Newsletter.updateRecipientCount(this)"), $this);?>

						<label class="checkbox" for="group_<?php echo $this->_tpl_vars['groupItem']['ID']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['groupItem']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</label>
					</p>
				<?php endforeach; endif; unset($_from); ?>
				<input type="hidden" value="" name="userGroupIDs" id="userGroupIDs" />
				<p>
					<?php echo smarty_function_checkbox(array('class' => 'checkbox','name' => 'users','onchange' => "Backend.Newsletter.updateRecipientCount(this)"), $this);?>

					<label class="checkbox" for="users"><?php echo smarty_function_translate(array('text' => '_all_users'), $this);?>
</label>
				</p>
				<p>
					<?php echo smarty_function_checkbox(array('class' => 'checkbox','name' => 'subscribers','onchange' => "Backend.Newsletter.updateRecipientCount(this)"), $this);?>

					<label class="checkbox" for="subscribers"><?php echo smarty_function_translate(array('text' => '_all_subscribers'), $this);?>
</label>
				<p>
				<fieldset class="container">
					<p class="recipientCount">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/newsletter/recipientCount.tpl", 'smarty_include_vars' => array('count' => $this->_tpl_vars['recipientCount'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</p>
				</fieldset>

				<input type="submit" name="send" class="submit" value="<?php echo smarty_function_translate(array('text' => '_send_message'), $this);?>
"  onclick="this.form.elements.namedItem('sendFlag').value = 'send';" />
			</div>
		</p>
	</fieldset>

	<fieldset>
		<legend><?php echo smarty_function_translate(array('text' => '_status'), $this);?>
</legend>
		<p>
			<label><?php echo smarty_function_translate(array('text' => '_status'), $this);?>
:</label>
			<label class="statusString"><?php echo smarty_function_translate(array('text' => "_status_".($this->_tpl_vars['newsletter']['status'])), $this);?>
</label>
		</p>
		<p>
			<label><?php echo smarty_function_translate(array('text' => '_messages_sent'), $this);?>
:</label>
			<label class="sentCount"><?php echo $this->_tpl_vars['sentCount']; ?>
</label>
		</p>
		<div style="display: none;">
			<span class="statusPartial"><?php echo smarty_function_translate(array('text' => '_status_1'), $this);?>
</span>
			<span class="statusSent"><?php echo smarty_function_translate(array('text' => '_status_2'), $this);?>
</span>
		</div>
	</fieldset>

	<fieldset class="sendProgress" style="display: none;">
		<legend><?php echo smarty_function_translate(array('text' => '_sending'), $this);?>
</legend>
		<div class="progressBarIndicator"></div>
		<div class="progressBar">
			<span class="progressCount"></span>
			<span class="progressSeparator"> / </span>
			<span class="progressTotal"></span>
		</div>
		<a class="cancel" href="#" onclick="Backend.Newsletter.cancel(this); return false;"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
	</fieldset>
</div>

<input type="hidden" name="sendFlag" value="" />

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="clear"></div>