<?php


if(isset($_GET['x']) && is_numeric($_GET['x']) && !($_GET['x'] > get_server_speed('dimension'))){
	$map['x'] = $_GET['x'];
} else {
	$map['x'] = $village['x'];
}
if(isset($_GET['y']) && is_numeric($_GET['y']) && !($_GET['y'] > get_server_speed('dimension'))){
	$map['y'] = $_GET['y'];
} else {
	$map['y'] = $village['y'];
}

$map['size'] = 16;

if($map['x'] > get_server_speed('dimension')){
	$map['x'] = get_server_speed('dimension');
}
if($map['y'] > get_server_speed('dimension')){
	$map['y'] = get_server_speed('dimension');
}
if($map['x'] <= 0) {
	$map['x'] = 0;
}
if($map['y'] <= 0){
	$map['y'] = 0;
}

$one_right_coords = ($map['size'])/2;



$x_b = ($map['x']-$one_right_coords < 0) ? 0 : $map['x']-$one_right_coords;
$x_e = ($map['x']+$one_right_coords > get_server_speed('dimension')) ? get_server_speed('dimension') : $map['x']+$one_right_coords;

$y_b = ($map['y']-$one_right_coords < 0) ? 0 : $map['y']-$one_right_coords;
$y_e = ($map['y']+$one_right_coords > get_server_speed('dimension')) ? get_server_speed('dimension') : $map['y']+$one_right_coords;

for($n = $x_b; $n <= $x_e; ++$n){
	$x_coords[] = ceil($n);
}
for($n = $y_b; $n<=$y_e; ++$n){
	$y_coords[] = ceil($n);
}

$cl_map = new map();
$cl_map->search_villages($x_b, $x_e, $y_b, $y_e);



$tpl->assign("map", $map);

$tpl->assign("cl_map", $cl_map);
$tpl->assign("x_coords", $x_coords);
$tpl->assign("y_coords", $y_coords);
?>