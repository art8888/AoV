<?php
require_once("include.inc.php");

$q1 = $db->query("SELECT * FROM ".$prefix."villages WHERE userid='-1'");
while($village2 = $db->fetch($q1)){
	$villages[] = $village2['id'];
	ressinc($village2);
}

foreach($villages as $v=>$key){
	foreach($cl_builds->get_array("dbname") as $key2=>$dbname){
		$buildings_per_village[$key][$dbname] = $db->fetch($db->query("SELECT ".$dbname." FROM ".$prefix."villages WHERE id='".$key."'"))[$dbname];
	}
	$village_data[$key] = $db->fetch($db->query("SELECT * FROM ".$prefix."villages WHERE id='".$key."'"));

}

foreach($buildings_per_village as $v=>$k){
	
	$max_storage = ($village_data[$v]['bonus'] == 'storage') ? ($arr_maxstorage[$village_data[$v]['storage']]*(1+$config['bonus_values']['storage'])) : $arr_maxstorage[$village_data[$v]['storage']];

        $max_farm  = ($village_data[$v]['bonus'] == 'farm') ? ($arr_farm[$village_data[$v]['farm']]*(1+$config['bonus_values']['farm'])) : $arr_farm[$village_data[$v]['farm']];

        $available = array();

	foreach($cl_builds->get_array("dbname") as $key=>$dbname){
		$cl_builds->build($village_data[$v], $key, $buildings_per_village[$v]);

		if($cl_builds->get_build_error2() == "no_error"){
			
			array_push($available, $dbname);
		}

		$available_per_village[$v] = $available;
			
	}
}

foreach($available_per_village as $key=>$value){

	
	if($village_data[$key]['points'] <= 3000){
		$rand = $value[rand(0,count($value)-1)];
        $stone = $cl_builds->get_stone($rand,$buildings_per_village[$key][$rand]+1);
	    $iron = $cl_builds->get_iron($rand,$buildings_per_village[$key][$rand]+1);
	    $pop = $cl_builds->get_pop($rand,$buildings_per_village[$key][$rand]+1);
	    $time = $cl_builds->get_time($buildings_per_village[$key]['main'], $rand, $buildings_per_village[$key][$rand]+1);

	    $onlytime = $cl_builds->get_time($buildings_per_village[$key]['main'], $rand, $buildings_per_village[$key][$rand]+1);

	    $result = $db->query("SELECT end_time FROM ".$prefix."buildings WHERE villageid='".$key."' ORDER BY id DESC LIMIT 1");
		$row = $db->fetch($result);
		if($db->affectedrows() == "0") {
			$time += time();
			$add_village_sql = ",main_build='".$rand.",$time' ";
		}else{
			$time += $row['end_time'];
		}

		$db->query("UPDATE ".$prefix."villages SET r_wood=r_wood-'".round($wood)."', r_stone=r_stone-'".round($stone)."', r_iron=r_iron-'".round($iron)."', r_pop=r_pop+'".$pop."' ".$add_village_sql." WHERE id='".$key."' ");
		$db->query("INSERT INTO ".$prefix."buildings (building, villageid, end_time, build_time) VALUES ('".$rand."', '".$key."', '".$time."', '".$onlytime."') ");
		$buildid = $db->getlastid();
		$db->query("INSERT INTO ".$prefix."events (event_time, event_type, event_id, user_id, village_id) VALUES ('".$time."', 'build', '".$buildid."', '-1', '".$key."')");
	}       
}


reload_all_villages_points_barbs();
?>