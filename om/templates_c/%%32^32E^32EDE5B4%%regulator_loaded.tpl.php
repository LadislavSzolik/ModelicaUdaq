<?php /* Smarty version 2.6.25, created on 2011-05-04 11:36:30
         compiled from regulator_loaded.tpl */ ?>
<!--<script type="text/javascript" src="skript/js/loadedReg.js"></script>-->

<script type="text/javascript">//<![CDATA[<?php echo '


var typParamTxt = \'<select class="TypParam"><option value="Real" selected="selected">Real</option><option value="Integer">Integer</option><option value="String">String</option><option value="Boolean">Boolean</option></select>\';

var con1= true;
var con2= true;
var con3= true;
var con4= true;
var con5= true;
var aktualPar = ['; ?>
<?php echo $this->_tpl_vars['controller']->par_arr_js; ?>
<?php echo '];
var aktualVar = ['; ?>
<?php echo $this->_tpl_vars['controller']->var_arr_js; ?>
<?php echo '];
var validArr = new Array(true,true,true,true); //number of controlled vars, pars

function deleteWarn(defIn,delIn){
	var def = defIn;
	var del = delIn;
	var response = confirm(\''; ?>
<?php echo $this->_tpl_vars['text113']; ?>
<?php echo '\');
	if(response){
		window.location = "index.php?page=9&default="+def+"&delete="+del;
	}else {
		window.location = "index.php?page=9";
	}
}
///////////////////////////////////////////////////////////////VALIDATE///////////////////////////////////////////////////////////////
function validateFunc(count, item){
	if(item.val() != "" && count == 2 && ( item.val() == "inf" || !isNaN(item.val()))) {
			validArr[count] = true;
			item.css({\'border\':\'\',\'background-color\' : \'white\' });
	}else if(item.val() == "" || isNaN(item.val())){
		validArr[count] = false;
		item.css({\'border\':\'2px solid red\',\'background-color\' : \'#FF9966\'});
	}else{
		validArr[count] = true;
		item.css({\'border\':\'\',\'background-color\' : \'white\' });
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
	  	$(\'.parV\'+(aktualPar[i]).toString()).keyup(function() {
				genCont();
		});
		$(\'.parN\'+(aktualPar[i]).toString()).keyup(function() {
				genCont();
		});
		$(\'.parTypTd\'+(aktualPar[i]).toString()+\' > .TypParam\').change(function(){
				genCont();
		});

		$(\'.deleteP\'+(aktualPar[i]).toString()).click(function(){
			$(\'.p\'+$(this).attr(\'alt\')).remove();
			for(var i=0; i < aktualPar.length; i++)
			{
				if(aktualPar[i] == parseInt($(this).attr(\'alt\')))
				{
					aktualPar.splice(i,1);
				}
			}
			genCont();
		});
	    }
	    for(var i=0; i < aktualVar.length ; i++){
		$(\'.varN\'+(aktualVar[i]).toString()).keyup(function() {
			genCont();
		});
		$(\'.varTypTd\'+(aktualVar[i]).toString()+\' > .TypParam\').change(function(){
			genCont();
		});
		$(\'.deleteV\'+(aktualVar[i]).toString()).click(function(){			
			$(\'.v\'+$(this).attr(\'alt\')).remove();
			for(var i=0; i < aktualVar.length; i++)
			{
				if(aktualVar[i] == parseInt($(this).attr(\'alt\')))
				{
					aktualVar.splice(i,1);
				}
			}
			genCont();
		});
	    }
	}
///////////////////////////////////////////////////////////////ADD PAR BTN ///////////////////////////////////////////////////////////////
	$(\'.addPar\').click(function()
	{
		if(aktualPar.length < 1 ){
		  aktualPar.push(1);
		}else{
		  aktualPar.push(aktualPar[aktualPar.length -1]+1);
		}
		var aktP = aktualPar[aktualPar.length-1];
		
		$(\'<tr class=\\"p\'+(aktP).toString()+\'\\" align=\\"left\\"><td class=\\"parTypTd\'+(aktP).toString()+\'\\">\'+
		typParamTxt+\'</td>\'+
		\'<td><input name=\\"parN\'+(aktP)+\'\\" class = \\"parN\'+(aktP)+\'\\" type=\\"text\\" size=5 value=\\"\\" /></td>\'+
		\'<td><input name=\\"parV\'+(aktP)+\'\\"  class=\\"parV\'+(aktP)+\'\\" type=\\"text\\" size=5 value=\\"\\" /></td>\'+
		\'<td><img src=\\"pic/remove.png\\" alt=\\"\'+(aktP).toString()+\'\\"  height=\\"22\\" style=\\"vertical-align:middle;cursor:pointer;cursor:hand;\\" class=\\"deleteP\'+(aktP).toString()+\'\\" />\'+
		\'</button></td></tr>\').insertAfter(\'.p\'+(aktP-1).toString());

		$(\'.parV\'+(aktP).toString()).keyup(function() {
				genCont();
		});
		$(\'.parN\'+(aktP).toString()).keyup(function() {
				genCont();
		});
		$(\'.parTypTd\'+(aktP).toString()+\' > .TypParam\').change(function(){
				genCont();  
		});
			
		$(\'.deleteP\'+(aktP).toString()).click(function(){
			$(\'.p\'+$(this).attr(\'alt\')).remove();
			for(var i = 0; i < aktualPar.length; i++)
			{
				if(aktualPar[i] == parseInt($(this).attr(\'alt\')))
				{
					aktualPar.splice(i,1);
				}
			}
			genCont();
		});	
	});
///////////////////////////////////////////////////////////////ADD VAR BTN///////////////////////////////////////////////////////////////
	$(\'.addVar\').click(function(){
		aktualVar.push(aktualVar[aktualVar.length -1]+1);
		var aktV = aktualVar[aktualVar.length-1];
		$(\'<tr class=\\"v\'+(aktV).toString()+\'\\" align=\\"left\\"><td class=\\"varTypTd\'+(aktV).toString()+\'\\">\'+
		  typParamTxt+\'</td>\'+
			\'<td><input  class = \\"varN\'+(aktV).toString()+\'\\" type=\\"text\\" size=5 value=\\"\\" /></td>\'+
			\'<td><img src=\\"pic/remove.png\\" class=\\"deleteV\'+(aktV).toString()+\'\\" alt=\\"\'+(aktV).toString()+\'\\" height=\\"22\\" style=\\"vertical-align:middle;cursor:pointer;cursor:hand;\\" />\'+
			\'</td></tr>\').insertAfter(\'.v\'+(aktV-1).toString());

		$(\'.varN\'+(aktV).toString()).keyup(function() {
			genCont();
		});	
		$(\'.varTypTd\'+(aktV).toString()+\' > .TypParam\').change(function(){
			genCont();
		});	
		$(\'.deleteV\'+(aktV).toString()).click(function(){
			$(\'.v\'+$(this).attr(\'alt\')).remove();
			for(var i=0; i < aktualVar.length ; i++)
			{
				if(aktualVar[i] == parseInt($(this).attr(\'alt\')))
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

		for(var i=0; i < aktualPar.length ; i++)
		{	
			if($(\'.p\'+aktualPar[i]).length) {
				params += "parameter "+$(\'.parTypTd\'+aktualPar[i]+\' > .TypParam option:selected\').val()+" "+$(\'.parN\'+aktualPar[i]).val()+" = "+$(\'.parV\'+aktualPar[i]).val()+";\\n";
				rowCount++;
			}else{
				break;
			}
		}
		for(var i=0; i< aktualVar.length; i++)
		{
			if($(\'.v\'+aktualVar[i]).length) {
				vars += $(\'.varTypTd\'+aktualVar[i]+\' > .TypParam option:selected\').val() +" "+$(\'.varN\'+aktualVar[i]).val()+";\\n";
				rowCount++;
			}
		}
		rowCount +=$(\'.contEq\').attr(\'rows\');
		regContent = "model "+$(\'.contName\').val() +"\\n"+params+vars+"\\nequation\\n"+$(\'.contEq\').val()+"\\nend "+$(\'.contName\').val()+";";
		$(\'.contStr\').val(regContent);
		$(\'.contStr\').attr(\'rows\',rowCount);

	}	
///////////////////////////////////////////////////////////////SAVE BTN///////////////////////////////////////////////////////////////	
	$(\'.saveModel\').click(function(){
		if(isValid() == true) {	
			var aktParLen = aktualPar.length;
			var aktVarLen = aktualVar.length;

			var dataT = \'\';
			dataT += \'saving=true\';
			dataT += \'&option=\'+encodeURIComponent($(".option").val());
			dataT += \'&sample=\'+encodeURIComponent($(".sample").val());
			dataT += \'&fun=\'+encodeURIComponent($(".fun").val());
			dataT += \'&led=\'+encodeURIComponent($(".led").val());
			dataT += \'&contName=\'+encodeURIComponent($(".contName").val());
			dataT += \'&equation=\'+encodeURIComponent($(".contEq").val());
			dataT += \'&timeLimit=\'+encodeURIComponent($(".timeLimit").val());
			dataT += \'&parameter=\';
			for(var i=0; i < aktParLen; i++)
			{
			dataT += $(\'.parTypTd\'+aktualPar[i]+\' > .TypParam option:selected\').val()+\'-\'+$(\'.parN\'+aktualPar[i]).val()+\'-\'+$(\'.parV\'+aktualPar[i]).val()+\';\';
			}

			dataT += \'&variable=\';
			for(var i=0; i < aktVarLen; i++)
			{
			dataT += $(\'.varTypTd\'+aktualVar[i]+\' > .TypParam option:selected\').val() +\'-\'+$(\'.varN\'+aktualVar[i]).val()+";";
			}

			if($(\'.activ\').length > 0){
				dataT += \'&activ=\'+encodeURIComponent($(\'.activ\').attr("checked"));
			}
			if($(\'.contId\').length >0){
				dataT += \'&userId=\'+encodeURIComponent($(\'.userId\').val());
				dataT += \'&id=\'+encodeURIComponent($(\'.contId\').val());
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
			alert("'; ?>
<?php echo $this->_tpl_vars['text120']; ?>
<?php echo '");
		}
	});
///////////////////////////////////////////////////////////////RUN BTN///////////////////////////////////////////////////////////////	
	$(\'.runExp\').click(function(){
		if(isValid() == true) {
			$(\'.contForm\').submit();
		}else{
			alert("'; ?>
<?php echo $this->_tpl_vars['text120']; ?>
<?php echo '");
		}
	});
///////////////////////////////////////////////////////////////SAVE BTN///////////////////////////////////////////////////////////////	
	$(\'.defCont\').click(function() {
		window.location.reload();
	});

	$(\'.contEq\').keyup(function() {
		genCont();
	});

	$(\'.contName\').keyup(function(){
		genCont();
	});

	////////////////////init////////////////////
	genCont();
	genLoadedAction();
});

//]]></script>'; ?>

<?php if ($this->_tpl_vars['option'] == 'default'): ?>
	<?php $this->assign('disable', 'readonly="readonly"'); ?>
	<?php $this->assign('selectDis', 'disabled="disabled"'); ?>
<?php else: ?>
	<?php $this->assign('disable', ''); ?>
	<?php $this->assign('selectDis', ''); ?>
<?php endif; ?>
<div class="loadedCont">
	<form class="contForm"  action='index.php?page=3' method='post'	 enctype='multipart/form-data'>
	<input type='hidden' class='par_arr' name="par_arr" value='<?php echo $this->_tpl_vars['controller']->par_arr_js; ?>
' />
	<input type='hidden' class='option'  value='<?php echo $this->_tpl_vars['option']; ?>
' />
	<input type="hidden" class='userId' value='<?php echo $this->_tpl_vars['controller']->login; ?>
' />
 	<input type='hidden' class='contId' value='<?php echo $this->_tpl_vars['controller']->id; ?>
' />
	<div class="notification"></div>
  <fieldset>
	<legend><?php echo $this->_tpl_vars['text132']; ?>
</legend>
	<br />
		<div style="text-align:center;">
			<label><b><?php echo $this->_tpl_vars['text21']; ?>
</b></label>
			<?php if ($this->_tpl_vars['option'] == 'default'): ?>
				<input   class = "contName" type="text" name='contName' size="28" value="<?php echo $this->_tpl_vars['controller']->name; ?>
" style="display:none;" />
				<?php echo $this->_tpl_vars['controller']->name; ?>

			<?php else: ?>
				<input   class = "contName" type="text" name='contName' size="28" value="<?php echo $this->_tpl_vars['controller']->name; ?>
"  />
			<?php endif; ?>			
			<?php if ($this->_tpl_vars['option'] == 'admin' && $this->_tpl_vars['user'] && $this->_tpl_vars['user']->permission < 2 && $this->_tpl_vars['secondOpt']): ?>
				<?php if ($this->_tpl_vars['controller']->activ == 1): ?>
					<?php $this->assign('activCheck', 'checked="checked"'); ?>
				<?php else: ?>
					<?php $this->assign('activCheck', ''); ?>
				<?php endif; ?>
				<div style="float:left;" >
					<label><b><?php echo $this->_tpl_vars['text83']; ?>
</b></label><input type="checkbox" class="activ" name="activ" <?php echo $this->_tpl_vars['activCheck']; ?>
 />
				</div>
			<?php endif; ?>
		</div>
<hr />
  <table style="width:95%;margin:auto;" class="nastavTable" >
  <tr align="left" ><th colspan="2" ><?php echo $this->_tpl_vars['text17']; ?>
</th></tr>
  	<tr ><td></td>
		<td><?php echo $this->_tpl_vars['text18']; ?>
</td>
		<td ><input onchange="validateFunc(0,$('.sample'));"  name='sample' class="sample" type="text" size="5" value="<?php echo $this->_tpl_vars['controller']->sample; ?>
" /></td>
		<td ><?php echo $this->_tpl_vars['text20']; ?>
</td>
		<td ><input onchange="validateFunc(1,$('.led'));"  type="text" class="led" name='led' size="5" value="<?php echo $this->_tpl_vars['controller']->led; ?>
" /></td>
	</tr>
  	<tr >
		<td></td>
		<td ><?php echo $this->_tpl_vars['text118']; ?>
<br /><?php echo $this->_tpl_vars['text143']; ?>
</td>
		<td ><input onchange="validateFunc(2,$('.timeLimit'));" type="text"  size="5" name="timeLimit" class="timeLimit" value="<?php echo $this->_tpl_vars['controller']->timeLimit; ?>
" /></td>
		<td ><?php echo $this->_tpl_vars['text19']; ?>
</td>
		<td ><input onchange="validateFunc(3,$('.fun'));"  name='fun'  class="fun" type="text" size="5" value="<?php echo $this->_tpl_vars['controller']->fun; ?>
" /></td>
	</tr>
	</table>
	<hr />	
		<div style="float:left;width:50%;padding-left:20px;" >
			<table  class="pars" style="width:85%;" cellpadding="5">
				<tr><th align="left" colspan="5"><?php echo $this->_tpl_vars['text22']; ?>
</th></tr>
				<tr class="p0"><td><?php echo $this->_tpl_vars['text23']; ?>
</td><td><?php echo $this->_tpl_vars['text24']; ?>
</td><td><?php echo $this->_tpl_vars['text25']; ?>
</td></tr>
				<?php $_from = $this->_tpl_vars['controller']->par_arr; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['parTNV']):
?>
					<?php $this->assign('realType', ''); ?>
					<?php $this->assign('intType', ''); ?>
					<?php $this->assign('strType', ''); ?>
					<?php $this->assign('boolType', ''); ?>
					<?php if ($this->_tpl_vars['parTNV'][1] == 'Real'): ?>
						<?php $this->assign('realType', 'selected="selected"'); ?>
					<?php elseif ($this->_tpl_vars['parTNV'][1] == 'Integer'): ?>
						<?php $this->assign('intType', 'selected="selected"'); ?>
					<?php elseif ($this->_tpl_vars['parTNV'][1] == 'String'): ?>
						<?php $this->assign('strType', 'selected="selected"'); ?>
					<?php elseif ($this->_tpl_vars['parTNV'][1] == 'Boolean'): ?>
						<?php $this->assign('boolType', 'selected="selected"'); ?>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['parTNV'][3] == 'Ref'): ?>
						<tr class='p<?php echo $this->_tpl_vars['i']+1; ?>
'>
							<td class='parTypTd<?php echo $this->_tpl_vars['i']+1; ?>
' align='left' >
								<select class="TypParam" disabled="disabled">
									<option value="Real" <?php echo $this->_tpl_vars['realType']; ?>
 >Real</option>
								</select>
							</td>
				<td align='left'><input name='<?php echo $this->_tpl_vars['parTNV'][2]; ?>
' class = '<?php echo $this->_tpl_vars['parTNV'][2]; ?>
' type='text' size="5" value='<?php echo $this->_tpl_vars['parTNV'][3]; ?>
' readonly="readonly" /></td>
				<td align='left'><input name='<?php echo $this->_tpl_vars['parTNV'][4]; ?>
'  class='<?php echo $this->_tpl_vars['parTNV'][4]; ?>
' type='text' size="5" value='<?php echo $this->_tpl_vars['parTNV'][5]; ?>
' /></td>
						</tr>
					<?php else: ?>
						<tr class='p<?php echo $this->_tpl_vars['i']+1; ?>
'>
						<td class='parTypTd<?php echo $this->_tpl_vars['i']+1; ?>
' align='left' >
						<select class="TypParam" <?php echo $this->_tpl_vars['selectDis']; ?>
>
						<option value="Real" <?php echo $this->_tpl_vars['realType']; ?>
 >Real</option>
						<option value="Integer" <?php echo $this->_tpl_vars['intType']; ?>
>Integer</option>
						<option value="String" <?php echo $this->_tpl_vars['strType']; ?>
 >String</option>
						<option value="Boolean" <?php echo $this->_tpl_vars['boolType']; ?>
 >Boolean</option>
						</select>
						</td>
						<td align='left'><input name='<?php echo $this->_tpl_vars['parTNV'][2]; ?>
' class = '<?php echo $this->_tpl_vars['parTNV'][2]; ?>
' type='text' size="5" value='<?php echo $this->_tpl_vars['parTNV'][3]; ?>
' <?php echo $this->_tpl_vars['disable']; ?>
/></td>
						<td align='left'><input name='<?php echo $this->_tpl_vars['parTNV'][4]; ?>
'  class='<?php echo $this->_tpl_vars['parTNV'][4]; ?>
' type='text' size="5" value='<?php echo $this->_tpl_vars['parTNV'][5]; ?>
' /></td>
						<?php if ($this->_tpl_vars['option'] != 'default'): ?>
							<td align='left'>
							<img class="deleteP<?php echo $this->_tpl_vars['i']+1; ?>
" src="pic/remove.png" alt="<?php echo $this->_tpl_vars['i']+1; ?>
" height="22" style="vertical-align:middle;cursor:pointer;cursor:hand;" />
							
							</td>
						<?php endif; ?>
						</tr>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
				<?php if ($this->_tpl_vars['option'] != 'default'): ?>
  					<tr ><td colspan="5" align="center">
					<button type="button"   class="addPar"  style="padding:5px;">
					<img src="pic/pridat.png" alt="pridat" height="14" style="vertical-align:middle;padding-right:5px;" />
					<div style="display:inline;vertical-align:middle;"><?php echo $this->_tpl_vars['text26']; ?>
</div>
					</button>
					</td></tr>
				<?php endif; ?>
  			</table>
		</div>					
		<div  style="float:right;width:40%;">
			<table  class="vars" cellpadding="5" >
				<tr>
					<th align="left" colspan="5"><?php echo $this->_tpl_vars['text27']; ?>
</th>
				</tr>
  				<tr class="v0">
					<td><?php echo $this->_tpl_vars['text23']; ?>
</td>
					<td><?php echo $this->_tpl_vars['text24']; ?>
</td>
				</tr>
				<?php $_from = $this->_tpl_vars['controller']->var_arr; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['varTN']):
?>
					<?php $this->assign('realType2', ''); ?>
					<?php $this->assign('intType2', ''); ?>
					<?php $this->assign('strType2', ''); ?>
					<?php $this->assign('boolType2', ''); ?>
					<?php $this->assign('tempType', ''); ?>
					<?php $this->assign('intenType', ''); ?>
				
					<?php if ($this->_tpl_vars['parTNV'][1] == 'Real'): ?>
					<?php $this->assign('realType2', 'selected="selected"'); ?>
					<?php elseif ($this->_tpl_vars['varTN'][1] == 'Integer'): ?>
					<?php $this->assign('intType2', 'selected="selected"'); ?>
					<?php elseif ($this->_tpl_vars['varTN'][1] == 'String'): ?>
					<?php $this->assign('strType2', 'selected="selected"'); ?>
					<?php elseif ($this->_tpl_vars['varTN'][1] == 'Boolean'): ?>
					<?php $this->assign('boolType2', 'selected="selected"'); ?>
					<?php endif; ?>
				
					<?php if ($this->_tpl_vars['varTN'][1] == 'udaqOut'): ?>
				<tr class='v<?php echo $this->_tpl_vars['i']+1; ?>
'>
					<td class='varTypTd<?php echo $this->_tpl_vars['i']+1; ?>
' align='left' >
					<select class='TypParam' <?php echo $this->_tpl_vars['selectDis']; ?>
>
						<option value='udaqOut' >udaqOut</option>
					</select></td>
					<td align='left'>
						<input name='<?php echo $this->_tpl_vars['varTN'][2]; ?>
' class = '<?php echo $this->_tpl_vars['varTN'][2]; ?>
' type='text' size="5" value='<?php echo $this->_tpl_vars['varTN'][3]; ?>
' readonly="readonly" /></td>
				</tr>
					<?php elseif ($this->_tpl_vars['varTN'][1] == 'udaqIn'): ?>
				<tr class='v<?php echo $this->_tpl_vars['i']+1; ?>
'>
					<td class='varTypTd<?php echo $this->_tpl_vars['i']+1; ?>
' align='left' > 
					<select class='TypParam' <?php echo $this->_tpl_vars['selectDis']; ?>
>
						<option value='udaqIn' >udaqIn</option>
					</select></td>
					<td align='left' >
						<input name='<?php echo $this->_tpl_vars['varTN'][2]; ?>
' class = '<?php echo $this->_tpl_vars['varTN'][2]; ?>
' type='text' size="5" value='<?php echo $this->_tpl_vars['varTN'][3]; ?>
' readonly="readonly"/>
					</td>
				</tr>
					<?php else: ?>
				<tr class='v<?php echo $this->_tpl_vars['i']+1; ?>
'>
					<td class='varTypTd<?php echo $this->_tpl_vars['i']+1; ?>
' align='left' >
					<select class='TypParam' <?php echo $this->_tpl_vars['selectDis']; ?>
>
					<option value='Real' <?php echo $this->_tpl_vars['realType2']; ?>
 >Real</option>
					<option value='Integer' <?php echo $this->_tpl_vars['intType2']; ?>
>Integer</option>
					<option value='String' <?php echo $this->_tpl_vars['strType2']; ?>
 >String</option>
					<option value='Boolean' <?php echo $this->_tpl_vars['boolType2']; ?>
 >Boolean</option>
					</select>
					</td>
					<td align='left'><input name='<?php echo $this->_tpl_vars['varTN'][2]; ?>
' class = '<?php echo $this->_tpl_vars['varTN'][2]; ?>
' type='text' size="5" value='<?php echo $this->_tpl_vars['varTN'][3]; ?>
' <?php echo $this->_tpl_vars['disable']; ?>
 /></td>
					<?php if ($this->_tpl_vars['option'] != 'default'): ?>
						<td align='left'> 
				<img class="deleteV<?php echo $this->_tpl_vars['i']+1; ?>
" src="pic/remove.png" alt="<?php echo $this->_tpl_vars['i']+1; ?>
" height="22" style="vertical-align:middle;cursor:pointer;cursor:hand;" />
						</td>
					<?php endif; ?>
				</tr>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?> 
				<?php if ($this->_tpl_vars['option'] != 'default'): ?>
  				<tr ><td colspan="5" align="center">
						<button type="button"   class="addVar"  style="padding:5px;">
						<img src="pic/pridat.png" alt="pridat" height="14" style="vertical-align:middle;padding-right:5px;" />
						<div style="display:inline;vertical-align:middle;"><?php echo $this->_tpl_vars['text26']; ?>
</div>
						</button>
					</td>
				</tr>
				<?php endif; ?>
  			</table>
		</div>
	<div style="clear:both;" ></div>

	<?php if ($this->_tpl_vars['option'] == 'default'): ?>
		<?php $this->assign('textareaStyle', 'display:none'); ?>
	<?php endif; ?>
	<div  style="<?php echo $this->_tpl_vars['textareaStyle']; ?>
;"><hr />
		<div style="float:left;width:30%;" ><b><?php echo $this->_tpl_vars['text28']; ?>
</b></div>
		<div style="float:right;width:70%;"><textarea  class="contEq" rows="8" cols="50"><?php echo $this->_tpl_vars['controller']->equation; ?>
</textarea></div>
		<div style="clear:both;" ></div>
	</div>
	<hr />
	<div style="float:left;width:30%;" ><b><?php echo $this->_tpl_vars['text29']; ?>
</b></div>
	<div style="float:right;width:70%;"><textarea class="contStr" name="contStr" id="contStr" rows="8" cols="50"  readonly="readonly"></textarea></div>
	<div style="clear:both;" ></div>	
</fieldset>	

<br />
	<fieldset>	
		<legend><?php echo $this->_tpl_vars['text133']; ?>
</legend>
		<div class="footer_nav" style="text-align:center;">
		<table align="center" cellpadding="20">
			<tr>
				<td><a  href="index.php?page=9"><img height="32" src="pic/backIcon.png"  alt="backBtn" /><br /><?php echo $this->_tpl_vars['text81']; ?>
</a></td>
				<?php if ($this->_tpl_vars['user']): ?>
				<td><div  class='defCont' ><img src="pic/default.png"  alt="defaultCont" /><br /><?php echo $this->_tpl_vars['text30']; ?>
</div></td>
				<?php if (( $this->_tpl_vars['option'] != 'default' || $this->_tpl_vars['user']->permission < 2 )): ?>
				<td>					
					<div class='saveModel'  ><img src="pic/ulozenieIcon.png"  alt="saveCont" height="32" />
					<br /><?php echo $this->_tpl_vars['text31']; ?>
</div>
				</td>
				<?php endif; ?>
				<?php if (( $this->_tpl_vars['option'] != 'default' || $this->_tpl_vars['user']->permission < 2 ) && $this->_tpl_vars['option'] != 'add'): ?>
				<td>
					<div onclick="deleteWarn(<?php echo $this->_tpl_vars['controller']->type; ?>
,<?php echo $this->_tpl_vars['controller']->id; ?>
)" class='clearModel'>
					<img alt="remove" src="pic/remove.png" /><br /><?php echo $this->_tpl_vars['text32']; ?>
</div>
				</td>
				<?php endif; ?>
					<?php if ($this->_tpl_vars['option'] != 'add'): ?>
				<td>
					<div class="runExp" >
					<img alt="startExp" height="32" src="pic/start.png" /><br /><?php echo $this->_tpl_vars['text33']; ?>
</div>
				</td>
					<?php endif; ?>
				<?php endif; ?>
			</tr>
		</table>
		</div> 
	</fieldset>
</form>
</div>