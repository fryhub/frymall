<?php
$html = "";
$url = isset($_GET['url'])?$_GET['url']:"http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$html .= "<form action='".$host."index.php?m=Order&a=akmallBooking' method='post' id='akmallForm'><input type='hidden' name='lang' value='".C('DEFAULT_LANG')."'><input type='hidden' name='user_id' value='{$_GET['uid']}'><input type='hidden' name='user_pid' value='{$_GET['pid']}'><input type='hidden' name='sn' value='{$info['sn']}'><input type='hidden' name='item_id' value='{$info['id']}'><input type='hidden' name='item_name' value='{$info['name']}'><input type='hidden' name='item_price' id='item_price' value='".($product?$product[0]['price']:$info['price'])."'><input type='hidden' name='url' value='{$url}'><input type='hidden' name='redirect' value='".($template['redirect_uri']?$template['redirect_uri']:$url)."'><input type='hidden' name='referer' value='{$referer}'><input type='hidden' name='order_page' value='{$request['page']}'><input type='hidden' name='channel_id' value='{$cookie['ac']}'><input type='hidden' name='qrcode_pay' value='{$info['qrcode_pay']}'><input type='hidden' name='math' value='{$paymentDefault['math']}'><input type='hidden' name='page' value='{$page}'><input type='hidden' name='akmall_token' value='{$token}'><input type='hidden' name='buy_num' value='{$info['buy_num']}'><input type='hidden' name='buy_num_decrease' value='{$info['buy_num_decrease']}'>";
	
if(!empty($template['info']) && $request['page'] == 'single'){
	$html .= "<div class='akmall-brief clearfix'>{$template['info']}</div>";
}

if(!empty($product)){
$html .= "<div class='akmall-rows clearfix rows-id-params rows-id-params-{$info['params_type']} akmall-{$info['params_type']}'><label class='rows-head'>".$package.lang('request')."</label><div class='rows-params'>";
		switch ($info['params_type']) {
			case 'select':
				$html .= "<select class='akmall-params-change' name='item_params[]' akmall-fx='akmall.quantity' akmall-fx-params='0'>";
					foreach($product as $vo){
						$html .= "<option value='{$vo['title']}' value-price='{$vo['price']}'>{$vo['title']}</option>";
					}
				$html .= "</select>";
			break;
			default:
				$i=0;
				foreach($product as $vo){
					$i++;
					$html .= "<label akmall-value='{$vo['price']}' akmall-target='#item_price' akmall-fx='akmall.quantity' akmall-fx-params='0' class='".($vo['image']?' akmall-params-image':' ellipsis')." akmall-params  akmall-{$info['params_type']}".($i==0?' active ':'')."' title='{$vo['title']}'>";
					if($vo['image']){
						$html .= "<p class='item-image'><img src='".imageUrl($vo['image'])."' /></p>";
					}
					$html .= "<p class='item-desc'><input type='{$info['params_type']}' name='item_params[]' value='{$vo['title']}' ".($i==0?'checked':'').">{$vo['title']}</p></label>";
				}
			break;
		}
	$html .= "</div></div>";
}

