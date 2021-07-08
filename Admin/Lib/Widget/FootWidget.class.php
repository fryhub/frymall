<?php
/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 */
defined('THINK_PATH') OR exit();
class FootWidget extends Widget{
	public function render($data){
		return $this->renderFile ("index", $data);
	}
}
?>