<?php
require_once("include.inc.php");

reload_all_villages_points_players();
reload_all_player_points();

$villages = $db->query("SELECT * FROM ".$config['prefix']."villages WHERE userid!='-1'");
while($village = $db->fetch($villages)){
	ressinc($village);
	//reload_villages_pop($village);
	//echo $village['id'];
}

function check_builds($id){
	global $db;
	global $prefix;

	$done = false;
	$reload_village = array();

	$result = $db->query("SELECT * FROM ".$prefix."buildings WHERE id='".$id."'");

	while($row = $db->fetch($result)){
		$db->query("DELETE FROM ".$prefix."buildings WHERE id='".$id."'");
		if($db->affectedrows() == 1){
			$result2 = $db->query("SELECT COUNT(*) AS build_count FROM ".$prefix."buildings WHERE villageid='".$row['villageid']."'");
			$row2 = $db->fetch($result2);

			if($row2['build_count'] == '0') {
				$add_sql = ", main_build='' ";
			} else {
				$result2 = $db->query("SELECT building, end_time FROM ".$prefix."buildings WHERE villageid='".$row['villageid']."' ORDER BY end_time LIMIT 1");
				$next_build = $db->fetch($result2);
				$add_sql=",`main_build`='".$next_build['building'].",".$next_build['end_time']."' ";
			}

			$db->query("UPDATE ".$prefix."villages SET ".$row['building']."=".$row['building']."+1 ".$add_sql." WHERE id='".$row['villageid']."'");
			
		}
	}
}

function check_recruit($id, $time){
	global $db, $prefix;

	$result = $db->query("SELECT * FROM ".$prefix."recruit WHERE id='".$id."'");

	while($row = $db->fetch($result)){
		$diff_time = $time - $row['time_start'];
		$units_finished = (floor($diff_time/$row['time_per_unit']))-$row['num_finished'];

		if($units_finished+$row['num_finished'] > $row['num_unit']){
			$units_finished = $row['num_unit']-$row['num_finished'];
		}

		$db->query("UPDATE ".$prefix."unit_place SET ".$row['unit']."=".$row['unit']."+'".$units_finished."' WHERE villages_from_id='".$row['villageid']."' AND villages_to_id='".$row['villageid']."' ");
		$db->query("UPDATE ".$prefix."villages SET ".$row['unit']."=".$row['unit']."+'".$units_finished."' WHERE id='".$row['villageid']."' ");

		if($units_finished+$row['num_finished'] == $row['num_unit']){
			$db->query("DELETE FROM ".$prefix."recruit WHERE id='".$id."'");
			return true;
		}else{
			$db->query("UPDATE ".$prefix."recruit SET num_finished=num_finished+'".$units_finished."' WHERE id='".$id."'");
			return $row['time_start']+(($units_finished+$row['num_finished'])*$row['time_per_unit'])+$row['time_per_unit'];
			
		}
	}
}

function do_movement($id, $event_id, $time){
	global $db;
	global $prefix;

	$result = $db->query("SELECT * FROM ".$prefix."movements WHERE id='".$id."'");
	$row = $db->fetch($result);

	$row['id'] = $id;

	if(!isset($row['type'])){
		$row['type'] = '';
	}



	switch($row['type']){
		case 'attack':
		   $db->query("DELETE FROM ".$prefix."movements WHERE `id`='".$row['id']."'");
		   return do_movement_attack($row);
		break;
		 case 'support':
	    	$db->query("DELETE FROM ".$prefix."movements WHERE `id`='".$row['id']."'");
	        return do_movement_support($row);
	    break;
	    case 'return':
	    	if($row['die'] == "1"){
	    		$db->query("DELETE FROM ".$prefix."movements WHERE `id`='".$row['id']."'");
	    		return true;
	    	}
	        return do_movement_return($row);
	    break;
		case 'back':
		   if($row['die'] == "1"){
		   	$db->query("DELETE FROM ".$prefix."movements WHERE id='".$row['id']."'");
		   	return true;
		   }
		   return do_movement_back($row);
		break;
		case 'cancel':
		   if($row['die'] == "1"){
		   	$db->query("DELETE FROM ".$prefix."movements WHERE id='".$row['id']."'");
		   	return true;
		   }
		   return do_movement_back($row);
		break;
	}
}

