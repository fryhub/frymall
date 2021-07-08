<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html <?php if( C('DEFAULT_LANG') == 'arab-ae' OR C('DEFAULT_LANG') == 'arab-sa' OR C('DEFAULT_LANG') == 'arab-jor' OR C('DEFAULT_LANG') == 'arab-omn' ): ?>dir="rtl"<?php endif; ?>>
<head>
<title>
	<?php if(!empty($info["name"])): echo ($info["name"]); else: ?>
	<?php switch(ACTION_NAME): case "category": echo lang('item_category');?> -<?php break;?>
		<?php case "query": echo lang('order_query');?> -<?php break;?>
		<?php case "article": echo (getfields('Category','name',$_GET["id"])); ?> -<?php break; endswitch;?>
	<?php echo ($akmallConfig["title"]); endif; ?>
</title>
<meta charset="utf-8" />
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="yes" name="apple-touch-fullscreen"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="dns-prefetch" href="<?php echo ($akmallHost); ?>">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0, user-scalable=no" name="viewport">
<meta name="description" content="<?php if(empty($info["brief"])): echo ($akmallConfig["description"]); else: echo ($info["brief"]); endif; ?>">
<meta name="keywords" content="<?php if(!empty($info["tags"])): echo str_replace('#',',',$info['tags']);?>,<?php endif; echo ($akmallConfig["keywords"]); ?>">
<meta name="author" content="<?php echo lang('author');?>">
<link rel="shortcut icon" href="<?php echo C('akmall_ROOT');?>akmall.ico?v=<?php echo (AKMALL_VERSION); ?>" />
<link href="__PUBLIC__/akmall/akmall-order.css?v=<?php echo (AKMALL_VERSION); ?>" rel="stylesheet">
<?php if(!empty($template["template"])): ?><link href="<?php echo C('akmall_ROOT');?>Home/Tpl/akmall/<?php echo ($template['template']); ?>/assets/akmall.css?v=<?php echo (AKMALL_VERSION); ?>" rel="stylesheet"><?php endif; ?>
<!--[if lt IE 9]><link href="__PUBLIC__/akmall/akmall-ie.css?v=<?php echo (AKMALL_VERSION); ?>" rel="stylesheet"><![endif]-->
<script type="text/javascript" src="__PUBLIC__/akmall/seajs/seajs/sea.js?v=<?php echo C('AKMALL_VERSION');?>"></script>
<script type="text/javascript">
var akmallHost = "<?php echo ($akmallHost); ?>",akmallRoot = "<?php echo C('akmall_ROOT');?>",akmallVersion="<?php echo (AKMALL_VERSION); ?>",lang="<?php echo C('DEFAULT_LANG');?>";
seajs.config({ base: '__PUBLIC__/akmall/seajs/',alias: {'jquery': 'jquery/jquery','akmall': 'akmall/akmall','lang': 'akmall/lang-'+lang}, map: [['.css', '.css?v=' + akmallVersion],['.js', '.js?v=' + akmallVersion]]});
function traceExpress(com,num,order_id,order_no){
	window.location.href= "<?php echo C('akmall_ROOT');?>index.php?m=Order&a=traceExpress&com="+com+"&num="+num+"&order_id="+order_id+"&order_no="+order_no;
}
</script>
<?php if(session('fbpid')): ?><!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
<?php echo session('pixel_fbq');?>
fbq('track', 'PageView');
fbq('track', 'ViewContent');
</script>
<?php echo session('pixel_noscript');?>
<!-- End Facebook Pixel Code --><?php endif; ?>

<?php if(!empty($akmallConfig["head_content"])): echo ($akmallConfig["head_content"]); endif; ?>

