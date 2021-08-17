<?php
/* Smarty version 3.1.39, created on 2021-07-16 22:02:27
  from 'F:\xampp\htdocs\s1_\templates\popup_unit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60f1e5d33d8929_96531350',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a20219cf84a07a59cd0fa8a297712c1f250e2f61' => 
    array (
      0 => 'F:\\xampp\\htdocs\\s1_\\templates\\popup_unit.tpl',
      1 => 1626465745,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60f1e5d33d8929_96531350 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?xml ';?>
version="1.0"<?php echo '?>';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_name($_smarty_tpl->tpl_vars['unit']->value);?>
</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/css/game.css" />
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/js/game.js" type="text/javascript"><?php echo '</script'; ?>
>
</head>
<body>
<table class="principal" width="100%" align="center">
	<tr>
		<td>
			<table>
				<tr>
					<td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/unit_big/<?php echo $_smarty_tpl->tpl_vars['unit']->value;?>
.png" alt="<?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_name($_smarty_tpl->tpl_vars['unit']->value);?>
" /></td>
					<td>
						<h2><?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_name($_smarty_tpl->tpl_vars['unit']->value);?>
</h2>
						
					</td>
				</tr>
			</table>
			<table style="border: 1px solid #804000;" class="vis">
				<tr>
					<th width="150"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("costs");?>
</th>
					<th><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("population");?>
</th>
					<th><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("speed");?>
</th>
					<th><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("bounty");?>
</th>
				</tr>
				<tr class="center">
					<td>
						<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/wood.png" title="" /><?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_woodprice($_smarty_tpl->tpl_vars['unit']->value);?>
 
						<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/stone.png" title="" /><?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_stoneprice($_smarty_tpl->tpl_vars['unit']->value);?>
 
						<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/iron.png" title="" /><?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_ironprice($_smarty_tpl->tpl_vars['unit']->value);?>

					</td>
					<td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/face.png" title="" alt="" /> <?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_popprice($_smarty_tpl->tpl_vars['unit']->value);?>
</td>
					<td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/speed.png" title="" alt="" /><?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_speed($_smarty_tpl->tpl_vars['unit']->value,'minutes');?>
 <?php echo $_smarty_tpl->tpl_vars['lang']->value->get("min_per_field");?>
</td>
					<td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/bounty.png" title="" alt="" /><?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_booty($_smarty_tpl->tpl_vars['unit']->value);?>
</td>
				</tr>
			</table><br />
			<table style="border: 1px solid #804000;" class="vis">
				<tr><td><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("off_str");?>
</td><td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/unit/att.png" /> <?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_att($_smarty_tpl->tpl_vars['unit']->value,1);?>
</td></tr>
				<tr><td><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("general_def");?>
</td><td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/unit/def.png" /> <?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_def($_smarty_tpl->tpl_vars['unit']->value,1);?>
</td></tr>
				<tr><td><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("cav_def");?>
</td><td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/unit/def_cav.png" /> <?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_defCav($_smarty_tpl->tpl_vars['unit']->value,1);?>
</td></tr>
				<tr><td><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("archer_def");?>
</td><td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/unit/def_archer.png" /> <?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_defArcher($_smarty_tpl->tpl_vars['unit']->value,1);?>
</td></tr>
			</table><br />
			<table class="vis">
				<tr><th colspan="<?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_countNeeded($_smarty_tpl->tpl_vars['unit']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("needs");?>
</th></tr>
				<tr>
				<?php if (count($_smarty_tpl->tpl_vars['cl_units']->value->get_needed($_smarty_tpl->tpl_vars['unit']->value)) > 0) {?>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cl_units']->value->get_needed($_smarty_tpl->tpl_vars['unit']->value), 'n_stage', false, 'n_unit');
$_smarty_tpl->tpl_vars['n_stage']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['n_unit']->value => $_smarty_tpl->tpl_vars['n_stage']->value) {
$_smarty_tpl->tpl_vars['n_stage']->do_else = false;
?>
					<td><a href="popup_building.php?building=<?php echo $_smarty_tpl->tpl_vars['n_unit']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['cl_builds']->value->get_name($_smarty_tpl->tpl_vars['n_unit']->value);?>
</a> (<?php echo $_smarty_tpl->tpl_vars['lang']->value->get("level");?>
 <?php echo $_smarty_tpl->tpl_vars['n_stage']->value;?>
)</td>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<?php } else { ?>
					<td><div class="succes"></div></td>
				<?php }?>
				</tr>
			</table><br />
		</td>
	</tr>
</table>
<?php echo '<script'; ?>
 type="text/javascript">setImageTitles();<?php echo '</script'; ?>
>
</body>
</html><?php }
}
