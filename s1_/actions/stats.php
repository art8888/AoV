<?php
$units = $cl_units->get_array("dbname");

$u = array();

$r = array("r_wood", "r_stone", "r_iron");

foreach($r as $name){
	$r2[$name] = $db->fetch($db->query("SELECT SUM(".$name.") as '".$name."' FROM ".$prefix."villages "))[$name];
}

foreach($units as $dbname){
	$u[$dbname] = $db->fetch($db->query("SELECT SUM(".$dbname.") as '".$dbname."' FROM ".$prefix."villages "))[$dbname];;
}

$tpl->assign("cl_units2", $units);
$tpl->assign("u", $u);
$tpl->assign("r", $r2);
?>