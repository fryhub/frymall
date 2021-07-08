<?php

$html = "";
$scheme = isset($_SERVER['REQUEST_SCHEME'])&&!empty($_SERVER['REQUEST_SCHEME'])?$_SERVER['REQUEST_SCHEME']:'http';
$url = isset($_GET['url'])?$_GET['url']:"{$scheme}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$show_notice = $akmallConfig['show_notice']<2?'akmall-full-row':'';
$user_id = isset($cookie['uid'])?$cookie['uid']:$_SESSION['user']['id'];
$userInfo = M('User')->where(array('id'=>$user_id))->field('pid,role')->find();
$user_pid = $userInfo['role']=='member'?$userInfo['pid']:$user_id;
$referer  = isset($_GET['buildHtml'])?'':$_SERVER['HTTP_REFERER'];
$item_index = 0;
$package = !empty($info['params_name'])?$info['params_name']:lang('itemPackage');

$template['theme'] = $template['theme']?$template['theme']:'akmall';
$html .= "<link href='".C('akmall_ROOT')."Public/akmall/theme/{$template['theme']}/akmall.css?v=".akmall_VERSION."' rel='stylesheet'>";

$html .= "<div class='akmall-order akmall-border akmall-lang-".C('DEFAULT_LANG')." clearfix' id='akmallOrder'><div class='akmall-main akmall-border {$show_notice}'><div class='akmall-title akmall-title-order akmall-border ellipsis'><i class='icon-cart'></i>{$info['name']}</div>";
		
		$html .= "<div class='akmall-form-content akmall-border'><form action='".C('akmall_ROOT')."index.php?m=Order&a=akmallBooking' method='post' id='akmallForm'><input type='hidden' name='lang' value='".C('DEFAULT_LANG')."'><input type='hidden' name='user_id' value='{$user_id}'><input type='hidden' name='user_pid' value='{$user_pid}'><input type='hidden' name='sn' value='{$info['sn']}'><input type='hidden' name='item_id' value='{$info['id']}'><input type='hidden' name='item_name' value='{$info['name']}'><input type='hidden' name='item_price' id='item_price' value='".($product?$product[0]['price']:$info['price'])."'><input type='hidden' name='url' value='{$url}'><input type='hidden' name='redirect' value='".($template['redirect_uri']?$template['redirect_uri']:$url)."'><input type='hidden' name='referer' value='{$referer}'><input type='hidden' name='order_page' value='{$request['page']}'><input type='hidden' name='channel_id' value='{$cookie['ac']}'><input type='hidden' name='qrcode_pay' value='{$info['qrcode_pay']}'><input type='hidden' name='math' value='{$paymentDefault['math']}'><input type='hidden' name='page' value='{$page}'><input type='hidden' name='akmall_token' value='{$token}'><input type='hidden' name='buy_num' value='{$info['buy_num']}'><input type='hidden' name='buy_num_decrease' value='{$info['buy_num_decrease']}'><input type='hidden' name='min_num' value='{$info['min_num']}'><input type='hidden' name='max_num' value='{$info['max_num']}'><input type='hidden' name='coupon_value' value='0'>";
				

		if(!empty($template['info'])){
			$html .= "<div class='akmall-brief clearfix'>{$template['info']}</div>";
		}
		if(!empty($product)){
			$product_html = "<div class='akmall-box' id='akmall-box-product'><div class='akmall-rows clearfix rows-id-params rows-id-params-{$info['params_type']} akmall-{$info['params_type']}'><label class='rows-head'>".$package.lang('request')."</label><div class='rows-params'>";
			$selected = isset($_GET['selected'])&&$_GET['selected']>0?$_GET['selected']:1;
			switch ($info['params_type']) {
				case 'select':
					$product_html .= "<select class='akmall-params-change' name='item_params[]' akmall-fx='akmall.quantity' akmall-fx-params='0'>";
						foreach($product as $vo){
							$title = explode('||',$vo['title']);
							$product_html .= "<option value='{$vo['title']}'".($i==$selected?' selected ':'')." value-price='{$vo['price']}'>{$title[0]}</option>";
						}
					$product_html .= "</select>";
				break;
				default:
					$i=0;
					foreach($product as $vo){
						$i++;
						$title = explode('||',$vo['title']);
						$product_html .= "<label akmall-value='{$vo['price']}' akmall-target='#item_price' akmall-fx='akmall.quantity' akmall-fx-params='0' class='".($vo['image']?' akmall-params-image':' akmall-params-text')." akmall-params  akmall-{$info['params_type']}".($i==$selected?' active ':'')."' title='{$title[0]}'>";
						if($vo['image']){
							$product_html .= "<p class='item-image'><img src='".imageUrl($vo['image'])."' /></p>";
						}
						$product_html .= "<p class='item-desc'><input type='{$info['params_type']}' name='item_params[]' value='{$vo['title']}' ".($i==$selected?'checked':'').">{$title[0]}</p></label>";
					}
				break;
			}
			$product_html .= "</div></div></div><!--.akmall-box-->";
			//$product_html .= "</div></div>";
		}
		
		if(!empty($extends)){
			$extends_html = "<div class='akmall-box' id='akmall-box-extends'>";
			foreach($extends as $k=>$vo){
				$disabled  = '';
				$level = '';
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
				$extends_title= $vo['title'];
				if(strstr($vo['title'],'||')){
					$extends_title= explode('||',$vo['title']);
					$extends_title= $extends_title[0];
				}
				
				$extends_html .= "<div data-level='{$level}' class='akmall-rows clearfix rows-id-extends {$class} {$class2} extends-level-{$level} akmall-{$vo['type']}'><label class='rows-head'>{$extends_title}".lang('request')."</label><div class='rows-params'>";
				
				$vo['value'] = is_array($vo['value'])?$vo['value']:explode('#',$vo['value']);
				
				$value = explode('||',$vo['value'][0]);
				switch ($vo['type']) {
					case 'text':
						$extends_html .= "<input type='text' name='extends[{$vo['title']}]' placeholder='{$value[0]}' autocomplete='off' class='akmall-input-text' {$disabled} {$disabled2}>";
					break;
					case 'password':
						$extends_html .= "<input type='password' name='extends[{$vo['title']}]' placeholder='{$value[0]}' autocomplete='off' class='akmall-input-text' {$disabled} {$disabled2}>";
					break;
					case 'select':
						$extends_html .= "<select name='extends[{$vo['title']}]' {$disabled} {$disabled2}>";
						foreach($vo['value'] as $li){
							if(empty($li)){
								$extends_html .= "<option value=''>".lang('pleaseSelect')."</option>";
							}else{
								$value = explode('||',$li);
								$extends_html .= "<option value='{$li}'>{$value[0]}</option>";
							}
						}
						$extends_html .= "</select>";
					break;
					default:
						$i=0;
						foreach($vo['value'] as $k=>$li){
							$i++;
							$hidden = empty($li)?'style="display:none;"':'';
							$value = explode('||',$li);
							$extends_image = trim($vo['image'][$k]);
							if($extends_image ){
								$image_class = ' akmall-params-image ';
								$image = "<p class='item-image'><img src='".imageUrl($extends_image)."' /></p>";
							}else{
								$image = '';
								$image_class = '';
							}
							
							$extends_html .= "<label class='akmall-group akmall-params akmall-{$vo['type']} {$image_class}".($i==1?'active':'')."' {$hidden}>{$image}<span class='akmall-group-box'><input akmall-value='{$li}' class='{$vo['type']}-{$k}' id='{$vo['title']}{$key}' name='extends[{$vo['title']}]".($vo['type']=='checkbox'?'[]':'')."' type='{$vo['type']}' value='{$li}' ".($i==1?'checked':'')." {$disabled}><label class='selected-icon' for='{$vo['title']}{$key}'></label></span>{$value[0]}</label>";
						}
					break;
				}
				$extends_html .= "</div></div>";	
			}
			$extends_html .= "</div><!--.akmall-box-->";						
		}
		
		
		$akmall_box_begin = "<div class='akmall-box-params'>";
		$akmall_box_end = "</div><!--.akmall-box .akmall-box-params-->";
		$i = 0;
		foreach($params as $key=>$vo){
			if(empty($vo['checked'])){ continue;} 
			
			if(!in_array($key,array('product','extends'))){
				if($key=='payment'){
					$html .="<div class='akmall-box akmall-box-params'>";
				}
				if(!strstr($html,$akmall_box_begin)){ $html .= $akmall_box_begin; }
				$html .= "<div class='akmall-rows clearfix rows-id-{$key}'><label class='rows-head'>{$vo['name']}<span class='akmall-request ".($vo['request']?'':'akmall-request-none')."'>*</span></label><div class='rows-params'>";
			}
			switch ($key) {
				case 'product':
					if(strstr($html,$akmall_box_begin) && !strstr($html,$akmall_box_end)){$html .= $akmall_box_end; }
					$html .= $product_html;
				break;
				case 'extends':
					if(strstr($html,$akmall_box_begin) && !strstr($html,$akmall_box_end)){$html .= $akmall_box_end; }
					$html .= $extends_html;
				break;
				case 'price':
					$html .= "<span class='akmall-shipping' ".($info['shipping_id']?'':"style='display:none;'")."><strong class='akmall-order-price'>0.00</strong>+<strong class='akmall-shipping-price'>0.00</strong>(".lang('shippingPrice').")=</span>".lang('symbol')."<strong class='akmall-total-price'>".($product?$product[0]['price']:$info['price'])."</strong><strong class='akmall-coupon'></strong><span class='akmall-discount'></span>".$vo['info'];

					$html .= "</div><div><div></div></div><!--.akmall-box .akmall-box-params-->";
				break;
				case 'payment': 
					$html .= "<div class='akmall-payment clearfix'>";
					$i=0;
					$firstPayment =1;
					foreach($payment as $key=>$vo){
						if($key == 'qrcode' && empty($info['qrcode_pay'])){ continue;}
						$i++;
						if($i==1) $firstPayment=$key;
						$html .= "<label akmall-value='{$key}' akmall-target=':payment' akmall-fx='akmall.payment' akmall-fx-params='{$key}' class='ellipsis akmall-params akmall-payment-{$key} {$vo['classname']} ".($i==1?'active':'')."'><input type='radio' name='payment' value='{$key}' ".($i==1?'checked':'').">{$vo['name']}</label>";
						if($key=='creditcard'){
							$html .= '<script type="text/javascript" src="https://h.online-metrix.net/fp/tags.js?org_id=b7rx7nkg&session_id='.session_id().'"></script>';
						}
					}
					$monthRange = range(1,12);
					foreach($monthRange as $m){$m = $m<10?'0'.$m:$m;$month .= "<option value='{$m}'>{$m}</option>";}
					for($i=0;$i<12;$i++){
						$y = date('Y')+$i;
						$year .= "<option value='{$y}'>{$y}</option>";
					}
					$html .= "</div><div id='akmall-creditcard-info' class='clearfix' style=''><input type='text' name='creditcard[num]' class='akmall-input-text creditcard-num' placeholder='".lang('creditCardNum')."'><input type='text' name='creditcard[cvv]' class='akmall-input-text creditcard-cvv' placeholder='".lang('cvv')."'><select name='creditcard[month]' class='creditcard-month'><option value=''>".lang('month')."</option>{$month}</select><select name='creditcard[year]' class='creditcard-year'><option value=''>".lang('year')."</option>{$year}</select></div>";
					$html .= "<div id='akmall-payment-info' class='akmall-alert clearfix' ".($payment[$firstPayment]['info']?'':"style='display:none;'")."><div class='payment-info'>{$payment[$firstPayment]['info']}</div></div>";
				break;
				case 'mobile':
					$html .= "<input type='tel' name='{$key}' placeholder='{$vo['info']}' autocomplete='off' class='akmall-input-text' akmall-request='{$vo['request']}' value='{$cookie[$key]}'>";
				break;
				case 'salenum':
					$html .= "<span class='akmall-salenum'>{$info['salenum']}</span><!--span class='akmall-stock'>(".lang('stock')."{$info['quantity']})</span-->";
				break;
				case 'quantity':
					$html .= "<div class='akmall-quantity-group'><a class='quantity-dec' href='javascript:;' onclick='akmall.quantity(-1)'>-</a><input type='tel' class='akmall-quantity' size='4' value='1' name='quantity' onkeyup='akmall.quantity(0)'><a class='quantity-inc' href='javascript:;' onclick='akmall.quantity(1)'>+</a></div>";
				break;
				case 'datetime':
					/*
					$date = date('Y-m-d',strtotime("+0 day"));
					$html .= "<input type='text' name='{$key}' placeholder='{$vo['info']}' autocomplete='off' class='akmall-input-text Wdate' akmall-request='{$vo['request']}' style='width:50%;' onfocus=\"WdatePicker({minDate:'$date'})\" value='{$cookie[$key]}'>
						<script type='text/javascript' src='__PUBLIC__/Assets/js/My97DatePicker/WdatePicker.js'></script>";
					*/
					$html .= "<select id='datetime-1' onchange='changeDatetime(this.value)' class='select akmall-region' name='datetime[]'><option value=''>--请选择--</option><option value='無特殊要求'>無特殊要求</option><option value='指定派送時間'>指定派送時間</option></select>";
					$html .= "<select id='datetime-2' class='select2 akmall-region' name='datetime[]' disabled style='background:#eee'><option value=''>--请选择--</option><option value='週一至週日'>週一至週日</option><option value='週一至週五'>週一至週五</option><option value='週六日'>週六日</option></select>";
					$html .= "<select id='datetime-3' class='select2 akmall-region' name='datetime[]' disabled style='background:#eee'><option value=''>--请选择--</option><option value='全天'>全天</option><option value='上午'>上午</option><option value='下午'>下午</option></select>";
					$html .= '<script type="text/javascript">function changeDatetime(id){ if(id=="指定派送時間"){ $(".select2").attr("disabled",false).css("background-color","#fff");}else{ $(".select2").attr("disabled",true).css("background-color","#eee");;}}</script>';
				break;
				case 'file':
					$html .= "<input name='file' type='hidden' class='ui-text left' id='file'><button type='button' class='upload-button akmall-input-text akmall-btn' onclick='akmallUpload(\"#akmall-file\")'>{$vo['name']}</button><input type='file' name='file2' autocomplete='off' id='akmall-file' akmall-request='{$vo['request']}'   onchange='uploadImg(\"#akmall-file\",\"#file\")' class='hidden'>";
				break;
				case 'region':
					$regions = "<div class='region-select region-payOnDelivery'><select name='region[province]' id='province' class='akmall-region akmall-region-province' akmall-request='{$vo['request']}'></select><select name='region[city]' id='city' class='akmall-region akmall-region-city' akmall-request='{$vo['request']}'></select><select name='region[area]' id='area' class='akmall-region akmall-region-area' akmall-request='{$vo['request']}'></select></div>";
					
					
					$options711 = '';
					foreach($city as $k=>$c){$options711 .= "<option value='{$c}'>{$c}</option>";}
					$regions .= "<div class='region-select region-711' style='display:none;'><select onchange=\"getRegion($(this),'711','city')\" disabled name='region[province]' id='province-711' class='akmall-region akmall-region-province' akmall-request='{$vo['request']}'>{$options711}</select><select onchange=\"getRegion($(this),'711','area')\" disabled name='region[city]' id='city-711' class='akmall-region akmall-region-city' akmall-request='{$vo['request']}'><option value=''>請選擇</option></select><select onchange=\"getRegionDetail(this.value,'711')\" disabled name='region[area]' id='area-711' class='akmall-region akmall-region-area' akmall-request='{$vo['request']}'><option value=''>請選擇</option></select></div>";
					
					$quanjia = '';
					foreach($city as $k=>$c){$quanjia .= "<option value='{$c}'>{$c}</option>";}
					$regions .= "<div class='region-select region-quanjia' style='display:none;'><select onchange=\"getRegion($(this),'quanjia','city')\" disabled name='region[province]' id='province-quanjia' class='akmall-region akmall-region-province' akmall-request='{$vo['request']}'>{$quanjia}</select><select onchange=\"getRegion($(this),'quanjia','area')\" disabled name='region[city]' id='city-quanjia' class='akmall-region akmall-region-city' akmall-request='{$vo['request']}'><option value=''>請選擇</option></select><select onchange=\"getRegionDetail(this.value,'quanjia')\" disabled name='region[area]' id='area-quanjia' class='akmall-region akmall-region-area' akmall-request='{$vo['request']}'><option value=''>請選擇</option></select></div>";
				 
					
					
					$ajaxUrl = U('Order/getRegion');
					$regions .= "<script>function getRegion(_this,type,target){ var name=_this;var pid=0;if(typeof(_this)=='object'){var name=_this.val();pid=_this.find('option:selected').attr('data-id');}$.ajax({url:'{$ajaxUrl}',type:'post',data:{pid:pid,name:name,type:type,target:target},dataType:'json',success:function(ret){ if(ret.status=='1'){var opt='<option value=\'\'>請選擇</option>'; for(var i=0;i<ret.data.length;i++){ var data=ret.data[i];var info='';if(data.info!=null){info=' - '+data.info.address;}opt+='<option value=\''+data.name+'\' data-id=\''+data.id+'\'>'+data.name+info+'</option>';} $('#'+target+'-'+type).html(opt);$('#address').val(''); } }});} function getRegionDetail(name,type){ $.ajax({url:'{$ajaxUrl}',type:'post',data:{name:name,type:type,target:''},dataType:'json',success:function(ret){ $('#address').val(ret.address+'。 店名：'+ret.shop+'。 店号：'+ret.number+'。 電話：'+ret.phone); } });}</script>";
					
					switch(C('DEFAULT_LANG')){
						case 'zh-cn':
							switch($akmallConfig['region']){
								case 'city-picker':
									$html .= '<input name="region" class="akmall-input-text akmall-city-picker" readonly type="text" value="" data-toggle="city-picker"><script type="text/javascript">seajs.use(["akmall/city-picker"],function(region){});</script>';
								break;
								case 'region':
									$html .= $regions;
									$html .= "<script type='text/javascript'>seajs.use(['akmall/region'],function($,region){});</script>";
								break;
								case 'region-zh-ma':
									$html .= $regions;
									$html .= "<script type='text/javascript'>seajs.use(['akmall/region-zh-ma'],function(region){ new PCAS('region[province]','region[city]','region[area]','{$cookie['region'][0]}','{$cookie['region'][1]}','{$cookie['region'][2]}');});</script>";
								break;
								default:
									$html .= '<input name="region" class="akmall-input-text akmall-city-picker" readonly type="text" value="" data-toggle="city-picker"><script type="text/javascript">seajs.use(["akmall/city-picker"],function(region){});</script>';
								break;	
							}
							
						break;
						case 'thai':
							$html .= $regions;
							$html .= "<script type='text/javascript'>seajs.use(['akmall/region-thai'],function($,region){});</script>";
						break; 
						case 'in': 
							$html .= $regions;
							//$html .= "<script type='text/javascript'>seajs.use(['akmall/region-in'],function($,region){ _init_area();});</script>";
							$html .= "<script type='text/javascript'>seajs.use(['akmall/region-in','jquery'],function(region,$){ _init_area();$('#area').change(function () {var city = $('#city').val();var area = $('#area').val();$('#city').val(city + ',' + area);});});</script>";
						break;
						default:
							if(L('regions') && L('regions')!= 'REGIONS'){
								$regions = explode(',',L('regions'));
								$region = '';
								foreach($regions as $reg){ $region .= "<option value='{$reg}'>{$reg}</option>";}
								$html .= "<select name='region[province]' id='province' class='akmall-region akmall-region-province' style='width:98% !important;'>{$region}</select>";
							}else{	
								$html .= $regions;
								$html .= "<script type='text/javascript'>var lang='".C('DEFAULT_LANG')."';seajs.use(['akmall/region-'+lang],function(region){ new PCAS('region[province]','region[city]','region[area]','{$cookie['region'][0]}','{$cookie['region'][1]}','{$cookie['region'][2]}');});</script>";
							}	
							
						break;	
					}
					
				break;
				case 'address':
					$html .= "<div class='region-select region-payOnDelivery'><textarea rows='2' id='address' name='{$key}' placeholder='{$vo['info']}' autocomplete='off' akmall-request='{$vo['request']}' class='akmall-input-text' >{$cookie[$key]}</textarea></div>";
				break;
				case 'remark':
					$html .= "<textarea name='{$key}' placeholder='{$vo['info']}' class='akmall-input-text' akmall-request='{$vo['request']}' rows='2'></textarea>";
				break;
				case 'verify':
					$verify='http://'.$_SERVER['HTTP_HOST'].C('akmall_ROOT').'index.php?m=akmall&a=verify';
					if(!empty($request['verify'])) $verify .= '&'.http_build_query($request['verify']);
					$html .= "<input type='tel' name='{$key}' placeholder='{$vo['info']}' class='akmall-input-text' autocomplete='off' akmall-request='{$vo['request']}' style='width:30%;'>
						<img class='verify' src='{$verify}' onclick=\"$(this).attr('src','{$verify}&t='+new Date().getTime())\" />
						<a href='javascript:;' class='bright' onclick=\"$('.verify').attr('src','{$verify}&t='+new Date().getTime())\" />".lang('changeVerifyCode')."</a>";
				break;
				case 'code':
					$html .= "<input type='tel' name='{$key}' placeholder='{$vo['info']}' class='akmall-input-text' autocomplete='off' akmall-request='{$vo['request']}' style='width:50%;float:left;'>
						<button type='button' id='akmall-code' class='akmall-btn-min akmall-btn akmall-btn-ok' onclick=\"akmall.getCode()\" style='width:48%;font-weight:normal;float:right;padding:0.6rem 0;font-size:14px;' />".lang('getMobileCode')."<i></i></button>";
				break;
				default:
					$html .= "<input type='text' name='{$key}' placeholder='{$vo['info']}' autocomplete='off' akmall-request='{$vo['request']}' class='akmall-input-text' value='{$cookie[$key]}'>";
				break;
			}	
			if(!in_array($key,array('product','extends'))){ $html .= "</div></div>";}	
			 
		}

		$html .=  "<input type='hidden' name='item_index' value='{$item_index}'>";
		$html .= "<div class='akmall-rows akmall-id-btn clearfix'><input type='submit' id='akmall-submit' class='akmall-btn akmall-submit' value='".lang('orderSubmit')."' /></div></form></div></div></div>";

		if($akmallConfig['show_notice']){
			$html .= "<div class='akmall-box akmall-box-notice {$show_notice}'><div class='akmall-side akmall-border {$show_notice}'><div class='akmall-title akmall-title-scroll akmall-border ellipsis'><i class='icon-shipping'></i>".lang('orderNotification')."</div><div class='akmall-delivery'><div class='akmall-scroll {$show_notice}'><ul>";
			if($akmallConfig['real_notice']==1){
				$orders = M('Order')->field('item_name,item_params,name,mobile,region,add_time')->where(array('item_id'=>$info['id']))->order('id asc')->limit(25)->select();
				$i=0;
				foreach($orders as $li){
					$region = explode(' ',$li['region']);
					$item_params = empty($li['item_params'])?'':' - '.$li['item_params'];
					$i++;
					$html .= "<li ".($i%2 == 0?"class='even'":'')."><p><span class='akmall-badge'>{$region[0]}</span>".mb_substr($li['name'],0,1,'utf-8')."*[".substr($li['mobile'],0,3)."****".substr($li['mobile'],-4)."]</p><p><span class='akmall-date'>".date('m-d',$li['add_time'])."</span>{$li['item_name']}{$item_params}</p></li>";
				}
			}else{
				$item = json_decode($info['params'],true);
				$province = explode(',',L('scrollProvince'));
				$name = explode(',',L('scrollName'));
				$mobile = explode(',',L('scrollMobile'));
				$time=  explode(',',L('scrollTime'));
				for($i=0;$i<50;$i++){
					$num = rand(0,3);
					$pro = empty($item)?$info['name']:$info['name'].' - '.explode('||',$item[array_rand($item,1)]['title'])[0];
					$pp = $province[array_rand($province,1)];
					$nn = $name[array_rand($name,1)];
					$mm = $mobile[array_rand($mobile,1)].'****'.randCode(4);
					$rand = array_rand($time);
					$html .= "<li ".($i%2 == 0?"class='even'":'')."><p><span class='akmall-badge'>{$pp}</span>{$nn}*[{$mm}]</p><p><span class='akmall-date'>{$time[$rand]}</span>{$pro}</p></li>";
				}	
			}
			$html .= "</ul></div></div></div></div><!--.akmall-box-->";
		}
	
	$html .="<script type='text/javascript'>seajs.use(['jquery','akmall'], function(jQuery,akmall) { $('input[name=coupon]').bind('keyup keydown blur',function(){ var code = $(this).val();if(code.length>=8){akmall.coupon(code);}});akmall.resize('{$akmallConfig['show_notice']}');});</script>";	
$html .= "</div>";

$html .= "<script type='text/javascript'>seajs.config({vars: {'payment':".json_encode($payment).",'shipping':".json_encode($shipping)."}});</script>";
return $html;
?>
