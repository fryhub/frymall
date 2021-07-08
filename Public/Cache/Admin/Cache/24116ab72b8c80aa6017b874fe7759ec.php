<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<link href="__PUBLIC__/Assets/css/esui.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/Assets/css/union.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/Assets/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Assets/js/jquery.form.js"></script>
<script type="text/javascript" src="__PUBLIC__/Assets/js/jscolor.min.js"></script>
<style>
.info-table th, .info-table td{padding:3px 5px;}
</style>
</head>
<body>
<div class="layout-main">    
    <div class="box clear-fix">
		<form method="post" action="<?php echo U('Item/qrcode');?>" id="ajaxform" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
		<input type="hidden" name="user_id" value="<?php echo ($_SESSION["user"]["id"]); ?>" />
		<table class="info-table">
			<tbody>
				
				<tr>
					<td style="width:200px">
						<h2 style="padding-bottom:10px;text-align:center">二维码推广</h2>
						<div style="display:inline-block;padding:2px;border:5px solid #000;" id="qrcode">
							<!--img id="qrcode" width="180" src="<?php echo C('akmall_ROOT');?>Api/qrcode.php?size=8&margin=0&data=<?php echo ($url); ?>"-->
						</div>
					</td>
					<td>
						<style>
						.akmall-text p{margin:3px 0;}
						.akmall-text label{float:left;display:inline-block;width:70px;}
						.akmall-text .ui-text{height:35px;}
						</style>
						<div class="akmall-text" style="text-align:left">
						<p>
							<label><b>域名集合：</b></label>
							<select name="domain" id="domain" class="ui-text">
								<?php if(is_array($domain_set)): $i = 0; $__LIST__ = $domain_set;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo); ?>" ><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</p>
						<p>
							<label><b>链接模式：</b></label>
							<select name="link" id="link" class="ui-text">
								<option value="1">动态链接</option>
								<option value="2">静态链接</option>
								<option value="3">短链接</option>
								<option value="4">单页绑定域名</option>
							</select>
							
							<label style="float:none;margin-left:85px;"><b>推广渠道：</b></label>
							<input name="channel_id" id="channel_id"  class="ui-text">
						</p>
						<p>
							<label><b>推广链接：</b></label>
							<input name="url" id="url" readonly class="ui-text" size="58" type="text" value="<?php echo (urldecode($url[0])); ?>"><a id="url-link" href="<?php echo (urldecode($url[0][1])); ?>" target="_blank">【预览】</a>
						</p>
						<p>
							<label>动态链接：</label>
							<input name="url_1" id="url_1" readonly class="ui-text" size="58" type="text" value="<?php echo (urldecode($url[0][1])); ?>"><a id="url-link" href="<?php echo (urldecode($url[0][1])); ?>" target="_blank">【预览】</a>
						</p>
						<p>
							<label>静态链接：</label>
							<input name="url_2" id="url_2" readonly class="ui-text" size="58" type="text" value="<?php echo (urldecode($url[0][2])); ?>"><a id="url-link" href="<?php echo (urldecode($url[0][2])); ?>" target="_blank">【预览】</a>
						</p>
						<p>
							<label>短链接：</label>
							<input name="url_3" id="url_3" readonly class="ui-text" size="58" type="text" value="<?php echo (urldecode($url[0][3])); ?>"><a id="url-link" href="<?php echo (urldecode($url[0][3])); ?>" target="_blank">【预览】</a>
						</p>
						<p>
							<label>绑定域名：</label>
							<input name="url_4" id="url_4" readonly class="ui-text" size="58" type="text" value="<?php echo (urldecode($url[0][4])); ?>"><a id="url-link" href="<?php echo (urldecode($url[0][4])); ?>" target="_blank">【预览】</a>
						</p>
						<!-- <p>
							<label>form调用：</label>
							<textarea name="using" id="using" class="input-textarea" cols="80" rows="4"  style="width:455px;background:#f4f4f4"><?php echo ($form); ?></textarea>
							<a href="<?php echo ($host); ?>index.php?m=Lite&id=<?php echo ($info["sn"]); ?>&uid=<?php echo ($_SESSION['user']['id']); ?>" target="_blank">【预览】</a>
						</p> -->
						<p>
							<label>iframe调用</label>
							<textarea name="using" id="using" class="input-textarea" cols="80" rows="3"  style="width:455px;background:#f4f4f4"><iframe id="akmallIframe" name="akmallIframe" src="<?php echo ($host); ?>index.php?m=Order&id=<?php echo ($info["sn"]); ?>&uid=<?php echo ($_SESSION['user']['id']); ?>" width="100%" height="100%" scrolling="no" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0"></iframe></textarea>
							<a href="<?php echo ($host); ?>index.php?m=Order&id=<?php echo ($info["sn"]); ?>&uid=<?php echo ($_SESSION['user']['id']); ?>" target="_blank">【预览】</a>
						</p>
		
						
						</div>
					</td>
				</tr>
		
			</tbody>
		</table>
		</form>
    </div><!--.box-->
<script type="text/javascript" src="__PUBLIC__/Assets/js/qrcode.min.js"></script>	
<script type="text/javascript">
$(function(){
    $('#ajaxform').ajaxForm({
        success:function(data){ 
			parent.$.alert('保存成功',1);
		},
        dataType: 'json'
    });
});

function addUser(){
	top.location.href="<?php echo U('User/add');?>";
}
$(function(){
	build();
    $('#link').on('change',function(){ build(); })
    $('#domain').on('change',function(){ build(); })
	$('#channel_id').on('keyup',function(){ build(); })
});

function build(argv){
	var link = $('#link').val();
	var domain = $('#domain').val();
	var acid = $('#channel_id').val();
	
	if(link==1){
		var url = "<?php echo (urldecode($url[1][1])); ?>";
			url = "http://"+domain+url;
		if(acid){ url += "&gzid="+acid; }	
	}else if(link==2){
		var url = "<?php echo (urldecode($url[1][2])); ?>";
			url = "http://"+domain+url;
		if(acid){ url += "&gzid="+acid; }	
	}else if(link==3){
		var url = "<?php echo (urldecode($url[1][3])); ?>";
			url = "http://"+domain+url;
		if(acid){ url += "&gzid="+acid; }	
	}else{
		var url = "<?php echo (urldecode($url[1][4])); ?>";
		if(acid){ url += "?gzid="+acid; }	
		$.get("<?php echo (urldecode($url[1][1])); ?>&buildHtml=H5");
	}
	
	//$('#qrcode').attr('src',"<?php echo C('akmall_ROOT');?>Api/qrcode.php?size=6&margin=0&data="+encodeURIComponent(url));
	$('#qrcode').html('');
	new QRCode(document.getElementById('qrcode'), {text:url,width:200,height:200});

	$('#url').val(url);
	$('#url-link').attr('href',url);
	
		
}

</script>   

</body>
</html>