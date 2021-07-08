<?php
/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 */
require 'akmallApi.php';
payLog($_POST,'gleepay');
echo http( getNotifyUrl('gleepay'), 'POST',$_POST);
?>