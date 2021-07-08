<?php
return array(
	'SESSION_AUTO_START' =>true,
	'ORDER_STATUS' => array(
		0=>'<i class="statis-0">Chờ xem xét</i>',
		1=>'<i class="statis-1">đang xử lý</i>',
		2=>'<i class="statis-2">xác nhận</i>',
		3=>'<i class="statis-3">phát hàng</i>',
		4=>'<i class="statis-4">kí nhận</i>',
		5=>'<i class="statis-5">từ chối nhận</i>',
		6=>'<i class="statis-6">đóng</i>',
		7=>'<i class="statis-7">hoàn thành</i>',
		8=>'<i class="statis-8">xin hoàn tiền</i>',
		9=>'<i class="statis-9">đã hoàn tiền</i>',
	), 
	'PAYMENT' => array(
		'payOnDelivery'=>array('name'=>'Hàng đến trả tiền','info'=>'','classname'=>'payment-cod','math'=>'+0'),
	), 
	'TEMPLATE_OPTIONS'=>array(
		'product'=>array('name'=>'Giá phần','request'=>false, 'checked'=>true),
		'extends'=>array('name'=>'Thuộc tính sản phẩm','request'=>false, 'checked'=>true),
	
		'quantity'=>array('name'=>'Số lượng mua','request'=>true,'checked'=>true),
		'salenum'=>array('name'=>'số lượng đã bán','request'=>false,'checked'=>false),
		'price'=>array('name'=>'giá đơn hàng','request'=>false, 'checked'=>true),
		'coupon'=>array('name'=>'Phiếu ưu đãi','request'=>false,'info'=>'','checked'=>true),
		'payment'=>array('name'=>'phương thức thanh toán','request'=>true, 'checked'=>true),
		'name'=>array('name'=>'Tên thật','request'=>true,'info'=>'Hãy nhập tên thật hoặc nick của bạn','checked'=>true),
		'mobile'=>array('name'=>'Số di động','request'=>true,'info'=>'Hãy nhập số di động của bạn','checked'=>true),
		'phone'=>array('name'=>'Điện thoại liên hệ','request'=>false,'info'=>'Hãy nhập số điện thoại liên hệ','checked'=>true),
		'region'=>array('name'=>'chọn vùng','request'=>true,'checked'=>true),
		'address'=>array('name'=>'địa chỉ cụ thể','request'=>true,'info'=>'Hãy điền địa chỉ cụ thể của bạn','checked'=>true),
		'zcode'=>array('name'=>'Mã bưu chính','request'=>false,'info'=>'Hãy điền mã bưu chính','checked'=>false),
		'datetime'=>array('name'=>'Chọn thời gian','request'=>true,'info'=>'Hãy chọn thời gian', 'checked'=>true),
		'weixin'=>array('name'=>'Weixin','request'=>true,'info'=>'','checked'=>false),
		'qq'=>array('name'=>'qq','request'=>false,'info'=>'','checked'=>false),
		'mail'=>array('name'=>'gmail','request'=>false,'info'=>'Hãy nhập mail hay dùng của bạn','checked'=>false),
		'file'=>array('name'=>'Tải ảnh lên','request'=>false,'info'=>'','checked'=>false),
		'remark'=>array('name'=>'Lưu ý','request'=>false,'info'=>'Neeuys bạn có yêu cầu khác xin để lại lời nhắn','checked'=>true),
		'verify'=>array('name'=>'mã xác minh','request'=>true,'info'=>'Hãy nhập mã xác minh','checked'=>true),
		'code'=>array('name'=>'mã xác minh qua tin nhắn','request'=>true,'info'=>'Hãy nhập mã xác minh qua tin nhắn','checked'=>true),
	),
);
?>