<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:25
         compiled from custom:layout/frontend/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'renderBlock', 'custom:layout/frontend/header.tpl', 4, false),array('function', 'link', 'custom:layout/frontend/header.tpl', 10, false),array('function', 'img', 'custom:layout/frontend/header.tpl', 10, false),array('modifier', 'config', 'custom:layout/frontend/header.tpl', 10, false),)), $this); ?>
<div id="header">

	<div id="topMenuContainer">
		<?php echo smarty_function_renderBlock(array('block' => 'CART'), $this);?>

	</div>
	<div class="clear"></div>

		
	<div id="logoContainer">
		<center><a href="<?php echo smarty_function_link(array(), $this);?>
"><?php echo smarty_function_img(array('src' => ((is_array($_tmp='LOGO')) ? $this->_run_mod_handler('config', true, $_tmp) : $this->_plugins['modifier']['config'][0][0]->config($_tmp)),'alt' => 'Illuminata Logo'), $this);?>
</a></center>
	</div>

		

	<div class="clear"></div>

	<?php echo smarty_function_renderBlock(array('block' => 'HEADER'), $this);?>


	
</div>

<div class="clear"></div>
<div class="menu">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/aboutUs.html">About Us</a></li>
                    <li><a href="/hours.html">Hours</a></li>
                    <li><a href="/contact">Contact Us</a></li>
                    <li><a href="/promotionsCoupons.html">Pomotions</a></li>
                    <li><a href="/EyeExam">Eye Exam</a></li>
                    <li><a href="/news">News</a></li>

                </ul>
</div>
            <div class="clear"></div>
            
<div class="nav">
	<?php echo smarty_function_renderBlock(array('block' => 'SEARCH'), $this);?>

	<?php echo smarty_function_renderBlock(array('block' => 'ROOT_CATEGORIES'), $this);?>

</div>

<?php if ($this->_tpl_vars['request']['controller'] == 'index'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/banners.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php echo '
<script>
	jQuery(function(){
		if ( jQuery(window).width() <= 320 ) {
			jQuery(\'#cart .cartListTitle, #cart .ttl, #cart .subTotalCaption\').attr(\'colspan\', 2);
		}
		
	});

</script>
'; ?>