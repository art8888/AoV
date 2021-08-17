<?php
$villages = array();
$rows = $db->query("SELECT id, name, points, bonus, x, y, r_wood, r_stone, r_iron, r_pop, storage, farm FROM ".$prefix."villages WHERE userid='".$user['id']."'");
while($row = $db->fetch($rows)){
	$max_storage = ($row['bonus'] == 'storage') ? ($arr_maxstorage[$row['storage']]*(1+$config['bonus_values']['storage'])) : $arr_maxstorage[$row['storage']];

    $max_farm  = ($row['bonus'] == 'farm') ? ($arr_farm[$row['farm']]*(1+$config['bonus_values']['farm'])) : $arr_farm[$row['farm']];

	$villages[$row['id']]['name'] = $row['name'];
	$villages[$row['id']]['storage'] = $max_storage;
	$villages[$row['id']]['farm'] = $max_farm;
	$villages[$row['id']]['points'] = $row['points'];
	$villages[$row['id']]['x'] = $row['x'];
	$villages[$row['id']]['y'] = $row['y'];
	$villages[$row['id']]['r_wood'] = $row['r_wood'];
	$villages[$row['id']]['r_stone'] = $row['r_stone'];
	$villages[$row['id']]['r_iron'] = $row['r_iron'];
	$villages[$row['id']]['r_pop'] = $row['r_pop'];
	$villages[$row['id']]['id'] = $row['id'];

}

$cl_units2 = $cl_units->get_array("dbname");


$tpl->assign("villages", $villages);
$tpl->assign("cl_units2", $cl_units2);
?>