<?php
return array(
	'SESSION_AUTO_START' =>true,
	'ORDER_STATUS' => array(
		0=>'<i class="statis-0">Menunggu ulasan</i>',
		1=>'<i class="statis-1">Lagi Diproses</i>',
		2=>'<i class="statis-2">Konfirmasi</i>',
		3=>'<i class="statis-3">Kirim Barang</i>',
		4=>'<i class="statis-4">Terima Barang</i>',
		5=>'<i class="statis-5">Tolak Terima</i>',
		6=>'<i class="statis-6">Tutup</i>',
		7=>'<i class="statis-7">Selesai</i>',
		8=>'<i class="statis-8">Minta pengembalian uang</i>',
		9=>'<i class="statis-9">Dikembalikan</i>',
	), 
	'PAYMENT' => array(
		'payOnDelivery'=>array('name'=>'Bayar Setelah Sampai','info'=>'','classname'=>'payment-cod','math'=>'+0'),
	), 
	'TEMPLATE_OPTIONS'=>array(
		'product'=>array('name'=>'Paket','request'=>false, 'checked'=>true),
		'extends'=>array('name'=>'Atribut','request'=>false, 'checked'=>true),
		
		'quantity'=>array('name'=>'Quantitas','request'=>true,'checked'=>true),
		'salenum'=>array('name'=>'Quantitas Terjual','request'=>false,'checked'=>false),
		'price'=>array('name'=>'Harga','request'=>false, 'checked'=>true),
		'coupon'=>array('name'=>'Kupon','request'=>false,'info'=>'','checked'=>true),
		'payment'=>array('name'=>'Cara Pembayaran','request'=>true, 'checked'=>true),
		'name'=>array('name'=>'Nama','request'=>true,'info'=>'Tolong Masukkan Nama Anda','checked'=>true),
		'mobile'=>array('name'=>'Ponsel','request'=>true,'info'=>'Masukkan nomor ponsel Anda','checked'=>true),
		'phone'=>array('name'=>'Nomor Telepon','request'=>false,'info'=>'Masukkan Nomor Telepon','checked'=>true),
		'region'=>array('name'=>'Pilih Wilayah','request'=>true,'checked'=>true),
		'address'=>array('name'=>'Alamat Lengkap','request'=>true,'info'=>'Silakan Isi Alamat Lengkap Anda','checked'=>true),
		'zcode'=>array('name'=>'Kode Pos','request'=>false,'info'=>'Jika Anda tidak tahu, silakan isi 0000','checked'=>false),
		'datetime'=>array('name'=>'Pilih Waktu','request'=>false,'info'=>'Silakan Pilih Waktu', 'checked'=>true),
		'weixin'=>array('name'=>'Weixin','request'=>false,'info'=>'','checked'=>false),
		'qq'=>array('name'=>'LINE','request'=>false,'info'=>'Line','checked'=>false),
		'mail'=>array('name'=>'Email','request'=>false,'info'=>'Silakan Isi Email Biasa','checked'=>false),
		'file'=>array('name'=>'Unggah gambar','request'=>false,'info'=>'','checked'=>false),
		'remark'=>array('name'=>'Tinggalkan Pesan','request'=>false,'info'=>'Butuh Sesuatu, Silakan Tinggal Pesan','checked'=>true),
		'verify'=>array('name'=>'Verifisika','request'=>true,'info'=>'Silakan Isi Verifisika','checked'=>true),
		'code'=>array('name'=>'Verifisika Sms','request'=>true,'info'=>'Silakan Isi Verifisika Sms','checked'=>true),
	),
);
?>