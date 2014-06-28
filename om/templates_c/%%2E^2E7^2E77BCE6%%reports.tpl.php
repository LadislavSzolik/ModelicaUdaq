<?php /* Smarty version 2.6.25, created on 2011-05-02 15:50:46
         compiled from reports.tpl */ ?>
<?php if ($this->_tpl_vars['user']): ?>
<script type="text/javascript">//<![CDATA[<?php echo '
var grafdata = new Array();
var oG = {lines: { show: true }, grid: { backgroundColor: { colors: ["#fff", "#eee"] }}};
var gTime = '; ?>
<?php echo $this->_tpl_vars['report']->time; ?>
<?php echo ';
var gD1 = '; ?>
<?php echo $this->_tpl_vars['report']->temp; ?>
<?php echo ';
var gD2 = '; ?>
<?php echo $this->_tpl_vars['report']->ftemp; ?>
<?php echo ';
var gD3 = '; ?>
<?php echo $this->_tpl_vars['report']->light; ?>
<?php echo ';
var gD4 = '; ?>
<?php echo $this->_tpl_vars['report']->flight; ?>
<?php echo ';
var gD5 = '; ?>
<?php echo $this->_tpl_vars['report']->fan_out; ?>
<?php echo ';
var gD6 = '; ?>
<?php echo $this->_tpl_vars['report']->fanrpm; ?>
<?php echo ';
var gD7 = '; ?>
<?php echo $this->_tpl_vars['report']->ref_input; ?>
<?php echo ';

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
	if($(".checkGraf1").attr(\'checked\')){grafdata.push({label: \'temp\', data:grafTemp })};
	if($(".checkGraf2").attr(\'checked\')){grafdata.push({label: \'ftemp\',data:grafFtemp })};
	if($(".checkGraf3").attr(\'checked\')){grafdata.push({label: \'light\',data:grafLight})};
	if($(".checkGraf4").attr(\'checked\')){grafdata.push({label: \'flight\',data:grafFlight })};
	if($(".checkGraf5").attr(\'checked\')){grafdata.push({label: \'fan_out\',data:grafFan_out})};
	if($(".checkGraf6").attr(\'checked\')){grafdata.push({label: \'RPM\', data:grafFanrpm})};
	if($(".checkGraf7").attr(\'checked\')){grafdata.push({label: \'input\',data:grafRef_input })};
	$.plot($(".placeholder"), grafdata, oG);
}


$(document).ready(function(){
	grafChange();
	$(\'.export\').click(function(){
		var adr = "export.php?reportId="+$(\'.reportId\').val();
		if (typeof browserEval != \'undefined\') {
			browserEval(adr);
		}
		else
		{
			location.href=adr;
		}
	});

	$(\'.downXml\').click(function(){
		var adr = "exportXml.php?reportId="+$(\'.reportId\').val();
		if (typeof browserEval != \'undefined\') 
			browserEval(adr);
		else
			location.href=adr;
	});
	$(\'.downJson\').click(function(){
		var adr = "exportJson.php?reportId="+$(\'.reportId\').val();
		if (typeof browserEval != \'undefined\') 
			browserEval(adr);
		else
			location.href=adr;
	});
	$(\'.downPng\').click(function(){
		var divobj = document.getElementById("placeholder");
        Canvas2Image.saveAsPNG(divobj.childNodes[0], false);
	});

	$(\'.usedC\').click(function(){
		
		$(\'.akutalC\').val($(\'.usedCholder\').val());
		
	});
	$(\'.defUsedC\').click(function(){
		$(\'.akutalC\').val($(\'.defUsedCholder\').val());
		
	});
	$(\'.saveReport\').click(function(){
		$(\'.reportForm\').submit();
	});
});
//]]></script>'; ?>


<div style="display:none;">
	<textarea class="usedCholder" rows="15" cols="40"><?php echo $this->_tpl_vars['report']->usedController; ?>
</textarea>
	<textarea class="defUsedCholder" rows="15" cols="40"><?php echo $this->_tpl_vars['report']->controller->cont_string; ?>
</textarea>
	<textarea class="resultT" rows="15" cols="40"><?php echo $this->_tpl_vars['report']->temp; ?>
</textarea>
	<textarea class="resultI" rows="15" cols="40"><?php echo $this->_tpl_vars['report']->intensity; ?>
</textarea>
	<textarea class="resultTime" rows="15" cols="40"><?php echo $this->_tpl_vars['report']->time; ?>
</textarea>
	<input type="text" class="reportId" value="<?php echo $this->_tpl_vars['report']->id; ?>
" />
</div>
<div class="reportClass">
<form class="reportForm" action='index.php?page=7' method='post'  enctype='multipart/form-data'>
<fieldset>
	<legend><?php echo $this->_tpl_vars['text140']; ?>
 <?php echo $this->_tpl_vars['report']->id; ?>
</legend>
<br />

	<b><?php echo $this->_tpl_vars['text84']; ?>
:</b>
	<table align="center" style="text-align:left;width:100%;" >
		<tr>
			<td colspan="2">
			<table align="center" style="width:60%;">
				<tr><td><?php echo $this->_tpl_vars['text62']; ?>
</td><td style="color:navy;"><b><?php echo $this->_tpl_vars['report']->id; ?>
</b></td></tr>
				<tr><td><?php echo $this->_tpl_vars['text45']; ?>
</td><td style="color:navy;"><b><?php echo $this->_tpl_vars['report']->login; ?>
</b></td></tr>
				<tr><td><?php echo $this->_tpl_vars['text59']; ?>
</td><td style="color:navy;"><b><?php echo $this->_tpl_vars['report']->startTime; ?>
</b></td></tr>
				<tr><td><?php echo $this->_tpl_vars['text60']; ?>
</td><td style="color:navy;"><b><?php echo $this->_tpl_vars['report']->endTime; ?>
</b></td></tr>
			</table>
			</td>
		</tr>		
		<tr><td colspan="2"><hr /></td></tr>
		<?php if ($this->_tpl_vars['report']->controller->name != '-2'): ?>
		<tr><td><b><?php echo $this->_tpl_vars['text61']; ?>
:</b></td><td></td></tr>	
		<tr style="text-align:center;"><td colspan="2"><textarea  readonly="readonly" class="akutalC" rows="15" cols="70"><?php echo $this->_tpl_vars['report']->usedController; ?>
</textarea></td></tr>
		<tr><td align="right"><input type="radio" name="contCheck" class="usedC" value="usedC" checked="checked" /><?php echo $this->_tpl_vars['text63']; ?>
</td>
		<td><input type="radio" name="contCheck" class="defUsedC" value="defUsedC" /><?php echo $this->_tpl_vars['text64']; ?>
</td></tr>
		<tr><td colspan="2"><hr /></td></tr>
		<?php endif; ?>
		<tr><td align="left"><b><?php echo $this->_tpl_vars['text57']; ?>
</b></td></tr>
		<tr><td colspan="2">
		<table align="center" >
			<tr><td><input type="checkbox" onchange="grafChange()" class="checkGraf1" value="g1" /></td>
				<td><?php echo $this->_tpl_vars['text65']; ?>
</td>
				<td><input type="checkbox" onchange="grafChange()" class="checkGraf2" value="g2" /></td>
				<td><?php echo $this->_tpl_vars['text126']; ?>
</td>
				<td><input type="checkbox" onchange="grafChange()" class="checkGraf3" value="g3" /></td>
				<td><?php echo $this->_tpl_vars['text127']; ?>
</td>
			</tr>
			<tr>
				<td><input type="checkbox" onchange="grafChange()" class="checkGraf4" value="g4" checked="checked" /></td>
				<td><?php echo $this->_tpl_vars['text128']; ?>
</td>
				<td><input type="checkbox" onchange="grafChange()" class="checkGraf5" value="g5" /></td>
				<td><?php echo $this->_tpl_vars['text129']; ?>
</td>
				<td><input type="checkbox" onchange="grafChange()" class="checkGraf6" value="g6" /></td>
				<td><?php echo $this->_tpl_vars['text130']; ?>
</td>
			</tr>
			<tr>
				<td><input type="checkbox" onchange="grafChange()" class="checkGraf7" value="g7" checked="checked" /></td>
				<td><?php echo $this->_tpl_vars['text131']; ?>
</td>
			</tr>
		</table>
		</td></tr>
		<tr style="text-align:center;"><td colspan="2">
			<div class="placeholder" id="placeholder" style="width:560px;height:300px;margin:auto auto;"></div></td>
		</tr>
		<tr><td colspan="2"><hr /></td></tr>
		<tr><td><b><?php echo $this->_tpl_vars['text141']; ?>
:</b></td></tr>
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
		<tr ><td ><b><?php echo $this->_tpl_vars['text87']; ?>
:</b></td></tr>		
		<tr  style="text-align:center;"><td colspan="2" >
				<input type="hidden"  name="reportId" value="<?php echo $this->_tpl_vars['report']->id; ?>
"  />
				<textarea name="comments" rows="12" cols="65"><?php echo $this->_tpl_vars['report']->comments; ?>
</textarea>
		</td></tr>
	</table>

</fieldset>
<br />
<fieldset>
	<legend><?php echo $this->_tpl_vars['text133']; ?>
</legend>
	<table align="center" cellpadding="10px">
		<tr>
			<td>
				<a href="index.php?page=7"><img height="32" src="pic/backIcon.png"  alt="back" /><br /><?php echo $this->_tpl_vars['text81']; ?>
</a>
			</td>
			<td>
				<input name="saveReport" type="hidden" value="yes" />
				<div class='saveReport' style="cursor:pointer;cursor:hand;font: italic 100%/1.0 Georgia, serif;" >
					<img src="pic/ulozenieIcon.png"  alt="save" height="32" /><br /><?php echo $this->_tpl_vars['text31']; ?>

				</div>
			</td>
		</tr>
	</table>
</fieldset>
</form>
</div>
<?php endif; ?>