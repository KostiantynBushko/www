<?php /* Smarty version 2.6.26, created on 2015-12-11 14:40:15
         compiled from /home/illumin/public_html/application/view///backend/orderNote/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'denied', '/home/illumin/public_html/application/view///backend/orderNote/index.tpl', 4, false),array('block', 'form', '/home/illumin/public_html/application/view///backend/orderNote/index.tpl', 16, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/orderNote/index.tpl', 5, false),array('function', 'textarea', '/home/illumin/public_html/application/view///backend/orderNote/index.tpl', 19, false),array('modifier', 'capitalize', '/home/illumin/public_html/application/view///backend/orderNote/index.tpl', 14, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/orderNote/index.tpl', 24, false),)), $this); ?>
<div>
<div class="menuContainer" id="orderNoteMenu_<?php echo $this->_tpl_vars['order']['ID']; ?>
">

	<ul class="menu orderNoteMenu" style="margin: 0; <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>display: none;<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">		
		<li class="addResponse"><a href="#addResponse" class="addResponse" ><?php echo smarty_function_translate(array('text' => '_add_response'), $this);?>
</a></li>
		<li class="addResponseCancel done" style="display: none"><a href="#cancelResponse" class="addResponseCancel" ><?php echo smarty_function_translate(array('text' => '_cancel_response'), $this);?>
</a></li>
	</ul>
	
	<div class="clear"></div>
	
	<div class="addResponseForm" style="display: none;">
		<fieldset class="addForm">
		
			<legend><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_add_response'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__add_response', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__add_response'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</legend>
		
			<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.orderNote action=add id=".($this->_tpl_vars['order']['ID']),'method' => 'POST','handle' => $this->_tpl_vars['form'],'onsubmit' => "Backend.OrderNote.submitForm(event);",'role' => "order.update")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			
				<p>
					<?php echo smarty_function_textarea(array('name' => 'comment'), $this);?>

				</p>		
		
				<fieldset class="controls">
					<span class="progressIndicator" style="display: none;"></span>
					<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_add_response','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
					<?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 <a class="cancel responseCancel" href="#"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
				</fieldset>
		
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		
		</fieldset>
	</div>

</div>

<div class="clear"></div>

<fieldset class="container orderNoteContainer">
	<ul class="notes">
	<?php $_from = $this->_tpl_vars['notes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['note']):
?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/orderNote/view.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endforeach; else: ?>
		<div class="noRecords"><div style="display: block;"><?php echo smarty_function_translate(array('text' => '_no_messages'), $this);?>
</div></div>
	<?php endif; unset($_from); ?>
	</ul>
</fieldset>

<script type="text/javascript">
	Backend.OrderNote.init($('orderNoteMenu_<?php echo $this->_tpl_vars['order']['ID']; ?>
'));
</script>

<div class="clear"></div>

</div>