{pageTitle}{'STORE_HEADLINE'|config}{/pageTitle}
{assign var="metaDescription" value='INDEX_META_DESCRIPTION'|config}
{assign var="metaKeywords" value='INDEX_META_KEYWORDS'|config}

<script src="upload/theme/IlluminataV3Lenses/jquery.min.js"></script>
<script src="upload/theme/IlluminataV3Lenses/jquery.bxslider.js"></script>
<div class="index">

{include file="layout/frontend/layout.tpl"}
<div class="row">
<div class="promo"><ul class="bxslider">
  <li><img src="upload/theme/IlluminataV3Lenses/banner1.JPG"/></li>
  <li><img src="upload/theme/IlluminataV3Lenses/banner2.JPG" /></li>
  <li><img src="upload/theme/IlluminataV3Lenses/banner3.JPG" /></li>
        </ul></div></div>
        
            <div class="row icons promo">
                <div class="col-xs-3 icon"><center><img src="upload/theme/IlluminataV3Lenses/icon1.png"><h3>OUR PRODUCTS</h3><p>We hand pick every pair of glasses and sunglasses from each brand line we carry. We select the most beautiful, interesting and high quality glasses.</p><a href="/ourProducts.html" class="hvr-sweep-to-left">Read more</a></center><br></div>
                <div class="col-xs-3 icon"><center><img src="upload/theme/IlluminataV3Lenses/icon2.png"><h3>OUR SERVICE</h3><p>Buy eyeglasses and lenses online. Visit us to try them on and get fitted before installing lenses the same day. You can change to a different frame before lenses are installed.</p><a href="/ourService.html" class="hvr-sweep-to-left">Read more</a></center><br></div>
                <div class="col-xs-3 icon"><center><img src="upload/theme/IlluminataV3Lenses/icon3.png"><h3>EYE EXAMS</h3><p>Book an Eye Exam and choose a new pair of eyeglasses on the same day! Our doctor will perform an eye exam and our optician will help you to pick a frame.</p><a href="/eyeexam.html" class="hvr-sweep-to-left">Read more</a></center><br></div>
                <div class="col-xs-3 icon"><center><img src="upload/theme/IlluminataV3Lenses/icon4.png"><h3>SHOP ONLINE</h3><p>Huge catalog of eyeglasses and sunglasses of over 40 world best brand names. Pick up your purchase from our store or get it shipped to your home.</p><a href="/shopOnline.html" class="hvr-sweep-to-left">Read more</a></center><br></div>
            </div>
<div id="content" style="margin-top: 420px;">
	<!--<div class="welcome">
	<h3>Welcome to illuminata eyewear<h3/>
	<p>illuminata eyewear stands for a bright vision, fashionable image and a royal service.</p>
	<p>We specialize at carrying high end brands and limited edition products. Ever since we opened our door in 1998,
	we have worked hard to develop a reputation of personable service approach. We beleive we have a product for every taste and budget.</p>
	</div>-->
	
	<div class="promoCoupon">
	<img src="upload/theme/IlluminataV3Lenses/couponBack.PNG" style="float: right; margin-right:30px;"/>
	<h3>Get 20% OFF on all purchases</h3>
	<p>Use Coupon Code: Summer2015</p>
	
	</div>
	
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
<script src="upload/theme/IlluminataV3Lenses/bx.js"></script>
</div>

{include file="layout/frontend/footer.tpl"}

</div>