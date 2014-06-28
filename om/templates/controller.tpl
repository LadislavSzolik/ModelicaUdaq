<!--<script type="text/javascript" src="skript/js/loadedReg.js"></script>-->

<script type="text/javascript">//<![CDATA[{literal}


var typParamTxt = '<select class="TypParam"><option value="Real" selected="selected">Real</option><option value="Integer">Integer</option><option value="String">String</option><option value="Boolean">Boolean</option></select>';

var con1= true;
var con2= true;
var con3= true;
var con4= true;
var con5= true;
var aktualPar = [{/literal}{$controller->par_arr_js}{literal}];
var aktualVar = [{/literal}{$controller->var_arr_js}{literal}];
var validArr = new Array(true,true,true,true); //number of controlled vars, pars

function deleteWarn(defIn,delIn){
	var def = defIn;
	var del = delIn;
	var response = confirm('{/literal}{$text113}{literal}');
	if(response){
		window.location = "index.php?page=2&default="+def+"&delete="+del;
	}else {
		window.location = "index.php?page=2";
	}
}
///////////////////////////////////////////////////////////////VALIDATE///////////////////////////////////////////////////////////////
function validateFunc(count, item){
	if(item.val() != "" && count == 2 && ( item.val() == "inf" || !isNaN(item.val()))) {
			validArr[count] = true;
			item.css({'border':'','background-color' : 'white' });
	}else if(item.val() == "" || isNaN(item.val())){
		validArr[count] = false;
		item.css({'border':'2px solid red','background-color' : '#FF9966'});
	}else{
		validArr[count] = true;
		item.css({'border':'','background-color' : 'white' });
	}
}
function isValid() {
	var j;
	for(j=0;j<validArr.length;j++){		
		if(validArr[j] == false) {
			return false;
		}
	}
	return true;
}

