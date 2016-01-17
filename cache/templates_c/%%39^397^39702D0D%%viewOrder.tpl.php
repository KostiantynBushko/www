<?php /* Smarty version 2.6.26, created on 2015-12-11 06:45:04
         compiled from /home/illumin/public_html/application/view///user/viewOrder.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'pageTitle', '/home/illumin/public_html/application/view///user/viewOrder.tpl', 1, false),array('block', 'form', '/home/illumin/public_html/application/view///user/viewOrder.tpl', 119, false),array('block', 'error', '/home/illumin/public_html/application/view///user/viewOrder.tpl', 124, false),array('function', 'translate', '/home/illumin/public_html/application/view///user/viewOrder.tpl', 1, false),array('function', 'loadJs', '/home/illumin/public_html/application/view///user/viewOrder.tpl', 2, false),array('function', 'link', '/home/illumin/public_html/application/view///user/viewOrder.tpl', 32, false),array('function', 'textarea', '/home/illumin/public_html/application/view///user/viewOrder.tpl', 122, false),array('modifier', 'config', '/home/illumin/public_html/application/view///user/viewOrder.tpl', 31, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///user/viewOrder.tpl', 128, false),)), $this); ?>
<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_view_order'), $this);?>
 #<?php echo $this->_tpl_vars['order']['invoiceNumber']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php echo smarty_function_loadJs(array('form' => true), $this);?>

<div class="userViewOrder">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/userMenu.tpl", 'smarty_include_vars' => array('current' => 'ordersMenu')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content">

	<h1><?php echo smarty_function_translate(array('text' => '_view_order'), $this);?>
 <?php echo $this->_tpl_vars['order']['invoiceNumber']; ?>
 (<?php echo $this->_tpl_vars['order']['formatted_dateCompleted']['date_long']; ?>
)</h1>

		<fieldset class="container">

		<label class="title"><?php echo smarty_function_translate(array('text' => '_order_id'), $this);?>
:</label>
		<label class="text"><?php echo $this->_tpl_vars['order']['invoiceNumber']; ?>
</label>
		<div class="clear"></div>

		<label class="title"><?php echo smarty_function_translate(array('text' => '_placed'), $this);?>
:</label>
		<label class="text"><?php echo $this->_tpl_vars['order']['formatted_dateCompleted']['date_long']; ?>
</label>
		<div class="clear"></div>

		<label class="title"><?php echo smarty_function_translate(array('text' => '_order_total'), $this);?>
:</label>
		<label class="text"><?php echo $this->_tpl_vars['order']['formattedTotal'][$this->_tpl_vars['order']['Currency']['ID']]; ?>
</label>
		<div class="clear"></div>

		<label class="title"><?php echo smarty_function_translate(array('text' => '_order_status'), $this);?>
:</label>
		<label class="text"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/orderStatus.tpl", 'smarty_include_vars' => array('order' => $this->_tpl_vars['order'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></label>
		<div class="clear"></div>

		<p>
			<?php if (! $this->_tpl_vars['order']['isCancelled'] && ! ((is_array($_tmp='DISABLE_INVOICES')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
				<a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'orderInvoice','id' => ($this->_tpl_vars['order']['ID'])), $this);?>
" target="_blank" class="invoice"><?php echo smarty_function_translate(array('text' => '_order_invoice'), $this);?>
</a>
			<?php endif; ?>
			<a href="<?php echo smarty_function_link(array('controller' => 'user','action' => 'reorder','id' => ($this->_tpl_vars['order']['ID'])), $this);?>
" class="reorder"><?php echo smarty_function_translate(array('text' => '_reorder'), $this);?>
</a>
		</p>

		<?php $_from = $this->_tpl_vars['order']['shipments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['shipments'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['shipments']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['shipment']):
        $this->_foreach['shipments']['iteration']++;
?>

			<?php if ($this->_tpl_vars['shipment']['items']): ?>

				<?php if (! $this->_tpl_vars['shipment']['isShippable']): ?>
					<h2><?php echo smarty_function_translate(array('text' => '_downloads'), $this);?>
</h2>
				<?php elseif ($this->_foreach['shipments']['total'] > 1): ?>
					<h2><?php echo smarty_function_translate(array('text' => '_shipment'), $this);?>
 #<?php echo $this->_foreach['shipments']['iteration']; ?>
</h2>
					<p>
						<?php echo smarty_function_translate(array('text' => '_status'), $this);?>
: <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/shipmentStatus.tpl", 'smarty_include_vars' => array('shipment' => $this->_tpl_vars['shipment'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</p>
				<?php else: ?>
					<h2><?php echo smarty_function_translate(array('text' => '_ordered_products'), $this);?>
</h2>
				<?php endif; ?>

				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/shipmentEntry.tpl", 'smarty_include_vars' => array('downloadLinks' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<?php endif; ?>

		<?php endforeach; endif; unset($_from); ?>

		<?php if (!function_exists('smarty_fun_address')) { function smarty_fun_address(&$smarty, $params) { $_fun_tpl_vars = $smarty->_tpl_vars; $smarty->assign($params);  ?>
			<?php if ($smarty->_tpl_vars['address']): ?>
				<p>
					<?php echo $smarty->_tpl_vars['address']['fullName']; ?>

				</p>
				<p>
					<?php echo $smarty->_tpl_vars['address']['companyName']; ?>

				</p>
				<p>
					<?php echo $smarty->_tpl_vars['address']['address1']; ?>

				</p>
				<p>
					<?php echo $smarty->_tpl_vars['address']['address2']; ?>

				</p>
				<p>
					<?php echo $smarty->_tpl_vars['address']['city']; ?>

				</p>
				<p>
					<?php if ($smarty->_tpl_vars['address']['stateName']): ?><?php echo $smarty->_tpl_vars['address']['stateName']; ?>
, <?php endif; ?><?php echo $smarty->_tpl_vars['address']['postalCode']; ?>

				</p>
				<p>
					<?php echo $smarty->_tpl_vars['address']['countryName']; ?>

				</p>
				<p>
					<?php $_smarty_tpl_vars = $smarty->_tpl_vars;
$smarty->_smarty_include(array('smarty_include_tpl_file' => "custom:order/addressFieldValues.tpl", 'smarty_include_vars' => array('showLabels' => false)));
$smarty->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</p>
			<?php endif; ?>
		<?php  $smarty->_tpl_vars = $_fun_tpl_vars; }} smarty_fun_address($this, array());  ?>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/fieldValues.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<div id="overviewAddresses">

			<?php if ($this->_tpl_vars['order']['ShippingAddress'] && ! $this->_tpl_vars['order']['isMultiAddress']): ?>
			<div class="addressContainer">
				<h3><?php echo smarty_function_translate(array('text' => '_is_shipped_to'), $this);?>
:</h3>
				<?php smarty_fun_address($this, array('address'=>$this->_tpl_vars['order']['ShippingAddress']));  ?>
			</div>
			<?php endif; ?>

			<div class="addressContainer">
				<h3><?php echo smarty_function_translate(array('text' => '_is_billed_to'), $this);?>
:</h3>
				<?php smarty_fun_address($this, array('address'=>$this->_tpl_vars['order']['BillingAddress']));  ?>
			</div>

		</div>

		<div class="clear"></div>

		<h2 id="m_s_g"><?php echo smarty_function_translate(array('text' => '_support'), $this);?>
</h2>

		<p class="noteAbout"><?php echo smarty_function_translate(array('text' => '_have_questions'), $this);?>
</p>

		<?php if ($this->_tpl_vars['notes']): ?>
		   <ul class="notes">
			   <?php $_from = $this->_tpl_vars['notes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['note']):
?>
				   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:user/orderNote.tpl", 'smarty_include_vars' => array('note' => $this->_tpl_vars['note'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			   <?php endforeach; endif; unset($_from); ?>
		   </ul>
		<?php endif; ?>

		<?php $this->_tag_stack[] = array('form', array('action' => "controller=user action=addNote id=".($this->_tpl_vars['order']['ID']),'method' => 'POST','id' => 'noteForm','handle' => $this->_tpl_vars['noteForm'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			
				<label for="text"><span class="label"><?php echo smarty_function_translate(array('text' => '_enter_question'), $this);?>
:</span></label>
				<fieldset class="error"><?php echo smarty_function_textarea(array('name' => 'text'), $this);?>

			
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'text')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'text')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
			<p class="submit">
				<label></label>
				<input type="submit" class="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_submit_response','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
			</p>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

		</fieldset>

	</div>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>