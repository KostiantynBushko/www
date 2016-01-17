<select name="field[]">
	{foreach from=$fields key=class item=classFields}
		<optgroup label="{translate text=$class}">
		{foreach from=$classFields key=key item=field}
			<option value="{$key}">{$field.descr|default:$field.field}</option>
		{/foreach}
		</optgroup>
	{/foreach}
</select>
