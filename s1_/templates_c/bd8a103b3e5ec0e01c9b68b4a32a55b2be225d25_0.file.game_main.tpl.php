<?php
/* Smarty version 3.1.39, created on 2021-08-13 10:48:26
  from 'F:\xampp\htdocs\s1_\templates\game_main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_611631da518ac8_18826472',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bd8a103b3e5ec0e01c9b68b4a32a55b2be225d25' => 
    array (
      0 => 'F:\\xampp\\htdocs\\s1_\\templates\\game_main.tpl',
      1 => 1628844206,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_611631da518ac8_18826472 (Smarty_Internal_Template $_smarty_tpl) {
?><table width="50%">
   <tr>
      <td>
         <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/big_buildings/main1.png" />
      </td>
      <td>
         <h2><?php echo $_smarty_tpl->tpl_vars['cl_builds']->value->get_name('main');?>
</h2>
      </td>
   </tr>
</table>
<?php if ($_smarty_tpl->tpl_vars['building']->value) {?>
<table class="production_table">
   <tr>
      <th width="250"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("order");?>
</th>
      <th width="100"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("duration");?>
</th>
      <th width="150"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("endtime");?>
</th>
      <th width="150"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("cancel");?>
</th>

   </tr>
   <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['do_build']->value, 'item', false, 'id');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
      <?php $_smarty_tpl->_assignInScope('buildname', $_smarty_tpl->tpl_vars['do_build']->value[$_smarty_tpl->tpl_vars['id']->value]['build']);?>
      <tr>
         <td>
             <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/buildings/<?php echo $_smarty_tpl->tpl_vars['do_build']->value[$_smarty_tpl->tpl_vars['id']->value]['build'];?>
.png"><?php ob_start();
echo $_smarty_tpl->tpl_vars['do_build']->value[$_smarty_tpl->tpl_vars['id']->value]['build'];
$_prefixVariable1 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['lang']->value->get($_prefixVariable1);?>
(<?php echo $_smarty_tpl->tpl_vars['do_build']->value[$_smarty_tpl->tpl_vars['id']->value]['stage'];?>
)
         </td>
         <td>
             <span class="timer"><?php echo format_time($_smarty_tpl->tpl_vars['do_build']->value[$_smarty_tpl->tpl_vars['id']->value]['time']);?>
</span>
         </td>
         <td>
             <?php echo format_date($_smarty_tpl->tpl_vars['do_build']->value[$_smarty_tpl->tpl_vars['id']->value]['finished']);?>

         </td>
         <td>
            <a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=main&amp;action=cancel&amp;id=<?php echo $_smarty_tpl->tpl_vars['do_build']->value[$_smarty_tpl->tpl_vars['id']->value]['id'];?>
&amp;h=<?php echo $_smarty_tpl->tpl_vars['hkey']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("cancelb");?>
</a>
         </td>   
      </tr>
   <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
<?php }?>
<table class="production_table" width="50%">
   <tr>
      <th style="width:100px;" colspan="2"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("buildings");?>
</th>
      <th style="width:60px;"><div align="center"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/wood.png"/></div></th>
      <th style="width:60px;"><div align="center"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/stone.png"/></div></th>
      <th style="width:60px;"><div align="center"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/iron.png"/></div></th>
      <th style="width:60px;"><div align="center"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/face.png"/></div></th>
      <th style="width:60px;"><div align="center"></div></th>
   </tr>
 
   <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fulfilled_builds']->value, 'dbname', false, 'id');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>
   <tr>
   <th width="25"><div align="center"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/buildings/<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
.png"></div></th><td><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&screen=<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['cl_builds']->value->get_name($_smarty_tpl->tpl_vars['dbname']->value);?>
</a>(<?php echo $_smarty_tpl->tpl_vars['village']->value[$_smarty_tpl->tpl_vars['dbname']->value];?>
)</td>

      <?php if ($_smarty_tpl->tpl_vars['cl_builds']->value->get_maxstage($_smarty_tpl->tpl_vars['dbname']->value) <= $_smarty_tpl->tpl_vars['build_village']->value[$_smarty_tpl->tpl_vars['dbname']->value]) {?>
        
         <td colspan="6" align="center" class="inactive"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("maxlevel");?>
</td>
      <?php } else { ?>

          <td  align="center" class="inactive"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/wood.png"><?php echo $_smarty_tpl->tpl_vars['cl_builds']->value->get_wood($_smarty_tpl->tpl_vars['dbname']->value,$_smarty_tpl->tpl_vars['build_village']->value[$_smarty_tpl->tpl_vars['dbname']->value]+1);?>
</td>
          <td  align="center" class="inactive"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/stone.png"><?php echo $_smarty_tpl->tpl_vars['cl_builds']->value->get_stone($_smarty_tpl->tpl_vars['dbname']->value,$_smarty_tpl->tpl_vars['build_village']->value[$_smarty_tpl->tpl_vars['dbname']->value]+1);?>
</td>
          <td  align="center" class="inactive"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/iron.png"><?php echo $_smarty_tpl->tpl_vars['cl_builds']->value->get_iron($_smarty_tpl->tpl_vars['dbname']->value,$_smarty_tpl->tpl_vars['build_village']->value[$_smarty_tpl->tpl_vars['dbname']->value]+1);?>
</td>
          <td  align="center" class="inactive"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/face.png"><?php echo $_smarty_tpl->tpl_vars['cl_builds']->value->get_pop($_smarty_tpl->tpl_vars['dbname']->value,$_smarty_tpl->tpl_vars['build_village']->value[$_smarty_tpl->tpl_vars['dbname']->value]+1);?>
</td>
          <td  align="center" class="inactive"><?php echo format_time($_smarty_tpl->tpl_vars['cl_builds']->value->get_time($_smarty_tpl->tpl_vars['village']->value['main'],$_smarty_tpl->tpl_vars['dbname']->value,$_smarty_tpl->tpl_vars['build_village']->value[$_smarty_tpl->tpl_vars['dbname']->value]+1));?>
</td>
          <?php echo $_smarty_tpl->tpl_vars['cl_builds']->value->build($_smarty_tpl->tpl_vars['village']->value,$_smarty_tpl->tpl_vars['id']->value,$_smarty_tpl->tpl_vars['build_village']->value);?>


 
          <?php if ($_smarty_tpl->tpl_vars['cl_builds']->value->get_build_error2() == 'not_enough_ress') {?>
             <td align="center" class="inactive"><span><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("ress_dispo_in");?>
 <span class="timer_replace"><?php echo $_smarty_tpl->tpl_vars['cl_builds']->value->get_build_error();?>
</span></span><span style="display:none"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("ress_dispo");?>
</span></td>
          <?php } elseif ($_smarty_tpl->tpl_vars['cl_builds']->value->get_build_error2() == 'not_fulfilled') {?>
             <td class="inactive"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("not_req");?>
</td>
          <?php } elseif ($_smarty_tpl->tpl_vars['cl_builds']->value->get_build_error2() == 'not_enough_pop') {?>
             <td class="inactive"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("not_pop");?>
</td>
          <?php } elseif ($_smarty_tpl->tpl_vars['cl_builds']->value->get_build_error2() == 'not_enough_storage') {?>
             <td class="inactive"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("storage_space");?>
</td>
          <?php } else { ?>
                <?php if (count($_smarty_tpl->tpl_vars['do_build']->value) < 3) {?>
                    <td align="center"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&screen=main&action=build&id=<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
&h=<?php echo $_smarty_tpl->tpl_vars['hkey']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("build");?>
 <?php echo $_smarty_tpl->tpl_vars['build_village']->value[$_smarty_tpl->tpl_vars['dbname']->value]+1;?>
</a></td>
                <?php } else { ?>
                   <td align="center"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("build_limit");?>
</td>
                <?php }?>
          <?php }?>
          
      <?php }?>
   </tr>
   <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table><?php }
}
