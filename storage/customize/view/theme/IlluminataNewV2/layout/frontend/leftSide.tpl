<div id="leftSide">
	<div id="contentWrapperLeft"></div>

	{block LEFT_SIDE}

	{if 'CATEGORY_MENU_TYPE'|config == 'CAT_MENU_FLYOUT'}
		{block DYNAMIC_CATEGORIES}
	{elseif 'CATEGORY_MENU_TYPE'|config == 'CAT_MENU_STANDARD'}
		{block CATEGORY_BOX}
	{/if}
	{block INFORMATION}
	{block COMPARE}
	{block FILTER_BOX}

	{block NEWSLETTER}
	{block QUICKNAV}

	<div class="clear"></div>
</div>