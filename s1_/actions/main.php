<?php
$do_build = array();
$total_build = 0;
$total_stage = 0;

foreach($cl_builds->get_array("dbname") as $key=>$value){
	$total_build += $village[$value];
	$total_stage += $cl_builds->get_maxstage($value);
}

$builds = $cl_builds->get_array("dbname");
foreach($builds as $key => $value){
	$build_village[$value] = $village[$value];
}

$i = 0;
$result = $db->query("SELECT id, building, end_time, build_time, stage FROM ".$prefix."buildings WHERE villageid='".$village['id']."' ORDER BY id");
while($row = $db->fetch($result)){
	$do_build[$i]['build'] = $row['building'];
	$do_build[$i]['id'] = $row['id'];
	$do_build[$i]['stage'] = ++$build_village[$row['building']];

	$do_build[$i]['time'] = $row['end_time']-time();
	$do_build[$i]['finished'] = $row['end_time'];
	++$i;
}


$fulfilled_builds = array();
foreach($builds as $id=>$dbname){
	$needed = $cl_builds->get_needed($id);
	$needed_done = true;
	foreach($needed as $dbname2 => $needed_stage){
		if($village[$dbname2] < $needed_stage){
			$needed_done = false;
		}
	}
	if($village[$dbname] > 0 || $needed_done){
		$fulfilled_builds[$id] = $dbname;
	}
}

if(isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'build'){
	$dbname_array = $cl_builds->get_array("dbname");
	$id_array = array_flip($cl_builds->get_array('dbname'));

	if(!is_string($_GET['id']) || !in_array($_GET['id'], $dbname_array)){
		$error = "Bulding doesn't exist!";
	}

	if(empty($error)){
		$wood = $cl_builds->get_wood($_GET['id'],$build_village[$_GET['id']]+1);
		$stone = $cl_builds->get_stone($_GET['id'],$build_village[$_GET['id']]+1);
		$iron = $cl_builds->get_iron($_GET['id'],$build_village[$_GET['id']]+1);
		$pop = $cl_builds->get_pop($_GET['id'],$build_village[$_GET['id']]+1);
		$time = $cl_builds->get_time($village['main'],$_GET['id'],$build_village[$_GET['id']]+1);
		$onlytime = $cl_builds->get_time($village['main'],$_GET['id'],$build_village[$_GET['id']]+1);

		$result = $db->query("SELECT end_time FROM ".$prefix."buildings WHERE villageid='".$village['id']."' ORDER BY id DESC LIMIT 1");
		$row = $db->fetch($result);
		if($db->affectedrows() == "0") {
			$time += time();
			$add_village_sql = ",main_build='".$_GET['id'].",$time' ";
		}else{
			$time += $row['end_time'];
		}

		$db->query("UPDATE ".$prefix."villages SET r_wood=r_wood-'".round($wood)."', r_stone=r_stone-'".round($stone)."', r_iron=r_iron-'".round($iron)."', r_pop=r_pop+'".$pop."' ".$add_village_sql." WHERE id='".$village['id']."' ");
		$db->query("INSERT INTO ".$prefix."buildings (building, villageid, end_time, build_time) VALUES ('".$_GET['id']."', '".$village['id']."', '".$time."', '".$onlytime."') ");
		$buildid = $db->getlastid();
		$db->query("INSERT INTO ".$prefix."events (event_time, event_type, event_id, user_id, village_id) VALUES ('".$time."', 'build', '".$buildid."', '".$user['id']."', '".$village['id']."')");
		
		header("LOCATION: game.php?screen=main&village=".$village['id']."");

	}
}
if(isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == "cancel"){
	$g_id = parse($_GET['id']);
	$result = $db->query("SELECT building, villageid FROM ".$prefix."buildings WHERE id='".$g_id."'");
	$broke_build = $db->fetch($result);

	if(empty($broke_build['building'])){
		$error = "";
	}

	if($village['id'] != $broke_build['villageid']){
		$error = "";
	}

	if(empty($error)){
		$result = $db->query("DELETE FROM ".$prefix."buildings WHERE id='".$g_id."'");

		if($db->affectedRows() != "0"){
			$broke_build['stage'] = $build_village[$broke_build['building']];

			$wood = $cl_builds->get_wood($broke_build['building'], $broke_build['stage']);
			$stone = $cl_builds->get_stone($broke_build['building'], $broke_build['stage']);
			$iron = $cl_builds->get_iron($broke_build['building'], $broke_build['stage']);
			$pop = $cl_builds->get_pop($broke_build['building'], $broke_build['stage']);

			$db->query("UPDATE ".$prefix."villages SET r_wood=r_wood+'".$wood."', r_stone=r_stone+'".$stone."', r_iron=r_iron+'".$iron."', r_pop=r_pop-'".$pop."' WHERE id='".$village['id']."' ");
			$db->query("DELETE FROM ".$prefix."events WHERE event_id='".$g_id."' AND event_type='build'");

			$old_time = time();
			$village2 = $village;
			$is_first = true;

			$result = $db->query("SELECT id, build_time, end_time, building FROM ".$prefix."buildings WHERE villageid='".$village['id']."' ORDER BY id");

			while($row = $db->fetch($result)){
				$stage = ++$village2[$row['building']];
				$n_build_time = $cl_builds->get_time($village['main'], $row['building'], $stage);

				if($row['end_time']-$row['build_time'] < time() && $is_first) {
					$old_time = $row['end_time'];
				} else {
					$old_time = $old_time+$n_build_time;
					$db->query("UPDATE ".$prefix."buildings SET end_time='".$old_time."', build_time='".$n_build_time."' WHERE id='".$row['id']."'");
					$db->query("UPDATE ".$prefix."events SET event_time='".$old_time."' WHERE event_id='".$row['id']."' AND event_type='build' ");
				}
				if($is_first) {
					$first_build = $row['building'].",".$old_time;
				}
				$is_first = false;
			}
			if($is_first == true) {
				$db->query("UPDATE ".$prefix."villages SET main_build='' WHERE id='".$village['id']."'");
			} else {
				$db->query("UPDATE ".$prefix."villages SET main_build='".$first_build."' WHERE id='".$village['id']."' ");
			}
			header("LOCATION:game.php?village=".$village['id']."&screen=main");
		}
	}
}


$tpl->assign("building", is_building($village['id']));
$tpl->assign("cl_builds", $cl_builds);
$tpl->assign("fulfilled_builds", $fulfilled_builds);
$tpl->assign("build_village", $build_village);
$tpl->assign("cl", $cl);
$tpl->assign("builds", $builds);
$tpl->assign("do_build", $do_build);
?>