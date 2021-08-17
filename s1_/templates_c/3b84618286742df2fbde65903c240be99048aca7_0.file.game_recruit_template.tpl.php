<?php
/* Smarty version 3.1.39, created on 2021-07-19 13:38:37
  from 'F:\xampp\htdocs\s1_\templates\game_recruit_template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60f5643d228c68_22047876',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b84618286742df2fbde65903c240be99048aca7' => 
    array (
      0 => 'F:\\xampp\\htdocs\\s1_\\templates\\game_recruit_template.tpl',
      1 => 1626694715,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60f5643d228c68_22047876 (Smarty_Internal_Template $_smarty_tpl) {
?><table>
   <tr>
      <td>
         <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/big_buildings/<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
2.png" />
      </td>
      <td>
         <h2><?php echo $_smarty_tpl->tpl_vars['lang']->value->get($_smarty_tpl->tpl_vars['dbname']->value);?>
 (<?php echo $_smarty_tpl->tpl_vars['village']->value[$_smarty_tpl->tpl_vars['dbname']->value];?>
)</h2>
      </td>
   </tr>
</table>
<?php if ($_smarty_tpl->tpl_vars['show_build']->value) {?>
   <?php if (count($_smarty_tpl->tpl_vars['recruit_units']->value) > 0) {?>
      <table class="vis production_table">
         <tr>
            <th width="150"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("order");?>
</th>
            <th width="120"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("duration");?>
</th>
            <th width="150"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("endtime");?>
</th>
            <th width="100"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("cancel");?>
</th>
         </tr>
         <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['recruit_units']->value, 'value', false, 'key');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
            <tr <?php if ($_smarty_tpl->tpl_vars['recruit_units']->value[$_smarty_tpl->tpl_vars['key']->value]['lit']) {?>class="lit"<?php }?>>
               <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/unit_big/<?php echo $_smarty_tpl->tpl_vars['recruit_units']->value[$_smarty_tpl->tpl_vars['key']->value]['unit'];?>
.png" width="30px" hieght="30px"><b><?php echo $_smarty_tpl->tpl_vars['recruit_units']->value[$_smarty_tpl->tpl_vars['key']->value]['num_unit'];?>
</b> <?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_name($_smarty_tpl->tpl_vars['recruit_units']->value[$_smarty_tpl->tpl_vars['key']->value]['unit']);?>
</td>
                  <td><span class="timer"><?php echo format_time($_smarty_tpl->tpl_vars['recruit_units']->value[$_smarty_tpl->tpl_vars['key']->value]['countdown']);?>
</span></td>
               <td><?php echo format_date($_smarty_tpl->tpl_vars['recruit_units']->value[$_smarty_tpl->tpl_vars['key']->value]['time_finished']);?>
</td>
               <td><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
&amp;action=cancel&amp;id=<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
&amp;h=<?php echo $_smarty_tpl->tpl_vars['hkey']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("cancel");?>
</a></td>
            </tr>
         <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </table>
   <?php }?>
<form action="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
&amp;action=train&amp;h=<?php echo $_smarty_tpl->tpl_vars['hkey']->value;?>
" method="POST" onsubmit="this.submit.disabled=true;">
    <table class="vis production_table" style="font-size:13pt;">
       <tr>
          <th width="150"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("units");?>
</th>
          <th colspan="4" width="120"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("ressources");?>
</th>
          <th width="130">(hh:mm:ss)</th>
          <th width="130"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("in_total");?>
</th>
          <th><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("recruit");?>
</th>
       </tr>
       <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['units']->value, 'name', false, 'unit_dbname');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['unit_dbname']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <tr>
            <td><a href="javascript:popup('popup_unit.php?unit=<?php echo $_smarty_tpl->tpl_vars['unit_dbname']->value;?>
', 520, 520)"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/unit/<?php echo $_smarty_tpl->tpl_vars['unit_dbname']->value;?>
.png"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</a></td>
            <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/wood.png" title="wood"/><?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_woodprice($_smarty_tpl->tpl_vars['unit_dbname']->value);?>
</td>
            <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/stone.png" title="stone"/><?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_stoneprice($_smarty_tpl->tpl_vars['unit_dbname']->value);?>
</td>
            <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/iron.png" title="iron"/><?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_ironprice($_smarty_tpl->tpl_vars['unit_dbname']->value);?>
</td>
            <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/face.png" title="iron"/><?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_popprice($_smarty_tpl->tpl_vars['unit_dbname']->value);?>
</td>
            <td><?php echo format_time($_smarty_tpl->tpl_vars['cl_units']->value->get_time($_smarty_tpl->tpl_vars['village']->value['bonus'],$_smarty_tpl->tpl_vars['dbname']->value,$_smarty_tpl->tpl_vars['village']->value[$_smarty_tpl->tpl_vars['dbname']->value],$_smarty_tpl->tpl_vars['unit_dbname']->value));?>
</td>
             <td><?php echo $_smarty_tpl->tpl_vars['units_in_village']->value[$_smarty_tpl->tpl_vars['unit_dbname']->value];?>
/<?php echo $_smarty_tpl->tpl_vars['units_all']->value[$_smarty_tpl->tpl_vars['unit_dbname']->value];?>
</td>
             <?php echo $_smarty_tpl->tpl_vars['cl_units']->value->check_needed($_smarty_tpl->tpl_vars['unit_dbname']->value,$_smarty_tpl->tpl_vars['village']->value);?>

             <?php if ($_smarty_tpl->tpl_vars['cl_units']->value->last_error == 'not_tec') {?>
                <td class="inactive"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("tec_need");?>
</td>
             <?php } elseif ($_smarty_tpl->tpl_vars['cl_units']->value->last_error == 'not_needed') {?>
                <td class="inactive"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("not_need");?>
</td>
             <?php } elseif ($_smarty_tpl->tpl_vars['cl_units']->value->last_error == 'no_enough_ress') {?>
                <td class="inactive"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("not_enough_res");?>
</td>
             <?php } elseif ($_smarty_tpl->tpl_vars['cl_units']->value->last_error == 'not_enough_pop') {?>
                <td class="inactive"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("not_enough_pop");?>
</td>
             <?php } else { ?>
                <td><input name="<?php echo $_smarty_tpl->tpl_vars['unit_dbname']->value;?>
" type="text" size="5" maxlength="5" id="input_<?php echo $_smarty_tpl->tpl_vars['unit_dbname']->value;?>
" /><a href="javascript:void(0);" onclick="insertUnit($('#input_<?php echo $_smarty_tpl->tpl_vars['unit_dbname']->value;?>
'), <?php echo $_smarty_tpl->tpl_vars['cl_units']->value->last_error;?>
)">(max. <?php echo $_smarty_tpl->tpl_vars['cl_units']->value->last_error;?>
)</a></td>   
             <?php }?>
          </tr>
       <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
       <tr><td colspan="8" align="right"><input name="submit" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['lang']->value->get("recruit");?>
" style="font-size:13px;"/></td></tr>
    </table>
</form>
<?php }
}
}
