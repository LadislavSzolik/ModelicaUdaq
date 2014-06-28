<?php /* Smarty version 2.6.25, created on 2011-05-04 16:08:13
         compiled from reservation.tpl */ ?>

<link rel='stylesheet' type='text/css' href='skript/weekcalendar/libs/css/smoothness/jquery-ui-1.8.9.custom.css' />  
<link rel='stylesheet' type='text/css' href='skript/weekcalendar/jquery.weekcalendar.css' /> 
<link rel="stylesheet" type="text/css" href="skript/weekcalendar/skins/default.css" /> 
<script type='text/javascript' src='skript/js/date.format.js'></script>
<script type='text/javascript' src='skript/js/jquery.corner.js'></script>
<script type='text/javascript' src='skript/weekcalendar/libs/jquery-1.4.4.min.js'></script> 
<script type='text/javascript' src='skript/weekcalendar/libs/jquery-ui-1.8.9.custom.min.js'></script> 
<script type="text/javascript" src="skript/weekcalendar/libs/date.js"></script> 
<script type='text/javascript' src='skript/weekcalendar/jquery.weekcalendar.js'></script> 

<script type="text/javascript">//<![CDATA[<?php echo '
 
	var year = new Date().getFullYear();
	var month = new Date().getMonth();
	var day = new Date().getDate();
 
	var eventData1 = {
			options: {
				timeslotsPerHour: 4,
				timeslotHeight: 20
			},
			events : [
				'; ?>

					<?php if ($this->_tpl_vars['list'] != -1): ?>
						<?php $_from = $this->_tpl_vars['reservationArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
						<?php echo '
						{
							"id":'; ?>
<?php echo $this->_tpl_vars['v']->id; ?>
<?php echo ', 
							"start": new Date("'; ?>
<?php echo $this->_tpl_vars['v']->time_from; ?>
<?php echo '".replace("-","/").replace("-","/")), 
							"end": new Date("'; ?>
<?php echo $this->_tpl_vars['v']->time_to; ?>
<?php echo '".replace("-","/").replace("-","/")),
							"title":"'; ?>
<?php echo $this->_tpl_vars['v']->user_name; ?>
 (id:<?php echo $this->_tpl_vars['v']->user_id; ?>
)<div style='display:inline' ></div><?php echo '",
							"user_id":"'; ?>
<?php echo $this->_tpl_vars['v']->user_id; ?>
<?php echo '"
							'; ?>
<?php if (( $this->_tpl_vars['v']->user_name != $this->_tpl_vars['user']->login ) && $this->_tpl_vars['user']->permission > 2): ?><?php echo ',readOnly : true'; ?>
<?php endif; ?><?php echo '
						},'; ?>

						<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>
				<?php echo '
			]
		};
	   
	$(document).ready(function() {
 
		var $calendar = $(\'#calendar\').weekCalendar({
			timeslotsPerHour: 4,
			scrollToHourMillis : 0,
			height: function($calendar){
				return $(window).height() - $("h1").outerHeight(true);
			},
			eventRender : function(calEvent, $event) {
				if(calEvent.end.getTime() < new Date().getTime()) {
					$event.css("backgroundColor", "#aaa");
					$event.find(".time").css({"backgroundColor": "#999", "border":"1px solid #888"});
				}
			},
			eventNew : function(calEvent, $event) {
				$(\'#r_id\').html("<b>'; ?>
<?php echo $this->_tpl_vars['text90']; ?>
<?php echo '</b>");
				$(\'#u_id\').html("<b>'; ?>
<?php echo $this->_tpl_vars['user']->name; ?>
&nbsp;<?php echo $this->_tpl_vars['user']->surname; ?>
<?php echo '</b>");
				$(\'#time_from\').html("<input type=\'text\' name=\'time_from\' value=\'"+(new Date(calEvent.start).format("yyyy/mm/dd HH:MM:ss"))+"\' />");
				$(\'#time_to\').html("<input type=\'text\' name=\'time_to\' value=\'"+(new Date(calEvent.end).format("yyyy/mm/dd HH:MM:ss"))+"\' />");
				$(\'#f\').attr("action","index.php?page=10&add_rez=true");
				$(\'#submitter\').css("visibility","visible");
				$(\'#d_button\').css("visibility","hidden");
				$(\'#s_button\').click(function(){submit_form(calEvent, $event);});
				$(\'#properties\').css({"display":"block", "left":(($(window).width()-300)/2), "top":(($(window).height()-$(\'#properties\').height())/2)});
			},
			eventDrop : function(calEvent, $event) {				
				viewProps(calEvent, $event);
			},
			eventResize : function(calEvent, $event) {				
				viewProps(calEvent, $event);
			},
			eventClick : function(calEvent, $event) {				
				viewProps(calEvent, $event);
			},
			eventMouseover : function(calEvent, $event) {				
			},
			eventMouseout : function(calEvent, $event) {				
			},
			noEvents : function() {
			},
			draggable : function(calEvent, $event) {
				return calEvent.readOnly != true;
			},
			resizable : function(calEvent, $event) {
				return calEvent.readOnly != true;
			},
			longDays :[\''; ?>
<?php echo $this->_tpl_vars['text91']; ?>
<?php echo '\',\''; ?>
<?php echo $this->_tpl_vars['text92']; ?>
<?php echo '\',\''; ?>
<?php echo $this->_tpl_vars['text93']; ?>
<?php echo '\',\''; ?>
<?php echo $this->_tpl_vars['text94']; ?>
<?php echo '\',\''; ?>
<?php echo $this->_tpl_vars['text95']; ?>
<?php echo '\',\''; ?>
<?php echo $this->_tpl_vars['text96']; ?>
<?php echo '\',\''; ?>
<?php echo $this->_tpl_vars['text97']; ?>
<?php echo '\'],
			buttonText: {
				today: \''; ?>
<?php echo $this->_tpl_vars['text98']; ?>
<?php echo '\'
			},
			calendarAfterLoad :function(calEvent, $event) {
			},
			use24Hour : true,
			firstDayOfWeek : 1,
			data: function(start, end, callback) { 
				callback(eventData1);
            }
		});

 			function viewProps(calEvent, $event) {
			dayOverlapTest(calEvent, $event);
			if(calEvent.readOnly != true){
				$(\'#r_id\').html("<b>"+calEvent.id+"</b>");
				$(\'#u_id\').html("<b>"+calEvent.title+"</b>");
				$(\'#time_from\').html("<input type=\'text\' name=\'time_from\' value=\'"+(new Date(calEvent.start).format("yyyy/mm/dd HH:MM:ss"))+"\' />");
				$(\'#time_to\').html("<input type=\'text\' name=\'time_to\' value=\'"+(new Date(calEvent.end).format("yyyy/mm/dd HH:MM:ss"))+"\' />");
				$(\'#h_id\').attr("value",calEvent.id);
				$(\'#h_user_id\').attr("value",calEvent.user_id);
				$(\'#f\').attr("action","index.php?page=10&add_rez=true");
				$(\'#d_button\').css("visibility","visible");
				$(\'#d_button\').click(function(){deleteWarn(calEvent);});
				$(\'#s_button\').click(function(){submit_form(calEvent, $event);});
				$(\'#submitter\').css("visibility","visible");
			}else{
				$(\'#r_id\').html("<b>"+calEvent.id+"</b>");
				$(\'#u_id\').html("<b>"+calEvent.title+"</b>");
				$(\'#time_from\').html(new Date(calEvent.start).format("yyyy/mm/dd HH:MM:ss"));
				$(\'#time_to\').html(new Date(calEvent.end).format("yyyy/mm/dd HH:MM:ss"));
				$(\'#submitter\').css("visibility","hidden");
			}
			$(\'#properties\').css({
				"display":"block",
				"left":(($(window).width()-300)/2),
				"top":(($(window).height()-$(\'#properties\').height())/2)
			});
		}

		function dayOverlapTest(calEvent, $event){
			var d1 = (new Date(calEvent.start).format("dd"));
			var d2 = (new Date(calEvent.end).format("dd"));
			var m1 = (new Date(calEvent.start).format("mm"));
			var m2 = (new Date(calEvent.end).format("mm"));
			var y1 = (new Date(calEvent.start).format("yyyy"));
			var y2 = (new Date(calEvent.end).format("yyyy"));
			if(d1 != d2 || m1 != m2 || y1 != y2){
				alert("'; ?>
<?php echo $this->_tpl_vars['text99']; ?>
<?php echo '");
				window.location.reload();
			}
		}

		function submit_form(calEvent, $event){
			dayOverlapTest(calEvent, $event);
			document.f.submit();
		}
		$(\'#close\').click(function(){window.location.reload();});
	});
 
		function deleteWarn(calEvent){
			var response = confirm(\''; ?>
<?php echo $this->_tpl_vars['text100']; ?>
<?php echo ' \\n'; ?>
<?php echo $this->_tpl_vars['text104']; ?>
<?php echo ': \'+
						(new Date(calEvent.start).format("yyyy/mm/dd HH:MM:ss"))+
						\'\\n'; ?>
<?php echo $this->_tpl_vars['text105']; ?>
<?php echo ': \'+
						(new Date(calEvent.end).format("yyyy/mm/dd HH:MM:ss"))+
						\' ?\');
			if(response){
				window.location = "index.php?page=10&delete=true&reserv_id="+calEvent.id;
			}
		}
		function addNewReserv(){
			$(\'#r_id\').html("<b>'; ?>
<?php echo $this->_tpl_vars['text90']; ?>
<?php echo '</b>");
			$(\'#u_id\').html("<b>'; ?>
<?php echo $this->_tpl_vars['user']->name; ?>
 <?php echo $this->_tpl_vars['user']->surname; ?>
<?php echo '</b>");
			$(\'#time_from\').html("<input type=\'text\' name=\'time_from\' value=\'\' />");
			$(\'#time_to\').html("<input type=\'text\' name=\'time_to\' value=\'\' />");
			$(\'#f\').attr("action","index.php?page=10&add_rez=true");
			$(\'#submitter\').css("visibility","visible");
			$(\'#d_button\').css("visibility","hidden");
			$(\'#s_button\').click(function(){
				var f = document.f;
				var d1 = (new Date(f.time_from.value).format("dd"));
				var d2 = (new Date(f.time_to.value).format("dd"));
				var m1 = (new Date(f.time_from.value).format("mm"));
				var m2 = (new Date(f.time_to.value).format("mm"));
				var y1 = (new Date(f.time_from.value).format("yyyy"));
				var y2 = (new Date(f.time_to.value).format("yyyy"));
				if(d1 != d2 || m1 != m2 || y1 != y2){
					alert("'; ?>
<?php echo $this->_tpl_vars['text99']; ?>
<?php echo '");
					window.location.reload();
				}
				f.submit();
			});
			$(\'#properties\').css({
				"display":"block",
				"left":(($(window).width()-300)/2),
				"top":(($(window).height()-$(\'#properties\').height())/2)
			});
		}
//]]></script>'; ?>

	<fieldset>
		<legend><?php echo $this->_tpl_vars['text88']; ?>
</legend>
		<div style="float:right;">
			<button onclick="addNewReserv()"><?php echo $this->_tpl_vars['text101']; ?>
</button>
		</div>
		<div id='calendar'></div> 
		<div id="properties" style="width:300px; background:#fff; border-left:navy 2px solid; border-right:navy 2px solid; border-bottom:navy 2px solid; position:absolute; top:30px; left:30px; display:none;">
			<div id="prop_header" style="background:navy; color:#fff;">			
				<div style="float:left; padding:5px;"><b><?php echo $this->_tpl_vars['text108']; ?>
</b></div><div style="float:right; padding-right:7px; padding-top:5px;"><img id="close" alt="view" src="pic/remove.png" height="15px" /></div>
				<div style="clear:both;"></div>
			</div>
			<form id="f" action="#" name="f" method="post" style="padding:5px;">
				<table>
					<tr>
						<td><?php echo $this->_tpl_vars['text102']; ?>
: </td><td id="r_id"></td>
					</tr>
					<tr>
						<td><?php echo $this->_tpl_vars['text103']; ?>
: </td><td id="u_id"></td>
					</tr>
					<tr>
						<td><?php echo $this->_tpl_vars['text104']; ?>
: </td><td id="time_from" ></td>
					</tr>
					<tr>
						<td><?php echo $this->_tpl_vars['text105']; ?>
: </td><td id="time_to" ></td>
					</tr>
				</table>
				<div id="hidden_info" style="display:none;">
					<input id="h_id" type="hidden" name="id" value="" />
					<input id="h_user_id" type="hidden" name="user_id" value="" />
				</div>
			</form>
				<table style="width:100%;">
					<tr id="submitter" style="visibility:hidden;">
						<td>&nbsp;</td><td style="text-align:right;">
							<button id="d_button"><?php echo $this->_tpl_vars['text106']; ?>
</button>
							<button id="s_button" ><?php echo $this->_tpl_vars['text107']; ?>
</button></td>
					</tr>
				</table>
		</div>
	</fieldset>