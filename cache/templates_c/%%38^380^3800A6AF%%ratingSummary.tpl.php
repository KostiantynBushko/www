<?php /* Smarty version 2.6.26, created on 2015-12-01 10:48:41
         compiled from /home/illumin/public_html/application/view//product/ratingSummary.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view//product/ratingSummary.tpl', 5, false),array('function', 'self', '/home/illumin/public_html/application/view//product/ratingSummary.tpl', 7, false),array('function', 'maketext', '/home/illumin/public_html/application/view//product/ratingSummary.tpl', 7, false),)), $this); ?>
<?php if ($this->_tpl_vars['product']['ratingCount'] > 0): ?>
	<div id="ratingSummary">
		<fieldset class="container">
			<div class="overallRating">
				<span><?php echo smarty_function_translate(array('text' => '_overall_rating'), $this);?>
:</span> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/ratingImage.tpl", 'smarty_include_vars' => array('rating' => $this->_tpl_vars['product']['rating'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php if ($this->_tpl_vars['product']['reviewCount'] > 0): ?>
					<a href="<?php echo smarty_function_self(array(), $this);?>
#reviews">(<?php echo smarty_function_maketext(array('text' => '_review_count','params' => $this->_tpl_vars['product']['reviewCount']), $this);?>
)</a>
				<?php endif; ?>
			</div>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/ratingBreakdown.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		</fieldset>
	</div>
<?php endif; ?>