<?php /* Smarty version 2.6.26, created on 2015-12-01 15:10:26
         compiled from /home/illumin/public_html/storage/customize/view//module/eye-exam/EyeExam/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'rand', '/home/illumin/public_html/storage/customize/view//module/eye-exam/EyeExam/index.tpl', 2, false),array('modifier', 'strip_tags', '/home/illumin/public_html/storage/customize/view//module/eye-exam/EyeExam/index.tpl', 5, false),array('modifier', 'count', '/home/illumin/public_html/storage/customize/view//module/eye-exam/EyeExam/index.tpl', 33, false),array('modifier', 'substr', '/home/illumin/public_html/storage/customize/view//module/eye-exam/EyeExam/index.tpl', 44, false),array('block', 'pageTitle', '/home/illumin/public_html/storage/customize/view//module/eye-exam/EyeExam/index.tpl', 4, false),array('block', 'form', '/home/illumin/public_html/storage/customize/view//module/eye-exam/EyeExam/index.tpl', 18, false),array('block', 'error', '/home/illumin/public_html/storage/customize/view//module/eye-exam/EyeExam/index.tpl', 28, false),array('function', 'translate', '/home/illumin/public_html/storage/customize/view//module/eye-exam/EyeExam/index.tpl', 12, false),array('function', 'textfield', '/home/illumin/public_html/storage/customize/view//module/eye-exam/EyeExam/index.tpl', 26, false),array('function', 'radio', '/home/illumin/public_html/storage/customize/view//module/eye-exam/EyeExam/index.tpl', 44, false),array('function', 'renderBlock', '/home/illumin/public_html/storage/customize/view//module/eye-exam/EyeExam/index.tpl', 55, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->assign('containerId', ((is_array($_tmp=$this->_tpl_vars['blah'])) ? $this->_run_mod_handler('rand', true, $_tmp, 1000000) : rand($_tmp, 1000000))); ?>

<?php $this->_tag_stack[] = array('pageTitle', array()); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['page']['title_lang']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->assign('metaDescription', smarty_modifier_strip_tags($this->_tpl_vars['page']['metaDescription_lang'])); ?>

<div class="staticPageView}">

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/layout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <div id="content">
        <h1><?php echo smarty_function_translate(array('text' => '_title_lang'), $this);?>
</h1>

        <div class="staticPageText">
            <?php echo smarty_function_translate(array('text' => '_text_lang'), $this);?>

        </div>
        <br />
        <?php $this->_tag_stack[] = array('form', array('action' => "controller=EyeExam action=send",'method' => 'POST','id' => 'EyeExam','handle' => $this->_tpl_vars['form'],'style' => "float: left;")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:block/eav/fields.tpl", 'smarty_include_vars' => array('fieldList' => $this->_tpl_vars['specFieldList'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                        <div style="display: none;">
                
                <label for="surname"><span class="label">Your surname:</span></label>
                <fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'surname','class' => 'text'), $this);?>

                
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'surname')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'surname')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
            </div>
            <div class="eavField ">
                <p>
                    <?php if (count($this->_tpl_vars['schedule']) == 0): ?>
                <div id="noActiveTimeMessage"><?php echo smarty_function_translate(array('text' => '_no_working_hours'), $this);?>
</div>
                <?php else: ?>
                <fieldset class="error">
                    <?php $_from = $this->_tpl_vars['schedule']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['date_formatted'] => $this->_tpl_vars['date']):
?>
                    <h4><?php echo $this->_tpl_vars['date_formatted']; ?>
<h4>
                            <?php $_from = $this->_tpl_vars['date']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['doctor']):
?>
                                <?php if ($this->_tpl_vars['doctor']['isVisible'] == '1'): ?>
                                    <h4><?php echo $this->_tpl_vars['doctor']['doctorName']; ?>
</h4>
                                <?php endif; ?>
                                <?php $_from = $this->_tpl_vars['doctor']['times']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['time'] => $this->_tpl_vars['id']):
?>
                                    <?php echo smarty_function_radio(array('name' => 'time','value' => $this->_tpl_vars['id'],'class' => 'radio','style' => $this->_tpl_vars['requestTimeStyle']), $this);?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['time'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 5) : substr($_tmp, 0, 5)); ?>
 <br/>
                                <?php endforeach; endif; unset($_from); ?>
                            <?php endforeach; endif; unset($_from); ?>
                            <br />
                            <?php endforeach; endif; unset($_from); ?>
                            <div style="display: none;" class="errorText hidden"></div>
                </fieldset>
                <?php endif; ?>
                </p>
            </div>

        <?php echo smarty_function_renderBlock(array('block' => "FORM-SUBMIT-CONTACT"), $this);?>


            <p>
                <label class="empty"></label>
                <input type="submit" class="submit" value="<?php echo smarty_function_translate(array('text' => '_form_submit'), $this);?>
" />
            </p>

        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </div>
    <script type="text/javascript">

    </script>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/frontend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>