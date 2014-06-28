<?php /* Smarty version 2.6.25, created on 2011-05-03 16:37:29
         compiled from stepSimulation.tpl */ ?>
<script type="text/javascript">//<![CDATA[<?php echo '
var grafdata = new Array();
var oG = {lines: { show: true }, grid: { backgroundColor: { colors: ["#fff", "#eee"] }}};
var gD1 = new Array();
var gD2 = new Array();
var gD3 = new Array();
var gD4 = new Array();
var gD5 = new Array();
var gD6 = new Array();
var gD7 = new Array();

var sampleTime = 100;
var playing = false;
var contArr = new Array(6);	
var i;

function grafChange() {
	grafdata.empty();
	if($(".checkGraf1").attr(\'checked\')){grafdata.push({label: \'temp\', data:gD1 })};
	if($(".checkGraf2").attr(\'checked\')){grafdata.push({label: \'ftemp\',data:gD2 })};
	if($(".checkGraf3").attr(\'checked\')){grafdata.push({label: \'light\',data:gD3})};
	if($(".checkGraf4").attr(\'checked\')){grafdata.push({label: \'flight\',data:gD4 })};
	if($(".checkGraf5").attr(\'checked\')){grafdata.push({label: \'fan_out\',data:gD5})};
	if($(".checkGraf6").attr(\'checked\')){grafdata.push({label: \'RPM\', data:gD6})};
	if($(".checkGraf7").attr(\'checked\')){grafdata.push({label: \'input\', data:gD7})};
	$.plot($(".placeholder"), grafdata, oG);
}
	
function arrayGenerator(arrHolder) {
	arrHolder = arrHolder.split(",");
	var resultArr = new Array();
	if(arrHolder.length > 1) {
		for(i=0;i<arrHolder.length;i++)
		{
			resultArr.push(arrHolder[i]);
		}
	}else if(arrHolder.length == 0){
		resultArr = new Array();
	}else {
		resultArr = arrHolder;
	}
	return resultArr;
}
	
for(i=0;i<contArr.length;i++) {
	contArr[i] = true;
}

function control(count, item){
		if(item.val() != "" && count == 5 && ( item.val() == "inf" || !isNaN(item.val()))) {
			contArr[count] = true;
			item.css({\'border\':\'\',\'background-color\' : \'white\' });
		}else if(item.val() == "" || isNaN(item.val())){
			contArr[count] = false;
			item.css({\'border\':\'2px solid red\',\'background-color\' : \'#FF9966\'});
		}else{
			contArr[count] = true;
			item.css({\'border\':\'\',\'background-color\' : \'white\' });
		}
}
function endSim() {
		playing = false;
	}
function isValid() {
		var j;
		for(j=0;j<contArr.length;j++){
			if(contArr[j] == false) {
				return false;
			}
		}
		return true;
}
$(document).ready(function(){
	
	$.plot($(".placeholder"), [0,0],oG);

	function drawGraph() {
		playing = true;		
		$.plot($(".placeholder"), [0,0],oG);

	    function fetchData() {
		        function onDataReceived(series) {
					try {
						if(typeof(ok) != \'undefined\') {
							if(ok == true) {
								gD1 = graf1Data;
								gD2 = graf2Data;
								gD3 = graf3Data;
								gD4 = graf4Data;
								gD5 = graf5Data;
								gD6 = graf6Data;
								gD7 = graf7Data;

								grafdata.empty();
								if($(".checkGraf1").attr(\'checked\')){grafdata.push({label: \'temp\', data:gD1 })};
								if($(".checkGraf2").attr(\'checked\')){grafdata.push({label: \'ftemp\',data:gD2 })};
								if($(".checkGraf3").attr(\'checked\')){grafdata.push({label: \'light\',data:gD3 })};
								if($(".checkGraf4").attr(\'checked\')){grafdata.push({label: \'flight\',data:gD4 })};
								if($(".checkGraf5").attr(\'checked\')){grafdata.push({label: \'fan_out\',data:gD5})};
								if($(".checkGraf6").attr(\'checked\')){grafdata.push({label: \'RPM\',data:gD6 })};
								if($(".checkGraf7").attr(\'checked\')){grafdata.push({label: \'input\',data:gD7 })};
								oG = optGraf;
								if (playing == true) {
									$(".loading").css("display","none");
									$(".placeholder").css("display","block");
									$.plot($(".placeholder"), grafdata, optGraf);
								}
							}
						}
					}catch(err){}
		        }
		        $.ajax({
					url: "skript/python/getData.py",
		            method: \'GET\',
					cache: false,
		            dataType: \'script\',
		            success: onDataReceived
		        });
				if (playing == true ) {
		        	setTimeout(fetchData, sampleTime);
				}
		    }
		    setTimeout(fetchData, sampleTime);
	}

	$("button.start").click(function(){
		if(isValid() == true) {
			sampleTime = parseFloat($(".sample").val());
			$(".placeholder").css("display","none");
			$(".loading").css("display","block");
			$("#wait_loading").css("display","block");

			gD1 = new Array();
			gD2 = new Array();
			gD3 = new Array();
			gD4 = new Array();
			gD5 = new Array();
			gD6 = new Array();
			gD7 = new Array();
			grafChange();

var dataT= "fun="+encodeURIComponent($(".fun").val())+"&led="+encodeURIComponent($(".led").val())+"&sample="+encodeURIComponent($(".sample").val());
			dataT += "&nickname="+encodeURIComponent($(".nickname").val());
			dataT += "&controllerID="+encodeURIComponent($(".controllerID").val());
			dataT += "&user_id="+encodeURIComponent($(".user_id").val());
			dataT += "&nazovReg="+encodeURIComponent($(".nazovReg").val());
			dataT += "&lang="+encodeURIComponent($(".lang").val());
			dataT += "&timeLimit="+encodeURIComponent($(".timeLimit").val());
			dataT += "&vlastReg="+encodeURIComponent($(".vlastR").val());
			dataT += "&intensity="+encodeURIComponent($(".int").val());
			dataT += "&onlyStep=1";
	
			$.ajax({
				type: "POST",
				url: "skript/python/spustiUdaq.py",
				data: dataT,
				dataType: \'script\',
				success:
					function(html){
						drawGraph();
						$(".result").html(html);
					},
				error:
					function (xhr, ajaxOptions, thrownError){
						playing = false;
						alert("Error: "+xhr.status+" "+thrownError);
					},
				complete:
					function(jqXHR, textStatus) {
					$("#wait_loading").css("display","none");
				},
				timeout: 10000
			});
		}else{
			alert("'; ?>
<?php echo $this->_tpl_vars['text120']; ?>
<?php echo '");
		}
	});
	$("button.stop").click(function(){
		$.ajax({
			type: "POST",
			url: "skript/python/zastavitUdaq.py",
			success: function(html) {
				setTimeout(endSim,3000);
			},
			error:
				function (xhr, ajaxOptions, thrownError){
                    alert("Error: "+xhr.status+" "+thrownError);
            }
		});
	});
	
});
//]]></script>'; ?>

<input name="vlastR" class="vlastR" type="hidden" value="-" />
<input name="nazovReg" class="nazovReg" type="hidden" value="-" />
<input name="nickname" class="nickname" type="hidden" value="<?php echo $this->_tpl_vars['user']->login; ?>
" />
<input name="user_id" class="user_id" type="hidden" value="<?php echo $this->_tpl_vars['user']->id; ?>
" />
<input name="controllerID" class="controllerID" type="hidden" value="null" />
<input name="lang" class="lang" type="hidden" value="<?php echo $this->_supers['session']['lang']; ?>
" />

<fieldset><legend class="legend" ><?php echo $this->_tpl_vars['text121']; ?>
</legend>
<table border="0" align="center" style="width:300px;">
	<tr>
		<td  align='left'><?php echo $this->_tpl_vars['text66']; ?>
</td>
		<td align='center'><input onchange="control(0,$('.int'));" class="int"  type="text" size=8 value='5' /></td>
	</tr>
    <tr >
		<td align='left'><?php echo $this->_tpl_vars['text19']; ?>
</td>
		<td align='center' ><input  onchange="control(1,$('.fun'));" class="fun"  type="text" size=8 value='0' />
	</tr>
    <tr >
		<td  align='left'><?php echo $this->_tpl_vars['text20']; ?>
</td>
		<td align='center' ><input onchange="control(2,$('.led'));" class="led"  type="text" size=8 value='0' /></td>
	</tr>
	<tr>
		<td  align='left'><?php echo $this->_tpl_vars['text18']; ?>
</td>
		<td align='center'><input  onchange="control(4,$('.sample'));" class="sample"  type="text" size=8 value='100'/></td>
	</tr>
	<tr>
		<td  align='left'><?php echo $this->_tpl_vars['text118']; ?>
<br /><?php echo $this->_tpl_vars['text143']; ?>
</td>
		<td align='center'><input  onchange="control(5,$('.timeLimit'));" class="timeLimit"  type="text" size=8 value='120' /></td>
	</tr>
</table>
</fieldset>
<br />
<fieldset><legend class="legend" ><?php echo $this->_tpl_vars['text55']; ?>
</legend>
<div style="text-align:center;">
	<button type="button"   class="start" name="poslat" style="margin-right:20px;" >
	<img src="pic/playIcon.png" alt="play"   />	
	</button>
	<button type="button"   class="stop" name="poslat" >
	<img src="pic/stopIcon.png" alt="play"   />
	</button>
</div>
<div style="clear:both;" ></div>
</fieldset>
<br />
<fieldset><legend class="legend" ><?php echo $this->_tpl_vars['text57']; ?>
</legend><table align="center">
<tr><td><input type="checkbox" onchange="grafChange()" class="checkGraf1" value="g1" ></td>
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

<tr ><td colspan="6" ><div class="loading" style="display:none;text-align:center;width:560px;height:300px;margin:auto auto" ><h1><?php echo $this->_tpl_vars['text142']; ?>
</h1></div><div class="placeholder" style="width:560px;height:300px;margin:auto auto"></div></td></tr>
</table>
<div class="result"></div>
</fieldset>

