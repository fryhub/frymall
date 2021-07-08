<?php

$config= array(
	'URL_MODEL' => 0,
	'AKMALL_VERSION' => 'V5.8.12',
	'SHOW_PAGE_TRACE'     => false, // 调式跟踪信息
	'TOKEN_ON'=>false,  // 是否开启令牌验证
	'TOKEN_RESET'=>true,  //令牌验证出错后是否重置令牌 默认为true
	'TOKEN_NAME'=>'__hash__',
	'TOKEN_TYPE'=>'md5', 
	'DATA_CACHE_PATH' => './Public/Cache/', 
	'akmall_API'=>'http://123456/',

	'LANG_AUTO_DETECT'=>true,
	'DEFAULT_LANG'=>isset($_COOKIE['akmall_think_language'])?$_COOKIE['akmall_think_language']:'zh-cn',
	'LANG_SWITCH_ON' => true,   // 开启语言包功能
    'LANG_AUTO_DETECT' => false, // 自动侦测语言 开启多语言功能后有效
    'VAR_LANGUAGE' => 'l', // 默认语言切换变量
    'LANG_LIST' => 'zh-cn,zh-tw,zh-hk,jp,en-ae,en-my,en-ph,en-sg,en-us,en-vn,id-id,ms-my,th-th,cam,laos,arab-ae,arab-jor,arab-sa,arab-omn', // 允许切换的语言列表 用逗号分隔
	'WAP_THEME'=>'Item',
	
	'HTML_PATH' => '/Html',
	'HTML_FILE_SUFFIX' => '.html',// 默认静态文件后缀

	'DEFAULT_AJAX_RETURN' => 'json', 
	'TMPL_ACTION_ERROR'   => 'Public/success.html', 
    'TMPL_ACTION_SUCCESS' => 'Public/success.html', 
	'akmall_THEME_ROOT'   => 'Home/Tpl/akmall/',
	'akmall_TEMPLATE'=>array(
		'akmall'=>'宽松表单',
		'akmall2'=>'宽松表单2',
		'thin'=>'紧凑表单',
		'skin'=>'块状表单',
		'taiwan5'=>'台湾5',
		'ugly'=>'老套表单',
	),
	'ORDER_STATUS' => array(
		0=>'<i class="statis-0">待审核</i>',
		1=>'<i class="statis-1">处理中</i>',
		2=>'<i class="statis-2">确认</i>',
		3=>'<i class="statis-3">发货</i>',
		4=>'<i class="statis-4">签收</i>',
		5=>'<i class="statis-5">拒收</i>',
		6=>'<i class="statis-6">关闭</i>',
		7=>'<i class="statis-7">完结</i>',
		8=>'<i class="statis-8">申请退款</i>',
		9=>'<i class="statis-9">已退款</i>',
		//10=>'<i class="statis-9">关联单</i>',
	),
	'DELIVERY_STATUS' => array(
		0=>'<i class="statis-0">查询中</i>',
		1=>'<i class="statis-1">查询不到</i>',
		2=>'<i class="statis-2">运输途中</i>',
		3=>'<i class="statis-3">到达待取</i>',
		4=>'<i class="statis-4">成功签收</i>',
		5=>'<i class="statis-5">投递失败</i>',
		6=>'<i class="statis-6">可能异常</i>',
		7=>'<i class="statis-7">运输过久</i>',
	),
	'PAYMENT' => array(
		'payOnDelivery'=>array('name'=>'货到付款','info'=>'','classname'=>'payment-cod','math'=>'+0'),
		'711'=>array('name'=>'7-11取貨','info'=>'','classname'=>'payment-cod','math'=>'+0'),
		'quanjia'=>array('name'=>'全家取貨','info'=>'','classname'=>'payment-cod','math'=>'+0'),
		/* 'codepay'=>array('name'=>'码支付','info'=>'','classname'=>'payment-codepay','math'=>'*1','type'=>array(1=>'支付宝',2=>'QQ钱包',3=>'微信支付')), */
		'alipay'=>array('name'=>'支付宝','info'=>'','classname'=>'payment-alipay','math'=>'*1'),
		'wxpay'=>array('name'=>'微信支付','info'=>'','classname'=>'payment-wxpay','math'=>'*1'),
											  
		/* 'qrcode'=>array('name'=>'扫码支付','info'=>'','classname'=>'payment-qrcode','math'=>'+0'), */
		'bankpay'=>array('name'=>'银行汇款','info'=>'','classname'=>'payment-bankpay','math'=>'+0'),
		/* 'creditcard'=>array('name'=>'信用卡','info'=>'','classname'=>'payment-creditcard','math'=>'+0'), */
	), 
	'COMMENTS_TEMPLATE' => array(
		1=>'评论模板一',
		2=>'评论模板二',
		3=>'评论模板三（可评）',
	),
	'TEMPLATE_OPTIONS'=>array(
		'product'=>array('name'=>'价格套餐','request'=>false, 'checked'=>true),
		'extends'=>array('name'=>'产品属性','request'=>false, 'checked'=>true),
		
		'quantity'=>array('name'=>'订购数量','request'=>true,'checked'=>true),
		'salenum'=>array('name'=>'已售数量','request'=>false,'checked'=>false),
		'price'=>array('name'=>'订单价格','request'=>false, 'checked'=>true),
		'coupon'=>array('name'=>'优惠券','request'=>false,'info'=>'','checked'=>true),
		
		'payment'=>array('name'=>'支付方式','request'=>true, 'checked'=>true),
		'name'=>array('name'=>'您的姓名','request'=>true,'info'=>'','checked'=>true),
		'mobile'=>array('name'=>'手机号码','request'=>true,'info'=>'','checked'=>true),
		
		'phone'=>array('name'=>'联系电话','request'=>false,'info'=>'','checked'=>true),
		'region'=>array('name'=>'选择地区','request'=>true,'checked'=>true),
		'address'=>array('name'=>'详细地址','request'=>true,'info'=>'','checked'=>true),
		'zcode'=>array('name'=>'邮政编码','request'=>false,'info'=>'','checked'=>false),
		'datetime'=>array('name'=>'选择时间','request'=>false,'info'=>'', 'checked'=>true),
		'weixin'=>array('name'=>'微信账号','request'=>false,'info'=>'','checked'=>false),
		'qq'=>array('name'=>'QQ 号码','request'=>false,'info'=>'','checked'=>false),
		'mail'=>array('name'=>'电子邮箱','request'=>false,'info'=>'','checked'=>false),
		'file'=>array('name'=>'上传图片','request'=>false,'info'=>'','checked'=>false),
		'remark'=>array('name'=>'留言备注','request'=>false,'info'=>'','checked'=>true),
		'verify'=>array('name'=>'图片验证','request'=>true,'info'=>'','checked'=>true),
		'code'=>array('name'=>'短信验证','request'=>true,'info'=>'','checked'=>true),
		
		
	),
	'DEFAULT_OPTIONS'=>array('product','extends','quantity','price','name','mobile','region','address','mail','remark','payment'),
	'DEFAULT_COLOR'=>array(
		'body_bg'=>'F5F5F5','form_bg'=>'FFFFFF','title_bg'=>'FF5555','button_bg'=>'F34242','font'=>'333333','border'=>'666666','nav_bg'=>'F34242'
	),
	'akmall_ROUTE' => true,
	'ROUTE_RULES' => array(
		'Index'=>array(
			'a'=>':a.html',
			'order'=>array('id'=>'id/:id.html',),
			'category'=>array('id'=>'category-:id.html',),
			'article'=>array('id'=>'article-:id.html',),
			'detail'=>array('id'=>'detail-:id.html',),
			'result'=>array('order_no'=>'result/:order_no.html',),
			'pay'=>array('order_no'=>'pay-:order_no.html',),
		),
		'Item'=>array(
			'a'=>'item/:a.html',
			'index'=>array('uid'=>'item/index.html',),
			'category'=>array('id'=>'item/category-:id.html',),
			'order'=>array('id'=>'item/id-:id.html',),
			'detail'=>array('id'=>'item/detail-:id.html',),
		),
		'Wap'=>array(
			'a'=>'wap/:a.html',
			'index'=>array('uid'=>'wap/index.html',),
			'order'=>array('id'=>'wap/id-:id.html',),
			'category'=>array('cid'=>'wap/category-:cid.html',),
		),
		'Order'=>array(
			'index'=>array('id'=>'single/:id.html'),
			'pay'=>array('order_no'=>'Order/id-:order_no.html',),
			'payWxPayJsApi'=>array('order_id'=>'Order/wxpay-:order_id.html',),
			'payWxPayWap'=>array('order_id'=>'Order/payWxPayWap-:order_id.html',),
		),
	),
	
	'ADMIN_AUTH'=>array(
		'itemView'=>'商品查看',
		'itemAdd'=>'商品添加',
		'itemModify'=>'商品编辑',
		'itemCategory'=>'商品分类',
		'itemAuth'=>'商品批量操作',
		'itemComments'=>'商品评论',
		'orderView'=>'订单查看',
		'orderModify'=>'订单修改',
		'orderStatistics'=>'订单统计',
		'article'=>'文章管理',
		'user'=>'会员管理',
		'setting'=>'设置管理',
	),
	'AGENT_AUTH'=>array(
		'itemView'=>'商品查看',
		'itemAdd'=>'商品添加',
		'itemModify'=>'商品编辑',
		'itemCategory'=>'商品分类',
		'itemAuth'=>'商品批量操作',
		'itemComments'=>'商品评论',
		'user'=>'添加组员',
		'import'=>'批量操作',
		'modify'=>'修改订单',
		'orderStatistics'=>'订单统计',
		'down'=>'导出订单',
		'view'=>'组员查看完整订单信息',
	),
	
);

$db = file_exists("./Public/Common/akmall.db.php")?include("akmall.db.php"):array();
$express = include("akmall.express.php");
$setting = include("akmall.setting.php");
$auth = include("akmall.auth.php");
return array_merge($config,$db,$express,$setting,$auth);
?>