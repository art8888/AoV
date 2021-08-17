<?php
class builds{
	var $id;
	var $config;
	var $last_dbname = array();
	var $name = array();
	var $dbname = array();
	var $wood = array();
	var $stone = array();
	var $iron = array();
	var $bh = array();
	var $bh_total = 0;
	var $points = array();
	var $max_stage = array();
	var $needbuilds = array();
	var $needbuilds_by_dbname = array();
	var $build_error2;
	var $build_error;
	var $specials;
	var $graphicCoords = array();
	var $Classe;

	function __construct(){
		global $config;
		$this->config = $config;
	}

	function add_build($name, $dbname){
		$this->last_dbname = $dbname;
		$this->id = count($this->name);
		$this->name[$dbname] = $name;
		$this->dbname[$this->id] = $dbname;
	}

	function set_needbuilds($array){
		$this->needbuilds[$this->id] = $array;
		$this->needbuilds_by_name[$this->last_dbname] = $array;
	}

	function set_mainfactor($b,$m){
		$this->main_factor = "$b,$m";
	}

	function set_woodprice($b, $m){
		$this->wood[$this->last_dbname] = "$b,$m";
	}

	function set_stoneprice($b, $m){
		$this->stone[$this->last_dbname] = "$b,$m";
	}

	function set_ironprice($b, $m){
		$this->iron[$this->last_dbname] = "$b,$m";
	}

	function set_maxstage($stage){
		$this->max_stage[$this->last_dbname] = $stage;
	}

	function set_popprice($b,$m){
		$this->bh[$this->last_dbname] = "$b,$m";
	}

	function set_time($b,$m){
		$this->time[$this->last_dbname] = "$b,$m";
	}

	function set_points($b,$m){
		$this->points[$this->last_dbname] = "$b,$m";
	}

	function set_graphicCoords($coords){
		$this->graphicCoords[$this->last_dbname] = $coords;
	}

	function get_array($array){
		return $this->$array;
	}

	function get_needed($id){
		return $this->needbuilds[$id];
	}

	function get_name($name){
		return $this->name[$name];
	}

	function get_dbname($id){
		return $this->dbname[$id];
	}

	function get_maxstage($dbname){
		return $this->max_stage[$dbname];
	}

	function get_wood($dbname, $stage){
		list($start, $faktor) = explode(",", $this->wood[$dbname]);
		return round(($start/$faktor)*pow($faktor, $stage));
	}

	function get_stone($dbname, $stage){
		list($start, $faktor) = explode(",", $this->stone[$dbname]);
		return round(($start/$faktor)*pow($faktor, $stage));
	}

	function get_iron($dbname, $stage){
		list($start, $faktor) = explode(",", $this->iron[$dbname]);
		return round(($start/$faktor)*pow($faktor, $stage));
	}

	function get_pop($dbname,$stage){
		list($start,$faktor) = explode(",", $this->bh[$dbname]);
		if($stage == "0"){
			return 0;
		}else{
			$bh = round(($start/$faktor)*pow($faktor,$stage) - ($start/$faktor)*pow($faktor,$stage-1));
			$this->bh_total += $bh;
			return $bh;
		}
	}

	function get_graphicCoords($dbname){
		return $this->graphicCoords[$dbname];
	}

	function get_points($dbname, $stage){
		list($start,$faktor) = explode(",", $this->points[$dbname]);
		if($stage == "0"){
			return "0";
		}else{
			return round($start/$faktor*pow($faktor,$stage));
		}
	}

	function get_time($main_stage,$dbname,$stage){
		global $arr_builds_starts_by_one;

		list($start,$faktor) = explode(",", $this->time[$dbname]);
		list($start2,$faktor2) = explode(",", $this->main_factor);
		if(in_array($dbname, $arr_builds_starts_by_one)){
			//$stage -= 1;
		}
		$fakt = $start2*pow($faktor2,$main_stage);
		$time = round(($start/$faktor)*pow($faktor,$stage)*$fakt);
		return round($time/$this->config['speed']);
		
	}

	function get_build_error(){
		return $this->build_error;
	}
	 function get_build_error2(){
		return $this->build_error2;
	}

	function check_needed($buildname, $village){
		$id_arr = array_flip($this->dbname);
		$id = $id_arr[$buildname];
		$needed = true;
		foreach($this->get_needed($id) as $dbname => $stage){
			if($village[$dbname] < $stage){
				$needed = false;
			}
		}
		return $needed;
	}

	function build($village, $building, $build_village){
		global $wood_h;
		global $stone_h;
		global $iron_h;
		global $max_storage;
		global $max_farm;

		$dbname = $this->get_dbname($building);
		if($this->get_maxstage($dbname) <= $build_village[$dbname]){
			$this->build_error2 = "max_stage";
			return "";
		}

		$needed = $this->get_needed($building);
		$needed_done = true;

		foreach($needed as $dbname2 => $needed_stage){
			if($village[$dbname2] < $needed_stage){
				$this->build_error2 = "not_fulfilled";
				return "";
			}
		}
		if($this->get_pop($dbname,$build_village[$dbname]+1) != 0 && $max_farm-$village['r_pop']-$this->get_pop($dbname,$build_village[$dbname]+1) < 0){
			$this->build_error2 = "not_enough_pop";
			return "";
		}

		$wood = round($this->get_wood($dbname, $build_village[$dbname]+1));
		$stone = round($this->get_stone($dbname, $build_village[$dbname]+1));
		$iron = round($this->get_iron($dbname, $build_village[$dbname]+1));

		if($max_storage < max($wood, $stone, $iron)){
			$this->build_error2 = "not_enough_storage";
			return "";
		}
		if($wood > $village['r_wood'] || $stone > $village['r_stone'] || $iron > $village['r_iron']){
			if($wood > $village['r_wood']) {
				$missing = ($wood-$village['r_wood'])/$this->config['speed'];
				$per_second = $wood_h/3600;
				$timeA = $missing/$per_second;
			} else {
				$timeA = 0;
			}
			if($stone > $village['r_stone']){
   				$missing = ($stone-$village['r_stone'])/$this->config['speed'];
   				$per_second = $stone_h/3600;
   				$timeB = $missing/(1+$per_second);
			}else{
			    $timeB = 0;
			}
			if($iron > $village['r_iron']){
   				$missing = ($iron-$village['r_iron'])/$this->config['speed'];
   				$per_second = $iron_h/3600;
   				$timeC = $missing/$per_second;
			}else{
			    $timeC = 0;
			}

			$wait_seconds = ceil(max($timeA,$timeB,$timeC));

			$this->build_error = format_time($wait_seconds);
			$this->build_error2 = "not_enough_ress";
			return "";
		}
		$this->build_error = "";
		$this->build_error2 = "no_error";
	}

	


	
}
?>