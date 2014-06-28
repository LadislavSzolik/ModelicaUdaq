<script type="text/javascript">//<![CDATA[{literal}
	function deleteWarn(def,del){
		var response = confirm('{/literal}{$text113}{literal}');
		if(response){
			window.location = "index.php?page=2&default="+def+"&delete="+del;
		}else {
			window.location = "index.php?page=2";
		}
	}
	function checkChange() {
			if (!$('.default').is(':hidden')) {
				$('.default').slideUp('slow',tesingCheck);
			}
			if (!$('.userDef').is(':hidden')) {
				$('.userDef').slideUp('slow',tesingCheck);
			}
			if (!$('.onlyStep').is(':hidden')) {
				$('.onlyStep').slideUp('slow',tesingCheck);
			}
	}
	function tesingCheck() {
		if ($('.regDB0check').attr('checked')) {
				//$('.onlyStep').css("display","block");
				$('.onlyStep').slideDown('slow');
			}
			if ($('.regDB1check').attr('checked')) {
				
				$('.default').slideDown('slow');
			}
			if ($('.regDB2check').attr('checked')) {
				$('.userDef').slideDown('slow');
		}
	}
	
	$(document).ready(function(){
		$('.default').slideDown('slow');
		$('.regDB0check').click(function(){
			checkChange();
		});

		$('.regDB1check').click(function(){
			checkChange();
			
		});
		$('.regDB2check').click(function(){
			checkChange();
			
		});
	});
//]]></script>{/literal}


<div class="regList">
	<fieldset>
	<legend>{$text124}</legend>
	{if !$user}
		{assign var='disable' value='disabled'}
	{/if}	
	<div>
		<table align="center">
			<tr><td ><input type="radio" name="regDB" class="regDB1check" checked="checked" />{$text14}</td></tr>
			<tr><td ><input type="radio" name="regDB" class="regDB2check" {$disable} />{$text16}</td></tr>
			<tr><td ><input type="radio" name="regDB" class="regDB0check" {$disable} />{$text121}</td></tr>
		</table>
	</div>
</fieldset>
	<br />
	<fieldset>
		<legend>{$text125}</legend>
		<div style="padding:10px;">
		<div class="default" style="display:none;">
			<table align="center" style="width:100%;border-color:white" cellpadding="3" cellspacing="0" border="1">
			<tr  align="center" style="color:white; background-color:#151B8D;"><td>ID</td><td>{$text61}</td><td>{$text80}</td><td colspan="3">{$text82}</td></tr>
			{if $defaultArr}
				{foreach from=$defaultArr item=default key=i}
				{if $i%2} 
					{assign var='style' value='background-color:white;color:black'}
				{else}
					{assign var='style' value='background-color:#b8c1ff;color:black'}
				{/if}
				<tr align="center" style="{$style}"><td>{$default->id}</td><td>{$default->name}</td><td>{$default->datum}</td>
					
				{if $user && $user->permission < 2}
					<td>
						<a href="#"> 
						<img onclick="deleteWarn(0,{$default->id})" src="pic/remove.png" width="22" alt="remove" />
						</a> 
					</td>
				{/if}
					<td>
					<a href="index.php?page=3&amp;default=true&amp;show={$default->id}" >
						<img src="pic/changeIcon2.png" width="22" alt="edit" />
						</a>
					</td>
				{if $user}
					<td>
						<a href="index.php?page=4&amp;simCont={$default->id}" >
						<img src="pic/startIcon.png" width="22" alt="start" />
						</a>
					</td>
				{/if}
				</tr>
				{/foreach}
			{else}
				<tr><td colspan="6">{$text89}</td></tr>
			{/if}
			{if $user && $user->permission < 2}
				<tr><td colspan="6" style="text-align:center;" ><br />
					<a href="index.php?page=3&amp;addNew=true" >
					<img src="pic/pridat.png" alt="pridat" height="22" style="padding:5px;" /><br />{$text13}</a><br /><br />
				</td></tr>
			{/if}
			</table>
		</div>
		<div class="userDef" style="display:none;">
			<table align="center" style="width:100%;border-color:white;" cellpadding="3" cellspacing="0" border="1">	
			<tr  align="center"  style="color:white; background-color:#151B8D;">
				<td>ID</td>
			{if $user->permission < 2}
				<td>{$text36}</td>
			{/if}
				<td>{$text61}</td>
				<td>{$text80}</td>
			{if $user->permission < 2}
				<td>{$text83}</td>
			{/if}
				<td colspan="3">{$text82}</td>
			</tr>
			{if $userDefArr}
				{foreach from=$userDefArr item=userDef key=j}
					{if $j%2}
						{assign var='style' value='background-color:white;color:black;'}
					{else}
						{assign var='style' value='background-color:#b8c1ff;color:black;'}
					{/if}
					<tr align="center"  style="{$style}" >
						<td>{$userDef->id}</td>
					{if $user->permission < 2}
						<td>{$userDef->login}</td>
					{/if}
						<td>{$userDef->name}</td>
						<td>{$userDef->datum}</td>
					{if $user->permission < 2}
						<td>{$userDef->activ}</td>
					{/if}
						<td>
							<a href="#">
							<img onclick="deleteWarn(1,{$userDef->id})" src="pic/remove.png" width="22" alt="load" />
							</a>
						</td>
						<td>
						      <a href="index.php?page=3&amp;default=false&amp;show={$userDef->id}" >
							<img src="pic/changeIcon2.png" width="22" alt="edit" />
						      </a>
						</td>
					{if $user}
						<td>	
							<a href="index.php?page=4&amp;simCont={$userDef->id}" >
							<img src="pic/startIcon.png" width="22" alt="start" />
							</a>
						</td>
					{/if}
						
					</tr>
				{/foreach}
			{else}
				<tr><td colspan="6" align="center">{$text89}</td></tr>
			{/if}
			{if $user->permission > 1 && $user}
				<tr>
					<td colspan="6" style="text-align:center;" ><br />
					<a href="index.php?page=3&amp;addNew=true">
						<img src="pic/pridat.png" alt="pridat" height="22" style="padding:5px;" /><br />
						{$text13}
					</a>
					<br /><br />
					</td>
				</tr>
			{/if}
			</table>
		</div>
		<div class="onlyStep" style="display:none;text-align:center;">
				<a href="index.php?page=5">
				<img alt="remove"  src="pic/startIcon.png" style="padding:5px;" /><br />{$text33}</a>
		</div>
		</div>
	</fieldset>
</div>