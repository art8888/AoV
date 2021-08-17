<?php
require_once("GetUserData.php");
class register{
	function checkMail($email){
	if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
		return false;
	}else{
		return true;
	}
}
	function register_js($username, $password, $email, $captcha){
		global $db;
		$datas_cl = new getuserdata();
		$needed_datas = array("id","username","password","email");
		$datas = $datas_cl->getbyusername(parse($username), $needed_datas);
		if($datas['exist_user'] != 0) {
			$error = true;
			return ('{"message":"\''.$username.'\' IS ALREADY TAKEN!","type":"error","sms":"username"}');
		}
		if(strlen($username) < 3){
			$error = true;
			return ('{"message":"USERNAME MUST BE LONGER THAN 4 CHARACTERS AND SHORTER THAN 24","type":"error","sms":"username"}');
		}
		if((!isset($username) || !(strpos($username,";") === false) || !(strpos($username,"'") === false))){
			$error = true;
			return ('{"message":"INVALID CHARACTERS IN USERNAME","type":"error","sms":"username"}');
		}
		if((isset($username) && strlen($username) > 24)){
			$error = true;
			return('{"message":"USERNAME MUST CONTAIN MORE THAN 4 AND LESS THEN 24","type":"error","sms":"username"}');
		}
		if((isset($password) && strlen($password) < 6)){
			$error = true;
			return('{"message":"PASSWORD MUST BE LONGER THAN 6 CHARACTERS!","type":"error","sms":"password"}');
		}
		if((isset($password) && strlen($password) > 32)){
			$error = true;
			return('{"message":"PASSWORD MUS BE SHERTER THAN 32 CHARACTERS!","type":"error","sms":"password"}');
		}
		if(empty($email) || !$this->checkMail($email)){
			$error = true;
			return('{"message":"INVALID EMAIL!","type":"error","sms":"mail"}');
		}
		if(md5($captcha) != $_COOKIE['security']){
			$error = true;
		    return('{"message":"INVALID SECURITY CODE!","type":"error","sms":"captcha"}');
	    }

	    if(!isset($error)){
	    	 $db->query("INSERT INTO `users` (`username`, `password`, `email`, `date`) VALUES ('".$username."', '".md5(crc32(md5(sha1(md5($password)))))."', '".$email."', '".time()."') ");
	    	return('{"message":"REGISTER SUCCES WAIT TO REDIRECT","type":"sucess"}');
	    }

		return $datas;
	}
}
?>