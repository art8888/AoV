<?php
require_once("./include.inc.php");

$sid = new sid();
$session = $sid->check_sid($_COOKIE['session']);

if(!$session['userid']){
	header("LOCATION:sid_wrong.php");
	exit;
}

$userdatas = new GetUserData();
$usersql = array('username', 'villages');

$user = $userdatas->getbyid($session['userid'], $usersql, true);

if($user['exist_user'] == 0){
	create_user($session['userid']);
}

$n = count(generate_coords()['x']);
$r = rand(0, $n);

if(isset($_GET['action']) && $_GET['action'] == "create" && $user['villages'] == 0){
	
	create_village($session['userid'], $user['username'], generate_coords()['x'][$r], generate_coords()['y'][$r], false, '-1');
	add_village($session['userid']);
	header("LOCATION: game.php?screen=overview_villages");
		
	
}


$tpl = new AOV_Smarty;
$lang = new aLang("createvillage", "EN");
$tpl->assign("lang", $lang);
$tpl->assign("config", $config);
$tpl->display("createvillage.tpl");
?>