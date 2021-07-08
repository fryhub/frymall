<?php
$reply = lang('reply_colon');
$akmall_root = C('akmall_ROOT');

$akmallComment = <<<EOF
<style>
em,i{font-style: normal;font-weight: normal;}
#comments li{line-height:2.2rem;border-bottom:1px solid #eaeaea;padding:10px;overflow:hidden;position:relative;}
#comments .omg{border-radius:45px;margin-right:10px;width:2.5rem;height:2.5rem;}
#comments .right{font-size:1rem;float:right;}
#comments .ov{line-height:3rem;margin-bottom:6px;color:#999;}
#comments .con{color:#333;}
</style>
<div id="akmall-comments">						 
<ul class="comment" id="comments"></ul>
<div><a href="javascript:;" id="commentsAjax" class="akmall-btn" data-page="0">点击加载更多(<i></i>)条评论</a></div>
</div>
<script id="akmall-query" type="text/html">
    {{each list as value i}}
        <li>
			<div class="ov">
				<img class="omg" src="__PUBLIC__/akmall/avatar2.png">
				<em>{{value.name}}</em><em class="vip"></em>
				{{if value.region}}<i class="akmall-badge right">{{value.region}}</i>{{/if}}
			</div>
			<div class="con">{{#value.content}}</div>
            {{if value.reply_content}}<div class="reply" style="color:#f00;">{$reply}{{#value.reply_content}}</div>{{/if}}
		</li>
    {{/each}}
</script>
<script type="text/javascript">
seajs.use(['jquery','art/template'],function($,template){
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
				commentsAjax.find('i').html(data.data.leftPage);
				var html = template('akmall-query', data.data);
				$('#comments').append(html);
				if(parseInt(data.data.leftPage)==0){ commentsAjax.hide(); }
		   }
		 });
	}
});
</script>
EOF;
return $akmallComment;
?>