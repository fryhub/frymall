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
		<form method="post" action="<?php echo U('Item/template');?>" id="ajaxform" enctype="multipart/form-data">
		<table class="info-table">
			<tbody>
				<tr>
					<th><b class="verifing">*</b>表单风格：</th>
					<td>
						<select name="theme">
							<?php $template = C('akmall_TEMPLATE'); ?>
							<?php if(is_array($template)): $i = 0; $__LIST__ = $template;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if(($temp["theme"]) == $key): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						
						<select name="template" onchange="changeTheme('akmall/'+this.value)">
							<option value="">请选择模板</option>
							<?php if(!empty($custom)): if(is_array($custom)): $i = 0; $__LIST__ = $custom;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($temp["template"]) == $vo["id"]): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</optgroup><?php endif; ?>
						</select>
						
						<span style="margin-left:60px;">模板宽度：<input type="text" class="ui-text" name="width" size="6" value="<?php if(empty($temp["width"])): ?>750px<?php else: echo ($temp["width"]); endif; ?>"></span>
						<span class="ui-validityshower-info">（单位px或%）</span>
						<span style="margin-left:60px;">边距宽度：<input type="text" class="ui-text" name="padding" size="6" value="<?php if(empty($extend["padding"])): ?>0<?php else: echo ($extend["padding"]); endif; ?>"></span>
						<span class="ui-validityshower-info">（单位px）</span>
					</td>
				</tr>
				<tr>
					<?php $color = json_decode($temp['color'],true); ?>
					<th><b class="verifing">*</b><?php echo lang('模板颜色_colon');?></th>
					<td class="colors">
						<?php if(is_array($deaultColor)): $i = 0; $__LIST__ = $deaultColor;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><label class="ui-group-label"><?php echo (lang($key)); ?><input type="text" id="color_<?php echo ($key); ?>" name="color[<?php echo ($key); ?>]" size="3" class="jscolor" value="<?php if(empty($color)): ?>#<?php echo ($value); else: echo ($color[$key]); endif; ?>"></label><?php endforeach; endif; else: echo "" ;endif; ?>
						<button type="button"class="ui-button" onclick="resetColor()" />重置</button>	
					</td>
				</tr>
				<tr>
					<th><b class="verifing">*</b><?php echo lang('表单选项_colon');?></th>
					<td>
						<?php if(is_array($options)): $i = 0; $__LIST__ = $options;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label><input name="options[]" type="checkbox" value="<?php echo ($key); ?>" <?php if(!empty($vo["checked"])): ?>checked<?php endif; ?>><?php echo ($vo["name"]); ?></label>&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
					</td>
				</tr>
				<!-- <tr>
					<th>滚动信息</th>
					<td>
						<select name="show_notice">
							<?php echo status($temp['show_notice'],'select','0:不显示;1:下方显示;2:右侧显示','show_notice');?>
						</select>

					</td>
				</tr> -->
				
				<tr>
					<th>底部导航内容<br><a href="javascript:;" onclick="showExample()">查看示例</a></th>
					<td>
						<p class="bottom_nav_list-1"><input type="text" class="ui-text"  size="100" name="bottom_nav_list[1]" value="<?php echo ($extend['bottom_nav_list'][1]); ?>" ></p>
						<p class="bottom_nav_list-2"><input type="text" class="ui-text"  size="100" name="bottom_nav_list[2]" value="<?php echo ($extend['bottom_nav_list'][2]); ?>" ></p>
						<p class="bottom_nav_list-3"><input type="text" class="ui-text"  size="100" name="bottom_nav_list[3]" value="<?php echo ($extend['bottom_nav_list'][3]); ?>" ></p>
					</td>
				</tr>
				<tr>
					<th>说明信息</th>
					<td>
						<!--input type="button" value="插入html" onclick="insertHtml()" class="ui-button" />&nbsp;&nbsp;此信息将会显示在表单链接上面-->
						<textarea name="info" id="content" class="input-textarea editor" cols="80" rows="2"  style="width:100%;"><?php echo ($temp["info"]); ?></textarea>
					</td>
				</tr>
				
				<!--tr>
					<th>调用代码</th>
					<td>
						<textarea name="using" id="using" class="input-textarea" cols="80" rows="3"  style="width:95%;"><iframe id="akmallIframe" name="akmallIframe" src="<?php echo ($url["order"]); ?>" width="100%" height="100%" scrolling="no" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0"></iframe></textarea>
					</td>
				</tr-->
				<tr>
					<th>返回页面</th>
					<td>
						<input name="redirect_uri" class="ui-text" size="50" id="redirect_uri" type="text" value="<?php echo ($temp["redirect_uri"]); ?>" >
						<span class="ui-validityshower-info">（下单成功后点击返回页面）</span>
					</td>
				</tr>
				<tr>
					<th>模板调用</th>
					<td>
						<input type="submit"class="btn btn-ok" value="保存设置" />
						<a class="url btn" href="<?php echo ($url["order"]); ?>" id="tpl1" target="_blank">表单预览</a>
						<a class="url-detail btn" href="<?php echo ($url["detail"]); ?>" id="tpl2" target="_blank">文案预览</a>
						<a class="url-detail btn" href="<?php echo ($url["buildHtml"]); ?>" id="tpl2" target="_blank">静态生成</a>
					</td>
				</tr>
				<tr style="display:none;">
					<th>&nbsp;</th>
					<td>
						<input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>" />
						<input type="hidden" name="user_id" value="<?php echo ($_SESSION["user"]["id"]); ?>" />
					</td>
				</tr>
			</tbody>
		</table>
		</form>
    </div><!--.box-->
