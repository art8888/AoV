<?php
class reports{

	
	function new_report($player){
		global $db;
		global $prefix;

		$db->query("UPDATE ".$prefix."users SET new_report='1' WHERE userid='".$player."'");
	}

	function support($player_from, $village_from_name, $village_to_name, $village_from, $player_to, $village_to, $units, $time){
		global $db;
		global $prefix;
		

		if($player_to != "-1"){
			$title = "".$village_from_name." support ".$village_to_name."";
		} else {
			$title = "".$village_from_name." support barbarians";
		}

		if($player_to != "-1"){
			$db->query("INSERT INTO ".$prefix."reports (title, image, time, type, receiver_userid, to_user, to_village, from_user, from_village, s_units)
				VALUES ('".$title."', 'blue', '".$time."', 'support', '".$player_to."', '".$player_to."', '".$village_to."', '".$player_from."', '".$village_from."', '".$units."')");
			
		}
		if($player_to != "-1" && ($player_to != $player_from)){
			$db->query("INSERT INTO ".$prefix."reports (title, image, time, type, receiver_userid, to_user, to_village, from_user, from_village, s_units)
				VALUES ('".$title."', 'blue', '".$time."', 'support', '".$player_from."', '".$player_to."', '".$village_to."', '".$player_from."', '".$village_from."', '".$units."')");
			
		}
	}

	function attack($player_from, $player_fname, $village_from, $village_fname, $player_to, $player_tname, $village_to, $village_tname, $others, $time, $a_units, $ad_units, $d_units, $dd_units, $defenders, $defenders_units, $defender_units_per_village_dead, $support_villages_name){
		global $db;
		global $prefix;

		$title = $village_fname." attack ".$village_tname;

		$a_units_i = implode(";", $a_units);
		$d_units_i = implode(";", $d_units);

		

		$db->query("INSERT INTO ".$prefix."reports (title, image, from_village, to_village, a_units, ad_units, d_units, dd_units, s_units, luck) VALUES ('".$title."','".$others['factors']."','".$village_from."', '".$village_to."', '".$a_units_i."', '".$ad_units."', '".$d_units_i."', '".$dd_units."', '".$defenders_dead[$village]."', '".$others['luck']."')");

		foreach($defenders as $village){
			$defenders_dead[$village] = implode(";", $defender_units_per_village_dead[$village]);
			$defenders_u[$village] = implode(";", $defenders_units[$village]);
			$title = "Support from ".$support_villages_name[$village]." to ".$village_tname." has been attacked";
			if($village != $village_to){
				$db->query("INSERT INTO ".$prefix."reports (title, from_village, to_village, s_units, dd_units, new_wall, image, luck) VALUES ('".$title."','".$village."', '".$village_to."', '".$defenders_u[$village]."', '".$defenders_dead[$village]."', '".$others['new_wall']."', '".$others['factors']."', '".$others['luck']."')");
			}
			
		}

		
	}
}
?>