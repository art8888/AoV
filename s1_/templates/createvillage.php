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
					<table width="100%" style="border-spacing:0px;">
						<tr>
							<td width="50%" valign="middle" align="center"></td>
							<td width="50%" valign="bottom" align="right" style="padding: 0px;">
								<table class="header_login" style="padding: 2px;" width="60%">
								{if $logged_in}
									<tr><td colspan="2"><h3>{$lang->get("welcome")} {$user.username}!</h3></td></tr>
									<tr>
										<td width="50%"><a onclick="AOV.setVisibility('words', 'inline');"><div id="world" class="button">{$lang->get("login")}</div></a></td>
										<form action="process.php" id="logout" method="POST">
											<input type="hidden" name="action" value="logout">
											<td><input type="button" id="do_logout" onclick="AOV.logout();" class="button red" value="LOGOUT" style="width:115px" /></td>
										</form>
									</tr>
								{else}
									<form action="process.php" id="login" method="POST">
										<input type="hidden" name="action" value="login">
										<tr>
											<td>{$lang->get("username")}:</td>
											<td align="right"><input type="text" size="15" id="username" name="username" autocomplete="off" onenter="AOV.login();" /></td>
										</tr>
										<tr>
											<td>{$lang->get("password")}:</td>
											<td align="right"><input type="password" size="15" id="password" name="password" autocomplete="off" onenter="AOV.login();" /></td>
										</tr>
										<tr>
                                            <td colspan="2" align="right"><input type="button" id="do_login" onclick="AOV.login();" class="button green" value="{$lang->get('login')}" /></td>
                                        </tr>
                                        

									</form>
								{/if}
								</table>
							</td>
						</tr>
					</table>
				</td>
				<td class="dreapta"></td>
			</tr>
		</table>
		
		<table class="principal" id="round">
			<tr>
				<th class="sus_s">{if $logged_in}<div class="words-list" id="words">
			<table width="100%" align="center">
            	<form action="" method="post">
				<tr>
				{foreach from=$worlds item=world}
				<td align="left"><input type="button" value="{$world.name}({$world.db|villages:$user.id})"  class="button{$world.class}" onclick="{if $world.db|villages:$user.id >=1 }AOV.selectsts('{$world.db}');{else}AOV.selectw('{$world.db}'){/if} " style="width:105px;" />
				</td>
				{/foreach}
				</tr>
				</form>
                <tr><td align="right"><div style="float:none;"><a href="javascript:void(0);" onclick="AOV.setVisibility('words', 'none');" >{$lang->get("close")}</a></div></td></tr>
            </table>
		</div>{/if}</th>
			</tr>
			<tr>
				<td width="27%">
					<table class="vis" cellspacing="1" width="100%" align="center">
					{if $logged_in}
					{else}
						<form action="process.php" id="register" method="post">
							<input type="hidden" name="action" value="register">
							<tr>
								<td>{$lang->get("username")}:</td>
								<td><input type="text" size="15" id="reg_username" name="username" autocomplete="off" maxlength="15" onenter="AOV.register();"></td>
							</tr>
							<tr>
								<td>{$lang->get("password")}:</td>
								<td><input type="password" size="15" id="reg_password" name="password" autocomplete="off" maxlength="30" onenter="AOV.register();"></td>
							</tr>
							<tr>
								<td>{$lang->get("email")}:</td>
								<td><input type="text" size="15" id="reg_email" name="email" autocomplete="off" maxlength="30" onenter="AOV.register();"></td>
							</tr>
						<tr>
							<td>{$lang->get("securitycode")}:</td>
							<td>
								<input type="text" size="7" id="reg_captcha" name="captcha" autocomplete="off" maxlength="30" onenter="AOV.register();">
								<img src="verifyimage.php" title="Security Code" style="position:absolute" />
							</td>
						</tr>
							<tr><td colspan="2" align="right"><button type="submit" class="button green" id="do_reg" onclick="AOV.register();">{$lang->get("register")}</button></td></tr>
						</form>
					{/if}
					</table>
				</td>
			</tr>
	</table>
	</div>
</body>
</html>