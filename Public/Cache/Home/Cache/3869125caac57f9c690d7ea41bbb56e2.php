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

<link href="<?php echo C('akmall_ROOT');?>Public/akmall/pc/akmall.css?v=<?php echo (AKMALL_VERSION); ?>" rel="stylesheet">
<?php if(!empty($akmallConfig["lazyload"])): ?><script type="text/javascript">
seajs.use(['jquery/lazyload'], function() {
	$(".akmall-detail-content img").lazyload({ placeholder : "<?php echo C('akmall_ROOT');?>Public/akmall/akmall.gif",effect : "fadeIn",threshold:500});
});
</script><?php endif; ?>
<?php if(!empty($info["timer"])): ?><script type="text/javascript">seajs.use(['akmall','jquery/form','lang'],function(akmall) { akmall.timer('#akmall-timer', '<?php echo ($info["timer"]); ?>'); })</script><?php endif; ?>

</head>
<body <?php if( C('DEFAULT_LANG') == 'arab-ae' OR C('DEFAULT_LANG') == 'arab-sa' OR C('DEFAULT_LANG') == 'arab-jor' OR C('DEFAULT_LANG') == 'arab-omn' ): ?>class="arab"<?php endif; ?>>

<?php if(!empty($akmallConfig["notice"])): ?><div class="akmallAlert"><a class="close" onclick="$('.akmallAlert').slideUp(500);">×</a><?php echo ($akmallConfig["notice"]); ?></div><?php endif; ?>


<div class="header">
	<div class="mainwidth">
		<div class="headtop">
			<span class="place cur_city_name">
				<form action="<?php echo U('Index/category');?>" method="get" class="search_form">
					<input type="text" name="kw" class="search_input" placeholder="<?php echo lang('item_search');?>" value="<?php echo ($_GET['kw']); ?>" />
					<input type="submit" value="" class="search_button">
					<input type="hidden" name="m" value="Index" class="search_button">
					<input type="hidden" name="a" value="category" class="search_button">
				</form>
			</span>
			
			<div class="topright">
				<?php  ?>
				<a href="<?php echo U($wap_theme.'/index');?>" class="phone"><?php echo lang('themeMobile');?></a>
			</div>
			
		</div>
		<div class="logobox">
			<a href="<?php echo ($akmallHost); ?>" class="logo">
				<img title="<?php echo ($akmallConfig["title"]); ?>" alt="<?php echo ($akmallConfig["title"]); ?>" src="<?php if(empty($akmallConfig["logo_pc"])): ?>__PUBLIC__/akmall/pc/logo.png<?php else: echo (imageurl($akmallConfig["logo_pc"])); endif; ?>">
			</a>
		</div>
		<div class="nav">
		<?php if(empty($akmallConfig["header_nav"])): ?><ul>
				<li <?php if((ACTION_NAME) == "index"): ?>class="active"<?php endif; ?>><a href="<?php echo U('Index/index');?>"><span data-hover="<?php echo lang('index');?>"><?php echo lang('index');?></span></a></li>
				<li class="li_2"><a href="index.php?m=Index&a=category"><span data-hover="<?php echo lang('item_category');?>"><?php echo lang('item_category');?></span></a></li>
				<li class="li_3"><a href="index.php?m=Index&a=query"><span data-hover="<?php echo lang('order_query');?>"><?php echo lang('order_query');?></span></a></li>
				<li class="li_4"><a href="index.php?m=Index&a=article"><span data-hover="<?php echo lang('article');?>"><?php echo lang('article');?></span></a></li>
			</ul><?php endif; ?>
		<?php if(!empty($akmallConfig["header_nav"])): $navArray = explode("<br />",nl2br($akmallConfig['header_nav'])); foreach($navArray as $li){ $navArr = explode('||',$li); $navArr[1] = strpos($navArr[1],'index.php')===0?C('akmall_ROOT').$navArr[1]:$navArr[1]; $nav[] = $navArr; } ?>
			<ul>
				<li <?php if((ACTION_NAME) == "index"): ?>class="active"<?php endif; ?>><a href="<?php echo U('Index/index');?>"><span data-hover="<?php echo lang('index');?>"><?php echo lang('index');?></span></a></li>
				<?php if(isset($nav[0])): ?><li class="li_2"><a href="<?php echo ($nav[0][1]); ?>"><span data-hover="<?php echo ($nav[0][0]); ?>"><?php echo ($nav[0][0]); ?></span></a></li><?php endif; ?>
				<?php if(isset($nav[1])): ?><li class="li_3"><a href="<?php echo ($nav[1][1]); ?>"><span data-hover="<?php echo ($nav[1][0]); ?>"><?php echo ($nav[1][0]); ?></span></a></li><?php endif; ?>
				<?php if(isset($nav[2])): ?><li class="li_4"><a href="<?php echo ($nav[2][1]); ?>"><span data-hover="<?php echo ($nav[2][0]); ?>"><?php echo ($nav[2][0]); ?></span></a></li><?php endif; ?>
			</ul><?php endif; ?>
		</div>
	</div>
