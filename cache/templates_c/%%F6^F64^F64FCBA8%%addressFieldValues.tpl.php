<?php /* Smarty version 2.6.26, created on 2015-12-04 09:31:06
         compiled from custom:order/addressFieldValues.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'custom:order/addressFieldValues.tpl', 3, false),array('modifier', 'count', 'custom:order/addressFieldValues.tpl', 5, false),)), $this); ?>
<?php if (!function_exists('smarty_fun_attributeValue')) { function smarty_fun_attributeValue(&$smarty, $params) { $_fun_tpl_vars = $smarty->_tpl_vars; $smarty->assign($params);  ?>
<?php $smarty->assign('field', ((is_array($_tmp=@$smarty->_tpl_vars['field'])) ? $smarty->_run_mod_handler('default', true, $_tmp, 'SpecField') : smarty_modifier_default($_tmp, 'SpecField'))); ?>
<?php if ($smarty->_tpl_vars['attr']['values']): ?>
<ul class="attributeList<?php if (count($smarty->_tpl_vars['attr']['values']) == 1): ?> singleValue<?php endif; ?>"><?php $_from = $smarty->_tpl_vars['attr']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $smarty->_tpl_vars['value']):
?>
<li> <?php echo $smarty->_tpl_vars['value']['value_lang']; ?>
</li><?php endforeach; endif; unset($_from); ?></ul>
<?php elseif ($smarty->_tpl_vars['attr']['value_lang']): ?><?php echo $smarty->_tpl_vars['attr']['value_lang']; ?>

<?php elseif ($smarty->_tpl_vars['attr']['value']): ?><?php echo $smarty->_tpl_vars['attr'][$smarty->_tpl_vars['field']]['valuePrefix_lang']; ?>
<?php echo $smarty->_tpl_vars['attr']['value']; ?>
<?php echo $smarty->_tpl_vars['attr'][$smarty->_tpl_vars['field']]['valueSuffix_lang']; ?>

<?php endif; ?><?php  $smarty->_tpl_vars = $_fun_tpl_vars; }} smarty_fun_attributeValue($this, array());  ?>
<?php $_from = $this->_tpl_vars['address']['attributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attr']):
?>
<?php if ($this->_tpl_vars['attr']['EavField'] && ( $this->_tpl_vars['attr']['values'] || $this->_tpl_vars['attr']['value'] || $this->_tpl_vars['attr']['value_lang'] )): ?>
<?php if ($this->_tpl_vars['showLabels']): ?><label class="attrName"><?php echo $this->_tpl_vars['attr']['EavField']['name_lang']; ?>
:</label>  <label class="attrValue"><?php smarty_fun_attributeValue($this, array('attr'=>$this->_tpl_vars['attr'],'field'=>'EavField'));  ?></label>
<?php else: ?><p class="attrValue"><?php smarty_fun_attributeValue($this, array('attr'=>$this->_tpl_vars['attr'],'field'=>'EavField'));  ?></p><?php endif; ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>