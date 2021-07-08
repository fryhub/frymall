<?php if (!defined('THINK_PATH')) exit(); echo W("Main",array('module'=>MODULE_NAME,'action'=>ACTION_NAME));?>

<div class="layout-main">    
    <div id="breadclumb" class="box">
        <h3>
        	<strong><?php echo lang('breadclumb_colon');?></strong>
            <?php echo lang(MODULE_NAME);?><span></span><?php echo lang('category');?>
        </h3>
    </div>
    <div id="CooperationMain" class="box clear-fix">   
        <div class="layout-block-header"><a class="btn btn-ok" href="<?php echo U(MODULE_NAME.'/category',array('do'=>'edit','type'=>$type));?>"><?php echo lang('add');?></a></div>
        
        <div class="ui-table">
            <div class="ui-table-body ui-table-body-hover">
                <table cellpadding="0" cellspacing="0" width="100%" >
                    <thead>
                        <tr class="ui-table-head">
                            <th class="ui-table-hcell ui-table-hcell-sort" width="40"><?php echo lang('id');?></th>
                            <th class="ui-table-hcell ui-table-hcell-sort"><?php echo lang('name');?></th>
                            <th class="ui-table-hcell ui-table-hcell-sort"><?php echo lang('type');?></th>
                            <th class="ui-table-hcell ui-table-hcell-sort"><?php echo lang('image');?></th>
                            <th class="ui-table-hcell ui-table-hcell-sort"><?php echo lang('sortorder');?></th>
                            <th class="ui-table-hcell ui-table-hcell-sort" width="100"><?php echo lang('action');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="row-<?php echo ($vo["id"]); ?>">
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["name"]); ?></td>
                            <td><?php echo (status($vo["type"],"",array('1'=>lang('item'),'2'=>lang('article')))); ?></td>
                            <td><?php if(!empty($vo["image"])): ?><img src="<?php echo (imageurl($vo["image"])); ?>" height="50"><?php endif; ?></td>
                            <td><?php echo ($vo["sort_order"]); ?></td>
                            <td class="action">
                                <a href="<?php echo U('Item/category',array('do'=>'edit','id'=>$vo['id']));?>"><?php echo lang('edit');?></a> |
                                <q onclick="javascript:Delete('<?php echo ($vo["id"]); ?>','<?php echo U('Category/delete/',array('id'=>$vo['id']));?>')"><?php echo lang('delete');?></q>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
          
    </div><!--.box-->
<?php echo W("Foot");?>