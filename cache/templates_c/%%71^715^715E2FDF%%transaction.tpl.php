<?php /* Smarty version 2.6.26, created on 2015-12-16 11:22:56
         compiled from custom:backend/payment/transaction.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/payment/transaction.tpl', 16, false),array('function', 'backendUserUrl', 'custom:backend/payment/transaction.tpl', 33, false),array('function', 'link', 'custom:backend/payment/transaction.tpl', 68, false),array('function', 'textfield', 'custom:backend/payment/transaction.tpl', 108, false),array('function', 'checkbox', 'custom:backend/payment/transaction.tpl', 118, false),array('block', 'denied', 'custom:backend/payment/transaction.tpl', 54, false),array('block', 'form', 'custom:backend/payment/transaction.tpl', 99, false),array('modifier', 'escape', 'custom:backend/payment/transaction.tpl', 90, false),)), $this); ?>
<li class="transactionType_<?php echo $this->_tpl_vars['transaction']['type']; ?>
" id="transaction_<?php echo $this->_tpl_vars['transaction']['ID']; ?>
">

	<div class="transactionMainDetails">
		<div class="transactionAmount<?php if ($this->_tpl_vars['transaction']['isVoided']): ?> isVoided<?php endif; ?>">
			<?php echo $this->_tpl_vars['transaction']['formattedAmount']; ?>

			<?php if ($this->_tpl_vars['transaction']['Currency']['ID'] != $this->_tpl_vars['transaction']['RealCurrency']['ID']): ?>
				<span class="transactionRealAmount">
				(<?php echo $this->_tpl_vars['transaction']['formattedRealAmount']; ?>
)
				</span>
			<?php endif; ?>
		</div>

		<div class="transactionStatus">

			<?php if (0 == $this->_tpl_vars['transaction']['type']): ?>
				<?php echo smarty_function_translate(array('text' => '_type_sale'), $this);?>


			<?php elseif (1 == $this->_tpl_vars['transaction']['type']): ?>
				<?php echo smarty_function_translate(array('text' => '_type_authorization'), $this);?>


			<?php elseif (2 == $this->_tpl_vars['transaction']['type']): ?>
				<?php echo smarty_function_translate(array('text' => '_type_capture'), $this);?>


			<?php elseif (3 == $this->_tpl_vars['transaction']['type']): ?>
				<?php echo smarty_function_translate(array('text' => '_type_void'), $this);?>


			<?php endif; ?>
		</div>

		<div class="transactionUser">

			<?php if ($this->_tpl_vars['transaction']['User']): ?>
				<?php echo smarty_function_translate(array('text' => '_processed_by'), $this);?>
: <a href="<?php echo smarty_function_backendUserUrl(array('user' => $this->_tpl_vars['transaction']['User']), $this);?>
"><?php echo $this->_tpl_vars['transaction']['User']['fullName']; ?>
</a>
			<?php endif; ?>

		</div>

		<?php if ($this->_tpl_vars['transaction']['comment']): ?>
			<div class="transactionComment">
				<?php echo $this->_tpl_vars['transaction']['comment']; ?>

			</div>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['transaction']['attributes']): ?>
			<div class="overview">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/view.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['transaction'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		<?php endif; ?>

	</div>

	<div class="transactionDetails">

		<ul class="transactionMenu" <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none;"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
			<?php if ($this->_tpl_vars['transaction']['isCapturable']): ?>
				<li class="captureMenu">
					<a href="" onclick="Backend.Payment.showCaptureForm(<?php echo $this->_tpl_vars['transaction']['ID']; ?>
, event);"><?php echo smarty_function_translate(array('text' => '_capture'), $this);?>
</a>
				</li>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['transaction']['isVoidable']): ?>
				<li class="voidMenu">
					<a href="#void" onclick="Backend.Payment.showVoidForm(<?php echo $this->_tpl_vars['transaction']['ID']; ?>
, event);"><?php echo smarty_function_translate(array('text' => '_void'), $this);?>
</a>
				</li>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['transaction']['hasFullNumber']): ?>
				<li class="delCcNumMenu">
					<span class="progressIndicator" style="display: none;"></span>
					<a href="<?php echo smarty_function_link(array('controller' => "backend.payment",'action' => 'deleteCcNumber','id' => $this->_tpl_vars['transaction']['ID']), $this);?>
" onclick="Backend.Payment.deleteCcNum(<?php echo $this->_tpl_vars['transaction']['ID']; ?>
, event);"><?php echo smarty_function_translate(array('text' => '_delete_cc_num'), $this);?>
</a>
				</li>
			<?php endif; ?>
		</ul>

		<div class="clear"></div>

		<div class="transactionForm voidForm" style="display: none;">
			<form action="<?php echo smarty_function_link(array('controller' => "backend.payment",'action' => 'void','id' => $this->_tpl_vars['transaction']['ID']), $this);?>
" method="post" onsubmit="Backend.Payment.voidTransaction(<?php echo $this->_tpl_vars['transaction']['ID']; ?>
, this, event);">

				<span class="confirmation" style="display: none"><?php echo smarty_function_translate(array('text' => '_void_conf'), $this);?>
</span>

				<fieldset>
						<legend><?php echo smarty_function_translate(array('text' => '_void'), $this);?>
</legend>
								<p>
					<?php echo smarty_function_translate(array('text' => '_void_reason'), $this);?>
:
				</p>
				<textarea name="comment"></textarea>
						</fieldset>

				<fieldset class="controls">
					<span class="progressIndicator" style="display: none;"></span>
					<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_void_button','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
					<?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 <a class="menu" href="#" onclick="Backend.Payment.hideVoidForm(<?php echo $this->_tpl_vars['transaction']['ID']; ?>
, event);"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
				</fieldset>

			</form>
		</div>

		<?php if ($this->_tpl_vars['transaction']['isCapturable']): ?>
		<div class="transactionForm captureForm" style="display: none;">
				<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.payment action=capture id=".($this->_tpl_vars['transaction']['ID']),'method' => 'POST','onsubmit' => "Backend.Payment.captureTransaction(".($this->_tpl_vars['transaction']['ID']).", this, event);",'handle' => $this->_tpl_vars['capture'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

			<fieldset>
				<legend><?php echo smarty_function_translate(array('text' => '_capture'), $this);?>
</legend>

				<span class="confirmation" style="display: none"><?php echo smarty_function_translate(array('text' => '_capture_conf'), $this);?>
</span>

				<p>
					<?php echo smarty_function_translate(array('text' => '_capture_amount'), $this);?>
:<Br />
					<?php echo smarty_function_textfield(array('name' => 'amount','class' => 'text number','value' => $this->_tpl_vars['transaction']['amount']), $this);?>
 <?php echo $this->_tpl_vars['transaction']['Currency']['ID']; ?>

				</p>

				<p class="captureComment">
					<?php echo smarty_function_translate(array('text' => '_comment'), $this);?>
:
					<textarea name="comment"></textarea>
				</p>

				<?php if ($this->_tpl_vars['transaction']['isMultiCapture']): ?>
					<p>
						<?php echo smarty_function_checkbox(array('name' => 'complete','class' => 'checkbox'), $this);?>

						<label for="complete"><?php echo smarty_function_translate(array('text' => '_finalize'), $this);?>
</label>
						<div class="clear"></div>
					</p>
				<?php else: ?>
					<input type="checkbox" name="complete" id="complete" value="ON" checked="checked" style="display: none;" />
				<?php endif; ?>
				</fieldset>

		<fieldset class="controls">
				<span class="progressIndicator" style="display: none;"></span>
				<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_process_capture','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
			<?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 <a class="menu" href="#" onclick="Backend.Payment.hideCaptureForm(<?php echo $this->_tpl_vars['transaction']['ID']; ?>
, event);"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
		</fieldset>

			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</div>
		<?php endif; ?>

		<fieldset class="transactionMethod">

			<?php if ($this->_tpl_vars['transaction']['methodName']): ?>
				<?php $this->assign('transactionMethodName', $this->_tpl_vars['transaction']['methodName']); ?>
			<?php elseif ($this->_tpl_vars['transaction']['serializedData']['handler']): ?>
				<?php $this->assign('transactionMethodName', $this->_tpl_vars['transaction']['serializedData']['handler']); ?>
			<?php else: ?>
				<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_manual'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('transactionMethodName', ob_get_contents());ob_end_clean(); ?>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['transactionMethodName']): ?>
				<legend>
					<?php if ($this->_tpl_vars['transaction']['availableOfflinePaymentMethods']): ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/payment/editOfflineMethod.tpl", 'smarty_include_vars' => array('ID' => $this->_tpl_vars['transaction']['ID'],'methods' => $this->_tpl_vars['transaction']['availableOfflinePaymentMethods'],'name' => $this->_tpl_vars['transactionMethodName'],'handlerID' => $this->_tpl_vars['transaction']['handlerID'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php else: ?>
						<?php echo $this->_tpl_vars['transaction']['methodName']; ?>

					<?php endif; ?>
				</legend>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['transaction']['ccLastDigits']): ?>
				<div class="ccDetails">
					<div><?php echo $this->_tpl_vars['transaction']['ccName']; ?>
</div>
					<div><?php echo $this->_tpl_vars['transaction']['ccType']; ?>
 <span class="ccNum"><?php if ($this->_tpl_vars['transaction']['hasFullNumber']): ?> / <?php else: ?>...<?php endif; ?><?php echo $this->_tpl_vars['transaction']['ccLastDigits']; ?>
</span></div>
					<?php if ($this->_tpl_vars['transaction']['ccCVV']): ?>
						<div><?php echo $this->_tpl_vars['transaction']['ccCVV']; ?>
<div>
					<?php endif; ?>
					<div><?php echo $this->_tpl_vars['transaction']['ccExpiryMonth']; ?>
 / <?php echo $this->_tpl_vars['transaction']['ccExpiryYear']; ?>
</div>
				</div>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['transaction']['gatewayTransactionID']): ?>
				<div class="gatewayTransactionID">
					<?php echo smarty_function_translate(array('text' => '_transaction_id'), $this);?>
: <?php echo $this->_tpl_vars['transaction']['gatewayTransactionID']; ?>

				</div>
			<?php endif; ?>

			<div class="transactionTime">
				<?php echo $this->_tpl_vars['transaction']['formatted_time']['date_full']; ?>
 <?php echo $this->_tpl_vars['transaction']['formatted_time']['time_full']; ?>

			</div>

			<?php if ($this->_tpl_vars['transaction']['serializedData']): ?>
			<div class="extraData">
				<?php $_from = $this->_tpl_vars['transaction']['serializedData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
					<div>
						<?php echo $this->_tpl_vars['key']; ?>
: <?php echo $this->_tpl_vars['value']; ?>

					</div>
				<?php endforeach; endif; unset($_from); ?>
			</div>
			<?php endif; ?>

		</fieldset>

	</div>

	<div class="clear"></div>

	<?php if ($this->_tpl_vars['transaction']['transactions']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/payment/transactions.tpl", 'smarty_include_vars' => array('transactions' => $this->_tpl_vars['transaction']['transactions'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

</li>