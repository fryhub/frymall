<?php
/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 */
class ItemWidget extends Widget 
{
	public function render($data)
	{	
		$list['data'] = $data;
		return $this->renderFile ("index", $list);
	}
}
?>