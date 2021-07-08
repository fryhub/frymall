<?php if (!defined('THINK_PATH')) exit(); echo W("Main",array('module'=>MODULE_NAME,'action'=>ACTION_NAME));?>

<div class="layout-main">    
    <div id="breadclumb" class="box">
        <h3><strong><?php echo lang('breadclumb_colon');?></strong><?php echo lang(MODULE_NAME);?><span></span><?php echo (getfields("Item","name",$_GET["id"])); ?><span></span><?php echo lang('comments');?></h3>
    </div>
    <div id="CooperationMain" class="box clear-fix comments">   
        <div class="layout-block-header">
            <button type="button" onclick="commentsEdit('<?php echo ($_GET["id"]); ?>',0)" class="btn btn-ok"><?php echo lang('add_comments');?></button>
            <button type="button" onclick="commentsUpload('<?php echo ($_GET["id"]); ?>')" class="btn btn-ok"><?php echo lang('bulk_upload');?></button>
        </div>
        
		<form action="<?php echo U('Item/todo');?>" method="post" id="deleteform">
        <div class="ui-table">
            <div class="ui-table-body ui-table-body-hover">
                <table cellpadding="0" cellspacing="0" width="100%" >
                    <thead>
                        <tr class="ui-table-head">
							<th class="ui-table-hcell" width="20"><input type="checkbox" id="check_box" onclick="$.Select.All(this,'id[]');" ></th>
                            <th class="ui-table-hcell" width="80"><?php echo lang('name');?></th>
                            <th class="ui-table-hcell" width="80"><?php echo lang('mobile');?></th>
                            <th class="ui-table-hcell" width="80"><?php echo lang('region');?></th>
                            <th class="ui-table-hcell"><?php echo lang('comments');?></th>
                            <th class="ui-table-hcell">星级</th>
							<th class="ui-table-hcell"><?php echo lang('reply_comments');?></th>
							<th class="ui-table-hcell" width="120"><?php echo lang('time');?></th>
							<th class="ui-table-hcell" width="50"><?php echo lang('status');?></th>
                            <th class="ui-table-hcell" width="100"><?php echo lang('action');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="row-<?php echo ($vo["id"]); ?>">
							<td><input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" onclick="$.Select.This(this);"></td>
                            <td><?php echo ($vo["name"]); ?></td>
                            <td><?php echo ($vo["mobile"]); ?></td>
                            <td><?php echo ($vo["region"]); ?></td>
                            <td class="content"><?php echo ($vo["content"]); ?></td>
                            <td><?php echo ($vo["start"]); ?></td>
                            <td><?php echo ($vo["reply_content"]); ?></td>
                            <td><?php echo ($vo["add_time"]); ?></td>
                            <td><?php echo (status($vo["status"],"image")); ?></td>
                            <td class="action">
                                <q onclick="javascript:Delete('<?php echo ($vo["id"]); ?>','<?php echo U('Item/proccess/',array('do'=>'delete','module'=>'Comments','id'=>$vo['id']));?>')"><?php echo lang('delete');?></q> |
                                <q onclick="commentsEdit('<?php echo ($_GET["id"]); ?>','<?php echo ($vo["id"]); ?>')"><?php echo lang('modify');?></q>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
          
        <div class="ui-pager-bar clearfix" style="padding-left:10px;">
			<div class="float-left">
				<input type="hidden" name="model" value="Comments">
				<input type="checkbox" id="check_box" onclick="$.Select.All(this,'id[]');" >选择/反选 
				<input type="button" name="del" value="批量删除" class="btn" onclick="delConfirm()">
				<input type="submit" name="sort" value="批量排序" class="btn btn-ok">
				<input type="hidden" name="do" value="delete">
			</div>
			<div class="ui-pager" style="float:right"><?php echo ($page); ?></div>
		</div>
		
		</form>
</div><!--.box-->
<script type="text/javascript">
function commentsEdit(item_id,comments_id){
	var url = "?m=Item&a=commentsEdit&item_id="+item_id+"&comments_id="+comments_id;
	$.open(url,{title:'修改评论',width:850,height:550})
}
function commentsUpload(item_id){
	var url = "?m=Item&a=commentsUpload&item_id="+item_id;
	$.open(url,{title:'批量导入',width:550,height:250})
}
function delConfirm(){
	$.confirm('是否要删除？',function(){ 
		$('#deleteform').submit();
	},true)
}
</script>
<?php echo W("Foot");?>