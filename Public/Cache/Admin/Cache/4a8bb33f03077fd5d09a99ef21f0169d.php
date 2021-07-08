<?php if (!defined('THINK_PATH')) exit(); echo W("Main",array('module'=>MODULE_NAME,'action'=>ACTION_NAME,'do'=>$_GET['do']));?>
<script type="text/javascript">
isupload = false;
function akmallUpload(fileInput){
	if(isupload != false){
		$.alert("其他文件正在上传...请稍后");
	}else{
		$(fileInput).click();
	}
}
function uploadImg(fileInput,target){
	var filename = $(fileInput).val();
    if(filename != '' && filename != null){
    	isupload = true;
        var pic = $(fileInput)[0].files[0];
		console.log(pic);
        var fd = new FormData();
        fd.append('imgFile', pic);
        $.ajax({
            url:'<?php echo U("Public/upload");?>',
            type:"post",
            dataType:'json',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status=='1'){
                    $(target).val(data.data);
					$.alert('上传成功',1);
                }else{
					$.alert(data.data,0);
				}
            },
            error:function (){
				$.alert("上传出错了",0);
            }
        });
        isupload = false;
    }
    isupload = false;
}
</script>
<?php if(C('DEFAULT_LANG') != 'zh-cn'): ?><style>.region{display:none;}</style><?php endif; ?>
<div class="layout-main">
    <div id="breadclumb" class="box">
        <h3>
            <strong><?php echo lang('breadclumb_colon');?></strong>
            <?php echo lang(MODULE_NAME);?><span></span>
        </h3>
    </div>
    <div id="CooperationMain" class="box clear-fix">
        <div class="layout-block-header"><h2><?php echo lang('system_setting');?></h2></div>
        <ul class="ui-tab-group">
            <?php if(is_array($setting)): $i = 0; $__LIST__ = $setting;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li id="<?php echo ($key); ?>" <?php if(($i) == "1"): ?>class="active"<?php endif; ?>><q><?php echo (lang($key)); ?></q></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
       
        <?php if(is_array($setting)): $i = 0; $__LIST__ = $setting;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $title = $key; ?>
            <div class="info-block">
                <form method="post" action="__SELF__" enctype="multipart/form-data" class="form-horizontal" id="ajaxform-<?php echo ($key); ?>" autocomplete="off">
                <table class="info-table">
                    <tbody>
                        <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i; if(!empty($k["name"])): ?></td>
							</tr>
							<tr class="<?php echo ($key); ?>">
								<th><?php echo ($k["name"]); ?></th>
								<td>
							<?php else: endif; ?>	
                                <?php echo (setting($k,$key,$value[$key])); ?>
                                <?php if(!empty($k["decription"])): ?><span class="ui-validityshower-info"><?php echo ($k["decription"]); ?></span><?php endif; ?>
                            <?php if(empty($k["name"])): ?><empty name="k.name">
								</td>
							</tr><?php endif; ?>
						
						<?php if(($k["separator"]) == "1"): ?><tr><th colspan=2>&nbsp;</th></tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        <tr>
							<th>&nbsp;</th>
							<td>
								<input type="submit" class="btn btn-ok" value="<?php echo lang('save');?>" />
								<input type="reset" class="btn" value="<?php echo lang('reset');?>" />
								<?php if(($title) == "mail_setting"): ?><input type="button" class="btn" onclick="sendMailTest()" value="邮件测试"><?php endif; ?>
							</td>
						</tr>
                    </tbody>
                </table>
                </form>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
          
    </div><!--.box-->
<script type="text/javascript" src="__PUBLIC__/Assets/js/jscolor.min.js"></script>
<script type="text/javascript">
$(function(){
	$('#CooperationMain').tabs();	
})

$('form').ajaxForm({
	timeout: 5000,
	error:function(){ alert("<?php echo lang('ajaxError');?>");},
	beforeSubmit:function(){ $('#ajaxLoading').show();},
	success:function(data){ 
		$('#ajaxLoading').hide();
		if(data.status==1){
			$.alert(data.info,data.status);
		}else{
			$.alert(data.info,data.status);
		}
	},
	dataType: 'json'
});
function sendMailTest(){
	$.ajax({
		type:'get',
		url:"<?php echo U('Setting/sendMailTest');?>",
		beforeSend:function(){ $('#ajaxLoading').show();},
		success:function(data){ 
			$('#ajaxLoading').hide();
			if(data.status==1){
				$.alert(data.info+'发送成功！',data.status);
			}else{
				$.alert('发送失败！错误代码：<br>'+data.info,data.status);
			}
		},
		dataType: 'json'
	})
}
</script>
<div id="ajaxLoading" style="display:none;"><div class="loading-bar"><img src="__PUBLIC__/Assets/img/waiting.gif">加载中，请稍候...</div></div>

<!-- <script type="text/javascript" charset="utf-8" src="__PUBLIC__/Assets/js/ueditor-1.4.3/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Assets/js/ueditor-1.4.3/ueditor.all.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Assets/js/ueditor-1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
 var ue = UE.getEditor('result_info',{
	toolbars:[['fullscreen', 'source', '|', 'template', 'cleardoc',  '|',
	'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat', 'formatmatch',  'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall',  'fontfamily', 'fontsize', 
	'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
	'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
	'simpleupload', 'insertimage']]
});
</script> -->
<?php echo W("Foot");?>