function do_movement_attack($row){
	global $db;
	global $prefix;
	global $cl_units;
	global $cl_reports;

	$delete_event = false;

	$att_units_e = explode(";", $row['units']);

	$player_tname = getPlayerDatas($row['to_user_id'])['username'];
	$player_fname = getPlayerDatas($row['from_user_id'])['username'];

	$village_tname = getVillageDatas($row['to_village'])['name'];
	$village_fname = getVillageDatas($row['from_village'])['name'];

	$i = 0;



	$query = $db->query("SELECT villages_from_id FROM ".$prefix."unit_place WHERE villages_to_id='".$row['to_village']."'");
	while($row2 = $db->fetch($query)){
		$defender_villages[] = $row2['villages_from_id'];
	}

	foreach($defender_villages as $village){
		$support_villages_name[$village] = getVillageDatas($village)['name'];
		foreach($cl_units->get_array("dbname") as $name){
			$defender_units_per_village[$village][$name] = $db->fetch($db->query("SELECT SUM(".$name.") AS ".$name." FROM ".$prefix."unit_place WHERE villages_from_id='".$village."' AND villages_to_id='".$row['to_village']."' "))[$name];
		}
	}

	
    

	foreach($cl_units->get_array("dbname") as $name){
		$att_units[$name] = $att_units_e[$i];
		$def_units[$name] = $db->fetch($db->query("SELECT SUM(".$name.") as ".$name." FROM ".$prefix."unit_place WHERE villages_to_id='".$row['to_village']."'"))[$name];
		$i++;
	}

	$others['wall'] = getVillageDatas($row['to_village'])['wall'];
	$others['luck'] = rand(-25.0, 25.0);


	$battle = Battle($att_units, $def_units, $row['to_village'], $others, $defender_villages, $defender_units_per_village);

	$att_dead = implode(";",$battle['att_lose']);
	$def_dead = implode(";",$battle['def_lose']);

	$defender_units_per_village_dead = $battle['def_lose_support'];

	$db->query("UPDATE ".$prefix."users SET kill_off=kill_off+'".$battle['others']['def_lost_total']."' WHERE userid='".$row['from_user_id']."'");

	$db->query("UPDATE ".$prefix."users SET kill_def=kill_def+'".$battle['others']['att_lost_total']."' WHERE userid='".$row['to_user_id']."'");
    

	
	$Luck = 10;
	$moral = 0;
	$see = 1;

	$cl_reports->attack($row['from_user_id'], $player_fname, $row['from_village'], $village_fname, $row['to_user_id'], $player_tname, $row['to_village'], $village_tname, $battle['others'], time(), $att_units, $att_dead, $def_units, $def_dead, $defender_villages, $defender_units_per_village, $defender_units_per_village_dead, $support_villages_name);
	return true;
}

