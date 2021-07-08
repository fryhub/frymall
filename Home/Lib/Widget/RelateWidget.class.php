<?php
/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 */
class RelateWidget extends Widget 
{
	public function render($request){
		
		
		$akmall = new akmallAction();
		$akmallConfig = $akmall->akmallConfig();
		if($akmallConfig['relate_item_show']){
			$num = $akmallConfig['relate_item_num'];
			
			$list = M('Item')->where("is_delete=0 AND status=1 AND category_id={$request['category_id']} AND id!={$request['id']}")->limit($num)->order('sort_order asc,is_hot desc,id desc')->select();
			if(empty($list)) return false;
			include('Order/Relate.php');
		}else{
			return false;
		}
		
		include('Order/Query.php');
	}
}
?>