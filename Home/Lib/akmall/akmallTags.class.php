<?php
/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 */

class akmallTags {
	
	public static function akmall($item){
		preg_match_all("/(\{\[(akmall([\w\d\-]+))\]\})/",$item['content'],$matches);
		if(!in_array('akmallWeixin',$matches[2])){
			array_push($matches[2],'akmallWeixin');
		}
		if(!empty($matches[2])){
			foreach($matches[2] as $tags){
				$tag = explode('-',$tags);
				$action = $tag[0];
				if(method_exists('akmallTags',$action)){
					$argv = isset($tag[1])?$tag[1]:'';
					$item['content'] = self::$action($item,$argv);
				}	
			}
			
		}
		return $item;
	}
	
	
	//订单标签
	private function akmallOrder(&$item,$num){
		return str_replace('{[akmallOrder]}',R('Widgets/form',array('request'=>$_GET)),$item['content']);
	}
	
	//评论标签
	private function akmallComment(&$item,$num){
		return str_replace('{[akmallComment-'.$num.']}',R('Widgets/comment',array('request'=>$_GET,'num'=>$num)),$item['content']);
	}
	
	//滚动标签
	private function akmallScroll(&$item,$num){
		return str_replace('{[akmallScroll-'.$num.']}',R('Widgets/scroll',array('request'=>$_GET,'num'=>$num)),$item['content']);
	}
	
	//微信客服标签
	private function akmallWeixin(&$item,$num){
		
		$weixin = explode(';',$item['weixin']);
		if(!empty($weixin)){
			$index = array_rand($weixin);
			$arr = explode('|',$weixin[$index]);
			$wx = array('name'=>$arr[0],'img'=>isset($arr[1])?$arr[1]:'');
		}else{
			$wx = array('name'=>'','img'=>'');
		}
		$item['weixin'] = $wx;
		return str_replace('{[akmallWeixin]}',$wx['name'],$item['content']);
	}
	

}
?>