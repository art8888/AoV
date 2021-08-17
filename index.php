<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
require_once("./include.inc.php");
require_once("include/config.php");
$sid = new Sid();

function msec() {
	list($msec, $sec) = explode(' ', microtime());
	return ($sec%3600)*1000+$msec*1000;
}

function get_ms($a) {
	global $load_msec;
	echo "$a:".(msec()-$load_msec)."<br />";
}



$load_msec = msec();
$session = $sid->check_sid($_COOKIE['session']);

if($session['userid']){

	$logged_in = true;
	$hkey = $session['hkey'];

	$userdatas = new GetUserData();
	$usersql = array("username", "date", "email");
	$user = $userdatas->getbyid($session['userid'], $usersql, false);
	$user['id'] = $session['userid'];

    

    $rows = $db->query("SELECT * FROM worlds ORDER BY id ASC");
	while($row = $db->fetch($rows)){
		$worlds[$row['id']]['name'] = entparse($row['name']);
		$worlds[$row['id']]['db'] = entparse($row['db']);

		if($row['locked'] == '0')
			$worlds[$row['id']]['class'] = ' gray';
		if($row['exist'] == 1)
			$worlds[$row['id']]['class'] = ' green';
		$worlds[$row['id']][] = $row; 
	}
}
function villages($s, $u){
	global $db;
	return $db->fetch($db->query(("SELECT * FROM ".$s."users WHERE userid='".$u."'")))['villages'];
}
$tpl = new AOV_Smarty;
$lang = new aLang("index", "EN");
$tpl->assign("worlds", $worlds);
$tpl->assign("user", $user);
$tpl->assign("session", $session);
$tpl->assign("logged_in", $logged_in);
$tpl->assign("servertime", date("G:i:s"));
$tpl->assign("serverdate", date("d/m/Y"));
$tpl->assign("load_msec", round(msec()-$load_msec)); 
$tpl->assign("config", $config);
$tpl->assign("ip", $config);
$tpl->assign("lang", $lang);
$tpl->assign("cookie", $_COOKIE['session']);
$tpl->display('index.tpl');
?>