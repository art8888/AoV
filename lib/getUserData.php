<?php
class getuserdata{
	var $array;
	var $db;

	function __construct(){
		global $db;

		$this->db = $db;
	}
	function getbyid($id,$array,$count=true){
		$sql = 'SELECT ';
		if($count){
			$sql .= 'COUNT(`id`) AS `exist_id`, ';
		}

		$array_pop = array_pop($array);
		foreach($array as $key){
			$sql .= '`'.$key.'`, ';
		}
		$sql .= '`' . $array_pop . '`';
		$sql .= ' FROM `users` WHERE `id` = ' . $id;
		if($count){
			$sql .= ' GROUP BY ';
			foreach($array as $key){
				$sql .= '`'.$key.'`, ';
			}
			$sql .= '`'.$array_pop.'`';
		}
		$row = $this->db->fetch($this->db->query($sql));
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
		$sql .= ' FROM `users` WHERE `username` = \'' . $username . '\' ';
		$row = $this->db->fetch($this->db->query($sql));

		$row['exist_user'] = !isset($row['exist_user']) ? 0 : $row['exist_user'];

		return $row;
	}
}
?>