$(document).ready(function(){	
///////////////////////////////////////////////////////////////INIT ACTIONS///////////////////////////////////////////////////////////////	
	function genLoadedAction() {
	    for(i=0;i<aktualPar.length;i++){
	  	$('.parV'+(aktualPar[i]).toString()).keyup(function() {
				genCont();
		});
		$('.parN'+(aktualPar[i]).toString()).keyup(function() {
				genCont();
		});
		$('.parTypTd'+(aktualPar[i]).toString()+' > .TypParam').change(function(){
				genCont();
		});

		$('.deleteP'+(aktualPar[i]).toString()).click(function(){
			$('.p'+$(this).attr('alt')).remove();
			for(var i=0; i < aktualPar.length; i++)
			{
				if(aktualPar[i] == parseInt($(this).attr('alt')))
				{
					aktualPar.splice(i,1);
				}
			}
			genCont();
		});
	    }
	    for(var i=0; i < aktualVar.length ; i++){
		$('.varN'+(aktualVar[i]).toString()).keyup(function() {
			genCont();
		});
		$('.varTypTd'+(aktualVar[i]).toString()+' > .TypParam').change(function(){
			genCont();
		});
		$('.deleteV'+(aktualVar[i]).toString()).click(function(){			
			$('.v'+$(this).attr('alt')).remove();
			for(var i=0; i < aktualVar.length; i++)
			{
				if(aktualVar[i] == parseInt($(this).attr('alt')))
				{
					aktualVar.splice(i,1);
				}
			}
			genCont();
		});
	    }
	}
///////////////////////////////////////////////////////////////ADD PAR BTN ///////////////////////////////////////////////////////////////
	$('.addPar').click(function()
	{
		if(aktualPar.length < 1 ){
		  aktualPar.push(1);
		}else{
		  aktualPar.push(aktualPar[aktualPar.length -1]+1);
		}
		var aktP = aktualPar[aktualPar.length-1];
		
		$('<tr class=\"p'+(aktP).toString()+'\" align=\"left\"><td class=\"parTypTd'+(aktP).toString()+'\">'+
		typParamTxt+'</td>'+
		'<td><input name=\"parN'+(aktP)+'\" class = \"parN'+(aktP)+'\" type=\"text\" size=5 value=\"\" /></td>'+
		'<td><input name=\"parV'+(aktP)+'\"  class=\"parV'+(aktP)+'\" type=\"text\" size=5 value=\"\" /></td>'+
		'<td><img src=\"pic/remove.png\" alt=\"'+(aktP).toString()+'\"  height=\"22\" style=\"vertical-align:middle;cursor:pointer;cursor:hand;\" class=\"deleteP'+(aktP).toString()+'\" />'+
		'</button></td></tr>').insertAfter('.p'+(aktP-1).toString());

		$('.parV'+(aktP).toString()).keyup(function() {
				genCont();
		});
		$('.parN'+(aktP).toString()).keyup(function() {
				genCont();
		});
		$('.parTypTd'+(aktP).toString()+' > .TypParam').change(function(){
				genCont();  
		});
			
		$('.deleteP'+(aktP).toString()).click(function(){
			$('.p'+$(this).attr('alt')).remove();
			for(var i = 0; i < aktualPar.length; i++)
			{
				if(aktualPar[i] == parseInt($(this).attr('alt')))
				{
					aktualPar.splice(i,1);
				}
			}
			genCont();
		});	
	});
///////////////////////////////////////////////////////////////ADD VAR BTN///////////////////////////////////////////////////////////////
	$('.addVar').click(function(){
		aktualVar.push(aktualVar[aktualVar.length -1]+1);
		var aktV = aktualVar[aktualVar.length-1];
		$('<tr class=\"v'+(aktV).toString()+'\" align=\"left\"><td class=\"varTypTd'+(aktV).toString()+'\">'+
		  typParamTxt+'</td>'+
			'<td><input  class = \"varN'+(aktV).toString()+'\" type=\"text\" size=5 value=\"\" /></td>'+
			'<td><img src=\"pic/remove.png\" class=\"deleteV'+(aktV).toString()+'\" alt=\"'+(aktV).toString()+'\" height=\"22\" style=\"vertical-align:middle;cursor:pointer;cursor:hand;\" />'+
			'</td></tr>').insertAfter('.v'+(aktV-1).toString());

		$('.varN'+(aktV).toString()).keyup(function() {
			genCont();
		});	
		$('.varTypTd'+(aktV).toString()+' > .TypParam').change(function(){
			genCont();
		});	
		$('.deleteV'+(aktV).toString()).click(function(){
			$('.v'+$(this).attr('alt')).remove();
			for(var i=0; i < aktualVar.length ; i++)
			{
				if(aktualVar[i] == parseInt($(this).attr('alt')))
				{
					aktualVar.splice(i,1);
				}
			}
			genCont();
		});
			
	});
///////////////////////////////////////////////////////////////GEN CONTROLLER///////////////////////////////////////////////////////////////
	function genCont()
	{
		var regContent = "";
		var params = "";
		var vars = "";
		var rowCount = 0;
		var parameterInput = '';
		var variableInput = '';

		for(var i=0; i < aktualPar.length ; i++)
		{	
			if($('.p'+aktualPar[i]).length) {
				params += "parameter "+$('.parTypTd'+aktualPar[i]+' > .TypParam option:selected').val()+" "+$('.parN'+aktualPar[i]).val()+" = "+$('.parV'+aktualPar[i]).val()+";\n";
				rowCount++;
			}else{
				break;
			}
		}
		for(var i=0; i< aktualVar.length; i++)
		{
			if($('.v'+aktualVar[i]).length) {
				vars += $('.varTypTd'+aktualVar[i]+' > .TypParam option:selected').val() +" "+$('.varN'+aktualVar[i]).val()+";\n";
				rowCount++;
			}
		}
		rowCount +=$('.equation').attr('rows');
		regContent = "model "+$('.contName').val() +"\n"+params+vars+"\nequation\n"+$('.equation').val()+"\nend "+$('.contName').val()+";";
		$('.cont_string').val(regContent);
		$('.cont_string').attr('rows',rowCount);

		for(var i=0; i < aktualPar.length; i++)
		{
			parameterInput += $('.parTypTd'+aktualPar[i]+' > .TypParam option:selected').val()+'-'+$('.parN'+aktualPar[i]).val()+'-'+$('.parV'+aktualPar[i]).val()+';'
		}
		$('.parameter').val(parameterInput);
		for(var i=0; i < aktualVar.length; i++)
		{
			variableInput += $('.varTypTd'+aktualVar[i]+' > .TypParam option:selected').val() +'-'+$('.varN'+aktualVar[i]).val()+';';
		}
		$('.variable').val(variableInput);
	}	
///////////////////////////////////////////////////////////////SAVE BTN///////////////////////////////////////////////////////////////	
	$('.saveModel').click(function(){
		if(isValid() == true) {	
			var aktParLen = aktualPar.length;
			var aktVarLen = aktualVar.length;

			var dataT = '';
			dataT += 'saving=true';
			dataT += '&option='+encodeURIComponent("{/literal}{$option}{literal}");
			dataT += '&sample='+encodeURIComponent($(".sample").val());
			dataT += '&fun='+encodeURIComponent($(".fun").val());
			dataT += '&led='+encodeURIComponent($(".led").val());
			dataT += '&contName='+encodeURIComponent($(".contName").val());
			dataT += '&equation='+encodeURIComponent($(".equation").val());
			dataT += '&timeLimit='+encodeURIComponent($(".timeLimit").val());
			dataT += '&parameter=';
			for(var i=0; i < aktParLen; i++)
			{
			dataT += $('.parTypTd'+aktualPar[i]+' > .TypParam option:selected').val()+'-'+$('.parN'+aktualPar[i]).val()+'-'+$('.parV'+aktualPar[i]).val()+';';
			}

			dataT += '&variable=';
			for(var i=0; i < aktVarLen; i++)
			{
			dataT += $('.varTypTd'+aktualVar[i]+' > .TypParam option:selected').val() +'-'+$('.varN'+aktualVar[i]).val()+";";
			}

			if($('.activ').length > 0){
				dataT += '&activ='+encodeURIComponent($('.activ').attr("checked"));
			}
			if($('.contId').length >0){
				dataT += '&userId='+encodeURIComponent("{/literal}{$controller->login}{literal}");
				dataT += '&id='+encodeURIComponent($('.contId').val());
			}
			
			$.ajax({
				type: "POST",
				url: "saveController.php",
				data: dataT,
				success:
					function(html){$(".notification").html(html);
					}
				,
				error:
					function (xhr, ajaxOptions, thrownError){
						alert("Error: "+xhr.status+" "+thrownError);
				}
			});
		}else{
			alert("{/literal}{$text120}{literal}");
		}
	});
///////////////////////////////////////////////////////////////RUN BTN///////////////////////////////////////////////////////////////	
	$('.runExp').click(function(){
		if(isValid() == true) {
			$('.contForm').submit();
		}else{
			alert("{/literal}{$text120}{literal}");
		}
	});
///////////////////////////////////////////////////////////////SAVE BTN///////////////////////////////////////////////////////////////	
	$('.defCont').click(function() {
		window.location.reload();
	});

	$('.equation').keyup(function() {
		genCont();
	});

	$('.contName').keyup(function(){
		genCont();
	});

	////////////////////init////////////////////
	genCont();
	genLoadedAction();
});

