<?php
class units{
	var $dbname = array();
    var $last_dbname;
    var $name = array();
    var $woodprice = array();
    var $stoneprice = array();
    var $ironprice = array();
    var $popprice = array();
    var $att = array();
    var $def = array();
    var $defCav = array();
    var $defArcher = array();
    var $speed = array();
    var $booty = array();
    var $time = array();
    var $recruit_in = array();
    var $needed = array();
    var $specials = array();
    var $group = array();
    var $col = array();
    var $atttype = array();
    var $last_error;
    var $db;
    var $unitfactor;
    var $config;

	function __construct(){
		global $config;
		$this->config = $config;
	}

	function add_unit($name, $dbname){
		$this->dbname[$name] = $dbname;
		$this->name[$dbname] = $name;
		$this->last_dbname = $dbname;
	}

	function set_needed($array){
		$this->needed[$this->last_dbname] = $array;
    }
    function set_woodprice($price){
		$this->woodprice[$this->last_dbname] = "$price";
    }
    function set_stoneprice($price){
		$this->stoneprice[$this->last_dbname] = "$price";
    }
    function set_ironprice($price){
		$this->ironprice[$this->last_dbname] = "$price";
    }
    function set_bhprice($price){
		$this->popprice[$this->last_dbname] = "$price";
    }
    function set_description($text){
		$this->description[$this->last_dbname] = $text;
    }
    function set_time($time){
		$this->time[$this->last_dbname] = "$time";
    }
    function set_att($b,$m){
		$this->att[$this->last_dbname] = "$b,$m";
    }
    function set_group($group){
		$this->group[$this->last_dbname] = $group;
    }
    function set_def($b,$m){
		$this->def[$this->last_dbname] = "$b,$m";
    }
    function set_attType($t){
		$this->atttype[$this->last_dbname] = "$t";
    }
    function set_defcav($b,$m){
		$this->defCav[$this->last_dbname] = "$b,$m";
    }
    function set_defarcher($b,$m){
		$this->defArcher[$this->last_dbname] = "$b,$m";
    }
    function set_speed($value){
		$this->speed[$this->last_dbname] = "$value";
    }
    function set_booty($value){
		$this->booty[$this->last_dbname] = "$value";
    }
    function set_col($value){
		$this->col[$this->last_dbname] = "$value";
    }
    function set_recruit_in($building){
		$this->recruit_in[$this->last_dbname] = "$building";
    }
    function set_unitfactor($b,$m){
		$this->unitfactor = "$b,$m";
    }
    function set_specials($array){
		$this->specials[$this->last_dbname] = $array;
    }
    function get_array($name){
		return $this->$name;
    }
    function get_attType($name){
		$arr = array();
		foreach($this->atttype as $dbname=>$type){
			if($type == $name){
				$arr[] = $dbname;
	    	}
		}
		return $arr;
	}

	function get_col($dbname){
		return $this->col[$dbname];
    }

	function get_speed($dbname, $return_time=''){
		if($return_time == 'minutes'){
			return round($this->speed[$dbname]/60, 1);
		} else {
			return $this->speed[$dbname];
		}
	}
	function get_woodprice($dbname){
		return $this->woodprice[$dbname];
    }
    function get_stoneprice($dbname){
		return $this->stoneprice[$dbname];
    }
    function get_ironprice($dbname){
		return $this->ironprice[$dbname];
    }
    function get_specials($dbname){
		return $this->specials[$dbname];
    }
    function get_needed($dbname){
		return $this->needed[$dbname];
    }
    function get_description($dbname){
		return $this->description[$dbname];
    }
    function get_countNeeded($dbname){
		return count($this->needed[$dbname]);
    }
    function get_popprice($dbname){
		return $this->popprice[$dbname];
    }
    function get_group($dbname){
		return $this->group[$dbname];
    }
    function get_time($bonus, $build, $stage, $unit, $param=''){
    	global $config;


    	if($bonus == $build){
    		$tr = $config['bonus_values'][$bonus];
    	}else{
    		$tr = 0;
    	}
        
		list($start2, $faktor2) = explode(",", $this->unitfactor);
		$fakt = $start2 * pow($faktor2, $stage);
		if(empty($unit)){
		    return round($fakt, '2');
		}
		$time = round($fakt * $this->time[$unit]);
		if($param != "not_round"){
		    return round(($time-($time*$tr))/$this->config['speed']);
		}else{
		    return ($time-($time*$tr))/$this->config['speed'];
		}
    }
    
    function get_lowest_unit($array){
		$time = 0;
		foreach($array as $dbname=>$num){
	    	if($this->get_speed($dbname) > $time && $num > 0){
				$time = $this->get_speed($dbname);
	    	}
		}
		return $time;
    }
    function get_recruit_in_units($building){
		$units = array();
		foreach($this->name as $dbname=>$name){
		    if($this->recruit_in[$dbname] == $building){
				$units[$dbname] = $name;
		    }
		}
		return $units;
    }


    

