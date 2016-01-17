{include file="backend/eav/includes.tpl"}
{assign var=containerId value=$blah|rand:1000000}

{pageTitle}{$page.title_lang}{/pageTitle}
{assign var="metaDescription" value=$page.metaDescription_lang|@strip_tags}

<div class="staticPageView}">

    {include file="layout/frontend/layout.tpl"}

    <div id="content">
        <h1>{t _title_lang}</h1>
<div>
Ontario Ministry of Health advises it’s residents to check eyes every two years. We make it easy at Illuminata Eyewear. Simply pick the available date and time and make your booking.
Cost of eye exam is only $65. There is no tax as it’s a healthcare service.<br>
If you are under 18 or over 65 your eye exam is covered by OHIP every two years. Not sure if you are covered? Simply bring your OHIP card for an appointment and we will check via OHIP automated system.<br>
When you arrive, please budget for 30 minutes for an eye exam and required paperwork. Parking is available right in front of our building.<br>

</div>

        <div class="staticPageText">
            {t _text_lang}
        </div>
        <br />
        {form action="controller=EyeExam action=send" method="POST" id="EyeExam" handle=$form style="float: left;"}

            {include file="block/eav/fields.tpl" fieldList=$specFieldList}

            {* anti-spam *}
            <div style="display: none;">
                {err for="surname"}
                {{label Your surname:}}
                {textfield class="text"}
                {/err}
            </div>
            <div class="eavField ">
                <p>
                    {if $schedule|@count == 0}
                <div id="noActiveTimeMessage">{t _no_working_hours}</div>
                {else}
                <fieldset class="error">
                    {foreach from=$schedule key=date_formatted item=date}
                    <h4>{$date_formatted}<h4>
                            {foreach $date as $doctor}
                                {if $doctor.isVisible == "1"}
                                    <h4>{$doctor.doctorName}</h4>
                                {/if}
                                {foreach from=$doctor.times key=time item=id}
                                    {radio name="time"  value=$id class="radio" style=$requestTimeStyle} {$time|substr:0:5} <br/>
                                {/foreach}
                            {/foreach}
                            <br />
                            {/foreach}
                            <div style="display: none;" class="errorText hidden"></div>
                </fieldset>
                {/if}
                </p>
            </div>

        {block FORM-SUBMIT-CONTACT}

            <p>
                <label></label>
                <input type="submit" class="submit" value="{t _form_submit}" />
            </p>

        {/form}
    </div>
    <script type="text/javascript">

    </script>
    {include file="layout/frontend/footer.tpl"}
</div>