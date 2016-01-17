<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from /home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/overview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'renderBlock', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/overview.tpl', 3, false),array('function', 'translate', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/overview.tpl', 19, false),array('function', 'categoryUrl', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/overview.tpl', 20, false),array('modifier', 'config', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/overview.tpl', 24, false),)), $this); ?>
<table id="productMainDetails">

	<?php echo smarty_function_renderBlock(array('block' => "PRODUCT-OVERVIEW-BEFORE"), $this);?>

	

	<?php if ($this->_tpl_vars['product']['Manufacturer']['name']): ?>
	<tr class="availField"> 
		<td>Availabilty:</td>
		<td>
		<div class="availDiv">

		<?php echo $this->_tpl_vars['product']['byHandle']['availability']['value_lang']; ?>


		</div> 
		</td>
	</tr>

	<tr>
		<td class="param"><?php echo smarty_function_translate(array('text' => '_manufacturer'), $this);?>
:</td>
		<td class="value"><a href="<?php echo smarty_function_categoryUrl(array('data' => $this->_tpl_vars['product']['Category'],'addFilter' => $this->_tpl_vars['manufacturerFilter']), $this);?>
"><?php echo $this->_tpl_vars['product']['Manufacturer']['name']; ?>
</a></td>
	</tr>
	<?php endif; ?>

	<?php if (((is_array($_tmp='SHOW_PRODUCT_WEIGHT')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) && $this->_tpl_vars['product']['shippingWeight']): ?>
	<tr>
		<td class="param"><?php echo smarty_function_translate(array('text' => '_weight'), $this);?>
:</td>
		<td class="value">
			<?php if ('METRIC' == ((is_array($_tmp='UNIT_SYSTEM')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
				<?php echo $this->_tpl_vars['product']['shippingWeight']; ?>
 <?php echo smarty_function_translate(array('text' => '_kg'), $this);?>

			<?php else: ?>
				<?php echo $this->_tpl_vars['product']['shippingWeight_english']; ?>

			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	
	<?php if ($this->_tpl_vars['product']['stockCount'] && ((is_array($_tmp='PRODUCT_DISPLAY_STOCK')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
	<tr>
		<td class="param"><?php echo smarty_function_translate(array('text' => '_in_stock'), $this);?>
:</td>
		<td class="value"><?php echo $this->_tpl_vars['product']['stockCount']; ?>
</td>
	</tr>
	<?php endif; ?>

	<?php if (! $this->_tpl_vars['product']['isDownloadable'] || ((is_array($_tmp='INVENTORY_TRACKING_DOWNLOADABLE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<?php if (! $this->_tpl_vars['product']['stockCount'] && ((is_array($_tmp='PRODUCT_DISPLAY_NO_STOCK')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<tr>
			<td colspan="2" class="noStock"><span><?php echo smarty_function_translate(array('text' => '_no_stock'), $this);?>
</span></td>
		</tr>
		<?php endif; ?>

		<?php if (( $this->_tpl_vars['product']['stockCount'] <= ((is_array($_tmp='LOW_STOCK')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)) ) && ((is_array($_tmp='PRODUCT_DISPLAY_LOW_STOCK')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<tr>
			<td colspan="2" class="lowStock"><span><?php echo smarty_function_translate(array('text' => '_low_stock'), $this);?>
</span></td>
		</tr>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['product']['URL']): ?>
	<tr>
		<td colspan="2" class="websiteUrl"><a href="<?php echo $this->_tpl_vars['product']['URL']; ?>
" target="_blank"><?php echo smarty_function_translate(array('text' => '_product_website'), $this);?>
</a></td>
	</tr>
	<?php endif; ?>

	<?php echo smarty_function_renderBlock(array('block' => "PRODUCT-OVERVIEW-AFTER"), $this);?>


</table>