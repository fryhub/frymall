<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<link href="__PUBLIC__/Assets/css/esui.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/Assets/css/union.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/Assets/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Assets/js/jquery.form.js"></script>
<script type="text/javascript" src="__PUBLIC__/Assets/js/jscolor.min.js"></script>
</head>
<body>
<div class="layout-main">    
    <div class="box clear-fix">
		<form method="post" action="<?php echo U('Item/proccess');?>" id="ajaxform" enctype="multipart/form-data">
		<table class="info-table comments">
			<tbody>
				<tr>
					<th width="60"><?php echo lang('status');?></th>
					<td>
						<select name="status"><?php echo (status($info["status"],"select")); ?></select>
						<span class="ui-validityshower-info">（禁用则前台不显示）</span>
					</td>
					<th width="60">星级</th>
					<td>
						<select name="start">
							<?php $__FOR_START_25970__=1;$__FOR_END_25970__=6;for($i=$__FOR_START_25970__;$i < $__FOR_END_25970__;$i+=1){ ?><option value="heart-<?php echo ($i); ?>" <?php if($info["start"] == '' && $i == '5'): ?>selected<?php endif; ?> <?php if(($info["start"]) == "heart-$i"): ?>selected<?php endif; ?>><?php echo ($i); ?> 心</option><?php } ?>
							<!-- <?php $__FOR_START_20604__=1;$__FOR_END_20604__=6;for($i=$__FOR_START_20604__;$i < $__FOR_END_20604__;$i+=1){ ?><option value="diamond-<?php echo ($i); ?>" <?php if(($info["start"]) == "diamond-$i"): ?>selected<?php endif; ?>><?php echo ($i); ?> 钻</option><?php } ?> -->
						</select>
					</td>
				</tr>
                <tr>
                    <th>姓名</th>
                    <td>
                        <input name="name" class="ui-text" size="20" id="name" type="text" value="<?php echo ($info["name"]); ?>" >
                    </td>
             
                    <th>手机</th>
                    <td>
                        <input name="mobile" class="ui-text" size="20" id="mobile" type="text" value="<?php echo ($info["mobile"]); ?>" >
                    </td>
                </tr>
				<tr>
					<th>地区</th>
					<td>
						<input name="region" class="ui-text" size="20" id="region" type="text" value="<?php echo ($info["region"]); ?>" >
					</td>
				
					<th>时间</th>
					<td>
						<input name="add_time"  class="ui-text Wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" size="20" id="region" type="text" value="<?php if(empty($info["add_time"])): echo date('Y-m-d'); else: echo ($info["add_time"]); endif; ?>" >
					</td>
				</tr>
				<tr>
					<th>标题</th>
					<td colspan="3">
						<input name="title" class="ui-text" size="80" id="title" type="text" value="<?php echo ($info["title"]); ?>" >
					</td>
				
				</tr>
				<tr>
					<th>评论内容</th>
					<td colspan="3">
						<textarea name="content" id="content" class="input-textarea editor" cols="80" rows="2"  style="width:600px;"><?php echo ($info["content"]); ?></textarea>
					</td>
				</tr>
				<tr>
					<th>回复内容</th>
					<td colspan="3">
						<textarea name="reply_content" id="reply_content" class="input-textarea editor" cols="80" rows="2"  style="width:600px;"><?php echo ($info["reply_content"]); ?></textarea>
					</td>
				</tr>
	
				<tr>
					<th>&nbsp;</th>
					<td>
						<input type="submit"class="btn btn-ok" value="确认提交" />
					</td>
				</tr>
				<tr style="display:none;">
					<th>&nbsp;</th>
					<td>
						<?php if(!empty($_GET["comments_id"])): ?><input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"><?php endif; ?>
						<input type="hidden" name="item_id" value="<?php echo ($_GET['item_id']); ?>" />
						<input type="hidden" name="module" value="Comments" />
						<input type="hidden" name="user_id" value="<?php echo ($_SESSION["user"]["id"]); ?>" />
					</td>
				</tr>
			</tbody>
		</table>
		</form>
    </div><!--.box-->
<script type="text/javascript" src="__PUBLIC__/Assets/js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
$(function(){
    $('#ajaxform').ajaxForm({
        success:function(data){ 
			color = data.data;
			parent.$.alert('操作成功',1,false);
		},
        dataType: 'json'
    });
});

</script>   
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Assets/js/ueditor-1.4.3/ueditor.config.js?v=1"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Assets/js/ueditor-1.4.3/ueditor.all.js?v=1"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Assets/js/ueditor-1.4.3/lang/zh-cn/zh-cn.js?v=1"></script>
<script type="text/javascript">  
 var ue = UE.getEditor('content');
//UM.getEditor('reply_content',{autoHeightEnabled:true,initialFrameWidth:750,initialFrameHeight:80});
</script>  
</body>
</html>