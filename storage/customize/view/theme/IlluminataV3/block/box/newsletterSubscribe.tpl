{loadJs form=true}
<div class="box newsletter" style="border-left: 1px solid #ebebeb; border-right: 1px solid #ebebeb;">
	<div class="title">
		<div>{t _subscribe_to_newsletter}</div>
	</div>

	<div class="content">

	<p style="font-family: 'Open Sans'; font-size: 12px;">{t _enter_your_email_to_subscribe}</p>

	{form handle=$form action="controller=newsletter action=subscribe" method="POST"}
		{{err for="email"}}
			{textfield class="text" }
			<input type="submit" class="submit" value="OK" style="position: relative; left: -4px; margin-bottom: 20px; padding-left: 5px; padding-right: 5px;" />
		{/err}

	{/form}

	</div>

	
</div>