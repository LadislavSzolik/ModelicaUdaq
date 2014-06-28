
{if isset($smartyRegisterRequest) && !$error_arr}
  <fieldset><h3 align="center">{$text42}</h3><br /><div class = 'goodReg'></div></fieldset>
{elseif isset($smartyChangeRequest) && !$error_arr}
  <fieldset><h3 align="center">{$text43}</h3><br /><div class = 'goodReg'></div></fieldset>
{else}
  <form action='index.php?page=12' method='post' enctype='multipart/form-data'>
	<fieldset>
		<legend>
		{if $user}
			{$text136}
		{else}
			{$text44}
		{/if}
		</legend>
	<div class='registerContent' >
		<br />
		<table class='regiterTable' >
		<tr ><td rowspan='7' valign='top'><div class='loginSettingsIcon'></div></td></tr>
		{if $user}
		<tr><td>{$text45}</td> <td><input name='pouMeno' type='text' value='{$pouMeno}' /></td></tr>
		{else}
		<tr><td>{$text46}</td> <td><input name='pouMeno' type='text' value='{$pouMeno}'/></td></tr>
		{/if}
		<tr><td>{$text47}</td><td><input  type='password' name='heslo1'  value='{$heslo1}' /></td></tr>
		<tr><td>{$text48}</td><td><input  type='password' name='heslo2'  value='{$heslo2}' /></td></tr>
		<tr><td>{$text49}</td><td><input type='text'  name='meno' value='{$meno}' /> </td></tr>
		<tr><td>{$text50}</td><td><input type='text'  name='priezvisko' value='{$priezvisko}' /></td></tr>
		<tr><td>E-mail</td><td><input type='text'  name='email' value='{$email}' /></td></tr>
			<tr><td colspan="3" align="center">
			<br />
			{if $user }
				<input  type='submit' name='changeRequest' value='{$text51}' />
			{else}
				<input  type='submit' name='registerRequest' value='{$text52}' />
			{/if}
			</td></tr>
		</table>
	</div>
	</fieldset>
  </form>
<br /><br />
  {if $error_arr neq ''}
      <fieldset>
      <legend>{$text40}</legend>
		<div style="color:red; padding:20px;">
			{foreach from=$error_arr item=error}
				<b>{$error}</b><br />
			{/foreach}
		</div>
      </fieldset>
  {/if}
{/if}

