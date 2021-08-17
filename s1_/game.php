<?php
function msec(){
    list($msec, $sec) = explode(' ', microtime());
    return ($sec%3600)*1000+$msec*1000;
}
function gets_ms(){
	global $load_msec;
	echo "".(msec()-$load_msec)."";
}

$load_msec = msec();

require_once("./include.inc.php");

$sid = new sid();
$session = $sid->check_sid($_COOKIE['session']);
if(!$session['userid']){
	header ("Location: sid_wrong.php");
	exit;
}

$userdatas = new GetUserData();
$usersql = array('villages', 'coins', 'next_coin', 'points', 'tribe');
$user = $userdatas->getbyid($session['userid'], $usersql, false);

$user['id'] = $session['userid'];

$villagedatas = new GetVillageData();
if(empty($_GET['village'])){
	$_GET['village'] = getfirstvillage($user['id']);
}

$villagesql = array("userid", "id", "name", "x", "y", "points", "bonus", "last_act", "r_wood", "r_stone", "r_iron", "r_pop", "main", "barracks", "stable", "garage", "smith", "snob", "place", "market", "wood", "stone", "iron", "farm", "storage", "wall", "unit_spear", "unit_sword", "unit_axe", "unit_archer", "unit_spy", "unit_light", "unit_marcher", "unit_heavy", "unit_ram", "unit_cat", "unit_snob");
$village = $villagedatas->getbyid($_GET['village'], $villagesql);





$allow_screens = array("place_units_try_back","report","place_confirm","info_village","place","smith","snob","map","overview","main","overview_villages","settings","barracks","wood","stone","iron","farm","storage","hide","wall","stable","garage","info_command","ranking","market","market_confirm_send","mail","ally","info_player","info_ally","info_member","memo","train","friends","sim", "stats", "troops");

$tpl = new AOV_Smarty;


if(!isset($_GET['screen']))
	header("LOCATION: game.php?village=&screen=overview");

if(in_array(@$_GET['screen'], $allow_screens)){
	require_once("actions/".$_GET['screen'].".php");
}


$speed = get_server_speed("speed");
$config['speed'] = $speed;

$max_storage = ($village['bonus'] == 'storage') ? ($arr_maxstorage[$village['storage']]*(1+$config['bonus_values']['storage'])) : $arr_maxstorage[$village['storage']];

$max_farm  = ($village['bonus'] == 'farm') ? ($arr_farm[$village['farm']]*(1+$config['bonus_values']['farm'])) : $arr_farm[$village['farm']];


$wood_h = res_per_h($village, 'wood');
$stone_h = res_per_h($village, 'stone');
$iron_h = res_per_h($village, 'iron');

$is_building = is_building($_GET['village']);


$diff = time()-$village['last_act'];


foreach($cl_builds->get_array("dbname") as $dbname){
	array_push($villagesql, $dbname);
}





$tpl->assign("servertime", date("G:i:s"));
$tpl->assign("serverdate", date("d/m/Y"));
$tpl->assign("load_msec", round(msec()-$load_msec));
$tpl->assign("hkey", $session['hkey']);
$tpl->assign("screen", @$_GET['screen']);
$tpl->assign("village", $village);
$tpl->assign("user", $user);
$tpl->assign("wood_per_hour", $wood_h);
$tpl->assign("stone_per_hour", $stone_h);
$tpl->assign("iron_per_hour", $iron_h);
$tpl->assign("max_storage", $max_storage);
$tpl->assign("max_pop", floor($max_farm));
$tpl->assign("is_building", $is_building);
$tpl->assign("is_recruting_b", is_recruting_b($_GET['village']));
$tpl->assign("is_recruting_s", is_recruting_s($_GET['village']));
$tpl->assign("is_recruting_g", is_recruting_g($_GET['village']));
$tpl->assign("is_recruting_n", is_recruting_n($_GET['village']));
$tpl->assign("is_researching", is_researching($_GET['village']));
$tpl->assign("allow_screens", $allow_screens);
$tpl->assign("config", $config);
$tpl->assign("now", time());
$tpl->assign("sid", $sid);
$lang = new aLang("game", "EN");
$tpl->assign("lang", $lang);
$tpl->display("game.tpl");
?>
