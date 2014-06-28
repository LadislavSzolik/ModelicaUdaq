{if $user}
<script type="text/javascript">//<![CDATA[{literal}
var grafdata = new Array();
var oG = null;

var gTime = {/literal}{$report->time}{literal};
var gD1 = {/literal}{$report->temp}{literal};
var gD2 = {/literal}{$report->ftemp}{literal};
var gD3 = {/literal}{$report->light}{literal};
var gD4 = {/literal}{$report->flight}{literal};
var gD5 = {/literal}{$report->fan_out}{literal};
var gD6 = {/literal}{$report->fanrpm }{literal};
var gD7 = {/literal}{$report->ref_input}{literal};

var i;
var grafTemp = new Array();
var grafFtemp = new Array();
var grafLight = new Array();
var grafFlight = new Array();
var grafFan_out = new Array();
var grafFanrpm = new Array();
var grafRef_input = new Array();

for(i=0;i<gTime.length;i++) {
	grafTemp.push([parseFloat(gTime[i]),parseFloat(gD1[i])]);
	grafFtemp.push([parseFloat(gTime[i]),parseFloat(gD2[i])]);
	grafLight.push([parseFloat(gTime[i]),parseFloat(gD3[i])]);
	grafFlight.push([parseFloat(gTime[i]),parseFloat(gD4[i])]);
	grafFan_out.push([parseFloat(gTime[i]),parseFloat(gD5[i])]);
	grafFanrpm.push([parseFloat(gTime[i]),parseFloat(gD6[i])]);
	grafRef_input.push([parseFloat(gTime[i]),parseFloat(gD7[i])]);
}

function grafChange() {
	grafdata.empty();
	if($(".checkGraf1").attr('checked')){grafdata.push({color:'#FF0000',label: '{/literal}{$text65}{literal}', data:grafTemp })};
	if($(".checkGraf2").attr('checked')){grafdata.push({color:'#00FFFF',label: '{/literal}{$text126}{literal}',data:grafFtemp })};
	if($(".checkGraf3").attr('checked')){grafdata.push({color:'#0000FF',label: '{/literal}{$text127}{literal}',data:grafLight})};
	if($(".checkGraf4").attr('checked')){grafdata.push({color:'#800080',label: '{/literal}{$text128}{literal}',data:grafFlight })};
	if($(".checkGraf5").attr('checked')){grafdata.push({color:'#00FF00',label: '{/literal}{$text129}{literal}',data:grafFan_out})};
	if($(".checkGraf6").attr('checked')){grafdata.push({color:'#FF8040',label: '{/literal}{$text130}{literal}', data:grafFanrpm})};
	if($(".checkGraf7").attr('checked')){grafdata.push({color:'#FF9900',label: '{/literal}{$text131}{literal}',data:grafRef_input })};
	oG = {legend:{ container:$('.legendContainer')},lines: { show: true }, grid: { backgroundColor: { colors: ["#fff", "#eee"] }}};
	$.plot($(".placeholder"), grafdata, oG);
}


$(document).ready(function(){
	
	grafChange();
	$('.export').click(function(){
		var adr = "exportText.php?reportId="+$('.reportId').val();
		if (typeof browserEval != 'undefined') {
			browserEval(adr);
		}
		else
		{
			location.href=adr;
		}
	});

	$('.downXml').click(function(){
		var adr = "exportXml.php?reportId="+$('.reportId').val();
		if (typeof browserEval != 'undefined') 
			browserEval(adr);
		else
			location.href=adr;
	});
	$('.downJson').click(function(){
		var adr = "exportJson.php?reportId="+$('.reportId').val();
		if (typeof browserEval != 'undefined') 
			browserEval(adr);
		else
			location.href=adr;
	});
	$('.downPng').click(function(){
		var divobj = document.getElementById("placeholder");
        Canvas2Image.saveAsPNG(divobj.childNodes[0], false);
	});

	$('.usedC').click(function(){
		
		$('.akutalC').val($('.usedCholder').val());
		
	});
	$('.defUsedC').click(function(){
		$('.akutalC').val($('.defUsedCholder').val());
		
	});
	$('.saveReport').click(function(){
		$('.reportForm').submit();
	});
});
//]]></script>{/literal}

<div style="display:none;">
	<textarea class="usedCholder" rows="15" cols="40">{$report->usedController}</textarea>
	<textarea class="defUsedCholder" rows="15" cols="40">{$report->controller->cont_string}</textarea>
	<textarea class="resultT" rows="15" cols="40">{$report->temp}</textarea>
	<textarea class="resultI" rows="15" cols="40">{$report->intensity }</textarea>
	<textarea class="resultTime" rows="15" cols="40">{$report->time}</textarea>
	<input type="text" class="reportId" value="{$report->id}" />
</div>
<div class="reportClass">
<form class="reportForm" action='index.php?page=8' method='post'  enctype='multipart/form-data'>
<fieldset>
	<legend>{$text140} {$report->id}</legend>
