<?php

function generate_key() {
	return md5(microtime().serialize($_SERVER));
}

function parse($str) {
	$str = urlencode($str);
	$str = trim($str);
	return $str;
}

function entparse($str) {
	$str = urldecode($str);
	$str = stripslashes($str);
	$str = htmlspecialchars($str);
	return $str;
}

function get_server_speed($type){
	global $db;
	global $prefix;
	return $db->fetch($db->query("SELECT * FROM worlds WHERE db='".$prefix."'"))[$type];
}

function server_turn(){
	global $db;
	global $prefix;

	$turn_time = $db->fetch($db->query("SELECT turn_time FROM worlds WHERE db='".$prefix."'"))['turn_time'];
	if(time() >= $turn_time){
        $result = true;
		$db->query("UPDATE worlds SET turn='1', turn_time='".(time()+(10))."' WHERE db='".$prefix."'");
	}
}

function update_server(){
	global $db;
	global $prefix;

	return $db->query("UPDATE worlds SET turn='0' WHERE db='".$prefix."'");
}

function get_turn(){
	global $db;
	global $prefix;
	return $db->fetch($db->query("SELECT * FROM worlds WHERE db='".$prefix."'"))['turn'];
}

function format_time($sek){
    $std = 3600;
    $min = 60;
    $anzahl_std = 0;
    while($std <= $sek){
		$sek -= $std;
		++$anzahl_std;
	}
	$anzahl_min = 0;
	while($min <= $sek){
		$sek -= $min;
		++$anzahl_min;
	}
	return sprintf("%01s", $anzahl_std).":".sprintf("%02s", $anzahl_min).":".sprintf("%02s", $sek);
}

function relative_time($time){
	return date("G:i:s", $time);
}
function format_date($stamp, $show_sek="false"){
	$today_day = date("d", $time = time());
	$tomorrow_day = date("d", $time + 86400);
	$return = "";
	if($today_day == date("d", $stamp)){
		$return = "today";
	}elseif($tomorrow_day == date("d", $stamp)){
		$return = "tomorrow";
	}else{
		$return = "on ".date("d.m", $stamp);
	}
	if($show_sek){
		$return .= " at ".date("G:i:s", $stamp)." Hrs";
	}else{
		$return .= " at ".date("G:i", $stamp)." Hrs";
	}
	return $return;
}

function relative_date($stamp) {
	$today_day = date("d", $time = time());
	$tomorrow_day = date("d", $time + 86400);
	$return = "";
	if($today_day == date("d", $stamp)){
		$return = "today";
	}elseif($tomorrow_day == date("d", $stamp)){
		$return = "tomorrow";
	}else{
		$return = "on ".date("d.m", $stamp);
	}
	return $return;
}

function generate_coords(){
	global $config;
	global $db;
	global $prefix;

	$o = 0;
	$ov = 0;
	$free = 0;
	
	$datas = $db->fetch($db->query("SELECT radius, density, dimension, i FROM worlds WHERE db='".$prefix."'"));

	$origin['x'] = $datas['dimension']/2;
	$origin['y'] = $datas['dimension']/2;

	$ax = array();
	$ay = array();
	$type = array();

	$rows = $db->query("SELECT x, y, type, locked FROM ".$prefix."map");
	while($row = $db->fetch($rows)){
		$p['x'] = $row['x'];
		$p['y'] = $row['y'];

		$xf = $origin['x']+$datas['i']*$datas['radius'];
		$yf = $origin['y']+$datas['i']*$datas['radius'];

		if(ring($origin['x'], $origin['y'], $p, $xf, $yf, $datas['radius'])){
			if($row['locked'] == '1'){
				$o++;

				if($row['type'] == 'v'){
					$ov++;
				}
			}

			if(($row['type'] == 'e')&&($row['locked'] == '0')){
				$free++;
				array_push($ax, $p['x']);
				array_push($ay, $p['y']);
			}
		}
	}

	$total_density = density($free, $datas['density']);

	if($ov >= $total_density){
		$db->query("UPDATE worlds SET i=i+1 WHERE db='".$prefix."'");
	}
	return array('x'=>$ax, 'y'=>$ay);
}

function distance($ox, $oy, $x, $y){
	return sqrt(pow(($ox-$x),2)+pow(($oy-$y),2));
}