function do_movement_support($row){
	global $db;
	global $prefix;
	global $cl_units;
	global $cl_reports;

	$result = $db->query("SELECT COUNT(villages_to_id) AS count FROM ".$prefix."unit_place WHERE villages_from_id='".$row['from_village']."' AND villages_to_id='".$row['to_village']."' ");
	$exist_support = $db->fetch($result);

	$player_from = getVillageDatas($row['from_village'])['userid'];
	$player_to = getVillageDatas($row['to_village'])['userid'];

	

	if($exist_support['count'] == 0){
		$sql = "INSERT INTO ".$prefix."unit_place (";
		$first = true;

		foreach($cl_units->get_array("dbname") as $dbname){
			if($first){
				$sql .= "$dbname";
				$first = false;
			}else{
				$sql .= ",$dbname";
			}
		}
		$sql .= ", villages_from_id, villages_to_id, player_from_id, player_to_id) VALUES (";
		$first = true;

		$i = 0;
		$ex_units = explode(";", $row['units']);

		foreach($cl_units->get_array("dbname") as $dbname){
			if($first){
				$sql .= "'".$ex_units[$i]."'";
				$first = false;
			}else{
				$sql .= ",'".$ex_units[$i]."'";
				
			}
			$i++;

		}
		$sql .= ",'".$row['from_village']."','".$row['to_village']."', '".$player_from."', '".$player_to."')";
	}else{
		$sql = "UPDATE ".$prefix."unit_place SET ";
		$first = true;
		$i = 0;
		$ex_units = explode(";", $row['units']);

		foreach($cl_units->get_array("dbname") as $dbname){
			if($first){
				$sql .= "$dbname=$dbname+'".$ex_units[$i]."'";
				$first = false;
			}else{
				$sql .= ",$dbname=$dbname+'".$ex_units[$i]."'";

			}
			$i++;
		}
		$sql .= ",player_from_id='".$player_from."', player_to_id='".$player_to."' WHERE villages_from_id='".$row['from_village']."' AND villages_to_id='".$row['to_village']."'";
	}
	$db->query($sql);

	$vfn = $db->fetch($db->query("SELECT name FROM ".$prefix."villages WHERE id='".$row['from_village']."'"))['name'];
	$vtn = $db->fetch($db->query("SELECT name FROM ".$prefix."villages WHERE id='".$row['to_village']."'"))['name'];

	$cl_reports->support($player_from, $vfn, $vtn, $row['from_village'], $player_to, $row['to_village'], $row['units'], $row['end_time']);

	$db->query("DELETE FROM ".$prefix."movements WHERE id='".$row['id']."'");
	return true;
}

function check_events(){
	global $user;
	global $village;
	global $db;
	global $conf;
	global $prefix;

	$time = (empty($time)) ? time() : $time;
	$reload_village_points = array();

	$event_ids = array();
	$do_event = true;
	$i = 0;
	$do_mov = true;
	$delete_event = false;

	$result = $db->query("SELECT id, user_id, event_type, event_id FROM ".$prefix."events WHERE event_time < '".$time."'");
	while($row = $db->fetch($result)){
		$delete_event = false;
		$do_event = true;

		if(in_array($row['event_type']."_".$row['event_id'], $event_ids)){
			$delete_event = true;
			$do_event = false;
		}

		@$event_ids[$i] = $row['event_type']."_".$row['event_id'];

		if($do_event){
			switch($row['event_type']){
				case 'build':
			        $villageid = check_builds($row['event_id']);
			        $delete_event = true;
			        if(isset($villageid)){
			   	        $reload_village_points[$villageid] == "";
			   	        
			        }
			    break;
			    case 'recruit':
			       $recruit = check_recruit($row['event_id'], $time);
			       if(!is_numeric($recruit)){
			       	$delete_event = true;
			       }else{
			       	$delete_event = false;
			       	$db->query("UPDATE ".$prefix."events SET event_time='".$recruit."' WHERE id='".$row['id']."'");
			       }
			      
			    break;
			    case 'movement':
			       $movement_return = do_movement($row['event_id'], $row['id'], $time);
			       echo do_movement($row['event_id'], $row['id'], $time);
			       if($movement_return){
			       	    $delete_event = true;
			       }
			    break;
			    
			}
		}

		if($delete_event){
			$db->query("DELETE FROM ".$prefix."events WHERE id='".$row['id']."'");
		}else{
			$db->query("UPDATE ".$prefix."events SET is_locked='0' WHERE id=".$row['id']." AND is_locked='1'");
		}
		$i++;

		
	}
	foreach($reload_village_points as $id=>$value){
		//reload_village_points($id);
	}
}




check_events();
?>