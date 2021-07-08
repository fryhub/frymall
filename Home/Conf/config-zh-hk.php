<?php
return array(
	'SESSION_AUTO_START' =>true,
	'ORDER_STATUS' => array(
		0=>'<i class="statis-0">待審核</i>',
		1=>'<i class="statis-1">處理中</i>',
		2=>'<i class="statis-2">確認</i>',
		3=>'<i class="statis-3">發貨</i>',
		4=>'<i class="statis-4">簽收</i>',
		5=>'<i class="statis-5">拒收</i>',
		6=>'<i class="statis-6">關閉</i>',
		7=>'<i class="statis-7">完結</i>',
		8=>'<i class="statis-8">申請退款</i>',
		9=>'<i class="statis-9">已退款</i>',
		//10=>'<i class="statis-9">關聯單</i>',
	),
	'PAYMENT' => array(
		'payOnDelivery'=>array('name'=>'貨到付款','info'=>'','classname'=>'payment-cod','math'=>'+0'),
	), 
	'TEMPLATE_OPTIONS'=>array(
		'product'=>array('name'=>'價格套餐','request'=>false, 'checked'=>true),
		'extends'=>array('name'=>'產品屬性','request'=>false, 'checked'=>true),
		
		'quantity'=>array('name'=>'訂購數量','request'=>true,'checked'=>true),
		'salenum'=>array('name'=>'已售數量','request'=>false,'checked'=>false),
		'price'=>array('name'=>'訂單價格','request'=>false, 'checked'=>true),
		'coupon'=>array('name'=>'優惠券','request'=>false,'info'=>'','checked'=>true),
		'payment'=>array('name'=>'支付方式','request'=>true, 'checked'=>true),		
		'name'=>array('name'=>'您的姓名','request'=>true,'info'=>'','checked'=>true),
		'mobile'=>array('name'=>'手機號碼','request'=>true,'info'=>'','checked'=>true),
		
		'phone'=>array('name'=>'聯繫電話','request'=>false,'info'=>'','checked'=>true),
		'region'=>array('name'=>'選擇地區','request'=>true,'checked'=>true),
		'address'=>array('name'=>'詳細地址','request'=>true,'info'=>'','checked'=>true),
		'zcode'=>array('name'=>'郵政編碼','request'=>false,'info'=>'','checked'=>false),
		'datetime'=>array('name'=>'選擇時間','request'=>false,'info'=>'', 'checked'=>true),
		'weixin'=>array('name'=>'微信賬號','request'=>false,'info'=>'','checked'=>false),
		'qq'=>array('name'=>'LINE','request'=>false,'info'=>'','checked'=>false),
		'mail'=>array('name'=>'電子郵箱','request'=>false,'info'=>'','checked'=>false),
		'file'=>array('name'=>'上傳圖片','request'=>false,'info'=>'','checked'=>false),
		'remark'=>array('name'=>'留言備註','request'=>false,'info'=>'','checked'=>true),
		'verify'=>array('name'=>'圖片驗證','request'=>true,'info'=>'','checked'=>true),
		'code'=>array('name'=>'簡訊驗證','request'=>true,'info'=>'','checked'=>true),
		
		
	),
	
);

?>
