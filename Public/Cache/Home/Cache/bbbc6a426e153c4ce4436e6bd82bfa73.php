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

<div class="mainwidth">
	<h4 class="meminfo"><div class="infoleft "><span class="name"><?php echo lang('order_query');?></span></div></h4>
	<div class="akmall-query-wrap">
		<dl class="query_form">
			<form action="<?php echo C('akmall_ROOT');?>index.php?m=Order&a=query" method="post" id="akmallForm" class="clearfix">
				<input name="kw" required="required" class="query_text" type="text" placeholder="<?php echo lang('mobile_/_order_number');?>">
				<input type="submit" id="akmall-query-btn" class="query_button" value="<?php echo lang('order_query');?>">
			</form>
			<div class="query_result" id="akmall-query-result"></div>
		</dl>
	</div>
</div>

<script id="akmall-query" type="text/html">
<ul>
    {{each list as value i}}
        <li>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<th><?php echo lang('order_colon');?>{{value.order_no}}</th>
					<th width="80"><?php echo lang('status');?></th>
					<th width="100"><?php echo lang('quantity_price');?></th>
					<th width="150"><?php echo lang('booking_time');?></th>
				</tr>
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
					</td>
					<td>
						{{value.status}}
						<!-- {{if value.order_status=='0' && value.payment!='1' && value.payment!='6'}}
						<p><a href="<?php echo C('akmall_ROOT');?>index.php?m=Order&a=pay&order_no={{value.order_no}}" class="links" target="_blank">[<?php echo lang('pay');?>]</a></p>
						{{/if}} -->
					</td>
					<td>{{value.quantity}}/<span class="price">{{value.price}}</span></td>
					<td>{{value.time}}</td>
				</tr>
			</table>
		</li>
    {{/each}}
</ul>
</script>
<script type="text/javascript">
seajs.use(['akmall','jquery/form','art/template'],function(akmall,form,template){
	$('#akmallForm').ajaxForm({
		timeout: 50000,
		dataType: 'json',
		error:function(){  layer.closeAll(); alert(lang.ajaxError); },
		beforeSubmit:function(){ layer.closeAll();layer.load(); },
		success:function(data){
			layer.closeAll();
			if(data.status=='1'){
			console.log(data.data);
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