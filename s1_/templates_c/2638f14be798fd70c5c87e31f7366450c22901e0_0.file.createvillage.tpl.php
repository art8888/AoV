<?php
/* Smarty version 3.1.39, created on 2021-06-23 17:07:49
  from 'F:\xampp\htdocs\s1_\templates\createvillage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60d34e45325222_15965136',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2638f14be798fd70c5c87e31f7366450c22901e0' => 
    array (
      0 => 'F:\\xampp\\htdocs\\s1_\\templates\\createvillage.tpl',
      1 => 1624460867,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60d34e45325222_15965136 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?xml ';?>
version="1.0"<?php echo '?>';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo $_smarty_tpl->tpl_vars['config']->value['name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['lang']->value->get("title");?>
</title>
	<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/css/index.css" type="text/css" />
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/js/jquery.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/js/jquery.ui.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/js/jquery.form.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/js/jquery.onenter.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/js/index.js"><?php echo '</script'; ?>
>
	
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
						<th><center><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("new_village");?>
</center></th>
						<tr>
							<td><a href="create_city.php?action=create"><input type="submit" id="do_create" class="button red" value="Create" style="width:115px" /></a></td>
						</tr>
					</table>
				</td>
			</tr>
	</table>
	</div>
</body>
</html><?php }
}
