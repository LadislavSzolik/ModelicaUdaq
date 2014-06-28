<script type="text/javascript">//<![CDATA[{literal}
	function deleteWarn(del){
		var response = confirm('{/literal}{$text113}{literal}');
		if(response){
			window.location = "index.php?page=6&delete="+del;
		}else {
			//window.location = "index.php?page=6";
		}
	}
	$(document).ready(function(){
		$('.userListClass').hide();
		$('.userListClass').slideDown('swing');
	});
//]]></script>{/literal}

<fieldset>
<legend>{$text137}</legend>
	<br />
	<div class="userListClass" >
		<table align="center" style="width:100%;border-color:white" cellpadding="3" cellspacing="0" border="1" >
		<tr align="center" style="color:white; background-color:#151B8D;">
			<td>ID</td>
			<td>{$text36}</td>
			<td>E-mail</td>
			<td>{$text110}</td>
			<td>IP</td>
			<td colspan="3" align="center">{$text82}</td>
		</tr>
		{if $userList}	
			{foreach from=$userList item=aktUser key=i}
			{if $i%2} 
				{assign var='style' value='background-color:white;color:black'}
			{else}
				{assign var='style' value='background-color:#b8c1ff;color:black'}
			{/if}
			<tr style="{$style}" >
				<td>{$aktUser->id}</td>
				<td>{$aktUser->login}</td>
				<td>{$aktUser->email}</td>
				<td>
				    {if $aktUser->permission eq '1'}
					{$text144}
				    {else}
					{$text145}
				    {/if}
				</td>
				<td>{$aktUser->ip}</td>
				<td>
					<a href="index.php?page=7&amp;show={$aktUser->id}">
					<img src="pic/zoomIcon.png"  alt="load" style="vertical-align:middle;" /></a>
				</td>
				<td>
				<a href="index.php?page=7&amp;change={$aktUser->id}" >
					<img src="pic/changeIcon2.png" width="22" alt="load" />
					</a>
				</td>
				<td>
					<a href="#" >
					<img onclick="deleteWarn({$aktUser->id})" src="pic/remove.png" width="22" alt="load" />
					</a>
				</td>

			</tr>
			{/foreach}
		{else}
			<tr><td colspan="5">{$text89}</td></tr>
			
		{/if}

		{if $user && $user->permission < 2}
			<tr><td colspan="8" style="text-align:center;" ><br />
				<a href="index.php?page=7&amp;addNew=true">
				<img src="pic/pridat.png" alt="pridat" height="22" style="padding:5px;" /><br />
				{$text111}
				</a>
				<br /><br />
				</td>
			</tr>
		{/if}
		</table>
	</div>
</fieldset>