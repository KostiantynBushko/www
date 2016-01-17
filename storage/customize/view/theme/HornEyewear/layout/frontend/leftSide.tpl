<div id="leftSide">
	<div id="contentWrapperLeft"></div>

	{block LEFT_SIDE}

	{if 'CATEGORY_MENU_TYPE'|config == 'CAT_MENU_FLYOUT'}
		{block DYNAMIC_CATEGORIES}
	{elseif 'CATEGORY_MENU_TYPE'|config == 'CAT_MENU_STANDARD'}
		{block CATEGORY_BOX}
	{/if}

<a href="/about_us.html">About Us</a>
<a href="/horn_eyeglasses_material.html">Genuine Horn</a>
<a href="/history_and_tradition.html">History and Tradition</a>
<a href="/shipping_rates.html">Shipping Rates</a>
<a href="/find_a_store.html">Find a Store</a>
<a href="/open_up_a_retail_account.html">Open a Retail Account</a>
	{block COMPARE}
	{*block FILTER_BOX*}
	{*block INFORMATION*}
	{block NEWSLETTER}
	{*block QUICKNAV*}

	<div class="clear"></div>
</div>