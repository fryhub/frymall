<?php
$reply = lang('reply_colon');
$realname = lang('realname');
$mobile = lang('mobile');
$content = lang('content');
$submit = lang('submit');
$akmall_root = C('akmall_ROOT');

$akmallComment = <<<EOF
<style>
.recom_list{margin-top:1.5em;margin:12px;border:0;}
.recom_list dt{background:none;display:inline-block;width:100%;border-top:1px solid #eaeaea;padding-top:10px;}
.recom_list dd{margin-bottom:1em;padding-bottom:10px;padding-left:0;margin-left:0;}
.recom_list .fr{float:right}
.recom_list .king {display: inline-block; white-space: nowrap; width: 20px; overflow: hidden;}
.recom_list .reply{border:1px solid #eed3d7;background:#fbeedf;padding:5px;margin-top:10px;color:#D00;border-radius:2px;}
.recom_list img{float:left;max-width:35%;height:40px;margin-right:10px}
.comment-frame{padding:10px;10px;position:relative;clear: both;}
.comment-frame .akmall-rows{padding-right:15px;}
.comment-frame .rows-head b{color:#f00;}
.comment-frame .rows-params{margin-left:0}

#akmallComment .akmall-request{float:none;}
</style>
<div  class="box-content">
	<div class="recom_list" id="comments"></div>
	<div><a href="javascript:;" id="commentsAjax" class="akmall-btn" data-page="0">点击加载更多(<b></b>)条评论</a></div>
	
	<div class="comment-frame akmall-theme-thin">
		<form action="{$akmall_root}index.php?m=Order&a=comment" method="post" id="akmallComment">

		<div class="akmall-rows">
			<label class="rows-head">{$realname}<span class="akmall-request">*</span></label>
			<div class="rows-params"><input type="text" name="name" id="commentName" class="akmall-input-text" placeholder="{$realname}"></div>
		</div>
		<div class="akmall-rows">
			<label class="rows-head">{$mobile}<span class="akmall-request">*</span></label>
			<div class="rows-params"><input type="text" name="mobile" id="commentMobile" class="akmall-input-text" placeholder="{$mobile}"></div>
		</div>
		<div class="akmall-rows">
			<label class="rows-head">{$content}<span class="akmall-request">*</span></label>
			<div class="rows-params rows-params-content"><textarea name="content" id="commentContent" class="akmall-input-text" style="height:60px !important;border:1px solid #eaeaea;" cols="4"  placeholder="{$content}"></textarea></div>
		</div>
		<div class="akmall-rows akmall-id-btn clearfix">
			<div class="rows-params"><input type="submit" class="akmall-btn akmall-submit" value="{$submit}"></div>
			<input type="hidden" name="item_id" value="{$info['id']}">
		</div>
		</form>
	</div>


</div>


<script id="akmall-query" type="text/html">
<dl>
    {{each list as value i}}
		<dt><span class="fr"><span class="akmall-badge fr">{{value.region}}</span><br />{{value.add_time}}</span>
		<span class='avatar'><span class='king'>{{value.name}}</span><img src='Public/akmall/king.svg' /></span>
		{{value.name}}
		<span class="{{value.start}}"></span></dt>	
		<dd>
			{{#value.content}}
			{{if value.reply_content}}<div class="reply">{{#value.reply_content}}</div>{{/if}}
		</dd>
    {{/each}}
</dl>
</script>
</script>
<script type="text/javascript">
seajs.use(['jquery','art/template','jquery/form'],function($,template){
	$('#commentsAjax').click(function(){ comments(5); })
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
});

</script>
EOF;
return $akmallComment;
?>