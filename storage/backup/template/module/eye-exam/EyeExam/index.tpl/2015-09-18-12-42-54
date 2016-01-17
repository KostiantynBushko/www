{include file="backend/eav/includes.tpl"}
{assign var=containerId value=$blah|rand:1000000}

{pageTitle}{$page.title_lang}{/pageTitle}
{assign var="metaDescription" value=$page.metaDescription_lang|@strip_tags}

<div class="staticPageView}">

    {include file="layout/frontend/layout.tpl"}

    <div id="content">
        <h1>{t _title_lang}</h1>

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
                <label class="empty"></label>
                <input type="submit" class="submit" value="{t _form_submit}" />
            </p>

        {/form}
    </div>
    <script type="text/javascript">

    </script>
    {include file="layout/frontend/footer.tpl"}
</div>