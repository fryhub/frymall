<?php
$reply = lang('reply_colon');
$comments = M('Comments')->where(array('item_id'=>$info['id'],'status'=>1))->order('id DESC')->select();
if(empty($comments)){return false;}
$list  = "";
foreach($comments as $i=>$vo){
	$avatar = mb_substr($vo['name'],0,3);
	$class = $i%2==0?'l':'r';
	$name = empty($vo['name'])?'':"<div style='font-size: 16px; font-weight: bold;'>{$vo['name']}<span class='{$vo['start']}'></span><span style='float:right;font-weight:normal;font-size:12px;'>{$vo['add_time']} </span></div>";
	$replaycontent = empty($vo['reply_content'])?'':"<div class='reply' style='color:#f00;'>{$reply}{$vo['reply_content']}</div>";
	$list .= "<li class='{$class}'>
	<div class='text clearfix'>
		<div class='clearfix'>{$name}
			<div style='float:left;'>{$vo['content']}</div>
		</div>{$replaycontent}
	</div>
	<span class='corner'></span><span class='avatar'>{$avatar}</span></li>";
}

$akmallComment = <<<EOF
<div id="akmall-comments"><ul class="list">{$list}</ul></div>	
<script type="text/javascript">
seajs.use(['akmall'],function(akmall){ akmall.scroll('akmall-comments',3000);});
</script>
EOF;
return $akmallComment;
?>