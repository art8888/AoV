<?php
$show_build = $cl_builds->check_needed("place", $village);
$lang = new aLang("game", "EN");

$milisec = explode(" ", microtime());
$mili = round(msec()-$load_msec)*10;

if($show_build){
	if(isset($_GET['mode']) && $_GET['mode'] == "units"){
		include("place_units.php");
	}
	if(isset($_GET['mode']) && $_GET['mode'] == "sim"){
		include("place_sim.php");
	}

}
foreach($cl_units->get_array("dbname") as $id=>$dbname){
	$group_units[$cl_units->get_col($dbname)][] = $dbname;
}
$units = $cl_units->read_units($village['id'], $village['id']);

if(isset($_POST['x'])){
	$values['x'] = (int)$_POST['x'];
}
if(isset($_POST['y'])){
	$values['y'] = (int)$_POST['y'];
}

if(isset($_GET['try']) && $_GET['try'] == "confirm"){
	$error = "";
    $enought_units = true;
    $units_choosed = false;
	foreach($cl_units->get_array("dbname") as $dbname){
		if(!empty($_POST[$dbname])){
			$values[$dbname] = (int)$_POST[$dbname];
		}
		if($_POST[$dbname] < 1){
		    $send_units[$dbname] = 0;
		}else{
			$send_units[$dbname] = (int)$_POST[$dbname];
			$units_choosed = true;
		}
		if($units[$dbname] < $_POST[$dbname]){
			$enought_units = false;
		}


    }
    if(isset($_POST['attack'])){
			$type = "attack";
		}else{
			$type = "support";
		}
        if(empty($error) && !$units_choosed){
			$error = $lang->get("not_units");
		}
		if(empty($error) && !$enought_units){
			$error = $lang->get("not_enought_units");
		}
		if(empty($error) && (empty($_POST['x']) || empty($_POST['y']))){
			$error = $lang->get("empty_coords");
		}
		if(empty($error) && $_POST['x'] == $village['x'] && $_POST['y'] == $village['y']){
			$error = $lang->get("cant_attack_same_village");
		}

		$result = $db->query("SELECT COUNT(id) as count, userid FROM ".$prefix."villages WHERE x='".$_POST['x']."' AND y='".$_POST['y']."'");
		$village_exist = $db->fetch($result);

		if(empty($error) && $village_exist['count'] == 0){
			$error = $lang->get("empty_vilage");
		}
		if(empty($error) && $type == 'support' && $village_exist['userid'] == '-1'){
			$error = $lang->get("support_barb");
		}

		

		
		echo $error;
		if(empty($error)){
			$result = $db->query("SELECT id, name, userid FROM ".$prefix."villages WHERE x='".$_POST['x']."' AND y='".$_POST['y']."'");
			$info_villages = $db->fetch($result);

			$result2 = $db->query("SELECT username, id FROM ".$prefix."users WHERE userid='".$info_villages['userid']."'");
			$info_user = $db->fetch($result2);

			$info_villages['name'] = entparse($info_villages['name']);
			$info_villages['x'] = $_POST['x'];
			$info_villages['y'] = $_POST['y'];

			$unit_runtime = unit_running($village['x'], $village['y'], $_POST['x'], $_POST['y'], $cl_units->get_slowest_unit($send_units));
		
		    $arrival = time()+$unit_runtime;

		    $_GET['screen'] = "place_confirm";

		    $tpl->assign("info_village", $info_villages);
		    $tpl->assign("info_user", $info_user);
		    $tpl->assign("unit_runtime",$unit_runtime);
		    $tpl->assign("arrival", $arrival);
		    $tpl->assign("send_units", $send_units);
		}	
}
if(isset($_GET['action']) && $_GET['action'] == "command"){
	$error = "";

	if(empty($error) && $session['hkey'] != $_GET['h']){
		$error = "";
	}

	$enought_units = true;
	$units_choosed = false;

	foreach($cl_units->get_array("dbname") as $dbname){
		if(!empty($_POST[$dbname])){
			$values[$dbname] = (int)$_POST[$dbname];
		}
		if($_POST[$dbname] < 1){
			$send_units[$dbname] = 0;
		}else{
			$send_units[$dbname] = (int)$_POST[$dbname];
			$units_choosed = true;
		}
		if($units[$dbname] < $_POST[$dbname]){
			$enought_units = false;
		}
	}

	if(empty($error) && !$units_choosed){
		$error = $lang->get("not_units");
	}
	if(empty($error) && !$enought_units){
		$error = $lang->get("not_enought_units");
	}
	if(empty($error) && (empty($_POST['x']) || empty($_POST['y']))){
		$error = $lang->get("empty_coords");
	}
	if(empty($error) && $_POST['x'] == $village['x'] && $_POST['y'] == $village['y']){
		$error = $lang->get("cant_attack_same_village");
	}

	$result = $db->query("SELECT COUNT(id) as count, userid, id FROM ".$prefix."villages WHERE x='".$_POST['x']."' AND y='".$_POST['y']."'");
	$village_exist = $db->fetch($result);

	if(isset($_POST['attack'])){
		$type = "attack";
	}else{
		$type = "support";
	}

	if(empty($error) && $village_exist['count'] == 0){
		$error = $lang->get("empty_vilage");
	}else{
		$to_village_id = $village_exist['id'];
		$to_user_id = $village_exist['userid'];
	}

	if(empty($error) && $type == 'support' && $village_exist['userid'] == '-1'){
		$error = $lang->get("support_barb");
	}

	

	if(empty($error)){
		$start_time = time();
		$end_time = $start_time + unit_running($village['x'], $village['y'], $_POST['x'], $_POST['y'], $cl_units->get_slowest_unit($send_units));
		$send_units_implode = implode(";", $send_units);

		$type = $_POST['attack'] ? "attack" : "support";
		$cata_building = $_POST['building'];

		add_movement($village['userid'], $village['id'], $to_user_id, $to_village_id, $send_units_implode, $type, $start_time, $end_time, false, $cata_building, $mili);

		$sql = "";
		$sql = "UPDATE ".$prefix."unit_place SET ";
		$is_first=true;
		foreach($cl_units->get_array("dbname") as $dbname){
			if($is_first){
				$sql .= $dbname."=".$dbname."-'".$send_units[$dbname]."'";
				$is_first = false;
			}else{
				$sql .= ",".$dbname."=".$dbname."-'".$send_units[$dbname]."'";
			}
		}
		$sql .= " WHERE villages_from_id='".$village['id']."' AND villages_to_id='".$village['id']."'";
		$db->query($sql);

		header("Location:game.php?village=".$village['id']."&screen=place");

	}

	

}
if(!isset($error)) $error = "";
$tpl->assign("units", $units);
$tpl->assign("cl_units",$cl_units);
$tpl->assign("cl_builds",$cl_builds);
$tpl->assign("group_units",$group_units);
$tpl->assign("mode", $_GET['mode']);
$tpl->assign("show_build",$show_build);
$tpl->assign("build", 'place');
$tpl->assign("type", $type);
$tpl->assign("values", $values);
$tpl->assign("msec", $mili);
?>