{includeJs file="library/ActiveList.js"}
{includeCss file="library/ActiveList.css"}

{includeJs file="/module/eye-exam/javascript/backend/EyeExamSchedule.js"}
{includeCss file="/module/eye-exam/stylesheet/backend/EyeExamSchedule.css"}

{includeJs file="library/form/ActiveForm.js"}
{includeJs file="library/form/State.js"}
{includeJs file="library/form/Validator.js"}
{includeJs file="library/dhtmlCalendar/calendar.js"}
{includeJs file="library/dhtmlCalendar/lang/calendar-en.js"}
{includeJs file="library/dhtmlCalendar/lang/calendar-`$curLanguageCode`.js"}
{includeJs file="library/dhtmlCalendar/calendar-setup.js"}
{includeCss file="library/dhtmlCalendar/calendar-win2k-cold-2.css"}

{pageTitle help="content.site"}{t _site_eye_exam}{/pageTitle}

{include file="layout/backend/header.tpl"}

{allowed role="news.create"}

    <ul class="menu" id="eyeExamMenu">
        <li class="addEyeExamSchedule"><a href="#add" id="addEyeExamScheduleLink">{t _add_eye_exam}</a></li>
        <li class="addEyeExamSchedule"><a href="{link controller=backend.customField}#cat_8#tabFields__" id="addEyeExamScheduleLink">{t _customize_booking_form}</a></li>
        <li class="addEyeExamScheduleCancel done" style="display: none;"><a href="#cancel" id="addEyeExamScheduleCancelLink">{t _cancel_adding_eye_exam}</a></li>
        <li class="order_printSchedule">
            <form id="printForm" method="GET" action="{link controller=backend.eyeExamSchedule action=printSchedule}" class="enabled" target="_blank">
                <a href="#printSchedule)" onclick="$('printForm').submit(); return false;">{t _print_schedule}</a>
                {calendar id="printScheduleDate" name="date" value=$curDate noform=true}
            </form>
        </li>
    </ul>

{/allowed}

<fieldset id="addEyeExamSchedule" class="slideForm addForm" style="display: none;">

    <legend>{t _add_eye_exam|capitalize}</legend>

    {form action="controller=backend.eyeExamSchedule action=add" method="POST" onsubmit="new Backend.EyeExamSchedule.Add(this); return false;" handle=$form id="eyeExamForm" class="enabled"}
    <input type="hidden" name="id" />

    <div class="eavField ">
        <p>
            {err for="examDate"}
                <label>{tip _date_and_time _hint_date_and_time}</label>
            {calendar name="date" id="examDate"}
                <select id="request_time" name="time">
                    <option value="08:00:00">08:00</option>
                    <option value="08:30:00">08:30</option>
                    <option value="09:00:00">09:00</option>
                    <option value="09:30:00">09:30</option>
                    <option value="10:00:00">10:00</option>
                    <option value="10:30:00">10:30</option>
                    <option value="11:00:00">11:00</option>
                    <option value="11:30:00">11:30</option>
                    <option value="12:00:00">12:00</option>
                    <option value="12:30:00">12:30</option>
                    <option value="13:00:00">13:00</option>
                    <option value="13:30:00">13:30</option>
                    <option value="14:00:00">14:00</option>
                    <option value="14:30:00">14:30</option>
                    <option value="15:00:00">15:00</option>
                    <option value="15:30:00">15:30</option>
                    <option value="16:00:00">16:00</option>
                    <option value="16:30:00">16:30</option>
                    <option value="17:00:00">17:00</option>
                    <option value="17:30:00">17:30</option>
                    <option value="18:00:00">18:00</option>
                    <option value="18:30:00">18:30</option>
                    <option value="19:00:00">19:00</option>
                    <option value="19:30:00">19:30</option>
                    <option value="20:00:00">20:00</option>
                    <option value="20:30:00">20:30</option>
                </select>
            {/err}
        </p>
        <p>
            {err for="doctorName"}
                <label>{tip _doctor_name _hint_doctor_name}:</label>
            {textfield class="text"}
            {/err}
        </p>
        <p>
            <label>{tip _is_visible _hint_is_visible}:</label>
            <select id="visible" name="isVisible">
                <option value="1">{t _yes}</option>
                <option value="0">{t _no}</option>
            </select>
        </p>
        <p>
            {err for="comment"}
                <label class="wide">{tip _comment _hint_comment}:</label>
            {textarea class="tinyMCE"}
            {/err}
        </p>
        <fieldset class="controls" {denied role="news"}style="display: none;"{/denied}>
            <span class="progressIndicator" style="display: none;"></span>
            <input type="submit" class="submit save" value="{tn _save}" />
            <input type="submit" class="submit add" value="{tn _add}" />
            {t _or} <a class="cancel" href="#" onclick="Backend.EyeExamSchedule.prototype.hideAddForm(); return false;">{t _cancel}</a>
        </fieldset>
        {/form}

</fieldset>

<ul id="eyeExamList" class="activeList {allowed role="news.delete"}activeList_add_delete{/allowed} {allowed role="news.update"}activeList_add_edit{/allowed}">
</ul>

<div style="display: none">
    <span id="deleteUrl">{link controller=backend.eyeExamSchedule action=delete}?id=</span>
    <span id="confirmDelete">{t _del_conf}</span>
    <span id="sortUrl">{link controller=backend.eyeExamSchedule action=saveOrder}</span>
    <span id="statusUrl">{link controller=backend.eyeExamSchedule action=setEnabled}</span>
    <span id="saveUrl">{link controller=backend.eyeExamSchedule action=save}</span>
</div>

<ul style="display: none;">
    <li id="eyeExamList_template" style="position: relative;">
        <div>
            <div class="eyeExamListContainer">

			<span class="eyeExamCheckBox"{denied role="news.status"} style="display: none;"{/denied}>
				<span class="progressIndicator" style="float: left; padding: 0; display: none;"></span>
			</span>

                <span class="progressIndicator" style="display: none; "></span>

			<span class="eyeExamData">
				<span class="eyeExamDoctorName"></span>
				<span class="eyeExamDate"></span>
				<br class="clear" />
				<span class="eyeExamComment"></span>
                <span class="eyeExamIsVisible" style="display:none;"></span>
                <span class="eyeExamTime" style="display:none;"></span>
                <span class="eyeExamEyeExamRequestID" style="display:none;"></span>
                <span class="eyeExamEyeExamRequest"></span>
			</span>

            </div>

            <div class="formContainer activeList_editContainer" style="display: none;"></div>

        </div>
        <div class="clear"></div>
    </li>
</ul>

<script type="text/javascript">
    Form.State.backup($("eyeExamForm"));
    new Backend.EyeExamSchedule({json array=$eyeExamList}, $('eyeExamList'), $('eyeExamList_template'));
</script>

{include file="layout/backend/footer.tpl"}