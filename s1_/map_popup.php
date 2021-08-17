<?php
include('include.inc.php');
$time = time();

$v = $_GET['v'];
$u = $_GET['u'];
$ox = $_GET['ox'];
$oy = $_GET['oy'];

$villages = $db->fetch($db->query("SELECT * FROM ".$prefix."villages WHERE id='".$v."'"));
$user = $db->fetch($db->query("SELECT * FROM ".$prefix."users WHERE userid='".$u."'"));

$place = $db->fetch($db->query("SELECT * FROM ".$prefix."unit_place WHERE villages_from_id='".$v."' AND villages_to_id='".$v."'"));


$info_title = "".$villages['name']." (".$villages['x']."|".$villages['y'].")";
$info_points = $villages['points'];
$info_owner = "".$user['username']."(".$user['points'].")";


$max_storage = ($villages['bonus'] == 'storage') ? ($arr_maxstorage[$villages['storage']]*(1+$config['bonus_values']['storage'])) : $arr_maxstorage[$villages['storage']];

$max_farm  = ($villages['bonus'] == 'farm') ? ($arr_farm[$villages['farm']]*(1+$config['bonus_values']['farm'])) : $arr_farm[$villages['farm']];

foreach($cl_units->get_array("dbname") as $key=>$value){
	$units[] = $value;
}

foreach($cl_builds->get_array("dbname") as $key=>$value){
	$builds[] = $value;
}

$sid = new sid();
$session = $sid->check_sid($_COOKIE['session']);

