<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from /home/illumin/public_html/storage/customize/view//theme/IlluminataV3//contactForm/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'pageTitle', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//contactForm/index.tpl', 1, false),array('block', 'form', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//contactForm/index.tpl', 20, false),array('block', 'error', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//contactForm/index.tpl', 26, false),array('function', 'translate', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//contactForm/index.tpl', 1, false),array('function', 'loadJs', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//contactForm/index.tpl', 3, false),array('function', 'textfield', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//contactForm/index.tpl', 24, false),array('function', 'textarea', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//contactForm/index.tpl', 52, false),array('function', 'renderBlock', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//contactForm/index.tpl', 58, false),)), $this); ?>
<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_contact_us'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php echo smarty_function_loadJs(array('form' => true), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content">

<h1><?php echo smarty_function_translate(array('text' => '_contact_us'), $this);?>
</h1>
<div>
Illuminata Eyewear <br>
1750 The Queensway Unit #4<br>
Etobicoke, ON<br>
M9C 5H5<br>
<br>
Tel. 416-620-8028<br>
E-mail: sales@illuminataeyewear.com
<br><br>
</div>

<?php $this->_tag_stack[] = array('form', array('action' => "controller=contactForm action=send",'method' => 'POST','id' => 'contactForm','handle' => $this->_tpl_vars['form'],'style' => "float: left;")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<p>
		
			<label for="name"><span class="label"><?php echo smarty_function_translate(array('text' => '_your_name'), $this);?>
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

	<p>
		
			<label for="email"><span class="label"><?php echo smarty_function_translate(array('text' => '_your_email'), $this);?>
:</span></label>
			<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'email','class' => 'text'), $this);?>

		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'email')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'email')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	</p>

	<p>
		
			<label for="msg"><span class="label"><?php echo smarty_function_translate(array('text' => '_your_message'), $this);?>
:</span></label>
			<fieldset class="error"><?php echo smarty_function_textarea(array('name' => 'msg'), $this);?>

		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'msg')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'msg')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	</p>

	<?php echo smarty_function_renderBlock(array('block' => "FORM-SUBMIT-CONTACT"), $this);?>


	<p>
		<input type="submit" class="submit" value="<?php echo smarty_function_translate(array('text' => '_form_submit'), $this);?>
" />
	</p>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>