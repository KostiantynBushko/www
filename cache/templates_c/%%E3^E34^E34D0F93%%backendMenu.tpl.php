<?php /* Smarty version 2.6.26, created on 2015-12-01 10:53:47
         compiled from block/backend/backendMenu.tpl */ ?>
<div id="menuDescription" style="display: none;"></div>

<ul style="display: none;">
	<li id="navTopItem-template">
		<div>
			<div>
				<div>
					<a href=""></a>
					<ul>
					</ul>
				</div>
			</div>
		</div>
	</li>
	<li id="navSubItem-template">
		<a href=""></a>
	</li>
</ul>

<script type="text/javascript">
	window.menuArray = <?php echo $this->_tpl_vars['menuArray']; ?>
;
	new Backend.NavMenu(window.menuArray, '<?php echo $this->_tpl_vars['controller']; ?>
', '<?php echo $this->_tpl_vars['action']; ?>
');
</script>


