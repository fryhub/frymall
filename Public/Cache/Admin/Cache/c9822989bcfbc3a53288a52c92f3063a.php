<?php if (!defined('THINK_PATH')) exit(); echo W("Main",array('module'=>MODULE_NAME,'action'=>ACTION_NAME,'do'=>$_GET['do']));?>
<style>
.sms-send a{display:inline-block;margin:2px -2px;}
.button{margin-left:5px;padding:3px;border-radius:2px;background:#00c3af;color:#fff;border:none;cursor:pointer;font-size:12px;}
.button:hover{opacity:0.8;}
</style>
<div class="layout-main">    
    <div id="breadclumb" class="box">
        <h3><strong><?php echo lang('breadclumb_colon');?></strong><?php echo lang(MODULE_NAME);?><span></span><?php echo lang('order_list');?></h3>
    </div>
    <div id="CooperationMain" class="box clear-fix">   
        <div class="layout-block-header">
            <form action="__SELF__" method="get" id="searchform">
            	<input type="hidden" name="s" value="<?php echo (MODULE_NAME); ?>" />
				<input type="hidden" name="a" value="<?php echo (ACTION_NAME); ?>" />
				<input type="hidden" name="channel_id" value="<?php echo ($_GET['channel_id']); ?>" />
                <label><?php echo lang('order_search_colon');?></label>
				<select name="fields">
					<?php $fields=array('order_no'=>lang('order_number'),'delivery_no'=>lang('delivery_number'),'qudaonum'=>'渠道单号','item_sn'=>lang('item_number'),'item_name'=>lang('item_name'),'item_aliasname'=>'商品别名','name'=>lang('customer_realname'),'mobile'=>lang('customer_mobile'),'address'=>'详细地址','channel_id'=>lang('channel'),'add_ip'=>lang('下单IP'),); ?>
					<?php if(is_array($fields)): $i = 0; $__LIST__ = $fields;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if(($_GET["fields"]) == $key): ?>selected='selected'<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
                <input type="text" name="keyword" value="<?php echo (trim($_GET['keyword'])); ?>" class="ui-text" autocomplete="off" size="40">
                <button type="submit" class="btn btn-ok"><?php echo lang('search');?></button>
				<button type="submit" class="btn" name="akmallExcel"><?php echo lang('export_order');?></button>
				
				<div class="search-list filter clear-fix">
                    <label><?php echo lang('booking_time_colon');?></label>
                    <input type="text" name="time_start" value="<?php echo (trim($_GET['time_start'])); ?>" size="18" class="ui-text Wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});"><?php echo lang('to');?><input type="text" name="time_end" value="<?php echo (trim($_GET['time_end'])); ?>" size="18" class="ui-text Wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
			
					<select name="pageSize">
						<?php $pageSize=array('25','50','100','500'); ?>
						<?php if(is_array($pageSize)): $i = 0; $__LIST__ = $pageSize;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo); ?>" <?php if(($vo) == $_GET['pageSize']): ?>selected<?php endif; ?>>每页显示<?php echo ($vo); ?>条</option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<select name="user_id">
						<?php $users=M('User')->where("status=1")->select(); ?>
						<option value="">选择用户</option>
						<?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $_GET['user_id']): ?>selected<?php endif; ?>><?php echo ($vo["username"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
                </div>
				
				<div class="search-list filter clear-fix">
					<div class="title"><?php echo lang('order_status_colon');?></div>
					<div class="all"><q onclick="searchButtun('#status','')" <?php if(!is_numeric($_GET['status'])): ?>class="select_item"<?php endif; ?>>所有</q></div>
					<div class="division">|</div>
					<div class="scope"><?php if(is_array($status)): $i = 0; $__LIST__ = $status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><q onclick="searchButtun('#status','<?php echo ($key); ?>')" <?php if(is_numeric($_GET['status']) && $_GET['status'] == $key): ?>class="select_item"<?php endif; ?>><?php echo (strip_tags($vo["name"])); ?>(<?php echo ($vo["count"]); ?>)</q><?php endforeach; endif; else: echo "" ;endif; ?></div>
					<input type="hidden" name="status" id="status" value="<?php echo ($_GET["status"]); ?>">
				</div>
			
				<div class="search-list filter clear-fix">
					<div class="title"><?php echo lang('payment_colon');?></div>
					<div class="all"><q onclick="searchButtun('#payment','')" <?php if(empty($_GET['payment'])): ?>class="select_item"<?php endif; ?>>所有</q></div>
					<div class="division">|</div>
					<div class="scope"><?php $_result=C('PAYMENT');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><q onclick="searchButtun('#payment','<?php echo ($key); ?>')" <?php if($_GET['payment'] == $key): ?>class="select_item"<?php endif; ?>><?php echo (strip_tags($vo["name"])); ?></q><?php endforeach; endif; else: echo "" ;endif; ?></div>
					<input type="hidden" name="payment" id="payment" value="<?php echo ($_GET["payment"]); ?>">
				</div>
				
				
            </form>
        </div>
        
		<form action="<?php echo U('Order/deleteAll');?>" method="post" id="deleteform">
        <div class="ui-table">
            <div class="ui-table-body ui-table-body-hover">
                <table cellpadding="0" cellspacing="0" width="100%" >
                    <thead>
                        <tr class="ui-table-head">
                            <th class="ui-table-hcell" width="15"><input type="checkbox" id="check_box" onclick="$.Select.All(this,'id[]');" ></th>
                            <th class="ui-table-hcell" width="85"><?php echo lang('id_/_order_number');?></th>
                            <th class="ui-table-hcell"><?php echo lang('order_info');?></th>
                            <th class="ui-table-hcell" >
								<?php echo lang('customer_info');?>
								<button type="button" class="button" id="getReply">获取回复短信</button>
							</th>
                            <th class="ui-table-hcell" width="60"><?php echo lang('amount_price');?></th>
							<th class="ui-table-hcell" width="80">
								<?php echo lang('status');?>
								<button type="button" class="button" id="uploadExpress" title="批量上传物流单号到TrackingMore。仅上传发货状态，且没有上传过的订单">&nbsp;&uarr;&nbsp;</button>
								<button type="button" class="button" id="updateExpress" title="批量从TrackingMore更新物流信息。批量更新只能抓取30天内上传的订单">&nbsp;&darr;&nbsp;</button>
							</th>
                            <th class="ui-table-hcell" width="80"><?php echo lang('remark');?></th>
                            <th class="ui-table-hcell" width="85"><?php echo lang('time');?></th>
                            <th class="ui-table-hcell" width="100"><?php echo lang('action');?></th>
                        </tr>
                    </thead>
                    <tbody>
						<?php $payment = C('PAYMENT'); ?>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="row-<?php echo ($vo["id"]); ?>">
                            <td>
								<input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" onclick="$.Select.This(this);">
								<p class="sms-send">
									<?php if(empty($vo['sent'][0])): ?><a href="javascript:;" class="send-0" onclick="smsSend('<?php echo ($vo["id"]); ?>',0,0)" title="下单通知未发送"><img src="__PUBLIC__/Assets/img/false.png"></a>
									<?php else: ?>
									<a href="javascript:;" class="send-0" onclick="smsSend('<?php echo ($vo["id"]); ?>',0,1)" title="下单通知已发送"><img src="__PUBLIC__/Assets/img/true.png"></a><?php endif; ?>
									
									<?php if(empty($vo['sent'][1])): ?><a href="javascript:;" class="send-1" onclick="smsSend('<?php echo ($vo["id"]); ?>',1,0)" title="支付通知未发送"><img src="__PUBLIC__/Assets/img/false.png"></a>
									<?php else: ?>
									<a href="javascript:;" class="send-1" onclick="smsSend('<?php echo ($vo["id"]); ?>',1,1)" title="支付通知已发送"><img src="__PUBLIC__/Assets/img/true.png"></a><?php endif; ?>
									
									<?php if(empty($vo['sent'][3])): ?><a href="javascript:;" class="send-3" onclick="smsSend('<?php echo ($vo["id"]); ?>',3,0)" title="发货通知未发送"><img src="__PUBLIC__/Assets/img/false.png"></a>
									<?php else: ?>
									<a href="javascript:;" class="send-3" onclick="smsSend('<?php echo ($vo["id"]); ?>',3,1)" title="发货通知已发送"><img src="__PUBLIC__/Assets/img/true.png"></a><?php endif; ?>
								</p>
							</td>
                            <td>
								<?php if(($vo["num"]) > "1"): ?><a href="<?php echo U('Order/index',array('mobile'=>$vo['mobile']));?>" title="同手机号重复订单" style='display:inline-block;background:#ff9800;padding:1px 8px;font-size:10px;border-radius:4px;color:#fff'><?php echo ($vo["num"]); ?></a><?php endif; ?>
								<!-- 同一个ip的重复订单  -->
								<?php if(($vo["ipnum"]) > "1"): ?><a href="<?php echo U('Order/index',array('add_ip'=>$vo['add_ip']));?>" title="同 IP 重复订单" style='display:inline-block;background:#ff3d00;padding:1px 8px;font-size:10px;border-radius:4px;color:#fff'><?php echo ($vo["ipnum"]); ?></a><?php endif; ?>
								<?php if(($vo["device"]) == "2"): ?>M<?php else: ?> PC<?php endif; ?><br />
								ID:<?php echo ($vo["id"]); ?><br /><?php echo ($vo["order_no"]); ?><br />
							</td>
                            <td> 
								<div style="float:left;">
								<?php if(!empty($vo["item_aliasname"])): ?>【商品别名】<span style='color:#ff9800'><?php echo ($vo["item_aliasname"]); ?></span><?php endif; ?>
								<p>【商品编号】<a href="<?php echo U('Order/index',array('item_id'=>$vo['item_id']));?>"><?php echo ($vo["item_sn"]); ?></a></p>
								<p>【商品名称】<a href="<?php echo ($host); ?>index.php?m=Order&id=<?php echo ($vo["item_sn"]); ?>&uid=<?php echo ($_SESSION['user']['id']); ?>&tpl=detail" target="_blank"><?php echo ($vo["item_name"]); ?></a></p>
								<?php if(!empty($vo["item_params"])): ?><p>【商品套餐】<?php echo ($vo["item_params"]); ?></p><?php endif; ?>
								<?php $item_extends = json_decode($vo['item_extends'],true); if(!empty($item_extends)){ foreach($item_extends as $key=>$val){ $val = is_array($val)?implode('#',$val):$val; echo "<p>【".$key."】$val</p>"; } } ?>
								<?php if(!empty($vo["channel_id"])): ?><p>【推广渠道】<?php echo ($vo["channel_id"]); ?></p><?php endif; ?>
								</div>
							</td>
                            <td>
								<p style='color:#f00'>【用户】<?php echo (getfields("User","username",$vo["user_id"])); ?></p>
								<?php if(!empty($vo["name"])): ?>【姓名】<?php echo ($vo["name"]); ?><br><?php endif; ?>
								<?php if(!empty($vo["mobile"])): ?>【手机】<a href="<?php echo U('Order/index',array('mobile'=>$vo['mobile']));?>"><?php echo ($vo["mobile"]); ?></a><br><?php endif; ?>
								<?php if(!empty($vo["mail"])): ?>【邮箱】<?php echo ($vo["mail"]); ?><br><?php endif; ?>
								<?php if(!empty($vo["address"])): ?>【地址】<?php echo ($vo["region"]); ?> <?php echo ($vo["address"]); ?><br><?php endif; ?>
								<?php if(!empty($vo["zcode"])): ?>【邮编】<?php echo ($vo["zcode"]); ?><br><?php endif; ?>
								<?php if(!empty($vo["weixin"])): ?>【微信】<?php echo ($vo["weixin"]); ?><br><?php endif; ?>
								<?php if(!empty($vo["receive"])): if(is_array($vo["receive"])): $i = 0; $__LIST__ = $vo["receive"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><p style="color:#f00">【<?php echo ($li["receive_time"]); ?> 回复】<?php echo ($li["receive_content"]); ?></p><?php endforeach; endif; else: echo "" ;endif; endif; ?>
							</td>
                            <td><?php echo ($vo["quantity"]); ?>/<b class="alert"><?php echo (floatval($vo["total_price"])); ?></b></td>
                            <td>
								<div style="background-color:#ffe5b6;padding:5px;border: #ffe5b6 solid 1px;">
								<?php echo ($payment[$vo['payment']]['name']); ?>
								<p><?php echo status($vo['status'],'text',C('order_status'));?></p>
								<!--select name="select" class="status-select" data-id="<?php echo ($vo["id"]); ?>" data-status="<?php echo ($vo["status"]); ?>"></select-->
								</div>
								<div style="background-color:#fff9ee;padding:5px;border: #ffe5b6 solid 1px;">
								<?php echo experss($vo['delivery_name'],$vo['delivery_no'],$vo['id'],$vo['order_no']);?>
								<p class="ui-validityshower-info" style="font-size:9px;"><?php echo ($vo['delivery_no']); ?></p>
								<p><?php echo status($vo['delivery_status'],'text',C('delivery_status'));?></p>
								</div>
							</td>
							
                            <td>
								<?php echo $vo['remark']; ?>
							</td>
                            <td><?php echo (date("y-m-d H:i",$vo["add_time"])); ?></td>
                            <td class="action">
                                <a <?php if(in_array('orderModify',$_SESSION['user']['auth'])): ?>href="<?php echo U('Order/'.ACTION_NAME,array('do'=>'modify','id'=>$vo['id'],'status'=>$_GET['status']));?>"<?php else: ?>href="javascript:;" class="grey"<?php endif; ?>>修改</a>|
								<a <?php if(in_array('orderModify',$_SESSION['user']['auth'])): ?>href="javascript:del('<?php echo ($vo["id"]); ?>');"<?php else: ?>href="javascript:;" class="grey"<?php endif; ?>>删除</a>
								
								
								<?php if(!empty($vo["url"])): ?><p style="margin-top:5px;">
										<?php if(is_array($vo["url"])): $i = 0; $__LIST__ = $vo["url"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$url): $mod = ($i % 2 );++$i;?><a href="<?php echo (trim($url)); ?>" target="_blank">采购<?php echo ($i); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
									</p><?php endif; ?>
							</td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
          
        <div class="ui-pager-bar clearfix" style="padding-left:10px;">
			<div class="float-left">
				<input type="hidden" name="model" value="<?php echo (MODULE_NAME); ?>">
				<input type="checkbox" id="check_box" onclick="$.Select.All(this,'id[]');" >选择/反选 
				<!--input type="button" name="del" value="批量删除" class="btn" onclick="delConfirm()"-->
				<input type="hidden" name="del" value="1">
				<input type="button" value="批量操作" class="btn btn-ok" onclick="batch()">
			</div>
			<div class="ui-pager" style="float:right"><?php echo ($page); ?></div>
		</div>
		
		</form>
</div><!--.box-->
<script type="text/javascript" src="__PUBLIC__/Assets/js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
$(function(){
	$('#getReply').on('click',function(){
		$.ajax({
			url:"<?php echo U('Order/getReply');?>",
			type:'get',
			dataType:'json',
			success:function(ret){
				$.alert(ret.info,ret.status,function(){
					if(ret.status=='1')window.location.reload();
				});
			}
		})
	})
	
	$('.status-select').on('change',function(){
		var id = $(this).attr('data-id');
		var status = $(this).val();
		$.ajax({
			url:"<?php echo U('Order/modify');?>",
			type:'post',
			data:{id:id,change_status:status},
			dataType:'json',
			success:function(ret){
				$.alert(ret.info,ret.status,function(){
					//if(ret.status=='1')window.location.reload();
				});
			}
		})
	})
})
function delConfirm(){
	$.confirm('是否要删除？',function(){ 
		$('#deleteform').submit();
	},true);
}
function del(id){
	$.confirm('是否要删除？',function(){ 
		$.ajax({
			url:"<?php echo U('Order/proccess');?>",
			data:{'do':'del','id':id},
			type:'get',
			dataType:'json',
			success:function(ret){
				$.alert(ret.info,ret.status);
				if(ret.status=='1'){ $('#row-'+id).remove(); }
			}
		})
	},true);
}
function smsSend(id,order_status,send_status){
	var msg = send_status==1?'是否重新发送短信通知？':'是否发送短信通知？';
	$.confirm(msg,function(){ 
		$.ajax({
			url:"<?php echo U('Order/smsSend');?>",
			data:{order_id:id,order_status:order_status,send_status:send_status},
			type:'get',
			dataType:'json',
			success:function(ret){
				$.alert(ret.info,ret.status);
			}
		})
	},true);
}
function batch(){
	var id = new Array();
	$('tbody input:checkbox:checked').each(function() {
		id.push($(this).val());
	});
	$.open("<?php echo U('Order/batch');?>&id="+id,{title:'批量操作',width:850,height:400})

}
//订单上传TrackingMore
$(function(){
	$('#uploadExpress').on('click',function(){
		$.ajax({
			url:"<?php echo U('Order/uploadExpress');?>",
			success:function(track){
				$.alert(track.info,track.status,function(){
					window.location.reload();
				});
			}
		})
	})
})
//物流跟踪
$(function(){
	$('#updateExpress').on('click',function(){
		$.ajax({
			url:"<?php echo U('Order/updateExpress');?>",
			success:function(track){
				$.alert(track.info,track.status,function(){
					window.location.reload();
				});
			}
		})
	})
})

function traceExpress(com,num,order_id,order_no){
	var url = "?m=Order&a=traceExpress&com="+com+"&num="+num+"&order_id="+order_id+"&order_no="+order_no;
	$.open(url,{title:'物流跟踪',width:650,height:500})
}
</script>
<?php echo W("Foot");?>