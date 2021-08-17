<?php
include('include.inc.php');

$dimension = $db->fetch($db->query("SELECT dimension FROM worlds WHERE dir='".$prefix."'"))['dimension'];

$result_map = $db->query("SELECT x, y, type FROM ".$prefix."map WHERE locked='1'");
while($row = $db->fetch($result_map)){
	$image_objects[$row['x']][$row['y']] = $row['type'];
}
	$image_size = $dimension*2;
	$image_diameter = $image_size/5;
	$image_radius = floor($image_diameter/2);

	$img = imagecreate($image_size, $image_size);

	if(!isset($_GET['x']))
		$_GET['x'] = 0;
	if(!isset($_GET['y']))
		$_GET['y'] = 0;

	$start_left_x = $x-$image_radius;
	$start_left_y = $y-$image_radius;
	$end_right_x = $x+$image_radius;
	$end_right_y = $y+$image_radius;

	$fond = imagecolorallocate($img,61,73,81);
    $liniimari = imagecolorallocate($img,32,41,50);
	$liniimici = imagecolorallocate($img,48,57,66);
	$activ = imagecolorallocate($img,61,73,81);
	$sate = imagecolorallocate($img,130,60,10);
	$parasit = imagecolorallocate($img,150,150,150);
	$propriu = imagecolorallocate($img,240,200,0);
	$aliat = imagecolorallocate($img,0,160,244);
	$dusman = imagecolorallocate($img,244,0,0);
	$pna = imagecolorallocate($img,128,0,128);
	$trib = imagecolorallocate($img,0,0,244);
	$elem = imagecolorallocate($img,50,60,70);
	$active = imagecolorallocate($img,255,255,255);
	$col = imagecolorallocate($img,255,255,255);

	for($i = 1; $i <= $image_diameter; $i++){
		$curox = $start_left_x+$i;
		$curoy = $end_right_y-$i+1;
		$lx = $i*5;
		$ly = $i*5;
		settype($lines_arrx, "array");
		settype($lines_arry, "array");

		if($curox%5 == 0){
			$lines_arrx['mari'][$lx]=$liniimari;
		}else{
			$lines_arrx['mici'][$lx]=$liniimici;
		}

		if($curoy%5 == 0){
			$lines_arry['mari'][$ly] = $liniimari;
		}else{
			$lines_arry['mici'][$ly] = $liniimici;
		}

		if($curox%100 == 0){
			$lines_arrx['cont'][$lx] = $liniicontinent;
		}
		if($curoy%100 == 0){
			$lines_arry['cont'][$ly] = $liniicontinent;
		}
	}

	foreach($lines_arrx['mici'] as $key => $value){
		imageline($img,$key,0,$key,$image_size,$value);
	}
	foreach($lines_arry['mici'] as $key => $value){
		imageline($img,0,$key,$image_size,$key,$value);
	}

	if(is_array($lines_arrx['mari']) && is_array($lines_arry['mari'])){
		foreach($lines_arrx['mari'] as $key => $value){
			imageline($img,$key,0,$key,$image_size,$value);
		}
		foreach($lines_arry['mari'] as $key => $value){
			imageline($img,0,$key,$image_size,$key,$value);
		}
	}

	if(is_array($lines_arrx['cont'])){
		foreach($lines_arrx['cont'] as $key => $value){
			imageline($img,$key,0,$key,$image_size,$value);
		}
	}
	if(is_array($lines_arry['cont'])){
		foreach($lines_arry['cont'] as $key => $value){
			imageline($img,0,$key,$image_size,$key,$value);
		}
	}

	$polygon_var = (floor($mapsize_user/2))*5;
	$a1 = $image_radius*5-$polygon_var;
	$b1 = $image_radius*5+$polygon_var+5;
	imagepolygon($img,array($a1,$a1,$b1,$a1,$b1,$b1,$a1,$b1),4,$col);


     foreach($image_object as $key1=>$value1){
     	foreach($image_objects[$key1] as $key2=>$value2){
     		$rx = $key1;
     	}
     }

    imagepng($img, null, 9);
	imagedestroy($img);
?>