if(!empty($extends)){
	foreach($extends as $k=>$vo){
		//if($vo['type']=='text'){continue;}
		$disabled  = '';
		if(strstr($vo['title'],'#')){
			list($index,$vo['title'])= explode('#',$vo['title'],2);
			$item_index =1;
			$level = "1";
			if($index==1){
				$disabled = '';
				$class = "extends extends-{$index}";
			}else{
				$disabled = 'disabled';
				$class = "extends extends-hidden extends-{$index}";
			}
		}
		
		if(strstr($vo['title'],'#')){
			list($index2,$vo['title'])= explode('#',$vo['title'],2);
			
			if($index2==1){
				$disabled = '';
				$class2 = "subextends subextends-{$index2}";
			}else{
				$disabled = 'disabled';
				$class2 = "subextends subextends-hidden subextends-{$index2}";
			}
			$level = "2";
		}
		
		
		$html .= "<div data-level='{$level}' class='akmall-rows clearfix rows-id-extends {$class} {$class2} extends-level-{$level} akmall-{$vo['type']}'><label class='rows-head'>{$vo['title']}".lang('request')."</label><div class='rows-params'>";
		switch ($vo['type']) {
			case 'text':
				$html .= "<input type='text' name='extends[{$vo['title']}]' placeholder='{$vo['value']}' autocomplete='off' class='akmall-input-text' {$disabled} {$disabled2}>";
			break;
			case 'password':
				$html .= "<input type='password' name='extends[{$vo['title']}]' placeholder='{$vo['value']}' autocomplete='off' class='akmall-input-text' {$disabled} {$disabled2}>";
			break;
			case 'select':
				$html .= "<select name='extends[{$vo['title']}]' {$disabled} {$disabled2}>";
					foreach(explode('#',$vo['value']) as $li){
						if(empty($li)){
							$html .= "<option value=''>".lang('pleaseSelect')."</option>";
						}else{
							$html .= "<option value='{$li}'>{$li}</option>";
						}
					}
				$html .= "</select>";
			break;
			default:
				$i=0;
				foreach(explode('#',$vo['value']) as $li){
					$i++;
					$hidden = empty($li)?'style="display:none;"':'';
					$html .= "<label class='akmall-group akmall-params akmall-{$vo['type']} ".($i==0?'active':'')."' {$hidden}><span class='akmall-group-box'><input akmall-value='{$li}' class='{$vo['type']}-{$k}' id='{$vo['title']}{$key}' name='extends[{$vo['title']}]".($vo['type']=='checkbox'?'[]':'')."' type='{$vo['type']}' value='{$li}' ".($i==0?'checked':'')." {$disabled}><label class='selected-icon' for='{$vo['title']}{$key}'></label></span>{$li}</label>";
				}
			break;
		}
		$html .= "</div></div>";	
	}		
}

foreach($params as $key=>$vo){
	if(empty($vo['checked']) || in_array($key,array('product','extends'))){ continue;}
	$html .= "<div class='akmall-rows clearfix rows-id-{$key}'><label class='rows-head'>{$vo['name']}<span class='akmall-request ".($vo['request']?'':'akmall-request-none')."'>*</span></label><div class='rows-params'>";
	switch ($key) {
				
		case 'price':
			$html .= lang('symbol')."<strong class='akmall-total-price'>".$info['price']."</strong>";
	
		break;
		case 'payment':
			$html .= "<div class='akmall-payment clearfix'>";
			$i=0;
			$firstPayment =1;
			foreach($payment as $key=>$vo){
				if($key == 5 && empty($info['qrcode_pay'])){ continue;}
				$i++;
				if($i==1) $firstPayment=$key;
				$html .= "<label akmall-value='{$key}' akmall-target=':payment' akmall-fx='akmall.payment' akmall-fx-params='{$key}' class='ellipsis akmall-params akmall-payment-{$key} ".($i==1?'active':'')."'><input type='radio' name='payment' value='{$key}' ".($i==1?'checked':'').">{$vo['name']}</label>";
			}
			
			$html .= "</div>";	
		break;
		case 'mobile':
			$html .= "<input type='tel' name='{$key}' placeholder='{$vo['info']}' autocomplete='off' class='akmall-input-text' akmall-request='{$vo['request']}' value='{$cookie[$key]}'>";
		break;
		case 'salenum':
			$html .= "<span>{$info['salenum']}</span>";
		break;
		case 'quantity':
			$html .= "<input type='tel' class='akmall-quantity akmall-input-text' size='4' value='1' name='quantity'' style='width:50%;'>";
		break;
		case 'datetime':
			$date = date('Y-m-d',strtotime("+0 day"));
			$html .= "<input type='text' name='{$key}' placeholder='{$vo['info']}' autocomplete='off' class='akmall-input-text Wdate' akmall-request='{$vo['request']}' style='width:50%;' value='{$cookie[$key]}'>";
		break;
		case 'region':
			if(L('regions')=='' || L('regions')=='REGIONS'){
				$html .= "<select name='region[province]' id='province' class='akmall-region akmall-region-province' akmall-request='{$vo['request']}'></select>
					<select name='region[city]' id='city' class='akmall-region akmall-region-city' akmall-request='{$vo['request']}'></select>
					<select name='region[area]' id='area' class='akmall-region akmall-region-area' akmall-request='{$vo['request']}'></select>";
				
				$region = $host."/Public/akmall/seajs/akmall/region-".C('DEFAULT_LANG').".js";
				$html .= "<script src='{$region}'></script><script>new PCAS('region[province]','region[city]','region[area]','{$cookie['region'][0]}','{$cookie['region'][1]}','{$cookie['region'][2]}');</script>";
					
			}else{
				$regions = explode(',',L('regions'));
				$region = '';
				foreach($regions as $reg){ $region .= "<option value='{$reg}'>{$reg}</option>";}
				$html .= "<select name='region[province]' id='province' class='akmall-region akmall-region-province' style='width:100% !important;'>{$region}</select>";
			}
		break;
		case 'remark':
			$html .= "<input type='text' name='{$key}' placeholder='{$vo['info']}' autocomplete='off' akmall-request='{$vo['request']}' class='akmall-input-text' value='{$cookie[$key]}'>";
		break;
		case 'verify':
			$verify= $host.'index.php?m=akmall&a=verify';
			if(!empty($request['verify'])) $verify .= '&'.http_build_query($request['verify']);
			$html .= "<input type='tel' name='{$key}' placeholder='{$vo['info']}' class='akmall-input-text' autocomplete='off' akmall-request='{$vo['request']}' style='width:30%;'>
				<img class='verify' src='{$verify}' />";
		break;
		case 'code':
			$html .= "<input type='tel' name='{$key}' placeholder='{$vo['info']}' class='akmall-input-text' autocomplete='off' akmall-request='{$vo['request']}' style='width:50%;float:left;'>
				<a href='{$host}index.php?m=Order&a=getCode' target='_blank' class='akmall-btn-min akmall-btn akmall-btn-ok' style='width:48%;font-weight:normal;float:right;text-align:center;margin:0;padding:6px 0;font-size:14px;text-decoration:none;' />".lang('getMobileCode')."<i></i></a>";
		break;
		default:
			$html .= "<input type='text' name='{$key}' placeholder='{$vo['info']}' autocomplete='off' akmall-request='{$vo['request']}' class='akmall-input-text' value='{$cookie[$key]}'>";
		break;
	}
	$html .= "</div></div>";			
}

