<?php

function generate_key() {
	return md5(microtime().serialize($_SERVER));
}

function parse($str) {
	$str = urlencode($str);
	$str = trim($str);
	return $str;
}

function entparse($str) {
	$str = urldecode($str);
	$str = stripslashes($str);
	$str = htmlspecialchars($str);
	return $str;
}



function checkMail($email){
	if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
		return false;
	}else{
		return true;
	}
}
?>