    function check_needed($unit, $village){
    	global $db;
    	global $max_farm;
    	global $prefix;

    	foreach($this->needed[$unit] as $building=>$stage){
    		if($village[$building] < $stage){
    			$this->last_error = "not_needed";
    			return "";
    		}
    	}
    	if(!isset($village[$unit.'_tec'])){
    		$village[$unit.'_tec'] = -1;
    	}
    	if($village[$unit.'_tec'] <= 0 && !in_array("no_investigate", $this->get_specials($unit))){
    		$this->last_error = "not_tec";
    		return "";
    	}
    	foreach($this->needed[$unit] as $building=>$stage){
    		if($village[$building] < $stage){
    			$this->last_error = "not_needed";
    			return "";
    		}
    	}
    	if(!isset($village[$unit.'_tec'])){
    		$village[$unit.'_tec'] = -1;
    	}
    	if($village[$unit.'_tec'] <= 0 && !in_array("no_investigate", $this->get_specials($unit))){
    		$this->last_error = "not_tec";
    		return "";
    	}
    	if($village['r_wood'] < $this->woodprice[$unit] || $village['r_stone'] < $this->stoneprice[$unit] || $village['r_iron'] < $this->ironprice[$unit]){
    		$this->last_error = "not_enough_ress";
    	}
    	if(($max_farm-$village['r_pop']-$this->popprice[$unit]) < 0){
    		$this->last_error = "not_enough_pop";
    		return "";
    	}
    	$this->last_error = min(floor($village['r_wood']/$this->woodprice[$unit]), floor($village['r_stone']/$this->stoneprice[$unit]), floor($village['r_iron']/$this->ironprice[$unit]), floor(($max_farm - $village['r_pop'])/$this->popprice[$unit]));
    	return "";

    }
    function recruit_units($name, $count, $building, $bonus, $building_stage, $villageid){
    	global $user, $db, $prefix;

    	$result = $db->query("SELECT time_finished FROM ".$prefix."recruit WHERE villageid='".$villageid."' AND building='".$building."' ORDER BY id DESC LIMIT 1");
    	$last_recruit = $db->fetch($result);
    	if(is_array($last_recruit)){
    		$time = $last_recruit['time_finished'];
    	}else{
    		$time = time();
    	}

    	$unit_time = $this->get_time($bonus, $building, $building_stage, $name, "not_round");
    	$time_finished = round($time+($unit_time*$count));
    	$db->query("INSERT INTO ".$prefix."recruit (unit, num_unit, time_finished, time_start, villageid, building, time_per_unit) VALUES ('".$name."', '".$count."', '".$time_finished."', '".$time."', '".$villageid."', '".$building."', '".$unit_time."')");
    	$id = $db->getlastid();
    	$event_time = $time + $unit_time;
    	$db->query("INSERT INTO ".$prefix."events (event_time, event_type, event_id, user_id, village_id) VALUES ('".$event_time."', 'recruit', '".$id."', '".$user['id']."', '".$villageid."')");
    }

    function read_units($from='', $to=''){
    	global $db, $prefix;

    	$sql = "SELECT ";
    	$i = 0;
    	foreach($this->get_array("dbname") as $dbname){
    		if($i == 0){
    			$sql .= "SUM($dbname) AS $dbname";
    		}else{
    			$sql .= ", SUM($dbname) AS $dbname";
    		}
    		$i++;
    	}
    	$sql .= " FROM ".$prefix."unit_place WHERE ";
    	if(!empty($from) && !empty($to)){
    		$sql .= "villages_from_id='".$from."' AND villages_to_id='".$to."'";
    	}elseif(empty($from) && !empty($to)){
    		$sql .= "villages_to_id='".$to."'";
    	}elseif(!empty($from) && empty($to)){
    		$sql .= "villages_from_id='".$from."'";
    	}else{
    		exit;
    	}
    	$result = $db->query($sql);
    	return $db->fetch($result);
    }
    function get_slowest_unit($array){
    	foreach($array as $key=>$value){
    		if($value > 0){
    			$times[] = $this->get_speed($key);
    		}
    		
    		
    	}
    	return max($times);
    }
    function get_name($dbname){
		return $this->name[$dbname];
    }
    function get_booty($dbname){
		return $this->booty[$dbname];
    }
    function get_graphicName($dbname){
		return array_pop(explode("_", $dbname));
    }
    function get_att($dbname,$stage){
		list($start, $faktor) = explode(",", $this->att[$dbname]);
		return round(($start/$faktor)*pow($faktor, $stage));
    }
    function get_def($dbname,$stage){
		list($start, $faktor) = explode(",", $this->def[$dbname]);
		return round(($start/$faktor)*pow($faktor, $stage));
    }
    function get_defCav($dbname,$stage){
		list($start, $faktor) = explode(",", $this->defCav[$dbname]);
		return round(($start/$faktor)*pow($faktor, $stage));
    }
    function get_defarcher($dbname,$stage){
		list($start, $faktor) = explode(",", $this->defArcher[$dbname]);
		return round(($start/$faktor)*pow($faktor, $stage));
    }
}
?>