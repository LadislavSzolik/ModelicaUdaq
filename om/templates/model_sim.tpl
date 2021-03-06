<script type="text/javascript">//<![CDATA[{literal}
	var aktualPar = [{/literal}{$controller->par_arr_js}{literal}];
	var contArr = new Array((4+parseInt({/literal}{$controller->par_arr|@sizeof}{literal})));
	var sampleTime = {/literal}{$controller->sample}{literal};
	
	var i;
	var playing = false;
	var grafdata = new Array();
	var oG = {lines: { show: true }, grid: { backgroundColor: { colors: ["#fff", "#eee"] }}};
	var gD1 = new Array();
	var gD2 = new Array();
	var gD3 = new Array();
	var gD4 = new Array();
	var gD5 = new Array();
	var gD6 = new Array();
	var gD7 = new Array();
	var isCalled = false;
	function endSim() {
		playing = false;
	}

	function grafChange(isPlaying) {
		grafdata.empty();
	if($(".checkGraf1").attr('checked')){grafdata.push({label: '{/literal}{$text65}{literal}', data:gD1 })};
	if($(".checkGraf2").attr('checked')){grafdata.push({label: '{/literal}{$text126}{literal}',data:gD2 })};
	if($(".checkGraf3").attr('checked')){grafdata.push({label: '{/literal}{$text127}{literal}',data:gD3})};
	if($(".checkGraf4").attr('checked')){grafdata.push({label: '{/literal}{$text128}{literal}',data:gD4 })};
	if($(".checkGraf5").attr('checked')){grafdata.push({label: '{/literal}{$text129}{literal}',data:gD5})};
	if($(".checkGraf6").attr('checked')){grafdata.push({label: '{/literal}{$text130}{literal}', data:gD6})};
	if($(".checkGraf7").attr('checked')){grafdata.push({label: '{/literal}{$text131}{literal}', data:gD7})};
		$.plot($(".placeholder"), grafdata, oG);
	}
	
	for(i=0;i<contArr.length;i++) {
		contArr[i] = true;
	}
	function control(count, item){
		
		if(item.val() == "" || isNaN(item.val())){
			contArr[count] = false;
			item.css({'border':'2px solid red','background-color' : '#FF9966'});
		}else{
			contArr[count] = true;
			item.css({'border':'','background-color' : 'white' });
		}
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
	function init() {
		if(isCalled) return 0;
		$(".loading").css("display","none");
		$(".placeholder").css("display","block");
		$(".change").fadeIn('slow');
		$(".timeLimit").attr("disabled","disabled");
		$(".sample").attr("disabled","disabled");
		isCalled = true;
	}
$(document).ready(function(){
	$.plot($(".placeholder"), [0,0], oG);
	function drawGraph() {
		playing = true;
		$.plot($(".placeholder"), [0,0], oG);
	    function fetchData() {
		        function onDataReceived(series) {
					try {
						if(typeof(ok) != 'undefined') {
							if(ok == true) {
								gD1 = graf1Data;
								gD2 = graf2Data;
								gD3 = graf3Data;
								gD4 = graf4Data;
								gD5 = graf5Data;
								gD6 = graf6Data;
								gD7 = graf7Data;

								grafdata.empty();
	if($(".checkGraf1").attr('checked')){grafdata.push({label: '{/literal}{$text65}{literal}', data:gD1 })};
	if($(".checkGraf2").attr('checked')){grafdata.push({label: '{/literal}{$text126}{literal}',data:gD2 })};
	if($(".checkGraf3").attr('checked')){grafdata.push({label: '{/literal}{$text127}{literal}',data:gD3})};
	if($(".checkGraf4").attr('checked')){grafdata.push({label: '{/literal}{$text128}{literal}',data:gD4 })};
	if($(".checkGraf5").attr('checked')){grafdata.push({label: '{/literal}{$text129}{literal}',data:gD5})};
	if($(".checkGraf6").attr('checked')){grafdata.push({label: '{/literal}{$text130}{literal}', data:gD6})};
	if($(".checkGraf7").attr('checked')){grafdata.push({label: '{/literal}{$text131}{literal}', data:gD7})};
								oG = optGraf;
								if (playing == true) {
									init();
									$.plot($(".placeholder"), grafdata, optGraf);
								}
							}
						}
					}catch(err){}
		        }
		        $.ajax({
					url: "skript/python/getData.py",
		            method: 'GET',
					cache: false,
		            dataType: 'script',
		            success: onDataReceived
		        });
				if (playing == true ) {
		        	setTimeout(fetchData, sampleTime);
				}
		    }
		    setTimeout(fetchData, sampleTime);
		}

	$("button.start").click(function(){		
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
		isCalled = false;
		grafChange(true);
		var dataT= "";
		dataT += "&nickname="+encodeURIComponent("{/literal}{$user->login}{literal}");
		dataT += "&contId="+encodeURIComponent("{/literal}{$controller->id}{literal}");
		dataT += "&user_id="+encodeURIComponent("{/literal}{$user->id}{literal}");
		dataT += "&contName="+encodeURIComponent("{/literal}{$controller->name}{literal}");
		dataT += "&contStr="+encodeURIComponent($(".cont_string").val());
		dataT += "&lang="+encodeURIComponent("{/literal}{$smarty.session.lang}{literal}");
		dataT += "&timeLimit="+encodeURIComponent($(".timeLimit").val());
		dataT += "&aktualPar="+encodeURIComponent(aktualPar);
		dataT +="&fun="+encodeURIComponent($(".fun").val());
		dataT +="&led="+encodeURIComponent($(".led").val());
		dataT +="&sample="+encodeURIComponent($(".sample").val());
		for(i=0;i<aktualPar.length;i++)
		{
		      dataT += '&par'+aktualPar[i]+'='+encodeURIComponent($(".parN"+aktualPar[i]).val())+'='+encodeURIComponent($(".parV"+aktualPar[i]).val());
		}

		$.ajax({
			type: "POST",
			url: "skript/python/run_server.py",
			dataType: 'script',
			data: dataT,
			success:
				function(html){
					drawGraph();
					//$(".result").html(html);
				},
			error:
				function (xhr, ajaxOptions, thrownError){
                    alert("Error: "+xhr.status+" "+thrownError);
                },
			complete:
				function(jqXHR, textStatus) {
				$("#wait_loading").css("display","none");
			},
			timeout: 15000
		});
	});

	$("button.stop").click(function(){
		$.ajax({
			type: "POST",
			url: "skript/python/stopUdaq.py",
			success: function(html) {
				$(".change").fadeOut('slow');
				$(".timeLimit").attr("disabled","");
				$(".sample").attr("disabled","");
				setTimeout(endSim,2000);
			},
			error:
				function (xhr, ajaxOptions, thrownError){
                    alert("Error: "+xhr.status+" "+thrownError);
            }
		});
	});
	$("button.change").click(function(){
		if(isValid() == true) {
			dataT = "";
			dataT +="fun="+encodeURIComponent($(".fun").val());
			dataT +="&led="+encodeURIComponent($(".led").val());
			dataT += "&aktualPar="+encodeURIComponent(aktualPar);
			for(i=0;i<aktualPar.length;i++)
			{
		dataT += '&par'+aktualPar[i]+'='+encodeURIComponent($(".parN"+aktualPar[i]).val())+'='+encodeURIComponent($(".parV"+aktualPar[i]).val());
			}			
			$.ajax({
				type: "POST",
				url: "skript/python/changeUdaq.py",
				data: dataT,
				success:
					function(html){
						$(".result").html(html);
					},
				error:
					function (xhr, ajaxOptions, thrownError){
                    	alert("Error: "+xhr.status+" "+thrownError);
					}
			});
		}else{
			alert("{/literal}{$text120}{literal}");
		}
	});
});
//]]></script>{/literal}
<textarea class="cont_string" style="display:none;">{$controller->cont_string}</textarea>
<fieldset><legend class="legend" >{$text17}</legend>
<table  align="center" cellpadding="5px" style="width:80%">
	<tr>
		<td valign="top">
			<table cellpadding="5px">
			<tr><td>{$text21}</td><td><i>{$controller->name}</i></td></tr>
			<tr >
				<td align='left'>{$text19}</td>
				<td align='left' ><input  onchange="control(0,$('.fun'));" class="fun" name="fun" type="text" size="5" value='{$controller->fun}'/></td>
			</tr>
			<tr >
				<td  align='left'>{$text20}</td>
				<td align='left' ><input onchange="control(1,$('.led'));" class="led"  name="led" type="text" size="5" value='{$controller->led}' /></td>
			</tr>
			<tr>
				<td >{$text118}<br />{$text143}</td>
				<td ><input onchange="control(2,$('.timeLimit'));" type="text"  size="5"  class="timeLimit" value="{$controller->timeLimit}" /></td>
			</tr>
			<tr>
				<td>{$text18}</td>
				<td ><input onchange="control(3,$('.sample'));" class="sample" type="text" size="5" value="{$controller->sample}" /></td>
			</tr>
			</table>
		</td>
		<td>
			<table cellpadding="5px">				
				{foreach from=$controller->par_arr item=parTNV  key=i}
					<tr >
						<td align='left'>{$parTNV[3]}</td>
						<td align='left'><input  style='display:none' class='{$parTNV[2]}' value='{$parTNV[3]}' />
							<input onchange="control(4+{$i},$('.{$parTNV[4]}'));"  class='{$parTNV[4]}' type='text' size="5" value='{$parTNV[5]}' />
						</td>
					</tr>
    			{/foreach}
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><br /><button type="button"   class="change"  style="padding:5px;display:none;">
			<img src="pic/changeIcon.png" alt="change" height="20" style="vertical-align:middle;padding-right:5px;" />
			<div style="display:inline;vertical-align:middle;">{$text54}</div>
			</button>
		</td>
	</tr>
</table>
</fieldset>
<br />
<fieldset><legend class="legend" >{$text55}</legend>
<div style="text-align:center;">
	<button type="button"   class="start" name="poslat" style="margin-right:20px;" >
	<img src="pic/playIcon.png" alt="play"   />	
	</button>

	<button type="button"   class="stop" name="poslat" >
	<img src="pic/stopIcon.png" alt="stop"   />
	</button>
</div>
<div style="clear:both;" ></div>
</fieldset>
<br />
<fieldset><legend class="legend" >{$text57}</legend>
<table align="center">
<tr><td><input type="checkbox" onchange="grafChange(true)" class="checkGraf1" value="g1" /></td>
	<td>{$text65}</td>
	<td><input type="checkbox" onchange="grafChange(true)" class="checkGraf2" value="g2" /></td>
	<td>{$text126}</td>
	<td><input type="checkbox" onchange="grafChange(true)" class="checkGraf3" value="g3" /></td>
	<td>{$text127}</td>
</tr>
<tr>
	<td><input type="checkbox" onchange="grafChange(true)" class="checkGraf4" value="g4" checked="checked" /></td>
	<td>{$text128}</td>
	<td><input type="checkbox" onchange="grafChange(true)" class="checkGraf5" value="g5" /></td>
	<td>{$text129}</td>
	<td><input type="checkbox" onchange="grafChange(true)" class="checkGraf6" value="g6" /></td>
	<td>{$text130}</td>
</tr>
<tr>
	<td><input type="checkbox" onchange="grafChange(true)" class="checkGraf7" value="g7" checked="checked" /></td>
	<td>{$text131}</td>
</tr>
<tr><td colspan="5"><br /><div class="loading" style="display:none;text-align:center;width:560px;height:300px;margin:auto auto" ><h1>{$text142}</h1></div><div class="placeholder" style="width:560px;height:300px;margin:auto auto"></div></td>
	<td><div class="legendContainer"></div></td>
</tr>
</table>
<div class="result"></div>
</fieldset>
<br />
<fieldset>
	<legend>{$text133}</legend>
	<div class="simModel" style="text-align:center;" >
		<a  href="index.php?{$backFunc}"><img height="32" src="pic/backIcon.png"  alt="backBtn" /><br />{$text81}</a>
	</div>
</fieldset>

