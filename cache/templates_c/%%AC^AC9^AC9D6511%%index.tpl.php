<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:32
         compiled from /home/illumin/public_html/storage/customize/view//theme/IlluminataV3//index/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'pageTitle', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//index/index.tpl', 1, false),array('modifier', 'config', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//index/index.tpl', 1, false),array('modifier', 'default', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//index/index.tpl', 53, false),array('function', 'renderBlock', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//index/index.tpl', 28, false),array('function', 'translate', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//index/index.tpl', 35, false),array('function', 'link', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//index/index.tpl', 44, false),)), $this); ?>
<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo ((is_array($_tmp='STORE_HEADLINE')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->assign('metaDescription', ((is_array($_tmp='INDEX_META_DESCRIPTION')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))); ?>
<?php $this->assign('metaKeywords', ((is_array($_tmp='INDEX_META_KEYWORDS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))); ?>

<script src="upload/theme/IlluminataV3/jquery.min.js"></script>
<script src="upload/theme/IlluminataV3/jquery.bxslider.js"></script>
<div class="index">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<div id="content">
	<!--<div class="welcome">
	<h3>Welcome to illuminata eyewear<h3/>
	<p>illuminata eyewear stands for a bright vision, fashionable image and a royal service.</p>
	<p>We specialize at carrying high end brands and limited edition products. Ever since we opened our door in 1998,
	we have worked hard to develop a reputation of personable service approach. We beleive we have a product for every taste and budget.</p>
	</div>-->
	

	
	<!--div class="mirror">
	<div style="float: right; width:250px;">
	<h3>Try On Eyeglasses With Virtual Mirror</h3>
	<p>Bored at home? Checked out virtual mirror to find your most perfect pair of eyeglasses</p>
	</div>
	</div-->
	<!--<?php echo smarty_function_renderBlock(array('block' => "HOME-PAGE-TOP"), $this);?>


	<?php if (((is_array($_tmp='HOME_PAGE_SUBCATS')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp))): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/subcategoriesColumns.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>-->

	<?php if ($this->_tpl_vars['news']): ?>
		<h3><?php echo smarty_function_translate(array('text' => '_latest_news'), $this);?>
</h3>
		<ul class="news">
		<?php $_from = $this->_tpl_vars['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['news'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['news']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['newsItem']):
        $this->_foreach['news']['iteration']++;
?>
			<?php if (! ($this->_foreach['news']['iteration'] == $this->_foreach['news']['total']) || ! $this->_tpl_vars['isNewsArchive']): ?>
				<li class="newsEntry">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:news/newsEntry.tpl", 'smarty_include_vars' => array('entry' => $this->_tpl_vars['newsItem'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</li>
			<?php else: ?>
				<div class="newsArchive">
					<a href="<?php echo smarty_function_link(array('controller' => 'news'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_news_archive'), $this);?>
</a>
				</div>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['subCatFeatured']): ?>
		<h3><?php echo smarty_function_translate(array('text' => '_featured_products'), $this);?>
</h3>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/productListLayout.tpl", 'smarty_include_vars' => array('layout' => ((is_array($_tmp=((is_array($_tmp='FEATURED_LAYOUT')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['layout']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['layout'])),'products' => $this->_tpl_vars['subCatFeatured'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:category/categoryProductList.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script src="upload/theme/IlluminataV3/bx.js"></script>
</div>

<h3 class="about">About us</h3>

<div class="row about-info">
	<div class="promo">
		<ul class="bxslider">
  			<li>
  				<img src="upload/theme/IlluminataV3/bnr4.jpg" />
  				<div class="about-text">
  					<p>
  					Illuminata Eyewear is designer eyeglasses store located in Etobicoke, ON right across the street from Sherway Gardens Mall.<br>  
  					Designer eyeglasses is our passion! We believe that eyeglasses create or enhance your fashion image.<br> 
  					That is why we carry over 40 brands of fashion eyeglasses to satisfy your individual image. 
  					</p>
  				</div>
  			</li>
  			
  			<li>
  				<img src="upload/theme/IlluminataV3/bnr4.jpg" />
  				<div class="about-text">
  					<p>
  					Illuminata Eyewear, Etobicoke optical store is a full service optical store.<br>
  					When you buy your eyeglasses from Illuminata, you get a life time service that goes beyond the manufacturer warranty.<br> 
  					Should you ever need eyeglasses adjustment, cleaning or a minor repair our skilful optician will fix your eyeglasses for you.
  					</p>
  				</div>
  			</li>
  			
  			<li>
  				<img src="upload/theme/IlluminataV3/bnr4.jpg" />
  				<div class="about-text">
  					<p>
  					Illuminata Eyewear is also a one stop store for your eye exam.<br> 
  					You can book an eye exam directly from our website or call us 416-620-8028.<br> 
  					We offer highest quality prescription lenses – single vision, progressive, prescription sun lenses.<br> 
  					Our specialty is very high and complex prescriptions. At Illuminata Eyewear, we offer many brand name lenses by Essilor, Nikon and Zeiss.<br> 
  					Drop in for a free consultation on which brand of lenses will be the best for you at the best price.
  					</p>
  				</div>
  			</li>
  		</ul>
  	</div>
</div>




<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>