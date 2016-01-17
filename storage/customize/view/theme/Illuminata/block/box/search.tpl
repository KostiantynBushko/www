<div id="searchContainer">
	<div class="wrapper">
		{capture assign="searchUrl"}{categoryUrl data=$category}{/capture}
		{form action="controller=category" class="quickSearch" handle=$form}
			{if 'HIDE_SEARCH_CATS'|config}
				{hidden name="id" value="1"}
			{else}
				{selectfield name="id" options=$categories}
			{/if}
			{textfield class="text searchQuery" name="q"}
			<input type="submit" class="submit" value="{tn _search}" />
			<input type="hidden" name="cathandle" value="search" />
		{/form}

		{block CURRENCY}
		{block LANGUAGE}

<a href="/about_us.html">About Us</a>
<a href="/find_a_store.html">Locations</a>
<a href="/open_up_a_retail_account.html">Open Retail Account</a>
		<div class="clear"></div>
	</div>
</div>