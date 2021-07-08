<?php
/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 */
//error_reporting(E_ERROR);
require '../Public/ThinkPHP/Extend/Vendor/qrcode/phpqrcode.php';
$data = urldecode($_GET["data"]);
$size = isset($_GET["size"])?intval($_GET["size"]):5;
$margin = isset($_GET["margin"])?intval($_GET["margin"]):4;
QRcode::png($data,false,QR_ECLEVEL_L,$size,$margin);
?>