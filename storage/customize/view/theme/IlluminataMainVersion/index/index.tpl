{pageTitle}{'STORE_HEADLINE'|config}{/pageTitle}
{assign var="metaDescription" value='INDEX_META_DESCRIPTION'|config}
{assign var="metaKeywords" value='INDEX_META_KEYWORDS'|config}

<script src="upload/theme/IlluminataMainVersion/jquery.min.js"></script>
<script src="upload/theme/IlluminataMainVersion/jquery.bxslider.js"></script>
<div class="index">

{include file="layout/frontend/layout.tpl"}


<div id="content">
	<!--<div class="welcome">
	<h3>Welcome to illuminata eyewear<h3/>
	<p>illuminata eyewear stands for a bright vision, fashionable image and a royal service.</p>
	<p>We specialize at carrying high end brands and limited edition products. Ever since we opened our door in 1998,
	we have worked hard to develop a reputation of personable service approach. We beleive we have a product for every taste and budget.</p>
	</div>-->
	

	
	<!--div class="mirror">
	<div style="float: right; width:250px;">
	<h3>Try On Eyeglasses With Virtual Mirror</h3>
	<p>Bored at home? Checked out virtual mirror to find your most perfect pair of eyeglasses</p>
	</div>
	</div-->
	<!--{block HOME-PAGE-TOP}

	{if 'HOME_PAGE_SUBCATS'|config}
		{include file="category/subcategoriesColumns.tpl"}
	{/if}-->

	{if $news}
		<h3>{t _latest_news}</h3>
		<ul class="news">
		{foreach from=$news item=newsItem name="news"}
			{if !$smarty.foreach.news.last || !$isNewsArchive}
				<li class="newsEntry">
					{include file="news/newsEntry.tpl" entry=$newsItem}
				</li>
			{else}
				<div class="newsArchive">
					<a href="{link controller=news}">{t _news_archive}</a>
				</div>
			{/if}
		{/foreach}
		</ul>
	{/if}

	{if $subCatFeatured}
		<h3>{t _featured_products}</h3>
		{include file="category/productListLayout.tpl" layout='FEATURED_LAYOUT'|config|default:$layout products=$subCatFeatured}
	{/if}

	{include file="category/categoryProductList.tpl"}
<script src="upload/theme/IlluminataMainVersion/bx.js"></script>
</div>

{include file="layout/frontend/footer.tpl"}

</div>