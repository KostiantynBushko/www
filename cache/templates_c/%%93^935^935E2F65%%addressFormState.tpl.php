<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:01
         compiled from custom:user/addressFormState.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config', 'custom:user/addressFormState.tpl', 1, false),array('function', 'translate', 'custom:user/addressFormState.tpl', 4, false),array('function', 'uniqid', 'custom:user/addressFormState.tpl', 5, false),array('function', 'selectfield', 'custom:user/addressFormState.tpl', 5, false),array('function', 'textfield', 'custom:user/addressFormState.tpl', 6, false),array('function', 'link', 'custom:user/addressFormState.tpl', 15, false),array('block', 'error', 'custom:user/addressFormState.tpl', 8, false),)), $this); ?>
<br><?php if (! ((is_array($_tmp='DISABLE_STATE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
	<p <?php if (! $this->_tpl_vars['notRequired']): ?>class="required"<?php endif; ?>>
		
			<label for="<?php echo $this->_tpl_vars['prefix']; ?>
state_select"><span class="label"><?php echo smarty_function_translate(array('text' => '_state'), $this);?>
:</span></label>
			<fieldset class="error"><?php ob_start(); ?><?php echo smarty_function_uniqid(array('assign' => 'id_state_select'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_selectfield(array('name' => ($this->_tpl_vars['prefix'])."state_select",'style' => "display: none;",'options' => $this->_tpl_vars['states'],'id' => ($this->_tpl_vars['blockAsParamValue'])), $this);?>

			<?php ob_start(); ?><?php echo smarty_function_uniqid(array('assign' => 'id_state_text'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_textfield(array('name' => ($this->_tpl_vars['prefix'])."state_text",'class' => 'text','id' => ($this->_tpl_vars['blockAsParamValue'])), $this);?>

		
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."state_select")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => ($this->_tpl_vars['prefix'])."state_select")); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>

		<?php echo '
		<script type="text/javascript">
		'; ?>

			new User.StateSwitcher($('<?php echo $this->_tpl_vars['id_country']; ?>
'), $('<?php echo $this->_tpl_vars['id_state_select']; ?>
'), $('<?php echo $this->_tpl_vars['id_state_text']; ?>
'),
					'<?php echo smarty_function_link(array('controller' => 'user','action' => 'states'), $this);?>
');
		</script>
	</p>
<?php endif; ?>