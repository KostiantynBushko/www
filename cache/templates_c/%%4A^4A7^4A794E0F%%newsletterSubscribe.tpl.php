<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from /home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/newsletterSubscribe.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadJs', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/newsletterSubscribe.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/newsletterSubscribe.tpl', 4, false),array('function', 'textfield', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/newsletterSubscribe.tpl', 13, false),array('block', 'form', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/newsletterSubscribe.tpl', 11, false),array('block', 'error', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//block/box/newsletterSubscribe.tpl', 16, false),)), $this); ?>
<?php echo smarty_function_loadJs(array('form' => true), $this);?>

<div class="box newsletter" style="border-left: 1px solid #ebebeb; border-right: 1px solid #ebebeb;">
	<div class="title">
		<div><?php echo smarty_function_translate(array('text' => '_subscribe_to_newsletter'), $this);?>
</div>
	</div>

	<div class="content">

	<p style="font-family: 'Open Sans'; font-size: 12px;"><?php echo smarty_function_translate(array('text' => '_enter_your_email_to_subscribe'), $this);?>
</p>

	<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['form'],'action' => "controller=newsletter action=subscribe",'method' => 'POST')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		
			<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'email','class' => 'text'), $this);?>

			<input type="submit" class="submit" value="OK" style="position: relative; left: -4px; margin-bottom: 20px; padding-left: 5px; padding-right: 5px;" />
		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'email')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'email')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>

	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	</div>

	
</div>