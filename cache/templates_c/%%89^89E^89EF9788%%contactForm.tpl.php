<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from custom:product/contactForm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:product/contactForm.tpl', 2, false),array('function', 'textfield', 'custom:product/contactForm.tpl', 9, false),array('function', 'textarea', 'custom:product/contactForm.tpl', 37, false),array('block', 'form', 'custom:product/contactForm.tpl', 5, false),array('block', 'error', 'custom:product/contactForm.tpl', 11, false),)), $this); ?>
<div id="contactFormSection" class="productSection contactFormSection">
<h2><?php echo smarty_function_translate(array('text' => '_inquire'), $this);?>
<small><?php echo smarty_function_translate(array('text' => '_inquire_title'), $this);?>
</small></h2>

<div>
<?php $this->_tag_stack[] = array('form', array('action' => "controller=product action=sendContactForm",'method' => 'POST','handle' => $this->_tpl_vars['contactForm'],'id' => 'productContactForm','onsubmit' => "new Product.ContactForm(this); return false;")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<p class="required">
		
			<label for="name"><span class="label"><?php echo smarty_function_translate(array('text' => '_inquiry_name'), $this);?>
:</span></label>
			<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'name','class' => 'text'), $this);?>

		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'name')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'name')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	</p>

		<div style="display: none;">
		
			<label for="surname"><span class="label">Your surname:</span></label>
			<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'surname','class' => 'text'), $this);?>

		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'surname')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'surname')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	</div>
	
	<p class="required">
		
			<label for="email"><span class="label"><?php echo smarty_function_translate(array('text' => '_inquiry_email'), $this);?>
:</span></label>
			<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'email','class' => 'text'), $this);?>

		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'email')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'email')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	</p>

	<p class="required">
		
			<label for="msg"><span class="label"><?php echo smarty_function_translate(array('text' => '_inquiry_msg'), $this);?>
:</span></label>
			<fieldset class="error"><?php echo smarty_function_textarea(array('name' => 'msg'), $this);?>

		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'msg')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'msg')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	</p>

	<p>
		
		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" class="submit" value="<?php echo smarty_function_translate(array('text' => '_form_submit'), $this);?>
" style="margin-top: 20px;" />
	</p>

	<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['product']['ID']; ?>
" />

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<div class="clear"></div>
</div>
</div>