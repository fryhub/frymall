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
		'payOnDelivery'=>array('name'=>'Cash On Delivery','info'=>'','classname'=>'payment-cod','math'=>'+0'),
		
	), 
	'TEMPLATE_OPTIONS'=>array(
		'product'=>array('name'=>'Price package','request'=>false, 'checked'=>true),
		'extends'=>array('name'=>'Product properties','request'=>false, 'checked'=>true),
	
		'quantity'=>array('name'=>'Quantity','request'=>true,'checked'=>true),
		'salenum'=>array('name'=>'saleNum','request'=>false,'checked'=>false),
		'price'=>array('name'=>'Price','request'=>false, 'checked'=>true),
		'coupon'=>array('name'=>'Coupon','request'=>false,'info'=>'','checked'=>true),
		'payment'=>array('name'=>'Payment','request'=>true, 'checked'=>true),
		'name'=>array('name'=>'Name','request'=>true,'info'=>'Enter your name','checked'=>true),
		'mobile'=>array('name'=>'Mobile','request'=>true,'info'=>'Enter your mobile phone','checked'=>true),
		'phone'=>array('name'=>'Phone','request'=>false,'info'=>'Enter your contact number','checked'=>true),
		'region'=>array('name'=>'Region','request'=>true,'checked'=>true),
		'address'=>array('name'=>'Address','request'=>true,'info'=>'Please fill in your detailed address','checked'=>true),
		'zcode'=>array('name'=>'Zcode','request'=>true,'info'=>'If you don&#39;t know, please fill in 0000','checked'=>false),
		'datetime'=>array('name'=>'Datetime','request'=>false,'info'=>'Please select a time', 'checked'=>true),
		'weixin'=>array('name'=>'Weixin','request'=>false,'info'=>'','checked'=>false),
		'qq'=>array('name'=>'LINE','request'=>false,'info'=>'Line','checked'=>false),
		'mail'=>array('name'=>'Email','request'=>false,'info'=>'Please fill in your email','checked'=>false),
		'file'=>array('name'=>'Upload Image','request'=>false,'info'=>'','checked'=>false),
		'remark'=>array('name'=>'Remark','request'=>false,'info'=>'If there is additional demand, please leave a message','checked'=>true),
		'verify'=>array('name'=>'Verify','request'=>true,'info'=>'verify','checked'=>true),
		'code'=>array('name'=>'Code','request'=>true,'info'=>'code','checked'=>true),
	),
);
?>