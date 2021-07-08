<?php
/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 */
require 'akmallApi.php';
if(empty($_POST))exit;
$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://'; 
$host = $http_type.$_SERVER['HTTP_HOST'].substr(dirname($_SERVER['SCRIPT_NAME']), 0,-3);
echo http( $host.'index.php?m=Order&a=akmallBooking', 'POST',$_POST);
?>