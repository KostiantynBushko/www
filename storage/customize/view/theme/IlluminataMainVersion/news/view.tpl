{pageTitle}{$news.title_lang}{/pageTitle}
{assign var="metaDescription" value=$category.description_lang}
{assign var="metaKeywords" value=$category.keywords_lang}

<div class="categoryIndex category_{$category.ID}">

{include file="layout/frontend/layout.tpl"}

<div id="content">
	<h1>{$news.title_lang}</h1>
	<div class="newsDate">{$news.formatted_time.date_long}</div>

	<div class="newsEntry">
		<p>{$news.text_lang}</p>

		{if $news.moreText_lang}
			<p>{$news.moreText_lang}</p>
		{/if}
	</div>

</div>
{include file="layout/frontend/footer.tpl"}

</div>

{literal}
		<!-- AddThis Smart Layers BEGIN -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize -->

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5277150f0ea19ad7"></script>


<script type="text/javascript">
  addthis.layers({
    'theme' : 'transparent',
    'share' : {
      'position' : 'left',
      'numPreferredServices' : 5
    }, 
    'follow' : {
      'services' : [
        {'service': 'twitter', 'id': 'trendeyewear'}
      ]
    }   
  });
</script>

<!-- AddThis Smart Layers END -->

		
		{/literal}