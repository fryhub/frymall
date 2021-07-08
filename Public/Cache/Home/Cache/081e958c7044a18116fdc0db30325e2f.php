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

<link href="<?php echo C('akmall_ROOT'); echo C('akmall_THEME_ROOT');?>akmall-2/assets/akmall.css?v=<?php echo (AKMALL_VERSION); ?>" rel="stylesheet" type="text/css" />
<?php if(!empty($akmallConfig["lazyload"])): ?><script type="text/javascript">
seajs.use(['jquery/lazyload'], function() {
	$(".akmall-detail-content img").lazyload({ placeholder : "__PUBLIC__/akmall/akmall.gif",effect : "fadeIn",threshold:500})
});
</script><?php endif; ?>
<!--[if lt IE 9]>
<style>.header h1,.footer{color:#666;}</style>
<![endif]-->

<div class="wrapper akmall-detail-wrap">
	
		
	<div class="akmall-page">
		<?php if(!empty($info["slideshow"])): ?><div class="box box-image banner">
			<!--<h2 class="title"><?php echo lang('itemImage');?></h2>-->
			<div class="box-content">
				<div class="newbanner">
				  <div class="newflexslider">
					<ul class="newslides">
						<?php $_result=explode(',',$info['slideshow']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><img src="<?php echo (imageurl($vo)); ?>" /></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				  </div>
				</div>
				<script type="text/javascript">
				seajs.use(['jquery/newflexslider'], function(){ $('.newflexslider').newflexslider({ directionNav: true, pauseOnAction: false,newslideshowSpeed:3000 });});
				</script>
			</div>
		</div><?php endif; ?>
		<div class="box akmallbox-1">
			
			<div class="box-content">
				
				<div class="akmall-plug clearfix">
					
					<?php if(!empty($info["timer"])): ?><div class="timer">
						
						<div id="akmall-timer" class="akmall-timer">
						<span class="akmallDay"><strong>0</strong></span><span class="akmallHour"><strong>00</strong></span><span>:</span><span class="akmallMinute"><strong>00</strong></span><span>:</span><span class="akmallSecond"><strong>00</strong></span>
						</div>
						<script type="text/javascript">
							seajs.use(['akmall'],function(akmall) {
								akmall.timer('#akmall-timer', '<?php echo ($info["timer"]); ?>');
							})
						</script>
					</div>
					<?php if(!empty($info["original_price"])): ?><span class="original-price">後恢復<?php echo lang('symbol'); echo ($info["original_price"]); ?></span><?php endif; endif; ?>					
				</div>
				<div class="akmall-content-title">
					<h1><span style="color: #e61414;"><?php echo ($info["name"]); ?></span></h1>
					<p><?php echo ($info["brief"]); ?></p>
					<div class="price">
						勁爆價<span class="current-price"><?php echo lang('symbol'); echo (floatval($info["price"])); ?></span>
							<span class="group">
								<?php if(floatval($info['original_price']) > 0): ?>原價<del class="original-price"><?php echo lang('symbol'); echo ($info["original_price"]); ?></del>
								<?php else: ?><span class="original-price" style="height:10px;">&nbsp;</span><?php endif; ?>
								<?php if(!empty($info["salenum"])): ?><span class="salenum"><?php echo lang('sold'); echo ($info["salenum"]); ?></span><?php endif; ?>
							</span>
					</div>
				</div>
				<div class="item" id="service-item">
					<p class="title">優惠活動</p>
					<div class="baoyou">
						<div class="service-list">
							<span class="service huo">貨到付款</span>
							<span class="service quality">品質保證</span>
							<span class="service sevendays">七天退換</span>
							<span class="service shouhou">售後服務</span>
							<span class="right">》</span>
						</div>
						<div class="service-tips">由黑貓宅急便免費配送</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"> </div>
		<ul class="detail-bars akmall-detail-wrap">
            <li><a href="javascript:;" onclick="scrollto('#detial-context')" class="scrollBar" scroll-y="0"><?php echo lang('itemDescription');?></a></li>
            <li><a href="javascript:;" onclick="scrollto('#akmallOrder')" class="scrollBar" scroll-y="50"><?php echo lang('buyInfo');?></a></li>
            <li><a href="javascript:;" onclick="scrollto('#akmall-comments')" class="scrollBar" scroll-y="85"><?php echo lang('comments');?></a></li>
        </ul>
        <div class="clear">
        </div>
		
		<div class="box akmallbox-2" id="detial-context">
			
			<div class="box-content akmall-detail-content" ><?php echo ($info['content']); ?></div>
			<?php echo W('Relate',array_merge($info,array('moduel'=>'Order')));?> 
		</div>
	</div>
	
	<!--訂單查詢-->
<div class="akmall-query clearfix">
	<div class="akmall-content">
		<form action="<?php echo C('akmall_ROOT');?>index.php?m=Order&a=query" method="post" id="queryForm">
			<div class="akmall-rows clearfix rows-id-extends">
				<label class="rows-head"><?php echo lang('order_query');?></label>
				<div class="rows-params">
					<input type="tel" name="kw" autocomplete="off" required="required" placeholder="<?php echo lang('mobile_/_order_number');?>" class="akmall-input-text">
				</div>
			</div>
			<div class="akmall-rows akmall-id-btn clearfix">
				<input type="submit" id="akmall-query-btn" class="akmall-btn akmall-submit" value="<?php echo lang('submit_query');?>" />
			</div>
		</form>	
		<div id="akmall-query-result" class="query_result"></div>
	</div>
</div>
<script id="akmall-query" type="text/html">
{{each list as value i}}
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr><th><?php echo lang('order_colon');?>{{value.order_no}}</th></tr>
	<tr>
		<td>
			{{if value.is_auto_send}}
			<div class="akmall-alert">
				{{#value.send_content}}
			</div>
			{{/if}}
			<h2>{{value.title}}</h2>
			{{if value.params}}<p><?php echo lang('itemPackage_colon');?>{{#value.params}}</p>{{/if}}
			{{#value.itemExtends}}
			{{if value.address}}<?php echo lang('delivery_address_colon');?>{{value.address}}{{/if}}
			{{if value.express}}<p><?php echo lang('express_query_colon');?>{{#value.express}}</p>{{/if}}
			<p>
				<?php echo lang('order_status_colon');?>{{value.status}}
				{{if value.order_status=='0' && value.payment!='1' && value.payment!='6'}}
				<a href="<?php echo C('akmall_ROOT');?>index.php?m=Order&a=pay&order_no={{value.order_no}}" class="links" target="_blank">[<?php echo lang('pay');?>]</a>
				{{/if}}
			</p>
			<p><?php echo lang('quantity_price_colon');?>{{value.quantity}}/<span class="price">{{value.price}}</span></p>
			<p><?php echo lang('booking_time_colon');?>{{value.time}}</p>
		</td>
	</tr>
</table>
{{/each}}
</script>
<script type="text/javascript">
seajs.use(['akmall','jquery/form','art/template'],function(akmall,form,template){
	$('#queryForm').ajaxForm({
		timeout: 50000,
		dataType: 'json',
		error:function(){  layer.closeAll(); alert(lang.ajaxError); },
		beforeSubmit:function(){ layer.closeAll();layer.load(); },
		success:function(data){
			layer.closeAll();
			if(data.status=='1'){
				var html = template('akmall-query', data.data);
				document.getElementById('akmall-query-result').innerHTML = html;
			}else{ 
				layer.msg(data.info);
				document.getElementById('akmall-query-result').innerHTML = "<div class='akmall-rows'>"+data.info+"</div>";
			}
		}
	});
});
function delivery(order,id){
	var url = "<?php echo C('akmall_ROOT');?>index.php?m=Index&a=delivery&order="+order+"&id="+id+"&ord=asc&show=json",title="<?php echo lang('shipping_query');?>";
	layer.open({type: 2,shade: .2,shadeClose: true,title: title,area: ['600px', '60%'],content:url}); 
}
</script>

	<div class="guarantee">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAA2CAMAAACycDqVAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAA2UExURUxpcUB6qkB6qkB6qkB6qkB6qkB6qkB6qkB6qkB7qkB7qkB6qkB7qkB6qkB6qkB7qkB6qkB6qr8iNgoAAAARdFJOUwDJHOKrCoWZ7rvYcvhATl8sl1H2XgAAAcxJREFUSMeVVkcCgyAQFOld/v/ZSEJZpEjmkKAyMFvhOIY4mSLu2Ad1MkRgfe4RLBchw2xsZRkOLQS/FvMdf87/QTE7kh9/UJhCcEfhfI4Eiv8srGAkc8UdcfX4YMMrUKKoe6yjOvNKUYmCM12+UnCifOMQlelXioAUvWWMgRRZRktAylcZ2aX8Yu7vkUcygWTwDNFT5Dr7zsZ89bOMLimsoaTc8ksKbkKZIkji2IsBXPF/ThgeqrJrFD9a5pBGZgiuCmjAa/rxRPEBLMF7iq1TdK5eIKB8bFNRQiHF5enF/YAYY7zCgxmlD4gAlKpg3DgoNStr0YtsDHkgrym7RaKhA2MqWKF44M6qewD3SLlcp1x2yMECaaigskGXw226NPFjQ4oefHXPDtJuIp5RgS8D4T1k6HXBzELaw96stC/drS2o0o7Q7RRaOZjWJiIeZatgqvo2dnbsGg0pGpZKdo45J15RUZiqBXnPo7Kprn4bzJhqzqL0aM65818zst9mcrAMuxxadfzxsXyZ/2Stpclp852dFXh+MaFqfNqt7hfniGPs+hTB/zIG+wj7fhlrD3987VzItNnx7iOmeSOj96+K/msROY9/4BCa2f0BZQNXdtzM6pIAAAAASUVORK5CYII=" alt="guarantee">
        <p class="guarantee_title">買家保障</p>
        <p class="guarantee_content">如果您未收到商品<strong>全額退款</strong>！</p>
        <p class="guarantee_content">如果您購買的商品與描述不符，<strong>全額或部分退款</strong>！</p>
		<div class="payment_pic"><img src="<?php echo C('akmall_ROOT'); echo C('akmall_THEME_ROOT');?>akmall-2/assets/payment.png" /></div>
	</div>
	
<div class='akmall-remark'><?php echo ($info['remark']); ?></div>
<div class="akmall-footer"><?php echo ($akmallConfig["footer"]); ?></div>
<?php $showNav = count(array_filter($template['extend']['bottom_nav_list'])); if($showNav>=0){ if($showNav==0){ $style = "style='width:100%'";}elseif($showNav==1){ $style = "style='width:49%'";}elseif($showNav==3){ $style = "style='width:24%'";}else{ $style = '';} $hidden = (strpos($template['extend']['bottom_nav_list'][1],'http')===0)?"style='display:none;'":""; $buyNow = strstr($info['content'],'akmallOrder')?'#akmallOrder':U('Order/index',array('id'=>$info['sn'],'track'=>'purchase')); $html = '<div class="akmall-foot-nav"><span id="akmallUp"></span><!-- <a class="akmall-up" href="#" '.$hidden.'>'.lang('top').'</a> --><ul>'; for($i=1;$i<=$showNav;$i++){ $nav = explode('||',$template['extend']['bottom_nav_list'][$i]); $class = isset($nav[2])?'icon '.$nav[2]:''; $text = $hidden = (strpos($nav[0],'http')===0)?'<img src="'.$nav[0].'" style="max-width:100%;">':'<strong class="'.$class.'">'.$nav[0].'</strong>'; $html .= '<li class="foot-nav-'.$i.'" '.$style.'><a href="'.$nav[1].'">'.$text.'</a></li>'; } echo $html.'<li class="foot-nav-3" '.$style.'><a href="'.$buyNow.'"><strong class="icon CartButton">'.lang('booking').'</strong></a></li></ul></div>'; } ?>

<?php if($akmallConfig['show_qrcode'] == 1 && isMobile() == false): ?><div id="qrcode"><div class="qrcode"><div id="akmall-qrcode"></div><span><?php echo lang('qrcodeAddress');?></span></div></div>
<script type="text/javascript" src="__PUBLIC__/Assets/js/qrcode.min.js"></script>	
<script type="text/javascript">new QRCode(document.getElementById('akmall-qrcode'), {text:window.location.href,width:200,height:200});console.log(window.location.href);</script><?php endif; ?>
<script type="text/javascript">seajs.use(['jquery/scrollup'], function(){ $.scrollUp({scrollName: 'akmallUp'}); });</script>

<!-- Facebook Pixel Code -->
<!-- 触发AddToCart事件 -->
<script type='text/javascript'>
	var button = document.getElementsByClassName('CartButton');
	var i;
	var m = 1;//加一个判断变量 让事件只触发一次
	for (i = 0; i < button.length; i++) {
		button[i].addEventListener(
		'click', 
		function() { 
			if(m == 1){
				fbq('track', 'AddToCart');
				m = 0;
			}
		},
		false
		);
	}
</script>
<!-- 触发AddPaymentInfo事件 -->
<script type="text/javascript">
var button = document.getElementsByClassName('akmall-input-text');
	var i;
	var n = 1;//加一个判断变量 让事件只触发一次
	for (i = 0; i < button.length; i++) {
		button[i].addEventListener(
		'change', 
		function() { 
			if(n == 1){
				fbq('track', 'AddPaymentInfo');
				n = 0;
			}
		},
		false
		);
	}
  
</script>
<!-- End Facebook Pixel Code -->

<script type="text/javascript">
seajs.use(['akmall','jquery/form','lang'],function(akmall){
	 			
	window.akmall = akmall;
	akmall.quantity(0);
	var btnSubmit = $('.akmall-submit');
	$('#akmallForm').ajaxForm({
		cache: true,
		timeout: 50000,
		dataType: 'json',
		error:function(){ layer.closeAll(); alert(lang.ajaxError); btnSubmit.attr('disabled',false).val(lang.submit); },
		beforeSubmit:function(){
			if(checkForm('#akmallForm')==false) return false; 
			layer.closeAll();layer.load();
			btnSubmit.attr('disabled',true).val(lang.loading);
		},
		success:function(data){
			<?php if(session('fbpid')): ?>fbq('track', 'InitiateCheckout');<?php endif; ?>
			layer.closeAll();layer.closeAll();
			if(data.status=='1'){
				<?php echo ($info["javascript"]); ?>
				<?php if(session('fbpid')): ?>fbq('track', 'Purchase', 
					{
					value: data.data.total_price,
					currency: '<?php echo lang("currency");?>',
					}
				);<?php endif; ?>
				var redirect = "<?php echo U('Order/pay',array('order_no'=>'__orderNo__'));?>";
				window.location.href = redirect.replace('__orderNo__',data.data.order_no);
			}else{
				btnSubmit.attr('disabled',false).val(lang.submit);
				layer.msg(data.info);
			}
		}
	});
});
var wx = <?php echo (json_encode($info["weixin"])); ?>;
</script>


<?php if(!empty($akmallConfig["weixin_status"])): $slideshow = explode(',',$info['slideshow']);$imgUrl=$slideshow[0]; ?>
<script>
define("wxShare",["jquery","https://res.wx.qq.com/open/js/jweixin-1.0.0.js"],function(a){
	var $=a("jquery"),wx=a('https://res.wx.qq.com/open/js/jweixin-1.0.0.js');
	var url = encodeURIComponent(location.href.split('#')[0]);
    $.ajax({
        type : "get",
        url : "<?php echo C('akmall_ROOT');?>index.php?m=Order&a=wx&url="+url,
        dataType : "json",
        async : false,
        success:function(share){
            wx.config({
                debug: false,
                appId: share.appId,
                timestamp: share.timestamp,
                nonceStr: share.nonceStr,
                url: share.url,
                signature: share.signature,
				//jsApiList:['onMenuShareAppMessage', 'onMenuShareTimeline', 'hideAllNonBaseMenuItem', 'showMenuItems','hideMenuItems']
                jsApiList: [ 'onMenuShareTimeline', 'onMenuShareAppMessage']
            });
        },
		complete: function(e){
			console.log('complete');
		},
        error:function(data){  alert(data); }
    });
	wx.ready(function () {
		var shareData = {
			title: '<?php echo ($info["name"]); ?>',
			desc: '<?php echo ($info["brief"]); ?>',
			link: '<?php echo (urldecode($thisUrl)); ?>',
			imgUrl: '<?php echo (imageurl($imgUrl)); ?>',
			success: function () {
				alert('分享成功！');
			}
		};
		wx.hideAllNonBaseMenuItem();
		wx.onMenuShareAppMessage(shareData);
		wx.onMenuShareTimeline(shareData);
	});
});
seajs.use("wxShare");
</script><?php endif; ?>

	
<script>
seajs.use(['jquery'],function($){
	$(window).on('scroll', windowScroll);		
});
function windowScroll() {
	var scrollTop = $(window).scrollTop();
	var headerHeight = $(".banner").height();
	if (scrollTop >= headerHeight) {
		$(".detail-bars").css({
			position: "fixed",
			top: 0,
			left: "auto",
			width: '100%',
			zIndex: 1,
			background: "#fff"
		});
	}else {
		$(".detail-bars").removeAttr("style")
	}
}
function scrollto(div) {
    var eve = window.event || arguments.callee.caller.arguments[0];
    var obgTarget = eve.target || eve.srcElement;
    var top = $(div).offset().top - 42;
    $("body,html").animate({ scrollTop: top }, 500);
}
</script>
<!--服务体系-->
<div class="service-layer" id="service-layer" style="display:none;">
    <div class="service-content">
        <div class="service-title">服務承諾</div>
			<div class="the-service">
				<div class="title">
					<span class="service huo">貨到付款</span>
				</div>
				<div class="content">配送員上門送貨後收取貨款</div>
			</div>
			<div class="the-service">
				<div class="title">
					<span class="service quality">品質保證</span>
				</div>
				<div class="content">商品均為品牌授權正品</div>
			</div>
			<div class="the-service">
				<div class="title">
					<span class="service sevendays">七天退換</span>
				</div>
				<div class="content">簽收商品當天期7天內為鑒賞期，鑒賞期內對商品不滿意可申請退貨</div>
			</div>
			<div class="the-service">
				<div class="title">
					<span class="service shouhou">售後服務</span>
				</div>
			<div class="content">7*24小時售後服務，您可以隨時與我們聯繫</div>
		</div>
		<div class="finish" id="service-close">關&nbsp;&nbsp;閉</div>
    </div>
</div>
<script>
    var showC = document.getElementById('service-item');
	var showB = document.getElementById('service-close');
    var showA = document.getElementById('service-layer');
    showC.onclick = function () {
		showA.style.display="block";
    }
	showB.onclick = function () {
		showA.style.display="none";
    }
</script>

</div>


<?php if(isset($_GET['buildHtml'])): ?><script type="text/javascript">
seajs.use(['jquery/query','jquery/cookie'],function(){var ac = $.query.get('ac');ac=ac?ac:$.query.get('gzid');if(ac){ $.cookie('ac',ac);$('input[name=channel_id]').val(ac);}})
</script><?php endif; ?>

</body>
</html>