<?php
/* Smarty version 3.1.39, created on 2021-07-19 14:37:31
  from 'F:\xampp\htdocs\s1_\templates\game_place_confirm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60f5720b189e37_95864677',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e722d06b458913b4d9418dae820349aa50ff557a' => 
    array (
      0 => 'F:\\xampp\\htdocs\\s1_\\templates\\game_place_confirm.tpl',
      1 => 1626698245,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60f5720b189e37_95864677 (Smarty_Internal_Template $_smarty_tpl) {
?><br/>
<table class="production_table">
   <tr>
      <td><?php if ($_smarty_tpl->tpl_vars['type']->value == "attack") {?>
            <h2><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("attack_order");?>
</h2>
          <?php } else { ?>
            <h2><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("support_order");?>
</h2>
          <?php }?>
      </td>
   </tr>
   </table>
   <form action="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=place&amp;action=command&amp;h=<?php echo $_smarty_tpl->tpl_vars['hkey']->value;?>
" method="POST" onSubmit="this.submit.disabled=true;">
      <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" value="true">
      <input type="hidden" name="x" value="<?php echo $_smarty_tpl->tpl_vars['values']->value['x'];?>
">
      <input type="hidden" name="y" value="<?php echo $_smarty_tpl->tpl_vars['values']->value['y'];?>
">
      <table  class="production_table" style="font-size:14pt" width="400">
         <tr><th colspan="2">dasdada</th></tr>
         <tr><td>Direction:</td><td><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=info_village;id=<?php echo $_smarty_tpl->tpl_vars['info_village']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['info_village']->value['name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['info_village']->value['x'];?>
|<?php echo $_smarty_tpl->tpl_vars['info_village']->value['y'];?>
)</a></td></tr>
         <tr><td>Player:</td><td><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=info_player;id=<?php echo $_smarty_tpl->tpl_vars['info_user']->value['id'];?>
;id=<?php echo $_smarty_tpl->tpl_vars['info_village']->value['userid'];?>
"><?php echo $_smarty_tpl->tpl_vars['info_user']->value['username'];?>
</a></td></tr>
         <tr><td>Duration:</td><td><?php echo format_time($_smarty_tpl->tpl_vars['unit_runtime']->value);?>
</td></tr>
         <tr><td>Arrival:</td><td><?php echo relative_date($_smarty_tpl->tpl_vars['arrival']->value);?>
 <span class="relative_time"><?php echo relative_time($_smarty_tpl->tpl_vars['unit_runtime']->value);?>
</span><span style="font-size:10pt; color: grey">:<?php echo $_smarty_tpl->tpl_vars['msec']->value;?>
</span></td></tr>
         
      </table>
      <br/>
         <table>
               <tr>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cl_units']->value->get_array("dbname"), 'dbname', false, 'name');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['name']->value => $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>
                     <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['send_units']->value[$_smarty_tpl->tpl_vars['dbname']->value];?>
">
                     <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/unit/<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
.png" title="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" /></td>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
               </tr>
               <tr>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cl_units']->value->get_array("dbname"), 'dbname', false, 'name');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['name']->value => $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>
                     <?php if ($_smarty_tpl->tpl_vars['send_units']->value[$_smarty_tpl->tpl_vars['dbname']->value] > 0) {?>
                        <td><?php echo $_smarty_tpl->tpl_vars['send_units']->value[$_smarty_tpl->tpl_vars['dbname']->value];?>
</td>
                     <?php } else { ?>
                        <td class="hidden">0</td>
                     <?php }?>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
               </tr>
            </table>
            <br/>
               <?php if ($_smarty_tpl->tpl_vars['send_units']->value['unit_cat'] > 0) {?>
                  <table class="vis">
                     <tr>
                        <td>
                           <select name="building" size="1">
                              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cl_builds']->value->get_array("dbname"), 'dbname', false, 'id');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>
                                 <option label="<?php echo $_smarty_tpl->tpl_vars['cl_builds']->value->get_name($_smarty_tpl->tpl_vars['dbname']->value);?>
" value="<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['cl_builds']->value->get_name($_smarty_tpl->tpl_vars['dbname']->value);?>
</option>
                              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                           </select>
                        </td>
                     </tr>
                  </table>
               <?php }?>
               <br/>
               <input name="submit" type="submit" onload="this.disabled=false;" value="OK" style="font-size:10pt;">         
   </form>
  <?php }
}