<?php $color = $template['color']; ?>
<style>
.akmall-border,.akmall-side.akmall-full-row{ border-color:#<?php echo ($akmallConfig['theme_color']); ?>;}
<?php if(isset($template['width'])): ?>.akmall-detail-wrap{ max-width:<?php echo ($template["width"]); ?>;}<?php endif; ?>
<?php if(!empty($color)): ?>body,.akmall-order-wrap{ background-color:#<?php echo ($color["body_bg"]); ?>;}
.akmall-detail-content h2{ border-top-color:#<?php echo ($color["body_bg"]); ?>;}
.akmall-border,.akmall-side.akmall-full-row{ border-color:#<?php echo ($color["border"]); ?>;}
.akmall-detail-header dt{ color:#<?php echo ($color["font"]); ?>;}
.akmall-order{ color:#<?php echo ($color["font"]); ?>;background-color:#<?php echo ($color['form_bg']); ?>;}
.akmall-title{ background-color:#<?php echo ($color["title_bg"]); ?>;}
.akmall-btn,.akmall-btn:hover, .akmall-btn:active,.akmall-badge,.akmall-params.active,.akmall-group-box input:checked + label:after{ background-color:#<?php echo ($color['button_bg']); ?>;border-color:#<?php echo ($color["button_bg"]); ?>;}
.akmall-foot-nav{ background-color:#<?php echo ($color["nav_bg"]); ?>;}
.akmall-group.akmall-params.akmall-checkbox.active:hover{ background-color:#<?php echo ($color["button_bg"]); ?> !important;border-color:#<?php echo ($color["button_bg"]); ?> !important;color:#fff !important;}<?php endif; ?>
</style>

</head>
<body <?php if( C('DEFAULT_LANG') == 'arab-ae' OR C('DEFAULT_LANG') == 'arab-sa' OR C('DEFAULT_LANG') == 'arab-jor' OR C('DEFAULT_LANG') == 'arab-omn' ): ?>class="arab"<?php endif; ?>>

<?php if(!empty($akmallConfig["notice"])): ?><div class="akmallAlert"><a class="close" onclick="$('.akmallAlert').slideUp(500);">×</a><?php echo ($akmallConfig["notice"]); ?></div><?php endif; ?>

<div class="result">
	<h1><?php if(empty($order["status"])): ?><img src="__PUBLIC__/akmall/success.png"> <?php echo lang('submit_success'); else: echo lang('order_info'); endif; ?></h1>
    <div class="innner order_div success">
        <div class="order" style="min-height: calc(100vh - 244px);">
			<?php if(($order["status"]) == "3"): $item = M('Item')->where('is_delete=0 and id='.$order['item_id'])->field('is_auto_send,send_content')->find(); ?>
				<?php if(!empty($item["is_auto_send"])): ?><div class="akmall-alert">
					<span><?php echo (nl2br($item["send_content"])); ?></span>
				</div><?php endif; endif; ?>
					
            <ul>
				<?php if(($order["payment"]) != "1"): if(!empty($order["status"])): ?><li><label><?php echo lang('order_status_colon');?></label><span><?php $status=C('ORDER_STATUS'); echo ($status[$order['status']]); ?></span></li><?php endif; endif; ?>
				<li><label><?php echo lang('order_number_colon');?></label><span><?php echo ($order["order_no"]); ?></span></li>
				<li><label><?php echo lang('item_name_colon');?></label><span><?php echo ($order["item_name"]); ?></span></li>
				<?php if(!empty($order["item_params"])): $params_name = getFields("Item","params_name",$order['item_id']); ?>
				<li>
					<label><?php if(empty($params_name)): echo lang('itemPackage_colon'); else: echo ($params_name); echo lang('colon'); endif; ?></label>
					<?php $item_params = explode('#',$order['item_params']); $show_params = array(); foreach($item_params as $params){ $param = explode('||',$params); $show_params[] = $param[0]; } ?>
					<span><?php echo implode('#',$show_params);?></span>
				</li><?php endif; ?>
				<?php $extends = json_decode($order['item_extends'],true); ?>
				<?php if(!empty($extends)): if(is_array($extends)): $i = 0; $__LIST__ = $extends;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
						<?php if(strstr($key,'||')){ $key= explode('||',$key); $key= $key[0]; } ?>
						<label><?php echo ($key); echo lang('colon');?></label>
						<?php if(is_array($vo)){ $ret = array(); foreach($vo as $v){ $rs = explode('||',$v); $ret[] = $rs[0]; } $ret = implode('#',$ret); }elseif(strstr($vo,'||')){ $vo= explode('||',$vo); $ret= $vo[0]; }else{ $ret = $vo; } ?>
						<span><?php echo ($ret); ?></span>
					</li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
				<?php if(!empty($options)): $opt=C('TEMPLATE_OPTIONS');$payment = C('PAYMENT'); ?>
				<?php if(is_array($options)): $i = 0; $__LIST__ = $options;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$name): $mod = ($i % 2 );++$i; if(in_array($name,array('verify','code','coupon','product','extends'))){continue;} ?>
					<li>
						<label><?php echo $opt[$name]['name']; echo lang('colon');?></label>
						<span>
							<?php switch($name): case "mobile": echo (substr($order['mobile'],0,3)); ?>****<?php echo (substr($order['mobile'],"-3")); break;?>
								<?php case "price": ?><b><?php echo lang('symbol'); echo ($order['total_price']); ?></b><?php break;?>
								<?php case "payment": echo $payment[$order[$name]]['name']; break;?>
								<?php default: echo ($order[$name]); endswitch;?>
						</span>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
					<!--li><?php echo lang('paymentSubmit');?></li--><?php endif; ?>
			</ul>
			<div class="result_info"><?php echo ($akmallConfig["result_info"]); ?></div>
        </div>
		
        <div class="foot">
            <a href="javascript:history.go(-1)" class="foot_btn"><?php echo lang('goback');?></a>
			<p><?php echo ($akmallConfig["footer"]); ?></p>
        </div>
    </div>
</div>
<!-- <script>
pushHistory();  
window.addEventListener("popstate", function(e) {  
	window.location.href = "<?php echo ($redirectUrl); ?>";
	pushHistory();  
}, false);  
function pushHistory() {  
	var state = { title: "title", url: "#" };  
	window.history.pushState(state, "title", "#");  
}
</script> -->
<?php if(!empty($akmallConfig["mail_send"])): ?><script type="text/javascript">
seajs.use(['jquery'],function($){ var order_id = "<?php echo ($order['id']); ?>";$.ajax({ url:"<?php echo C('akmall_ROOT');?>index.php?m=Api&a=send&order_id="+order_id,timeout:1000 });});
</script><?php endif; ?>



<?php if(isset($_GET['buildHtml'])): ?><script type="text/javascript">
seajs.use(['jquery/query','jquery/cookie'],function(){var ac = $.query.get('ac');ac=ac?ac:$.query.get('gzid');if(ac){ $.cookie('ac',ac);$('input[name=channel_id]').val(ac);}})
</script><?php endif; ?>

</body>
</html>