//]]></script>{/literal}
{if $option eq 'default' }
	{assign var='disable' value='readonly="readonly"' }
	{assign var='selectDis' value='disabled="disabled"'}
{else}
	{assign var='disable' value='' }
	{assign var='selectDis' value=''}
{/if}
<div class="loadedCont">
	<form class="contForm"  action='index.php?page=4' method='post'	 enctype='multipart/form-data'>
	<input type='hidden' name ='parameter' class='parameter' value='{$controller->parameter}'/>
	<input type='hidden' name ='variable' class='variable' value='{$controller->variable}'/>	
 	<input type='hidden' name='contId' class='contId' value='{$controller->id}' />
	<div class="notification"></div>
  <fieldset>
	<legend>{$text132}</legend>
	<br />
		<div style="text-align:center;">
			<label><b>{$text21}</b></label>
			{if $option eq 'default'}
				<input   class = "contName" type="text" name='contName' size="28" value="{$controller->name}" style="display:none;" />
				{$controller->name}
			{else}
				<input   class = "contName" type="text" name='contName' size="28" value="{$controller->name}"  />
			{/if}			
			{if $option eq 'admin' && $user && $user->permission < 2 && $secondOpt}
				{if $controller->activ == 1}
					{assign var='activCheck' value='checked="checked"'}
				{else}
					{assign var='activCheck' value=''}
				{/if}
				<div style="float:left;" >
					<label><b>{$text83}</b></label><input type="checkbox" class="activ" name="activ" {$activCheck} />
				</div>
			{/if}
		</div>
