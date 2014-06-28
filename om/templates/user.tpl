
{if $succes}
	<fieldset>
		<legend>{$text138}</legend>
		<br />
		<div class="userClass" style="text-align:center;">
			<div class = 'goodReg'></div>
			<br />
			<h3>{$text117}</h3>		
		<br />
		<a  href="index.php?page=6"><img height="32" src="pic/backIcon.png"  alt="back" /><br />{$text81}</a>
		</div>
	</fieldset>
{else}
	<script type="text/javascript">//<![CDATA[{literal}
		$(document).ready(function(){ 
			$('.newPassw').click(function(){
				if ($('.newPassw').attr("checked") == true) {
					$('.trPassw1').css("visibility","visible");
					$('.trPassw2').css("visibility","visible");
				}else {
					$('.trPassw1').css("visibility","hidden");
					$('.trPassw2').css("visibility","hidden");
				}
			});
			$('.updateUser').click(function(){
				$('.userForm').submit();
			});
			$('.createUser').click(function(){
				$('.userForm').submit();
			});
			
		});
	//]]></script>{/literal}
	<div class="userClass">
		<form  class="userForm" action='index.php?page=7' method='post' enctype='multipart/form-data'>
		<fieldset>
			<legend>{$text138}</legend>
			<br />
			<table  align="center" style="width:100%;"  cellspacing="0" cellpadding="3">
			{if $show}
					<tr ><td rowspan='9' align="center" valign='top'><div class='loginSettingsIcon'></div></td></tr>
					<tr><td>ID</td><td><b>{$user->id}</b></td></tr>
					<tr><td>{$text36}</td><td><b>{$choosedUser->login}</b></td></tr>
					<tr><td>{$text49}</td><td><b>{$choosedUser->name}</b></td></tr>
					<tr><td>{$text50}</td><td><b>{$choosedUser->surname}</b></td></tr>
					<tr><td>E-mail</td><td><b>{$choosedUser->email}</b></td></tr>
					<tr><td>{$text110}</td><td><b>
						{if $choosedUser->permission eq '1'}
							{$text144}
						{else}
							{$text145}
						{/if}
					</b></td></tr>
					<tr><td>IP</td><td><b>{$choosedUser->ip}</b></td></tr>
					<tr><td>{$text80}</td><td><b>{$choosedUser->datum}</b></td></tr>
			{elseif $change}
					<tr ><td rowspan='10' align="center" valign='top'><div class='loginSettingsIcon'></div></td></tr>
					<tr><td>ID</td><td>{$choosedUser->id}<input type="hidden" name="id" value="{$choosedUser->id}" /></td></tr>
					<tr><td>{$text36}</td><td><input name='login' type='text' value='{$choosedUser->login}'/></td></tr>
					<tr><td>{$text49}</td><td><input name='name' type='text' value='{$choosedUser->name}'/></td></tr>
					<tr><td>{$text50}</td><td><input name='surname' type='text' value='{$choosedUser->surname}'/></td></tr>
					<tr><td>E-mail</td><td><input name='email' type='text' value='{$choosedUser->email}'/></td></tr>
					<tr><td>{$text110}</td><td>
					<select name='permission'>
					{if $choosedUser->permission eq '1'}
					  <option value="1" selected="selected" >{$text144}</option>
					  <option value="2" >{$text145}</option>
					{else}
					  <option value="1" >{$text144}</option>
					  <option value="2" selected="selected">{$text145}</option>
					{/if}
					</select>
					</td></tr>
					<tr><td  ><input type="checkbox" name="newPassw" class="newPassw" />{$text116}</td></tr>
					<tr class="trPassw1"  style="visibility:hidden;"><td>{$text47}</td><td><input name='passw1' type='password' value=''/></td></tr>
					<tr class="trPassw2" style="visibility:hidden;"><td>{$text48}</td><td><input name='passw2' type='password' value=''/></td></tr>
			{elseif $addNew}
					<tr ><td rowspan='8' align="center" valign='top'><div class='loginSettingsIcon'></div></td></tr>
					<tr><td>{$text36}</td><td><input name='login' type='text' value=''/></td></tr>
					<tr><td>{$text47}</td><td><input name='passw1' type='password' value=''/></td></tr>
					<tr><td>{$text48}</td><td><input name='passw2' type='password' value=''/></td></tr>
					<tr><td>{$text49}</td><td><input name='name' type='text' value=''/></td></tr>
					<tr><td>{$text50}</td><td><input name='surname' type='text' value=''/></td></tr>
					<tr><td>E-mail</td><td><input name='email' type='text' value=''/></td></tr>
					<tr><td>{$text110}</td><td>
						<select name='permission'>
							<option value="1" >{$text144}</option>
							<option value="2" >{$text145}</option>
						</select></td></tr>
			{/if}
				<tr><td colspan="3"><hr /></td></tr>
				<tr><td colspan="3" align="center">
					<table cellpadding="10px">
						<tr >
							<td >
								<a  href="index.php?page=6"><img height="32" src="pic/backIcon.png"  alt="back" /><br />{$text81}</a>
							</td>
						{if $change}
							<td>
								<input name="updateUser" type="hidden" value="yes" />
								<div class='updateUser' style="cursor:pointer;cursor:hand;" >
									<img src="pic/ulozenieIcon.png"  alt="save" height="32" /><br />{$text31}
								</div>
							</td>
						{/if}
						{if $addNew}
							<td>
								<input name="createUser" type="hidden" value="yes" />
								<div class='createUser' style="cursor:pointer;cursor:hand;" >
									<img src="pic/ulozenieIcon.png"  alt="save" height="32" /><br />{$text31}
								</div>
							</td>
						{/if}
						</tr>
					</table>
				</td></tr>
			</table>
		</fieldset>
		</form>
		<br /><br />
		{if $errorArr}
			<fieldset>
				<legend>{$text40}</legend>
					<div style="color:red; padding:20px;">
					{foreach from=$errorArr item=error}
						<b>{$error}</b><br />
					{/foreach}
					</div>
			</fieldset>
		{/if}
	</div>
{/if}

