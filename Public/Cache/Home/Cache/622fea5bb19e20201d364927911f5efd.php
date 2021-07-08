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
<?php if(!empty($akmallConfig["lazyload"])): ?><script type="text/javascript">seajs.use(['jquery/lazyload'], function() {	$(".akmall-detail-content img").lazyload({ placeholder : "__PUBLIC__/akmall/akmall.gif",effect : "fadeIn",threshold:500})});</script><?php endif; ?><!--[if lt IE 9]><style>.header h1,.footer{color:#666;}</style><![endif]--><style>.akmallDay,.akmallHour,.akmallMinute,.akmallSecond{margin:0 2px;padding:1px 3px;background:#000;color:#fff;}</style><div class="wrapper akmall-detail-wrap">	<div class="mui-content"> <!--产品轮播--><div class="banner">    <?php if(!empty($info["slideshow"])): ?><div class="newbanner">	  <div class="newflexslider">		<ul class="newslides">			<?php $_result=explode(',',$info['slideshow']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><img src="<?php echo (imageurl($vo)); ?>" /></li><?php endforeach; endif; else: echo "" ;endif; ?>		</ul>	  </div>	</div>	<script type="text/javascript">	seajs.use(['jquery/newflexslider'], function(){ $('.newflexslider').newflexslider({ directionNav: true, pauseOnAction: false,newslideshowSpeed:3000 });});	</script><?php endif; ?></div><div class="divVideoc1"></div><!--产品轮播-->     <div class="clear"></div>	<div class="detail-context" style="border-bottom: 1px dashed #dcdcdc;padding:10px 2px;height:50px;">		<div class="dc-price" style="background:#fff;">			<span class="s-price" style="font-size:24px"><?php echo lang('symbol'); echo (floatval($info["price"])); ?></span>			<span class="o-price" style="font-size:12px"><?php echo lang('symbol'); echo (floatval($info["original_price"])); ?></span>		</div>		<?php if(!empty($info["tags"])): $_result=explode('#',$info['tags']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="flag" style="font-size: 12px;"><?php echo ($vo); ?></span><?php endforeach; endif; else: echo "" ;endif; endif; ?>	</div>	<div class="clear"></div>	<div class="detail-7day" style="height:auto; overflow:hidden;padding:8px 5px;border-bottom: 1px dashed #dcdcdc;">        <span class="freeshipping"><?php echo lang('freeshipping');?></span>        <span class="timeWrap" style="">        <?php echo lang('countdown');?>        <?php if(!empty($info["timer"])): ?><span id="timer">			<span id="akmall-timer" class="akmall-timer">			<span class="akmallDay"><strong>0</strong></span><span class="akmallHour"><strong>00</strong></span><span>:</span><span class="akmallMinute"><strong>00</strong></span><span>:</span><span class="akmallSecond"><strong>00</strong></span>			</span>			<script type="text/javascript">				seajs.use(['akmall'],function(akmall) {					akmall.timer('#akmall-timer', '<?php echo ($info["timer"]); ?>');				})			</script>		</span><?php endif; ?>    </span>    </div><div class="clear"></div><div class="detail-number" style="height:36px;border-bottom: 1px dashed #dcdcdc;margin-top:0px;padding:7px 5px;">    <span style="display:block;float:left"><?php echo lang('sold');?> <?php echo ($info["salenum"]); ?></span>    <span style="width:120px; height:5px;border:1px solid #f00;display: block;float:left;margin:7px">            <span style="width:96%; height:4px;background:#f00;display: block;"></span>        </span>    <span>96%</span></div><div class="clear"></div><div class="detail-profile">    <span style="color: rgb(255, 0, 0);"><?php echo ($info["name"]); ?></span></div>        		<ul class="detail-bars akmall-detail-wrap">            <li><a href="javascript:;" onclick="scrollto('#detial-context')" class="scrollBar" scroll-y="0"><?php echo lang('itemDescription');?></a></li>            <li><a href="javascript:;" onclick="scrollto('#akmallOrder')" class="scrollBar" scroll-y="50"><?php echo lang('buyInfo');?></a></li>            <li><a href="javascript:;" onclick="scrollto('#akmall-comments')" class="scrollBar" scroll-y="85"><?php echo lang('comments');?></a></li>        </ul>        <div class="clear">        </div>		        <div class="detail-block" id="detial-context" style="padding-top:10px">			<?php echo ($info['content']); ?>		</div>				        <div class="clear"></div>    </div>	
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
<script>seajs.use(['jquery'],function($){	$(window).on('scroll', windowScroll);		});function windowScroll() {	var scrollTop = $(window).scrollTop();	var headerHeight = $(".banner").height();	if (scrollTop >= headerHeight) {		$(".detail-bars").css({			position: "fixed",			top: 0,			left: "auto",			width: '100%',			zIndex: 1,			background: "#fff"		});	}else {		$(".detail-bars").removeAttr("style")	}}function scrollto(div) {    var eve = window.event || arguments.callee.caller.arguments[0];    var obgTarget = eve.target || eve.srcElement;    var top = $(div).offset().top - 42;    $("body,html").animate({ scrollTop: top }, 500);}</script>		</div>

<?php if(isset($_GET['buildHtml'])): ?><script type="text/javascript">
seajs.use(['jquery/query','jquery/cookie'],function(){var ac = $.query.get('ac');ac=ac?ac:$.query.get('gzid');if(ac){ $.cookie('ac',ac);$('input[name=channel_id]').val(ac);}})
</script><?php endif; ?>

</body>
</html>