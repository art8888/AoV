<?php
class sid{
	var $db;

	function __construct(){
		global $db;

		$this->db = $db;
	}
	function test(){
		return $this->db->numrows("SELECT COUNT(sid) FROM `sessions` WHERE `sid`='2'");
	}
	function create_sid($userid){
		$this->db->query("DELETE FROM `sessions` WHERE `userid`='".$userid."'");
		do{
			$sid_letters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$sid = "";
			for($n=1;$n<=32;$n++){
				$sid .= $sid_letters{rand(0, 61)};
			}
			$result = $this->db->numrows("SELECT COUNT(sid) FROM `sessions` WHERE `sid`='".$sid."'");
		}while(($result)==0);
		$hkey = "";
		for($n=1;$n<=4;++$n){
			$hkey .= $sid_letters[rand(0, 61)];
		}
		$this->db->query("INSERT INTO `sessions` (`userid`,`hkey`,`sid`) VALUES ('".$userid."','".$hkey."','".$sid."')");
		setcookie("session", $sid);
	}
	function logout($userid){
		return $this->db->query("DELETE FROM `sessions` WHERE `userid`='".$userid."'");
    }
	function check_sid($sid){
		$sid = parse($sid);
		$result = $this->db->query("SELECT `userid`,`hkey`,`sid` FROM `sessions` WHERE `sid`='".$sid."'");
		$row = $this->db->fetch($result);
		if($result === false)
			return false;
		return $row;
	}
}
?>