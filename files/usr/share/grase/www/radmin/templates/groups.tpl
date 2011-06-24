{include file="header.tpl" Name="Groups" activepage="groups"}

<h2>{t}Group Config{/t}</h2>
<p>{t escape=no}Group expiry needs to be in a format understood by the <a target="_blank" href="http://www.php.net/manual/en/function.strtotime.php">strtotime</a> PHP function.{/t}<br/>{t}For example, "+1 month" will set an expiry for 1 month from when the account is created. "+2 weeks", "+3 days" etc.{/t}</p>

<p>{t}Deleting a group won't delete it's users. Next time the user is edited it's group will become the default group unless a new group is selected.{/t}</p>

<p>{t}The limits here are the default for group members, unless overridden when creating a member. If multiple limits are specified, the first limit to be reached will disconnect the user.{/t}</p>
<div id="GroupConfigForm">
<form method="post" action="?" class="generalForm">




    <div>
        <h3>{t}Groups{/t}</h3>
        
    {foreach from=$groups item=expiry key=groupname}        
        <div class="jsmultioption">
            <label>{t}Name{/t}</label><input type="text" name="groupname[]" value='{$groupname}'/>
            <label>{t}Expiry{/t}</label><input type="text" name="groupexpiry[]" value='{$expiry}'/>
            
            <label>{t}Default Data Limit (MiB){/t}</label>
            {html_options name="Group_Max_Mb[]" options=$Datacosts selected=$groupdata.$groupname.MaxMb}
            
            <label>{t}Default Time Limit (Minutes){/t}</label>
            {html_options name="Group_Max_Time[]" options=$Timecosts selected=$groupdata.$groupname.MaxTime}
            
            {* <label>{t}Recurring Data Limit (MiB){/t}</label>
            {html_options name="Recur_Data_Limit[]" options=$Datavals selected=$groupdata.$groupname.DataRecurLimit}{t}per{/t}
            {html_options name="Recur_Data[]" options=$Recurtimes selected=$groupdata.$groupname.DataRecurTime} *}
            
            <label>{t}Recurring Time Limit (Minutes){/t}</label>
            {html_options name="Recur_Time_Limit[]" options=$Timevals selected=$groupdata.$groupname.TimeRecurLimit}{t}per{/t}
            {html_options name="Recur_Time[]" options=$Recurtimes selected=$groupdata.$groupname.TimeRecurTime}
            
            
            <div class="jsremove ui-widget-content">
                <span class="jsremovebutton"></span>
                <span class="jsaddremovetext">{t}Delete Group{/t}</span>
            </div>
            <hr/>            
        </div>

    {/foreach}
        <div class="jsmultioption">
            <label>{t}Name{/t}</label><input type="text" name="groupname[]" value=''/>
            <label>{t}Expiry{/t}</label><input type="text" name="groupexpiry[]" value=''/>
            <label>{t}Default Data Limit (MiB){/t}</label>
            {html_options name="Group_Max_Mb[]" options=$Datacosts selected=$user.Max_Mb}
            <label>{t}Default Time Limit (Minutes){/t}</label>
            {html_options name="Group_Max_Time[]" options=$Timecosts selected=$user.Max_Time}

            {* <label>{t}Recurring Data Limit (MiB){/t}</label>
            {html_options name="Recur_Data_Limit[]" options=$Datavals}{t}per{/t}
            {html_options name="Recur_Data[]" values=$Recurtimes output=$Recurtimes}            
            *}
            <label>{t}Recurring Time Limit (Minutes){/t}</label>
            {html_options name="Recur_Time_Limit[]" options=$Timevals }{t}per{/t}
            {html_options name="Recur_Time[]" options=$Recurtimes}
            
            
            <div class="jsadd  ui-widget-content">
                <span class="jsaddbutton"></span>
                <span class="jsaddremovetext" id="addtext">{t}Add Another Group{/t}</span>
            </div>
            <hr/>
        </div>
        <span id="groupsInfo"></span>

    </div>

    <button type="submit" name="submit">{t}Save Settings{/t}</button>
    <div id="jsdeletetext" title="{t}Delete Group{/t}"></div> 

</form>

</div>

{include file="footer.tpl"}
