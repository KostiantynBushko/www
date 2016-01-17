<?php /* Smarty version 2.6.26, created on 2015-12-11 14:39:31
         compiled from custom:backend/shipment/itemAmount.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'backendProductUrl', 'custom:backend/shipment/itemAmount.tpl', 15, false),array('function', 'productUrl', 'custom:backend/shipment/itemAmount.tpl', 16, false),array('function', 'translate', 'custom:backend/shipment/itemAmount.tpl', 28, false),array('function', 'link', 'custom:backend/shipment/itemAmount.tpl', 32, false),array('modifier', 'htmlspecialchars', 'custom:backend/shipment/itemAmount.tpl', 39, false),array('modifier', 'string_format', 'custom:backend/shipment/itemAmount.tpl', 83, false),array('block', 'denied', 'custom:backend/shipment/itemAmount.tpl', 83, false),)), $this); ?>
<table class="orderShipmentsItem_info">
	<tr>
		<td class="orderShipmentsItem_info_sku_td">
		   <div class="orderShipmentsItem_info_sku">
			   <?php echo $this->_tpl_vars['item']['Product']['sku']; ?>


				<?php if ($this->_tpl_vars['item']['Product']['DefaultImage']['paths']['1']): ?>
					<a href="<?php echo $this->_tpl_vars['item']['Product']['DefaultImage']['paths']['4']; ?>
" rel="lightbox"><img src="<?php echo $this->_tpl_vars['item']['Product']['DefaultImage']['paths']['1']; ?>
" /></a>
				<?php endif; ?>
		   </div>
		</td>
		<td class="orderShipmentsItem_info_name_td">
			<div class="orderShipmentsItem_info_name">
				<?php if ($this->_tpl_vars['item']['Product']['ID']): ?>
					<a href="<?php echo smarty_function_backendProductUrl(array('product' => $this->_tpl_vars['item']['Product']), $this);?>
"><?php echo $this->_tpl_vars['item']['Product']['name_lang']; ?>
</a>
					<a class="external" href="<?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['item']['Product']), $this);?>
" target="_blank"></a>
				<?php else: ?>
					<span><?php echo $this->_tpl_vars['item']['Product']['name_lang']; ?>
</span>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['allOptions'][$this->_tpl_vars['item']['Product']['ID']] || $this->_tpl_vars['item']['options']): ?>
					<span class="basePrice">(<?php echo $this->_tpl_vars['item']['formattedBasePrice']; ?>
)</span>
					<div class="productOptions">
						<ul class="itemOptions">
						<?php $_from = $this->_tpl_vars['item']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
							<li>
								<?php echo $this->_tpl_vars['option']['Choice']['Option']['name_lang']; ?>
:
								<?php if (0 == $this->_tpl_vars['option']['Choice']['Option']['type']): ?>
									<?php echo smarty_function_translate(array('text' => '_option_yes'), $this);?>

								<?php elseif (1 == $this->_tpl_vars['option']['Choice']['Option']['type']): ?>
									<?php echo $this->_tpl_vars['option']['Choice']['name_lang']; ?>

								<?php elseif (3 == $this->_tpl_vars['option']['Choice']['Option']['type']): ?>
									<a href="<?php echo smarty_function_link(array('controller' => "backend.orderedItem",'action' => 'downloadOptionFile','id' => $this->_tpl_vars['item']['ID'],'query' => "option=".($this->_tpl_vars['option']['Choice']['Option']['ID'])), $this);?>
"><?php echo $this->_tpl_vars['option']['fileName']; ?>
</a>
									<?php if ($this->_tpl_vars['option']['small_url']): ?>
										<div class="optionImage">
											<a href="<?php echo $this->_tpl_vars['option']['large_url']; ?>
" rel="lightbox"><img src="<?php echo $this->_tpl_vars['option']['small_url']; ?>
" /></a>
										</div>
									<?php endif; ?>
								<?php else: ?>
									<?php echo htmlspecialchars($this->_tpl_vars['option']['optionText']); ?>

								<?php endif; ?>

								<?php if ($this->_tpl_vars['option']['priceDiff'] != 0): ?>
									<span class="optionPrice">(<?php echo $this->_tpl_vars['option']['formattedPrice']; ?>
)</span>
								<?php endif; ?>
							</li>
						<?php endforeach; endif; unset($_from); ?>
						</ul>

						<div class="menu productOptionsMenu">
							<a href="<?php echo smarty_function_link(array('controller' => "backend.orderedItem",'action' => 'optionForm','id' => $this->_tpl_vars['item']['ID']), $this);?>
" onclick="Backend.OrderedItem.loadOptionsForm(event);"><?php echo smarty_function_translate(array('text' => '_edit_options'), $this);?>
</a>
							<span class="progressIndicator" style="display: none;"></span>
						</div>
					</div>
				<?php endif; ?>

				<?php if ($this->_tpl_vars['item']['Product']['variations'] || $this->_tpl_vars['variations']['variations'][$this->_tpl_vars['item']['Product']['ID']]): ?>
					<div class="productOptions">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:order/itemVariations.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<div class="menu productOptionsMenu">
							<a href="<?php echo smarty_function_link(array('controller' => "backend.orderedItem",'action' => 'variationForm','id' => $this->_tpl_vars['item']['ID']), $this);?>
" id="variationsMenuLink_<?php echo $this->_tpl_vars['item']['ID']; ?>
" onclick="Backend.OrderedItem.loadOptionsForm(event);"><?php echo smarty_function_translate(array('text' => '_edit_variations'), $this);?>
</a>
							<span class="progressIndicator" style="display: none;"></span>
						</div>

						<?php if (! $this->_tpl_vars['item']['Product']['variations']): ?>
							<script type="text/javascript">
								Backend.OrderedItem.loadOptionsForm($("variationsMenuLink_<?php echo $this->_tpl_vars['item']['ID']; ?>
"));
							</script>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ($this->_tpl_vars['downloadCount'][$this->_tpl_vars['item']['ID']]): ?>
					<div class="itemDownloadStats">
						<?php echo smarty_function_translate(array('text' => '_times_downloaded'), $this);?>
: <?php echo $this->_tpl_vars['downloadCount'][$this->_tpl_vars['item']['ID']]; ?>

					</div>
				<?php endif; ?>

			</div>
		</td>
		<td class="orderShipmentsItem_info_price_td">
			<div class="orderShipmentsItem_info_price">
				<span class="pricePrefix"><?php echo $this->_tpl_vars['shipment']['AmountCurrency']['pricePrefix']; ?>
</span>
				<input name="price_<?php echo $this->_tpl_vars['item']['ID']; ?>
" id="orderShipmentsItem_price_<?php echo $this->_tpl_vars['item']['ID']; ?>
" class="price orderShipmentsItem_price" <?php if ($this->_tpl_vars['item']['Shipment']['status'] == 3 || $this->_tpl_vars['shipment']['status'] == 3): ?>readonly="readonly"<?php endif; ?> <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['itemPrice'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
" />
				<span class="priceSuffix"><?php echo $this->_tpl_vars['shipment']['AmountCurrency']['priceSuffix']; ?>
</span>
			</div>
		</td>
		<td class="orderShipmentsItem_info_count_td">
			<div class="orderShipmentsItem_info_count">
				<span class="progressIndicator" style="display: none;"></span>
				<input name="count_<?php echo $this->_tpl_vars['item']['ID']; ?>
" value="<?php echo $this->_tpl_vars['item']['count']; ?>
" id="orderShipmentsItem_count_<?php echo $this->_tpl_vars['item']['ID']; ?>
" class="orderShipmentsItem_count" style="<?php if ($this->_tpl_vars['item']['Shipment']['status'] == 3 || $this->_tpl_vars['shipment']['status'] == 3): ?>display: none;<?php endif; ?>" <?php $this->_tag_stack[] = array('denied', array('role' => 'order.update')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>readonly="readonly"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>  />
				<span class="itemCountText"><?php echo $this->_tpl_vars['item']['count']; ?>
</span>
			</div>
		</td>
		<td class="orderShipmentsItem_info_total_td ">
			<div class="orderShipmentsItem_info_total item_subtotal">
				<span class="pricePrefix"><?php echo $this->_tpl_vars['shipment']['AmountCurrency']['pricePrefix']; ?>
</span>
				<span class="price"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['displaySubTotal'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</span>
				<span class="priceSuffix"><?php echo $this->_tpl_vars['shipment']['AmountCurrency']['priceSuffix']; ?>
</span>
			</div>
		</td>
	</tr>
</table>
