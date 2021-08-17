<?php
class getuserdata{
	var $array;
	var $db;
	var $prefix;

	function __construct(){
		global $db;
		global $prefix;

		$this->prefix = $prefix;

		$this->db = $db;
	}
	function getbyid($id,$array,$count=true){
		global $prefix;
		$sql = 'SELECT ';
		if($count){
			$sql .= 'COUNT(`id`) AS `exist_id`, ';
		}

		$array_pop = array_pop($array);
		foreach($array as $key){
			$sql .= '`'.$key.'`, ';
		}
		$sql .= '`' . $array_pop . '`';
		$sql .= ' FROM `'.$prefix.'users` WHERE `userid` = ' . $id;
		if($count){
			$sql .= ' GROUP BY ';
			foreach($array as $key){
				$sql .= '`'.$key.'`, ';
			}
			$sql .= '`'.$array_pop.'`';
		}
		$result = $this->db->query($sql);
		$row    = $this->db->fetch($result);
		if($count){
			$row['exist_user'] = !isset($row['exist_id']) ? 0 : $row['exist_id'];
		}
		return $row;
	}
	function getbyusername($username,$array){
		$sql = 'SELECT COUNT(`username`) AS `exist_user`';
		$array_pop = array_pop($array);
		foreach($array as $key){
			$sql .= ', `'.$key.'`';
		}
		$sql .= ' FROM `'.$this->prefix.'users` WHERE `username` = \'' . $username . '\' ';
		$row = $this->db->fetch($this->db->query($sql));

		$row['exist_user'] = !isset($row['exist_user']) ? 0 : $row['exist_user'];

		return $row;
	}
}
?>