<div id="searchContainer" style="padding-left: 170px;">
	<div class="wrapper">
		{capture assign="searchUrl"}{categoryUrl data=$category}{/capture}
		{form action="controller=category" class="quickSearch" handle=$form}
			{if 'HIDE_SEARCH_CATS'|config}
				{hidden name="id" value="1"}
			{else}
				{selectfield name="id" options=$categories}
			{/if}
{textfield class="text searchQuery" name="q" value="   Search..." style="border: none; position: relative; left:-20px;"}
<input type="submit" class="submit" style="position: relative; right: 50px; border: none; background-image: url('upload/theme/IlluminataNew/searchicon.jpg'); background-position: right; background-repeat: no repeat; background-color: white; color: gray;" value="|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" />
			<input type="hidden" name="cathandle" value="search" />
		{/form}
		
		{block CURRENCY}
		{block LANGUAGE}

		<div class="clear"></div>
	</div>
</div>