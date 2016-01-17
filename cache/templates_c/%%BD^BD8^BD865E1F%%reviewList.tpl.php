<?php /* Smarty version 2.6.26, created on 2015-12-01 21:46:36
         compiled from custom:product/reviewList.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'custom:product/reviewList.tpl', 12, false),)), $this); ?>
<div id="reviews">

	<?php $_from = $this->_tpl_vars['reviews']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['reviews'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['reviews']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['review']):
        $this->_foreach['reviews']['iteration']++;
?>
		<div class="review<?php if (($this->_foreach['reviews']['iteration'] <= 1)): ?> first<?php endif; ?>">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/ratingBreakdown.tpl", 'smarty_include_vars' => array('ratings' => $this->_tpl_vars['review']['ratings'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<span class="reviewRating"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:product/ratingImage.tpl", 'smarty_include_vars' => array('rating' => $this->_tpl_vars['review']['rating'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span>
			<span class="reviewNickname"><?php echo $this->_tpl_vars['review']['nickname']; ?>
</span>, <span class="reviewDate"><?php echo $this->_tpl_vars['review']['formatted_dateCreated']['date_long']; ?>
</span>
			<div class="reviewTitle">
				<?php echo $this->_tpl_vars['review']['title']; ?>

			</div>
			<p class="reviewText">
				<?php echo smarty_modifier_nl2br($this->_tpl_vars['review']['text']); ?>

			</p>
		</div>
	<?php endforeach; endif; unset($_from); ?>

</div>