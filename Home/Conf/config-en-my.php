<?php
return array(
	'SESSION_AUTO_START' =>true,
	'ORDER_STATUS' => array(
		0=>'<i class="statis-0">Pending</i>',
		1=>'<i class="statis-1">Processing</i>',
		2=>'<i class="statis-2">Confirmed</i>',
		3=>'<i class="statis-3">Shipped</i>',
		4=>'<i class="statis-4">Signed</i>',
		5=>'<i class="statis-5">Rejected</i>',
		6=>'<i class="statis-6">Closed</i>',
		7=>'<i class="statis-7">Completed</i>',
		8=>'<i class="statis-8">Request a refund</i>',
		9=>'<i class="statis-9">Refunded</i>',
	), 
	'PAYMENT' => array(
		'payOnDelivery'=>array('name'=>'Cash On Delivery(貨到付款)','info'=>'','classname'=>'payment-cod','math'=>'+0'),
		
	), 
	'TEMPLATE_OPTIONS'=>array(
		'product'=>array('name'=>'Product(套餐)','request'=>false, 'checked'=>true),
		'extends'=>array('name'=>'Product properties(屬性)','request'=>false, 'checked'=>true),
	
		'quantity'=>array('name'=>'Quantity(數量)','request'=>true,'checked'=>true),
		'salenum'=>array('name'=>'saleNum(已售數量)','request'=>false,'checked'=>false),
		'price'=>array('name'=>'Price(價格)','request'=>false, 'checked'=>true),
		'coupon'=>array('name'=>'Coupon(優惠券)','request'=>false,'info'=>'','checked'=>true),
		'payment'=>array('name'=>'Payment(支付方式)','request'=>true, 'checked'=>true),
		'name'=>array('name'=>'Name(您的姓名)','request'=>true,'info'=>'Enter your name','checked'=>true),
		'mobile'=>array('name'=>'Mobile(手機號碼)','request'=>true,'info'=>'Enter your mobile phone','checked'=>true),
		'phone'=>array('name'=>'Phone(住宅電話)','request'=>false,'info'=>'Enter your contact number','checked'=>true),
		'region'=>array('name'=>'Region(選擇地區)','request'=>true,'checked'=>true),
		'address'=>array('name'=>'Address(詳細地址)','request'=>true,'info'=>'Please fill in your detailed address','checked'=>true),
		'zcode'=>array('name'=>'Zcode(郵編)','request'=>true,'info'=>'If you don&#39;t know, please fill in 0000','checked'=>false),
		'datetime'=>array('name'=>'Datetime(選擇時間)','request'=>false,'info'=>'Please select a time', 'checked'=>true),
		'weixin'=>array('name'=>'Weixin','request'=>false,'info'=>'','checked'=>false),
		'qq'=>array('name'=>'LINE','request'=>false,'info'=>'Line','checked'=>false),
		'mail'=>array('name'=>'Email(郵箱)','request'=>false,'info'=>'Please fill in your email','checked'=>false),
		'file'=>array('name'=>'Upload Image','request'=>false,'info'=>'','checked'=>false),
		'remark'=>array('name'=>'Remark(留言備註)','request'=>false,'info'=>'If there is additional demand, please leave a message','checked'=>true),
		'verify'=>array('name'=>'Verify(手機驗證)','request'=>true,'info'=>'verify','checked'=>true),
		'code'=>array('name'=>'Code(驗證碼)','request'=>true,'info'=>'code','checked'=>true),
	),
);
?>