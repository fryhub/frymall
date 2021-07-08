<?php
/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 */

$payment = C('PAYMENT');
$order['item_extends'] = json_decode($order['item_extends'],true);
$order['add_time'] = date('Y-m-d H:i:s',$order['add_time']);
foreach($order['item_extends'] as $k=>$v){ 
	$v = is_array($v)?implode('，', $v):$v;
	$item_extends .= "<p>【{$k}】{$v}</p>";
}
$delivery = C('DELIVERY');

$delivery_notification = lang('delivery_notification');
$order_number = lang('order_number');
$item_name = lang('item_name');
$item_package = lang('item_package');
$extends_package = lang('extends_package');
$order_quantity = lang('order_quantity');
$order_totalPrice = lang('order_totalPrice');
$payments = lang('payment');
$express_name = lang('express_name');
$express_number = lang('express_number');


$send_content = M('Item')->where(array('id'=>$order['item_id']))->getField('send_content');
$send_content = $send_content?"<div style='border:1px solid #eed3d7;background-color: #fbeedf;margin:10px 0;padding:10px;color:##c00'>".preg_replace('/\r\n/', '',nl2br($send_content))."</div>":"";

$akmallSendContent = <<<EOF
<h1 style="margin:20px 0;padding:10px 0;font-size:20px;color:#f60;border-bottom:2px solid #ccc;">{$delivery_notification}</h1>
{$send_content}
<div>
	<p>【{$order_number}】{$order['order_no']}</p>
	<p>【{$item_name}】{$order['item_name']}</p>
	<p>【{$item_package}】{$order['item_params']}</p>
	<p>{$item_extends}</p>
	<p>【{$order_quantity}】{$order['quantity']}</p>
	<p>【{$order_totalPrice}】<b style="color:#f60;">{$order['total_price']}元</b></p>
	<p>【{$express_name}】{$delivery[$order['delivery_name']]}</p>
	<p>【{$express_number}】{$order['delivery_no']}</p>
</div>
EOF;
return $akmallSendContent;
?>