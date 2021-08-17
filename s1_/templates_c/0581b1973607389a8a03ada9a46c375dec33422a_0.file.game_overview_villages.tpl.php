<?php
/* Smarty version 3.1.39, created on 2021-07-20 22:28:42
  from 'F:\xampp\htdocs\s1_\templates\game_overview_villages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60f731fad57fb7_29679606',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0581b1973607389a8a03ada9a46c375dec33422a' => 
    array (
      0 => 'F:\\xampp\\htdocs\\s1_\\templates\\game_overview_villages.tpl',
      1 => 1626812513,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60f731fad57fb7_29679606 (Smarty_Internal_Template $_smarty_tpl) {
?><table class="production_table" class="vis overview_table" width="100%">
<tr>
<th><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("villages");?>
</th>
<th><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("points");?>
</th>
<th><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("resources");?>
</th>
<th><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("storage");?>
</th>
<th><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("farm");?>
</th>
<th colspan="11"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("troops");?>
</th>
</tr>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['villages']->value, 'village');
$_smarty_tpl->tpl_vars['village']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['village']->value) {
$_smarty_tpl->tpl_vars['village']->do_else = false;
?>
<tr class="nowrap row_a">
<td><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&screen=overview"><?php echo $_smarty_tpl->tpl_vars['village']->value['name'];?>
(<?php echo $_smarty_tpl->tpl_vars['village']->value['x'];?>
|<?php echo $_smarty_tpl->tpl_vars['village']->value['y'];?>
)</a></td>
<td><?php echo $_smarty_tpl->tpl_vars['village']->value['points'];?>
</td>
<td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/wood.png" class="info_res"><span id="wood"<?php if ($_smarty_tpl->tpl_vars['village']->value['r_wood'] == $_smarty_tpl->tpl_vars['max_storage']->value) {?>class="warn"<?php }?>><?php echo round($_smarty_tpl->tpl_vars['village']->value['r_wood']);?>
</span>
<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/stone.png" class="info_res"><span id="wood"<?php if ($_smarty_tpl->tpl_vars['village']->value['r_stone'] == $_smarty_tpl->tpl_vars['max_storage']->value) {?>class="warn"<?php }?>><?php echo round($_smarty_tpl->tpl_vars['village']->value['r_stone']);?>
</span>
<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/iron.png" class="info_res"><span id="wood"<?php if ($_smarty_tpl->tpl_vars['village']->value['r_stone'] == $_smarty_tpl->tpl_vars['max_storage']->value) {?>class="warn"<?php }?>><?php echo round($_smarty_tpl->tpl_vars['village']->value['r_iron']);?>
</span>
</td>
<td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/res.png" class="info_res"><span id="storage"><?php echo $_smarty_tpl->tpl_vars['village']->value['storage'];?>
</td>
<td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/face.png" class="info_res"><span id="pop"><?php echo $_smarty_tpl->tpl_vars['village']->value['r_pop'];?>
/<?php echo floor($_smarty_tpl->tpl_vars['village']->value['farm']);?>
</td>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cl_units2']->value, 'dbname');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>
<td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/unit/<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
.png"><span id="<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['units_in']->value[$_smarty_tpl->tpl_vars['village']->value][$_smarty_tpl->tpl_vars['dbname']->value];?>
</span></td>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</tr>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
<?php }
}
