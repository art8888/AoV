<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>{$config.name} - {$lang->get("title")}</title>
	<link rel="stylesheet" href="{$config.cdn}/css/index.css" type="text/css" />
	<script type="text/javascript" src="{$config.cdn}/js/jquery.js"></script>
	<script type="text/javascript" src="{$config.cdn}/js/jquery.ui.js"></script>
	<script type="text/javascript" src="{$config.cdn}/js/jquery.form.js"></script>
	<script type="text/javascript" src="{$config.cdn}/js/jquery.onenter.js"></script>
	<script type="text/javascript" src="{$config.cdn}/js/index.js"></script>
	
</head>
<body id="body">
	<div id="top_bg"></div>
	<div id="main">
		<table class="antet">
			<tr>
				<td class="stanga"></td>
				<td class="header" width="90%" style="background: transparent no-repeat 20% bottom;">
				</td>
				<td class="dreapta"></td>
			</tr>
		</table>
		
		<table class="principal" id="round">
			<tr>
				<td width="27%">
					<table class="vis" cellspacing="1" width="100%" align="center">
						<th><center>{$lang->get("new_village")}</center></th>
						<tr>
							<td><a href="create_city.php?action=create"><input type="submit" id="do_create" class="button red" value="Create" style="width:115px" /></a></td>
						</tr>
					</table>
				</td>
			</tr>
	</table>
	</div>
</body>
</html>