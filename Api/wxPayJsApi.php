<?php
/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 */
require 'akmallApi.php';
$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://'; 
$host = $http_type.$_SERVER['HTTP_HOST'].substr(dirname($_SERVER['SCRIPT_NAME']), 0,-3);
	
$url = $host."index.php?m=Order&a=payWxPayJsApi&code={$_GET['code']}&state={$_GET['state']}";
Header("Location: $url");
?>