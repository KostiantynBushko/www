<?php /* Smarty version 2.6.26, created on 2015-12-03 18:16:34
         compiled from /home/illumin/public_html/application/view///backend/discount/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'includeJs', '/home/illumin/public_html/application/view///backend/discount/index.tpl', 1, false),array('function', 'includeCss', '/home/illumin/public_html/application/view///backend/discount/index.tpl', 9, false),array('function', 'translate', '/home/illumin/public_html/application/view///backend/discount/index.tpl', 24, false),array('function', 'link', '/home/illumin/public_html/application/view///backend/discount/index.tpl', 53, false),array('function', 'json', '/home/illumin/public_html/application/view///backend/discount/index.tpl', 63, false),array('function', 'selectfield', '/home/illumin/public_html/application/view///backend/discount/index.tpl', 83, false),array('function', 'textfield', '/home/illumin/public_html/application/view///backend/discount/index.tpl', 86, false),array('function', 'renderBlock', '/home/illumin/public_html/application/view///backend/discount/index.tpl', 88, false),array('function', 'calendar', '/home/illumin/public_html/application/view///backend/discount/index.tpl', 105, false),array('function', 'toolTip', '/home/illumin/public_html/application/view///backend/discount/index.tpl', 116, false),array('block', 'pageTitle', '/home/illumin/public_html/application/view///backend/discount/index.tpl', 24, false),array('block', 'form', '/home/illumin/public_html/application/view///backend/discount/index.tpl', 75, false),)), $this); ?>
<?php echo smarty_function_includeJs(array('file' => "library/rico/ricobase.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/rico/ricoLiveGrid.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/Validator.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/ActiveForm.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/form/State.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/ActiveGrid.js"), $this);?>

<?php echo smarty_function_includeJs(array('file' => "library/TabControl.js"), $this);?>


<?php echo smarty_function_includeCss(array('file' => "library/TabControl.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/ActiveList.css"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/ActiveGrid.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "backend/Category.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/Category.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "backend/Discount.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "backend/Discount.css"), $this);?>


<?php echo smarty_function_includeJs(array('file' => "library/ActiveList.js"), $this);?>

<?php echo smarty_function_includeCss(array('file' => "library/ActiveGrid.css"), $this);?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/eav/includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->_tag_stack[] = array('pageTitle', array('help' => 'products')); $_block_repeat=true;smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_translate(array('text' => '_pricing_rules'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pageTitle($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="discountGrid" id="discountGrid" class="maxHeight h--50">
	<ul class="menu">
		<li class="addDiscountMenu">
			<a href="#" onclick="Backend.Discount.Editor.prototype.showAddForm(this); return false;">
				<?php echo smarty_function_translate(array('text' => '_create_rule'), $this);?>

			</a>
			<span class="progressIndicator" id="currAddMenuLoadIndicator" style="display: none;"></span>
		</li>
	</ul>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:backend/discount/grid.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<div id="addDiscountContainer" style="display: none;"></div>

<div id="discountManagerContainer" style="display: none;">
	<fieldset class="container">
		<ul class="menu">
			<li class="done"><a href="#cancelEditing" id="cancel_user_edit" class="cancel"><?php echo smarty_function_translate(array('text' => '_cancel_editing_discount'), $this);?>
</a></li>
		</ul>
	</fieldset>

	<div class="tabContainer">
		<ul class="tabList tabs">
			<li id="tabUserInfo" class="tab active">
				<a href="<?php echo smarty_function_link(array('controller' => "backend.discount",'action' => 'edit','id' => '_id_'), $this);?>
"}"></a>
				<span class="tabHelp">products</span>
			</li>
		</ul>
	</div>
	<div class="sectionContainer maxHeight h--50"></div>

	<?php echo '
	<script type="text/javascript">
		Backend.Discount.Editor.prototype.Links.add = Backend.Router.createUrl(\'backend.discount\', \'add\');
		Backend.Discount.Action.prototype.itemActions = '; ?>
<?php echo smarty_function_json(array('array' => $this->_tpl_vars['itemActions']), $this);?>
<?php echo ';
		Event.observe($("cancel_user_edit"), "click", function(e) {
			Event.stop(e);
			var editor = Backend.Discount.Editor.prototype.getInstance(Backend.Discount.Editor.prototype.getCurrentId(), false);
			editor.cancelForm();
		});
	</script>
	'; ?>

</div>

<div id="conditionTemplate">
	<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['conditionForm'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<li>
			<div class="conditionInfo">
				<span class="conditionDeleteMenu">
					<img src="image/silk/cancel.png" class="conditionDelete" />
					<span class="progressIndicator" style="display: none;"></span>
				</span>

				<span><?php echo smarty_function_selectfield(array('name' => 'conditionClass','class' => 'conditionClass','options' => $this->_tpl_vars['conditionTypes']), $this);?>
</span>
				<span><?php echo smarty_function_selectfield(array('name' => 'productComparisonField','class' => 'comparisonField','options' => $this->_tpl_vars['comparisonFields']), $this);?>
</span>
				<span><?php echo smarty_function_selectfield(array('name' => 'comparisonType','class' => 'comparisonType','options' => $this->_tpl_vars['comparisonTypes']), $this);?>
</span>
				<span><?php echo smarty_function_textfield(array('name' => 'comparisonValue','class' => 'number comparisonValue'), $this);?>
</span>

				<?php echo smarty_function_renderBlock(array('block' => "BUSINESS-RULE-CONDITION-PARAMS"), $this);?>


				<span class="conditionTime">
					<?php echo smarty_function_translate(array('text' => '_include_orders_time'), $this);?>

					<select name="conditionTime" class="value">
						<option value="before"><?php echo smarty_function_translate(array('text' => '_condition_time_before'), $this);?>
</option>
						<option value="range"><?php echo smarty_function_translate(array('text' => '_condition_time_range'), $this);?>
</option>
					</select>

					<span class="conditionTimeBefore">
						<input name="min" type="text" class="minutes text number value" /> <?php echo smarty_function_translate(array('text' => '_minutes'), $this);?>

						<input name="hr" type="text" class="hours text number value" /> <?php echo smarty_function_translate(array('text' => '_hours'), $this);?>

						<input name="day" type="text" class="days text number value" /> <?php echo smarty_function_translate(array('text' => '_days'), $this);?>

						<input name="year" type="text" class="years text number value" /> <?php echo smarty_function_translate(array('text' => '_years'), $this);?>

					</span>

					<span class="conditionTimeRange">
						<?php echo smarty_function_calendar(array('name' => 'from','id' => 'from'), $this);?>

						<?php echo smarty_function_calendar(array('name' => 'to','id' => 'to'), $this);?>

					</span>

					<span class="progressIndicator" style="display: none;"></span>
				</span>

				<span class="subConditionMenu">

					<span class="isReverseContainer">
						<input type="checkbox" class="checkbox isReverse" name="isReverse" id="isReverse">
						<label class="checkbox"><?php echo smarty_function_toolTip(array('label' => '_isReverse','hint' => '_isReverse_help'), $this);?>
</label>
					</span>

					<a href="#" class="subCondition"><?php echo smarty_function_translate(array('text' => '_add_subcondition'), $this);?>
</a>
					<span class="progressIndicator" style="display: none;"></span>
				</span>
			</div>

			<div class="recordContainer" style="display: none;">
				<ul class="menu">
					<div class="conditionItems">
						<li class="addConditionProduct"><a href="#"><?php echo smarty_function_translate(array('text' => '_add_product'), $this);?>
</a></li>
						<li class="addConditionCategory"><a href="#"><?php echo smarty_function_translate(array('text' => '_add_category'), $this);?>
</a></li>
						<li class="addConditionManufacturer"><a href="#"><?php echo smarty_function_translate(array('text' => '_add_manufacturer'), $this);?>
</a></li>
					</div>

					<li class="addConditionUserGroup"><a href="#"><?php echo smarty_function_translate(array('text' => '_add_usergroup'), $this);?>
</a></li>
					<li class="addConditionUser"><a href="#"><?php echo smarty_function_translate(array('text' => '_add_user'), $this);?>
</a></li>
					<li class="addConditionDeliveryZone"><a href="#"><?php echo smarty_function_translate(array('text' => '_add_deliveryzone'), $this);?>
</a></li>
				</ul>
				<ul class="records"></ul>
				<div class="allItemsMenu">
					<span>
						<input type="checkbox" value="1" class="checkbox isAnyRecord" id="isAnyRecord" name="isAnyRecord" />
						<label class="checkbox" for="isAnyRecord"><?php echo smarty_function_toolTip(array('label' => '_all_items_must_be_present'), $this);?>
</label>
					</span>
					<div class="clear"></div>
				</div>
			</div>

			<div class="selectRecordContainer">
				<ul></ul>
				<div class="clear"></div>
			</div>

			<div class="valueContainer">
				<ul></ul>
				<div class="clear"></div>
			</div>

			<ul class="conditionContainer" style="display: none;">
				<div class="allSubsMenu">
					<span>
						<input type="checkbox" value="1" class="checkbox isAllSubconditions" id="isAllSubconditions" name="isAllSubconditions" />
						<label class="checkbox" for="isAllSubconditions"><?php echo smarty_function_toolTip(array('label' => '_all_subconditions_must_match'), $this);?>
</label>
					</span>
					<div class="clear"></div>
				</div>
			</ul>
		</li>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>

<div id="recordTemplate">
	<li>
		<span class="recordDeleteMenu">
			<img src="image/silk/cancel.png" class="recordDelete" />
			<span class="progressIndicator" style="display: none;"></span>
		</span>
		<a href="#"><span class="recordClass"></span><span class="recordTypeSep">: </span><span class="recordName"></span></a>
	</li>
</div>

<div id="selectRecordTemplate">
	<li>
		<span>
			<input type="checkbox" class="checkbox" />
		</span>
		<label class="checkbox"><a href="#"></a></label>
	</li>
</div>

<div id="actionTemplate">
	<?php $this->_tag_stack[] = array('form', array('handle' => $this->_tpl_vars['conditionForm'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<li>
			<label style="width: 80px;"></label>
			<span>
				<input type="checkbox" class="checkbox isEnabled" name="isEnabled" />
				<label class="checkbox"><?php echo smarty_function_translate(array('text' => '_is_enabled'), $this);?>
</label>
			</span>
			<div class="clear"></div>

			<p>
				<label><?php echo smarty_function_toolTip(array('label' => '_action'), $this);?>
</label>
				<span><?php echo smarty_function_selectfield(array('name' => 'actionClass','class' => 'actionClass','options' => $this->_tpl_vars['actionTypes']), $this);?>
</span>
			</p>

			<div class="amountFields">
				<p>
					<label><?php echo smarty_function_translate(array('text' => '_amount'), $this);?>
</label>
					<span><?php echo smarty_function_textfield(array('name' => 'amount','class' => 'number comparisonValue'), $this);?>
</span>
					<span class="percent">%</span>
					<span class="currency"><?php echo $this->_tpl_vars['currencyCode']; ?>
</span>
				</p>
				<p>
					<label><?php echo smarty_function_toolTip(array('label' => '_discount_step','hint' => '_discount_step_descr'), $this);?>
</label>
					<span><?php echo smarty_function_textfield(array('name' => 'discountStep','class' => 'number discountStep'), $this);?>
</span>
				</p>
				<p>
					<label><?php echo smarty_function_toolTip(array('label' => '_discount_limit','hint' => '_discount_limit_descr'), $this);?>
</label>
					<span><?php echo smarty_function_textfield(array('name' => 'discountLimit','class' => 'number discountLimit'), $this);?>
</span>
				</p>

				<label></label>
				<span>
					<input type="checkbox" class="checkbox isOrderLevel" name="isOrderLevel" />
					<label class="checkbox"><?php echo smarty_function_toolTip(array('label' => '_is_order_level','hint' => '_discount_isOrderLevel_descr'), $this);?>
</label>
				</span>
				<div class="clear"></div>
			</div>

			<div class="actionFields">
				<?php $_from = $this->_tpl_vars['actionFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['actionClass'] => $this->_tpl_vars['fields']):
?>
					<?php if ($this->_tpl_vars['fields']): ?>
						<div class="classContainer <?php echo $this->_tpl_vars['actionClass']; ?>
">
							<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
								<p>
									<label><?php echo smarty_function_translate(array('text' => $this->_tpl_vars['field']['label']), $this);?>
</label>
									<span>
										<?php if ($this->_tpl_vars['field']['type'] == 'number'): ?>
											<?php echo smarty_function_textfield(array('class' => "text number actionField ".($this->_tpl_vars['field']['name']),'name' => $this->_tpl_vars['field']['name']), $this);?>

										<?php elseif ($this->_tpl_vars['field']['type'] == 'text'): ?>
											<?php echo smarty_function_textfield(array('class' => "text wide actionField ".($this->_tpl_vars['field']['name']),'name' => $this->_tpl_vars['field']['name']), $this);?>

										<?php elseif ($this->_tpl_vars['field']['type'] == 'select'): ?>
											<?php echo smarty_function_selectfield(array('class' => "actionField ".($this->_tpl_vars['field']['name']),'name' => $this->_tpl_vars['field']['name'],'options' => $this->_tpl_vars['field']['options']), $this);?>

										<?php endif; ?>
										<span class="progressIndicator" style="display: none;"></span>
									</span>
								</p>
							<?php endforeach; endif; unset($_from); ?>
						</div>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			</div>

			<div class="clear"></div>

			<div class="applyTo">
				<p>
					<label><?php echo smarty_function_translate(array('text' => '_apply_to'), $this);?>
</label>
					<span><?php echo smarty_function_selectfield(array('name' => 'type','class' => 'applyTo','options' => $this->_tpl_vars['applyToChoices']), $this);?>
</span>
				</p>

				<div class="conditionContainer actionCondition">
					<ul class="conditionContainer root" style="display: none;"></ul>
				</div>
			</div>
		</li>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom:layout/backend/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>