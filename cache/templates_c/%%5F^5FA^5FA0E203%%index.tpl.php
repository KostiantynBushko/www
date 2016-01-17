<?php /* Smarty version 2.6.26, created on 2015-12-16 11:22:56
         compiled from /home/illumin/public_html/application/view///backend/payment/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'denied', '/home/illumin/public_html/application/view///backend/payment/index.tpl', 4, false),array('block', 'form', '/home/illumin/public_html/application/view///backend/payment/index.tpl', 16, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/payment/index.tpl', 5, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/payment/index.tpl', 8, false),array('function', 'textfield', '/home/illumin/public_html/application/view///backend/payment/index.tpl', 21, false),array('function', 'textarea', '/home/illumin/public_html/application/view///backend/payment/index.tpl', 28, false),array('modifier', 'capitalize', '/home/illumin/public_html/application/view///backend/payment/index.tpl', 14, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/payment/index.tpl', 33, false),)), $this); ?>
<div>
<div class="menuContainer" id="paymentMenu_<?php echo $this->_tpl_vars['order']['ID']; ?>
">

	<ul class="menu paymentMenu" <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none;"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
		<li class="offlinePayment"><a href="#addOfflinePayment" class="addOfflinePayment"><?php echo smarty_function_translate(array('text' => '_add_offline_payment'), $this);?>
</a></li>
		<li class="offlinePaymentCancel done" style="display: none;"><a href="#cancelOfflinePayment" class="cancelOfflinePayment"><?php echo smarty_function_translate(array('text' => '_cancel_offline_payment'), $this);?>
</a></li>

		<li class="ccPayment"><a onclick="window.open('<?php echo smarty_function_link(array('controller' => "backend.payment",'action' => 'ccForm','id' => $this->_tpl_vars['order']['ID']), $this);?>
', 'creditCard', 'directories=no, height=440, width=540, resizable=yes, scrollbars=no, toolbar=no'); return false;" href="#" class="addCreditCardPayment"><?php echo smarty_function_translate(array('text' => '_add_credit_card_payment'), $this);?>
</a></li>
	</ul>

	<div class="slideForm addOffline" style="display: none;">
		<fieldset class="addForm addOfflinePayment">

			<legend><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_add_offline_payment'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__add_offline_payment', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__add_offline_payment'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</legend>

			<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.payment action=addOffline id=".($this->_tpl_vars['order']['ID']),'method' => 'POST','handle' => $this->_tpl_vars['offlinePaymentForm'],'onsubmit' => "Backend.Payment.submitOfflinePaymentForm(event);")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

				<p>
					<label><?php echo smarty_function_translate(array('text' => '_amount'), $this);?>
:</label>
					<fieldset class="error">
						<?php echo smarty_function_textfield(array('name' => 'amount','class' => 'text number'), $this);?>
 <?php echo $this->_tpl_vars['order']['Currency']['ID']; ?>

						<div class="errorText hidden"></div>
					</fieldset>
				</p>

				<p>
					<label><?php echo smarty_function_translate(array('text' => '_comment'), $this);?>
:</label>
					<?php echo smarty_function_textarea(array('name' => 'comment'), $this);?>

				</p>

				<fieldset class="controls" style="margin-right: 40px;">
					<span class="progressIndicator" style="display: none;"></span>
					<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_add_payment','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
					<?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 <a class="cancel offlinePaymentCancel" href="#"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
				</fieldset>

			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

		</fieldset>
	</div>

</div>

<form class="paymentSummary">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/payment/totals.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</form>

<div class="clear"></div>

<fieldset class="container transactionContainer">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/payment/transactions.tpl", 'smarty_include_vars' => array('transactions' => $this->_tpl_vars['transactions'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</fieldset>

<?php echo '
<script type="text/javascript">
	Backend.Payment.init($(\''; ?>
paymentMenu_<?php echo $this->_tpl_vars['order']['ID']; ?>
<?php echo '\'));
</script>
'; ?>


<div class="clear"></div>

</div>