<br />

	<b>{$text84}:</b>
	<table align="center" style="text-align:left;width:100%;" >
		<tr>
			<td colspan="2">
			<table align="center" style="width:60%;" >
				<tr><td>{$text62}</td><td style="color:navy;"><b>{$report->id}</b></td></tr>
				<tr><td>{$text45}</td><td style="color:navy;"><b>{$report->login}</b></td></tr>
				<tr><td>{$text59}</td><td style="color:navy;"><b>{$report->startTime}</b></td></tr>
				<tr><td>{$text60}</td><td style="color:navy;"><b>{$report->endTime}</b></td></tr>
			</table>
			</td>
		</tr>		
		<tr><td colspan="2"><hr /></td></tr>
		{if $report->controller->name neq '-2'}
		<tr><td><b>{$text61}:</b></td><td></td></tr>	
		<tr style="text-align:center;">
			<td colspan="2"><textarea  readonly="readonly" class="akutalC" rows="15" cols="70">{$report->usedController}</textarea></td></tr>
		<tr><td align="center">
		  <table>
			<tr><td><input type="radio" name="contCheck" class="usedC" value="usedC" checked="checked" />{$text63}</td>
			<td><input type="radio" name="contCheck" class="defUsedC" value="defUsedC" />{$text64}</td></tr>
		  </table>
		</td></tr>
		<tr><td colspan="2"><hr /></td></tr>
		{/if}
		<tr><td align="left"><b>{$text57}</b></td></tr>
		<tr><td colspan="2">
		<table align="center" >
			<tr><td><input type="checkbox" onchange="grafChange()" class="checkGraf1" value="g1" /></td>
				<td>{$text65}</td>
				<td><input type="checkbox" onchange="grafChange()" class="checkGraf2" value="g2" /></td>
				<td>{$text126}</td>
				<td><input type="checkbox" onchange="grafChange()" class="checkGraf3" value="g3" /></td>
				<td>{$text127}</td>
			</tr>
			<tr>
				<td><input type="checkbox" onchange="grafChange()" class="checkGraf4" value="g4" checked="checked" /></td>
				<td>{$text128}</td>
				<td><input type="checkbox" onchange="grafChange()" class="checkGraf5" value="g5" /></td>
				<td>{$text129}</td>
				<td><input type="checkbox" onchange="grafChange()" class="checkGraf6" value="g6" /></td>
				<td>{$text130}</td>
			</tr>
			<tr>
				<td><input type="checkbox" onchange="grafChange()" class="checkGraf7" value="g7" checked="checked" /></td>
				<td>{$text131}</td>
			</tr>
		</table>
		</td></tr>
		<tr ><td >
			<table>
			  <tr><td><div class="placeholder" id="placeholder" style="width:560px;height:300px;margin:auto auto;"></div></td>
			  <td><div  class="legendContainer"></div></td></td></tr>
			</table>
		</tr>
		<tr><td colspan="2"><hr /></td></tr>
		<tr><td><b>{$text141}:</b></td></tr>
		<tr ><td colspan="2">
		<table style="font-weight:bold;" align="center"  cellpadding="5px;" >
			<tr>
				<td >
				<button type="button"   class="export"  style="padding:5px;">
				<img src="pic/downloadIcon3.png" alt="txt"  style="vertical-align:middle;padding-right:5px;" /><br />
				<div style="display:inline;vertical-align:middle;"><b>.TXT</b></div>
				</button>
				</td>
				<td >
				<button type="button"   class="downPng"  style="padding:5px;">
				<img src="pic/downloadIcon3.png" alt="png"  style="vertical-align:middle;padding-right:5px;" /><br />
				<div style="display:inline;vertical-align:middle;"><b>.PNG</b></div>
				</button>
				</td>
				<td >
				<button type="button"   class="downXml"  style="padding:5px;">
				<img src="pic/downloadIcon3.png" alt="xml"  style="vertical-align:middle;padding-right:5px;" /><br />
				<div style="display:inline;vertical-align:middle;"><b>.XML</b></div>
				</button>
				</td>
				<td >
				<button type="button"   class="downJson"  style="padding:5px;">
				<img src="pic/downloadIcon3.png" alt="json"  style="vertical-align:middle;padding-right:5px;" /><br />
				<div style="display:inline;vertical-align:middle;"><b>.JSON</b></div>
				</button>
				</td>
			</tr>
		</table>
		</td></tr>
		<tr><td colspan="2"><hr /></td></tr>
		<tr ><td ><b>{$text87}:</b></td></tr>		
		<tr  style="text-align:center;"><td colspan="2" >
				<input type="hidden"  name="reportId" value="{$report->id}"  />
				<textarea name="comments" rows="12" cols="65">{$report->comments}</textarea>
		</td></tr>
	</table>

</fieldset>
<br />
<fieldset>
	<legend>{$text133}</legend>
	<table align="center" cellpadding="10px">
		<tr>
			<td>
				<a href="index.php?page=8"><img height="32" src="pic/backIcon.png"  alt="back" /><br />{$text81}</a>
			</td>
			<td>
				<input name="saveReport" type="hidden" value="yes" />
				<div class='saveReport' style="cursor:pointer;cursor:hand;font: italic 100%/1.0 Georgia, serif;" >
					<img src="pic/ulozenieIcon.png"  alt="save" height="32" /><br />{$text31}
				</div>
			</td>
		</tr>
	</table>
</fieldset>
</form>
</div>
{/if}