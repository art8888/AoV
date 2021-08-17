<?php
/* Smarty version 3.1.39, created on 2021-07-21 09:05:15
  from 'F:\xampp\htdocs\s1_\templates\game_map.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60f7c72babe974_29718410',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c375796c6cdfc75f83c7e1f827c11f48c7f20dc' => 
    array (
      0 => 'F:\\xampp\\htdocs\\s1_\\templates\\game_map.tpl',
      1 => 1626851111,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60f7c72babe974_29718410 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="info" style="position:absolute; top:150px; left:900px; width:350px; height:1px; visibility: hidden; z-index:10"></div>

<table collspacing="0" collpadding="0" width="100%">
   <tr>
      <td valign="top">
         <table class="vis" style="border:1px solid #804000; margin-bottom:5px;" align="center">
            <tr class="nowrap">
               <th valign="top"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("std");?>
:</th>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(255,255,255)"></th>
						<td style="white-space:normal"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("act");?>
</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(240,200,0)"></th>
						<td style="white-space:normal; width:100px;"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("ownv");?>
</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(0,0,244)"></th>
						<td style="white-space:normal"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("tribev");?>
</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(150,150,150)"></th>
						<td style="white-space:normal"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("barb");?>
</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(130,60,10)"></th>
						<td style="white-space:normal"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("other");?>
</td>
            </tr>
            <tr class="nowrap">
						<th valign="top"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("tribe");?>
:</th>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(0,160,244)"></th>
						<td style="white-space:normal;"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("allyt");?>
</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(128,0,128)"></th>
						<td style="white-space:normal;" colspan="3"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("pna");?>
</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(244,0,0)"></th>
						<td style="white-space:normal" colspan="3"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("enemy");?>
</td>
					</tr>
         </table>
         <table cellspacing="0" cellpadding="0" class="vis" style="border:1px solid #804000;" >
            <tr>
               <th></th>
               <th><div align="center"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=map&amp;x=<?php echo $_smarty_tpl->tpl_vars['map']->value['x'];?>
&amp;y=<?php echo $_smarty_tpl->tpl_vars['map']->value['y']-$_smarty_tpl->tpl_vars['map']->value['size'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/map/map_n.png" style="z-index:1; position:relative;" /></a></div></th>
               <th></th>
            </tr>
            <tr>
               <th align="center"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=map&amp;x=<?php echo $_smarty_tpl->tpl_vars['map']->value['x']-$_smarty_tpl->tpl_vars['map']->value['size'];?>
&amp;y=<?php echo $_smarty_tpl->tpl_vars['map']->value['y'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/map/map_w.png" style="z-index:1; position:relative;" /></a></th>
               <td>
                     <form action="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&screen=map" method="post">
                        <input type="hidden" name="curx" value="<?php echo $_smarty_tpl->tpl_vars['map']->value['x'];?>
" maxlength="3" />
                        <input type="hidden" name="cury" value="<?php echo $_smarty_tpl->tpl_vars['map']->value['y'];?>
" maxlength="3" />
                        <input type="image" name="" style="cursor:hand;" src="minimap.php?x=<?php echo $_smarty_tpl->tpl_vars['map']->value['x'];?>
&y=<?php echo $_smarty_tpl->tpl_vars['map']->value['y'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&hkey=<?php echo $_smarty_tpl->tpl_vars['hkey']->value;?>
" />
                     </form>
                  </td>
               <td>
                  <table style="background-color:rgba(0, 0, 0, 0.5); border:1px solid #000; border-spacing:0px;" cellpadding="0" class="map" >
                     <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['y_coords']->value, 'y');
$_smarty_tpl->tpl_vars['y']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['y']->value) {
$_smarty_tpl->tpl_vars['y']->do_else = false;
?>
                        <tr>
                           <td width="20"><?php echo $_smarty_tpl->tpl_vars['y']->value;?>
</td>
                           <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['x_coords']->value, 'x');
$_smarty_tpl->tpl_vars['x']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['x']->value) {
$_smarty_tpl->tpl_vars['x']->do_else = false;
?>
                                 <?php if (!$_smarty_tpl->tpl_vars['cl_map']->value->has_villages($_smarty_tpl->tpl_vars['x']->value,$_smarty_tpl->tpl_vars['y']->value)) {?>
                                    <td id="" class=""><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/map/<?php echo $_smarty_tpl->tpl_vars['cl_map']->value->environement($_smarty_tpl->tpl_vars['x']->value,$_smarty_tpl->tpl_vars['y']->value);?>
.png"></td>
                                 <?php } else { ?>
                                    <td id="" class="" style="background-color:rgb(<?php echo $_smarty_tpl->tpl_vars['cl_map']->value->getColor($_smarty_tpl->tpl_vars['x']->value,$_smarty_tpl->tpl_vars['y']->value);?>
)"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=info_village&amp;id=<?php echo $_smarty_tpl->tpl_vars['cl_map']->value->getVillageId($_smarty_tpl->tpl_vars['x']->value,$_smarty_tpl->tpl_vars['y']->value);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/map/<?php echo $_smarty_tpl->tpl_vars['cl_map']->value->graphic($_smarty_tpl->tpl_vars['x']->value,$_smarty_tpl->tpl_vars['y']->value);?>
" onmouseover="showinfo(<?php echo $_smarty_tpl->tpl_vars['cl_map']->value->getVillageId($_smarty_tpl->tpl_vars['x']->value,$_smarty_tpl->tpl_vars['y']->value);?>
, <?php echo $_smarty_tpl->tpl_vars['cl_map']->value->getvillage($_smarty_tpl->tpl_vars['x']->value,$_smarty_tpl->tpl_vars['y']->value,'userid');?>
, <?php echo $_smarty_tpl->tpl_vars['village']->value['x'];?>
, <?php echo $_smarty_tpl->tpl_vars['village']->value['y'];?>
);" onmouseout="hideinfo();" /></a></td>
                                 <?php }?>
                                
                                
                           <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tr>
                     <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                     <tr>
									<td height="20"></td>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['x_coords']->value, 'x');
$_smarty_tpl->tpl_vars['x']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['x']->value) {
$_smarty_tpl->tpl_vars['x']->do_else = false;
?>
										<td><?php echo $_smarty_tpl->tpl_vars['x']->value;?>
</td>
									<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								</tr>
                  </table>
               </td>
               <th align="center"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=map&amp;x=<?php echo $_smarty_tpl->tpl_vars['map']->value['x']+$_smarty_tpl->tpl_vars['map']->value['size']-1;?>
&amp;y=<?php echo $_smarty_tpl->tpl_vars['map']->value['y'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/map/map_e.png" style="z-index:1; position:relative;" /></a></th>
					</tr>
					<tr>
						<th></th>
						<th><div align="center"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=map&amp;x=<?php echo $_smarty_tpl->tpl_vars['map']->value['x'];?>
&amp;y=<?php echo $_smarty_tpl->tpl_vars['map']->value['y']+$_smarty_tpl->tpl_vars['map']->value['size'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/map/map_s.png" style="z-index:1; position:relative;" /></a></div></th>
						<th></th>
					</tr>
            </tr>
         </table>
      </td>

   </tr>
</table><?php }
}
