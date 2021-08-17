<?php
require_once("./include.inc.php");
if(isset($_POST['action']) && $_POST['action'] == 'login'){

	$login = new login();
	$playerid = $login->login_js($_POST['username'], $_POST['password']);

	if(is_numeric($playerid)){
		exit('{"message":"LOGIN SUCCES! WAIT TO REDIRECT", "type":"succes"}');
	}
	exit($playerid);
}
if(isset($_POST["action"]) && $_POST["action"] == "logout"){
	$sid = new sid();
	$session = $sid->check_sid($_COOKIE['session']);
	$sid->logout($session['userid']);
	setcookie("session", "", time()-1);
	exit('{"message":"LOGOUT SUCCES","type":"sucess"}');
}
if(isset($_POST['action']) && $_POST['action'] == "register"){
	$register = new register();
    
   $playerid = $register->register_js($_POST['username'], $_POST['password'], $_POST['email'], $_POST['captcha']);
   exit($playerid);
}
?>