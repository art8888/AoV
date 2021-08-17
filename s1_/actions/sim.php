<?php
$units_data = $cl_units->get_array("dbname");

$row = $db->fetch($db->query("SELECT units, to_village FROM ".$prefix."movements WHERE id=20"));
//$units_explode = explode(";", $row['units']);

//Count number of defenders
$defenders_query = $db->query("SELECT villages_from_id FROM ".$prefix."unit_place WHERE villages_to_id='2955'");
while($row_def = $db->fetch($defenders_query)){
	$defenders_player[] = $row_def['villages_from_id'];
}

$first = true;
$u = "";

$units_explode = explode(";", "0;0;7000;0;0;2900;0;0;500;0;0");
$village_to = 2955;

$wall = $db->fetch($db->query("SELECT wall FROM ".$prefix."villages WHERE id='2955'"))['wall'];

foreach($defenders_player as $player){
	foreach($units_data as $dbname){
		$defenders_units_per_player[$player][$dbname] = $db->fetch($db->query("SELECT SUM(".$dbname.") as '".$dbname."' FROM ".$prefix."unit_place WHERE villages_from_id='2955' AND villages_to_id='2955'"))[$dbname];
	}
}

foreach($units_data as $dbname){
	$defenders_units[$dbname] = $db->fetch($db->query("SELECT SUM(".$dbname.") as '".$dbname."' FROM ".$prefix."unit_place WHERE villages_to_id='2955'"))[$dbname];
}

$i = 0;
foreach($units_data as $dbname){
	$units_attacker[$dbname] = $units_explode[$i];
	$i++;
}

function simulate($att, $def, $wall_v, $units_per_village){
	global $config;
	global $cl_units;
	global $arr_wall_bonus;
	global $defenders_units_per_player;

	$attPoints_Foot = 0;
	$attPoints_Cav = 0;
	$attPoints_Bow = 0;
	$attTotal = 0;
	$defPoints_Foot = 0;
	$defPoints_Cav = 0;
	$defPoints_Bow = 0;
	$defTotal = 0;

	$wall['wall_fight'] = 0;

	if($att['unit_ram'] > 0){
		$ramHarm = $config['ram']['wall'];
		$wall['wall_fight'] = $wall_v-round($att['unit_ram']/($ramHarm['base']*pow($ramHarm['factor'], $wall_v)));
		if($wall['wall_fight'] < 0) {
			$wall['wall_fight'] = 0;
		}
	}else{
		$wall['wall_fight'] = $wall_v;
	}

	$luck = (100+25.0)/10;

	foreach($cl_units->get_array("dbname") as $name=>$dbname){
		if($cl_units->get_group($dbname) == "cav"){
			$attPoints_Cav += $cl_units->get_att($dbname, 1)*$att[$dbname];
		}elseif($cl_units->get_group($dbname, 1) == "archer"){
			$attPoints_Bow += $cl_units->get_att($dbname, 1)*$att[$dbname];
		}else{
			$attPoints_Foot += $cl_units->get_att($dbname, 1)*$att[$dbname];
		}

		$attTotal += $att[$dbname];
		$defTotal += $def[$dbname];

		$defPoints_Foot += $cl_units->get_def($dbname, 1)*$def[$dbname];
		$defPoints_Cav += $cl_units->get_defCav($dbname, 1)*$def[$dbname];
		$defPoints_Bow += $cl_units->get_defArcher($dbname, 1)*$def[$dbname];
	}

	if($def['unit_ram'] > 0 || $def['unit_cat'] > 0){
		
	}

	$attPoints_Total = $attPoints_Foot+$attPoints_Cav+$attPoints_Bow;

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
	$attPoints_real *= (100+$luck)/100;
	

	$attFoot = $attPoints_real*$attFoot_factor;
	$attCav = $attPoints_real*$attCav_factor;
	$attBow = $attPoints_real*$attBow_factor;

	
	$defPoints_Total = $defPoints_Foot+$defPoints_Cav+$defPoints_Bow;

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
	$defPoints_real += $config['reason_defense'];
	$defPoints_real += $arr_wall_bonus[$wall['wall_fight']]+1;

	$defFoot = $defPoints_real*$defFoot_factor;
	$defCav = $defPoints_real*$defCav_factor;
	$defBow = $defPoints_real*$defBow_factor;

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

	$def_lose_factor = (($attPoints_real*pow($attPoints_real, 1/2))/($defPoints_real*pow($defPoints_real,1/2)));

	foreach($cl_units->get_array("dbname") as $name=>$dbname){
			if($cl_units->get_group($dbname) == "cav"){
				$att_lose[$dbname] = round($att[$dbname]*$att_lose_cav);
			}elseif($cl_units->get_group($dbname) == "archer"){
				$att_lose[$dbname] = round($att[$dbname]*$att_lose_bow);
			}else{
				$att_lose[$dbname] = round($att[$dbname]*$att_lose_foot);
			}
			$att_lost_total += $att_lose[$dbname];
			$def_lose[$dbname] = round($def[$dbname] * $def_lose_factor);
			$def_lost_total += $def_lose[$dbname];
	}
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

    foreach($units_per_village as $key=>$village){
    	foreach($cl_units->get_array("dbname") as $name=>$dbname){
    		if($defenders_units_per_player[$key][$dbname] <= 0){
    			$units_surv[$key][$dbname] = 0;
    		}else{
    			$units_surv_factor[$key][$dbname] = $defenders_units_per_player[$key][$dbname]/$def[$dbname];
    		}

    		$units_surv[$key][$dbname] = round(($def[$dbname]-$def_lose[$dbname])*$units_surv_factor[$key][$dbname]);
    		
    	}
    }

    

    

	return array("att_lose"=>$att_lose, "def_lose"=>$def_lose, "surv"=>$units_surv, "points"=>$attPoints_real."/".$defPoints_real."/".$wall['wall_fight']);
	
	
}

$others['luck'] = rand(-25, 25);

$tpl->assign("units_data", $units_data);
$tpl->assign("units_attacker", $units_attacker);


//$tpl->assign("att_lose", Battle($units_attacker, $defenders_units, $village_to, $others, 1));
$tpl->assign("att_lose", Simulate($units_attacker, $defenders_units, 4, array()));

$tpl->assign("dp", $defenders_player);
$tpl->assign("def_units", $defenders_units);
$tpl->assign("dupp", $defenders_units_per_player);

?>