function ring($ox, $oy, $p, $xf, $yf, $r){
	if( ( (distance($ox, $oy, $p['x'], $p['y']))>=(distance($ox, $oy, $xf, $yf)-$r)  )&&( (distance($ox, $oy, $p['x'], $p['y']))<=(distance($ox, $oy, $xf, $yf)) )     ){
		return true;
	}
}
function density($n, $den){
	return floor(($den/100)*$n);
}
function randomizer($min, $max, $q){
	$numbers = range($min, $max);
	shuffle($numbers);
	return array_slice($numbers, 0, $q);
}

function create_village($user, $username, $x, $y, $bonus, $bt){
	global $db;
	global $prefix;

	if($bonus){
		$image = 'b1';
		$name = 'Bonus';
	} else {
		$image = 'v1';
		$name = 'Village ';
	}

	if($user == '-1'){
		$image .= '_left';
		$name .= 'Barbarian'; 
	} else {
		$name .= $username;
		$image = 'v1';
	}
    
    $db->query("UPDATE ".$prefix."map SET image='".$image."', type='v', locked='1' WHERE x='".$x."' AND y='".$y."'");
	$db->query("INSERT INTO ".$prefix."villages (userid, name, x, y, bonus) VALUES ('".$user."', '".$name."', '".$x."', '".$y."', '".$bt."')");
	$id = $db->getlastid();
	$db->query("INSERT INTO ".$prefix."unit_place (villages_from_id, villages_to_id, player_from_id, player_to_id) VALUES ('".$id."', '".$id."', '".$user."', '".$user."')");
	
}

function add_village($id){
	global $db;
	global $prefix;
	return $db->query("UPDATE ".$prefix."users SET villages=villages+1 WHERE userid='".$id."'");
}

function getVillageDatas($village){
	global $db;
	global $prefix;
	return $db->fetch($db->query("SELECT * FROM ".$prefix."villages WHERE id='".$village."'"));
}

function getPlayerDatas($id){
	global $db;
	global $prefix;
	return $db->fetch($db->query("SELECT * FROM ".$prefix."users WHERE userid='".$id."'"));
}

function create_user($id){
	global $db;
	global $prefix;
	$datas = $db->fetch($db->query("SELECT username FROM users WHERE id='".$id."'"));
	return $db->query("INSERT INTO ".$prefix."users (userid, username) VALUES ('".$id."', '".$datas['username']."')");
	
}

function getfirstvillage($userid){
	global $db;
	global $prefix;
	return $db->fetch($db->query("SELECT id FROM ".$prefix."villages WHERE userid='".$userid."' ORDER BY RAND() LIMIT 1"))['id'];
}

function is_building($id){
	global $db;
	global $prefix;
	return ($db->fetch($db->query("SELECT COUNT(id) AS nb FROM ".$prefix."buildings WHERE villageid='".$id."'"))['nb'] >= 1) ? true : false;
}

function is_recruting_b($id){
	global $db;
	global $prefix;
	return ($db->fetch($db->query("SELECT COUNT(id) AS nb FROM ".$prefix."recruit WHERE villageid='".$id."' AND building='barracks'"))['nb'] >= 1) ? true : false;
}
function is_recruting_s($id){
	global $db;
	global $prefix;
	return ($db->fetch($db->query("SELECT COUNT(id) AS nb FROM ".$prefix."recruit WHERE villageid='".$id."' AND building='stable'"))['nb'] >= 1) ? true : false;
}
function is_recruting_g($id){
	global $db;
	global $prefix;
	return ($db->fetch($db->query("SELECT COUNT(id) AS nb FROM ".$prefix."recruit WHERE villageid='".$id."' AND building='garage'"))['nb'] >= 1) ? true : false;
}
function is_recruting_n($id){
	global $db;
	global $prefix;
	return ($db->fetch($db->query("SELECT COUNT(id) AS nb FROM ".$prefix."recruit WHERE villageid='".$id."' AND building='snob'"))['nb'] >= 1) ? true : false;
}
function is_researching($id){
	global $db;
	global $prefix;
	return ($db->fetch($db->query("SELECT COUNT(id) AS nb FROM ".$prefix."research WHERE villageid='".$id."'"))['nb'] >= 1) ? true : false;
}

