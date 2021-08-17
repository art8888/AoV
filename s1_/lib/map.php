<?php
class map{
	var $db;
	var $config;
	var $prefix;
	var $user;
	var $village;
	var $villages;
	var $ally;
	var $players;


	function __construct(){
		global $db, $user, $village, $prefix, $config;

		$this->db = $db;
		$this->user = $user;
		$this->village = $village;
		$this->prefix = $prefix;
		$this->config = $config;
	}

	function search_villages($x_b, $x_e, $y_b, $y_e){
		$result = $this->db->query("SELECT id, x, y, points, name, bonus, userid FROM ".$this->prefix."villages WHERE (x>='".$x_b."' AND x<='".$x_e."') AND (y>='".$y_b."' AND y<='".$y_e."')");
		while($row_vill = $this->db->fetch($result)){
			foreach($row_vill as $key=>$value){
				$this->villages[$row_vill['x']][$row_vill['y']][$key] = $value;
			}
			if($row_vill['userid'] != "-1"){
				if(!isset($this->players[$row_vill['userid']])){
					$result2 = $this->db->query("SELECT `tribe`,`username`,`points` FROM `".$this->prefix."users` WHERE `userid`='".$row_vill['userid']."'");
					$row_user = $this->db->fetch($result2);
					if(is_array($row_user)){
						foreach($row_user as $key=>$value){
							$this->players[$row_vill['userid']][$key] = $value;
						}
					}
					if(!isset($this->ally[$row_user['tribe']]) && $row_user['tribe'] != "-1"){
						$result3 = $this->db->query("SELECT `id`,`points`,`short`,`name` FROM `".$this->prefix."tribes` WHERE `id`='".$row_user['ally']."'");
						$row_ally = $this->db->fetch($result3);
						if(is_array($row_ally)){
							foreach($row_ally as $key=>$value){
								$this->ally[$row_user['tribe']][$key] = $value;
							}
						}
					}
				}
			}	
		}
	}

	function has_villages($x, $y){
		$result = $this->db->fetch($this->db->query("SELECT type FROM ".$this->prefix."map WHERE x='".$x."' AND y='".$y."'"))['type'];
		if($result == 'e') {
			return false;
		} else {
			return true;
		}
	}

	function getvillage($x,$y,$type){
		return $this->villages[$x][$y][$type];
	}

	function getVillageId($x, $y){
		return $this->villages[$x][$y]['id'];
	}

	function environement($x, $y){
		return $this->db->fetch($this->db->query("SELECT image FROM ".$this->prefix."map WHERE x='".$x."' AND y='".$y."'"))['image'];
	}

	function graphic($x, $y){
		$graphic = "";
			if($this->villages[$x][$y]["bonus"] == "-1"){
			    $graphic .= "v";
		    } else {
			    $graphic .= "b";
		    }
		    $v = true;
		    $points = $this->villages[$x][$y]["points"];
		    if($points < 300 && $v){
			    $graphic .= "1";
		    }elseif($points < 1000 && $v){
			    $graphic .= "2";
		    }elseif($points < 3000 && $v){
			    $graphic .= "3";
		    }elseif($points < 9000 && $v){
			    $graphic .= "4";
		    }elseif($points < 11000 && $v){
			    $graphic .= "5";
		    }elseif($v){
			    $graphic .= "6";
		    }
		    if($this->villages[$x][$y]['userid'] == "-1"){
			    $graphic .= "_left";
		    } else {
			    $graphic .= "";
		    }
		
		
		$graphic .= ".png";
		return $graphic;
	}

	function getColor($x, $y){
		$getAllyTypeEnemy = $this->db->query("SELECT to_ally, type FROM ".$this->prefix."ally_contracts WHERE from_ally='".$this->user['tribe']."' AND type='enemy'");
		$toAllyEnemy = array();
		while($typeEnemyRow = $this->db->fetch($getAllyTypeEnemy)){
			$toAllyEnemy[] = $typeEnemyRow['to_ally'];
		}
		if(($this->village['x'] == $x) && ($this->village['y'] == $y)){
			$rgb = "255,255,255";
		}elseif($this->villages[$x][$y]['userid'] == $this->user['id']){
			$rgb = "240,200,0";
		}elseif($this->players[$this->getvillage($x,$y,'userid')]['tribe'] == $this->user['tribe'] && $this->user['tribe'] != "-1"){
			$rgb = "0,0,224";
		}elseif(in_array($this->players[$this->getvillage($x,$y,'userid')]['tribe'], $toAllyEnemy)){
			$rgb = "244,0,0";
		
		}else{
			$rgb = "130,60,10";
		}
		return $rgb;
	}


}
?>