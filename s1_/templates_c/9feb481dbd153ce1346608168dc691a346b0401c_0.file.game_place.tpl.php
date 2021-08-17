<?php
/* Smarty version 3.1.39, created on 2021-07-19 15:42:58
  from 'F:\xampp\htdocs\s1_\templates\game_place.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60f58162b739c3_26087366',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9feb481dbd153ce1346608168dc691a346b0401c' => 
    array (
      0 => 'F:\\xampp\\htdocs\\s1_\\templates\\game_place.tpl',
      1 => 1626702177,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60f58162b739c3_26087366 (Smarty_Internal_Template $_smarty_tpl) {
?><table
   <tr>
      <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/big_buildings/place1.png"/></td>
      <td><h2><?php echo $_smarty_tpl->tpl_vars['lang']->value->get($_smarty_tpl->tpl_vars['build']->value);?>
(<?php echo $_smarty_tpl->tpl_vars['village']->value['place'];?>
)</h2></td>
   </tr>
</table>
<br/>
<?php if ($_smarty_tpl->tpl_vars['show_build']->value) {?>
   <table class="production_table" width="50%">
      <tr>
         <td valign="top" width="100">
            <table class="vis" width="100%">
               <tr>
                  <td width="120"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=place&amp;mode=units"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("troops");?>
</a></td>
               </tr>
                <tr>
                  <td width="120"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=sim"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("sim");?>
</a></td>
               </tr>
            </table>
         </td>
      </tr>
      <td>
          <table class="production_table">
             <th align="center"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("order");?>
</th>
             <form name="units" action="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=place&amp;try=confirm" method="post">
                <tr>
                   <?php $_smarty_tpl->_assignInScope('counter', 0);?>

                   <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['group_units']->value, 'value', false, 'group_name');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['group_name']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                      <td width="150">
                         <table class="vis" width="100%">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['group_units']->value[$_smarty_tpl->tpl_vars['group_name']->value], 'dbname');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>

                              <tr><td><a href="javascript:popup('popup_unit.php?unit=<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
', 520, 520)"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/unit/<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
.png"></a><input id="input_<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
" type="text" size="5" tabindex="<?php echo $_smarty_tpl->tpl_vars['counter']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['values']->value[$_smarty_tpl->tpl_vars['dbname']->value];?>
" class="unitsInput"/><a href="javascript:void(0)" onclick="insertUnit($('#input_<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
'), <?php echo $_smarty_tpl->tpl_vars['units']->value[$_smarty_tpl->tpl_vars['dbname']->value];?>
)">(<?php echo $_smarty_tpl->tpl_vars['units']->value[$_smarty_tpl->tpl_vars['dbname']->value];?>
)</td></tr>
                              
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                         </table>
                      </td>
                   <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </tr>
                <tr><td><a id="selectAllUnits" href="javascript:void(0);" onclick="selectAllUnits(true)">&raquo; <?php echo $_smarty_tpl->tpl_vars['lang']->value->get("all_troops");?>
</a></td></tr>
                <tr>
                   <table>
		<tr>
			<td>X: <input type="text" name="x" tabindex="13" id="inputx" value="<?php echo $_smarty_tpl->tpl_vars['values']->value['x'];?>
" size="5" maxlength="3" onkeyup="xProcess('inputx', 'inputy')" /></td>
			<td>Y: <input type="text" name="y" tabindex="14" id="inputy" value="<?php echo $_smarty_tpl->tpl_vars['values']->value['y'];?>
" size="5" maxlength="3" /></td>
			<td rowspan="2"><input class="button red" name="attack" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['lang']->value->get("attack_order");?>
" /></td>
			<td rowspan="2"><input class="button green" name="support" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['lang']->value->get("support_order");?>
" /></td>
		</tr>
	</table>
                </tr>
            </form>
          </table>
      </td>
   </table>
<?php }
}
}
