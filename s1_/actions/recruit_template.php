<?php
$show_build = ($cl_builds->check_needed($buildname, $village) && $village[$buildname] > 0) ? true:false;
if($show_build){
	$units = $cl_units->get_recruit_in_units($buildname);

	$max_farm = ($village['bonus'] == 'farm') ? ($arr_farm[$village['farm']]*(1+$config['bonus_values']['farm'])) : $arr_farm[$village['farm']];

	$sql = "SELECT ";
	$i = 0;
	foreach($units as $key=>$value){
		++$i;
		if(count($units) == $i){
			$sql .= $key;
			continue;
		} else {
			$sql .= $key.",";
		}
	}

	$sql .= " FROM ".$prefix."unit_place WHERE villages_from_id='".$village['id']."' AND villages_to_id='".$village['id']."'";
	$result = $db->query($sql);
	$units_in_village = $db->fetch($result);

	$sql = "SELECT ";
	$i = 0;
	foreach($units as $key=>$value){
		++$i;
		if(in_array("no_investigate", $cl_units->get_specials($key))){
			if(count($units) == $i){
				$sql .= $key;
				continue;			
			}
			$sql .= $key.",";
			continue;
		}elseif(count($units) == $i){
			$sql .= $key.",".$key."_tec";
			continue;
		}else{
			$sql .= $key.",".$key."_tec,";
		}
	}
	
	$sql .= " FROM ".$prefix."villages WHERE id='".$village['id']."'";
	$result = $db->query($sql);
	$units_all = $db->fetch($result);

	$village = $village+$units_all;

	foreach($units as $key=>$value){
		$units_all[$key] = $units_all[$key];
	}

	if(isset($_GET['action']) && $_GET['action'] == "train"){
		if($session['hkey'] != $_GET['h']){
			$error = "";
		}
		$check = "";
		$reload = false;

		foreach($units as $key=>$value){
			if(!empty($_POST[$key])){
				$cl_units->check_needed($key, $village);

				$input = (int)$_POST[$key];

				$wood = $cl_units->get_woodprice($key)*$input;
				$stone = $cl_units->get_stoneprice($key)*$input;
				$iron = $cl_units->get_ironprice($key)*$input;
				$pop = $cl_units->get_popprice($key)*$input;

				if($wood > $village['r_wood'] || $stone > $village['r_stone'] || $iron > $village['r_iron']){
					$check = "too_many_units";
				}

				if(($max_farm - $village['r_pop']-$pop) < 0 && empty($check)){
					$check = "to_many_pop";
				}
				if(empty($check) && is_numeric($cl_units->last_error) && $input > 0){
					$db->query("UPDATE ".$prefix."villages SET r_wood=r_wood-'".$wood."', r_stone=r_stone-'".$stone."', r_iron=r_iron-'".$iron."', r_pop=r_pop+'".$pop."' WHERE id='".$village['id']."'");
					$village['r_wood'] -= $wood;
					$village['r_stone'] -= $stone;
					$village['r_iron'] -= $iron;
					$village['r_pop'] += $pop;
					$cl_units->recruit_units($key, $input, $buildname, $village['bonus'], $village[$buildname], $village['id']);
				}
			}
		}
	}

	$recruit_units = array();
	$i = 0;
	$result = $db->query("SELECT id, unit, num_unit, num_finished, time_finished, time_start FROM ".$prefix."recruit WHERE villageid='".$village['id']."' AND building='".$buildname."' ORDER BY time_start");
	while($row = $db->fetch($result)){
		++$i;
		if($i == 1){
			$recruit_units[$row['id']]['lit'] = true;
		} else {
			$recruit_units[$row['id']]['lit'] = false;
		}

		$recruit_units[$row['id']]['unit'] = $row['unit'];
		$recruit_units[$row['id']]['num_unit'] = $row['num_unit']-$row['num_finished'];
		$recruit_units[$row['id']]['time_finished'] = $row['time_finished'];

		if($i == 1){
			$recruit_units[$row['id']]['countdown'] = $row['time_finished']-time();
		}else{
			$recruit_units[$row['id']]['countdown'] = $row['time_finished'] - time();
		}
	}
	$tpl->assign("units", $units);
	$tpl->assign("units_in_village", $units_in_village);
	$tpl->assign("units_all", $units_all);
	$tpl->assign("recruit_units", $recruit_units);
}
$tpl->assign("dbname", $buildname);
$tpl->assign("units", $units);
$tpl->assign("show_build", $show_build);
$tpl->assign("cl_units", $cl_units);
$tpl->assign("units_in_village", $units_in_village);
$tpl->assign("units_all", $units_all);
?>