<hr />
  <table style="width:95%;margin:auto;" class="nastavTable" >
  <tr align="left" ><th colspan="2" >{$text17}</th></tr>
  	<tr ><td></td>
		<td>{$text18}</td>
		<td ><input onchange="validateFunc(0,$('.sample'));"  name='sample' class="sample" type="text" size="5" value="{$controller->sample}" /></td>
		<td >{$text20}</td>
		<td ><input onchange="validateFunc(1,$('.led'));"  type="text" class="led" name='led' size="5" value="{$controller->led}" /></td>
	</tr>
  	<tr >
		<td></td>
		<td >{$text118}<br />{$text143}</td>
		<td ><input onchange="validateFunc(2,$('.timeLimit'));" type="text"  size="5" name="timeLimit" class="timeLimit" value="{$controller->timeLimit}" /></td>
		<td >{$text19}</td>
		<td ><input onchange="validateFunc(3,$('.fun'));"  name='fun'  class="fun" type="text" size="5" value="{$controller->fun}" /></td>
	</tr>
	</table>
	<hr />	
		<div style="float:left;width:50%;padding-left:20px;" >
			<table  class="pars" style="width:85%;" cellpadding="5">
				<tr><th align="left" colspan="5">{$text22}</th></tr>
				<tr class="p0"><td>{$text23}</td><td>{$text24}</td><td>{$text25}</td></tr>
				{foreach from=$controller->par_arr item=parTNV  key=i}
					{assign var='realType' value =''}
					{assign var='intType' value =''}
					{assign var='strType' value =''}
					{assign var='boolType' value =''}
					{if $parTNV[1] eq 'Real'}
						{assign var='realType' value ='selected="selected"'}
					{elseif $parTNV[1] eq 'Integer'}
						{assign var='intType' value ='selected="selected"'}
					{elseif $parTNV[1] eq 'String'}
						{assign var='strType' value ='selected="selected"'}
					{elseif $parTNV[1] eq 'Boolean'}
						{assign var='boolType' value ='selected="selected"'}
					{/if}
					
					{if $parTNV[3] eq 'Ref'}
						<tr class='p{$i+1}'>
							<td class='parTypTd{$i+1}' align='left' >
								<select class="TypParam" disabled="disabled">
									<option value="Real" {$realType} >Real</option>
								</select>
							</td>
				<td align='left'><input name='{$parTNV[2]}' class = '{$parTNV[2]}' type='text' size="5" value='{$parTNV[3]}' readonly="readonly" /></td>
				<td align='left'><input name='{$parTNV[4]}'  class='{$parTNV[4]}' type='text' size="5" value='{$parTNV[5]}' /></td>
						</tr>
					{else}
						<tr class='p{$i+1}'>
						<td class='parTypTd{$i+1}' align='left' >
						<select class="TypParam" {$selectDis}>
						<option value="Real" {$realType} >Real</option>
						<option value="Integer" {$intType}>Integer</option>
						<option value="String" {$strType} >String</option>
						<option value="Boolean" {$boolType} >Boolean</option>
						</select>
						</td>
						<td align='left'><input name='{$parTNV[2]}' class = '{$parTNV[2]}' type='text' size="5" value='{$parTNV[3]}' {$disable}/></td>
						<td align='left'><input name='{$parTNV[4]}'  class='{$parTNV[4]}' type='text' size="5" value='{$parTNV[5]}' /></td>
						{if $option neq 'default' }
							<td align='left'>
							<img class="deleteP{$i+1}" src="pic/remove.png" alt="{$i+1}" height="22" style="vertical-align:middle;cursor:pointer;cursor:hand;" />
							
							</td>
						{/if}
						</tr>
					{/if}
				{/foreach}
				{if $option neq 'default'}
  					<tr ><td colspan="5" align="center">
					<button type="button"   class="addPar"  style="padding:5px;">
					<img src="pic/pridat.png" alt="pridat" height="14" style="vertical-align:middle;padding-right:5px;" />
					<div style="display:inline;vertical-align:middle;">{$text26}</div>
					</button>
					</td></tr>
				{/if}
  			</table>
		</div>					
		<div  style="float:right;width:40%;">
			<table  class="vars" cellpadding="5" >
				<tr>
					<th align="left" colspan="5">{$text27}</th>
				</tr>
  				<tr class="v0">
					<td>{$text23}</td>
					<td>{$text24}</td>
				</tr>
				{foreach from=$controller->var_arr item=varTN key=i}
					{assign var='realType2' value =''}
					{assign var='intType2' value =''}
					{assign var='strType2' value =''}
					{assign var='boolType2' value =''}
					{assign var='tempType' value =''}
					{assign var='intenType' value =''}
				
					{if $parTNV[1] eq 'Real'}
					{assign var='realType2' value ='selected="selected"'}
					{elseif $varTN[1] eq 'Integer'}
					{assign var='intType2' value ='selected="selected"'}
					{elseif $varTN[1] eq 'String'}
					{assign var='strType2' value ='selected="selected"'}
					{elseif $varTN[1] eq 'Boolean'}
					{assign var='boolType2' value ='selected="selected"'}
					{/if}
				
					{if $varTN[1] eq 'udaqOut'}
				<tr class='v{$i+1}'>
					<td class='varTypTd{$i+1}' align='left' >
					<select class='TypParam' {$selectDis}>
						<option value='udaqOut' >udaqOut</option>
					</select></td>
					<td align='left'>
						<input name='{$varTN[2]}' class = '{$varTN[2]}' type='text' size="5" value='{$varTN[3]}' readonly="readonly" /></td>
				</tr>
					{elseif $varTN[1] eq 'udaqIn'}
				<tr class='v{$i+1}'>
					<td class='varTypTd{$i+1}' align='left' > 
					<select class='TypParam' {$selectDis}>
						<option value='udaqIn' >udaqIn</option>
					</select></td>
					<td align='left' >
						<input name='{$varTN[2]}' class = '{$varTN[2]}' type='text' size="5" value='{$varTN[3]}' readonly="readonly"/>
					</td>
				</tr>
					{else}
				<tr class='v{$i+1}'>
					<td class='varTypTd{$i+1}' align='left' >
					<select class='TypParam' {$selectDis}>
					<option value='Real' {$realType2} >Real</option>
					<option value='Integer' {$intType2}>Integer</option>
					<option value='String' {$strType2} >String</option>
					<option value='Boolean' {$boolType2} >Boolean</option>
					</select>
					</td>
					<td align='left'><input name='{$varTN[2]}' class = '{$varTN[2]}' type='text' size="5" value='{$varTN[3]}' {$disable} /></td>
					{if $option neq 'default'}
						<td align='left'> 
				<img class="deleteV{$i+1}" src="pic/remove.png" alt="{$i+1}" height="22" style="vertical-align:middle;cursor:pointer;cursor:hand;" />
						</td>
					{/if}
				</tr>
					{/if}
				{/foreach} 
				{if $option neq 'default'}
  				<tr ><td colspan="5" align="center">
						<button type="button"   class="addVar"  style="padding:5px;">
						<img src="pic/pridat.png" alt="pridat" height="14" style="vertical-align:middle;padding-right:5px;" />
						<div style="display:inline;vertical-align:middle;">{$text26}</div>
						</button>
					</td>
				</tr>
				{/if}
  			</table>
		</div>
	<div style="clear:both;" ></div>

	{if $option eq 'default' }
		{assign var='textareaStyle' value='display:none'}
	{/if}
	<div  style="{$textareaStyle};"><hr />
		<div style="float:left;width:30%;" ><b>{$text28}</b></div>
		<div style="float:right;width:70%;"><textarea  name="equation" class="equation" rows="8" cols="50">{$controller->equation}</textarea></div>
		<div style="clear:both;" ></div>
	</div>
	<hr />
	<div style="float:left;width:30%;" ><b>{$text29}</b></div>
	<div style="float:right;width:70%;"><textarea class="cont_string" name="cont_string" id="cont_string" rows="8" cols="50"  readonly="readonly"></textarea></div>
	<div style="clear:both;" ></div>	