$lang = new aLang("game", "EN");
?>
<table class="vis" style="background-color:#F0E6C8; border:1px solid rgb(128, 64, 0);" width="100%">
	<tr>
		<?php if($villages['bonus'] != "-1") {?>
			<td rowspan="8">
				<?php
				   if($villages['bonus'] == 'barracks') {
				   	echo "<img src='".$config['cdn']."/graphic/big_buildings/barracks2.png'>";
				   } elseif($villages['bonus'] == 'all'){
				   	echo "<img src='".$config['cdn']."/graphic/big_buildings/storage3.png'>";
				   }elseif($villages['bonus'] == 'stable'){
				   	echo "<img src='".$config['cdn']."/graphic/big_buildings/stable3.png'>";
				   }elseif($villages['bonus'] == 'garage'){
				   	echo "<img src='".$config['cdn']."/graphic/big_buildings/garage3.png'>";
				   }elseif($villages['bonus'] == 'farm'){
				   	echo "<img src='".$config['cdn']."/graphic/big_buildings/farm3.png'>";
				   }elseif($villages['bonus'] == 'storage'){
				   	echo "<img src='".$config['cdn']."/graphic/big_buildings/market3.png'>";
				   }elseif($villages['bonus'] == 'wood'){
				   	echo "<img src='".$config['cdn']."/graphic/big_buildings/wood3.png'>";
				   }elseif($villages['bonus'] == 'stone'){
				   	echo "<img src='".$config['cdn']."/graphic/big_buildings/stone3.png'>";
				   }elseif($villages['bonus'] == 'iron'){
				   	echo "<img src='".$config['cdn']."/graphic/big_buildings/iron3.png'>";
				   }
				}
				?>
			</td>
			<th colspan="2"><?php echo $info_title; ?></th>
		</tr>
			<?php if($villages['bonus'] != '-1'){?>
				<tr>
					<td colspan="2" align="center">
						<?php if($villages['bonus'] == 'all') {
							echo "<b>".$lang->get("all_bonus")."</b>";
						} elseif($villages['bonus'] == 'barracks'){
							echo "<b>".$lang->get("barracks_bonus")."</b>";
						}elseif($villages['bonus'] == 'stable'){
							echo "<b>".$lang->get("stable_bonus")."</b>";
						}elseif($villages['bonus'] == 'garage'){
							echo "<b>".$lang->get("garage_bonus")."</b>";
						}elseif($villages['bonus'] == 'storage'){
							echo "<b>".$lang->get("storage_bonus")."</b>";
						}elseif($villages['bonus'] == 'wood'){
							echo "<b>".$lang->get("wood_bonus")."</b>";
						}elseif($villages['bonus'] == 'stone'){
							echo "<b>".$lang->get("stone_bonus")."</b>";
						}elseif($villages['bonus'] == 'iron'){
							echo "<b>".$lang->get("iron_bonus")."</b>";
						}elseif($villages['bonus'] == 'farm'){
							echo "<b>".$lang->get("farm_bonus")."</b>";
						}
						?>
					</td>
				</tr>
			<?php } ?>
			<tr>
				<td width="30%"><?php echo $lang->get("points"); ?>:</td><td><?php echo $info_points; ?></td>
			</tr>
			<?php if($villages['userid'] == '-1') { ?>
				<tr>
					<td colspan="2" align="center"><?php echo $lang->get("barbarian"); ?></td>
				</tr>
			<?php } else { ?>
				<tr>
					<td width="30%"><?php echo $lang->get("owner"); ?></td><td><?php echo $info_owner; ?></td>
				</tr>
			<?php } if($u == $session['userid']){?>
				<tr>
					<td colspan="2" align="center">
						<img src="<?php echo $config['cdn']; ?>/graphic/wood.png" /> <?php echo round($villages['r_wood']);?>
                        <img src="<?php echo $config['cdn']; ?>/graphic/stone.png" /> <?php echo round($villages['r_stone']);?>
                        <img src="<?php echo $config['cdn']; ?>/graphic/iron.png" /> <?php echo round($villages['r_iron']);?>
                        <img src="<?php echo $config['cdn']; ?>/graphic/res.png" /> <?php echo  $max_storage;?>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
                        <img src="<?php echo $config['cdn']; ?>/graphic/face.png" /> <?php echo  $villages['r_pop']."/".$max_farm;?>
					</td>
				</tr>
				<td colspan="2" style="background-color: #F7EED3;" align="center">
					<table class="vis" style="margin:5px; background-color:#F0E6C8;" width="98%">
						<tr>
							<?php
							   for($i=0; $i<=10; $i++){
							   	?>
							   	<td align="center" <?php if($i%2==0){echo "style='background-color: #ded3b9;'";}?>>
							   		<img src="<?php echo $config['cdn']; ?>/graphic/unit/<?php echo $units[$i]; ?>.png">
							   	</td>
							   	
							<?php
							   }
							?>
						</tr>
						<tr>
							<?php
							   for($i=0; $i<=10; $i++){
							   	?>
							   	<td align="center" <?php if($i%2==0){echo "style='background-color: #ded3b9;'";}?>>
							   		<b><?php echo "".$villages[$units[$i]]."</b>(<i>".$place[$units[$i]]."</i>)"; ?>
							   	</td>
							   	
							<?php
							   }
							?>
						</tr>
					</table>
				</td>
				<tr>
				<td colspan="2" style="background-color: #F7EED3;" align="center">
					<table class="vis" style="margin:5px; background-color:#F0E6C8;" width="98%">
						<tr>
							<?php
							   for($i=0; $i<=13; $i++){
							   	?>
							   	<td align="center" <?php if($i%2==0){echo "style='background-color: #ded3b9;'";}?>>
							   		<img src="<?php echo $config['cdn']; ?>/graphic/buildings/<?php echo $builds[$i]; ?>.png">
							   	</td>
							   	
							<?php
							   }
							?>
						</tr>
						<tr>
							<?php
							   for($i=0; $i<=13; $i++){
							   	?>
							   	<td align="center" <?php if($i%2==0){echo "style='background-color: #ded3b9;'";}?>>
							   		<b><?php echo $villages[$builds[$i]]; ?></b>
							   	</td>
							   	
							<?php
							   }
							?>
						</tr>
						
					<table class="vis" style="margin:5px; background-color:#F0E6C8;" width="98%">
						<tr>
							<?php
							   for($i=0; $i<=10; $i++){
							   	?>
							   	<td align="center" <?php if($i%2==0){echo "style='background-color: #ded3b9;'";}?>>
							   		<img src="<?php echo $config['cdn']; ?>/graphic/unit/<?php echo $units[$i]; ?>.png">
							   	</td>
							   	
							<?php
							   }
							?>
						</tr>
						<tr>
							<?php
							   for($i=0; $i<=10; $i++){
							   	?>
							   	<td align="center" <?php if($i%2==0){echo "style='background-color: #ded3b9;'";}?>>
							   		<b><?php print format_time(unit_running($ox, $oy, $villages['x'], $villages['y'], $cl_units->get_speed($units[$i]))) ?></b>
							   	</td>
							   	
							<?php
							   }
							?>
						</tr>
					</table>
				</td>
					</table>
				</td>
			</tr>
			<?php } else { ?>
				<?php if($_GET['village'] != $v) { ?> 
					<td colspan="2" style="background-color: #F7EED3;" align="center">
					<table class="vis" style="margin:5px; background-color:#F0E6C8;" width="98%">
						<tr>
							<?php
							   for($i=0; $i<=10; $i++){
							   	?>
							   	<td align="center" <?php if($i%2==0){echo "style='background-color: #ded3b9;'";}?>>
							   		<img src="<?php echo $config['cdn']; ?>/graphic/unit/<?php echo $units[$i]; ?>.png">
							   	</td>
							   	
							<?php
							   }
							?>
						</tr>
						<tr>
							<?php
							   for($i=0; $i<=10; $i++){
							   	?>
							   	<td align="center" <?php if($i%2==0){echo "style='background-color: #ded3b9;'";}?>>
							   		<b><?php print format_time(unit_running($ox, $oy, $villages['x'], $villages['y'], $cl_units->get_speed($units[$i]))) ?></b>
							   	</td>
							   	
							<?php
							   }
							?>
						</tr>
					</table>
				</td>
			    <?php } ?>
			<?php } ?>
</table>