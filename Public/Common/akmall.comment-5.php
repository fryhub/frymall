<?php
$reply = lang('reply_colon');
$realname = lang('realname');
$mobile = lang('mobile');
$content = lang('content');
$submit = lang('submit');
$akmall_root = C('akmall_ROOT');

$comments = M('Comments')->where(array('item_id'=>$info['id'],'status'=>1))->order('id DESC')->select();
if(empty($comments)){return false;}
$list  = "";
foreach($comments as $i=>$vo){
	$name = empty($vo['name'])?'':"<div style='float:left;'>{$vo['name']}：</div>";
	$replaycontent = empty($vo['reply_content'])?'':"<div class='reply' style='color:#f00;'>{$reply}{$vo['reply_content']}</div>";
	//$list .= "<li class='{$class}'><div class='text clearfix'><div class='clearfix'>{$name}<div style='float:left;'>{$vo['content']}</div></div>{$replaycontent}</div><span class='corner'></span><span class='avatar'></span></li>";
	
	$list .= "<li><div class='user_infor'><span class='user_name'>{$name}</span><span class='user_id'>({$vo['mobile']})</span><span class='star'>滿意度：<i>★★★★★</i></span></div><div>{$vo['content']}</div></li>";
}


$akmallComment = <<<EOF
<style>
.comments-title{font-size:.6rem;text-align:center;background:#e7e7e7;padding:.5rem;border-bottom:3px solid #fff;margin:.5rem 0}
#akmall-comments{height:350px}
#akmall-comments ul li{list-style:none;font-size:.6rem;padding:.8rem .5rem;border-bottom:1px dashed #ccc;padding:10px}
.akmall-comments .user_infor{font-size:.66rem;margin-bottom:.3rem}
.akmall-comments .user_infor .user_name{color:#f00;margin-left:0}
.akmall-comments .user_infor .user_name{color:#f00;margin-left:0}
.akmall-comments .user_infor span{margin:0 .2rem}
.akmall-comments .star{color:#f00}
</style>
<h1 class="comments-title" id="akmall-comments">最新評價</h1>
<div class="akmall-comments">
	<ul>{$list} </ul>
</div>
<script type="text/javascript">
seajs.use(['jquery','jquery/marquee'],function($){
	$('#akmall-comments').akmallMarquee({ direction: 'up' });

});
</script>
EOF;
return $akmallComment;
?>