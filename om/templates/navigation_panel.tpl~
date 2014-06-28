<script type="text/javascript">//<![CDATA[{literal}
$(document).ready(function(){
	$('#liquid-round').hide(0);
	$('#liquid-round').fadeIn('slow');
});
//]]></script>{/literal}
<div class="navigation" id="navigation">
    <a href="index.php?page=1">{$text1}</a>
	
    <a href="index.php?page=2">{$text2}</a>
	
    {if !$user}
     <a href="index.php?page=11">{$text3}</a>
    {else}
		{if $user->permission < 2}
			<a href="index.php?page=6">{$text109}</a>
		{/if}
		<a href="index.php?page=8">{$text58}</a>
	  	<a href="index.php?page=10">{$text88}</a>
		<a href="index.php?page=13">{$text4}</a>
     <label>{$text5}&nbsp;
		{if $user->ldap}
			{$user->login}
		{else}
			<a href="index.php?page=12">{$user->name}&nbsp;{$user->surname}</a>
		{/if}
	</label>
    {/if}
</div>
<div id="liquid-round"><div class="top"><span></span></div><div class = "center-content"><div id ="wait_loading"></div>