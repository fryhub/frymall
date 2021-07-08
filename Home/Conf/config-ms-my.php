<?php
return array(
	'SESSION_AUTO_START' =>true,
	'ORDER_STATUS' => array(
		0=>'<i class="statis-0">Menunggu untuk semakan</i>',
		1=>'<i class="statis-1">Sedang Memproses</i>',
		2=>'<i class="statis-2">Kenal Pasti</i>',
		3=>'<i class="statis-3">Barang Dihantar Keluar</i>',
		4=>'<i class="statis-4">Penerimaan Barang</i>',
		5=>'<i class="statis-5">Penolakan Barang</i>',
		6=>'<i class="statis-6">Tutup</i>',
		7=>'<i class="statis-7">Tamat</i>',
		8=>'<i class="statis-8">Minta bayaran balik</i>',
		9=>'<i class="statis-9">Dikembalikan</i>',
	), 
	'PAYMENT' => array(
		'payOnDelivery'=>array('name'=>'Tunai semasa penghantaran(货到付款)','info'=>'','classname'=>'payment-cod','math'=>'+0'),
	),  
	'TEMPLATE_OPTIONS'=>array(
		'product'=>array('name'=>'Pakej(套餐)','request'=>false, 'checked'=>true),
		'extends'=>array('name'=>'Atribut(属性)','request'=>false, 'checked'=>true),

		'quantity'=>array('name'=>'Kuantiti Pesanan(数量)','request'=>true,'checked'=>true),
		'salenum'=>array('name'=>'Kuantiti Yang Dijual(已售数量)','request'=>false,'checked'=>false),
		'price'=>array('name'=>'Harga Pesanan(价格)','request'=>false, 'checked'=>true),
		'coupon'=>array('name'=>'Kupon(优惠券)','request'=>false,'info'=>'','checked'=>true),
		'payment'=>array('name'=>'Cara Pembayaran(支付方式)','request'=>true, 'checked'=>true),
		'name'=>array('name'=>'Nama Sebenar(您的姓名)','request'=>true,'info'=>'Sila Masukkan Nama Atau Nama Samaran Anda','checked'=>true),
		'mobile'=>array('name'=>'Telefon Bimbit(手机号码)','request'=>true,'info'=>'Sila Masukkan Nombor Telefon Bimbit Anda','checked'=>true),
		'phone'=>array('name'=>'Telefon(住宅电话)','request'=>false,'info'=>'Sila Masukkan Nombor Telefon Anda','checked'=>true),
		'region'=>array('name'=>'Pilih Kawasan(选择地区)','request'=>true,'checked'=>true),
		'address'=>array('name'=>'Alamat(详细地址)','request'=>true,'info'=>'Sila Isikan Alamat Teliti Anda','checked'=>true),
		'zcode'=>array('name'=>'Poskod(邮编)','request'=>true,'info'=>'Sekiranya anda tidak tahu, sila isi 0000','checked'=>false),
		'datetime'=>array('name'=>'Pilih Masa(选择时间)','request'=>false,'info'=>'Sila Pilih Masa', 'checked'=>true),
		'weixin'=>array('name'=>'Weixin','request'=>false,'info'=>'','checked'=>false),
		'qq'=>array('name'=>'LINE','request'=>false,'info'=>'','checked'=>false),
		'mail'=>array('name'=>'Alamat Emel(邮箱)','request'=>false,'info'=>'Sila Isikan Alamat Emel','checked'=>false),
		'file'=>array('name'=>'Muat naik imej','request'=>false,'info'=>'','checked'=>false),
		'remark'=>array('name'=>'Perkataan(留言备注)','request'=>false,'info'=>'Sila Tinggalkan Mesej Jika Mempunyai Permintaan Lain','checked'=>true),
		'verify'=>array('name'=>'Kod Pengesahan(手机验证)','request'=>true,'info'=>'Sila Isikan Kod Pengesahan','checked'=>true),
		'code'=>array('name'=>'Kod pengesahan SMS(验证码)','request'=>true,'info'=>'Sila isikan kod pengesahan SMS','checked'=>true),
	),
);
?>