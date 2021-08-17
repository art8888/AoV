<?php
/* Smarty version 3.1.39, created on 2021-07-31 00:26:26
  from 'F:\xampp\htdocs\s1_\templates\game_overview.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61047c92e4e1c7_06989945',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '21bfbeb3b382d97244efeac2fc12b5752b708a72' => 
    array (
      0 => 'F:\\xampp\\htdocs\\s1_\\templates\\game_overview.tpl',
      1 => 1627683986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61047c92e4e1c7_06989945 (Smarty_Internal_Template $_smarty_tpl) {
?><table cellspacing="0" cellpadding="0" style="border-width:1px; border-style:solid; border-color:#804000; background-color:#F1EBDD;" >
   <tr>
      <td>
         <div class="content_main" style="display:block;">
            <img usemap="#map" width="600" height="418" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/back_none.jpg">
            
             <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['built_builds']->value, 'dbname', false, 'id');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>
                <?php if ($_smarty_tpl->tpl_vars['dbname']->value == 'place') {?>
                    <?php if ($_smarty_tpl->tpl_vars['village']->value['place'] >= 1) {?>
                         <div class="p_place"><div class="flag place"><?php echo $_smarty_tpl->tpl_vars['village']->value['place'];?>
</div>
                         <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/place1.png"/>
                         </div>
                    <?php }?>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['dbname']->value == 'main') {?>
                     <div class="p_main"><div class="flag main"><?php echo $_smarty_tpl->tpl_vars['village']->value['main'];?>
</div>
                    <?php if ($_smarty_tpl->tpl_vars['is_building']->value) {?>
                       <?php if ($_smarty_tpl->tpl_vars['village']->value['main'] < '5') {?>
                          <img  src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/main1.gif"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['main'] >= '5' && $_smarty_tpl->tpl_vars['village']->value['main'] < '15') {?>
                          <img  src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/main2.gif"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['main'] >= '15') {?>
                         <img  src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/main3.gif"/>
                       <?php }?>
                    <?php } else { ?>
                        <?php if ($_smarty_tpl->tpl_vars['village']->value['main'] < '5') {?>
                          <img  src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/main1.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['main'] >= '5' && $_smarty_tpl->tpl_vars['village']->value['main'] < '15') {?>
                          <img  src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/main2.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['main'] >= '15') {?>
                          <img  src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/main3.png"/>
                       <?php }?>
                    <?php }?>
                    </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['dbname']->value == 'barracks') {?>
                <div class="p_barracks"><div class="flag barracks"><?php echo $_smarty_tpl->tpl_vars['village']->value['barracks'];?>
</div>
                   <?php if ($_smarty_tpl->tpl_vars['is_recruting_b']->value) {?>
                       <?php if ($_smarty_tpl->tpl_vars['village']->value['barracks'] < '5') {?>
                         <img  src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/barracks1.gif"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['barracks'] >= '5' && $_smarty_tpl->tpl_vars['village']->value['barracks'] < '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/barracks2.gif"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['barracks'] >= '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/barracks3.gif"/>
                       <?php }?>
                    <?php } else { ?>
                        <?php if ($_smarty_tpl->tpl_vars['village']->value['barracks'] < '5') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/barracks1.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['barracks'] >= '5' && $_smarty_tpl->tpl_vars['village']->value['barracks'] < '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/barracks2.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['barracks'] >= '20') {?>
                         <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/barracks3.png"/>
                       <?php }?>
                    <?php }?>
                </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['dbname']->value == 'stable') {?>
                <div class="p_stable"><div class="flag stable"><?php echo $_smarty_tpl->tpl_vars['village']->value['stable'];?>
</div>
                    <?php if ($_smarty_tpl->tpl_vars['is_recruting_s']->value) {?>
                       <?php if ($_smarty_tpl->tpl_vars['village']->value['stable'] < '5') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/stable1.gif"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['stable'] >= '5' && $_smarty_tpl->tpl_vars['village']->value['stable'] < '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/stable2.gif"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['stable'] >= '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/stable3.gif"/>
                       <?php }?>
                    <?php } else { ?>
                        <?php if ($_smarty_tpl->tpl_vars['village']->value['stable'] < '5') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/stable1.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['stable'] >= '5' && $_smarty_tpl->tpl_vars['village']->value['stable'] < '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/stable2.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['stable'] >= '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/stable3.png"/>
                       <?php }?>
                    <?php }?>
                </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['dbname']->value == 'garage') {?>
                <div class="p_garage"><div class="flag garage"><?php echo $_smarty_tpl->tpl_vars['village']->value['garage'];?>
</div>
                    <?php if ($_smarty_tpl->tpl_vars['is_recruting_g']->value) {?>
                       <?php if ($_smarty_tpl->tpl_vars['village']->value['garage'] < '5') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/garage1.gif"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['garage'] >= '5' && $_smarty_tpl->tpl_vars['village']->value['garage'] < '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/garage2.gif"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['garage'] >= '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/garage3.gif"/>
                       <?php }?>
                    <?php } else { ?>
                        <?php if ($_smarty_tpl->tpl_vars['village']->value['garage'] < '5') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/garage1.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['garage'] >= '5' && $_smarty_tpl->tpl_vars['village']->value['garage'] < '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/garage2.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['garage'] >= '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/garage3.png"/>
                       <?php }?>
                    <?php }?>
                </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['dbname']->value == 'snob') {?>
                <div class="p_snob"><div class="flag snob"><?php echo $_smarty_tpl->tpl_vars['village']->value['snob'];?>
</div>
                    <?php if ($_smarty_tpl->tpl_vars['is_recruting_n']->value) {?>
                       <?php if ($_smarty_tpl->tpl_vars['village']->value['snob'] >= '1') {?>
                         <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/snob1.gif"/>
                       <?php }?>
                    <?php } else { ?>
                        <?php if ($_smarty_tpl->tpl_vars['village']->value['snob'] >= '1') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/snob1.png"/>
                       <?php }?>
                    <?php }?>
                </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['dbname']->value == 'smith') {?>
                <div class="p_smith"><div class="flag smith"><?php echo $_smarty_tpl->tpl_vars['village']->value['smith'];?>
</div>
                    <?php if ($_smarty_tpl->tpl_vars['is_researching']->value) {?>
                       <?php if ($_smarty_tpl->tpl_vars['village']->value['smith'] < '5') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/smith1.gif"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['smith'] >= '5' && $_smarty_tpl->tpl_vars['village']->value['smith'] < '15') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/smith2.gif"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['smith'] >= '15') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/smith3.gif"/>
                       <?php }?>
                    <?php } else { ?>
                        <?php if ($_smarty_tpl->tpl_vars['village']->value['smith'] < '5') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/smith1.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['smith'] >= '5' && $_smarty_tpl->tpl_vars['village']->value['smith'] < '15') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/smith2.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['smith'] >= '15') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/smith3.png"/>
                       <?php }?>
                    <?php }?>
                </div>    
                <?php } elseif ($_smarty_tpl->tpl_vars['dbname']->value == 'market') {?>
                <div class="p_market"><div class="flag market"><?php echo $_smarty_tpl->tpl_vars['village']->value['market'];?>
</div>
                        <?php if ($_smarty_tpl->tpl_vars['village']->value['market'] < '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/market1.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['market'] >= '10' && $_smarty_tpl->tpl_vars['village']->value['market'] < '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/market2.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['market'] >= '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/market3.png"/>
                       <?php }?>
                </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['dbname']->value == 'wood') {?>
                <div class="p_wood"><div class="flag wood"><?php echo $_smarty_tpl->tpl_vars['village']->value['wood'];?>
</div>
                     <?php if ($_smarty_tpl->tpl_vars['village']->value['wood'] < '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/wood1.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['wood'] >= '10' && $_smarty_tpl->tpl_vars['village']->value['wood'] < '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/wood2.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['wood'] >= '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/wood3.png"/>
                       <?php }?>
                </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['dbname']->value == 'stone') {?>
                <div class="p_stone"><div class="flag stone"><?php echo $_smarty_tpl->tpl_vars['village']->value['stone'];?>
</div>
                     <?php if ($_smarty_tpl->tpl_vars['village']->value['stone'] < '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/stone1.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['stone'] >= '10' && $_smarty_tpl->tpl_vars['village']->value['stone'] < '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/stone2.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['stone'] >= '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/stone3.png"/>
                       <?php }?>
                </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['dbname']->value == 'iron') {?>
                <div class="p_iron"><div class="flag iron"><?php echo $_smarty_tpl->tpl_vars['village']->value['iron'];?>
</div>
                     <?php if ($_smarty_tpl->tpl_vars['village']->value['iron'] < '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/iron1.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['iron'] >= '10' && $_smarty_tpl->tpl_vars['village']->value['iron'] < '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/iron2.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['iron'] >= '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/iron3.png"/>
                       <?php }?>
                </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['dbname']->value == 'farm') {?>
                <div class="p_farm"><div class="flag farm"><?php echo $_smarty_tpl->tpl_vars['village']->value['farm'];?>
</div>
                     <?php if ($_smarty_tpl->tpl_vars['village']->value['farm'] < '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/farm1.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['farm'] >= '10' && $_smarty_tpl->tpl_vars['village']->value['farm'] < '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/farm2.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['farm'] >= '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/farm3.png"/>
                       <?php }?>
                </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['dbname']->value == 'storage') {?>
                <div class="p_storage"><div class="flag storage"><?php echo $_smarty_tpl->tpl_vars['village']->value['storage'];?>
</div>
                     <?php if ($_smarty_tpl->tpl_vars['village']->value['storage'] < '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/storage1.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['storage'] >= '10' && $_smarty_tpl->tpl_vars['village']->value['storage'] < '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/storage2.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['storage'] >= '20') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/storage3.png"/>
                       <?php }?>
                </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['dbname']->value == 'wall') {?>
                <div class="p_wall"><div class="flag wall"><?php echo $_smarty_tpl->tpl_vars['village']->value['wall'];?>
</div>
                     <?php if ($_smarty_tpl->tpl_vars['village']->value['wall'] < '10') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/wall1.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['wall'] >= '10' && $_smarty_tpl->tpl_vars['village']->value['wall'] < '15') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/wall2.png"/>
                       <?php } elseif ($_smarty_tpl->tpl_vars['village']->value['wall'] >= '15') {?>
                          <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/wall3.png"/>
                       <?php }?>
                </div>
                <?php }?>
                 
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

            <img class="empty" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/visual/empty.png" alt="" usemap="#map" />
            <map name="map" id="map_buildings">
             <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['built_builds']->value, 'dbname', false, 'id');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>
            <a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
""><area shape="poly" target="_blank" coords="<?php echo $_smarty_tpl->tpl_vars['cl_builds']->value->get_GraphicCoords($_smarty_tpl->tpl_vars['dbname']->value);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['cl_builds']->value->get_name($_smarty_tpl->tpl_vars['dbname']->value);?>
" title="<?php echo $_smarty_tpl->tpl_vars['cl_builds']->value->get_name($_smarty_tpl->tpl_vars['dbname']->value);?>
"></a>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </map>
            
             
            
             
         </div>
      </td>
      <td>
        <table class="production_table" class="vis overview_table" width="100%">
        <tr>
              <thead>
        <tr>
            <th colspan="2"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("resources");?>
</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/wood.png"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("wood");?>
</td>
            <td><b><?php echo round($_smarty_tpl->tpl_vars['wood_per_hour']->value);?>
</b> <?php echo $_smarty_tpl->tpl_vars['lang']->value->get("perh");?>
</td>
        </tr>
         <tr>
            <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/stone.png"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("stone");?>
</td>
            <td><b><?php echo round($_smarty_tpl->tpl_vars['stone_per_hour']->value);?>
</b> <?php echo $_smarty_tpl->tpl_vars['lang']->value->get("perh");?>
</td>
        </tr>
         <tr>
            <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/iron.png"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("iron");?>
</td>
            <td><b><?php echo round($_smarty_tpl->tpl_vars['iron_per_hour']->value);?>
</b> <?php echo $_smarty_tpl->tpl_vars['lang']->value->get("perh");?>
</td>
        </tr>
    </tbody>
           </tr>
           <tr>
              <th colspan="2"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("troops");?>
</th>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['in_village']->value, 'dbname', false, 'id');
$_smarty_tpl->tpl_vars['dbname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['dbname']->value) {
$_smarty_tpl->tpl_vars['dbname']->do_else = false;
?>
              <tr class="nowrap row_a">
                 <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/unit/<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
.png"><b><?php echo $_smarty_tpl->tpl_vars['troops']->value[$_smarty_tpl->tpl_vars['dbname']->value];?>
</b></td>
                 <td><?php echo $_smarty_tpl->tpl_vars['cl_units']->value->get_name($_smarty_tpl->tpl_vars['dbname']->value);?>
</td>
              </tr>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
           </tr>
          
        </table>
      </td>
    </tr>
    <th>
       <table class="production_table">
          <?php if ($_smarty_tpl->tpl_vars['nb']->value >= 1) {?>
          <div id="info_troops"></div>
          <tr>
             <td><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("commands");?>
:</td>
             <td><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("land");?>
:</td>
             <td><?php echo $_smarty_tpl->tpl_vars['lang']->value->get("land_in");?>
:</td>
          </tr>

          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cmd']->value, 'name', false, 'key');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
              <tr>
                 <td><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['cdn'];?>
/graphic/<?php echo $_smarty_tpl->tpl_vars['cmd']->value[$_smarty_tpl->tpl_vars['key']->value]['type'];?>
.png" width="20" height="20" onmouseover="showinfo_command(event, <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['cmd']->value[$_smarty_tpl->tpl_vars['key']->value]['from_user'];?>
, <?php echo $_smarty_tpl->tpl_vars['cmd']->value[$_smarty_tpl->tpl_vars['key']->value]['to_user'];?>
)" onmouseout="hideinfo_command()"><a href="game.php?village=<?php echo $_smarty_tpl->tpl_vars['village']->value['id'];?>
&amp;screen=info_command&amp;id=<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
&amp;h=<?php echo $_smarty_tpl->tpl_vars['hkey']->value;?>
" ><?php echo $_smarty_tpl->tpl_vars['cmd']->value[$_smarty_tpl->tpl_vars['key']->value]['name_from'];?>
 <?php echo $_smarty_tpl->tpl_vars['cmd']->value[$_smarty_tpl->tpl_vars['key']->value]['type'];?>
 <?php echo $_smarty_tpl->tpl_vars['cmd']->value[$_smarty_tpl->tpl_vars['key']->value]['name_to'];?>
</a> - </td>
                 <td><?php echo format_date($_smarty_tpl->tpl_vars['cmd']->value[$_smarty_tpl->tpl_vars['key']->value]['end_time']);?>
 - </td>
                 <td><span class="timer"><?php echo format_time($_smarty_tpl->tpl_vars['cmd']->value[$_smarty_tpl->tpl_vars['key']->value]['countdown']);?>
</span></td>
              </tr>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <?php }?>
         
       </table>
    </th>  
</table><?php }
}
