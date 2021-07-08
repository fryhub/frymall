<?php
/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 */


@ini_set( "display_errors","Off" );
//ob_start('ob_gzhandler');
define('APP_DEBUG',true);//调式模式
define( 'RUNTIME_PATH' , './Public/Cache/Home/' );
define( 'COMMON_PATH' , './Public/Common/' );
define('AKMALL_VERSION','V5.8.12');
define('APP_NAME','Home');
define('APP_PATH','./Home/');
require 'Public/ThinkPHP/ThinkPHP.php';
?>