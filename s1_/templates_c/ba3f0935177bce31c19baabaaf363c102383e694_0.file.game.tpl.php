<?php
/* Smarty version 3.1.39, created on 2021-07-30 21:44:42
  from 'F:\xampp\htdocs\s1_\templates\game.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_610456aa44f8e9_76746936',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ba3f0935177bce31c19baabaaf363c102383e694' => 
    array (
      0 => 'F:\\xampp\\htdocs\\s1_\\templates\\game.tpl',
      1 => 1627668309,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:game_".((string)$_smarty_tpl->tpl_vars[\'screen\']->value).".tpl' => 1,
  ),
),false)) {
function content_610456aa44f8e9_76746936 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?xml ';?>
version="1.0" encoding="UTF-8" <?php echo '?>';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title></title>
	<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/css/game.css?<?php echo $_smarty_tpl->tpl_vars['now']->value;?>
" type="text/css" />
	<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/rabe.png" type="image/x-icon">
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/js/jquery.js?<?php echo $_smarty_tpl->tpl_vars['now']->value;?>
"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/js/jquery.form.js?<?php echo $_smarty_tpl->tpl_vars['now']->value;?>
"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/js/game.js?<?php echo $_smarty_tpl->tpl_vars['now']->value;?>
"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript">
		var vid = <?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
;
		var act_vid = <?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
;
		var act_points = <?php echo $_smarty_tpl->tpl_vars['user']->value['points'];?>
;
		var userid = <?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
;
		var storage = <?php echo $_smarty_tpl->tpl_vars['max_storage']->value;?>
;
		var last = <?php echo $_smarty_tpl->tpl_vars['village']->value['last_act'];?>
;
		var now = Date.now();

		var wood_s = <?php echo $_smarty_tpl->tpl_vars['wood_per_hour']->value/3600;?>
;
		var stone_s = <?php echo $_smarty_tpl->tpl_vars['stone_per_hour']->value/3600;?>
;
		var iron_s = <?php echo $_smarty_tpl->tpl_vars['iron_per_hour']->value/3600;?>
;

		var wood_r = <?php echo $_smarty_tpl->tpl_vars['village']->value['r_wood'];?>

		var stone_r = <?php echo $_smarty_tpl->tpl_vars['village']->value['r_stone'];?>

		var iron_r = <?php echo $_smarty_tpl->tpl_vars['village']->value['r_iron'];?>


		


	<?php echo '</script'; ?>
>
	<!--[if IE 6]><?php echo '<script'; ?>
 type="text/javascript">document.execCommand("BackgroundImageCache",false,true);<?php echo '</script'; ?>
><![endif]-->
</head>
<body id="body">
<div id="main">
	<table class="menu nowrap" align="center" width="100%">
		<tr id="menu">
			<td><center><a href="logout.php">LOGOUT | </a>
			<a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=leaderboard">Leaderboard</a> |
			<a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=raports">Raports</a> |
			<a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=stats">Stats</a></center></td>
		</tr>
	</table>
	<br>
	<div id="content" align="center">
		<table class="menu nowrap" align="center" width="50%">
			<tr><td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/buildings/main.png" class="info_res"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=main"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("main");?>
</a></td>
			    <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/buildings/barracks.png" class="info_res"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=barracks"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("barracks");?>
</a></td>
			    <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/buildings/stable.png" class="info_res"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=stable"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("stable");?>
</a></td>
			    <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/buildings/garage.png" class="info_res"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=garage"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("garage");?>
</a></td>
			    <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/buildings/snob.png" class="info_res"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=snob"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("snob");?>
</a></td>
			    <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/buildings/place.png" class="info_res"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=place"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("place");?>
</a></td>
			    <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/buildings/market.png" class="info_res"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=market"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("market");?>
</a></td>

			</tr>
	    </table>
		<table class="menu nowrap" align="center" width="50%">
		   <tr>
			<th class="sus_s" style="text-align:center;" width="10%"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&screen=map">Map</a></th>
			<th class="sus_s" style="text-align:center;" width="10%"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&screen=troops">Troops</a></th>
			<td><span style="float:left;"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&screen=overview_villages"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("generalw");?>
</a></span></td>
			<th class="sus_d">
				<span style="float:left;"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&screen=overview"><?php echo $_smarty_tpl->tpl_vars['village']->value['name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['village']->value['x'];?>
|<?php echo $_smarty_tpl->tpl_vars['village']->value['y'];?>
)</a></span>
				<span id="slim" style="float: right;">
					<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/wood.png" class="info_res"><span id="wood" title="<?php echo $_smarty_tpl->tpl_vars['wood_per_hour']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['village']->value['r_wood'] == $_smarty_tpl->tpl_vars['max_storage']->value) {?>class="warn"<?php }?>><?php echo round($_smarty_tpl->tpl_vars['village']->value['r_wood']);?>
</span>
					<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/stone.png" class="info_res"><span id="stone" title="<?php echo $_smarty_tpl->tpl_vars['stone_per_hour']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['village']->value['r_stone'] == $_smarty_tpl->tpl_vars['max_storage']->value) {?>class="warn"<?php }?>><?php echo round($_smarty_tpl->tpl_vars['village']->value['r_stone']);?>
</span>
					<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/iron.png" class="info_res"><span id="iron" title="<?php echo $_smarty_tpl->tpl_vars['iron_per_hour']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['village']->value['r_iron'] == $_smarty_tpl->tpl_vars['max_storage']->value) {?>class="warn"<?php }?>><?php echo round($_smarty_tpl->tpl_vars['village']->value['r_iron']);?>
</span> |
					<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/res.png" class="info_res"><span id="storage"><?php echo round($_smarty_tpl->tpl_vars['max_storage']->value);?>
</span> | 
					<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/face.png" class="info_res"><span id="actual_farm"><?php echo $_smarty_tpl->tpl_vars['village']->value['r_pop'];?>
</span>/<?php echo $_smarty_tpl->tpl_vars['max_pop']->value;?>

				</span>
			</th>
		</tr>
        
	    </table>

		<?php if (in_array($_smarty_tpl->tpl_vars['screen']->value,$_smarty_tpl->tpl_vars['allow_screens']->value)) {?>
		    <?php $_smarty_tpl->_subTemplateRender("file:game_".((string)$_smarty_tpl->tpl_vars['screen']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
		<?php }?>
		<span id="slim">Servertime: <strong><span id="serverTime"><?php echo $_smarty_tpl->tpl_vars['servertime']->value;?>
</span> |<?php echo $_smarty_tpl->tpl_vars['serverdate']->value;?>
 | <?php echo $_smarty_tpl->tpl_vars['load_msec']->value;?>
</strong></span>
	</div>
</div>

</div>
<?php echo '<script'; ?>
 type="text/javascript">startTimer();<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
