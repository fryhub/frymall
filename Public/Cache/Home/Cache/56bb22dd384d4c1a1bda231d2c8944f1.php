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

<div class="akmall-order-wrap clearfix">
    <div class="akmall-detail-wrap">
        <?php echo ($info["content"]); ?>
		
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
                        if(window!=window.top){
                           	window.top.location.href = redirect.replace('__orderNo__',data.data.order_no);
                      	}else{
                        	 window.location.href = redirect.replace('__orderNo__',data.data.order_no);
                        }
                    }else{
                        btnSubmit.attr('disabled',false).val(lang.submit);
                        layer.msg(data.info);
                    }
                }
            });
        });
        if(self!=top){
            height();window.onresize=function(){height();}
            function height(){ try{var height=parseInt(document.body.clientHeight);parent.window.document.getElementById("akmallIframe").height = height;}catch (ex){console.log(ex);}}
        }
        </script>
    </div>
</div>




<?php if(isset($_GET['buildHtml'])): ?><script type="text/javascript">
seajs.use(['jquery/query','jquery/cookie'],function(){var ac = $.query.get('ac');ac=ac?ac:$.query.get('gzid');if(ac){ $.cookie('ac',ac);$('input[name=channel_id]').val(ac);}})
</script><?php endif; ?>

</body>
</html>