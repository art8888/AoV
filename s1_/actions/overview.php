<?php
$builds = $cl_builds->get_array("dbname");
$build_builds = array();
foreach($builds as $id => $dbname){
	$needed = $cl_builds->get_needed($id);
	$needed_done = true;
	if($village[$dbname] > 0){
		foreach($needed as $dbname2 => $needed_stage){
			if($village[$dbname2] < $needed_stage){
				$needed_done = false;
			}
		}
	}else{
		$needed_done = false;
	}
	if($needed_done){
		$built_builds[$id] = $dbname;
	}
}

$units = $cl_units->get_array("dbname");
$in_village = array();
$in_village_support = array();
foreach($units as $id => $dbname){
	if($village[$dbname] > 0){
		$in_village[$id] = $dbname;
		$units_in[$dbname] = $db->fetch($db->query("SELECT SUM(".$dbname.") as sum FROM ".$prefix."unit_place WHERE villages_to_id='".$village['id']."' "))['sum']; 
	}elseif(add_troops($dbname, $village['id']) > 0){
		$in_village[$id] = $dbname;
		$units_in[$dbname] = add_troops($dbname, $village['id']);
	}
	
}
$cmd = array();

$cmd_q = $db->query("SELECT id, from_village, to_village, from_user_id, to_user_id, type, start_time, end_time, msec FROM ".$prefix."movements WHERE to_village='".$village['id']."'");
while($row = $db->fetch($cmd_q)){
	$cmd[$row['id']]['from_village'] = $row['from_village'];

	$cmd[$row['id']]['name_from'] = getVillageDatas($row['from_village'])['name'];
	$cmd[$row['id']]['name_to'] = getVillageDatas($row['to_village'])['name'];

	$cmd[$row['id']]['from_user'] = $row['from_user_id'];
	$cmd[$row['id']]['to_user'] = $row['to_user_id'];

	$cmd[$row['id']]['to_village'] = $row['to_village'];
	$cmd[$row['id']]['type'] = $row['type'];
	$cmd[$row['id']]['start_time'] = $row['start_time'];
	$cmd[$row['id']]['end_time'] = $row['end_time'];
	$cmd[$row['id']]['countdown'] = $row['end_time']-time();
	$cmd[$row['id']]['msec'] = $row['msec'];
	$nb = 2;
}



$tpl->assign("cl_builds", $cl_builds);
$tpl->assign("built_builds", $built_builds);
$tpl->assign("cl_units", $cl_units);
$tpl->assign("in_village", $in_village);
$tpl->assign("troops", $units_in);
$tpl->assign("speed", $config['speed']);
$tpl->assign("cmd", $cmd);
$tpl->assign("nb", $nb);
?>