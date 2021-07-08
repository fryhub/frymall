<?php
$reply = lang('reply_colon');
$realname = lang('realname');
$mobile = lang('mobile');
$content = lang('content');
$submit = lang('submit');
$akmall_root = C('akmall_ROOT');
$time = date('Y/m/d');

$akmallComment = <<<EOF
<style>
#akmall-comments ul li{margin:0;padding:0;}
.recom_list{margin:12px;border:0}
.recom_list dt{background:none;display:block;padding-bottom:5px;}
.recom_list dd{margin-left:0;margin-bottom:8px;border-bottom:1px solid #ccc;padding-bottom:8px;padding-left:0}
.recom_list .fr{float:right}
.recom_list .reply{border:1px solid #eed3d7;background:#fbeedf;url("http://download.csdn.net/images/commend_reply.png") no-repeat 3px 3px;padding:5px;margin-top:10px;color:#D00;border-radius:2px;}

.comment-frame{padding:10px;10px;height:200px;position:relative;}
.comment-frame .akmall-rows{padding-right:15px;}
.comment-frame .rows-head b{color:#f00;}
.comment-frame .rows-params{margin-left:0}

.comment-title{color:#999;text-indent:0.5em;}
#comments p{line-height:1.5em;}
</style>
<div  class="box-content">

	<div class="recom_list"  id="akmall-comments" style="height:380px">
		<ul id="comments"></ul>
	</div>
	<div><a href="javascript:;" id="commentsAjax" class="akmall-btn" data-page="0">点击加载更多(<b></b>)条评论</a></div>
</div>


<script id="akmall-query" type="text/html">
    {{each list as value i}}
		<li>
		<dt>
			<a href="javascript:;" class="user_name">{{if value.name}}{{value.name}}{{else}}匿名{{/if}}</a><span class="{{value.start}}"></span><span style='float:right;font-weight:normal;font-size:12px;'>{$time} </span>
		</dt>
		<dd>
			{{#value.content}}
			{{if value.title}}<p class="comment-title">{{value.title}}</p>{{/if}}
			{{if value.reply_content}}<div class="reply">{{#value.reply_content}}</div>{{/if}}
		</dd>
		</li>
    {{/each}}
</script>
</script>
<script type="text/javascript">
seajs.use(['jquery','art/template','akmall','jquery/form'],function($,template,akmall){
	
	$('#commentsAjax').click(function(){ comments(20); })
	comments(5);
	function comments(page){
		var item_id = '{$info['id']}',commentsAjax=$('#commentsAjax');
		var currentPage = commentsAjax.attr('data-page');
		$.ajax({
		   type: "POST",
		   url: "{$akmall_root}index.php?m=Order&a=getComments",
		   data: {item_id:item_id,page:page,currentPage:currentPage},
		   dataType: 'json',
		   success: function(data){
				commentsAjax.attr('data-page',data.data.currentPage)
				commentsAjax.find('b').html(data.data.leftPage);
				var html = template('akmall-query', data.data);
				$('#comments').append(html);
				if(parseInt(data.data.leftPage)==0){ commentsAjax.hide(); }
		   }
		 });
	}
	
	$('#akmallComment').ajaxForm({
		cache: true,
		timeout: 500,
		dataType: 'json',
		error:function(){ layer.closeAll(); alert(lang.ajaxError); },
		beforeSubmit:function(){
			layer.closeAll();layer.load();
		},
		success:function(data){
			if(data.status==1){
				$('#commentName').val('');
				$('#commentMobile').val('');
				$('#commentContent').val('');
			}
			layer.closeAll();layer.closeAll();
			layer.msg(data.info);
		}
	});
	
	akmall.scroll('akmall-comments',3000);
});

</script>
EOF;
return $akmallComment;
?>