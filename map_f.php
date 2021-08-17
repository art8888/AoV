<?php
Class Map{
	var $db;
	var $d;
	var $grid_l;
	var $typeoftile;

	function Map() {
		include "include/config.php";
		$this->d = $config['dimension'];
		$this->prefix = $config['prefix'];
		$this->db = mysqli_connect($config['host'], $config['user'], $config['password']);
		mysqli_select_db($this->db, $config['db']);
	}

	function clear(){
		return $this->db->query("DELETE FROM ".$this->prefix."map WHERE id>'0'");
	}

	function gen(){
			for($i = 0; $i<=$this->d; $i++){
				for($j = 0; $j<=$this->d; $j++){
					$q = $this->db->query("INSERT INTO ".$this->prefix."map (x, y, image) VALUES ('".$i."', '".$j."', 'gras1')");
					
				}
			}		
	}

	function map_DataCoord($x, $y){
		return  $this->db->query("SELECT * FROM ".$this->prefix."map WHERE x='".$x."' AND y='".$y."'")->fetch_assoc()['id'];
	}

	function max_d(){
		return $this->db->query("SELECT MAX(x) AS x FROM ".$this->prefix."map")->fetch_assoc()['x'];
	}

	function have_village($x, $y){
		$c =  ($this->db->query("SELECT * FROM ".$this->prefix."villages WHERE x='".$x."' AND y='".$y."'"))->num_rows;
		$row = $this->db->query("SELECT userid FROM ".$this->prefix."villages WHERE x='".$x."' AND y='".$y."'")->fetch_assoc();

		if($c == 1){
			$image = "v1";
			if($row != -1){
				$image .= "_left";
			}
			return $this->db->query("UPDATE ".$this->prefix."map SET image='".$image."', locked=1 WHERE x='".$x."' AND y='".$y."' ");
		}

	}

	function map_show(){
		for($k = 0; $k <= $this->d; $k++){
			$st_x = ($k + 1)*53;
			echo '<div style="position:absolute;left:'.$st_x.'px;top:0px;width:50px">'.$k.'</div>';
		}
		for($j = 0; $j <= $this->d; $j++){
			$st_y = ($j + 1)*38;
			echo '<div style="position:absolute;left:0px;top:'.$st_y.';width:50px;">'.$j.'</div>';
		}

		for($m = 0; $m <= $this->d; $m++){
			for($i = 0; $i <= $this->d; $i++){
				//$this->have_village($m, $i);
				$xm = ($m + 1)*53;
				$ym = ($i + 1)*38;

				echo '<div id="'.$this->map_DataCoord($m, $i).'"  class="'.$this->map_Data($this->map_DataCoord($m, $i),'image').' tile" style="left:'.$xm.'px;top:'.$ym.'px;height:38px;width:53px;"></div>';
			}
		}
	}

	function is_next($id){

		$ra = array();

		$x = $this->map_Data($id, 'x');
		$y = $this->map_Data($id, 'y');

		$xp = (($this->is_same($x+1, $y))||($x+1 > $this->d)||($this->is_inarray($this->map_DataCoord($x+1, $y)))) ? 'O' : 'G';
		$yp = (($this->is_same($x, $y+1))||($y+1 > $this->d)||($this->is_inarray($this->map_DataCoord($x, $y+1)))) ? 'O' : 'G';

		$xm = (($this->is_same($x-1, $y))||($x-1 < 0)||($this->is_inarray($this->map_DataCoord($x-1, $y)))) ? 'O' : 'G';
		$ym = (($this->is_same($x, $y-1))||($y-1 < 0)||($this->is_inarray($this->map_DataCoord($x, $y-1)))) ? 'O' : 'G';

		return "".$ym."".$xp."".$yp."".$xm."";
	}

	function is_same($x, $y){
		//return (($this->db->query("SELECT * FROM mapgen WHERE x='".$x."' AND y='".$y."'"))->fetch_assoc()['type'] == $this->typeoftile) ? true : false;
	}

	function is_inarray($id){
		return in_array($id, $this->grid_l);
	} 

	function is_locked($x, $y){
		return ($this->db->query("SELECT locked FROM ".$this->prefix."map WHERE x='".$x."' AND y='".$y."'"))->fetch_assoc()['locked'] ? true : false;
	}

	function map_Data($id, $data){
		return $this->db->query("SELECT * FROM ".$this->prefix."map WHERE id='".$id."'")->fetch_assoc()[$data];
	}

	function assign($grid){
		if($this->$typeoftile == "forest"){
			if($grid == 'GGGG'){
			    $type = "forest0000";
		    }
		    if($grid == 'GOGG'){
			    $type = "forest0001";
		    }
		    if($grid == 'OGGG'){
			    $type = "forest0010";
		    }
		    if($grid == 'OOGG'){
			    $type = "forest0011";
		    }
            if($grid == 'GGGO'){
			    $type = "forest0100";
		    }
		    if($grid == 'GOGO'){
			    $type = "forest0101";
		    }
		    if($grid == 'OGGO'){
			    $type = "forest0110";
		    }
		    if($grid == 'OOGO'){
			    $type = "forest0111";
		    }
		    if($grid == 'GGOG'){
			    $type = "forest1000";
		    }
		    if($grid == 'GOOG'){
			    $type = "forest1001";
		    }
		    if($grid == 'OGOG'){
			    $type = "forest1010";
		    }
		    if($grid == 'OOOG'){
			    $type = "forest1011";
		    }
		    if($grid == 'GGOO'){
			    $type = "forest1100";
		    }
		    if($grid == 'GOOO'){
			    $type = "forest1101";
		    }
		    if($grid == 'OGOO'){
			    $type = "forest1110";
		    }
		    if($grid == 'OOOO'){
			    $type = "forest1111";
		    }
		}
		if($this->$typeoftile == "mountain") {
			if($grid == 'OGGO'){
				$type = "berg1";
			}
			if($grid == 'GGOO'){
				$type = "berg2";
			}
			if($grid == 'GOOG'){
				$type = "berg3";
			}
			if($grid == 'OOGG'){
				$type = "berg4";
			}
		}
		if($this->$typeoftile == "lake"){
			$type = "see";
		}

		return $type;
	}

	function Edit($grid){
		$data = explode("-", $grid);

		$this->grid_l = $data;
		$value = "";

		$return_grid = array();

		foreach($data as $key => $id){
			$return_grid += [$id => "".$this->is_next($id).""];  
			$this->db->query("UPDATE ".$this->prefix."map SET locked=true, image='".$this->assign($return_grid[$id])."' WHERE id='".$id."'");
			//$this->db->query("INSERT INTO grid (data) VALUES ('".$return_grid[$id]."')");
		}
	}
}

$map = new Map;
if($_POST){
	if($_POST['action'] == 'cl'){
		$map->clear();
	}
	if($_POST['action'] == 'gen'){
		$map->gen();
	}
	if($_POST['action'] == 'edit'){
		$map->$typeoftile = $_POST['type'];
		$map->Edit($_POST['grid']);
	}
}
?>