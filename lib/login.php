<?php
require_once("GetUserData.php");
class login{
	var $sid;

	function login_js($username, $password){
		global $db;	

		$datas_cl = new getuserdata();
		$needed_datas = array("id","username","password","banned");
		$datas = $datas_cl->getbyusername(parse($username), $needed_datas);
		if($datas['exist_user'] == "0"){
		    return '{"message":"WRONG USERNAME!","type":"error","sms":"username"}';
		}elseif($datas['password'] != md5(crc32(md5(sha1(md5($password)))))){
		    return '{"message":"Invalid PASSWORD!","type":"error","sms":"password"}';
		}elseif($datas['banned'] == "Y"){
		    return '{"message":"ACCOUNT BANNED!","type":"error","sms":"username"}';
		}
		$sid = new sid();
        $sid = $sid->create_sid($datas['id']);
        $db->query("INSERT INTO `logins` (`username`,`time`,`ip`,`userid`) VALUES ('".$datas['username']."','".time()."','".$_SERVER['REMOTE_ADDR']."','".$datas['id']."')");
		return $datas;
	}
}
?>