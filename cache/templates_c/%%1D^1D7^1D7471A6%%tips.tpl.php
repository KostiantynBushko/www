<?php /* Smarty version 2.6.26, created on 2015-12-01 10:53:47
         compiled from custom:backend/index/tips.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'custom:backend/index/tips.tpl', 2, false),array('function', 'link', 'custom:backend/index/tips.tpl', 13, false),)), $this); ?>
<fieldset class="tips">
	<legend><?php echo smarty_function_translate(array('text' => '_whats_next'), $this);?>
</legend>

	<div class="gettingStarted">
		<p>
			The backend area provides a full control over your store - managing it's content, configuring, customizing, etc.
		</p>

		<div class="column">
			<h2>Getting Started</h2>

			<p>
				Begin with <a href="<?php echo smarty_function_link(array('controller' => "backend.category"), $this);?>
">creating categories</a> for your products. When some categories are ready, you can <a href="<?php echo smarty_function_link(array('controller' => "backend.category"), $this);?>
">add products</a> into them. Of course, you can move the products around at any time.
			</p>

			<p>
				Already have the product information in an Excel table? LiveCart can <a href="<?php echo smarty_function_link(array('controller' => "backend.csvImport"), $this);?>
">import</a> them all at once via .csv files (easily saved from Excel or OpenOffice).
			</p>

			<p>
				Tweak hundreds of <a href="<?php echo smarty_function_link(array('controller' => "backend.settings"), $this);?>
">configuration settings</a>.
			</p>

			<h2>Selling Products</h2>

			<p>
				Are your products shippable (physical products) or downloadable (digital products)? If there are any shippable products, it will be necessary to create some <strong>shipping options</strong>, which can be done in two ways:
				<ul>
					<li><a href="<?php echo smarty_function_link(array('controller' => "backend.settings"), $this);?>
#section_06-shipping__">Real-time shipping</a> - rates are automatically fetched from carrier using the calculated shipment weight</li>
					<li><a href="<?php echo smarty_function_link(array('controller' => "backend.deliveryZone"), $this);?>
">Manual shipping rates</a> - create address-based delivery zones and enter shipping rates manually</li>
				</ul>
			</p>

			<div style="margin: 0.5em 0;">
			<p>
				If the store prices have to include <strong>taxes</strong>, there are two steps to take:
				<ol>
					<li><a href="<?php echo smarty_function_link(array('controller' => "backend.tax"), $this);?>
">Define taxes</a> that will be used</li>
					<li><a href="<?php echo smarty_function_link(array('controller' => "backend.deliveryZone"), $this);?>
">Set tax rates</a> for each delivery location via tax zones</li>
				</ol>
			</p>
			</div>

			<p>
				An online store provides the great benefit of being able to <a href="<?php echo smarty_function_link(array('controller' => "backend.settings"), $this);?>
#section_05-payment__"><strong>accept payments online</strong></a>. LiveCart has several built-in and easily configurable options for received credit card or other online payments as well as offline payments (bank wire transfer, checks, etc.). To start accepting payments, <a href="<?php echo smarty_function_link(array('controller' => "backend.settings"), $this);?>
#section_05-payment__">select payment options</a> that your store will use.
			</p>
		</div>

		<div class="column">
			<h2>Configure For International Markets</h2>
			<p>
				Are you running an international store? Any information can be entered in <a href="<?php echo smarty_function_link(array('controller' => "backend.language"), $this);?>
">multiple languages</a> and products can be priced in <a href="<?php echo smarty_function_link(array('controller' => "backend.staticPage"), $this);?>
">different currencies</a> (with automatic price conversion, if necessary).
			</p>

			<h2>Boost Your Sales</h2>
			<p>
				Create sales campaigns, discounts, coupons and much more using the powerful <a href="<?php echo smarty_function_link(array('controller' => "backend.discount"), $this);?>
">business rule system</a>.
			</p>

			<p>
				<a href="<?php echo smarty_function_link(array('controller' => "backend.newsletter"), $this);?>
">Send newsletter messages</a> to your customers and newsletter subscribers.
			</p>

			<p>
				Analyze sales results via <a href="<?php echo smarty_function_link(array('controller' => "backend.report"), $this);?>
">reports</a> and set up <a href="<?php echo smarty_function_link(array('controller' => "backend.settings"), $this);?>
#section_tracking.GoogleAnalytics__">Google Analytics</a> for additional reporting.
			</p>

			<p>
				<a href="<?php echo smarty_function_link(array('controller' => "backend.settings"), $this);?>
#section_08-sitemaps__">Syndicate</a> your product data to price comparison aggregators like Google Base and <a href="<?php echo smarty_function_link(array('controller' => "backend.settings"), $this);?>
#section_08-sitemaps__">send XML sitemaps</a> to search engines.
			</p>

			<h2>Managing Site Content</h2>
			<p>
				Publish <a href="<?php echo smarty_function_link(array('controller' => "backend.staticPage"), $this);?>
">custom content pages</a> as well as <a href="<?php echo smarty_function_link(array('controller' => "backend.siteNews"), $this);?>
">news posts</a> and upload custom media files.
			</p>
		</div>

		<div class="column last">
			<h2>Customizing Your Store</h2>
			<p>
				Customization can be done at various levels using different tools:
				<ul>
					<li><a href="<?php echo smarty_function_link(array('controller' => "backend.customize"), $this);?>
">Live Customization</a> - a set of WYSIWYG tools that allow editing page templates, modify CSS style definitions via Firebug and text captions in a point-and-click fashion</li>
					<li>Manage <a href="<?php echo smarty_function_link(array('controller' => "backend.theme"), $this);?>
">design themes</a> - modify colors, backgrounds, upload image files, etc</li>
					<li><a href="<?php echo smarty_function_link(array('controller' => "backend.settings"), $this);?>
#section_01-display__">Upload store logotype and select the theme</a> to use in your site</li>
					<li><a href="<?php echo smarty_function_link(array('controller' => "backend.template"), $this);?>
">Edit page templates</a> - browse and edit the template files</li>
					<li><a href="<?php echo smarty_function_link(array('controller' => "backend.template",'action' => 'email'), $this);?>
">Personalize e-mail messages</a></li>
				</ul>
			</p>

			<h2>Extending Store Functionality</h2>
			<p>
				LiveCart has a <a href="<?php echo smarty_function_link(array('controller' => "backend.module"), $this);?>
">module system</a> and several <a href="http://livecart.com/modules">ready-made modules</a>.
			</p>

			<h2>More Advanced Features</h2>
			<p>
				Exchange LiveCart data with 3rd party applications using the <a href="<?php echo smarty_function_link(array('controller' => "backend.settings"), $this);?>
#section_30-api__">XML API</a>.
			</p>
		</div>

	</div>

</fieldset>