function max_storage_value($village){
	global $db;
	global $config;
	global $arr_maxstorage;

	$max_storage = ($village['bonus'] == 'storage') ? ($arr_maxstorage[$village['storage']]*(1+$config['bonus_values']['storage'])) : $arr_maxstorage[$village['storage']];
	return $max_storage;
}

function res_per_h($village, $res){
	global $db;
	global $config;
	global $arr_production;

	if($village['bonus'] == 'all') {
		$production = $arr_production[$village[$res]]*(1+$config['bonus_values']['all'])*$config['speed'];
	} else {
		$production = ($village['bonus'] == $res) ? ($arr_production[$village[$res]]*(1+$config['bonus_values'][$res]))*$config['speed'] : $arr_production[$village[$res]]*$config['speed'];
	}

	
	return $production;
}

function ressinc($village, $time=""){
	global $config;
	global $db;
	global $prefix;

	$time = (empty($time)) ? time() : $time;

	$diff = $time - $village['last_act'];

	$wood = res_per_h($village, 'wood')/60/60*$diff;
	$stone = res_per_h($village, 'stone')/60/60*$diff;
	$iron = res_per_h($village, 'iron')/60/60*$diff;

	$max_storage = max_storage_value($village);

	$wood_full = $village['r_wood']+$wood;
	$stone_full = $village['r_stone']+$stone;
	$iron_full = $village['r_iron']+$iron;

	if(($village['r_wood'] > $max_storage) || ($wood_full > $max_storage)){
		$db->query("UPDATE ".$prefix."villages SET r_wood='".$max_storage."' WHERE id='".$village['id']."'");
	} else {
		$db->query("UPDATE ".$prefix."villages SET r_wood=r_wood+'".$wood."' WHERE id='".$village['id']."'");
	}

	if($village['r_stone'] > $max_storage || $stone_full > $max_storage){
		$db->query("UPDATE ".$prefix."villages SET r_stone='".$max_storage."' WHERE id='".$village['id']."'");
	} else {
		$db->query("UPDATE ".$prefix."villages SET r_stone=r_stone+'".$stone."' WHERE id='".$village['id']."'");
	}

	if($village['r_iron'] > $max_storage || $wood_full > $max_storage){
		$db->query("UPDATE ".$prefix."villages SET r_iron='".$max_storage."' WHERE id='".$village['id']."'");
	} else {
		$db->query("UPDATE ".$prefix."villages SET r_iron=r_iron+'".$iron."' WHERE id='".$village['id']."'");
	}

	

	$db->query("UPDATE ".$prefix."villages SET last_act='".$time."' WHERE id='".$village['id']."'");
	
  }

  function reload_all_villages_points_players(){
  	global $cl_builds;
  	global $db;
  	global $prefix;

  	$builds = $cl_builds->get_array("dbname");
  	$result = $db->query("SELECT id, points, ".implode(", ", $builds)." FROM ".$prefix."villages WHERE userid!='-1'");

  	while($rowall = $db->fetch($result)){
  		$points = 0;
  		foreach($builds as $building) {
  			$points += $cl_builds->get_points($building, $rowall[$building]);
  		}
  		if($points != $row['points']) {
  			$db->query("UPDATE ".$prefix."villages SET points='".$points."' WHERE id='".$rowall['id']."'");
  		}
  	}

  }

   function reload_all_villages_points_barbs(){
  	global $cl_builds;
  	global $db;
  	global $prefix;

  	$builds = $cl_builds->get_array("dbname");
  	$result = $db->query("SELECT id, points, ".implode(", ", $builds)." FROM ".$prefix."villages WHERE userid='-1'");

  	while($rowall = $db->fetch($result)){
  		$points = 0;
  		foreach($builds as $building) {
  			$points += $cl_builds->get_points($building, $rowall[$building]);
  		}
  		if($points != $row['points']) {
  			$db->query("UPDATE ".$prefix."villages SET points='".$points."' WHERE id='".$rowall['id']."'");
  		}
  	}

  }

  function reload_all_player_points(){
  	global $db, $prefix;

  	$result_p = $db->query("SELECT userid FROM ".$prefix."users");
  	while($row = $db->fetch($result_p)){
  		$result = $db->fetch($db->query("SELECT SUM(points) as points FROM ".$prefix."villages WHERE userid='".$row['userid']."'"));
  		$db->query("UPDATE ".$prefix."users SET points='".$result['points']."' WHERE userid='".$row['userid']."'");
  		
  	}

  	
  }

  function add_troops($unit, $villageid){
  	global $db, $prefix;
  	return $db->fetch($db->query("SELECT SUM(".$unit.") AS unit FROM ".$prefix."unit_place WHERE villages_to_id='".$villageid."'"))['unit'];
  }

  function reload_villages_pop($village){
  	global $cl_builds, $cl_units, $db, $prefix;

  	$builds = $cl_builds->get_array("dbname");
  	$units = $cl_units->get_array("dbname");

    $pop = 0;
  	foreach($builds as $stage){
  		for($i=1; $i<=$village[$stage]; $i++){
  			$pop += $cl_builds->get_pop($stage, $i);
  		}
  	}

  	$db->query("UPDATE ".$prefix."villages SET r_pop='".$pop."' WHERE id='".$village['id']."'");
  	
  	
  }

  function unit_running($x, $y, $coordx, $coordy, $pro_field){
  	global $config;

  	$distance = sqrt(pow(($x-$coordx),2)+pow(($y-$coordy),2));

  	$unit_speed = get_server_speed('speed')*get_server_speed('uspeed')/$pro_field;

  	return round($distance/$unit_speed);
  
}

