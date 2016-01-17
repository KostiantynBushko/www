<?php /* Smarty version 2.6.26, created on 2015-12-01 10:53:59
         compiled from custom:backend/module/node.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'custom:backend/module/node.tpl', 1, false),array('function', 'translate', 'custom:backend/module/node.tpl', 12, false),array('function', 'json', 'custom:backend/module/node.tpl', 46, false),)), $this); ?>
<li id="<?php echo $this->_tpl_vars['module']['path']; ?>
" class="module module_<?php echo ((is_array($_tmp=$this->_tpl_vars['module']['path'])) ? $this->_run_mod_handler('replace', true, $_tmp, '.', '_') : smarty_modifier_replace($_tmp, '.', '_')); ?>
 activeList_odd <?php if ($this->_tpl_vars['module']['newest'] && ( $this->_tpl_vars['module']['newest']['version'] != $this->_tpl_vars['module']['Module']['version'] )): ?>needUpdate<?php endif; ?> <?php if (! $this->_tpl_vars['module']['isEnabled']): ?>disabled<?php endif; ?> <?php if ($this->_tpl_vars['module']['isInstalled']): ?>installed<?php endif; ?>">
	<div>
		<span class="moduleStatus">
			<input type="checkbox" class="checkbox" <?php if ($this->_tpl_vars['module']['isEnabled']): ?>checked="checked"<?php endif; ?> <?php if (! $this->_tpl_vars['module']['isInstalled']): ?>disabled="disabled"<?php endif; ?> />
			<span class="progressIndicator" style="display: none;"></span>
		</span>

		<div class="moduleContent">

			<?php if ($this->_tpl_vars['module']['newest'] && ( $this->_tpl_vars['module']['newest']['version'] != $this->_tpl_vars['module']['Module']['version'] )): ?>
				<span class="updateInfo">
					<?php echo smarty_function_translate(array('text' => '_newest_version'), $this);?>
: <span class="newestVersionNumber"><?php echo $this->_tpl_vars['module']['newest']['version']; ?>
</span>
					<span class="updateTime"><?php echo $this->_tpl_vars['module']['newest']['time']['date_medium']; ?>
</span>
				</span>
			<?php endif; ?>

			<span class="moduleName"><?php echo $this->_tpl_vars['module']['Module']['name']; ?>
</span>
			<?php if (! $this->_tpl_vars['module']['isEnabled']): ?>
				<span class="moduleInactive">(<?php echo smarty_function_translate(array('text' => '_inactive'), $this);?>
)</span>
			<?php endif; ?>

			<div class="moduleVersion">
				<?php echo smarty_function_translate(array('text' => '_version'), $this);?>
: <?php echo $this->_tpl_vars['module']['Module']['version']; ?>
 | <?php echo smarty_function_translate(array('text' => '_channel'), $this);?>
: <span class="channel channel-<?php echo $this->_tpl_vars['module']['Module']['line']; ?>
"><?php echo $this->_tpl_vars['module']['Module']['line']; ?>
</span>
			</div>

			<?php if (! $this->_tpl_vars['module']['isInstalled']): ?>
				<div class="moduleInstallationStatus"><span class="installed_no"><?php echo smarty_function_translate(array('text' => '_not_installed'), $this);?>
</span> (<a class="installAction" href="#install"><?php echo smarty_function_translate(array('text' => '_install'), $this);?>
</a>)</div>
			<?php else: ?>
				<div class="moduleUpdate">
						<?php if ($this->_tpl_vars['module']['repo']): ?>
							<a class="updateAction" href="#update">Update or downgrade</a> <span class="sep">|</span>
						<?php endif; ?>

						<a class="installAction" href="#deinstall"><?php echo smarty_function_translate(array('text' => '_deinstall'), $this);?>
</a>
					<br />
				</div>
			<?php endif; ?>

			<div class="updateMenuContainer"></div>
		</div>

	</div>
</li>

<script type="text/javascript">
	$('<?php echo $this->_tpl_vars['module']['path']; ?>
').repo = { repo: <?php echo smarty_function_json(array('array' => $this->_tpl_vars['module']['repo']['repo']), $this);?>
, handshake: <?php echo smarty_function_json(array('array' => $this->_tpl_vars['module']['repo']['handshake']), $this);?>
 };
	$('<?php echo $this->_tpl_vars['module']['path']; ?>
').version = <?php echo smarty_function_json(array('array' => $this->_tpl_vars['module']['Module']['version']), $this);?>
;
</script>