<div style="padding: 3em; border: none;">
	
		<div class="labelCompany" style="font-size: 90%">
			Illuminata Eyewear<br>
			1750 The Queensway<br>
			Unit 4<br>
			Etobicoke, ON<br>
			M9C 5H5<br>
			Canada

		</div>
		<br><br>
	
<div style="font-size: 120%; font-weight: bold; margin-left: 250px;">
	To:<br>
	{if $address.fullName}
		<div class="labelName">
			{$address.fullName}
		</div>
	{/if}
<div>
{$address.companyName}
</div>
	<div class="labelAddress1">
		{$address.address1}
	</div>
	<div class="labelAddress2">
		{$address.address2}
	</div>

	<div class="labelCity">
		{$address.city}
	</div>

	<div class="labelState">
		{$address.stateName|default:$address.State.name}{if $address.postalCode}, {$address.postalCode}{/if}
	</div>

	<div class="labelCountry">
		{$address.countryName}
	</div>
	<div style="font-size: 150%; font-weight: bold; margin-top: 40px; margin-left: -50px;">
	DO NOT DROP AT DOOR
	</div>
</div>



</div>
