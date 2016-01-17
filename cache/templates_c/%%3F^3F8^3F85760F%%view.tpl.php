<?php /* Smarty version 2.6.26, created on 2015-12-01 11:14:19
         compiled from /home/illumin/public_html/storage/customize/view//theme/IlluminataV3//news/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'pageTitle', '/home/illumin/public_html/storage/customize/view//theme/IlluminataV3//news/view.tpl', 1, false),)), $this); ?>
<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['news']['title_lang']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->assign('metaDescription', $this->_tpl_vars['category']['description_lang']); ?>
<?php $this->assign('metaKeywords', $this->_tpl_vars['category']['keywords_lang']); ?>

<div class="categoryIndex category_<?php echo $this->_tpl_vars['category']['ID']; ?>
">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content">
	<h1><?php echo $this->_tpl_vars['news']['title_lang']; ?>
</h1>
	<div class="newsDate"><?php echo $this->_tpl_vars['news']['formatted_time']['date_long']; ?>
</div>

	<div class="newsEntry">
		<p><?php echo $this->_tpl_vars['news']['text_lang']; ?>
</p>

		<?php if ($this->_tpl_vars['news']['moreText_lang']): ?>
			<p><?php echo $this->_tpl_vars['news']['moreText_lang']; ?>
</p>
		<?php endif; ?>
	</div>

</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>

<?php echo '
		<!-- AddThis Smart Layers BEGIN -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize -->

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5277150f0ea19ad7"></script>


<script type="text/javascript">
  addthis.layers({
    \'theme\' : \'transparent\',
    \'share\' : {
      \'position\' : \'left\',
      \'numPreferredServices\' : 5
    }, 
    \'follow\' : {
      \'services\' : [
        {\'service\': \'twitter\', \'id\': \'trendeyewear\'}
      ]
    }   
  });
</script>

<!-- AddThis Smart Layers END -->

		
		'; ?>