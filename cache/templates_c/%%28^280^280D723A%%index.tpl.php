<?php /* Smarty version 2.6.26, created on 2015-12-02 14:04:13
         compiled from /home/illumin/public_html/application/view///backend/siteNews/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeJs', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 1, false),array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 2, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 16, false),array('function', 'calendar', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 38, false),array('function', 'textfield', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 43, false),array('function', 'textarea', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 51, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 90, false),array('function', 'json', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 127, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 16, false),array('block', 'allowed', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 20, false),array('block', 'form', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 33, false),array('block', 'error', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 45, false),array('block', 'language', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 61, false),array('block', 'denied', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 76, false),array('modifier', 'capitalize', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 31, false),array('modifier', 'escape', '/home/illumin/public_html/application/view///backend/siteNews/index.tpl', 78, false),)), $this); ?>
<?php echo smarty_function_includeJs(array('file' => "library/ActiveList.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/ActiveList.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "backend/SiteNews.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/SiteNews.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "library/form/ActiveForm.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/State.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/Validator.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlCalendar/calendar.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlCalendar/lang/calendar-en.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlCalendar/lang/calendar-".($this->_tpl_vars['curLanguageCode']).".js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlCalendar/calendar-setup.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/dhtmlCalendar/calendar-win2k-cold-2.css"), $this);?>


<?php $this->_tag_stack[] = array('pageTitle', array('help' => "content.site")); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_site_news'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->_tag_stack[] = array('allowed', array('role' => "news.create")); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

	<ul class="menu" id="newsMenu">
		<li class="addNews"><a href="#add" id="addNewsLink"><?php echo smarty_function_translate(array('text' => '_add_news'), $this);?>
</a></li>
		<li class="addNewsCancel done" style="display: none;"><a href="#cancel" id="addNewsCancelLink"><?php echo smarty_function_translate(array('text' => '_cancel_adding_news'), $this);?>
</a></li>
	</ul>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<fieldset id="addNews" class="slideForm addForm" style="display: none;">

	<legend><?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_add_news'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__add_news', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__add_news'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</legend>

	<?php $this->_tag_stack[] = array('form', array('action' => "controller=backend.siteNews action=add",'method' => 'POST','onsubmit' => "new Backend.SiteNews.Add(this); return false;",'handle' => $this->_tpl_vars['form'],'id' => 'newsForm','class' => 'enabled')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<input type="hidden" name="id" />

		<p>
			<label><?php echo smarty_function_translate(array('text' => '_date'), $this);?>
</label>
			<?php echo smarty_function_calendar(array('name' => 'time','id' => 'time'), $this);?>

		</p>
		<p>
			
				<label><?php echo smarty_function_translate(array('text' => '_title'), $this);?>
:</label>
				<fieldset class="error"><?php echo smarty_function_textfield(array('name' => 'title','class' => 'text'), $this);?>

			
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'title')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'title')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
		</p>
		<p>
			
				<label class="wide"><?php echo smarty_function_translate(array('text' => '_text'), $this);?>
:</label>
				<fieldset class="error"><?php echo smarty_function_textarea(array('name' => 'text','class' => 'tinyMCE'), $this);?>

			
	<div class="errorText hidden<?php $this->_tag_stack[] = array('error', array('for' => 'text')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> visible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('error', array('for' => 'text')); $_block_repeat=true;smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['msg']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_error($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
		</p>
		<p>
			<label class="wide" style="margin-top: 1em;"><?php echo smarty_function_translate(array('text' => '_more_text'), $this);?>
:</label>
			<?php echo smarty_function_textarea(array('name' => 'moreText','class' => 'tinyMCE'), $this);?>

		</p>

		<?php $this->_tag_stack[] = array('language', array()); $_block_repeat=true;smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<p>
				<label class="wide"><?php echo smarty_function_translate(array('text' => '_title'), $this);?>
:</label>
				<?php echo smarty_function_textfield(array('class' => 'text','name' => "title_".($this->_tpl_vars['lang']['ID'])), $this);?>

			</p>
			<p>
				<label class="wide"><?php echo smarty_function_translate(array('text' => '_text'), $this);?>
:</label>
				<?php echo smarty_function_textarea(array('name' => "text_".($this->_tpl_vars['lang']['ID']),'class' => 'tinyMCE'), $this);?>

			</p>
			<p>
				<label class="wide"><?php echo smarty_function_translate(array('text' => '_more_text'), $this);?>
:</label>
				<?php echo smarty_function_textarea(array('name' => "moreText_".($this->_tpl_vars['lang']['ID']),'class' => 'tinyMCE'), $this);?>

			</p>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_language($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

		<fieldset class="controls" <?php $this->_tag_stack[] = array('denied', array('role' => 'news')); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>style="display: none;"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
			<span class="progressIndicator" style="display: none;"></span>
			<input type="submit" class="submit save" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_save','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
			<input type="submit" class="submit add" value="<?php echo ((is_array($_tmp=smarty_function_translate(array('text' => '_add','disableLiveTranslation' => 'true'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));?>
" />
			<?php echo smarty_function_translate(array('text' => '_or'), $this);?>
 <a class="cancel" href="#" onclick="Backend.SiteNews.prototype.hideAddForm(); return false;"><?php echo smarty_function_translate(array('text' => '_cancel'), $this);?>
</a>
		</fieldset>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</fieldset>

<ul id="newsList" class="activeList <?php $this->_tag_stack[] = array('allowed', array('role' => "news.sort")); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>activeList_add_sort<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php $this->_tag_stack[] = array('allowed', array('role' => "news.delete")); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>activeList_add_delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php $this->_tag_stack[] = array('allowed', array('role' => "news.update")); $_block_repeat=true;smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>activeList_add_edit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_allowed($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
</ul>

<div style="display: none">
	<span id="deleteUrl"><?php echo smarty_function_link(array('controller' => "backend.siteNews",'action' => 'delete'), $this);?>
?id=</span>
	<span id="confirmDelete"><?php echo smarty_function_translate(array('text' => '_del_conf'), $this);?>
</span>
	<span id="sortUrl"><?php echo smarty_function_link(array('controller' => "backend.siteNews",'action' => 'saveOrder'), $this);?>
</span>
	<span id="statusUrl"><?php echo smarty_function_link(array('controller' => "backend.siteNews",'action' => 'setEnabled'), $this);?>
</span>
	<span id="saveUrl"><?php echo smarty_function_link(array('controller' => "backend.siteNews",'action' => 'save'), $this);?>
</span>
</div>

<ul style="display: none;">
<li id="newsList_template" style="position: relative;">
	<div>
		<div class="newsListContainer">

			<span class="newsCheckBox"<?php $this->_tag_stack[] = array('denied', array('role' => "news.status")); $_block_repeat=true;smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> style="display: none;"<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_denied($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>>
				<input type="checkbox" class="checkbox" name="isEnabled" onclick="this.up('li').handler.setEnabled(this);" />
				<span class="progressIndicator" style="float: left; padding: 0; display: none;"></span>
			</span>

			<span class="progressIndicator" style="display: none; "></span>

			<span class="newsData">
				<span class="newsTitle"></span>
				<span class="newsDate"></span>
				<br class="clear" />
				<span class="newsText"></span>
			</span>

		</div>

		<div class="formContainer activeList_editContainer" style="display: none;"></div>

	</div>
	<div class="clear"></div>
</li>
</ul>

<script type="text/javascript">
	Form.State.backup($("newsForm"));
	new Backend.SiteNews(<?php echo smarty_function_json(array('array' => $this->_tpl_vars['newsList']), $this);?>
, $('newsList'), $('newsList_template'));
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>