</div>
<?php if(!empty($akmallConfig["theme_color"])): ?><style> 
	.booking-now,.akmall-btn,.akmall-plug .price,.akmall-badge{background-color: #<?php echo $akmallConfig['theme_color']; ?> !important;border-color: #<?php echo $akmallConfig['theme_color']; ?> !important;}
	.akmall-btn.active {color:#<?php echo $akmallConfig['theme_color']; ?>;border-bottom-color:#<?php echo $akmallConfig['theme_color']; ?>;}
	.side-menu a.active{border-left-color:#<?php echo $akmallConfig['theme_color']; ?>;}
	.btn-buy,.akmall-foot-nav{background-color:#<?php echo $akmallConfig['theme_color']; ?> !important;}
</style><?php endif; ?>

<div class="mainwidth" id="akmall-show-bar">
	<div class="akmall-detail-header clearfix">
		<div class="mainwidth header-wrap">
			<?php $buyNow = strstr($info['content'],'akmallOrder')?'#akmallOrder':U('Order/index',array('id'=>$info['sn'],'track'=>'purchase')); ?>
			<a class="booking-now CartButton" href="<?php echo ($buyNow); ?>"><?php echo lang('bookingNow');?></a>
			<?php if(!empty($info["image"])): ?><h1 class="title"><img src="<?php echo (imageurl($info["image"])); ?>"></h1><?php endif; ?>
			<dl>
				<dt class="ellipsis"><?php echo ($info["name"]); ?>
					<?php if(!empty($info["tags"])): $_result=explode('#',$info['tags']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="akmall-badge"><?php echo ($vo); ?></span><?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</dt>
				<dd class="ellipsis"><?php echo ($info["brief"]); ?></dd>
			</dl>
		</div>
	</div>
</div>

<!--修改pc前台内容-->
	<div class="akmall-page">
		
		<?php if(!empty($info["slideshow"])): ?><div class="box box-image">
			<div class="newbanner">
			  <div class="newflexslider">
				<ul class="newslides">
					<?php $_result=explode(',',$info['slideshow']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><img src="<?php echo (imageurl($vo)); ?>" /></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			  </div>
			</div>
			<script type="text/javascript">
			seajs.use(['jquery/newflexslider'], function(){ $('.newflexslider').newflexslider({ directionNav: true, pauseOnAction: false,newslideshowSpeed:4000 });});
			</script>
		</div><?php endif; ?>
		
		<div class="box akmallbox-1">
			<!--<h2 class="title"><?php echo lang('purchase');?></h2>-->
			<div class="box-content">
				<div class="akmall-plug clearfix">
					<div class="price" <?php if(empty($info["timer"])): ?>style="width:100%;"<?php endif; ?>>
						<span class="symbol"><?php echo lang('symbol');?></span>
						<span class="current-price"><?php echo (floatval($info["price"])); ?></span>
						<span class="group">
							<?php if(floatval($info['original_price']) > 0): ?><del class="original-price"><?php echo lang('symbol'); echo ($info["original_price"]); ?></del>
							<?php else: ?><span class="original-price" style="height:10px;">&nbsp;</span><?php endif; ?>
							<?php if(!empty($info["salenum"])): ?><span class="salenum"><?php echo lang('sold'); echo ($info["salenum"]); ?></span><?php endif; ?>
						</span>
					</div>
					<?php if(!empty($info["timer"])): ?><div class="timer">
						<p class="tt"><?php echo lang('countdown');?></p>
						<div id="akmall-timer" class="akmall-timer">
						<span class="akmallDay"><strong>0</strong></span><span class="akmallHour"><strong>00</strong></span><span>:</span><span class="akmallMinute"><strong>00</strong></span><span>:</span><span class="akmallSecond"><strong>00</strong></span>
						</div>
						<script type="text/javascript">
							seajs.use(['akmall'],function(akmall) {
								akmall.timer('#akmall-timer', '<?php echo ($info["timer"]); ?>');
							})
						</script>
					</div><?php endif; ?>
				</div>
				
				<div class="akmall-content-title">
					<h1><?php echo ($info["name"]); ?></h1>
					<p><?php echo ($info["brief"]); ?></p>
				</div>
				<div class="baoyou">
					<span class="by"><?php echo lang('freeShipping');?></span>
					<span class="huo"><?php echo lang('cashOnDelivery');?></span>
					<span class="tui"><?php echo lang('refund');?></span>
				</div>
				<div class="gou CartButton">
					<?php $buyNow = strstr($info['content'],'akmallOrder')?'#akmallOrder':U('Order/index',array('id'=>$info['sn'],'track'=>'purchase')); ?>
					<a href="<?php echo ($buyNow); ?>"><?php echo lang('buyNow');?></a>
				</div>
				<?php if(!empty($akmallConfig["contact_tel"])): ?><div class="contact tel"><i class="icon-tel"></i><a href="tel:<?php echo ($akmallConfig["contact_tel"]); ?>"><?php echo lang('BuybyMobile'); echo ($akmallConfig["contact_tel"]); ?></a></div><?php endif; ?>
				<?php if(!empty($akmallConfig["contact_phone"])): ?><div class="contact phone"><i class="icon-phone"></i><a href="sms:<?php echo ($akmallConfig["contact_phone"]); ?>"><?php echo lang('BuybySMS'); echo ($akmallConfig["contact_phone"]); ?></a></div><?php endif; ?>
				<?php if(!empty($akmallConfig["contact_facebook"])): ?><div class="contact facebook"><i class="icon-facebook"></i><a target="_blank" href="<?php echo ($akmallConfig["contact_facebook"]); ?>"><?php echo lang('FacebookPage');?></a></div><?php endif; ?>
				<?php if(!empty($akmallConfig["contact_messenger"])): ?><div class="contact messenger"><i class="icon-messenger"></i><a target="_blank" href="<?php echo ($akmallConfig["contact_messenger"]); ?>"><?php echo lang('Messenger');?></a></div><?php endif; ?>
				<?php if(!empty($akmallConfig["contact_line"])): ?><div class="contact line"><i class="icon-line"></i><a target="_blank" href="<?php echo ($akmallConfig["contact_line_url"]); ?>"><?php echo lang('Line'); echo ($akmallConfig["contact_line"]); ?></a></div><?php endif; ?>
				<?php if(!empty($akmallConfig["contact_whatsapp"])): ?><div class="contact whatsapp"><i class="icon-whatsapp"></i><a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo ($akmallConfig["contact_whatsapp"]); ?>"><?php echo lang('WhatsApp'); echo ($akmallConfig["contact_whatsapp"]); ?></a></div><?php endif; ?>
				<?php if(!empty($akmallConfig["contact_qq"])): ?><div class="contact contact_qq"><i class="icon-qq"></i><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($akmallConfig["contact_qq"]); ?>&site=qq&menu=yes"><?php echo lang('contactQQ'); echo ($akmallConfig["contact_qq"]); ?></a></div><?php endif; ?>
				<br />
				
			</div>
		</div>
	</div>
<!--修改pc前台内容-->

<div class="container">
	<div class="mainwidth">




    <script type="text/javascript">
		seajs.use(['jquery'], function() {
			$(window).scroll(function(){
				var winHeight = $(this).height(),orderTop = $('.akmall-order').offset().top,docTop = $(document).scrollTop(),nav=$('.akmall-foot-nav'),navHeight=nav.height();
				if(docTop+winHeight/2>=orderTop){ nav.slideUp(); }else{ nav.slideDown(); }
			})
			var elm = $('#akmall-show-bar'); 
			var startPos = $(elm).offset().top; 
			$.event.add(window, "scroll", function() { 
				var p = $(window).scrollTop(); 
				if(((p) > startPos)){ elm.addClass('akmall-fixed'); }else{ elm.removeClass('akmall-fixed'); }
			}); 
		});
		</script>
		<div class="akmall-detail-wrap clearfix">
			<div class="akmall-detail-content"><?php echo ($info["content"]); ?></div>
			
			<?php echo W('Relate',array_merge($info,array('moduel'=>'Index')));?>
		</div>
	</div>
</div>

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
				top.window.location.href = redirect.replace('__orderNo__',data.data.order_no);
			}else{
				btnSubmit.attr('disabled',false).val(lang.submit);
				layer.msg(data.info);
			}
		}
	});
});
</script>


    <div class='akmall-remark'><?php echo ($info['remark']); ?></div>
    <div class="footer">
	<div class="mainwidth">
		<?php if(empty($akmallConfig['contact_tel']) && empty($akmallConfig['contact_phone']) && empty($akmallConfig['contact_facebook']) && empty($akmallConfig['contact_messenger']) && empty($akmallConfig['contact_line']) && empty($akmallConfig['contact_whatsapp']) && empty($akmallConfig['contact_qq'])): ?><style>.akmall-copyright{width:100% !important;padding-right:0 !important;border-right:none !important;text-align:center;}.akmall-contact{display:none !important;}</style><?php endif; ?>
		<ul class="footcon">
			<li class="akmall-copyright">
				<div class="copyright"><?php echo ($akmallConfig["footer"]); ?></div>
			</li>
			<li class="akmall-contact">
				<div class="foottel">
					<?php if(!empty($akmallConfig["contact_tel"])): ?><span class="tell"><?php echo lang('serviceNumber');?><span class="num"><?php echo ($akmallConfig["contact_tel"]); ?></span></span><?php endif; ?></br>
					<?php if(!empty($akmallConfig["contact_phone"])): ?><a href="sms:<?php echo ($akmallConfig["contact_phone"]); ?>"><span class="foot-icon phone"><i class="icon-phone"></i></span></a><?php endif; ?>
					<?php if(!empty($akmallConfig["contact_facebook"])): ?><a target="_blank" href="<?php echo ($akmallConfig["contact_facebook"]); ?>"><span class="foot-icon facebook"><i class="icon-facebook"></i></span></a><?php endif; ?>
					<?php if(!empty($akmallConfig["contact_messenger"])): ?><a target="_blank" href="<?php echo ($akmallConfig["contact_messenger"]); ?>"><span class="foot-icon messenger"><i class="icon-messenger"></i></span></a><?php endif; ?>
					<?php if(!empty($akmallConfig["contact_line"])): ?><a target="_blank" href="<?php echo ($akmallConfig["contact_line_url"]); ?>"><span class="foot-icon line"><i class="icon-line"></i></span></a><?php endif; ?>
					<?php if(!empty($akmallConfig["contact_whatsapp"])): ?><a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo ($akmallConfig["contact_whatsapp"]); ?>"><span class="foot-icon whatsapp"><i class="icon-whatsapp"></i></span></a><?php endif; ?>
					<?php if(!empty($akmallConfig["contact_qq"])): ?><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($akmallConfig["contact_qq"]); ?>&site=qq&menu=yes"><span class="foot-icon contact_qq"><i class="icon-qq"></i></span></a><?php endif; ?>
				</div>
				
			</li>
		</ul>
	</div>
</div>
<div id="akmallUp"></div>
<script type="text/javascript">
seajs.use(['jquery/scrollup'], function(){ $.scrollUp({scrollName: 'akmallUp'}); });
</script>

<?php if(isset($_GET['buildHtml'])): ?><script type="text/javascript">
seajs.use(['jquery/query','jquery/cookie'],function(){var ac = $.query.get('ac');ac=ac?ac:$.query.get('gzid');if(ac){ $.cookie('ac',ac);$('input[name=channel_id]').val(ac);}})
</script><?php endif; ?>

</body>
</html>