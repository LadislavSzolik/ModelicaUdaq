<?php /* Smarty version 2.6.25, created on 2011-04-06 01:17:22
         compiled from reservation_all.tpl */ ?>
<div class="content_inner">
	<style type='text/css'>
		@import url(skript/weekcalendar/libs/css/smoothness/jquery-ui-1.8.9.custom.css);
		@import url(skript/weekcalendar/demo.css);
		@import url(skript/weekcalendar/jquery.weekcalendar.css);
		@import url(skript/js/popup/jquery.bubblepopup.v2.3.1.css);
	</style>
	<script type='text/javascript' src='skript/weekcalendar/libs/jquery-ui-1.8.9.custom.min.js'></script>
	<script type='text/javascript' src='skript/weekcalendar/jquery.weekcalendar.js'></script>
	<script type='text/javascript' src='skript/js/date.format.js'></script>
	<script type='text/javascript' src='skript/js/jquery.corner.js'></script>
<script type='text/javascript'>
	<?php echo '
	var year = new Date().getFullYear();
	var month = new Date().getMonth();
	var day = new Date().getDate();
	var eventDataAll = {
		events : [
		/*'; ?>

		<?php if ($this->_tpl_vars['list'] != -1): ?>
			<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
 (id.:<?php echo $this->_tpl_vars['v']->user_id; ?>
)<div style='display:inline' ></div><?php echo '",
				"user_id":"'; ?>
<?php echo $this->_tpl_vars['v']->user_id; ?>
<?php echo '",
				'; ?>
<?php if ($this->_tpl_vars['v']->user_name != $this->_tpl_vars['curruser'] && $this->_tpl_vars['user']['role'] > 2): ?><?php echo ',readOnly : true'; ?>
<?php endif; ?><?php echo '
			},'; ?>

			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
		<?php echo '*/
		]
	};
	var eventData = eventDataAll;

	$(document).ready(function() {
		
		//alert(new Date("Mon Feb 28 2011 10:30:00 GMT+0100 (CET)").format("yyyy/mm/dd HH:MM:ss"));

		$(\'#close\').click(function(){$(\'#properties\').css("display","none");});
		$(\'#properties\').draggable();
		$(\'#properties\').corner("round","10px");
		$(\'#prop_header\').corner("round","5px");

		$(\'#button_filter_all\').click(function(){
			$(\'#calendar\').weekCalendar({data:eventDataAll});
			$(\'#calendar\').weekCalendar("refresh");
		});



		$(\'#calendar\').weekCalendar({
			timeslotsPerHour: 1,
			timeFormat: "H:i",
			dateFormat: "M. j.",
			timeSeparator: " - ",
			businessHours: false,
			allowCalEventOverlap : false,
			height: function($calendar){
				//return $(window).height() - $("h1").outerHeight();
				return 600;
			},

			eventRender : function(calEvent, $event) {
				$event.css("backgroundColor", calEvent.color);
	
//				$(\'.wc-time\').css("backgroundColor", calEvent.color);
//				$(\'.ui-corner-all\').css("backgroundColor", calEvent.color);
				//if(calEvent.param == \'fluid\')$event.css("backgroundColor", $(\'.color_hydro\').css("backgroundColor"));
				//if(calEvent.param == \'udaq28/lt\')$event.css("backgroundColor", $(\'.color_udaq\').css("backgroundColor"));
				if(calEvent.end.getTime() < new Date().getTime()) {
					$event.css("backgroundColor", "#aaa");
					//$event.find(".time").css({"backgroundColor": "#999", "border":"1px solid #888"});
				}

				//popup
				$event.CreateBubblePopup({
						position : \'right\',
						align	 : \'bottom\',
						tail	 : {align: \'top\'},
						innerHtml: \'<b>id: \'+calEvent.id+\'</b><br  />\'+calEvent.title,
								innerHtmlStyle: {
									\'text-align\':\'center\'
								},
						themeName: 	\'azure\',
						themePath: 	\'scripts/js/popup/jquerybubblepopup-theme\',

					}); 
			},
			eventNew : function(calEvent, $event) {
				$(\'#r_id\').html("<b>new</b>");
				$(\'#u_id\').html("<b>'; ?>
<?php echo $this->_tpl_vars['user']['Meno']; ?>
 <?php echo $this->_tpl_vars['user']['Priezvisko']; ?>
<?php echo '</b>");
				$(\'#time_from\').html("<input type=\'text\' name=\'time_from\' value=\'"+(new Date(calEvent.start).format("yyyy/mm/dd HH:MM:ss"))+"\' />");
				$(\'#time_to\').html("<input type=\'text\' name=\'time_to\' value=\'"+(new Date(calEvent.end).format("yyyy/mm/dd HH:MM:ss"))+"\' />");
				$(\'#f\').attr("action","'; ?>
<?php echo $this->_tpl_vars['root_link']; ?>
<?php echo '/scripts/reservation_new.php");
				$(\'#submitter\').css("visibility","visible");
				$(\'#d_button\').css("visibility","hidden");
				$(\'#s_button\').click(function(){submit_form(calEvent, $event);});
				$(\'#properties\').css({"display":"block", "left":(($(window).width()-300)/2), "top":(($(window).height()-$(\'#properties\').height())/2)});
			},
			eventDrop : function(calEvent, $event) {
				//displayMessage("<strong>Moved Event</strong><br/>Start: " + calEvent.start + "<br/>End: " + calEvent.end);
				viewProps(calEvent, $event);
			},
			eventResize : function(calEvent, $event) {
				//displayMessage("<strong>Resized Event</strong><br/>Start: " + calEvent.start + "<br/>End: " + calEvent.end);
				viewProps(calEvent, $event);
			},
			eventClick : function(calEvent, $event) {
				//displayMessage("<strong>Clicked Event</strong><br/>Start: " + calEvent.start + "<br/>End: " + calEvent.end);
				viewProps(calEvent, $event);
			},
			eventMouseover : function(calEvent, $event) {
				//displayMessage("<strong>Mouseover Event</strong><br/>Start: " + calEvent.start + "<br/>End: " + calEvent.end);
			},
			eventMouseout : function(calEvent, $event) {
				//displayMessage("<strong>Mouseout Event</strong><br/>Start: " + calEvent.start + "<br/>End: " + calEvent.end);
			},
			noEvents : function() {
				//displayMessage("There are no events for this week");
			},
			draggable : function(calEvent, $event) {
				return calEvent.readOnly != true;
			},
			resizable : function(calEvent, $event) {
				return calEvent.readOnly != true;
			},
			longDays :[\'Nedeľa\',\'Pondelok\',\'Utorok\',\'Streda\',\'Štvrtok\',\'Piatok\',\'Sobota\'],
			buttonText: {
				today: \'dnes\'
			},
			calendarAfterLoad :function(calEvent, $event) {

			},
			use24Hour : true,
			firstDayOfWeek : 1,
			data:eventData
		});

		function viewProps(calEvent, $event) {
			//displayMessage("<strong>Clicked Event</strong><br/>Start: " + calEvent.start + "<br/>End: " + calEvent.end);
			//window.location="'; ?>
<?php echo $this->_tpl_vars['home_link']; ?>
<?php echo '?page=7&reserv_id="+calEvent.id;
			dayOverlapTest(calEvent, $event);
			if(calEvent.readOnly != true){
				$(\'#r_id\').html("<b>"+calEvent.id+"</b>");
				$(\'#u_id\').html("<b>"+calEvent.title+"</b>");
				$(\'#time_from\').html("<input type=\'text\' name=\'time_from\' value=\'"+(new Date(calEvent.start).format("yyyy/mm/dd HH:MM:ss"))+"\' />");
				$(\'#time_to\').html("<input type=\'text\' name=\'time_to\' value=\'"+(new Date(calEvent.end).format("yyyy/mm/dd HH:MM:ss"))+"\' />");
				$(\'#h_id\').attr("value",calEvent.id);
				$(\'#h_user_id\').attr("value",calEvent.user_id);
				$(\'#f\').attr("action","'; ?>
<?php echo $this->_tpl_vars['root_link']; ?>
<?php echo '/scripts/reservation_edit_act.php");
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
			//var rez="";
			//for(var key in $event){rez+=\' =\'+$event[key];}displayMessage(rez);
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
				alert("Warning: Reservations can\'t overlap one day!");
				window.location.reload();
			}
		}

		function submit_form(calEvent, $event){
			dayOverlapTest(calEvent, $event);
			document.f.submit();
		}

		$(\'#close\').click(function(){window.location.reload();});

		function displayMessage(message) {
			$("#message").html(message).fadeIn();
		}

		$("<div id=\\"message\\" class=\\"ui-corner-all\\"></div>").prependTo($("body"));
		
	});	
	'; ?>

</script>

	<script type="text/javascript" language="JavaScript">
	<?php echo '
		function deleteWarn(calEvent){
			var response = confirm(\'Naozaj chcete vymazať recerváciu \\nod: \'+
						(new Date(calEvent.start).format("yyyy/mm/dd HH:MM:ss"))+
						\'\\ndo: \'+
						(new Date(calEvent.end).format("yyyy/mm/dd HH:MM:ss"))+
						\' ?\');
			if(response){
				window.location = "'; ?>
<?php echo $this->_tpl_vars['home_link']; ?>
<?php echo '?page=9&reserv_id="+calEvent.id;
			}
		}
		function addNewReserv(){
			$(\'#r_id\').html("<b>new</b>");
			$(\'#u_id\').html("<b>'; ?>
<?php echo $this->_tpl_vars['user']['Meno']; ?>
 <?php echo $this->_tpl_vars['user']['Priezvisko']; ?>
<?php echo '</b>");
			$(\'#time_from\').html("<input type=\'text\' name=\'time_from\' value=\' />");
			$(\'#time_to\').html("<input type=\'text\' name=\'time_to\' value=\'\' />");
			$(\'#f\').attr("action","'; ?>
<?php echo $this->_tpl_vars['root_link']; ?>
<?php echo '/scripts/reservation_new.php");
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
					alert("Warning: Reservations can\'t overlap one day!");
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
	'; ?>

	</script>
	<h1>Rezervácie</h1>
	<div id='calendar'></div>
	<div style="float:left;">
		<button id="button_filter_all">Všetky</button>
	</div>
	<div style="float:right;">
		<button onclick="addNewReserv()">Pridať</button>
	</div>
	<div style="clear:both;"></div>

	<div id="properties" style="width:300px; background:#fff; border-left:#E5C388 2px solid; border-right:#E5C388 2px solid; border-bottom:#E5C388 2px solid; position:absolute; top:30px; left:30px; display:none;">
		<div id="prop_header" style="background:#000; color:#66cc33;">
			<div style="float:left; padding:5px;"><b>Properties</b></div><div style="float:right; padding-right:7px; padding-top:5px;"><img id="close" alt="view" src="pic/remove.png" height="15px" /></div>
			<div style="clear:both;"></div>
		</div>
		<form id="f" action="#" name="f" method="POST" style="padding:5px;">
			<table>
				<tr>
					<td>Id rezervácie: </td><td id="r_id"></td>
				</tr>
				<tr>
					<td>Užívateľ: </td><td id="u_id"></td>
				</tr>
				<tr>
					<td>Od: </td><td id="time_from" ></td>
				</tr>
				<tr>
					<td>Do: </td><td id="time_to" ></td>
				</tr>
			</table>
			<div id="hidden_info" style="display:none;">
				<input id="h_id" type="hidden" name="id" value="" />
				<input id="h_user_id" type="hidden" name="user_id" value="" />
			</div>
		</form>
			<table style="width:100%;">
				<tr id="submitter" style="visibility:hidden;">
					<td>&nbsp;</td><td style="text-align:right;"><button id="d_button">Vymazať</button><button id="s_button">OK</button></td>
				</tr>
			</table>
	</div>
	<br />
</div>