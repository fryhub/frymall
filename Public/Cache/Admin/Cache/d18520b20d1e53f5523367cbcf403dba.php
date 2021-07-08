<?php if (!defined('THINK_PATH')) exit(); echo W("Main",array('module'=>MODULE_NAME,'action'=>ACTION_NAME));?>
<?php if(empty($akmallConfig["item_quantity"])): ?><style>.akmallQuantity{display:none;}</style><?php endif; ?>
<style>
.using{background:#00c3af;color:#fff;display:inline-block;padding:1px 5px;border-radius:2px;}
.using:hover{background:#00ab99;color:#fff !important;}
.ellipsis{overflow: hidden;text-overflow: ellipsis;white-space: nowrap;word-break: break-all;word-wrap: break-word;}
</style>
<div class="layout-main">    
    <div id="breadclumb" class="box">
        <h3><strong><?php echo lang('breadclumb_colon');?></strong><?php echo lang(MODULE_NAME);?><span></span><?php echo lang('item_list');?></h3>
    </div>
    <div id="CooperationMain" class="box clear-fix">   
        <div class="layout-block-header">
            <form action="__SELF__" method="get" id="searchform">
            	<input type="hidden" name="s" value="<?php echo (MODULE_NAME); ?>" />
				<input type="hidden" name="a" value="<?php echo (ACTION_NAME); ?>" />
                <label><?php echo lang('search_colon');?></label>
                <input type="text" name="keyword" value="<?php echo (trim($_GET['keyword'])); ?>" class="ui-text" autocomplete="off" size="40">
				<select name="category_id">
					<option value="0"><?php echo lang('select_category');?></option>
					<?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($_GET["category_id"]) == $vo["id"]): ?>selected='selected'<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<!-- 商品列表添加用户筛选 -->
				<select name="user_id">
						<?php $users=M('User')->where("status=1")->select(); ?>
						<option value="">选择用户</option>
						<?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($_GET["user_id"]) == $vo["id"]): ?>selected='selected'<?php endif; ?>><?php echo ($vo["username"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<!-- 商品列表添加用户筛选 -->
                <button type="submit" class="btn btn-ok"><?php echo lang('search');?></button>
            </form>
        </div>
        
		<form action="<?php echo U('Item/todo');?>" method="post" id="deleteform">
        <div class="ui-table">
            <div class="ui-table-body ui-table-body-hover">
                <table cellpadding="0" cellspacing="0" width="100%" >
                    <thead>
                        <tr class="ui-table-head">
                            <th class="ui-table-hcell" width="20"><input type="checkbox" id="check_box" onclick="$.Select.All(this,'id[]');" ></th>
                            <th class="ui-table-hcell" width="35"><?php echo lang('sortOrder');?></th>
                            <th class="ui-table-hcell" width="60"><?php echo lang('item_number');?></th>
                            <th class="ui-table-hcell" width="240"><?php echo lang('name');?></th>
							<th class="ui-table-hcell" width="80">绑定域名</th>
                            <th class="ui-table-hcell" width="80"><?php echo lang('category');?></th>
                            <th class="ui-table-hcell" width="40"><?php echo lang('price');?></th>
                            <th class="ui-table-hcell akmallQuantity" width="40">库存</th>
                            <th class="ui-table-hcell" width="30"><?php echo lang('package');?></th>
							<th class="ui-table-hcell" width="30"><?php echo lang('status');?></th>
							<th class="ui-table-hcell" width="100">IPCLOAK</th><!--ip_cloak设置-->
                            <th class="ui-table-hcell" width="135"><?php echo lang('action');?></th>
							<th class="ui-table-hcell" width="80"><?php echo lang('user');?>/<?php echo lang('agent');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="row-<?php echo ($vo["id"]); ?>">
                            <td><input type="checkbox" class="itemId" name="id[]" value="<?php echo ($vo["id"]); ?>" onclick="$.Select.This(this);"></td>
                            <td><input type="text" class="ui-text" size="1" name="sort_order[<?php echo ($vo["id"]); ?>]" value="<?php echo ($vo["sort_order"]); ?>"></td>
							<td><?php echo ($vo["sn"]); ?></td>
                            <td>
								<a href="<?php echo ($vo["url"]["detail"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a>
								<?php if(!empty($vo["image"])): ?><a href="<?php echo (imageurl($vo["image"])); ?>" title="<?php echo lang('image');?>" target="_blank"><img src="__PUBLIC__/Assets/img/pic.jpg" /></a><?php endif; ?>
								<?php if(($vo["is_hot"]) == "1"): ?><img src="__PUBLIC__/Assets/img/hot.gif" /><?php endif; ?>
								<br /><?php if(!empty($vo["aliasname"])): echo ($vo["aliasname"]); endif; ?>
							</td>
							<td><a href="http://<?php echo ($vo["domain"]); echo C('akmall_ROOT');?>" target="_blank"><?php echo ($vo["domain"]); ?></a></td>
                            <td><?php echo (getfields("Category","name",$vo["category_id"])); ?></td>
                            <td><?php echo ($vo["price"]); ?></td>
                            <td class="akmallQuantity"><?php echo ($vo["quantity"]); ?></td>
                            <td><?php echo (count(json_decode($vo["params"],true))); ?></td>
							<td><?php echo (status($vo["status"],"image")); ?></td>
							<td class="ellipsis"><a href="<?php echo ($vo["ipcloak_url"]); ?>" target="_blank"><?php echo ($vo["ipcloak_url"]); ?> </a></td><!--ipcloak设置-->
                            <td class="action">
                                <?php if(in_array('itemModify',$_SESSION['user']['auth'])): ?><a href="<?php echo U('Item/'.ACTION_NAME,array('do'=>'edit','id'=>$vo['id']));?>"><?php echo lang('edit');?></a><?php endif; ?>
                                <?php if(in_array('itemAdd',$_SESSION['user']['auth'])): ?><a href="<?php echo U('Item/'.ACTION_NAME,array('do'=>'copy','id'=>$vo['id']));?>"><?php echo lang('copy');?></a><?php endif; ?>
								<a <?php if(in_array('itemComments',$_SESSION['user']['auth'])): ?>href="<?php echo U('Item/'.ACTION_NAME,array('do'=>'comments','id'=>$vo['id']));?>"<?php else: ?>class="grey"<?php endif; ?>><?php echo lang('comments');?>(<?php echo getFields("Comments","count(id)",$vo['id'],"item_id");?>)</a> <br /><br />
								<q onclick="using('<?php echo ($vo["id"]); ?>','<?php echo ($vo["name"]); ?>')" class="using">模板设置</q>
								<q onclick="qrcode('<?php echo ($vo["id"]); ?>','<?php echo ($vo["name"]); ?>')" class="using"><?php echo lang('using');?></q>
                            </td>
							<!-- 商品栏后面添加用户组 -->
							<td>
								<?php if(!empty($vo["user_id"])): ?><span style='color:#fff;background-color: #ff963e;padding: 1px 4px;border-radius: 2px;'><?php echo (getfields("User","username",$vo["user_id"])); ?></span><?php endif; ?>
								<?php if(!empty($vo["user_pid"])): ?><br /><br /><span style='color:#fff;background-color: #ffc107;padding: 1px 4px;border-radius: 2px;'><?php echo (getfields("User","username",$vo["user_pid"])); ?></span><?php endif; ?>
							</td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
          
        <div class="ui-pager-bar clearfix" style="padding-left:10px;">
			<div class="float-left">
			<?php if(in_array('itemAuth',$_SESSION['user']['auth'])): ?><input type="hidden" name="model" value="<?php echo (MODULE_NAME); ?>">
				<input type="checkbox" id="check_box" onclick="$.Select.All(this,'id[]');" >选择/反选 
				<input type="button" name="del" value="批量删除" class="btn" onclick="delConfirm()">
				<input type="submit" name="sort" value="批量排序" class="btn btn-ok">				
				<!-- <q class="btn btn-ok" onclick="auth(0,'批量授权')">批量授权</q> -->				
				<input type="hidden" name="del" value="1"><?php endif; ?>
			</div>
			<div class="ui-pager" style="float:right"><?php echo ($page); ?></div>
		</div>
		
		</form>
</div><!--.box-->
<script type="text/javascript">

function using(id,title){
	var url = "?m=Item&a=index&do=using&id="+id;
	$.open(url,{title:'页面设置 - '+title,width:980,height:500})
}
function qrcode(id,title){
	var url = "?m=Item&a=qrcode&id="+id;
	$.open(url,{title:'推广 - '+title,width:850,height:300})
}
function auth(id,title){
	if(id===0){
		var ids = new Array(),i=0;
		 $(".itemId").each(function(){
			var _this = $(this);
			if(_this.attr("checked")=="checked"){ ids[i] =_this.val(); i++;}
		})
		id = ids.join();
	}
	var url = "?m=Item&a=auth&id="+id;
	$.open(url,{title:'授权 - '+title,width:500,height:250})
}
function delConfirm(){
	$.confirm('是否要删除？',function(){ 
		$('#deleteform').submit();
	},true)
}
</script>
<?php echo W("Foot");?>