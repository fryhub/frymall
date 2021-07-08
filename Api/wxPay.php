<?php
/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 */
require 'akmallApi.php';
$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
if($xml ){
	$result = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
	payLog($result,'wxPay');
	http( getNotifyUrl('wxPay',$result['out_trade_no']), 'POST',$result );
}else{
	payLog('empty','wxPay');
}
?>