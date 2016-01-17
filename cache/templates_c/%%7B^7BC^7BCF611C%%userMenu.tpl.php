<?php /* Smarty version 2.6.26, created on 2015-12-08 07:44:37
         compiled from custom:user/userMenu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', 'custom:user/userMenu.tpl', 3, false),array('function', 'translate', 'custom:user/userMenu.tpl', 3, false),array('function', 'renderBlock', 'custom:user/userMenu.tpl', 13, false),)), $this); ?>
<div id="userMenuContainer">
	<ul id="userMenu">
	   <li id="homeMenu" class="<?php if ('homeMenu' == $this->_tpl_vars['current']): ?>selected<?php endif; ?>"><a href="<?php echo smarty_function_link(array('controller' => 'user'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_acc_home'), $this);?>
</a></li>

	   <li id="orderMenu" class="<?php if ('orderMenu' == $this->_tpl_vars['current']): ?>selected<?php endif; ?>"><a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'orders'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_orders'), $this);?>
</a></li>
	   <li id="fileMenu" class="<?php if ('fileMenu' == $this->_tpl_vars['current']): ?>selected<?php endif; ?>"><a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'files'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_downloads'), $this);?>
</a></li>

	   <li id="personalMenu" class="<?php if ('personalMenu' == $this->_tpl_vars['current']): ?>selected<?php endif; ?>"><a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'personal'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_personal_info'), $this);?>
</a></li>
	   <li id="addressMenu" class="<?php if ('addressMenu' == $this->_tpl_vars['current']): ?>selected<?php endif; ?>"><a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'addresses'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_addresses'), $this);?>
</a></li>
	   <li id="emailMenu" class="<?php if ('emailMenu' == $this->_tpl_vars['current']): ?>selected<?php endif; ?>"><a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'changeEmail'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_change_email_address'), $this);?>
</a></li>
	   <li id="passwordMenu" class="<?php if ('passwordMenu' == $this->_tpl_vars['current']): ?>selected<?php endif; ?>"><a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'changePassword'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_change_pass'), $this);?>
</a></li>

	   <?php echo smarty_function_renderBlock(array('block' => 'USER_MENU_ITEMS'), $this);?>


	   <li id="signOutMenu" class="<?php if ('signoutMenu' == $this->_tpl_vars['current']): ?>selected<?php endif; ?>"><a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'logout'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_sign_out'), $this);?>
</a></li>
	</ul>
</div>