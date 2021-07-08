
SET FOREIGN_KEY_CHECKS=0;
 
DROP TABLE IF EXISTS `akmall_advert`;
CREATE TABLE `akmall_advert` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `target` enum('_blank','_self') NOT NULL,
  `description` mediumtext NOT NULL,
  `sort_order` mediumint(5) NOT NULL DEFAULT '0',
  `create_time` int(10) NOT NULL,
  `type` enum('幻灯片','广告') NOT NULL DEFAULT '幻灯片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='广告幻灯片表-akmall.cc';

-- ----------------------------
-- Table structure for akmall_alipay_log
-- ----------------------------
DROP TABLE IF EXISTS `akmall_alipay_log`;
CREATE TABLE `akmall_alipay_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pay_type` tinyint(1) NOT NULL DEFAULT '1',
  `discount` mediumint(5) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `trade_no` varchar(64) NOT NULL,
  `buyer_email` varchar(32) DEFAULT NULL,
  `gmt_create` datetime DEFAULT NULL,
  `notify_type` varchar(50) DEFAULT NULL,
  `quantity` mediumint(5) DEFAULT NULL,
  `out_trade_no` varchar(32) NOT NULL,
  `seller_id` varchar(30) DEFAULT NULL,
  `notify_time` datetime NOT NULL,
  `trade_status` varchar(50) NOT NULL DEFAULT '',
  `is_total_fee_adjust` char(1) DEFAULT NULL,
  `total_fee` decimal(8,2) NOT NULL,
  `gmt_payment` datetime DEFAULT NULL,
  `seller_email` varchar(32) NOT NULL DEFAULT '',
  `price` decimal(12,0) DEFAULT NULL,
  `buyer_id` varchar(30) DEFAULT NULL,
  `notify_id` varchar(32) DEFAULT NULL,
  `use_coupon` char(1) DEFAULT NULL,
  `sign_type` varchar(32) DEFAULT NULL,
  `sign` varchar(50) DEFAULT NULL,
  `body` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `out_trade_no` (`out_trade_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='支付宝支付记录-akmall.cc';

-- ----------------------------
-- Table structure for akmall_article
-- ----------------------------
DROP TABLE IF EXISTS `akmall_article`;
CREATE TABLE `akmall_article` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(12) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `brief` text,
  `tags` varchar(100) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT '0',
  `content` longtext NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `is_frozen` tinyint(1) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL,
  `add_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='产品表-akmall.cc';

-- ----------------------------
-- Table structure for akmall_category
-- ----------------------------
DROP TABLE IF EXISTS `akmall_category`;
CREATE TABLE `akmall_category` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` mediumint(5) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='产品分类表-akmall.cc';

-- ----------------------------
-- Table structure for akmall_code
-- ----------------------------
DROP TABLE IF EXISTS `akmall_code`;
CREATE TABLE `akmall_code` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(16) NOT NULL,
  `item_id` int(12) NOT NULL DEFAULT '0',
  `code` varchar(10) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `add_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mobile` (`mobile`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for akmall_comments
-- ----------------------------
DROP TABLE IF EXISTS `akmall_comments`;
CREATE TABLE `akmall_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `item_id` int(12) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `title` varchar(50) DEFAULT NULL,
  `name` varchar(25) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `region` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `reply_content` text,
  `start` varchar(20) DEFAULT '5',
  `add_time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='评论表-akmall.cc';

-- ----------------------------
-- Table structure for akmall_coupon
-- ----------------------------
DROP TABLE IF EXISTS `akmall_coupon`;
CREATE TABLE `akmall_coupon` (
  `id` bigint(12) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `code` varchar(12) DEFAULT NULL,
  `types` tinyint(1) NOT NULL DEFAULT '1',
  `value` float(12,0) DEFAULT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `used_user` int(12) NOT NULL DEFAULT '0',
  `used_time` int(11) DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `expire_time` int(11) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for akmall_item
-- ----------------------------
DROP TABLE IF EXISTS `akmall_item`;
CREATE TABLE `akmall_item` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `user_pid` int(11) NOT NULL DEFAULT '0',
  `sn` varchar(15) NOT NULL,
  `category_id` int(12) NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL,
  `aliasname` varchar(100) NOT NULL,
  `brief` varchar(255) NOT NULL DEFAULT '',
  `tags` varchar(100) NOT NULL DEFAULT '',
  `original_price` decimal(12,0) NOT NULL DEFAULT '0.00',
  `price` decimal(12,0) NOT NULL COMMENT '价格',
  `quantity` int(12) NOT NULL DEFAULT '1000',
  `salenum` int(12) NOT NULL DEFAULT '0',
  `min_num` tinyint(3) DEFAULT '0',
  `max_num` mediumint(5) DEFAULT '10',
  `qrcode_pay` tinyint(1) NOT NULL DEFAULT '0',
  `qrcode_pay_info` text,
  `qrcode` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) DEFAULT NULL,
  `slideshow` text,
  `status` tinyint(1) NOT NULL,
  `is_hot` tinyint(1) NOT NULL DEFAULT '0',
  `is_big` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int(10) unsigned NOT NULL DEFAULT '0',
  `params_name` varchar(25) DEFAULT NULL,
  `params` text COMMENT '套餐属性',
  `params_type` varchar(20) DEFAULT NULL,
  `options` text,
  `extends` longtext,
  `content` longtext,
  `payment` varchar(255) DEFAULT '',
  `shipping_id` int(12) NOT NULL DEFAULT '0',
  `remark` text,
  `header` text,
  `javascript` text,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `is_sent` tinyint(1) NOT NULL DEFAULT '0',
  `is_auto_send` tinyint(1) NOT NULL DEFAULT '0',
  `send_content` text,
  `sms_send` text,
  `timer` int(10) NOT NULL DEFAULT '0',
  `link_pay_url` varchar(255) DEFAULT NULL,
  `link_pay_info` varchar(255) DEFAULT NULL,
  `click` int(12) NOT NULL DEFAULT '1',
  `buy_num` varchar(100) DEFAULT NULL,
  `buy_num_decrease` varchar(100) DEFAULT NULL,
  `redirect_uri` varchar(255) DEFAULT NULL,
  `weixin` text,
  `update_time` int(10) NOT NULL,
  `add_time` int(10) NOT NULL,
  `ipcloak_url` varchar(255) DEFAULT NULL,
  `purchase_url` varchar(255) DEFAULT NULL,
  `domain` varchar(100) DEFAULT NULL,
  `facebook_pixel_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sn` (`sn`),
  KEY `title` (`name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='产品表-akmall.cc';

-- ----------------------------
-- Table structure for akmall_item_group
-- ----------------------------
DROP TABLE IF EXISTS `akmall_item_group`;
CREATE TABLE `akmall_item_group` (
  `item_id` int(12) NOT NULL,
  `group_id` int(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for akmall_item_template
-- ----------------------------
DROP TABLE IF EXISTS `akmall_item_template`;
CREATE TABLE `akmall_item_template` (
  `id` bigint(20) NOT NULL COMMENT '产品id',
  `theme` varchar(25) NOT NULL,
  `template` varchar(25) NOT NULL,
  `options` text NOT NULL,
  `width` varchar(20) NOT NULL DEFAULT '750px',
  `show_notice` tinyint(1) NOT NULL DEFAULT '0',
  `show_comments` int(3) NOT NULL DEFAULT '0',
  `info` text,
  `color` varchar(255) NOT NULL,
  `redirect_uri` varchar(255) DEFAULT NULL,
  `extend` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='产品模板表-akmall.cc';

-- ----------------------------
-- Table structure for akmall_order
-- ----------------------------
DROP TABLE IF EXISTS `akmall_order`;
CREATE TABLE `akmall_order` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(12) NOT NULL,
  `user_pid` int(12) NOT NULL DEFAULT '0',
  `seller_id` int(12) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `order_no` varchar(20) NOT NULL,
  `order_page` varchar(15) NOT NULL DEFAULT 'single',
  `channel_id` varchar(20) DEFAULT NULL,
  `item_id` int(12) NOT NULL,
  `item_sn` varchar(25) DEFAULT NULL,
  `item_name` varchar(200) NOT NULL,
  `item_aliasname` varchar(100) NOT NULL,
  `item_params` varchar(255) NOT NULL,
  `item_extends` text,
  `item_price` decimal(12,0) NOT NULL DEFAULT '0.00',
  `order_price` decimal(12,0) NOT NULL,
  `shipping_price` decimal(12,0) NOT NULL DEFAULT '0.00',
  `total_price` decimal(12,0) NOT NULL DEFAULT '0.00',
  `quantity` mediumint(5) NOT NULL DEFAULT '1',
  `datetime` varchar(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `phone` varchar(20) NOT NULL DEFAULT '',
  `region` varchar(150) NOT NULL DEFAULT '',
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `zcode` varchar(10) NOT NULL DEFAULT '',
  `qq` varchar(20) NOT NULL,
  `weixin` varchar(50) DEFAULT NULL,
  `mail` varchar(50) NOT NULL DEFAULT '',
  `remark` varchar(100) NOT NULL,
  `payment` varchar(20) NOT NULL DEFAULT '1',
  `payment_num` varchar(20) NOT NULL,
  `delivery_name` varchar(20) NOT NULL,
  `delivery_no` varchar(25) NOT NULL,
  `delivery_status` tinyint(1) NOT NULL DEFAULT '9',
  `device` tinyint(1) NOT NULL DEFAULT '1',
  `add_ip` varchar(15) NOT NULL DEFAULT '',
  `is_delete` tinyint(1) NOT NULL,
  `is_sent` tinyint(1) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `referer` varchar(255) DEFAULT NULL,
  `add_time` int(10) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `update_time` int(10) NOT NULL,
  `update_user_id` int(12) NOT NULL DEFAULT '0',
  `coupon` varchar(12) DEFAULT NULL,
  `qudao` varchar(30) DEFAULT NULL,
  `qudaonum` varchar(30) DEFAULT NULL,
  `creditcard` text,
  `is_read` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='产品订单表-akmall.cc';
 

-- ----------------------------
-- Table structure for akmall_order_fengye
-- ----------------------------
DROP TABLE IF EXISTS `akmall_order_fengye`;
CREATE TABLE `akmall_order_fengye` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `adgroup_id` varchar(20) DEFAULT NULL,
  `adgroup_name` varchar(200) DEFAULT NULL,
  `advertiser_id` varchar(20) DEFAULT NULL,
  `account_id` varchar(20) DEFAULT NULL,
  `order_id` varchar(20) DEFAULT NULL,
  `page_name` varchar(100) DEFAULT NULL,
  `package_info` text,
  `quantity` int(5) DEFAULT NULL,
  `price` decimal(12,0) DEFAULT NULL,
  `total_price` decimal(12,0) DEFAULT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_province` varchar(50) DEFAULT NULL,
  `user_city` varchar(50) DEFAULT NULL,
  `user_area` varchar(50) DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_ip` varchar(20) DEFAULT NULL,
  `order_time` datetime DEFAULT NULL,
  `user_message` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `add_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='产品订单表';
	


-- ----------------------------
-- Table structure for akmall_order_log
-- ----------------------------
DROP TABLE IF EXISTS `akmall_order_log`;
CREATE TABLE `akmall_order_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `add_time` int(10) NOT NULL,
  `user_id` int(12) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='产品订单记录表-akmall.cc';
  
-- ----------------------------
-- Table structure for akmall_qudao
-- ----------------------------
DROP TABLE IF EXISTS `akmall_qudao`;
CREATE TABLE `akmall_qudao` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sn` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `add_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for akmall_receive
-- ----------------------------
DROP TABLE IF EXISTS `akmall_receive`;
CREATE TABLE `akmall_receive` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(12) DEFAULT '0',
  `mobile` varchar(15) DEFAULT NULL,
  `receive_content` text,
  `receive_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for akmall_sent
-- ----------------------------
DROP TABLE IF EXISTS `akmall_sent`;
CREATE TABLE `akmall_sent` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(12) DEFAULT '0',
  `order_status` tinyint(1) DEFAULT '0',
  `sent_status` tinyint(1) DEFAULT '0',
  `mobile` varchar(15) DEFAULT NULL,
  `sent_content` text,
  `sent_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for akmall_setting
-- ----------------------------
DROP TABLE IF EXISTS `akmall_setting`;
CREATE TABLE `akmall_setting` (
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='产品系统设置表-akmall.cc';

-- ----------------------------
-- Table structure for akmall_shipping
-- ---------------------------- 
DROP TABLE IF EXISTS `akmall_shipping`;
CREATE TABLE `akmall_shipping` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `less_num` tinyint(4) NOT NULL DEFAULT '1',
  `less_num_cost` decimal(12,0) NOT NULL DEFAULT '0',
  `step_num` tinyint(3) NOT NULL DEFAULT '1',
  `step_num_cost` decimal(12,0) NOT NULL DEFAULT '1',
  `is_free_num` tinyint(1) NOT NULL DEFAULT '0',
  `is_free_cost` tinyint(1) NOT NULL DEFAULT '0',
  `free_num` mediumint(5) NOT NULL DEFAULT '0',
  `free_cost` decimal(12,0) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='运费模板-akmall.cc';

-- ----------------------------
-- Table structure for akmall_user
-- ---------------------------- 
INSERT INTO `akmall_shipping` VALUES ('1', '满100免运费', '2', '10.00', '1', '2.00', '1', '1', '50', '100.00', '1455506416');
 
DROP TABLE IF EXISTS `akmall_user`;
CREATE TABLE `akmall_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(12) unsigned NOT NULL DEFAULT '0',
  `group_id` int(12) NOT NULL DEFAULT '0',
  `username` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `role` enum('admin','member','agent') NOT NULL DEFAULT 'admin',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `mobile` varchar(15) NOT NULL,
  `qq` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `info` mediumtext NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `login_ip` char(16) NOT NULL,
  `login_time` datetime NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='产品用户表-akmall.cc';

-- ----------------------------
-- Table structure for akmall_user_group
-- ----------------------------
DROP TABLE IF EXISTS `akmall_user_group`;
CREATE TABLE `akmall_user_group` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `role` enum('admin','agent') DEFAULT 'admin',
  `score` int(10) NOT NULL DEFAULT '0',
  `name` varchar(25) NOT NULL,
  `discount` tinyint(3) NOT NULL DEFAULT '100',
  `auth` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for akmall_user_logs
-- ----------------------------
DROP TABLE IF EXISTS `akmall_user_logs`;
CREATE TABLE `akmall_user_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `types` varchar(20) NOT NULL,
  `content` text,
  `add_ip` varchar(15) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_setting` VALUES ('system_close_info', '');
INSERT INTO `akmall_setting` VALUES ('URL_MODEL', '0');
INSERT INTO `akmall_setting` VALUES ('item_quantity', '0');
INSERT INTO `akmall_setting` VALUES ('show_qrcode', '0');
INSERT INTO `akmall_setting` VALUES ('real_notice', '0');
INSERT INTO `akmall_setting` VALUES ('record_order', '1');
INSERT INTO `akmall_setting` VALUES ('repeat_order', '0');
INSERT INTO `akmall_setting` VALUES ('lazyload', '0');
INSERT INTO `akmall_setting` VALUES ('title', 'AK单页订单管理系统企业版');
INSERT INTO `akmall_setting` VALUES ('keywords', 'AK单页订单管理系统企业版');
INSERT INTO `akmall_setting` VALUES ('description', 'AK单页订单管理系统企业版');
INSERT INTO `akmall_setting` VALUES ('footer', '<div style="font-size:14px;">\n<a href="index.php?m=Item&a=detail&id=1&uid=1">關於我們</a> | \n<a href="index.php?m=Item&a=detail&id=3&uid=1">物流條款</a> | \n<a href="index.php?m=Item&a=detail&id=4&uid=1">服務條款</a> | \n<a href="index.php?m=Item&a=detail&id=5&uid=1">隱私協議</a><br />\nCopyright © 2016-2019 <a href="#"  target="_blank">AK单页订单管理系统企业版</a> All Rights Reserved<br /></div>');
INSERT INTO `akmall_setting` VALUES ('notice', '<p style="font-size:12px;">大部分内容都可在后台修改，支持东南亚各国，具体联系微信：123456</p>');
INSERT INTO `akmall_setting` VALUES ('payment_global', '1');
INSERT INTO `akmall_setting` VALUES ('payOnDelivery_status', '1');
INSERT INTO `akmall_setting` VALUES ('payOnDelivery_discount', '0');
INSERT INTO `akmall_setting` VALUES ('payOnDelivery_discount_info', '注: 我們會宅配送貨到您府上，請您注意查收。');
INSERT INTO `akmall_setting` VALUES ('bankpay_status', '0');
INSERT INTO `akmall_setting` VALUES ('bankpay_discount', '0');
INSERT INTO `akmall_setting` VALUES ('bankpay_info', '注: 我們會宅配送貨到您府上，請您注意查收。');
INSERT INTO `akmall_setting` VALUES ('alipay_status', '0');
INSERT INTO `akmall_setting` VALUES ('alipay_type', '[\"1\",\"2\"]');
INSERT INTO `akmall_setting` VALUES ('alipay_mail', '');
INSERT INTO `akmall_setting` VALUES ('alipay_pid', '');
INSERT INTO `akmall_setting` VALUES ('alipay_key', '');
INSERT INTO `akmall_setting` VALUES ('alipay_discount', '0.95');
INSERT INTO `akmall_setting` VALUES ('alipay_discount_info', '支付宝95折');
INSERT INTO `akmall_setting` VALUES ('wxpay_status', '0');
INSERT INTO `akmall_setting` VALUES ('wxpay_appid', '');
INSERT INTO `akmall_setting` VALUES ('wxpay_mchid', '');
INSERT INTO `akmall_setting` VALUES ('wxpay_key', '');
INSERT INTO `akmall_setting` VALUES ('wxpay_secret', '');
INSERT INTO `akmall_setting` VALUES ('wxpay_type', '[\"1\",\"2\"]');
INSERT INTO `akmall_setting` VALUES ('wxpay_discount', '1');
INSERT INTO `akmall_setting` VALUES ('wxpay_discount_info', '');
INSERT INTO `akmall_setting` VALUES ('safe_check_mobile', '0');
INSERT INTO `akmall_setting` VALUES ('safe_mobile_limit', '100');
INSERT INTO `akmall_setting` VALUES ('safe_order_interval', '20');
INSERT INTO `akmall_setting` VALUES ('safe_ip_limit', '20');
INSERT INTO `akmall_setting` VALUES ('safe_ip_denied', '');
INSERT INTO `akmall_setting` VALUES ('result_info', '');
INSERT INTO `akmall_setting` VALUES ('html_file', 'Html/');
INSERT INTO `akmall_setting` VALUES ('DEFAULT_LANG', 'zh-cn');
INSERT INTO `akmall_setting` VALUES ('export_type', 'excel');
INSERT INTO `akmall_setting` VALUES ('export_order', '[\"id\",\"order_no\",\"item_sn\",\"item_name\",\"item_params\",\"item_extends\",\"quantity\",\"total_price\",\"name\",\"mobile\",\"province\",\"city\",\"area\",\"address\",\"payment\",\"remark\",\"weixin\",\"channel_id\"]');
INSERT INTO `akmall_setting` VALUES ('creditcard_status', '0');
INSERT INTO `akmall_setting` VALUES ('creditcard_mid', '61953');
INSERT INTO `akmall_setting` VALUES ('mail_send', '0');
INSERT INTO `akmall_setting` VALUES ('mail_proxy', '0');
INSERT INTO `akmall_setting` VALUES ('delivery_setting', '[\"jet\",\"ems\",\"jd\",\"tcat\",\"shunfeng\",\"hct\",\"kerrytj\",\"jne\"]');
INSERT INTO `akmall_setting` VALUES ('shop_links', '1');
INSERT INTO `akmall_setting` VALUES ('system_template', 'akmall');
INSERT INTO `akmall_setting` VALUES ('order_options', '[\"product\",\"extends\",\"price\",\"quantity\",\"payment\",\"name\",\"mobile\",\"region\",\"address\",\"mail\",\"remark\"]');
INSERT INTO `akmall_setting` VALUES ('show_notice', '1');
INSERT INTO `akmall_setting` VALUES ('slider_show', '1');
INSERT INTO `akmall_setting` VALUES ('slider_num', '5');
INSERT INTO `akmall_setting` VALUES ('item_hot_show', '1');
INSERT INTO `akmall_setting` VALUES ('item_hot_num', '12');
INSERT INTO `akmall_setting` VALUES ('item_category_show', '1');
INSERT INTO `akmall_setting` VALUES ('item_category_num', '10');
INSERT INTO `akmall_setting` VALUES ('item_category_id', '1,2,3,4');
INSERT INTO `akmall_setting` VALUES ('show_header', '1');
INSERT INTO `akmall_setting` VALUES ('show_bottom_nav', '1');
INSERT INTO `akmall_setting` VALUES ('system_status', '1');
INSERT INTO `akmall_setting` VALUES ('theme_color', 'F34242');
INSERT INTO `akmall_setting` VALUES ('contact_tel', '后台设置清空内容就不显示');
INSERT INTO `akmall_setting` VALUES ('contact_phone', '');
INSERT INTO `akmall_setting` VALUES ('contact_facebook', 'https://');
INSERT INTO `akmall_setting` VALUES ('contact_messenger', 'https://');
INSERT INTO `akmall_setting` VALUES ('contact_line', 'LineId');
INSERT INTO `akmall_setting` VALUES ('contact_line_url', 'https://line.me/xxxx');
INSERT INTO `akmall_setting` VALUES ('contact_whatsapp', '8617600000000');
INSERT INTO `akmall_setting` VALUES ('contact_qq', '');
INSERT INTO `akmall_setting` VALUES ('is_encode', '0');
INSERT INTO `akmall_setting` VALUES ('facebook_pixel_id', '9999,8888,555');
INSERT INTO `akmall_setting` VALUES ('sms_send', '0');
INSERT INTO `akmall_setting` VALUES ('sms_admin', '0');
INSERT INTO `akmall_setting` VALUES ('sms_admin_mobile', '');
INSERT INTO `akmall_setting` VALUES ('sms_account', '');
INSERT INTO `akmall_setting` VALUES ('sms_password', '');
INSERT INTO `akmall_setting` VALUES ('mail_send_status', '[]');
INSERT INTO `akmall_setting` VALUES ('mail_smtp', 'smtp.qq.com');
INSERT INTO `akmall_setting` VALUES ('mail_ssl', 'ssl');
INSERT INTO `akmall_setting` VALUES ('mail_port', '465');
INSERT INTO `akmall_setting` VALUES ('mail_account', '');
INSERT INTO `akmall_setting` VALUES ('mail_password', '');
INSERT INTO `akmall_setting` VALUES ('mail_to', 'admin@akmall.cc');
INSERT INTO `akmall_setting` VALUES ('mail_title', '【[akmallStatus]】[akmallTitle]');
INSERT INTO `akmall_setting` VALUES ('logo_pc', '');
INSERT INTO `akmall_setting` VALUES ('logo', '');
INSERT INTO `akmall_setting` VALUES ('system_theme', 'akmall');
INSERT INTO `akmall_setting` VALUES ('relate_item_show', '1');
INSERT INTO `akmall_setting` VALUES ('relate_item_num', '3');
INSERT INTO `akmall_setting` VALUES ('codepay_status', '0');
INSERT INTO `akmall_setting` VALUES ('codepay_type', '1');
INSERT INTO `akmall_setting` VALUES ('codepay_id', '34676');
INSERT INTO `akmall_setting` VALUES ('codepay_discount', '1');
INSERT INTO `akmall_setting` VALUES ('codepay_discount_info', '打开微信，选择扫码支付');
INSERT INTO `akmall_setting` VALUES ('region', 'region');
INSERT INTO `akmall_setting` VALUES ('main_domain', '');
INSERT INTO `akmall_setting` VALUES ('paypay_status', '0');
INSERT INTO `akmall_setting` VALUES ('redirect_domains', '');
INSERT INTO `akmall_setting` VALUES ('creditcard_gateway', '61953001');
INSERT INTO `akmall_setting` VALUES ('creditcard_key', 'H482lv4j');
INSERT INTO `akmall_setting` VALUES ('creditcard_discount', '1');
INSERT INTO `akmall_setting` VALUES ('creditcard_discount_info', '信用卡支付');
INSERT INTO `akmall_setting` VALUES ('creditcard_url', 'https://pay.sslshoppingmall.com/TPInterface');
INSERT INTO `akmall_setting` VALUES ('order_backup_url', '');
INSERT INTO `akmall_setting` VALUES ('paypay_user', '');
INSERT INTO `akmall_setting` VALUES ('paypay_key', '');
INSERT INTO `akmall_setting` VALUES ('paypay_discount', '');
INSERT INTO `akmall_setting` VALUES ('paypay_discount_info', '');


DROP TABLE IF EXISTS `akmall_region`;
CREATE TABLE `akmall_region` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `name` varchar(50) DEFAULT NULL,
  `info` text,
  `code` varchar(20) DEFAULT NULL,
  `item` varchar(20) DEFAULT NULL,
  `lang` varchar(20) DEFAULT NULL,
  `display_order` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9679 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of akmall_region
-- ----------------------------
