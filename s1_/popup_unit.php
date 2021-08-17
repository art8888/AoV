<?php
require_once("include.inc.php");

$unit = @$_GET['unit'];

$tpl = new AOV_Smarty;
$lang = new aLang("game", "EN");
$tpl->assign("lang", $lang);
$tpl->assign("unit", $unit);
$tpl->assign("cl_units", $cl_units);
$tpl->assign("cl_builds", $cl_builds);
$tpl->assign("config", $config);
$tpl->display("popup_unit.tpl");
?>