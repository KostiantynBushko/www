<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:01
         compiled from custom:order/itemVariationsList.tpl */ ?>
<?php $_from = $this->_tpl_vars['item']['Product']['variations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['variations'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['variations']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['variation']):
        $this->_foreach['variations']['iteration']++;
?>
<span class="variationName"><?php echo $this->_tpl_vars['variation']['name_lang']; ?>
</span><?php if (! ($this->_foreach['variations']['iteration'] == $this->_foreach['variations']['total'])): ?> <span class="variationSeparator">/</span> <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>