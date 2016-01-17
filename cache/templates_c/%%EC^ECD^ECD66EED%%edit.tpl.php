<?php /* Smarty version 2.6.26, created on 2015-12-03 18:16:40
         compiled from /home/illumin/public_html/application/view///backend/discount/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', '/home/illumin/public_html/application/view///backend/discount/edit.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/discount/edit.tpl', 4, false),array('function', 'checkbox', '/home/illumin/public_html/application/view///backend/discount/edit.tpl', 8, false),array('function', 'toolTip', '/home/illumin/public_html/application/view///backend/discount/edit.tpl', 9, false),array('function', 'json', '/home/illumin/public_html/application/view///backend/discount/edit.tpl', 54, false),)), $this); ?>
<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['form'],'action' => "controller=backend.discount action=save id=".($this->_tpl_vars['condition']['ID']),'id' => "userInfo_".($this->_tpl_vars['condition']['ID'])."_form",'onsubmit' => "Backend.Discount.Editor.prototype.getInstance(".($this->_tpl_vars['condition']['ID']).", false).submitForm(); return false;",'method' => 'post','role' => "product.update")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

	<fieldset>
		<legend><?php echo smarty_function_translate(array('text' => '_main_info'), $this);?>
</legend>

		<p>
			<label></label>
			<?php echo smarty_function_checkbox(array('name' => 'isEnabled','class' => 'checkbox','id' => "isEnabled_".($this->_tpl_vars['condition']['ID'])), $this);?>

			<label for="isEnabled_<?php echo $this->_tpl_vars['condition']['ID']; ?>
" class="checkbox"><?php echo smarty_function_toolTip(array('label' => '_is_enabled','hint' => '_tip_is_enabled_condition'), $this);?>
</label>
		</p>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/discount/conditionForm.tpl", 'smarty_include_vars' => array('id' => "userInfo_".($this->_tpl_vars['condition']['ID'])."_form")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<fieldset class="controls">
			<span class="progressIndicator" style="display: none;"></span>
			<input type="submit" name="save" class="submit" value="<?php echo smarty_function_translate(array('text' => '_save'), $this);?>
">
			<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

			<a class="cancel" href="#"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
		</fieldset>

	</fieldset>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<fieldset class="conditions" id="condition_<?php echo $this->_tpl_vars['condition']['ID']; ?>
">
	<legend><?php echo smarty_function_translate(array('text' => '_conditions'), $this);?>
</legend>

	<ul class="menu">
		<li class="addRootCondition">
			<a href="#" id="addRootCondition_<?php echo $this->_tpl_vars['condition']['ID']; ?>
"><?php echo smarty_function_translate(array('text' => '_add_new_condition'), $this);?>
</a>
			<span class="progressIndicator" style="display: none;"></span>
		</li>
	</ul>

	<ul class="conditionContainer root"></ul>

</fieldset>

<fieldset class="actions">
	<legend><?php echo smarty_function_translate(array('text' => '_actions'), $this);?>
</legend>

	<ul class="menu">
		<li class="addAction">
			<a href="#" id="addAction_<?php echo $this->_tpl_vars['condition']['ID']; ?>
" onclick="Backend.Discount.Action.prototype.addAction(event, <?php echo $this->_tpl_vars['condition']['ID']; ?>
);"><?php echo smarty_function_translate(array('text' => '_add_new_action'), $this);?>
</a>
			<span class="progressIndicator" style="display: none;"></span>
		</li>
	</ul>

	<ul class="actionContainer activeList activeList_add_delete activeList_add_sort" id="actionContainer_<?php echo $this->_tpl_vars['condition']['ID']; ?>
"></ul>

</fieldset>

<script type="text/javascript">
	var inst = new Backend.Discount.Condition(<?php echo smarty_function_json(array('array' => $this->_tpl_vars['condition']), $this);?>
, <?php echo smarty_function_json(array('array' => $this->_tpl_vars['records']), $this);?>
, <?php echo smarty_function_json(array('array' => $this->_tpl_vars['serializedValues']), $this);?>
, $('condition_<?php echo $this->_tpl_vars['condition']['ID']; ?>
').down('.conditionContainer'));
	Event.observe($('addRootCondition_<?php echo $this->_tpl_vars['condition']['ID']; ?>
'), 'click', inst.createSubCondition.bind(inst));

	var action = null;
	<?php echo smarty_function_json(array('array' => $this->_tpl_vars['actions']), $this);?>
.each(function(act) <?php echo '{action = Backend.Discount.Action.prototype.createAction(act); });
	if (action)
	{
		action.initializeList();
	}
	'; ?>

</script>