</fieldset>	

<br />
	<fieldset>
		<legend>{$text133}</legend>
		<div class="footer_nav" style="text-align:center;">
		<table align="center" cellpadding="20">
			<tr>
				<td><a  href="index.php?page=2"><img height="32" src="pic/backIcon.png"  alt="backBtn" /><br />{$text81}</a></td>
				{if $user}
				<td><div  class='defCont' ><img src="pic/default.png"  alt="defaultCont" /><br />{$text30}</div></td>
				{if ($option neq 'default'|| $user->permission < 2) }
				<td>					
					<div class='saveModel'  ><img src="pic/ulozenieIcon.png"  alt="saveCont" height="32" />
					<br />{$text31}</div>
				</td>
				{/if}
				{if ($option neq 'default' ||  $user->permission < 2) && $option neq 'add' }
				<td>
					<div onclick="deleteWarn({$controller->type},{$controller->id})" class='clearModel'>
					<img alt="remove" src="pic/remove.png" /><br />{$text32}</div>
				</td>
				{/if}
					{if $option neq 'add' }
				<td>
					<div class="runExp" >
					<img alt="startExp" height="32" src="pic/start.png" /><br />{$text33}</div>
				</td>
					{/if}
				{/if}
			</tr>
		</table>
		</div> 
	</fieldset>
</form>
</div>