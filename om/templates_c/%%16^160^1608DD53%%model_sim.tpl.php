<?php /* Smarty version 2.6.25, created on 2011-05-19 10:50:18
         compiled from model_sim.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'sizeof', 'model_sim.tpl', 3, false),)), $this); ?>
<script type="text/javascript">//<![CDATA[<?php echo '
	var aktualPar = ['; ?>
<?php echo $this->_tpl_vars['controller']->par_arr_js; ?>
<?php echo '];
	var contArr = new Array((4+parseInt('; ?>
<?php echo sizeof($this->_tpl_vars['controller']->par_arr); ?>
<?php echo ')));
	var sampleTime = '; ?>
<?php echo $this->_tpl_vars['controller']->sample; ?>
<?php echo ';
	
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
	if($(".checkGraf1").attr(\'checked\')){grafdata.push({label: \''; ?>
<?php echo $this->_tpl_vars['text65']; ?>
<?php echo '\', data:gD1 })};
	if($(".checkGraf2").attr(\'checked\')){grafdata.push({label: \''; ?>
<?php echo $this->_tpl_vars['text126']; ?>
<?php echo '\',data:gD2 })};
	if($(".checkGraf3").attr(\'checked\')){grafdata.push({label: \''; ?>
<?php echo $this->_tpl_vars['text127']; ?>
<?php echo '\',data:gD3})};
	if($(".checkGraf4").attr(\'checked\')){grafdata.push({label: \''; ?>
<?php echo $this->_tpl_vars['text128']; ?>
<?php echo '\',data:gD4 })};
	if($(".checkGraf5").attr(\'checked\')){grafdata.push({label: \''; ?>
<?php echo $this->_tpl_vars['text129']; ?>
<?php echo '\',data:gD5})};
	if($(".checkGraf6").attr(\'checked\')){grafdata.push({label: \''; ?>
<?php echo $this->_tpl_vars['text130']; ?>
<?php echo '\', data:gD6})};
	if($(".checkGraf7").attr(\'checked\')){grafdata.push({label: \''; ?>
<?php echo $this->_tpl_vars['text131']; ?>
<?php echo '\', data:gD7})};
		$.plot($(".placeholder"), grafdata, oG);
	}
	
	for(i=0;i<contArr.length;i++) {
		contArr[i] = true;
	}
	function control(count, item){
		
		if(item.val() == "" || isNaN(item.val())){
			contArr[count] = false;
			item.css({\'border\':\'2px solid red\',\'background-color\' : \'#FF9966\'});
		}else{
			contArr[count] = true;
			item.css({\'border\':\'\',\'background-color\' : \'white\' });
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
		$(".change").fadeIn(\'slow\');
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
	if($(".checkGraf1").attr(\'checked\')){grafdata.push({label: \''; ?>
<?php echo $this->_tpl_vars['text65']; ?>
<?php echo '\', data:gD1 })};
	if($(".checkGraf2").attr(\'checked\')){grafdata.push({label: \''; ?>
<?php echo $this->_tpl_vars['text126']; ?>
<?php echo '\',data:gD2 })};
	if($(".checkGraf3").attr(\'checked\')){grafdata.push({label: \''; ?>
<?php echo $this->_tpl_vars['text127']; ?>
<?php echo '\',data:gD3})};
	if($(".checkGraf4").attr(\'checked\')){grafdata.push({label: \''; ?>
<?php echo $this->_tpl_vars['text128']; ?>
<?php echo '\',data:gD4 })};
	if($(".checkGraf5").attr(\'checked\')){grafdata.push({label: \''; ?>
<?php echo $this->_tpl_vars['text129']; ?>
<?php echo '\',data:gD5})};
	if($(".checkGraf6").attr(\'checked\')){grafdata.push({label: \''; ?>
<?php echo $this->_tpl_vars['text130']; ?>
<?php echo '\', data:gD6})};
	if($(".checkGraf7").attr(\'checked\')){grafdata.push({label: \''; ?>
<?php echo $this->_tpl_vars['text131']; ?>
<?php echo '\', data:gD7})};
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
		dataT += "&nickname="+encodeURIComponent("'; ?>
<?php echo $this->_tpl_vars['user']->login; ?>
<?php echo '");
		dataT += "&contId="+encodeURIComponent("'; ?>
<?php echo $this->_tpl_vars['controller']->id; ?>
<?php echo '");
		dataT += "&user_id="+encodeURIComponent("'; ?>
<?php echo $this->_tpl_vars['user']->id; ?>
<?php echo '");
		dataT += "&contName="+encodeURIComponent("'; ?>
<?php echo $this->_tpl_vars['controller']->name; ?>
<?php echo '");
		dataT += "&contStr="+encodeURIComponent($(".cont_string").val());
		dataT += "&lang="+encodeURIComponent("'; ?>
<?php echo $this->_supers['session']['lang']; ?>
<?php echo '");
		dataT += "&timeLimit="+encodeURIComponent($(".timeLimit").val());
		dataT += "&aktualPar="+encodeURIComponent(aktualPar);
		dataT +="&fun="+encodeURIComponent($(".fun").val());
		dataT +="&led="+encodeURIComponent($(".led").val());
		dataT +="&sample="+encodeURIComponent($(".sample").val());
		for(i=0;i<aktualPar.length;i++)
		{
		      dataT += \'&par\'+aktualPar[i]+\'=\'+encodeURIComponent($(".parN"+aktualPar[i]).val())+\'=\'+encodeURIComponent($(".parV"+aktualPar[i]).val());
		}

		$.ajax({
			type: "POST",
			url: "skript/python/run_server.py",
			dataType: \'script\',
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
				$(".change").fadeOut(\'slow\');
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
		dataT += \'&par\'+aktualPar[i]+\'=\'+encodeURIComponent($(".parN"+aktualPar[i]).val())+\'=\'+encodeURIComponent($(".parV"+aktualPar[i]).val());
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
			alert("'; ?>
<?php echo $this->_tpl_vars['text120']; ?>
<?php echo '");
		}
	});
});
//]]></script>'; ?>

<textarea class="cont_string" style="display:none;"><?php echo $this->_tpl_vars['controller']->cont_string; ?>
</textarea>
<fieldset><legend class="legend" ><?php echo $this->_tpl_vars['text17']; ?>
</legend>
<table  align="center" cellpadding="5px" style="width:80%">
	<tr>
		<td valign="top">
			<table cellpadding="5px">
			<tr><td><?php echo $this->_tpl_vars['text21']; ?>
</td><td><i><?php echo $this->_tpl_vars['controller']->name; ?>
</i></td></tr>
			<tr >
				<td align='left'><?php echo $this->_tpl_vars['text19']; ?>
</td>
				<td align='left' ><input  onchange="control(0,$('.fun'));" class="fun" name="fun" type="text" size="5" value='<?php echo $this->_tpl_vars['controller']->fun; ?>
'/></td>
			</tr>
			<tr >
				<td  align='left'><?php echo $this->_tpl_vars['text20']; ?>
</td>
				<td align='left' ><input onchange="control(1,$('.led'));" class="led"  name="led" type="text" size="5" value='<?php echo $this->_tpl_vars['controller']->led; ?>
' /></td>
			</tr>
			<tr>
				<td ><?php echo $this->_tpl_vars['text118']; ?>
<br /><?php echo $this->_tpl_vars['text143']; ?>
</td>
				<td ><input onchange="control(2,$('.timeLimit'));" type="text"  size="5"  class="timeLimit" value="<?php echo $this->_tpl_vars['controller']->timeLimit; ?>
" /></td>
			</tr>
			<tr>
				<td><?php echo $this->_tpl_vars['text18']; ?>
</td>
				<td ><input onchange="control(3,$('.sample'));" class="sample" type="text" size="5" value="<?php echo $this->_tpl_vars['controller']->sample; ?>
" /></td>
			</tr>
			</table>
		</td>
		<td>
			<table cellpadding="5px">				
				<?php $_from = $this->_tpl_vars['controller']->par_arr; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['parTNV']):
?>
					<tr >
						<td align='left'><?php echo $this->_tpl_vars['parTNV'][3]; ?>
</td>
						<td align='left'><input  style='display:none' class='<?php echo $this->_tpl_vars['parTNV'][2]; ?>
' value='<?php echo $this->_tpl_vars['parTNV'][3]; ?>
' />
							<input onchange="control(4+<?php echo $this->_tpl_vars['i']; ?>
,$('.<?php echo $this->_tpl_vars['parTNV'][4]; ?>
'));"  class='<?php echo $this->_tpl_vars['parTNV'][4]; ?>
' type='text' size="5" value='<?php echo $this->_tpl_vars['parTNV'][5]; ?>
' />
						</td>
					</tr>
    			<?php endforeach; endif; unset($_from); ?>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><br /><button type="button"   class="change"  style="padding:5px;display:none;">
			<img src="pic/changeIcon.png" alt="change" height="20" style="vertical-align:middle;padding-right:5px;" />
			<div style="display:inline;vertical-align:middle;"><?php echo $this->_tpl_vars['text54']; ?>
</div>
			</button>
		</td>
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
	<img src="pic/stopIcon.png" alt="stop"   />
	</button>
</div>
<div style="clear:both;" ></div>
</fieldset>
<br />
<fieldset><legend class="legend" ><?php echo $this->_tpl_vars['text57']; ?>
</legend>
<table align="center">
<tr><td><input type="checkbox" onchange="grafChange(true)" class="checkGraf1" value="g1" /></td>
	<td><?php echo $this->_tpl_vars['text65']; ?>
</td>
	<td><input type="checkbox" onchange="grafChange(true)" class="checkGraf2" value="g2" /></td>
	<td><?php echo $this->_tpl_vars['text126']; ?>
</td>
	<td><input type="checkbox" onchange="grafChange(true)" class="checkGraf3" value="g3" /></td>
	<td><?php echo $this->_tpl_vars['text127']; ?>
</td>
</tr>
<tr>
	<td><input type="checkbox" onchange="grafChange(true)" class="checkGraf4" value="g4" checked="checked" /></td>
	<td><?php echo $this->_tpl_vars['text128']; ?>
</td>
	<td><input type="checkbox" onchange="grafChange(true)" class="checkGraf5" value="g5" /></td>
	<td><?php echo $this->_tpl_vars['text129']; ?>
</td>
	<td><input type="checkbox" onchange="grafChange(true)" class="checkGraf6" value="g6" /></td>
	<td><?php echo $this->_tpl_vars['text130']; ?>
</td>
</tr>
<tr>
	<td><input type="checkbox" onchange="grafChange(true)" class="checkGraf7" value="g7" checked="checked" /></td>
	<td><?php echo $this->_tpl_vars['text131']; ?>
</td>
</tr>
<tr><td colspan="5"><br /><div class="loading" style="display:none;text-align:center;width:560px;height:300px;margin:auto auto" ><h1><?php echo $this->_tpl_vars['text142']; ?>
</h1></div><div class="placeholder" style="width:560px;height:300px;margin:auto auto"></div></td>
	<td><div class="legendContainer"></div></td>
</tr>
</table>
<div class="result"></div>
</fieldset>
<br />
<fieldset>
	<legend><?php echo $this->_tpl_vars['text133']; ?>
</legend>
	<div class="simModel" style="text-align:center;" >
		<a  href="index.php?<?php echo $this->_tpl_vars['backFunc']; ?>
"><img height="32" src="pic/backIcon.png"  alt="backBtn" /><br /><?php echo $this->_tpl_vars['text81']; ?>
</a>
	</div>
</fieldset>
