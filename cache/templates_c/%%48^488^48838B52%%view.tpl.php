<?php /* Smarty version 2.6.26, created on 2015-12-16 11:22:18
         compiled from custom:backend/orderNote/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/orderNote/view.tpl', 6, false),array('function', 'backendUserUrl', 'custom:backend/orderNote/view.tpl', 12, false),array('modifier', 'nl2br', 'custom:backend/orderNote/view.tpl', 22, false),)), $this); ?>
<li class="responder_<?php echo $this->_tpl_vars['note']['isAdmin']; ?>
">
	
	<div class="responseUser">
		<span class="responderType">
		<?php if ($this->_tpl_vars['note']['isAdmin']): ?>
			<?php echo smarty_function_translate(array('text' => '_admin'), $this);?>
:
		<?php else: ?>
			<?php echo smarty_function_translate(array('text' => '_customer'), $this);?>
:
		<?php endif; ?>
		</span>
		
		<a href="<?php echo smarty_function_backendUserUrl(array('user' => $this->_tpl_vars['note']['User']), $this);?>
"><?php echo $this->_tpl_vars['note']['User']['fullName']; ?>
</a>
	</div>
		
	<div class="noteDate">
		<?php echo $this->_tpl_vars['note']['formatted_time']['date_full']; ?>
 <?php echo $this->_tpl_vars['note']['formatted_time']['time_full']; ?>

	</div>
		
	<div class="clear"></div>
		
	<div class="noteText">
		<?php echo ((is_array($_tmp=$this->_tpl_vars['note']['text'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

	</div>
	
</li>