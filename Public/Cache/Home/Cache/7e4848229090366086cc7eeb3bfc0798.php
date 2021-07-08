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

<link href="__PUBLIC__/akmall/pc/akmall.css?v=<?php echo (AKMALL_VERSION); ?>" rel="stylesheet">
<script type="text/javascript">
seajs.use(['jquery/lazyload'], function() {
	$(".akmall-lazy").lazyload({ placeholder : "__PUBLIC__/akmall/akmall.gif",effect : "fadeIn"});
});
</script>

</head>
<body <?php if( C('DEFAULT_LANG') == 'arab-ae' OR C('DEFAULT_LANG') == 'arab-sa' OR C('DEFAULT_LANG') == 'arab-jor' OR C('DEFAULT_LANG') == 'arab-omn' ): ?>class="arab"<?php endif; ?>>

<?php if(!empty($akmallConfig["notice"])): ?><div class="akmallAlert"><a class="close" onclick="$('.akmallAlert').slideUp(500);">×</a><?php echo ($akmallConfig["notice"]); ?></div><?php endif; ?>

<div class="pbody">
	
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


<div class="container">
	<div class="mainwidth">
		
		<?php if(!empty($slider)): ?><div class="newbanner">
		  <div class="newflexslider">
			<ul class="newslides">
				<?php if(is_array($slider)): $i = 0; $__LIST__ = $slider;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["link"]); ?>" target="<?php echo ($vo["target"]); ?>"><img src="<?php echo (imageurl($vo["banner"])); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		  </div>
		</div>
		<script type="text/javascript">
		seajs.use(['jquery/newflexslider'], function(){ $('.newflexslider').newflexslider({ directionNav: true, pauseOnAction: false,newslideshowSpeed:5000 });});
		</script><?php endif; ?>


	<?php if(!empty($hot["list"])): ?><div class="indprocon">
		<div class="toptitle">
			<span class="titlein"><strong><?php echo lang('newArrival');?> / <span class="en">New Products</span></strong></span>
		</div>
		
		<ul class="indprolist">
			<?php if(is_array($hot["list"])): $i = 0; $__LIST__ = $hot["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
				<div class="img">
				<a href="<?php echo U('Index/order',array('id'=>$vo['sn']));?>">
					<img src="<?php echo (imageurl($vo["image"])); ?>" class="akmall-lazy"><span></span>
				</a>
				</div>
				<a href="<?php echo U('Index/order',array('id'=>$vo['sn']));?>" class="title" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></a>
				<span class="price">
					<?php echo lang('symbol'); echo ($vo["price"]); ?>
					<?php if(floatval($vo['original_price']) > 0): ?><del><?php echo lang('symbol'); echo ($vo["original_price"]); ?></del><?php endif; ?>
				</span>
				<span class="text"><?php echo ($vo["brief"]); ?></span>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div><?php endif; ?>

<style> 
.btn{background-color: #FF6600;}
.tabs-nav a.active {color:#FF6600;border-bottom-color:#FF6600;}
.side-menu a.active{border-left-color:#FF6600;}
.btn-buy,.akmall-foot-nav{background-color:#FF6600 !important;}
.booking-now,.akmall-btn,.akmall-plug .price,.akmall-badge{background-color: #FF6600 !important;border-color: #FF6600 !important;}
.akmall-btn.active {color:#FF6600;border-bottom-color:#FF6600;}
.newtitle{ height:auto; line-height:50px;font-size:140%; text-indent:12px; color:#444; border:1px solid #eee; border-bottom:none;background-color: #fff;text-align:center;}
.newmain dl{ display:block; }
.newmain dl dt{ margin-top:-1px;clear:both;width:100%; height:auto;position:relative;overflow:hidden;border-bottom: 1px solid #eee;border-top: 1px solid #eee;}
.newmain dl dt a.info{ height:auto; display:block; position:relative; background:#fff; border-right:1px solid #eee;}
.newmain dl dt .img{ display:block;height:auto;text-align:center;}
.newmain dl dt .img img{ height:auto;max-width:100%;}
.newmain dl dt .clear{margin-top:0px;}
.newmain_text1,.newmain_text{margin-left:-1px;border-right:1px solid #eee;padding:8px 0;width:100%;  display:block; z-index:99;text-align:center;position: relative;background: #fff;}
.newmain_text1 h4,.newmain_text1 p,.newmain_text1 em,.newmain_text h4,.newmain dl dd a p,.newmain dl dd a em{ display:block; height:3em;overflow:hidden; line-height:1.5em;}
.newmain_text1 h4,.newmain_text h4{font-size:100%;color:#333333;}
.newmain_text1 p,.newmain_text p{font-size:80%; color:#666;}
.newmain_text1 em,.newmain_text em{font-size:100%; color:#666;}
.newmain_text1 em strong,.newmain_text em strong {font-size:120%; font-weight:normal; color:#FF9933;}
.newmain dl dt .newmain_text em {right: 3%;top: 20px;}
.newmain dl dd{ width:50%; display:inline-block; height:auto;oat:left;background-color: #fff;*margin-left:-1px;position:relative;overflow:hidden;border-bottom: 1px solid #eee;border-left: 1px solid #eee;margin-left: -1px;}
.newmain dl dd a.info{height:auto; display:block; overflow:hidden; position:absolute;left:0;right:0;top:0;bottom: 0;border-right: 1px solid #eee;}
.newmain dl dd .img{display:block; height:auto;margin-top:0;text-align:center;position: relative;}
.newmain dl dd .img img{ width:100%;bottom:0;}
.newmain .data-empty{ width:100%;text-align:center;padding:5em 0;}
.akmall-item-list .clear{margin-top:80%;}
.tabs-nav a {display: inline-block;height:40px;font-size: 14px;color: #4b4b4b;background:#fff;text-align:center;overflow:hidden;border-bottom:1px solid #e3e3e3;}
.tabs-nav a  span{display: inline-block;margin:10px 0;height:20px;line-height:20px;border-left:1px solid #ccc;width:100%;text-align:center;}
.tabs-nav a:first-child  span{border:none;}
.tabs-nav a.active{color:#1faf33;border-bottom:1px solid #1faf33;}
.tabs-main{padding-top:10px;}
.newmain dl.list3{display:none;}
.newmain dl.list3 dd{width:230px !important;margin:8px;}
.newmain dl.list3 .newmain_text{top:10px;text-align:center;padding-bottom: 20px;}
.newmain dl.list3 .newmain_text em{font-size:1em;font-style:normal;}

</style>

	<?php echo W('Tabs',array('status'=>$akmallConfig['item_category_show'],'id'=>$akmallConfig['item_category_id'],'num'=>$akmallConfig['item_category_num']));?>
	
	<div class="indprocon">
		<div class="toptitle">
			<span class="titlein"><strong><?php echo lang('newsInfo');?> / <span class="en">News Infomation</span></strong></span>
		</div>
		<?php $category = M('Category')->where('type=2')->order('sort_order asc ,id asc')->limit(3)->select(); foreach($category as &$cate){ $cate['list'] = M('Article')->where('is_delete=0 and status=1 and category_id='.$cate['id'])->order('sort_order asc ,id desc')->limit(10)->select(); } ?>
		<div class="wrap clearfix">
			<?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="news-list">
				<?php if(!empty($vo["image"])): ?><div class="list-title"><a href="<?php echo U('Index/article',array('id'=>$vo['id']));?>"><img src="<?php echo (imageurl($vo["image"])); ?>" alt="<?php echo ($vo["name"]); ?>"></a></div><?php endif; ?>
				<ul>
					<?php if(is_array($vo["list"])): $i = 0; $__LIST__ = $vo["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/detail',array('id'=>$li['id']));?>" target="_blank"><?php echo ($li["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
	
</div>
    </div>
<div id="downArrowBox"></div>
</div>


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