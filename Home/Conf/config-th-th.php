<?php
return array(
	'SESSION_AUTO_START' =>true,
	'ORDER_STATUS' => array(
		0=>'<i class="statis-0">รอการตรวจสอบ</i>',
		1=>'<i class="statis-1">การประมวลผล</i>',
		2=>'<i class="statis-2">ยืนยัน</i>',
		3=>'<i class="statis-3">การจัดส่งสินค้า</i>',
		4=>'<i class="statis-4">สมบูรณ์</i>',
		5=>'<i class="statis-5">ปฏิเสธ</i>',
		6=>'<i class="statis-6">ใกล้</i>',
		7=>'<i class="statis-7">ปลาย</i>',
		8=>'<i class="statis-8">ขอเงินคืน</i>',
		9=>'<i class="statis-9">คืนเงิน</i>',
		//10=>'<i class="statis-9">關聯單</i>',
	),
	'PAYMENT' => array(
		'payOnDelivery'=>array('name'=>'ชำระเงินปลายทาง','info'=>'','classname'=>'payment-cod','math'=>'+0'),
	), 
	'TEMPLATE_OPTIONS'=>array(
		'product'=>array('name'=>'แพคเกจราคา','request'=>false, 'checked'=>true),
		'extends'=>array('name'=>'คุณสมบัติ','request'=>false, 'checked'=>true),
		
		'quantity'=>array('name'=>'ปริมาณการสั่งซื้อ','request'=>true,'checked'=>true),
		'salenum'=>array('name'=>'ปริมาณการขาย','request'=>false,'checked'=>false),
		'price'=>array('name'=>'ราคาสั่งซื้อ','request'=>false, 'checked'=>true),
		'coupon'=>array('name'=>'คูปอง','request'=>false,'info'=>'','checked'=>true),
		'payment'=>array('name'=>'วิธีการชำระเงิน','request'=>true, 'checked'=>true),
		'name'=>array('name'=>'ชื่อ-สกุล','request'=>true,'info'=>'','checked'=>true),
		'mobile'=>array('name'=>'หมายเลขโทรศัพท์','request'=>true,'info'=>'','checked'=>true),
		
		'phone'=>array('name'=>'เบอร์ติดต่อ','request'=>false,'info'=>'','checked'=>true),
		'region'=>array('name'=>'ภูมิภาค','request'=>true,'checked'=>true),
		'address'=>array('name'=>'ที่อยู่','request'=>true,'info'=>'','checked'=>true),
		'zcode'=>array('name'=>'รหัสไปรษณีย์','request'=>true,'info'=>'','checked'=>false),
		'datetime'=>array('name'=>'เลือกเวลา','request'=>false,'info'=>'', 'checked'=>true),
		'weixin'=>array('name'=>'Weixin','request'=>false,'info'=>'','checked'=>false),
		'qq'=>array('name'=>'LINE','request'=>false,'info'=>'','checked'=>false),
		'mail'=>array('name'=>'Email','request'=>false,'info'=>'','checked'=>false),
		'file'=>array('name'=>'อัพโหลดภาพ','request'=>false,'info'=>'','checked'=>false),
		'remark'=>array('name'=>'ฝากข้อความไว้','request'=>false,'info'=>'','checked'=>true),
		'verify'=>array('name'=>'รหัสยืนยัน','request'=>true,'info'=>'','checked'=>true),
		'code'=>array('name'=>'รหัสยืนยันทาง SMS','request'=>true,'info'=>'','checked'=>true),		
	),
	
);

?>
