<?php
class getvillagedata{
	var $array;
	var $db;
	var $prefix;

	function __construct(){
		global $db;
		global $prefix;

		$this->prefix = $prefix;
		$this->db = $db;
	}
	function getbyid($id, $array, $count=true){
		global $db;
		global $prefix;
	
		$sql = "SELECT ";
		$sql .= implode(",",$array);
		$sql .= " FROM `".$prefix."villages` WHERE `id`='".$id."'";
		$result = $db->query($sql);
		$row = $db->fetch($result);
		if($count){
			$row['exist_village'] = !isset($count) ? 0 : $count;
		}
		return $row;
	}
	function getbyvillagename($name, $array){
		global $db;
		global $prefix;
	
		$sql = "SELECT ";
		$sql .= implode(",",$array);
		$sql .= " FROM `".$prefix."villages` WHERE `name`='".$name."'";
		$result = $db->query($sql);
		$row = $db->fetch($result);
		
			$row['exist_village'] = !isset($count) ? 0 : $count;
		
		return $row;
	}
}
?>