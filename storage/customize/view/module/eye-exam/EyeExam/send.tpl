{pageTitle}{t _form_sent}{/pageTitle}

{loadJs form=true}
{include file="layout/frontend/layout.tpl"}

<div id="content">

<h1>{t _form_sent}</h1>

<p>{t _form_thankyou}</p>

<p>Eye Exam Info:</p>
<strong>Date: {$date}</strong><br>
<strong>Time: {$time|substr:0:5}</strong>

<div>
<strong>Our Address</strong><br>
Illuminata Eyewear<br>
1750 The Queensway, Unit 4<br>
Etobicoke, ON<br>
M9C 5H5<br><br>

tel. 416-620-8028<br>
e-mail: sales@illuminataeyewear.com<br><br>

<p>
Please come on time! If you are paying by OHIP, please bring your OHIP card and come 10 minutes in advance of your booking.<br>
If your plans change, please be mindfull, and call us. The booking time is reserved for you and no one will be put into this time slot.
</p>
</div>
</div>

{include file="layout/frontend/footer.tpl"}