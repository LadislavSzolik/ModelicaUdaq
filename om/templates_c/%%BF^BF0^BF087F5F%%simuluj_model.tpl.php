<?php /* Smarty version 2.6.25, created on 2011-05-04 10:40:28
         compiled from simuluj_model.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'sizeof', 'simuluj_model.tpl', 3, false),)), $this); ?>
<script type="text/javascript">//<![CDATA[<?php echo '
	var aktualPar = ['; ?>
<?php echo $this->_tpl_vars['par_arr']; ?>
<?php echo '];
	var contArr = new Array((4+parseInt('; ?>
<?php echo sizeof($this->_tpl_vars['parNV']); ?>
<?php echo ')));	
	var i;
	var sampleTime = '; ?>
<?php echo $this->_tpl_vars['sample']; ?>
<?php echo ';
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

	function endSim() {
		playing = false;
	}

	function grafChange(isPlaying) {
		grafdata.empty();
		if($(".checkGraf1").attr(\'checked\')){grafdata.push({label: \'temp\', data:gD1 })};
		if($(".checkGraf2").attr(\'checked\')){grafdata.push({label: \'ftemp\',data:gD2 })};
		if($(".checkGraf3").attr(\'checked\')){grafdata.push({label: \'light\',data:gD3})};
		if($(".checkGraf4").attr(\'checked\')){grafdata.push({label: \'flight\',data:gD4 })};
		if($(".checkGraf5").attr(\'checked\')){grafdata.push({label: \'fan_out\',data:gD5})};
		if($(".checkGraf6").attr(\'checked\')){grafdata.push({label: \'RPM\', data:gD6})};
		if($(".checkGraf7").attr(\'checked\')){grafdata.push({label: \'input\',data:gD7 })};
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
		grafChange(true);
		var dataT= "";
			dataT +="fun="+encodeURIComponent($("#fun").val());
			dataT +="&led="+encodeURIComponent($("#led").val());
			dataT +="&sample="+encodeURIComponent($(".sample").val());
			dataT += "&nickname="+encodeURIComponent($(".nickname").val());
			dataT += "&controllerID="+encodeURIComponent($(".controllerID").val());
			dataT += "&user_id="+encodeURIComponent($(".user_id").val());
			dataT += "&nazovReg="+encodeURIComponent($(".nazovReg").val());
			dataT += "&lang="+encodeURIComponent($(".lang").val());
			dataT += "&timeLimit="+encodeURIComponent($(".timeLimit").val());
			dataT += "&vlastReg="+encodeURIComponent($(".vlastR").val());
			dataT += "&aktualPar="+encodeURIComponent(aktualPar);
			for(i=0;i<aktualPar.length;i++)
			{
		dataT += \'&par\'+aktualPar[i]+\'=\'+encodeURIComponent($(".parN"+aktualPar[i]).val())+\'=\'+encodeURIComponent($(".parV"+aktualPar[i]).val());
			}

		$.ajax({
			type: "POST",
			url: "skript/python/spustiUdaq.py",
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
			}
		});
	});

	$("button.stop").click(function(){
		$.ajax({
			type: "POST",
			url: "skript/python/zastavitUdaq.py",
			success: function(html) {
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
			dataT +="fun="+encodeURIComponent($("#fun").val());
			dataT +="&led="+encodeURIComponent($("#led").val());
			dataT += "&aktualPar="+encodeURIComponent(aktualPar);
			for(i=0;i<aktualPar.length;i++)
			{
		dataT += \'&par\'+aktualPar[i]+\'=\'+encodeURIComponent($(".parN"+aktualPar[i]).val())+\'=\'+encodeURIComponent($(".parV"+aktualPar[i]).val());
			}			
			$.ajax({
				type: "POST",
				url: "skript/python/zmenitUdaq.py",
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

<input name="nazovReg" class="nazovReg" type="hidden" value="<?php echo $this->_tpl_vars['nazovReg']; ?>
" />
<input name="nickname" class="nickname" type="hidden" value="<?php echo $this->_tpl_vars['user']->login; ?>
" />
<input name="user_id" class="user_id" type="hidden" value="<?php echo $this->_tpl_vars['user']->id; ?>
" />
<input name="controllerID" class="controllerID" type="hidden" value="<?php echo $this->_tpl_vars['controllerID']; ?>
" />
<input name="par_arr" class="par_arr" type="hidden" value="<?php echo $this->_tpl_vars['par_arr']; ?>
" />
<input name="lang" class="lang" type="hidden" value="<?php echo $this->_supers['session']['lang']; ?>
" />



<textarea  style="display:none;" class="vlastR" id = "vlastR" rows="15" cols="50"><?php echo $this->_tpl_vars['vytvorReg']; ?>
</textarea>
<fieldset><legend class="legend" ><?php echo $this->_tpl_vars['text17']; ?>
</legend>
<table  align="center" cellpadding="5px" style="width:80%">
	<tr>
		<td valign="top">
			<table cellpadding="5px">
			<tr><td><?php echo $this->_tpl_vars['text21']; ?>
</td><td><i><?php echo $this->_tpl_vars['nazovReg']; ?>
</i></td></tr>
			<tr >
				<td align='left'><?php echo $this->_tpl_vars['text19']; ?>
</td>
				<td align='left' ><input  onchange="control(0,$('.fun'));" class="fun" id="fun" name="Reťazec" type="text" size="5" value='<?php echo $this->_tpl_vars['fun']; ?>
'/></td>
			</tr>
    		<tr >
				<td  align='left'><?php echo $this->_tpl_vars['text20']; ?>
</td>
				<td align='left' ><input onchange="control(1,$('.led'));" class="led" id="led" name="Reťazec" type="text" size="5" value='<?php echo $this->_tpl_vars['led']; ?>
' /></td>
			</tr>
			<tr>
				<td ><?php echo $this->_tpl_vars['text118']; ?>
<br /><?php echo $this->_tpl_vars['text143']; ?>
</td>
				<td ><input onchange="control(2,$('.timeLimit'));" type="text"  size="5"  class="timeLimit" value="<?php echo $this->_tpl_vars['timeLimit']; ?>
" /></td>
			</tr>
			<tr>
				<td><?php echo $this->_tpl_vars['text18']; ?>
</td>
				<td ><input onchange="control(3,$('.sample'));" class="sample" type="text" size="5" value="<?php echo $this->_tpl_vars['sample']; ?>
" /></td>
			</tr>
			</table>
		</td>
		<td>
			<table cellpadding="5px">
				<?php $_from = $this->_tpl_vars['parNV']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['par']):
?>
					<tr >
						<td align='left'><?php echo $this->_tpl_vars['par'][1]; ?>
</td>
						<td align='left'><input  style='display:none' class='<?php echo $this->_tpl_vars['par'][0]; ?>
' value='<?php echo $this->_tpl_vars['par'][1]; ?>
' />
							<input onchange="control(4+<?php echo $this->_tpl_vars['k']; ?>
,$('.<?php echo $this->_tpl_vars['par'][2]; ?>
'));"  class='<?php echo $this->_tpl_vars['par'][2]; ?>
' type='text' size="8" value='<?php echo $this->_tpl_vars['par'][3]; ?>
' />
						</td>
					</tr>
    			<?php endforeach; endif; unset($_from); ?>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><br /><button type="button"   class="change"  style="padding:5px;">
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
</legend><table align="center">
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
<tr><td colspan="6"><br /><div class="loading" style="display:none;text-align:center;width:560px;height:300px;margin:auto auto" ><h1><?php echo $this->_tpl_vars['text142']; ?>
</h1></div><div class="placeholder" style="width:560px;height:300px;margin:auto auto"></div></td></tr>
</table>
<div class="result"></div>
</fieldset>

