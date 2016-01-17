{pageTitle}{'STORE_HEADLINE'|config}{/pageTitle}
{assign var="metaDescription" value='INDEX_META_DESCRIPTION'|config}
{assign var="metaKeywords" value='INDEX_META_KEYWORDS'|config}
<div class="index">
{include file="layout/frontend/layout.tpl"}
<div id="content">



<div class="slider">
			<ul class="slides">
				<li class="slide">
				<div style="background-image: url(upload/theme/Illuminata/IlluminataLarge.gif);">
<h1>Unique Optical Boutique</h1>
<em>Serving You Since 1996</em>
<a href="">Learn more</a>
</div>
</li><li class="slide">
				<div style="background-image: url(upload/theme/Illuminata/IlluminataLarge.gif);">
<h1>Widest Product Selection</h1>
<em>Eyeglasses from top brands</em>
<a href="">Learn more</a>
</div>
</li><li class="slide"> 
<div style="background-image: url(upload/theme/Illuminata/IlluminataLarge.gif);">
<h1>Focus on Your Style and Needs</h1>
<em>Hightly trained optician staff</em>
<a href="">Shop online or in store</a>
</div>
</li><li class="slide">
<div style="background-image: url(upload/theme/Illuminata/IlluminataLarge.gif);">
<h1>Eye Exams Arranged</h1>
<em>Vision is Light</em>
<a href="">Book an eye exam</a>
</div></li>	
			</ul>
		</div>
		{literal}
		<script type="text/javascript">
		jQuery( document ).ready(function() {
		var glide = jQuery('.slider').glide().data('api_glide');

				$(window).on('keyup', function (key) {
					if (key.keyCode === 13) {
						glide.jump(3, console.log('Wooo!'));
					};
				});

				jQuery('.slider-arrow').on('click', function() {
					console.log(glide.current());
				});
				});
		</script>
{/literal}


<div id="intro">
    <ul>
      <li>
        <h2>About Illuminata</h2>
        <div class="imgholder"><a href="#"><img src="upload/theme/Illuminata/IlluminataGlasses1.gif" alt="" /></a></div>
        <p>Illuminata Eyewear stands for a bright vision, fashionable image and a royal service. We specialize at carrying high end brands and limited edition products.
		</p>
        <p>Ever since we opened a door in 1996, we have worked hard to develop a reputation of personable service approach. We beleive we have a product for every taste and budget.</p><br>
        <p class="readmore"><a href="findus.html">Continue Reading &raquo;</a></p>
      </li>
      <li>
        <h2>Our Products</h2>
        <div class="imgholder"><a href="#"><img src="upload/theme/Illuminata/IlluminataGlasses2.gif" alt="" /></a></div>
        <p>We hand pick every pair of glasses and sunglasses from each brand line we carry. We select the most beautiful, interesting and high quality glasses.
        </p>
        <p>We belive that lenses are as important as frames, therefore offer only the best quality lenses by world leading lens manufacturers. We will update you on newest technology innovations to fit your vision needs.
        </p>
        <p class="readmore"><a href="products.html">Continue Reading &raquo;</a></p>
      </li>
      <li class="last">
        <h2>Our Service</h2>
        <div class="imgholder"><a href="#"><img src="upload/theme/Illuminata/IlluminataGlasses3.gif" alt="" /></a></div>
        <p>Our licensed optitians will ensure you get your lenses custom made for your prescription and facial dimentions. We guarantee results and work closely with lens manufacturers on every single order. 
        </p>
        <p>Eye exams are performed at our location for your convenience. We beat everyone's prices and service. Once you make a purchase from our store, we will service it for ever.
		</p>
        <p class="readmore"><a href="promotions.html">Continue Reading</a></p>
      </li>
    </ul>
  </div>



	{block HOME-PAGE-TOP}

	{*if 'HOME_PAGE_SUBCATS'|config}
		{include file="category/subcategoriesColumns.tpl"}
	{/if*}

	{if $news}
		<h2>{t _latest_news}</h2>
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

	{*if $subCatFeatured}
		<h2>Shop Our Collection</h2>
		{include file="category/productListLayout.tpl" layout='FEATURED_LAYOUT'|config|default:$layout products=$subCatFeatured}
	{/if*}

	{*include file="category/categoryProductList.tpl"*}

</div>

{include file="layout/frontend/footer.tpl"}

</div>