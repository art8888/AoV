<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title></title>
	<link rel="stylesheet" href="{$config.cdn}/css/game.css?{$now}" type="text/css" />
	<link rel="shortcut icon" href="{$config.cdn}/rabe.png" type="image/x-icon">
	<script type="text/javascript" src="{$config.cdn}/js/jquery.js?{$now}"></script>
	<script type="text/javascript" src="{$config.cdn}/js/jquery.form.js?{$now}"></script>
	<script type="text/javascript" src="{$config.cdn}/js/game.js?{$now}"></script>
	<script type="text/javascript">
		var vid = {$village.id};
		var act_vid = {$village.id};
		var act_points = {$user.points};
		var userid = {$user.id};
		var storage = {$max_storage};
		var last = {$village.last_act};
		var now = Date.now();

		var wood_s = {$wood_per_hour/3600};
		var stone_s = {$stone_per_hour/3600};
		var iron_s = {$iron_per_hour/3600};

		var wood_r = {$village.r_wood}
		var stone_r = {$village.r_stone}
		var iron_r = {$village.r_iron}

		


	</script>
	<!--[if IE 6]><script type="text/javascript">document.execCommand("BackgroundImageCache",false,true);</script><![endif]-->
</head>
<body id="body">
<div id="main">
	<table class="menu nowrap" align="center" width="100%">
		<tr id="menu">
			<td><center><a href="logout.php">LOGOUT | </a>
			<a href="game.php?village={$village.id}&amp;screen=leaderboard">Leaderboard</a> |
			<a href="game.php?village={$village.id}&amp;screen=raports">Raports</a> |
			<a href="game.php?village={$village.id}&amp;screen=stats">Stats</a></center></td>
		</tr>
	</table>
	<br>
	<div id="content" align="center">
		<table class="menu nowrap" align="center" width="50%">
			<tr><td><img src="{$config.cdn}/graphic/buildings/main.png" class="info_res"><a href="game.php?village={$village.id}&amp;screen=main">{$lang->get("main")}</a></td>
			    <td><img src="{$config.cdn}/graphic/buildings/barracks.png" class="info_res"><a href="game.php?village={$village.id}&amp;screen=barracks">{$lang->get("barracks")}</a></td>
			    <td><img src="{$config.cdn}/graphic/buildings/stable.png" class="info_res"><a href="game.php?village={$village.id}&amp;screen=stable">{$lang->get("stable")}</a></td>
			    <td><img src="{$config.cdn}/graphic/buildings/garage.png" class="info_res"><a href="game.php?village={$village.id}&amp;screen=garage">{$lang->get("garage")}</a></td>
			    <td><img src="{$config.cdn}/graphic/buildings/snob.png" class="info_res"><a href="game.php?village={$village.id}&amp;screen=snob">{$lang->get("snob")}</a></td>
			    <td><img src="{$config.cdn}/graphic/buildings/place.png" class="info_res"><a href="game.php?village={$village.id}&amp;screen=place">{$lang->get("place")}</a></td>
			    <td><img src="{$config.cdn}/graphic/buildings/market.png" class="info_res"><a href="game.php?village={$village.id}&amp;screen=market">{$lang->get("market")}</a></td>

			</tr>
	    </table>
		<table class="menu nowrap" align="center" width="50%">
		   <tr>
			<th class="sus_s" style="text-align:center;" width="10%"><a href="game.php?village={$village.id}&screen=map">Map</a></th>
			<th class="sus_s" style="text-align:center;" width="10%"><a href="game.php?village={$village.id}&screen=troops">Troops</a></th>
			<td><span style="float:left;"><a href="game.php?village={$village.id}&screen=overview_villages">{$lang->get("generalw")}</a></span></td>
			<th class="sus_d">
				<span style="float:left;"><a href="game.php?village={$village.id}&screen=overview">{$village.name} ({$village.x}|{$village.y})</a></span>
				<span id="slim" style="float: right;">
					<img src="{$config.cdn}/graphic/wood.png" class="info_res"><span id="wood" title="{$wood_per_hour}" {if $village.r_wood==$max_storage}class="warn"{/if}>{round($village.r_wood)}</span>
					<img src="{$config.cdn}/graphic/stone.png" class="info_res"><span id="stone" title="{$stone_per_hour}" {if $village.r_stone==$max_storage}class="warn"{/if}>{round($village.r_stone)}</span>
					<img src="{$config.cdn}/graphic/iron.png" class="info_res"><span id="iron" title="{$iron_per_hour}" {if $village.r_iron==$max_storage}class="warn"{/if}>{round($village.r_iron)}</span> |
					<img src="{$config.cdn}/graphic/res.png" class="info_res"><span id="storage">{round($max_storage)}</span> | 
					<img src="{$config.cdn}/graphic/face.png" class="info_res"><span id="actual_farm">{$village.r_pop}</span>/{$max_pop}
				</span>
			</th>
		</tr>
        
	    </table>

		{if in_array($screen, $allow_screens)}
		    {include file="game_$screen.tpl"}
		{/if}
		<span id="slim">Servertime: <strong><span id="serverTime">{$servertime}</span> |{$serverdate} | {$load_msec}</strong></span>
	</div>
</div>

</div>
<script type="text/javascript">startTimer();</script>
</body>
</html>
