{pageTitle}{t _order_invoice}{/pageTitle}
{pageTitle}{t _invoice} {$order.invoiceNumber}{/pageTitle}
<div class="userOrderInvoice">

    <div id="content" class="left right">

        <div id="invoice">

            <div id="invoiceHeader">
                <h1>{t _eye_exam_schedule_title}</h1>
                <div id="invoiceDate">{$order.formatted_dateCompleted.date_long}</div>
            </div>

            <div class="clear"></div>

            {foreach $schedule as $row}
                {if isset($row.eyeExamRequestID)}
                    <div style="width:97%;line-height:normal;border: 1px dotted grey;margin: 10px;float: left;position: static;">&nbsp;
                        <div class="addressContainer" style="margin: 0px 10px 10px;">
                            <p>
                                <label class="attrName">Doctor Name:</label>
                                <label class="attrValue">{$row.doctorName}</label>
                            </p>
                            <p>
                                <label class="attrName">Date: </label>
                                <label class="attrValue">{$row.formatted_date.date_long} {$row.time|substr:0:5}</label>
                            </p>

                            {foreach from=$row.EyeExamRequest.specialFields key=field item=value}
                                <p>
                                    <label class="attrName">{$field}:</label>
                                    <label class="attrValue">{$value}</label>
                                </p>
                            {/foreach}

                        </div>
                    </div>
                {/if}
            {/foreach}


        </div>
    </div>

</div>

{* include file="layout/frontend/footer.tpl" *}

</div>

<script type="text/javascript">
    {*	window.print(); *}
</script>