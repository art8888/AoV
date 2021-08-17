function startTimer2(){
	$(document).ready(function(){
		setInterval(function(){
			$("#wood_r").html(Math.floor(wood_r+=wood_s));
			$("#stone_r").html(Math.floor(stone_r+=stone_s));
			$("#iron_r").html(Math.floor(iron_r+=iron_s));
		},1000);
	});
}

var resis = new Object();
var timers = new Array();
var timeDiff = null;

function addTimer(element, endTime, mode, reload){
	var timer = new Object();
	timer['element'] = element;
	timer['endTime'] = endTime;
	timer['reload'] = reload;
	timer['mode'] = mode;
	timers.push(timer);
}
function startTimer(){
	var serverTime = getTime(document.getElementById("serverTime"));
	timeDiff = serverTime-getLocalTime();
	timeStart = serverTime;

	var spans = document.getElementsByTagName("span");
	for(var span_id in spans){
		var span = spans[span_id];
		if(span.className == "timer" || span.className == "timer_replace"){
			startTime = getTime(span);
			if(startTime != -1){
				addTimer(span, serverTime+startTime, false, (span.className == "timer"));
			}
		}

		if(span.className == "relative_time"){
			startTime = getTime(span);
			if(startTime != -1){
				addTimer(span, startTime, true, (span.className == "timer"));
			}
		}
	}

	startResTicker('wood');
	startResTicker('stone');
	startResTicker('iron');

	window.setInterval("tick()", 1000);
}
function startResTicker(resName){
	var element = document.getElementById(resName);
	var start = parseInt(element.firstChild.nodeValue);
	var max = parseInt(document.getElementById("storage").firstChild.nodeValue);
	var prod = element.title/3600;

	var res = new Object();
	res['name'] = resName;
	res['start'] = start;
	res['max'] = max;
	res['prod'] = prod;
	resis[resName] = res;
}
function tickRes(res){
	var resName = res['name'];
	var start = res['start'];
	var max = res['max'];
	var prod = res['prod'];

	var now = new Date();
	var time = (now.getTime()/1000+timeDiff)-timeStart;
	current = Math.min(Math.floor(start+prod*time), max);
	var element = document.getElementById(resName);
	element.firstChild.nodeValue = current;

	if(current == max){
		element.setAttribute('class', 'warn');
	}
}
function tick(){
	tickTime();

	for(var res in resis){
		tickRes(resis[res]);
	}
	for(var timer in timers){
		remove = tickTimer(timers[timer]);
		if(remove){
			timers.splice(timer, 1);
		}
	}
}
function tickTime(){
	var serverTime = document.getElementById("serverTime");
	if(serverTime != null){
		time = getLocalTime()+timeDiff;
		formatTime(serverTime, time, true);
	}
}
function tickTimer(timer){
	if(timer['mode']){
		var time = timer['endTime']+(getLocalTime()+timeDiff)-3600;
	}else{
		var time = timer['endTime']-(getLocalTime()+timeDiff);
	}

	
	

	if(timer['reload'] && time < 0){
		document.location.href = document.location.href;
		formatTime(timer['element'], 0, false);
		return true;
	}
	
	if(!timer['reload'] && time <= 0){
		var parent = timer['element'].parentNode;
		parent.nextSibling.style.display = 'inline';
		parent.parentNode.removeChild(parent);

		return true;
	}

	formatTime(timer['element'], time, false);
	return false;
}
function getLocalTime(){
	var now = new Date();
	return Math.floor(now.getTime()/1000)
}
function getTime(element){
	if(element.firstChild.nodeValue == null){
		return -1;
	}
	part = element.firstChild.nodeValue.split(":");

	for(j = 1; j < 3; j++){
		if(part[j].charAt(0) == "0")
			part[j] = part[j].substring(1, part[j].length);
	}

	hours = parseInt(part[0]);
	minutes = parseInt(part[1]);
	seconds = parseInt(part[2]);
	time = hours*60*60+minutes*60+seconds;
	return time;
}
function formatTime(element, time, clamp){
	hours = Math.floor(time/3600);
	if(clamp){
		hours = hours%24;
	}
	minutes = Math.floor(time/60)%60;
	seconds = time%60;

	timeString = hours + ":";
	if(minutes < 10){
		timeString += "0";
	}
	timeString += minutes + ":";
	if(seconds < 10){
		timeString += "0";
	}
	timeString += seconds;

	element.firstChild.nodeValue = timeString;
}

function showinfo(v, u, ox, oy){
	$("#info").css("visibility","visible");
	$("#info").load('map_popup.php?v='+v+'&u='+u+'&ox='+ox+'&oy='+oy);
}
function hideinfo(x){
	$("#info").css("visibility", "hidden");
}
function showinfo_command(event, id, uf, ut){
	console.log(event.clientX);
	$("#info_troops").css({position:'absolute', top:''+event.clientY+'px', left:''+event.clientX+'', visibility:'visible'});
	$("#info_troops").load('info_troops.php?id='+id+'&f='+uf+'&t='+ut);
}
function hideinfo_command(){
	$("#info_troops").css("visibility", "hidden");
}
function popup(url, width, height){
	wnd = window.open(url, "popup", "width="+width+",height="+height+",left=150, top=150, resizable=yes");
	wnd.focus();
}
function insertUnit(a, c, b){
	if($(a).val() != c || b){
		$(a).val(c)
	}else{
		$(a).val("")
	}
}