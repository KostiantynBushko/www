<?php /* Smarty version 2.6.26, created on 2015-12-03 18:16:40
         compiled from custom:backend/discount/conditionForm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'checkbox', 'custom:backend/discount/conditionForm.tpl', 3, false),array('function', 'toolTip', 'custom:backend/discount/conditionForm.tpl', 4, false),array('function', 'translate', 'custom:backend/discount/conditionForm.tpl', 9, false),array('function', 'textfield', 'custom:backend/discount/conditionForm.tpl', 10, false),array('function', 'selectfield', 'custom:backend/discount/conditionForm.tpl', 28, false),array('function', 'calendar', 'custom:backend/discount/conditionForm.tpl', 46, false),array('block', 'error', 'custom:backend/discount/conditionForm.tpl', 12, false),array('block', 'language', 'custom:backend/discount/conditionForm.tpl', 74, false),)), $this); ?>
<div class="field">
	<label></label>
	<?php echo smarty_function_checkbox(array('name' => 'isFinal','class' => 'checkbox','id' => "isFinal_".($this->_tpl_vars['condition']['ID'])), $this);?>

	<label for="isFinal_<?php echo $this->_tpl_vars['condition']['ID']; ?>
" class="checkbox"><?php echo smarty_function_toolTip(array('label' => '_stop_processing'), $this);?>
</label>
</div>

<div class="required field">
	
		<label for="name"><span class="label"><?php ob_start(); ?><?php echo smarty_function_toolTip(array('label' => "DiscountCondition.name"), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_translate(array('text' => ($this->_tpl_vars['blockAsParamValue'])."</span></label>"), $this);?>

		<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'name'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'name')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'name')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</div>

<div class="couponCode field">
	
		<label for="couponCode"><span class="label"><?php ob_start(); ?><?php echo smarty_function_toolTip(array('label' => "DiscountCondition.couponCode"), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_translate(array('text' => ($this->_tpl_vars['blockAsParamValue'])."</span></label>"), $this);?>

		<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'couponCode'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'couponCode')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'couponCode')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</div>

<div class="couponLimitType field">
	
		<label for="couponLimitType"><span class="label"><?php ob_start(); ?><?php echo smarty_function_toolTip(array('label' => "DiscountCondition.couponLimitType"), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_translate(array('text' => ($this->_tpl_vars['blockAsParamValue'])."</span></label>"), $this);?>

		<fieldset class="error"><?php echo smarty_function_selectfield(array('name' => 'couponLimitType','options' => $this->_tpl_vars['couponLimitTypes']), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'couponLimitType')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'couponLimitType')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</div>

<div class="couponLimitCount field">
	
		<label for="couponLimitCount"><span class="label"><?php ob_start(); ?><?php echo smarty_function_toolTip(array('label' => "DiscountCondition.couponLimitCount"), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_translate(array('text' => ($this->_tpl_vars['blockAsParamValue'])."</span></label>"), $this);?>

		<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'couponLimitCount','class' => 'number'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'couponLimitCount')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'couponLimitCount')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</div>

<div class="field">
	
		<label for="validFrom"><span class="label"><?php ob_start(); ?><?php echo smarty_function_toolTip(array('label' => "DiscountCondition.validFrom"), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_translate(array('text' => ($this->_tpl_vars['blockAsParamValue'])."</span></label>"), $this);?>

		<fieldset class="error"><?php echo smarty_function_calendar(array('name' => 'validFrom','id' => 'validFrom'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'validFrom')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'validFrom')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</div>

<div class="field">
	
		<label for="validTo"><span class="label"><?php ob_start(); ?><?php echo smarty_function_toolTip(array('label' => "DiscountCondition.validTo"), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_translate(array('text' => ($this->_tpl_vars['blockAsParamValue'])."</span></label>"), $this);?>

		<fieldset class="error"><?php echo smarty_function_calendar(array('name' => 'validTo','id' => 'validTo'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'validTo')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'validTo')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</div>

<div class="field">
	
		<label for="position"><span class="label"><?php ob_start(); ?><?php echo smarty_function_toolTip(array('label' => "DiscountCondition.position"), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_translate(array('text' => ($this->_tpl_vars['blockAsParamValue'])."</span></label>"), $this);?>

		<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'position','class' => 'number'), $this);?>

	
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'position')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'position')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
</div>

<script language="text/javascript">
	Backend.Discount.Editor.prototype.initDiscountForm('<?php echo $this->_tpl_vars['id']; ?>
');
</script>

<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<div class="field">
		<label><?php echo smarty_function_toolTip(array('label' => "DiscountCondition.name"), $this);?>
</label>
		<?php echo smarty_function_textfield(array('name' => "name_".($this->_tpl_vars['lang']['ID'])), $this);?>

	</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>