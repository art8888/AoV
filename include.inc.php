<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('precision', '20');

define('PATH', str_replace(PATH_SEPARATOR, '/', dirname(__FILE__)));

function Autoloader($class_name){
	$root = PATH."/lib/";
	$search_dirs = array(
		'{name}.php',
		'{name}.class.php',
		'class/{name}.class.php',
		'class/{name}.class.php',
		'smarty/{name}.class.php',
	);
	foreach($search_dirs as $dir){
		$dir = str_replace('{name}', $class_name, $dir);
		if(file_exists($root.$dir)){
			require_once($root.$dir);
			break;
		}
	}
}

spl_autoload_register('Autoloader');
require_once(PATH."/include/config.php");
require_once(PATH."/lib/functions.php");
$db = new DB_MySQL();
$sid = new sid();
$db->connect($config['host'], $config['user'], $config['password'], $config['db'], "MySql");
$run_key = generate_key();
?>