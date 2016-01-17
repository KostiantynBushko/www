<?php /* Smarty version 2.6.26, created on 2015-12-01 12:14:49
         compiled from /home/illumin/public_html/application/view///backend/newsletter/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeJs', '/home/illumin/public_html/application/view///backend/newsletter/index.tpl', 1, false),array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/newsletter/index.tpl', 12, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/newsletter/index.tpl', 22, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/newsletter/index.tpl', 32, false),array('function', 'activeGrid', '/home/illumin/public_html/application/view///backend/newsletter/index.tpl', 48, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/newsletter/index.tpl', 22, false),array('modifier', 'addslashes', '/home/illumin/public_html/application/view///backend/newsletter/index.tpl', 131, false),)), $this); ?>
<?php echo smarty_function_includeJs(array('file' => "library/form/Validator.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/ActiveForm.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/State.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/TabControl.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/ActiveList.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/rico/ricobase.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/rico/ricoLiveGrid.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/ActiveGrid.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/editarea/edit_area_full.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "backend/Newsletter.js"), $this);?>


<?php echo smarty_function_includeCss(array('file' => "library/ActiveGrid.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/TabControl.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/Newsletter.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "library/dhtmlCalendar/calendar.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlCalendar/lang/calendar-en.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlCalendar/lang/calendar-".($this->_tpl_vars['curLanguageCode']).".js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/dhtmlCalendar/calendar-setup.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/dhtmlCalendar/calendar-win2k-cold-2.css"), $this);?>


<?php $this->_tag_stack[] = array('pageTitle', array('help' => "tools.newsletter")); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_newsletters'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="newsletterTabContainer" class="tabContainer maxHeight h--20">

	<div id="loadingNewsletter" style="display: none; position: absolute; text-align: center; width: 100%; padding-top: 200px; z-index: 50000;">
		<span style="padding: 40px; background-color: white; border: 1px solid black;"><?php echo smarty_function_translate(array('text' => '_loading_newsletter'), $this);?>
<span class="progressIndicator"></span></span>
	</div>

	<ul class="tabList tabs">
		<li id="tabMessages" class="tab active"><a href="<?php echo smarty_function_link(array('controller' => "backend.newsletter",'action' => 'list'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_messages'), $this);?>
</a></li>
		<li id="tabSubscribers" class="tab inactive"><a href="<?php echo smarty_function_link(array('controller' => "backend.newsletterSubscriber"), $this);?>
"><?php echo smarty_function_translate(array('text' => '_subscribers'), $this);?>
</a></li>
	</ul>
	<div class="sectionContainer maxHeight h--95">
		<div id="tabMessagesContent" class="maxHeight tabPageContainer">
			<ul class="menu">
				<li class="addNewsletterMenu">
					<a href="#" onclick="Backend.Newsletter.showAddForm(this); return false;">
						<?php echo smarty_function_translate(array('text' => '_create_message'), $this);?>

					</a>
					<span class="progressIndicator" id="currAddMenuLoadIndicator" style="display: none;"></span>
				</li>
			</ul>

			<div class="clear"></div>

			<?php echo smarty_function_activeGrid(array('prefix' => 'newsletters','id' => 0,'controller' => "backend.newsletter",'action' => 'lists','displayedColumns' => $this->_tpl_vars['displayedColumns'],'availableColumns' => $this->_tpl_vars['availableColumns'],'totalCount' => 0,'filters' => $this->_tpl_vars['filters'],'container' => 'tabMessages','dataFormatter' => "Backend.Newsletter.GridFormatter",'count' => "backend/newsletter/count.tpl",'massAction' => "backend/newsletter/massAction.tpl"), $this);?>


		</div>
		<div id="tabSubscribersContent" class="tabPageContainer"></div>
	</div>
</div>

<div id="addMessageContainer" style="display: none;"></div>

<div id="newsletterManagerContainer" class="maxHeight h--90" style="display: none;">

	<fieldset class="container">
		<ul class="menu cancelEditing">
			<li class="done">
				<a href="#cancelEditing" id="cancel_newsletter_edit" class="cancel"><?php echo smarty_function_translate(array('text' => '_done_editing_message'), $this);?>
</a>
			</li>
		</ul>
	</fieldset>

	<div class="tabContainer">
		<ul class="tabList tabs">
			<li id="tabMessageInfo" class="tab active">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.newsletter",'action' => 'edit','id' => '_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_edit_message'), $this);?>
</a>
				<span class="tabHelp">products.edit</span>
			</li>

			<li id="tabSubmissionStats" class="tab inactive">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.productPrice",'action' => 'index','id' => '_id_'), $this);?>
"><?php echo smarty_function_translate(array('text' => '_submission_info'), $this);?>
</a>
				<span class="tabHelp">products.edit.pricing</span>
			</li>
		</ul>
	</div>
	<div class="sectionContainer maxHeight h--50"></div>
</div>

<?php echo '
<script type="text/javascript">
	Event.observe($("cancel_newsletter_edit"), "click", function(e) {
		Event.stop(e);
		var message = Backend.Newsletter.Editor.prototype.getInstance(Backend.Newsletter.Editor.prototype.getCurrentId(), false);
		message.removeTinyMce();
		message.cancelForm();
		Backend.Newsletter.Editor.prototype.showMainContainer();
	});

	TabControl.prototype.getInstance(\'newsletterTabContainer\', Backend.Newsletter.getTabUrl, Backend.Newsletter.getContentTabId);

	Backend.Newsletter.links =
	{
		add: \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.newsletter",'action' => 'add'), $this);?>
<?php echo '\',
		recipientCount: \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.newsletter",'action' => 'recipientCount'), $this);?>
<?php echo '\',
		plaintext: \''; ?>
<?php echo smarty_function_link(array('controller' => "backend.newsletter",'action' => 'plaintext'), $this);?>
<?php echo '\',
	}

'; ?>


	Backend.Newsletter.GridFormatter.url = '<?php echo smarty_function_link(array('controller' => "backend.newsletter",'action' => 'edit'), $this);?>
?id=';
	window.activeGrids['newsletters_0'].setDataFormatter(Backend.Newsletter.GridFormatter);

	var massHandler = new ActiveGrid.MassActionHandler(
						$('newslettersMass_0'),
						window.activeGrids['newsletters_0'],
<?php echo '
						{
							\'onComplete\':
								function()
								{
									Backend.Newsletter.resetEditors();
								}
						}
'; ?>

						);
	massHandler.deleteConfirmMessage = '<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_newsletter_delete_confirm'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__newsletter_delete_confirm', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__newsletter_delete_confirm'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
' ;
	massHandler.nothingSelectedMessage = '<?php ob_start(); ?><?php echo smarty_function_translate(array('text' => '_nothing_selected'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('translation__nothing_selected', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['translation__nothing_selected'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
' ;
<?php echo '
</script>
'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>