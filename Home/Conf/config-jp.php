<?php
return array(
	'SESSION_AUTO_START' =>true,
	'ORDER_STATUS' => array(
		0=>'<i class="statis-0">審査待ち</i>',
		1=>'<i class="statis-1">支払い済み</i>',
		2=>'<i class="statis-2">確認</i>',
		3=>'<i class="statis-3">出荷</i>',
		4=>'<i class="statis-4">受領</i>',
		5=>'<i class="statis-5">拒絶</i>',
		6=>'<i class="statis-6">閉じる</i>',
		7=>'<i class="statis-7">完結する</i>',
		8=>'<i class="statis-8">返金の申し込み</i>',
		9=>'<i class="statis-9">払い戻し済み</i>',
		//10=>'<i class="statis-9">關聯單</i>',
	), 
	'PAYMENT' => array(
		'payOnDelivery'=>array('name'=>'着払い','info'=>'','classname'=>'payment-cod','math'=>'+0'),
	), 
	'TEMPLATE_OPTIONS'=>array(
		'product'=>array('name'=>'價格套餐','request'=>false, 'checked'=>true),
		'extends'=>array('name'=>'商品の特徴','request'=>false, 'checked'=>true),
		
		'quantity'=>array('name'=>'注文数量','request'=>true,'checked'=>true),
		'salenum'=>array('name'=>'販売した数量','request'=>false,'checked'=>false),
		'price'=>array('name'=>'受注価格','request'=>false, 'checked'=>true),
		'coupon'=>array('name'=>'クーポン券','request'=>false,'info'=>'','checked'=>true),
		
		'payment'=>array('name'=>'支払い方法','request'=>true, 'checked'=>true),
		'name'=>array('name'=>'本当の名前','request'=>true,'info'=>'貴方の名前或いは呼び方をご入力ください','checked'=>true),
		'mobile'=>array('name'=>'携帯電話番号','request'=>true,'info'=>'貴方の携帯電話番号ご入力ください','checked'=>true),
		'phone'=>array('name'=>'電話番号','request'=>false,'info'=>'貴方の電話番号をご入力ください','checked'=>true),
		'region'=>array('name'=>'地域選択','request'=>true,'checked'=>true),
		'address'=>array('name'=>'詳細の住所','request'=>true,'info'=>'貴方の詳細な住所をご記入ください','checked'=>true),
		'zcode'=>array('name'=>'郵便番号','request'=>false,'info'=>'郵便番号をご記入ください','checked'=>false),
		'datetime'=>array('name'=>'時間選択','request'=>false,'info'=>'時間をご選択ください', 'checked'=>true),
		'qq'=>array('name'=>'QQ 番号','request'=>false,'info'=>'QQ番号をご記入ください','checked'=>false),
		'mail'=>array('name'=>'電子メ-ルアドレス','request'=>false,'info'=>'貴方が常に使用する電子メ-ルアドレスをご記入ください常','checked'=>false),
		'file'=>array('name'=>'画像をアップロード','request'=>false,'info'=>'','checked'=>false),
		'remark'=>array('name'=>'伝言備考','request'=>false,'info'=>'もし特殊な要望が有りましたら、伝言を残してください','checked'=>true),
		'verify'=>array('name'=>'検証コ-ド','request'=>true,'info'=>'検証コ-ドをご記入ください','checked'=>true),
		'code'=>array('name'=>'メセッジ検証コ-ド','request'=>true,'info'=>'メセッジ検証コ-ドをご記入ください','checked'=>true),
	),
);
?>