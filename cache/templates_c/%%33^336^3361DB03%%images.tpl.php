<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from /home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/images.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/images.tpl', 2, false),array('modifier', 'escape', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/images.tpl', 4, false),array('modifier', 'default', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/images.tpl', 5, false),array('modifier', 'config', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/images.tpl', 8, false),array('function', 'img', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/images.tpl', 8, false),array('function', 'productUrl', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/images.tpl', 21, false),array('function', 'json', '/home/illumin/public_html/storage/customize/view/theme/IlluminataV3//product/block/images.tpl', 51, false),)), $this); ?>
<div id="imageContainer">
	<div id="largeImage" class="<?php if (count($this->_tpl_vars['images']) == 0): ?>missingImage<?php endif; ?> <?php if (count($this->_tpl_vars['images']) > 1): ?>multipleImages<?php endif; ?>">
		<?php if ($this->_tpl_vars['product']['DefaultImage']['paths']['3']): ?>
			<a onclick="Product.Lightbox2Gallery.start(this); return false;" href="<?php echo $this->_tpl_vars['product']['DefaultImage']['paths']['4']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['DefaultImage']['title_lang'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" target="_blank">
				<img src="<?php echo $this->_tpl_vars['product']['DefaultImage']['paths']['3']; ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['name_lang'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=@$this->_tpl_vars['request']['variation']['sku'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['product']['sku']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['product']['sku'])); ?>
" id="mainImage" />
			</a>
		<?php else: ?>
			<?php echo smarty_function_img(array('src' => ((is_array($_tmp='MISSING_IMG_LARGE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)),'alt' => "",'id' => 'mainImage'), $this);?>

		<?php endif; ?>
							<?php if ($this->_tpl_vars['product']['hasMirror'] && ((is_array($_tmp='ENABLE_VIRTUAL_MIRROR')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<a href="#" value="Try On" id="try-on" onclick="showMirror(<?php echo $this->_tpl_vars['product']['ID']; ?>
, event)">Try Them On</a>
		<?php endif; ?>
	</div>
	<?php if (count($this->_tpl_vars['images']) > 1): ?>
		<div id="moreImages">
			<?php $_from = $this->_tpl_vars['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
				<?php if ($this->_tpl_vars['image']['productID'] != $this->_tpl_vars['product']['ID']): ?>
			<?php $this->assign('varID', $this->_tpl_vars['image']['productID']); ?>
			<?php $this->assign("varProduct", Product::getInstanceByID($this->get_template_vars("varID"))->toArray()); ?>
			<?php ob_start(); ?><?php echo smarty_function_productUrl(array('product' => $this->_tpl_vars['varProduct']), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('imgLink', ob_get_contents());ob_end_clean(); ?>
			<?php $this->assign('isVariation', 1); ?>
		<?php else: ?> 
			<?php $this->assign('imgLink', $this->_tpl_vars['image']['paths']['4']); ?>
			<?php $this->assign('isVariation', 0); ?>
		<?php endif; ?>
		<a href="<?php echo $this->_tpl_vars['imgLink']; ?>
" <?php if (! $this->_tpl_vars['isVariation']): ?>target="_blank" onclick="return false;"<?php endif; ?>>
		<?php echo smarty_function_img(array('src' => $this->_tpl_vars['image']['paths']['1'],'id' => "img_".($this->_tpl_vars['image']['ID']),'alt' => ((is_array($_tmp=$this->_tpl_vars['image']['name_lang'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)),'onclick' => "return false;"), $this);?>
</a>
			<?php endforeach; endif; unset($_from); ?>
		</div>
	<?php endif; ?>
	<?php if (count($this->_tpl_vars['images']) > 0): ?>
				<div class="hidden">
			<?php $_from = $this->_tpl_vars['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
				<a rel="lightbox[product]" href="<?php echo $this->_tpl_vars['image']['paths']['4']; ?>
" target="_blank" onclick="return false;"><?php echo smarty_function_img(array('src' => $this->_tpl_vars['image']['paths']['1'],'id' => "img_".($this->_tpl_vars['image']['ID']),'alt' => ((is_array($_tmp=$this->_tpl_vars['image']['title_lang'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)),'onclick' => "return false;"), $this);?>
</a>
			<?php endforeach; endif; unset($_from); ?>
		</div>
	<?php endif; ?>
	
	
</div>

<?php echo '
<script type="text/javascript">
'; ?>

	var imageData = $H();
	var imageDescr = $H();
	var imageProducts = $H();
	<?php $_from = $this->_tpl_vars['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
		imageData[<?php echo $this->_tpl_vars['image']['ID']; ?>
] = <?php echo smarty_function_json(array('array' => $this->_tpl_vars['image']['paths']), $this);?>
;
		imageDescr[<?php echo $this->_tpl_vars['image']['ID']; ?>
] = <?php echo smarty_function_json(array('array' => $this->_tpl_vars['image']['title_lang']), $this);?>
;
		imageProducts[<?php echo $this->_tpl_vars['image']['ID']; ?>
] = <?php echo smarty_function_json(array('array' => $this->_tpl_vars['image']['productID']), $this);?>
;
	<?php endforeach; endif; unset($_from); ?>
	new Product.ImageHandler(imageData, imageDescr, imageProducts, <?php if ($this->_tpl_vars['enlargeProductThumbnailOnMouseOver']): ?>true<?php else: ?>false<?php endif; ?>);

	var loadingImage = 'image/loading.gif';
	var closeButton = 'image/silk/gif/cross.gif';
</script>