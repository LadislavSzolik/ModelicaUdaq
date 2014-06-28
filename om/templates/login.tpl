
{if $user}
 <fieldset><div style="width:100%;text-align:center;"><h3>{$text41}</h3><div class='goodLogin'></div></div></fieldset>
{else}
	<form action='index.php?page=11' method='post' enctype='multipart/form-data'>
	<fieldset >
		<legend>{$text34}</legend>
		<div class='loginContent'>
		<table style="width:500px;margin:auto;" class='loginTable' border='0' >
		<tr ><td rowspan="4"><div class='loginFigure'></div></td></tr>
		<tr align="left">
			<td><label>{$text35}</label></td>
			<td><select name="LdapLogin" ><option value="NOLDAP" >no LDAP</option><option value="LDAP" >LDAP stuba</option></select></td></tr>
    	<tr align="left" ><td><label for='pouMeno'>{$text36}</label></td><td><input type='text' name='pouMeno' class='pouMeno'/></td></tr>
    	<tr align="left" ><td><label for='heslo'>{$text37}</label></td><td><input type='password' name='heslo' class='heslo' /></td></tr>
		<tr align="right"><td colspan="2"><br /><button type='submit' name='loginRequest' id ='buttonBtn' >{$text38}</button></td></tr>
		</table>
		</div>
		<br />	
		<div style="width:100%;text-align:right;">{$text134} <a href='index.php?page=12'  class ='anBtn'>{$text135}</a></div>
	</fieldset>
		<br /><br />
	</form>	
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