<script type="text/javascript">
$(function(){
    $('#ajaxform').ajaxForm({
        success:function(data){ 
			color = data.data;
			parent.$.alert('保存成功',1);
		},
        dataType: 'json'
    });
	bottomNav();
});
function bottomNav(){
	var nav = $("input[name=bottom_nav]:checked").val();
	console.log(nav);
}
function resetColor(color){ 
	var color = color?color:<?php echo (json_encode($deaultColor)); ?>;
	for(var key in color){ 
		var fontColor = key=='body_bg' || key=='form_bg'?'#000000':'#FFFFFF';
		$('#color_'+key).val(color[key]).css({"background-color":'#'+color[key],'color':fontColor});
	}
}

function changeTheme(theme){
	$.getJSON("?m=Item&a=getCustomColor&tpl="+theme, function(color) {
		resetColor(color.data);
	});
}
</script>   

<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Assets/js/ueditor-1.4.3/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Assets/js/ueditor-1.4.3/ueditor.all.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Assets/js/ueditor-1.4.3/lang/zh-cn/zh-cn.js"></script>


<script type="text/javascript">
 function setContent(contents,msg) {
     var arr = [];
     UE.getEditor('content').setContent(contents, true);
     $.alert(msg?msg:'添加成功',1);
 }
 function insertHtml() {
     var value = prompt('插入html代码', '');
     UE.getEditor('content').execCommand('insertHtml', value)
 }
 UE.plugins["akmallPlugin"] = function() {
     var me = this, editor = this;
     var utils = baidu.editor.utils,
             Popup = baidu.editor.ui.Popup,
             Stateful = baidu.editor.ui.Stateful,
             uiUtils = baidu.editor.ui.uiUtils,
             UIBase = baidu.editor.ui.UIBase;
     var domUtils = baidu.editor.dom.domUtils;

     var clickPop = new baidu.editor.ui.Popup({
         content: "",
         editor: me,
         _remove: function() {
             $(clickPop.anchorEl).remove();
             clickPop.hide();
         },
         _blank: function() {
             $('<p><br/></p>').insertAfter(clickPop.anchorEl);
             clickPop.hide();
         },
         className: 'edui-bubble'
     });

     me.addListener("click",
         function(t, evt) {
             evt = evt || window.event;
             var el = evt.target || evt.srcElement;
             if (el.tagName == "IMG") {  return; }
             if ($(el).parents('.akmall-editor').size() > 0) {
                 el = $(el).parents('.akmall-editor:first').get(0);

                 current_active_ueitem = $(el);
                 clickPop.render();
                 var html = clickPop.formatHtml('<nobr class="akmall-poptools edui-default">模块：' + '<a href="javascript:;" onclick="$$._remove()" stateful>' + '删除</a>' + ' | <a href="javascript:;" onclick="$$._blank()" stateful>' + '其后插入空行</a>' + '</nobr>');
                 var content = clickPop.getDom('content');
                 content.innerHTML = html;
                 clickPop.anchorEl = el;
                 clickPop.showAnchor(clickPop.anchorEl);
             } else {
                 el.style.border="0";
                 if (current_active_ueitem) {  current_active_ueitem = null; }
             }
         });
 };
 var ue = UE.getEditor('content',{
            toolbars:[['fullscreen', 'source', '|', 'template', 'cleardoc',  '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat', 'formatmatch',  'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall',  'fontfamily', 'fontsize', 
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage']]
        });
		
function showExample(){
	top.$.dialog({
		title: '底部导航设置示例',
		content: '<div style="line-height:25px;"><p><?php echo lang('booking');?>||#akmallOrder||CartButton</p>'
				+ '<p>首页||<?php echo C('akmall_ROOT');?>index.php||home</p>'
				+ '<p>客服||http://url||message</p>'
				+ '<p>电话咨询||tel:13888888888||call</p>'
				+ '<p>短信订购||sms:13888888888||sms</p>'
				+ '<p><?php echo lang('query');?>||<?php echo C('akmall_ROOT');?>index.php?m=Order&a=query||query</p>'
				+ '<p>微信咨询||javascript:weixin(wx.name,wx.img);||weixin </p>'
				+ '<p>QQ 咨询||http://wpa.qq.com/msgrd?v=3&site=qq&menu=yes&uin=QQ号||qq </p>'
				+ '<p>其它链接||http://123456/</p>'
				+ '<p>支持链接Facebook、Messenger、Line、WhatsApp、TG等<a href="http://doc.akmall.cc" target=_blank>帮助</a></p></div>',
		lock: true,
		fixed: true,
		cancelValue: '关闭',
		cancel: function () {}
	});
}		
</script>

</body>
</html>