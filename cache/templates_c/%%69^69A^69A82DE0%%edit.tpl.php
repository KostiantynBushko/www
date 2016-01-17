<?php /* Smarty version 2.6.26, created on 2015-12-01 10:57:05
         compiled from /home/illumin/public_html/application/view///backend/theme/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', '/home/illumin/public_html/application/view///backend/theme/edit.tpl', 1, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/theme/edit.tpl', 3, false),array('function', 'maketext', '/home/illumin/public_html/application/view///backend/theme/edit.tpl', 6, false),array('function', 'toolTip', '/home/illumin/public_html/application/view///backend/theme/edit.tpl', 8, false),array('function', 'selectfield', '/home/illumin/public_html/application/view///backend/theme/edit.tpl', 9, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/theme/edit.tpl', 19, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/theme/edit.tpl', 17, false),)), $this); ?>
<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.theme action=saveSettings",'handle' => $this->_tpl_vars['form'],'onsubmit' => "new LiveCart.AjaxRequest(this); return false;")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<fieldset>
		<legend><?php echo smarty_function_translate(array('text' => '_parent_themes'), $this);?>
</legend>
		<?php unset($this->_sections['parents']);
$this->_sections['parents']['name'] = 'parents';
$this->_sections['parents']['start'] = (int)1;
$this->_sections['parents']['loop'] = is_array($_loop=4) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['parents']['show'] = true;
$this->_sections['parents']['max'] = $this->_sections['parents']['loop'];
$this->_sections['parents']['step'] = 1;
if ($this->_sections['parents']['start'] < 0)
    $this->_sections['parents']['start'] = max($this->_sections['parents']['step'] > 0 ? 0 : -1, $this->_sections['parents']['loop'] + $this->_sections['parents']['start']);
else
    $this->_sections['parents']['start'] = min($this->_sections['parents']['start'], $this->_sections['parents']['step'] > 0 ? $this->_sections['parents']['loop'] : $this->_sections['parents']['loop']-1);
if ($this->_sections['parents']['show']) {
    $this->_sections['parents']['total'] = min(ceil(($this->_sections['parents']['step'] > 0 ? $this->_sections['parents']['loop'] - $this->_sections['parents']['start'] : $this->_sections['parents']['start']+1)/abs($this->_sections['parents']['step'])), $this->_sections['parents']['max']);
    if ($this->_sections['parents']['total'] == 0)
        $this->_sections['parents']['show'] = false;
} else
    $this->_sections['parents']['total'] = 0;
if ($this->_sections['parents']['show']):

            for ($this->_sections['parents']['index'] = $this->_sections['parents']['start'], $this->_sections['parents']['iteration'] = 1;
                 $this->_sections['parents']['iteration'] <= $this->_sections['parents']['total'];
                 $this->_sections['parents']['index'] += $this->_sections['parents']['step'], $this->_sections['parents']['iteration']++):
$this->_sections['parents']['rownum'] = $this->_sections['parents']['iteration'];
$this->_sections['parents']['index_prev'] = $this->_sections['parents']['index'] - $this->_sections['parents']['step'];
$this->_sections['parents']['index_next'] = $this->_sections['parents']['index'] + $this->_sections['parents']['step'];
$this->_sections['parents']['first']      = ($this->_sections['parents']['iteration'] == 1);
$this->_sections['parents']['last']       = ($this->_sections['parents']['iteration'] == $this->_sections['parents']['total']);
?>
			<p>
				<?php ob_start(); ?><?php echo smarty_function_maketext(array('text' => '_parent_theme_x','params' => $this->_sections['parents']['index']), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
				<?php if ($this->_sections['parents']['index'] == 1): ?><?php $this->assign('tipIndex', '1'); ?><?php else: ?><?php $this->assign('tipIndex', '2'); ?><?php endif; ?>
				<label><?php echo smarty_function_toolTip(array('label' => $this->_tpl_vars['label'],'hint' => "_tip_parent_".($this->_tpl_vars['tipIndex'])), $this);?>
:</label>
				<?php echo smarty_function_selectfield(array('name' => "parent_".($this->_sections['parents']['index']),'options' => $this->_tpl_vars['themes'],'blank' => true), $this);?>

			</p>
		<?php endfor; endif; ?>
	</fieldset>

	<fieldset class="controls">
		<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['theme']['name']; ?>
" />
		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_save','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" class="submit" />
		<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

		<a class="cancel" href="<?php echo smarty_function_link(array('controller' => "backend.theme"), $this);?>
"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
	</fieldset>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>