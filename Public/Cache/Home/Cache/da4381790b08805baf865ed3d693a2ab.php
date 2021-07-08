<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<title>支付宝支付</title>
<meta charset="utf-8" />
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="yes" name="apple-touch-fullscreen"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="dns-prefetch" href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0, user-scalable=no" name="viewport">
<meta name="description" content="<?php if(empty($info["brief"])): echo ($akmallConfig["description"]); else: echo ($info["brief"]); endif; ?>">
<meta name="keywords" content="<?php if(!empty($info["tags"])): echo str_replace('#',' ',$info['tags']); endif; ?> <?php echo ($akmallConfig["keywords"]); ?>">
<meta name="author" content="<?php echo lang('author');?>">
<link rel="shortcut icon" href="__PUBLIC__/Assets/img/akmall.ico" />
<link href="__PUBLIC__/akmall/akmall-order.css?v=<?php echo (AKMALL_VERSION); ?>" rel="stylesheet">
<!--[if lt IE 9]><link href="__PUBLIC__/akmall/akmall-ie.css?v=<?php echo (AKMALL_VERSION); ?>" rel="stylesheet"><![endif]-->
<script type="text/javascript" src="__PUBLIC__/akmall/seajs/seajs/sea.js?v=<?php echo (AKMALL_VERSION); ?>"></script>
<script type="text/javascript">
var akmallHost = "<?php echo ($akmallHost); ?>",akmallRoot = "<?php echo C('akmall_ROOT');?>",akmallVersion="<?php echo C('AKMALL_VERSION');?>",lang="<?php echo C('DEFAULT_LANG');?>";
seajs.config({ base: '__PUBLIC__/akmall/seajs/',alias: {'jquery': 'jquery/jquery','akmall': 'akmall/akmall','lang': 'akmall/lang-'+lang}, map: [['.css', '.css?v=' + akmallVersion],['.js', '.js?v=' + akmallVersion]]});
</script>
</head>
<body>
<p>正在提交...</p>
<script type="text/javascript">
seajs.use(['jquery','akmall'],function($){
	var order_id = "<?php echo ($order['id']); ?>";$.ajax({ url:"<?php echo C('akmall_ROOT');?>index.php?m=Api&a=send&order_id="+order_id,timeout:500 });
	setTimeout(function(){
		var url = "<?php echo C('akmall_ROOT');?>index.php?m=Api&a=payAlipay&order_no=<?php echo ($order['order_no']); ?>";
		window.location.href=url;
	},500);
	
});
</script>
</body>
</html>