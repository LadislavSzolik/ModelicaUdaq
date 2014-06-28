<script type="text/javascript">//<![CDATA[{literal}
	function deleteWarn(del){
		var response = confirm('{/literal}{$text113}{literal}');
		if(response){
			window.location = "index.php?page=8&delete="+del;
		}else {
			//window.location = "index.php?page=8";
		}
	}
	$(document).ready(function(){
		$('.reportClass').hide();
		$('.reportClass').slideDown('swing');
	});
//]]></script>{/literal}

<fieldset>
<legend>{$text139}</legend>
	<br />
<div class="reportClass">
<table align="center" style="width:100%;border-color:white" cellpadding="3" cellspacing="0" border="1">	
	<tr align="center" style="color:white; background-color:#151B8D;">
			<td style="width:30px;"><b>ID</b></td>
		{if $user->permission < 2}
			<td><b>{$text36}</b></td>
		{/if}
			<td><b>{$text12}</b></td>
			<td><b>{$text86}</b></td>
			<td><b>{$text80}</b></td>
			<td colspan="2"><b>{$text82}</b></td>
	</tr>
	{if $reportArr }
		{foreach from=$reportArr item=report key=i}
			{if $i%2}
				{assign var='style' value='background-color:white;color:black'}
			{else}
				{assign var='style' value='background-color:#b8c1ff;color:black'}
			{/if}
			<tr align="center" style="{$style}" ><td>{$report->id}</td>
			{if $user->permission < 2}
				<td>{$report->login}</td>
			{/if}
				<td>
					{if $report->controllerId eq '-2'}
						-
					{else}
						{$report->controllerId}
					{/if}
				</td>
				<td>
				{if $report->controller->name eq '-1'}
					{$text85}
				{elseif $report->controller->name eq '-2'}
					{$text121}
				{else}
					{$report->controller->name}
				{/if}
				</td>
				<td>{$report->startTime}</td>
				<td>
					<a href="index.php?page=9&amp;id={$report->id}">
						<img src="pic/zoomIcon.png"  alt="load" style="vertical-align:middle;padding-right:5px;" />
					</a>
				</td>
			{if $user && $user->permission < 2}
				<td>
	 				<a href="#"> 
						<img onclick="deleteWarn({$report->id})" src="pic/remove.png" width="22" alt="load" />
 					</a> 
				</td>
			{/if}
			</tr>
		{/foreach}
	{else}
		<tr><td colspan="4">{$text89}</td></tr>
	{/if}
</table>
</div>
</fieldset>