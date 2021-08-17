<?php
/* Smarty version 3.1.39, created on 2021-08-12 13:46:39
  from 'F:\xampp\htdocs\s1_\templates\game_sim.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61150a1fcb5d10_18313945',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b2198ad3e1c05eb9ba350cc78a3175a01575370' => 
    array (
      0 => 'F:\\xampp\\htdocs\\s1_\\templates\\game_sim.tpl',
      1 => 1628768797,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61150a1fcb5d10_18313945 (Smarty_Internal_Template $_smarty_tpl) {
?><table class="production_table" width="50%">
<tr>
    <td>X</td>
   <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['units_data']->value, 'dbname', false, 'id');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>
      <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/unit/<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
.png"></td>
   <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</tr>
<tr>
<td>Trupe atacatoare</td>
   <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['units_data']->value, 'dbname', false, 'id');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>
      <td><?php echo $_smarty_tpl->tpl_vars['units_attacker']->value[$_smarty_tpl->tpl_vars['dbname']->value];?>
</td>
   <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</tr>
<tr>
<td>Trupe in total</td>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['units_data']->value, 'dbname');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['def_units']->value[$_smarty_tpl->tpl_vars['dbname']->value];?>
</td>  
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      
</tr>
<tr><td>Trupe pierdute atacator</td>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['units_data']->value, 'dbname');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['att_lose']->value['att_lose'][$_smarty_tpl->tpl_vars['dbname']->value];?>
</td>  
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</tr>
<tr><td>Trupe pierdute aparator</td>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['units_data']->value, 'dbname');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['att_lose']->value['def_lose'][$_smarty_tpl->tpl_vars['dbname']->value];?>
</td>  
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</tr>
<tr>
<td><?php echo $_smarty_tpl->tpl_vars['att_lose']->value['points'];?>
</td>
</tr>

</table><?php }
}
