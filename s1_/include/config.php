<?php
date_default_timezone_get("Europe/Paris");

$config['name'] = "Age of Vandals";
$config['cdn'] = 'global_cdn';
$config['Version'] = "0.0.1";
$config['Server1'] = "BETA TEST";

$config['host'] = "localhost";
$config['user'] = "root";
$config['password'] = "";
$config['db'] = "aov";

$config['density'] = 60;
$config['radius'] = 3;
$config['dimension'] = 100;
$config['prefix'] = "s1_";

$config['speed'] = 900;

$config['ram']['wall']['base'] = 6.1;
$config['ram']['wall']['factor'] = 1.09;

$config['defense'] = 50;

$config['units'] = array('spear', 'sword', 'axe', 'archer', 'spy', 'light', 'marcher', 'heavy', 'ram', 'cat', 'snob');

$config['bonus_types'] = array('all', 'barracks', 'farm', 'garage', 'iron', 'stable', 'stone', 'storage', 'wood');
$config['bonus_values'] = array('all'=>0.33,
	                            'barracks'=>0.50,
	                            'farm'=>0.10,
	                            'garage'=>0.50,
	                            'stable'=>0.50,
	                            'iron'=>1,
	                            'stone'=>1,
	                            'storage'=>0.50,
	                            'wood'=>1
	                            );


$config['$arr_builds_starts_by_one'] = array('main','farm','storage');
?>