function add_movement($from_userid, $from_id, $to_userid, $to_id, $units, $type, $start_time, $end_time, $building="", $turn=false, $msec){
	global $db, $prefix;

	if($turn){
		$sfrom_userid = $to_userid;
		$sfrom_id = $to_id;
		$sto_userid = $from_userid;
		$sto_id = $from_id;
	}else{
		$sfrom_userid = $from_userid;
		$sfrom_id = $from_id;
		$sto_userid = $to_userid;
		$sto_id = $to_id;
	}

	//$db->query("INSERT INTO ".$prefix."movements (from_village, to_village, from_userid, to_userid, units, type, start_time, end_time, building, send_from_user, send_from_village, send_to_user, send_to village, msec) VALUES ('".$from_id."', '".$to_id."', ".$from_userid."', '".$to_userid."', '".$units."', '".$type."', '".$start_time."', '".$end_time."', '".$building."', '".$sfrom_userid."', '".$sfrom_id."', '".$sto_userid."', '".$sto_id."', '".$msec."')");
	$db->query("INSERT INTO ".$prefix."movements (from_village, to_village, from_user_id, to_user_id, units, type, start_time, end_time, msec, building) VALUES ('".$from_id."', '".$to_id."', '".$from_userid."', '".$to_userid."', '".$units."', '".$type."', '".$start_time."', '".$end_time."', '".$msec."', '".$building."')");
	$id = $db->getlastid();
	if($type == "attack"){
		$db->query("UPDATE ".$prefix."villages SET attacks=attacks+1 WHERE id='".$to_id."'");
	}elseif($type == "support"){
		$db->query("UPDATE ".$prefix."villages SET supports=supports+1 WHERE id='".$to_id."'");
	}
	$db->query("INSERT INTO ".$prefix."events (event_time, event_type, event_id, user_id, village_id) VALUES ('".$end_time."', 'movement', '".$id."', '".$from_userid."','".$from_id."')");
	$event_idA = $db->getlastid();
}