$html .=  "<input type='hidden' name='item_index' value='{$item_index}'>";
$html .= "<div class='akmall-rows akmall-id-btn clearfix'><input type='submit' id='akmall-submit' class='akmall-btn akmall-submit' value='".lang('orderSubmit')."' /></div></form>";
$html .= "<style>#akmallForm{color:#333;padding:5px;}#akmallForm *{margin:0;padding:0;font-size:14px;}#akmallForm .akmall-request{font-size:16px;font-weight:bold;color:#f60;float: left;display: inline-block;line-height:25px;margin-left: 3px;}#akmallForm .akmall-request-none{visibility: hidden;}#akmallForm .clearfix:before,#akmallForm .clearfix:after{content:'';display:table;}#akmallForm .clearfix:after{clear:both;}#akmallForm .clearfix{*zoom:1;}#akmallForm .akmall-rows{padding:3px 0;position: relative;text-align: center;}#akmallForm .rows-head{position:absolute;left:0;width:5rem;font-weight:normal;border-bottom:none;padding:2px 0;text-align:right;}#akmallForm .rows-params{margin-left: 5.5rem;text-align: left;}#akmallForm .akmall-params{display:block;color:#f00;padding:2px 0;}.akmall-params-image{margin-right:5px;float:left;max-width:30%;border:1px solid #ccc;}.akmall-params-image img{max-width:100%;}#akmallForm .akmall-payment .akmall-params{display:inline-block;margin-right:15px;font-weight:bold;}#akmallForm select,#akmallForm .akmall-input-text {float:left;text-indent:4px;width:100%;display: inline-block;padding:5px 0;margin-right:1px;color: #555555;border: 1px solid #cccccc;font-family:MicroSoft Yahei;outline:none;transition: all 0.2s linear 0s;box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);border-radius: 2px;font-size: 14px;}#akmallForm .akmall-total-price{color:#f00;font-size:18px;}#akmallForm .akmall-btn{margin:10px 0;width:98%;padding:10px;background: #EE3300;border: #EE3300;color:#fff;border-radius:5px;font-size:18px;cursor:pointer;}#akmallForm .akmall-btn:hover{opacity:0.9;}#akmallForm .akmall-region{width:33%;}#akmallForm .akmall-region-area{float:right;}";
if(!empty($template['color'])){
	$color = $template['color'];
    $html .= "#akmallForm{color:#{$color['font']};background-color:#{$color['form_bg']};}.akmall-title{background-color:#{$color['title_bg']};}#akmallForm .akmall-btn,#akmallForm .akmall-btn:hover, #akmallForm .akmall-btn:active,#akmallForm .akmall-group-box input:checked + label:after{background-color:#{$color['button_bg']};border-color:#{$color['button_bg']};}#akmallForm .akmall-params{color:#{$color['button_bg']};}";
}
$html .= "</style>";
return $html;
?>
