<?php
include('include.inc.php');

$id = $_GET['id'];
$from = $_GET['f'];
$to = $_GET['t'];

$units = $db->fetch($db->query("SELECT units FROM ".$prefix."movements WHERE id='".$id."'"))['units'];

if($from == $to){
	$units_e = explode(";", $units);
	$i = 0;
	foreach($cl_units->get_array("dbname") as $key=>$value){
		$i++;
		$units_i[] = $value;
	}

	?>
	<table class="vis" style="background-color:#F0E6C8; border:1px solid rgb(128, 64, 0);">
		<tr>
			<?php
			   for($j = 0; $j<count($units_i); $j++){
			   	?>
			   	   <td align="center"><img src="<?php echo $config['cdn']; ?>/graphic/unit/<?php echo $units_i[$j]; ?>.png"></td>
			   	<?php
			   }
			?>
		</tr>
		<tr>
			<?php
			   for($j = 0; $j<count($units_i); $j++){
			   	?>
			   	   <td align="center"><?php echo $units_e[$j]; ?></td>
			   	<?php
			   }
			?>
		</tr>
	</table>
	<?php
}
?>