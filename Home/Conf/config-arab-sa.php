<?php
return array(
	'SESSION_AUTO_START' =>true,
	'ORDER_STATUS' => array(
		0=>'<i class="statis-0">في انتظار مراجعة</i>',
		1=>'<i class="statis-1">تحت المعالجة</i>',
		2=>'<i class="statis-2">أؤكد</i>',
		3=>'<i class="statis-3">تسليم</i>',
		4=>'<i class="statis-4">تم التسليم</i>',
		5=>'<i class="statis-5">تم رفضه</i>',
		6=>'<i class="statis-6">مغلق</i>',
		7=>'<i class="statis-7">انتهاء</i>',
		8=>'<i class="statis-8">طلب استرداد</i>',
		9=>'<i class="statis-9">تم الاسترداد</i>',
	), 
	'PAYMENT' => array(
		'payOnDelivery'=>array('name'=>'الدفع عند الإستلام الشجن مجانا(Cash on delivery)','info'=>'','classname'=>'payment-cod','math'=>'+0'),
	), 
	'TEMPLATE_OPTIONS'=>array(
		'product'=>array('name'=>'خيارات المنتج(Package Pric)','request'=>false, 'checked'=>true),
		'extends'=>array('name'=>'خصائص المنتج(product properties)','request'=>false, 'checked'=>true),
	
		'quantity'=>array('name'=>'كمية(Quantity)','request'=>true,'checked'=>true),
		'salenum'=>array('name'=>'الكمية المباعة (Sold quantity)','request'=>false,'checked'=>false),
		'price'=>array('name'=>'سعر الطلبية (Price of order)','request'=>false, 'checked'=>true),
		'coupon'=>array('name'=>'coupon','request'=>false,'info'=>'','checked'=>true),
		'payment'=>array('name'=>'طريقة الدفع (Payment method)','request'=>true, 'checked'=>true),
		'name'=>array('name'=>'إسم كامل(Full Name)','request'=>true,'info'=>'الإسم الكامل','checked'=>true),
		'mobile'=>array('name'=>'رقم الهاتف(Phone Number)','request'=>true,'info'=>'e.g. 05XXXXXXXX','checked'=>true),
		'phone'=>array('name'=>'رقم الجوال البديل(Alternative mobile number)','request'=>false,'info'=>'e.g. 05XXXXXXXX','checked'=>true),
		'region'=>array('name'=>'منطقة(Area) ','request'=>true,'checked'=>true),
		'address'=>array('name'=>'العنوان التفصيلي(Detailed Address)','request'=>true,'info'=>'اسم الشارع اسم الحي و رقم البناء ( لتوصيل طلبك بأسرع وقت ممكن)','checked'=>true),
		'zcode'=>array('name'=>'Zip code','request'=>false,'info'=>'Please fill in the zip code','checked'=>false),
		'datetime'=>array('name'=>'اختر الوقت(selection period)','request'=>true,'info'=>'Please select a time', 'checked'=>true),
		'weixin'=>array('name'=>'Weixin','request'=>true,'info'=>'','checked'=>false),
		'qq'=>array('name'=>'رقم الواتس(whatsapp no)','request'=>false,'info'=>'Line','checked'=>false),
		'mail'=>array('name'=>'Email','request'=>false,'info'=>'Please fill in your email','checked'=>false),
		'file'=>array('name'=>'تحميل صوره(upload image)','request'=>false,'info'=>'','checked'=>false),
		'remark'=>array('name'=>'البنايات القريبة(Nearby buildings)','request'=>false,'info'=>'المسجد القريب منك أو دراسة أو سوق أو مستشفي و غيره من البناء سهل لتوصيل الطلب','checked'=>true),
		'verify'=>array('name'=>'Picture verification','request'=>true,'info'=>'verify','checked'=>true),
		'code'=>array('name'=>'SMS verification','request'=>true,'info'=>'code','checked'=>true),
	),
);
?>