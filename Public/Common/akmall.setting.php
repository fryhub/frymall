<?php
/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 */

include_once('./config.php');
return array(
	'setting' => array(
		'basic_info' => array(
					
			'title'=> array('name'=>'网站标题','tags'=>'text','options'=>'','decription'=>'','width'=>80,'height'=>0,'separator'=>0,),
			'keywords'=> array('name'=>'网站关键词','tags'=>'text','options'=>'','decription'=>'','width'=>80,'height'=>0,'separator'=>0,),
			'description'=> array('name'=>'网站描述','options'=>'','tags'=>'textarea','decription'=>'','width'=>90,'height'=>3,'separator'=>0,),
			'logo_pc'=> array('name'=>'PC端Logo','tags'=>'file','options'=>'','decription'=>'（宽高为：160X70）','width'=>50,'height'=>0,'separator'=>0,),
			'logo'=> array('name'=>'Wap端Logo','tags'=>'file','options'=>'','decription'=>'（宽高为：160X40）','width'=>50,'height'=>0,'separator'=>0,),
			'head_content'=> array('name'=>'顶部Head','options'=>'','tags'=>'textarea','decription'=>'显示在head标签内，支持html、js代码，可添加第三方数据跟踪和客服系统','width'=>100,'height'=>10,'separator'=>0,),
			'footer'=> array('name'=>'网站底部','options'=>'','tags'=>'textarea','decription'=>'显示在网站最下方，支持html、js代码，可添加第三方数据跟踪和客服系统','width'=>100,'height'=>10,'separator'=>0,),
			'notice'=> array('name'=>'顶部公告','options'=>'','tags'=>'text','decription'=>'','width'=>95,'height'=>2,'separator'=>0,),
			'result_info'=> array('name'=>'提交成功页面底部','options'=>'','tags'=>'textarea','decription'=>'显示在订单提交成功之后的页面，支持html、js代码','width'=>100,'height'=>10,'separator'=>1,),
			'contact_tel'=> array('name'=>'电话号码','options'=>'','tags'=>'text','decription'=>'','width'=>30,'height'=>25,'separator'=>0,),
			'contact_phone'=> array('name'=>'短信号码','options'=>'','tags'=>'text','decription'=>'','width'=>30,'height'=>25,'separator'=>0,),
			'contact_facebook'=> array('name'=>'Facebook Page','options'=>'','tags'=>'text','decription'=>'填写完整链接','width'=>30,'height'=>25,'separator'=>0,),
			'contact_messenger'=> array('name'=>'Messenger','options'=>'','tags'=>'text','decription'=>'填写完整链接','width'=>30,'height'=>25,'separator'=>0,),
			'contact_line'=> array('name'=>'Line','options'=>'','tags'=>'text','decription'=>'填写Line的ID，与下面的URL配合使用','width'=>30,'height'=>25,'separator'=>0,),
			'contact_line_url'=> array('name'=>'Line_url','options'=>'','tags'=>'text','decription'=>'填写Line的URL，与上面的ID配合使用，URL获取方法请看doc.akmall.cc','width'=>30,'height'=>25,'separator'=>0,),
			'contact_whatsapp'=> array('name'=>'WhatsApp','options'=>'','tags'=>'text','decription'=>'例：8615688888888','width'=>30,'height'=>25,'separator'=>0,),
			'contact_qq'=> array('name'=>'联系QQ','options'=>'','tags'=>'text','decription'=>'','width'=>30,'height'=>25,'separator'=>0,),
		),

		'website_setting'=>array(
			'system_status'=> array('name'=>'网站状态','options'=>array('1'=>'运行','2'=>'关闭PC站','3'=>'关闭Wap站','0'=>'关闭整站',),'tags'=>'select','decription'=>'网站关闭后将不显示前台页面，后台可以正常使用','width'=>35,'height'=>0,'separator'=>0,),
			'system_close_info'=> array('name'=>'默认首页','options'=>array('1'=>'运行','0'=>'关闭',),'tags'=>'text','decription'=>'填写【商品编号】则默认该商品为首页，填写网址则跳转，如：http://123456','width'=>35,'height'=>0,'separator'=>0,),
			'html_file'=> array('name'=>'生成静态目录','options'=>'','tags'=>'text','decription'=>'生成静态页面保存的目录，如：Html/','width'=>35,'height'=>0,'separator'=>0,),
			'is_encode'=> array('name'=>'内容加密输出','value'=>'','options'=>array('0'=>'不加密','1'=>'加密'),'tags'=>'select','decription'=>'','width'=>10,'height'=>0,'class'=>'', 'separator'=>0,),
			'URL_MODEL'=> array('name'=>'网站运行模式','options'=>array('0'=>'动态模式','2'=>'伪静态模式'),'tags'=>'select','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'DEFAULT_LANG'=> array('name'=>'语言版本','options'=>array('zh-cn'=>'简体-大陆','zh-tw'=>'繁體-台湾','zh-hk'=>'繁體-香港','jp'=>'日语-日本','en-my'=>'英语(繁中)-马来','ms-my'=>'马来语(简中)-马来','en-sg'=>'英语(简中)-新加坡','en-us'=>'英语-美元','th-th'=>'泰语-泰国','id-id'=>'印尼语','arab-ae'=>'阿语-阿联酋','arab-sa'=>'阿语-沙特','arab-jor'=>'阿语-约旦','arab-omn'=>'阿语-阿曼','en-ae'=>'英语-迪拜','en-ph'=>'英语-菲律宾','vi-vn'=>'越南语','en-vn'=>'英语-越南','en-ken'=>'英语-肯尼亚','en-ind'=>'英语-印度',),'tags'=>'select','decription'=>'前台语言切换，后台依然是简单中文','width'=>35,'height'=>0,'separator'=>0,),
			'region'=> array('name'=>'地区选择','options'=>array('city-picker'=>'中国地区一','region'=>'中国地区二'),'tags'=>'select','decription'=>'非大陆地区不用修改','width'=>35,'height'=>0,'separator'=>0,),
			'theme_color'=> array('name'=>'主题颜色','value'=>'','options'=>'','tags'=>'text','decription'=>'前台主题颜色','width'=>10,'height'=>0,'class'=>' jscolor', 'separator'=>1,),

            'item_quantity'=> array('name'=>'商品库存','value'=>1,'options'=>array('0'=>'不使用','1'=>'下单减库存','2'=>'支付减库存','4'=>'发货减库存',),'tags'=>'select','decription'=>'是否使用商品库存','width'=>35,'height'=>0,'separator'=>0,),
            'show_qrcode'=> array('name'=>'单页显示二维码','value'=>0,'options'=>array('0'=>'关闭','1'=>'显示'),'tags'=>'select','decription'=>'单页右下角的二维码','width'=>35,'height'=>0,'separator'=>0,),
            'shop_links'=> array('name'=>'商城链接','value'=>0,'options'=>array('1'=>'默认','2'=>'链接到单页'),'tags'=>'select','decription'=>'商品跳转链接','width'=>35,'height'=>0,'separator'=>1,),

			
			'system_theme'=> array('name'=>'表单模板','options'=>$config['akmall_TEMPLATE'],'tags'=>'select','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'order_options'=> array('name'=>'表单选项','options'=>array('product'=>'价格套餐','extends'=>'产品属性','price'=>'产品价格','coupon'=>'优惠券','salenum'=>'已售数量','quantity'=>'订购数量','payment'=>'支付方式','datetime'=>'选择时间','name'=>'客户姓名','mobile'=>'客户手机','phone'=>'客户电话','region'=>'地区选择','address'=>'详细地址','zcode'=>'邮政编码','qq'=>'QQ 号码','weixin'=>'微信账号','mail'=>'电子邮箱','file'=>'上传图片','remark'=>'备注留言','verify'=>'验证号码','code'=>'手机验证',),'tags'=>'checkbox','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'show_notice'=> array('name'=>'显示滚动订单','options'=>array('0'=>'不显示','1'=>'下方显示','2'=>'右侧显示',),'tags'=>'radio','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'real_notice'=> array('name'=>'滚动订单信息','options'=>array('0'=>'虚假','1'=>'真实',),'tags'=>'radio','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'record_order'=> array('name'=>'记录客户信息','options'=>array('0'=>'不记录','1'=>'记录'),'tags'=>'radio','decription'=>'记录则客户再次下单时不需填写信息','width'=>35,'height'=>0,'separator'=>0,),
			//'repeat_order'=> array('name'=>'重复订单提交','options'=>array('0'=>'禁止重复提交','1'=>'允许重复提交'),'tags'=>'radio','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'lazyload'=> array('name'=>'图片延迟加载','options'=>array('1'=>'延迟','0'=>'不延迟'),'tags'=>'radio','decription'=>'使用延迟加载可提升网页打开速度','width'=>35,'height'=>0,'separator'=>1,),

            'slider_show'=> array('name'=>'首页幻灯片','value'=>1,'options'=>array('1'=>'显示','0'=>'关闭',),'tags'=>'select','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'slider_num'=> array('name'=>'','value'=>5,'options'=>'','tags'=>'text','decription'=>'条','width'=>5,'height'=>0,'separator'=>0,),
			'item_hot_show'=> array('name'=>'首页新品推荐','value'=>1,'options'=>array('1'=>'显示','0'=>'关闭',),'tags'=>'select','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'item_hot_num'=> array('name'=>'','value'=>5,'options'=>'','tags'=>'text','decription'=>'条','width'=>5,'height'=>0,'separator'=>0,),
			'relate_item_show'=> array('name'=>'相关产品推荐','value'=>1,'options'=>array('1'=>'显示','0'=>'关闭',),'tags'=>'select','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'relate_item_num'=> array('name'=>'','value'=>5,'options'=>'','tags'=>'text','decription'=>'条','width'=>5,'height'=>0,'separator'=>0,),
			'item_category_show'=> array('name'=>'首页分类展示','value'=>1,'options'=>array('1'=>'显示','0'=>'关闭',),'tags'=>'select','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'item_category_num'=> array('name'=>'','value'=>3,'options'=>'','tags'=>'text','decription'=>'条','width'=>5,'height'=>0,'separator'=>0,),
			'item_category_id'=> array('name'=>'首页分类ID','options'=>'','tags'=>'text','decription'=>'多个ID请用英文逗号分隔开，如：1,2,3','width'=>30,'height'=>0,'separator'=>1,),

			'show_header'=> array('name'=>'移动端头部信息','value'=>1,'options'=>array('1'=>'显示','0'=>'关闭',),'tags'=>'select','decription'=>'控制手机版头部','width'=>35,'height'=>0,'separator'=>0,),
			'show_bottom_nav'=> array('name'=>'移动端底部导航','value'=>1,'options'=>array('1'=>'显示','0'=>'关闭',),'tags'=>'select','decription'=>'控制手机版底部导航栏','width'=>35,'height'=>0,'separator'=>1,),
			
			'header_nav'=> array('name'=>'电脑站头部导航','options'=>'','tags'=>'textarea','decription'=>'每行一个，格式：导航名称||链接地址  （可以自定义PC端顶部导航栏，如果不会自定义请勿填写任何内容）','width'=>60,'height'=>4,'separator'=>0,),
			/* 'footer_nav'=> array('name'=>'手机站底部导航','options'=>'','tags'=>'textarea','decription'=>'','width'=>60,'height'=>4,'separator'=>1,), */
			'order_footer_nav'=> array('name'=>'手机站订单页<br>底部导航','options'=>'','tags'=>'textarea','decription'=>'可自定义手机站商品详情页底部导航栏，格式同上','width'=>60,'height'=>4,'separator'=>1,),
			
			'facebook_pixel_id'=> array('name'=>'Facebook像素','options'=>'','tags'=>'text','decription'=>'多个Pixel ID请用英文逗号隔开','width'=>60,'height'=>0,'separator'=>1,),

		),

		'payment_setting' => array(
			'payment_global'=> array('name'=>'全站通用','value'=>1,'options'=>array('1'=>'是','0'=>'否',),'tags'=>'select','decription'=>'非全站通用，可单独对某个产品设置支付方式','width'=>35,'height'=>0,'separator'=>0,),
			'payOnDelivery_status'=> array('name'=>'货到付款','options'=>array('1'=>'启用','0'=>'关闭',),'tags'=>'radio','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'payOnDelivery_discount'=> array('name'=>'到付额外费用','value'=>0,'options'=>'','tags'=>'text','decription'=>'元（选择货到付款需客户补交费用。0则不需要）','width'=>5,'height'=>0,'separator'=>0,),
			'payOnDelivery_discount_info'=> array('name'=>'选择到付时提示','options'=>'','tags'=>'textarea','decription'=>'选择货到付款时的提示文字，这里为空则不提示','width'=>50,'height'=>3,'separator'=>1,),
			
			'711_status'=> array('name'=>'711超商取貨','options'=>array('1'=>'启用','0'=>'关闭',),'tags'=>'radio','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'711_discount'=> array('name'=>'到付额外费用','value'=>0,'options'=>'','tags'=>'text','decription'=>'元（选择时需客户补交费用。0则不需要）','width'=>5,'height'=>0,'separator'=>0,),
			'711_discount_info'=> array('name'=>'选择到付时提示','options'=>'','tags'=>'textarea','decription'=>'选择时的提示文字，这里为空则不提示','width'=>50,'height'=>3,'separator'=>1,),
			
			'quanjia_status'=> array('name'=>'全家','options'=>array('1'=>'启用','0'=>'关闭',),'tags'=>'radio','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'quanjia_discount'=> array('name'=>'到付额外费用','value'=>0,'options'=>'','tags'=>'text','decription'=>'元（选择时需客户补交费用。0则不需要）','width'=>5,'height'=>0,'separator'=>0,),
			'quanjia_discount_info'=> array('name'=>'选择到付时提示','options'=>'','tags'=>'textarea','decription'=>'选择时的提示文字，这里为空则不提示','width'=>50,'height'=>3,'separator'=>1,),
		/*
			'codepay_status'=> array('name'=>'码支付:','options'=>array('1'=>'启用','0'=>'关闭',),'tags'=>'radio','decription'=>'<span style="color:#f60">可以个人二维码收款，直接到账，并且有返回通知。申请地址<a href="https://codepay.fateqq.com/i/34676" target="_blank"><b>【码支付】</b></a></span>','width'=>50,'height'=>0,'separator'=>0,),
			'codepay_type'=> array('name'=>'支付方式','options'=>array('1'=>'支付宝','2'=>'QQ钱包','3'=>'微信支付'),'tags'=>'checkbox','decription'=>'','width'=>50,'height'=>0,'separator'=>0,),
			'codepay_id'=> array('name'=>'码支付ID','options'=>'','tags'=>'text','decription'=>'','width'=>50,'height'=>0,'separator'=>0,),
			'codepay_key'=> array('name'=>'通信密钥','options'=>'','tags'=>'text','decription'=>'','width'=>50,'height'=>0,'separator'=>0,),
			'codepay_token'=> array('name'=>'token','options'=>'','tags'=>'text','decription'=>'','width'=>50,'height'=>0,'separator'=>0,),
			'codepay_discount'=> array('name'=>'享受折扣','options'=>'','tags'=>'text','decription'=>'0.85为85折，1不打折','width'=>5,'height'=>0,'separator'=>0,),
			'codepay_discount_info'=> array('name'=>'选择时提示','options'=>'','tags'=>'textarea','decription'=>'为空则不提示','width'=>50,'height'=>3,'separator'=>1,),
		*/	
			'bankpay_status'=> array('name'=>'银行转账','options'=>array('1'=>'启用','0'=>'关闭',),'tags'=>'radio','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'bankpay_discount'=> array('name'=>'享受折扣','value'=>0,'options'=>'','tags'=>'text','decription'=>'元（选择银行转账需客户补交费用。0则不需要，负数则减免）','width'=>5,'height'=>0,'separator'=>0,),
			'bankpay_discount_info'=> array('name'=>'选择转账时提示','options'=>'','tags'=>'textarea','decription'=>'','width'=>50,'height'=>3,'separator'=>1,),
		/*	
			'creditcard_status'=> array('name'=>'信用卡','options'=>array('1'=>'启用','0'=>'关闭',),'tags'=>'radio','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'creditcard_mid'=> array('name'=>'mid','value'=>0,'options'=>'','tags'=>'text','decription'=>'','width'=>5,'height'=>0,'separator'=>0,),
			'creditcard_gateway'=> array('name'=>'gateway','value'=>0,'options'=>'','tags'=>'text','decription'=>'','width'=>5,'height'=>0,'separator'=>0,),
			'creditcard_key'=> array('name'=>'key','value'=>0,'options'=>'','tags'=>'text','decription'=>'','width'=>5,'height'=>0,'separator'=>0,),
			'creditcard_url'=> array('name'=>'url','value'=>0,'options'=>'','tags'=>'text','decription'=>'','width'=>5,'height'=>0,'separator'=>0,),
			'creditcard_discount'=> array('name'=>'享受折扣','value'=>0,'options'=>'','tags'=>'text','decription'=>'元（选择银行转账需客户补交费用。0则不需要，负数则减免）','width'=>5,'height'=>0,'separator'=>0,),
			'creditcard_discount_info'=> array('name'=>'选择转账时提示','options'=>'','tags'=>'textarea','decription'=>'','width'=>50,'height'=>3,'separator'=>1,),
		*/	
			'alipay_status'=> array('name'=>'支付宝','options'=>array('1'=>'启用','0'=>'关闭',),'tags'=>'radio','decription'=>'开通支付宝即时到账请到<a href="https://b.alipay.com/order/productIndex.htm" target="_blank">支付宝</a>官网申请','width'=>50,'height'=>0,'separator'=>0,),
			'alipay_type'=> array('name'=>'支付宝类型','options'=>array('1'=>'即时到账（网页版）','2'=>'手机网站支付'),'tags'=>'checkbox','decription'=>'申请即时到账需要有企业资质','width'=>50,'height'=>0,'separator'=>0,),
			'alipay_mail'=> array('name'=>'支付宝账户','options'=>'','tags'=>'text','decription'=>'','width'=>50,'height'=>0,'separator'=>0,),
			'alipay_pid'=> array('name'=>'合作者身份(PID)','options'=>'','tags'=>'text','decription'=>'','width'=>50,'height'=>0,'separator'=>0,),
			'alipay_key'=> array('name'=>'安全校验码(KEY)','options'=>'','tags'=>'text','decription'=>'','width'=>50,'height'=>0,'separator'=>0,),
			'alipay_discount'=> array('name'=>'享受折扣','options'=>'','tags'=>'text','decription'=>'0.85为85折，1不打折','width'=>5,'height'=>0,'separator'=>0,),
			'alipay_discount_info'=> array('name'=>'选择支付宝时提示','options'=>'','tags'=>'textarea','decription'=>'为空则不提示','width'=>50,'height'=>3,'separator'=>1,),

			'wxpay_status'=> array('name'=>'微信支付','options'=>array('1'=>'启用','0'=>'关闭',),'tags'=>'radio','decription'=>'开通微信支付请到<a href="https://pay.weixin.qq.com" target="_blank">微信支付</a>官网申请','width'=>35,'height'=>0,'separator'=>0,),
			'wxpay_appid'=> array('name'=>'微信APPID','options'=>'','tags'=>'text','decription'=>'','width'=>50,'height'=>0,'separator'=>0,),
			'wxpay_mchid'=> array('name'=>'微信MCHID','options'=>'','tags'=>'text','decription'=>'微信商户号','width'=>50,'height'=>0,'separator'=>0,),
			'wxpay_key'=> array('name'=>'支付密钥KEY','options'=>'','tags'=>'text','decription'=>'微信API密钥','width'=>50,'height'=>0,'separator'=>0,),
			'wxpay_secret'=> array('name'=>'微信支付应用密钥','options'=>'','tags'=>'text','decription'=>'AppSecret(应用密钥)','width'=>50,'height'=>0,'separator'=>0,),
			'wxpay_type'=> array('name'=>'微信支付类型','options'=>array('1'=>'扫码支付','2'=>'H5支付',),'tags'=>'checkbox','decription'=>'','width'=>50,'height'=>0,'separator'=>0,),
			'wxpay_discount'=> array('name'=>'享受折扣','options'=>'','tags'=>'text','decription'=>'0.85为85折，1不打折','width'=>5,'height'=>0,'separator'=>0,),
			'wxpay_discount_info'=> array('name'=>'选择微信支付时提示','options'=>'','tags'=>'textarea','decription'=>'为空则不提示','width'=>50,'height'=>3,'separator'=>1,),

			
		),

		'mail_setting' => array(
			'mail_send'=> array('name'=>'邮件发送','options'=>array('1'=>'启用','0'=>'关闭',),'tags'=>'select','decription'=>'','width'=>5,'height'=>0,'separator'=>0,),
			'mail_proxy'=> array('name'=>'','options'=>array('0'=>'不使用邮件代理','1'=>'使用邮件代理',),'tags'=>'select','decription'=>'如果服务器不支持邮件发送，请使用代理','width'=>5,'height'=>0,'separator'=>0,),
			'mail_send_status'=> array('name'=>'发送通知','options'=>array('0'=>'下单通知','1'=>'付款通知','2'=>'确认通知','3'=>'发货通知',),'tags'=>'checkbox','decription'=>'','width'=>5,'height'=>0,'separator'=>0,),
			'mail_smtp'=> array('name'=>'SMTP服务器','options'=>'','tags'=>'text','decription'=>'如网易163邮箱：smtp.163.com','width'=>50,'height'=>0,'separator'=>0,),
			'mail_ssl'=> array('name'=>'使用SSL','value'=>25,'options'=>array(''=>'不使用','ssl'=>'使用SSL',),'tags'=>'select','decription'=>'QQ，网易邮箱要使用SSL','width'=>10,'height'=>0,'separator'=>0,),
			'mail_port'=> array('name'=>'SMTP服务器端口','value'=>25,'options'=>'','tags'=>'text','decription'=>'默认为25,使用SSL用465','width'=>10,'height'=>0,'separator'=>0,),
			'mail_account'=> array('name'=>'发送邮箱','options'=>'','tags'=>'text','decription'=>'发送邮箱的帐号','width'=>50,'height'=>0,'separator'=>0,),
			'mail_password'=> array('name'=>'邮箱密码或授权码','options'=>'','tags'=>'text','decription'=>'发送邮箱的密码','width'=>50,'height'=>0,'separator'=>0,),
			'mail_to'=> array('name'=>'接收邮箱','options'=>'','tags'=>'text','decription'=>'多个邮箱请用英文逗号隔开','width'=>50,'height'=>0,'separator'=>0,),
			'mail_title'=> array('name'=>'邮件标题','options'=>'','tags'=>'text','decription'=>'[akmallStatus]订单状态，[akmallTitle]产品名，[akmallName]客户名','width'=>50,'height'=>0,'separator'=>0,),
		),

		'sms_setting' => array(
			'sms_send'=> array('name'=>'短信发送','options'=>array('0'=>'关闭','1'=>'启用',),'tags'=>'select','decription'=>'短信使用<a href="https://www.yunpian.com" target="_blank">云片</a>的服务，请去云片官网开通账户','width'=>30,'height'=>0,'separator'=>0,),
			'sms_admin'=> array('name'=>'通知对象','value'=>1,'options'=>array('0'=>'只通知客户','1'=>'只通知管理员','2'=>'同时通知管理员和客户',),'tags'=>'select','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
			'sms_admin_mobile'=> array('name'=>'','options'=>'','tags'=>'text','decription'=>'请填写管理员手机号，多个号码请用英文逗号隔开','width'=>30,'height'=>0,'separator'=>0,),
			'sms_account'=> array('name'=>'发送账号','options'=>'','tags'=>'text','decription'=>'','width'=>30,'height'=>0,'separator'=>0,),
			'sms_password'=> array('name'=>'发送密码','options'=>'','tags'=>'text','decription'=>'','width'=>30,'height'=>0,'separator'=>0,),
			'sms_sign'=> array('name'=>'短信签名','options'=>'','tags'=>'text','decription'=>'云片审核通过的签名，如【AKMALL】','width'=>30,'height'=>0,'separator'=>0,),
			'sms_countrys_code'=> array('name'=>'国家代码','options'=>'','tags'=>'text','decription'=>'例如+886(台湾)、+852(香港)，大陆不用填','width'=>30,'height'=>0,'separator'=>0,),
		),

		'safe_setting' => array(
			/* 'safe_check_mobile'=> array('name'=>'校验手机归属地','value'=>5,'options'=>array('0'=>'不校验','1'=>'校验',),'tags'=>'select','decription'=>'校验手机归属地和下单地址一致','width'=>5,'height'=>0,'separator'=>0,), */
			'safe_mobile_limit'=> array('name'=>'手机号下单限制','value'=>5,'options'=>'','tags'=>'text','decription'=>'笔（一个手机每天可对某一产品下单笔数）','width'=>5,'height'=>0,'separator'=>0,),
			'safe_order_interval'=> array('name'=>'下单间隔限制','value'=>20,'options'=>'','tags'=>'text','decription'=>'秒（对同一产品设置下单间隔，设置时长可以有效防止重复下单）','width'=>5,'height'=>0,'separator'=>0,),
			'safe_ip_limit'=> array('name'=>'IP下单限制','value'=>10,'options'=>'','tags'=>'text','decription'=>'笔（限制每个IP每小时可下单笔数，0 则不限制）','width'=>5,'height'=>0,'separator'=>0,),
			'safe_ip_denied'=> array('name'=>'黑名单IP','options'=>'','tags'=>'textarea','decription'=>'每个IP用#分隔开，IP段可用*号代替','width'=>80,'height'=>3,'separator'=>0,),
		),
		
		'ipcloak' => array(
			'ipcloak_status'=> array('name'=>'IP Cloak','options'=>array('0'=>'不启用','1'=>'启用',),'tags'=>'select','decription'=>'如需使用此功能，请直接联系我们开通账号','width'=>50,'height'=>0,'separator'=>0,),
			/* 'ipcloak_api'=> array('name'=>'接口地址','options'=>array('https://www.ipcloakads.com/api/index.php'=>'东南亚','https://www.iplooking.net/api/index.php'=>'备用',),'tags'=>'select','decription'=>'非特殊情况不要选择备用','width'=>50,'height'=>0,'separator'=>0,), */
			'ipcloak_username'=> array('name'=>'用户名','options'=>'','tags'=>'text','decription'=>'','width'=>50,'height'=>0,'separator'=>0,),
			'ipcloak_password'=> array('name'=>'密码','options'=>'','tags'=>'text','decription'=>'','width'=>50,'height'=>0,'separator'=>0,),
			'ipcloak_countries'=> array('name'=>'国家代码','options'=>'','tags'=>'text','decription'=>'查看<a href="http://www.ip-cloak.com/country.html" target="_blank">国家代码</a>，多个代码请用+号连接，如：CN+TW+HK','width'=>50,'height'=>0,'separator'=>0,),
			'ipcloak_agent'=> array('name'=>'屏蔽代理','options'=>array('true'=>'屏蔽','false'=>'不屏蔽',),'tags'=>'select','decription'=>'是否屏蔽vpn代理','width'=>50,'height'=>0,'separator'=>0,),
			'ipcloak_devices'=> array('name'=>'屏蔽设备','options'=>'','tags'=>'text','decription'=>'phone=手机，tablet=平板电脑，computer=台式/笔记本, 多个设备用+号相连，例如：tablet+computer','width'=>50,'height'=>0,'separator'=>0,),
			'ipcloak_whitelist'=> array('name'=>'白名单ip','options'=>'','tags'=>'text','decription'=>'多个ip用+连接','width'=>100,'height'=>0,'separator'=>0,),
		),

		'express_setting' => array(
			'delivery_key'=> array('name'=>'TrackingMore','options'=>'','tags'=>'text','decription'=>'请把API Key填写在此处，接口申请<a href="https://www.trackingmore.com" target="_blank">TrackingMore</a>，此网站分国内国外，海外服务器必须开vpn注册账户然后申请apikey。<br />可选功能。启用此功能后可以批量抓取订单物流状态、并可以根据物流状态自动更新订单状态，但此功能会产生费用，具体访问TrackingMore官网','width'=>35,'height'=>0,'separator'=>0,),
			'delivery_autoupdate'=> array('name'=>'更新订单状态','options'=>array('0'=>'不更新','1'=>'更新',),'tags'=>'radio','decription'=>'选择是否在更新物流状态时同步更新订单状态','width'=>35,'height'=>0,'separator'=>1,),
			'delivery_setting'=> array('name'=>'设置常用快递','options'=>$express['DELIVERY'],'tags'=>'checkbox','decription'=>'运输商<a href="https://www.trackingmore.com/help_article-16-30-cn.html" target="_blank">简码表</a>，仔细核对选择，不要错误勾选','width'=>35,'height'=>0,'separator'=>0,),
		),
		'export_setting' => array(
			'export_type'=> array('name'=>'导出格式','options'=>array('excel'=>'导出Excel','csv'=>'导出CSV',),'tags'=>'select','decription'=>'CSV格式可以导出大数据','width'=>30,'height'=>0,'separator'=>0,),
			'export_order'=> array('name'=>'导出订单','options'=>array('id'=>'订单 ID','order_no'=>'订单编号','item_sn'=>'商品编号','item_name'=>'商品名称','item_aliasname'=>'商品别名','item_params'=>'商品套餐','item_extends'=>'商品属性','quantity'=>'订单数量','total_price'=>'订单总价','name'=>'姓名','mobile'=>'手机','phone'=>'电话','province'=>'省份','city'=>'城市','area'=>'地区','address'=>'地址','zcode'=>'邮编','payment'=>'支付方式','status'=>'订单状态','delivery_name'=>'快递名称','delivery_no'=>'快递单号','remark'=>'客户备注','qq'=>'QQ','weixin'=>'微信','mail'=>'Email','channel_id'=>'推广渠道','url'=>'下单地址','referer'=>'来路地址','user_pid'=>'小组名','user_id'=>'用户名','datetime'=>'预约日期','add_ip'=>'下单IP','add_time'=>'下单时间','admin_remark'=>'管理员备注'),'tags'=>'checkbox','decription'=>'','width'=>35,'height'=>0,'separator'=>0,),
		),
		'域名集合' => array(
			'domain_set'=> array('name'=>'绑定域名','options'=>'','tags'=>'textarea','decription'=>'系统绑定的其它域名，一行一个。需要先设置好解析和在服务器端绑定，','width'=>50,'height'=>12,'separator'=>0,),
		),
		'实验性功能' => array(
			'oss_host'=> array('name'=>'远程图片地址','tags'=>'text','options'=>'','decription'=>'产品页面img文件使用远程链接，比较典型的如：阿里云OSS（需配合<a href="https://github.com/aliyun/ossfs/blob/master/README-CN.md" target="_blank">ossfs</a>使用，非专业技术员请勿使用）','width'=>50,'height'=>0,'separator'=>0,),
		),
		/* 'weixin_share_setting' => array(
			'weixin_status'=> array('name'=>'微信分享','options'=>array('0'=>'关闭','1'=>'启用',),'tags'=>'select','decription'=>'需要登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”','width'=>50,'height'=>0,'separator'=>0,),
			'weixin_appid'=> array('name'=>'AppID(应用ID)','options'=>'','tags'=>'text','decription'=>'','width'=>50,'height'=>0,'separator'=>0,),
			'weixin_appsecret'=> array('name'=>'AppSecret(应用密钥)','options'=>'','tags'=>'text','decription'=>'','width'=>50,'height'=>0,'separator'=>0,),
		), */
		
	)
);

?>