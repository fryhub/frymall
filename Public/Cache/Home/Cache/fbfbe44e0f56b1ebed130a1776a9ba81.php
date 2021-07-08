<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html <?php if( C('DEFAULT_LANG') == 'arab-ae' OR C('DEFAULT_LANG') == 'arab-sa' OR C('DEFAULT_LANG') == 'arab-jor' OR C('DEFAULT_LANG') == 'arab-omn' ): ?>dir="rtl"<?php endif; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(!empty($info["name"])): echo ($info["name"]); ?> -<?php endif; ?> <?php echo ($akmallConfig["title"]); ?></title>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="yes" name="apple-touch-fullscreen"/>
<meta content="telephone=no" name="format-detection"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0, user-scalable=no" name="viewport">
<meta name="MobileOptimized" content="640">
<meta name="description" content="<?php if(!empty($info["brief"])): echo ($info["brief"]); else: echo ($akmallConfig["description"]); endif; ?>">
<meta name="keywords" content="<?php if(!empty($info["name"])): echo ($info["name"]); ?>|<?php endif; echo ($akmallConfig["keywords"]); ?>">
<meta name="author" content="<?php echo lang('author');?>">
<link rel="shortcut icon" href="__PUBLIC__/Assets/img/akmall.ico" />
<link href="__PUBLIC__/akmall/Item/style.css?v=<?php echo (AKMALL_VERSION); ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/akmall/seajs/seajs/sea.js"></script>
<script type="text/javascript">
var akmallHost = "<?php echo ($akmallHost); ?>",akmallRoot = "<?php echo C('akmall_ROOT');?>",lang="<?php echo C('DEFAULT_LANG');?>";
seajs.config({ base: '__PUBLIC__/akmall/seajs/',alias: {'jquery': 'jquery/jquery','akmall': 'akmall/akmall','lang': 'akmall/lang-'+lang}});
seajs.use(['jquery'], function($){ 
$('.search_button').click(function(){ $('.search_submit').show(); $('.search_input').show().animate({width:'100%'}).focus();})
$('.search_input').blur(function(){ $(this).animate({width:'0'},500,function(){ $(this).hide();$('.search_submit').hide();}); })
});
</script>
<?php if(!empty($akmallConfig["theme_color"])): ?><style> 
	.header,.btn{background-color: #<?php echo $akmallConfig['theme_color']; ?>;}
	.tabs-nav a.active {color:#<?php echo $akmallConfig['theme_color']; ?>;border-bottom-color:#<?php echo $akmallConfig['theme_color']; ?>;}
	.side-menu a.active{border-left-color:#<?php echo $akmallConfig['theme_color']; ?>;}
	.btn-buy,.akmall-foot-nav{background-color:#<?php echo $akmallConfig['theme_color']; ?> !important;}
	.booking-now,.akmall-btn,.akmall-plug .price,.akmall-badge{background-color: #<?php echo $akmallConfig['theme_color']; ?> !important;border-color: #<?php echo $akmallConfig['theme_color']; ?> !important;}
	.akmall-btn.active {color:#<?php echo $akmallConfig['theme_color']; ?>;border-bottom-color:#<?php echo $akmallConfig['theme_color']; ?>;}
</style><?php endif; ?>

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
</head>

<body class="<?php echo ($akmallConfig["system_theme"]); ?> <?php if( C('DEFAULT_LANG') == 'arab-ae' OR C('DEFAULT_LANG') == 'arab-sa' OR C('DEFAULT_LANG') == 'arab-jor' OR C('DEFAULT_LANG') == 'arab-omn' ): ?>arab<?php endif; ?>">

<?php if(!empty($akmallConfig["notice"])): ?><div class="akmallAlert"><a class="close" onclick="$('.akmallAlert').slideUp(500);">×</a><?php echo ($akmallConfig["notice"]); ?></div><?php endif; ?>
<?php if(!empty($akmallConfig["show_header"])): ?><div class="header">
	<div class="back"><a href="javascript:history.go(-1)"><img src="__PUBLIC__/akmall/Item/icon-goback.svg"></a></div> 
	<div class="wrap">
		<a class="logo" href="<?php echo U('Item/index');?>"><img src="<?php if(empty($akmallConfig["logo"])): ?>__PUBLIC__/Assets/img/logo.png<?php else: echo (imageurl($akmallConfig["logo"])); endif; ?>" alt="<?php echo ($akmallConfig["title"]); ?>" /></a>
	</div>
	<div class="search">
		<form method="get" action="<?php echo U('Item/category');?>" class="searchform">
			<input type="hidden" name="m" value="Item">
			<input type="hidden" name="a" value="category">
			<input type="text" name="kw" class="search_input" value="<?php echo (trim($_GET['kw'])); ?>" placeholder="<?php echo lang('search');?>">
			<button type="button" class="search_button"></button>
			<button type="submit" class="search_submit"></button>
		</form>
	</div> 
</div>

<?php else: ?>
<style>.tab_menu{top:0;}.subnav{display:none;}</style><?php endif; ?>


<?php if(!empty($slider)): ?><div class="newbanner">
  <div class="newflexslider">
    <ul class="newslides">
		<?php if(is_array($slider)): $i = 0; $__LIST__ = $slider;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["link"]); ?>" target="<?php echo ($vo["target"]); ?>"><img src="<?php echo (imageurl($vo["image"])); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
</div>
<script type="text/javascript">
seajs.use(['jquery/newflexslider'], function(){ $('.newflexslider').newflexslider({ directionNav: true, pauseOnAction: false,newslideshowSpeed:3000 });});
</script><?php endif; ?>

<?php $brand = M('Category')->where('type=1 and image!=""')->order('sort_order asc')->select(); if($brand){ ?>
<div class="newmain background" style="margin-bottom:8px;">
	<!-- <div class="indextit"> 热门品牌<span>HotBrand</span></div> -->
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="brandico">
	  <tbody>
	  <tr>
	  <?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($key > 0 AND $key%4 == 0): ?></tr><tr><?php endif; ?>
		<td class="f1"><div align="center"><a class="links" href="<?php echo U('Item/category',array('id'=>$vo['id']));?>"><img src="<?php echo (imageurl($vo["image"])); ?>"></a><span><?php echo ($vo["name"]); ?></span></div></td><?php endforeach; endif; else: echo "" ;endif; ?>
	  </tr>
	</tbody>
	</table>
</div>
<?php } ?>

<?php echo W('Item',$hot);?>
<?php echo W('Tabs',array('status'=>$akmallConfig['item_category_show'],'id'=>$akmallConfig['item_category_id'],'num'=>$akmallConfig['item_category_num']));?>


	<div class="newmain footer"><?php echo ($akmallConfig["footer"]); ?></div>
	<div class="clear ptop"></div>
	
	<?php if(!empty($akmallConfig["foot_info"])): ?><div class="akmall-foot-info" style="position:fixed;z-index:100;height: 45px;line-height: 45px;bottom:46px;text-align:center;background:#f60;color:#fff;width:100%;"><?php echo ($akmallConfig["foot_info"]); ?></div><?php endif; ?>
	<?php if(!empty($akmallConfig["show_bottom_nav"])): ?><div class="nav2">
		<!-- <?php $navArray = explode("<br />",nl2br($akmallConfig['footer_nav'])); foreach($navArray as $li){ $nav[] = explode('||',$li);} $width = 100/(count($nav)+1); ?> -->
			
		<li style="width:33.3%"><a href="<?php echo U('Item/index');?>"><span><img src="__PUBLIC__/akmall/Item/icon-home.svg"></span><p><?php echo lang('index');?></p></a></li>
		<li style="width:33.3%"><a href="index.php?m=Item&a=category"><span><img src="__PUBLIC__/akmall/Item/icon-menu.svg"></span><p><?php echo lang('category');?></p></a></li>
		<li style="width:33.3%"><a href="index.php?m=Item&a=query"><span><img src="__PUBLIC__/akmall/Item/icon-newspaper.svg"></span><p><?php echo lang('query');?></p></a></li>
		<!-- <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $ico = isset($vo[2])?$vo[2]:'newspaper'; $vo[1] = strpos($vo[1],'index.php')===0?C('akmall_ROOT').$vo[1]:$vo[1]; ?>
		<li style="width:<?php echo ($width); ?>%"><a href="<?php echo ($vo[1]); ?>"><span><img src="__PUBLIC__/akmall/Item/icon-<?php echo ($ico); ?>.svg"></span><p><?php echo ($vo[0]); ?></p></a></li><?php endforeach; endif; else: echo "" ;endif; ?> -->
	</div><?php endif; ?>
<script type="text/javascript">
seajs.use(['jquery/scrollup'], function(){ $.scrollUp({scrollName: 'akmallUp'}); });
</script>
</body>
</html>