<?php
$html = "<style>.akmall-scroll2{height:160px;overflow:hidden;line-height:30px;border-radius: 5px;margin:10px 5px}.akmall-scroll2 li span{margin-right:10px;}</style>";
$html .= "<div class='akmall-scroll2'><div style='padding: 5px;'><ul>";
if($akmallConfig['real_notice']==1){
	$orders = M('Order')->field('item_name,item_params,name,mobile,region,add_time')->where(array('item_id'=>$info['id']))->order('id asc')->limit(25)->select();
	$i=0;
	foreach($orders as $li){
		$region = explode(' ',$li['region']);
		$item_params = empty($li['item_params'])?$li['item_name']:$li['item_params'];
		$i++;
		$html .= "<li ".($i%2 == 0?"class='even'":'')."><span class='akmall-badge'>{$region[0]}</span><span class='akmall-mobile'>".mb_substr($li['name'],0,1,'utf-8')."*[".substr($li['mobile'],0,3)."****".substr($li['mobile'],-4)."]</span><span class='akmall-date'>".date('m-d',$li['add_time'])."</span>{$item_params}</li>";
	}
}else{
	$item = json_decode($info['params'],true);
	$province = explode(',',L('scrollProvince'));
	$name = explode(',',L('scrollName'));
	$mobile = explode(',',L('scrollMobile'));
	$time=  explode(',',L('scrollTime'));
	for($i=0;$i<50;$i++){
		$num = rand(0,3);
		$pro = empty($item)?$info['name']:$item[array_rand($item,1)]['title'];
		$pp = $province[array_rand($province,1)];
		$nn = $name[array_rand($name,1)];
		$mm = $mobile[array_rand($mobile,1)].'****'.randCode(4);
		$rand = array_rand($time);
		$html .= "<li ".($i%2 == 0?"class='even'":'')."><span style='color:#0c3'>[最新订购]</span><span class='akmall-mobile'>{$nn}*({$mm})</span><span class='akmall-date'>{$time[$rand]}订购了</span><span class='akmall-item'>{$pro} <span style='color:#FF0000'>√</span></span></li>";
	}	
}
$html .= "</ul></div></div>";
$html .= "<script>function scollDown(c,b){var a=$(c+' ul li').height();var b=b||2500;setInterval(function(){ $(c+' ul').prepend($(c+' ul li:last').css('height','0px').animate({height:a+'px'},'slow'))},b)}seajs.use(['jquery'],function(a){scollDown('.akmall-scroll2',3000)});</script>";

return $html;
?>

