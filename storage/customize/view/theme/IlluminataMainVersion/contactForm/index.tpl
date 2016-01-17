{pageTitle}{t _contact_us}{/pageTitle}

{loadJs form=true}
{include file="layout/frontend/layout.tpl"}

<div id="content">

<h1>{t _contact_us}</h1>
<div>
Illuminata Eyewear <br>
1750 The Queensway Unit #4<br>
Etobicoke, ON<br>
M9C 5H5<br>
<br>
Tel. 416-620-8028<br>
E-mail: sales@illuminataeyewear.com
<br><br>
</div>

{form action="controller=contactForm action=send" method="POST" id="contactForm" handle=$form style="float: left;"}
	<p>
		{err for="name"}
			{{label {t _your_name}:}}
			{textfield class="text"}
		{/err}
	</p>

	{* anti-spam *}
	<div style="display: none;">
		{err for="surname"}
			{{label Your surname:}}
			{textfield class="text"}
		{/err}
	</div>

	<p>
		{err for="email"}
			{{label {t _your_email}:}}
			{textfield class="text"}
		{/err}
	</p>

	<p>
		{err for="msg"}
			{{label {t _your_message}:}}
			{textarea}
		{/err}
	</p>

	{block FORM-SUBMIT-CONTACT}

	<p>
		<input type="submit" class="submit" value="{t _form_submit}" />
	</p>

{/form}

</div>

{include file="layout/frontend/footer.tpl"}