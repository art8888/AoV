<?php
/* Smarty version 3.1.39, created on 2021-07-20 23:00:50
  from 'F:\xampp\htdocs\s1_\templates\game_stats.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60f73982e8fe21_32773416',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fd4cb13f805cc3ea7a5dd172d7bf4ab0a16eea10' => 
    array (
      0 => 'F:\\xampp\\htdocs\\s1_\\templates\\game_stats.tpl',
      1 => 1626814849,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60f73982e8fe21_32773416 (Smarty_Internal_Template $_smarty_tpl) {
?><table class="data-table">
<tr>
   <td>Nr players</td>
   <td>4901</td>
</tr>
<tr>
   <td>Total sate:</td>
   <td><span class="grey">6153(1.26 per jucator)</span></td>
</tr>
<tr>
   <td>Sate jucatori:</td>
   <td><span class="grey">4884</span></td>
</tr>
<tr>
   <td>Sate barbari:</td>
   <td><span class="grey">4884</span></td>
</tr>
<tr>
   <td>Sate bonus:</td>
   <td><span class="grey">4884</span></td>
</tr>
<tr>
   <td>Points total:</td>
   <td><span class="grey">2573312(525 per jucator)</span></td>
</tr>
<tr>
   <td>
      <ul class="material-list">
         <li>
            <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/wood.png"><?php echo round($_smarty_tpl->tpl_vars['r']->value['r_wood']);?>

         </li>
         <li>
            <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/stone.png"><?php echo round($_smarty_tpl->tpl_vars['r']->value['r_stone']);?>

         </li>
         <li>
            <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/iron.png"><?php echo round($_smarty_tpl->tpl_vars['r']->value['r_iron']);?>

         </li>
      </ul>
   </td>
</tr>
<tr>
   <td>Total troops:</td>
   <td>
      <ul>
         <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cl_units2']->value, 'dbname');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>
            <li>
               <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/unit/<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
.png"> - <?php echo $_smarty_tpl->tpl_vars['u']->value[$_smarty_tpl->tpl_vars['dbname']->value];?>

            </li>
         <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </ul>
   </td>
</tr>
</table><?php }
}
