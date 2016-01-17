<?php /* Smarty version 2.6.26, created on 2015-12-03 18:13:35
         compiled from /home/illumin/public_html/application/view///backend/theme/colors.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '/home/illumin/public_html/application/view///backend/theme/colors.tpl', 2, false),array('function', 'filefield', '/home/illumin/public_html/application/view///backend/theme/colors.tpl', 26, false),array('function', 'textfield', '/home/illumin/public_html/application/view///backend/theme/colors.tpl', 28, false),array('function', 'selectfield', '/home/illumin/public_html/application/view///backend/theme/colors.tpl', 30, false),array('function', 'uniqid', '/home/illumin/public_html/application/view///backend/theme/colors.tpl', 58, false),array('function', 'checkbox', '/home/illumin/public_html/application/view///backend/theme/colors.tpl', 58, false),array('function', 'hidden', '/home/illumin/public_html/application/view///backend/theme/colors.tpl', 64, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/theme/colors.tpl', 77, false),array('block', 'form', '/home/illumin/public_html/application/view///backend/theme/colors.tpl', 11, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/theme/colors.tpl', 75, false),)), $this); ?>
<?php if (! $this->_tpl_vars['config']): ?>
	<div class="warning"><?php echo smarty_function_translate(array('text' => '_colors_not_editable'), $this);?>
</div>
<?php endif; ?>

<div
	onclick="<?php echo 'TabControl.prototype.getInstance(\'tabContainer\').activateTab($(\'tabCss\'));'; ?>
"
	id="notice_changes_in_css_tab_<?php echo $this->_tpl_vars['theme']; ?>
" class="warning cssAndStyleTab" style="display:none;"
><?php echo smarty_function_translate(array('text' => '_notice_changes_in_css_tab'), $this);?>
</div>


<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.theme action=saveColors",'method' => 'POST','enctype' => "multipart/form-data",'handle' => $this->_tpl_vars['form'],'id' => "colors_".($this->_tpl_vars['theme']),'target' => "iframe_".($this->_tpl_vars['theme']))); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php $_from = $this->_tpl_vars['config']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['section']):
?>
		<fieldset>
			<legend><?php echo $this->_tpl_vars['section']['name']; ?>
</legend>

			<?php $_from = $this->_tpl_vars['section']['properties']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['property']):
?>
				<fieldset class="container entry" rel="<?php echo $this->_tpl_vars['property']['selector']; ?>
/<?php echo $this->_tpl_vars['property']['type']; ?>
">

					<?php if ('checkbox' != $this->_tpl_vars['property']['type']): ?>
						<label><?php echo $this->_tpl_vars['property']['name']; ?>
</label>
					<?php else: ?>
						<label></label>
					<?php endif; ?>

					<?php if ('upload' == $this->_tpl_vars['property']['type']): ?>
						<?php echo smarty_function_filefield(array('name' => $this->_tpl_vars['property']['var'],'class' => 'file'), $this);?>

						- <?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 -
						<?php echo smarty_function_textfield(array('class' => 'text'), $this);?>

						<div class="imageOptions">
							<div class="repeat"><?php echo smarty_function_translate(array('text' => '_repeat'), $this);?>
: <?php echo smarty_function_selectfield(array('class' => 'repeat','options' => $this->_tpl_vars['bgRepeat']), $this);?>
</div>
							<div class="position"><?php echo smarty_function_translate(array('text' => '_position'), $this);?>
: <?php echo smarty_function_selectfield(array('class' => 'position','options' => $this->_tpl_vars['bgPosition']), $this);?>
</div>
						</div>
					<?php elseif ('color' == $this->_tpl_vars['property']['type']): ?>
						<?php echo smarty_function_textfield(array('id' => $this->_tpl_vars['property']['id'],'class' => 'text color'), $this);?>

						<script type="text/javascript">
							$('<?php echo $this->_tpl_vars['property']['id']; ?>
').color = new jscolor.color($('<?php echo $this->_tpl_vars['property']['id']; ?>
'), <?php echo '{adjust: false, required: false, hash: true, caps: false}'; ?>
);
						</script>
					<?php elseif ('size' == $this->_tpl_vars['property']['type']): ?>
						<div class="sizeEntry">
							<?php echo smarty_function_textfield(array('id' => $this->_tpl_vars['property']['id'],'class' => 'text number'), $this);?>

							<?php echo smarty_function_selectfield(array('options' => $this->_tpl_vars['measurements']), $this);?>

						</div>
					<?php elseif ('border' == $this->_tpl_vars['property']['type']): ?>
						<?php echo smarty_function_textfield(array('class' => 'text number'), $this);?>

						px
						<?php echo smarty_function_selectfield(array('options' => $this->_tpl_vars['borderStyles']), $this);?>

						<?php echo smarty_function_textfield(array('id' => $this->_tpl_vars['property']['id'],'class' => 'text color'), $this);?>

						<script type="text/javascript">
							$('<?php echo $this->_tpl_vars['property']['id']; ?>
').color = new jscolor.color($('<?php echo $this->_tpl_vars['property']['id']; ?>
'), <?php echo '{adjust: false, required: false, hash: true, caps: false}'; ?>
);
						</script>
					<?php elseif ('text-decoration' == $this->_tpl_vars['property']['type']): ?>
						<?php echo smarty_function_selectfield(array('options' => $this->_tpl_vars['textStyles']), $this);?>

					<?php elseif ('font' == $this->_tpl_vars['property']['type']): ?>
						<div class="fontEntry">
							<?php echo smarty_function_textfield(array('name' => $this->_tpl_vars['property']['var'],'id' => $this->_tpl_vars['property']['id'],'class' => 'text'), $this);?>

						</div>
					<?php elseif ('checkbox' == $this->_tpl_vars['property']['type']): ?>
						<?php ob_start(); ?><?php echo smarty_function_uniqid(array(), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blockAsParamValue', ob_get_contents());ob_end_clean(); ?><?php echo smarty_function_checkbox(array('id' => ($this->_tpl_vars['blockAsParamValue']),'name' => 'option','class' => 'option checkbox','value' => $this->_tpl_vars['property']['append']), $this);?>

						<?php if ('checkbox' == $this->_tpl_vars['property']['type']): ?>
							<label class="checkbox" for="<?php echo smarty_function_uniqid(array('last' => true), $this);?>
"><?php echo $this->_tpl_vars['property']['name']; ?>
</label>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['property']['append']): ?>
						<?php echo smarty_function_hidden(array('class' => 'append','name' => 'append','value' => $this->_tpl_vars['property']['append']), $this);?>

					<?php endif; ?>
				</fieldset>
			<?php endforeach; endif; unset($_from); ?>
		</fieldset>
	<?php endforeach; endif; unset($_from); ?>

	<fieldset class="controls">
		<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['theme']; ?>
" />
		<input type="hidden" name="css" value="" />
		<span class="progressIndicator" style="display: none;"></span>
		<input type="submit" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_save','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" class="submit" />
		<?php echo smarty_function_translate(array('text' => '_or'), $this);?>

		<a class="cancel" href="<?php echo smarty_function_link(array('controller' => "backend.theme"), $this);?>
"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
	</fieldset>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<iframe src="<?php echo smarty_function_link(array('controller' => "backend.theme",'action' => 'cssIframe','query' => "theme=".($this->_tpl_vars['theme'])), $this);?>
" id="iframe_<?php echo $this->_tpl_vars['theme']; ?>
" name="iframe_<?php echo $this->_tpl_vars['theme']; ?>
" style="display: none;"></iframe>