function Battle($att, $def, $village_to, $others, $defender_villages, $defenders_units_per_village){
	global $config;
	global $cl_units;
	global $arr_wall_bonus;

	$attPoints_Foot = 0;
	$attPoints_Cav = 0;
	$attPoints_Bow = 0;
	$attTotal = 0;
	$defPoints_Foot = 0;
	$defPoints_Cav = 0;
	$defPoints_Bow = 0;
	$defTotal = 0;

	$others['wall_fight'] = 0;

	if($att['unit_ram'] > 0){
		$ramHarm = $config['ram']['wall'];
		$others['wall_fight'] = $others['wall']-round($att['unit_ram']/($ramHarm['base']*pow($ramHarm['factor'], $others['wall'])));
		if($others['wall_fight'] < 0) {
			$others['wall_fight'] = 0;
		}
	}else{
		$others['wall_fight'] = $others['wall'];
	}

	

	foreach($cl_units->get_array("dbname") as $name=>$dbname){
		if($cl_units->get_group($dbname) == "cav"){
			$attPoints_Cav += $cl_units->get_att($dbname, 1)*$att[$dbname];
		}elseif($cl_units->get_group($dbname) == "archer"){
			$attPoints_Bow += $cl_units->get_att($dbname, 1)*$att[$dbname];
		}else{
			$attPoints_Foot += $cl_units->get_att($dbname, 1)*$att[$dbname];
		}

		$attTotal += $att[$dbname];
		$defTotal += $def[$dbname];

		
	    $defPoints_Foot += $cl_units->get_def($dbname, 1)*$def[$dbname];
		$defPoints_Cav += $cl_units->get_defCav($dbname, 1)*$def[$dbname];
		$defPoints_Bow += $cl_units->get_defarcher($dbname, 1)*$def[$dbname];
	}

	
    if($attPoints_Foot == 0){
    	$defPoints_Foot = 0;
    }

    if($attPoints_Cav == 0){
    	$defPoints_Cav = 0;
    }

    if($attPoints_Bow == 0){
    	$defPoints_Bow = 0;
    }


	$attPoints_Total = $attPoints_Foot+$attPoints_Cav+$attPoints_Bow;

	$defPoints_Total = $defPoints_Foot+$defPoints_Cav+$defPoints_Bow;


	if($attPoints_Total <= 0){
		$attFoot_factor = 0;
		$attCav_factor = 0;
		$attBow_factor = 0;
	}else{
		$attFoot_factor = $attPoints_Foot/$attPoints_Total;
		$attCav_factor = $attPoints_Cav/$attPoints_Total;
		$attBow_factor = $attPoints_Bow/$attPoints_Total;
	}

	$attPoints_real = $attPoints_Total;
	$attPoints_real *= 1+(100+$others['luck'])/100;

	$attFoot = $attPoints_real*$attFoot_factor;
	$attCav = $attPoints_real*$attCav_factor;
	$attBow = $attPoints_real*$attBow_factor;

	

	if($defPoints_Total <= 0){
		$defFoot_factor = 0;
		$defCav_factor = 0;
		$defBow_factor = 0;
	}else{
		$defFoot_factor = $defPoints_Foot/$defPoints_Total;
		$defCav_factor = $defPoints_Cav/$defPoints_Total;
		$defBow_factor = $defPoints_Bow/$defPoints_Total;
	}

	$defPoints_real = $defPoints_Total;
	$defPoints_real += $config['defense'];
	$defPoints_real *= $arr_wall_bonus[$others['wall_fight']]+1; 
	

	$defFoot = $defPoints_real*$defFoot_factor;
	$defCav = $defPoints_real*$defCav_factor;
	$defBow = $defPoints_real*$defBow_factor;


	if($attPoints_real > $defPoints_real){
		$others['wins'] = 'att';
		$others['see'] = true;
		$others['def_color'] = 'red';

		$def_lose = $def;
		$def_lost_total = $defTotal;

		foreach($defenders_units_per_village as $village=>$unit){
			foreach($cl_units->get_array("dbname") as $name){
				$defenders_dead_per_village[$village][$name] = $defenders_units_per_village[$village][$name];
			}
		}

		$att_lost_total = 0;
		$att_lose = array();

		if($defFoot <= 0){
			$att_lose_foot = 0;
		}else{
			$att_lose_foot = (($defFoot*pow($defFoot, 1/2))/(1+$attFoot*pow($attFoot, 1/2)));
		}

		if($defCav <= 0){
			$att_lose_cav = 0;
		}else{
			$att_lose_cav = (($defCav*pow($defCav, 1/2))/(1+$attCav*pow($attCav, 1/2)));
		}

		if($defBow <= 0){
			$att_lose_bow = 0;
		}else{
			$att_lose_bow = (($defBow*pow($defBow, 1/2))/(1+$attBow*pow($attBow, 1/2)));
		}

		foreach($cl_units->get_array("dbname") as $name=>$dbname){
			if($cl_units->get_group($dbname) == "cav"){
				$att_lose[$dbname] = round($att[$dbname]*$att_lose_cav);
			}elseif($cl_units->get_group($dbname) == "archer"){
				$att_lose[$dbname] = round($att[$dbname]*$att_lose_bow);
			}else{
				$att_lose[$dbname] = round($att[$dbname]*$att_lose_foot);
			}

			$att_lost_total += $att_lose[$dbname];
		}
		if($att_lost_total <= 0){
			$others['att_color'] = "green";
		}else{
			$others['att_color'] = "yellow";
		}

		if($att['unit_ram'] > 0){
			
			$ramW = $config['ram']['wall'];

			$max_wall_damage = (($att['unit_ram']*$cl_units->get_att("unit_ram", 1))/$ramW['base']*pow($ramW['factor'], $others['wall']));
            
            if($attTotal <= 0){
            	$ram_factor = 1;
            }else{
            	$ram_factor = $att_lost_total/$attTotal;
            }

            $others['new_wall'] = $others['wall']-round($max_wall_damage-((1/2)*$max_wall_damage*$ram_factor));
		}else{
			$others['new_wall'] = $others['wall'];
		}
	}elseif($defPoints_real > $attPoints_real){
		$others['wins'] = 'def';
		$others['att_color'] = "red";

		$att_lose = $att;

		$att_lost_total = $attTotal;
		$def_lost_total = 0;

		$def_lose = array();

		$def_lose_factor = (($attPoints_real*pow($attPoints_real, 1/2))/($defPoints_real*pow($defPoints_real, 1/2)));

		foreach($cl_units->get_array("dbname") as $name=>$dbname){
			$def_lose[$dbname] = round($def[$dbname] * $def_lose_factor);
			$def_lost_total += $def_lose[$dbname];
		}

		foreach($defenders_units_per_village as $village=>$unit){
			foreach($cl_units->get_array("dbname") as $name=>$dbname){
				if($defenders_units_per_village[$village][$dbname] <= 0){
					$defenders_dead_per_village[$village][$dbname] = 0;
				}else {
					$defenders_factor[$village][$dbname] = $defenders_units_per_village[$village][$dbname]/$def[$dbname];
				}

				$defenders_dead_per_village[$village][$dbname] = round(($def_lose[$dbname])*$defenders_factor[$village][$dbname]);
			}
		}

		$others['def_lost_total'] = $def_lost_total;
		$others['att_lost_total'] = $att_lost_total;

        if($def_lost_total <= 0){
        	$others['def_color'] = "green";
        }else{
        	$others['def_color'] = "yellow";
        }

        if($att['unit_ram'] > 0){
        	if($defTotal <= 0){
        		$ram_factor = 1;
        	}else{
        		
        		$ram_factor = $def_lost_total/$defTotal;
        		
        	}
        	$ramW = $config['ram']['wall'];
        	$others['new_wall'] = $others['wall'] - round(($att['unit_ram']*$cl_units->get_att("unit_ram", 1)*$ram_factor)/(2*$ramW['base']*pow($ramW['factor'], $others['wall'])));
        }else{
        	$others['new_wall'] = $others['wall'];
        }


	}

	if($others['new_wall'] < 0){
		$others['new_wall'] = 0;
	}

	

	$others['factors'] =$others['wall_fight']."/".$others['new_wall'];

	foreach($att_lose as $key=>$value){
        if($value > $att[$key]){
        	$att_lose[$key] = $att[$key];
        }
    }

    foreach($def_lose as $key=>$value){
        if($value > $def[$key]){
        	$def_lose[$key] = $def[$key];
        }
    }

	

    /*foreach($units_per_village as $key=>$village){
    	foreach($cl_units->get_array("dbname") as $name=>$dbname){
    		if($defenders_units_per_player[$key][$dbname] <= 0){
    			$units_surv[$key][$dbname] = 0;
    		}else{
    			$units_surv_factor[$key][$dbname] = $defenders_units_per_player[$key][$dbname]/$def[$dbname];
    		}

    		$units_surv[$key][$dbname] = round(($def[$dbname]-$def_lose[$dbname])*$units_surv_factor[$key][$dbname]);
    		
    	}
    }*/

    return array("att"=>$att,
    	         "att_lose"=>$att_lose,
    	         "def"=>$def,
    	         "def_lose"=>$def_lose,
    	         "def_lose_support"=>$defenders_dead_per_village,
    	         "others"=>$others
                );

	
}


?>