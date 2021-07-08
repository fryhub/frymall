<?php
/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 */
defined('THINK_PATH') OR exit();
function lang($world){
	$array = explode('_',$world);
	$lang  = '';
	foreach($array as $value){
		if($value)$lang .= L($value);
	}
	return strtolower(C('DEFAULT_LANG'))=='en'?ucfirst($lang):$lang;
}

function password($password){
	$pwd = trim($password);
	return hash_hmac('md5',md5($pwd),$pwd);
}

function mbSubstr($str,$len=25,$encoding='utf-8'){
	$str = strip_tags($str);
	$string = mb_substr($str,0,$len,$encoding);
	if(mb_strlen($str,'utf8')>$len) $string .= '...';
	return $string;
}

function errorLog($data,$filename=''){
	if(empty($filename)) $filename = C('DATA_CACHE_PATH').'Error-'.date('Ym').'.log';
	$log = array(
		'userId'   => $_SESSION['user']['id'],
		'clientIP' => get_client_ip(),
		'dateTime' => date('Y-m-d H:i:s'),
		'data'     => $data,
	);
	@file_put_contents($filename,var_export($log,true)."\n",FILE_APPEND);
}

function randCode($length=12, $chars = '0123456789') {
	$hash = '';
	$max = strlen($chars) - 1;
	for($i = 0; $i < $length; $i++) {
		do{$num = $chars[mt_rand(0, $max)];}while($i==0 && $num==0);
		$hash .= $num;
	}
	return $hash;
}

function getFields($table,$fields,$id,$str=''){
	$Model = M($table);
	if(empty($str)){
		$expression='getByid';
	}else{
		$expression='getBy'.$str;
	}
	$thisaa=$Model->field($fields)->$expression($id);

	$bb=explode(',',$fields);
	if(count($bb)<=1){
		return $thisaa[$fields];
	}else{
		return $thisaa;
	}		
}

function status($status,$type='',$data='1:启用;0:禁用',$name='status'){
	if(is_array($data)){
		$data_array = $data;
	}else{
		$arr1 = explode(';',$data);
		foreach($arr1 as $a){
			$arr2 = explode(':',$a);
			$data_array[$arr2[0]] = $arr2[1];
		}
	}
	$tags = '';
	switch($type){
		case 'select':
			$tags = '';
			foreach($data_array as $k=>$v){
				$select = ctype_alnum($status)&&$k==$status?'selected="selected"':'';
				$tags .= '<option value="'.$k.'" '.$select.'>'.$v.'</option>';
			}
		break;
		case 'radio':
			$i = 0;
			foreach($data_array as $k=>$v){
				$i++;
				$checked = '';
				if((!ctype_alnum($status) && $i==1) || (ctype_alnum($status) && $k==$status)) $checked = 'checked="checked"';
				$tags .= '<input type="radio" name="'.$name.'" value="'.$k.'" '.$checked.' /><label class="ui-group-label">'.$v.'</label>';
			}
		break;
		case 'image':
			$image = $status==1?'true.png':'false.png';
			$tags  = '<img src="Public/Assets/img/'.$image.'" />';
		break;
		default:
			$tags = $data_array[$status];
	}
	return $tags;
}

function setting(array $param,$key,$output=''){
	extract($param);
	$readonly = $readonly==1?'readonly="readonly"':'';
	switch($tags){
		case 'text':
			$html = "<input type='{$tags}' name='{$key}' id='{$key}' size='{$width}' autocomplete='off' class='ui-text {$class}' value='{$output}' {$readonly} />";
		break;
		case 'checkbox':
			$akmallConfig = empty($output)?array():json_decode(str_replace('\\', '', $output),true);
			if(is_array($options)){
				foreach($options as $k=>$v){
					$checked = in_array($k,$akmallConfig)?"checked='checked'":"";
					$html .= "<label class='ui-group-label status-radio'><input type='{$tags}' name='{$key}[]' id='{$key}-{$k}' class='input-checkbox {$class}' value='{$k}' {$checked} {$readonly} />{$v}</label>";
				}
				$html .= "<input type='{$tags}' name='{$key}[10000]' value='10000' checked='checked' style='display:none'>";
			}else{
				$html = "Error.";
			}
		break;
		case 'radio':
			if(is_array($options)){
				foreach($options as $k=>$v){
					$checked = $k==$output?"checked='checked'":"";
					$html .= "<label class='ui-group-label status-radio'><input type='{$tags}' name='{$key}' id='{$key}-{$k}' class='input-radio  {$class}' value='{$k}' {$checked} />{$v}</label>";
				}
			}else{
				$html = "Error.";
			}
		break;
		case 'textarea':
			$html = "<textarea name='{$key}' id='{$key}' class='textarea  {$class}' cols='{$width}' rows='{$height}'>{$output}</textarea>";
		break;
		case 'select':
			if(is_array($options)){
				$html  = "<select name='{$key}' class='{$class}' id='{$key}'>";
				foreach($options as $k=>$v){
					$selected = $k==$output?"selected='selected'":"";
					$html .= "<option value='{$k}' {$selected}>{$v}</option>";
				}
				$html .= "</select>";
			}else{
				$html = "Error.";
			}
		break;
		case 'file':
			$html  = "<input type='text' size='{$width}' name='{$key}' id='image-{$key}' class='ui-text {$class}' style='float:left;' value='{$output}' /><button type='button' class='button' onclick=\"akmallUpload('#{$key}')\">上传图片</button><input type='file' class='hidden' id='{$key}' onchange=\"uploadImg('#{$key}','#image-{$key}');\" />";
			if(!empty($output)) $html .= '<a id="view-'.$key.'" target="_blank" href="'.__PUBLIC__.'/Uploads/'.$output.'" style="margin-left:5px;" class="ui-button" >'.lang('view_image').'</a>';
		break;
		default:
			$html = "<input type='{$tags}' size='{$width}' name='{$key}' id='{$key}' autocomplete='off' class='ui-text  {$class}' value='{$output}' />";
		break;
	}
	return $html;
}

function isEmail($email) {
	return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}
function isMobileNum($mobile) {
	switch(C('DEFAULT_LANG')){
		case 'zh-cn': return preg_match("/1[3-9]{1}\d{9}$/", $mobile);break;
		case 'zh-tw': return preg_match("/^(9|09)\d{8}$/", $mobile);break;
		//case 'jp': return preg_match("/^([789]|0[789])\d{9}/", $mobile);break;
		//case 'arab': return preg_match("/^[0-9]{9,}$/", $mobile);break;
		default:return true;
	}
}

function http( $url, $method = 'GET', array $postfields = array(), array $headers = array() ){
    $ci = curl_init();
    curl_setopt( $ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0 );
    curl_setopt( $ci, CURLOPT_CONNECTTIMEOUT, 10 );
    curl_setopt( $ci, CURLOPT_TIMEOUT, 20 );
    curl_setopt( $ci, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ci, CURLOPT_ENCODING, 'gzip' );
    curl_setopt( $ci, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $ci, CURLOPT_MAXREDIRS, 5 );
    curl_setopt( $ci, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ci, CURLOPT_HEADER, false );

    switch( strtoupper( $method ) )
    {
        case 'POST':
            curl_setopt( $ci, CURLOPT_POST, true );
            if ( !empty( $postfields ) )
            {
                curl_setopt( $ci, CURLOPT_POSTFIELDS, http_build_query( $postfields ) );
            }
            break;
        case 'DELETE':
            curl_setopt( $ci, CURLOPT_CUSTOMREQUEST, 'DELETE' );
            if ( !empty( $postfields ) )
            {
                $url = "{$url}?" . http_build_query( $postfields );
            }
            break;
        case 'GET':
            if ( !empty( $postfields ) )
            {
                $url = "{$url}?" . http_build_query( $postfields );
            }
            break;
    }
    
    curl_setopt($ci, CURLOPT_URL, $url );
    curl_setopt($ci, CURLOPT_HTTPHEADER, $headers );
    curl_setopt($ci, CURLINFO_HEADER_OUT, true );
    
    $response = curl_exec( $ci );
    curl_close ($ci);
    return $response;
}

function delFiles($dir='./Public/Cache/') {
  $dh = opendir($dir);
  while ($file=readdir($dh)) {
    if($file!="." && $file!="..") {
      $fullpath=$dir."/".$file;
      if(!is_dir($fullpath)) {
          unlink($fullpath);
      } else {
          delFiles($fullpath);
      }
    }
  }
  closedir($dh);
}

function isMobile(){
	$screen = cookie('screen');
	if(in_array($screen, array('pc','m'))){
		return $screen=='pc'?false:true;
	}
    $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
    $is_mobile = false;
    cookie('screen','pc');
    foreach ($mobile_agents as $device) {
        if (stristr($user_agent, $device)) {
            $is_mobile = true;
            cookie('screen','m');
            break;
        }
    }
    return $is_mobile;
}
function isWeixin(){
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	return strstr($user_agent,"MicroMessenger")?true:false;
}

function imageUrl($image){
	if(empty($image)) return '';
	$images = explode(',',$image);
	if(count($images)===1){
		if(strpos($image, 'http://')===0 || strpos($image, 'https://')===0){
			return $image;
		}else{
			$akmallConfig = Cache("akmallConfig");
			if(!empty($akmallConfig['oss_host'])){
				$akmallHost = $akmallConfig['oss_host'].C('akmall_ROOT');
			}else{
				$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') || $_SERVER['SERVER_PORT'] == '443' || $_SERVER['HTTP_FROM_HTTPS'] == 'on' || $_SERVER['HTTP_FROM_HTTPS'] == 'on' || $_SERVER['HTTP_SSL_FLAG'] == 'SSL') ? 'https://' : 'http://'; 
				$akmallHost = $http_type.$_SERVER['HTTP_HOST'].C('akmall_ROOT');
			}
		
			return $akmallHost."Public/Uploads".$image;
		}
	}else{
		
	}
}

function ksortRecursion( array &$data ){
    foreach( $data as &$v ) {
        is_array( $v ) && ksortRecursion( $v );
    }
    ksort( $data );
}

function createSign($data,$key){
	if(isset($data['sign']))unset($data['sign']);
	ksortRecursion( $data );
    return strtoupper( md5( strtolower( md5( http_build_query( $data ) ) ) . $key ) );
}

function getCache($table,$where,$refresh=false,$time=864000){
        $Model = ucfirst($table);
        $cacheName = $Model.implode('', $where);
        $data = cache($cacheName);
        if(empty($data) || $refresh==true){
            $data = M($Model)->where($where)->find();
            cache($cacheName,$data,$time);
        }
        return $data; 
    }
    function experss($com,$num,$order_id,$order_no){
    		if(empty($com) || empty($num)) return false;
    		$express = C('DELIVERY');
			
			
			if(in_array($com,array('ak-tcat'))){
				return "<a href='https://www.t-cat.com.tw/Inquire/Trace.aspx?no={$num}' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-hct'))){
				return "<a href='https://cagweb01.hct.com.tw/pls/hctweb/C_PIKAM020AS?pACT=C_POKAM31&pINVOICE_NO={$num}' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-kerrytj'))){
				return "<a href='https://www.kerrytj.com/webquery/CargoStatus/CS_Search_KtjNo.aspx?ktjNO={$num}' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-711'))){
				return "{$num} <a href='https://eservice.7-11.com.tw/e-tracking/search.aspx' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-quanjia'))){
				return "{$num} <a href='https://www.famiport.com.tw/Web_Famiport/page/process.aspx' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-ezship'))){
				return "{$num} <a href='https://www.ezship.com.tw/receiver_query/ezship_query_shipstatus_2017.jsp' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-kerryhk'))){
				return "<a href='http://hk.kerryexpress.com/track?track={$num}' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-jet'))){
				return "<a href='https://www.trackingmore.com/jet-tracking.html?number={$num}' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-jne'))){
				return "<a href='https://track.aftership.com/jne/{$num}' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-vt'))){
				return "<a href='https://www.viettelpost.com.vn/Tracking?KEY={$num}' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-dpe'))){
				return "<a href='http://www.dpe.net.cn/Tracking.php?tracknumbers={$num}' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-dhl'))){
				return "<a href='https://www.logistics.dhl/global-en/home/tracking/tracking-ecommerce.html?tracking-id={$num}' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-nj'))){
				return "<a href='https://www.ninjavan.co/en-ph/tracking?id={$num}' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-lbc'))){
				return "<a href='https://www.lbcexpress.com/track/?tracking_no={$num}' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-jam'))){
				return "{$num} <a href='https://myjamexpress.com/new-myjamexp/jamexpress/waybill-status/' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else if(in_array($com,array('ak-2go'))){
				return "<a href='https://supplychain.2go.com.ph/CustomerSupport/etrace/indiv1.asp?code={$num}' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}else{
				//$com = $com=='jingdong'?'jd':$com;
				//return "<a href='http://m.kuaidi100.com/result.jsp?com={$com}&nu={$num}' target='_blank' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
				return "<a href='javascript:;' onclick='traceExpress(\"{$com}\",\"{$num}\",\"{$order_id}\",\"{$order_no}\")' class='links express-links'>{$express[$com]}".lang('toView')."</a>";
			}
    }
	
	function strFilter($str){
		$str = str_replace('\'', '', $str);
		$str = str_replace('"', '', $str);
		$str = str_replace('“', '', $str);
		$str = str_replace('”', '', $str);
		$str = str_replace(',', '', $str);
		$str = str_replace('<', '', $str);
		$str = str_replace('>', '', $str);
		$str = str_replace('?', '', $str);
		$str = str_replace('`', '', $str);
		$str = str_replace('·', '', $str);
		$str = str_replace('~', '', $str);
		$str = str_replace('!', '', $str);
		$str = str_replace('@', '', $str);
		$str = str_replace('$', '', $str);
		$str = str_replace('%', '', $str);
		$str = str_replace('^', '', $str);
		$str = str_replace('……', '', $str);
		$str = str_replace('&', '', $str);
		$str = str_replace('*', '', $str);
		$str = str_replace('(', '', $str);
		$str = str_replace(')', '', $str);
		$str = str_replace('-', '', $str);
		$str = str_replace('_', '', $str);
		$str = str_replace('+', '', $str);
		$str = str_replace('=', '', $str);
		$str = str_replace('|', '', $str);
		$str = str_replace('\\', '', $str);
		$str = str_replace('[', '', $str);
		$str = str_replace(']', '', $str);
		$str = str_replace('{', '', $str);
		$str = str_replace('}', '', $str);
		$str = str_replace(';', '', $str);
		$str = str_replace(':', '', $str);
		$str = str_replace('.', '', $str);
		$str = str_replace('/', '', $str);
		return trim($str);
	}
	
	function csv_export($data = array(), $headlist = array(), $fileName='') {
		$fileName = $fileName?$fileName:date('Ymd');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$fileName.'.csv"');
		header('Cache-Control: max-age=0');

		//打开PHP文件句柄,php://output 表示直接输出到浏览器
		$fp = fopen('php://output', 'a');

		//输出Excel列名信息
		foreach ($headlist as $key => $value) {
			//CSV的Excel支持GBK编码，一定要转换，否则乱码
			$headlist[$key] = iconv('utf-8', 'gbk', $value);
		}

		//将数据通过fputcsv写到文件句柄
		//fputcsv($fp, $headlist);

		//计数器
		$num = 0;

		//每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
		$limit = 100000;

		//逐行取出数据，不浪费内存
		$count = count($data);
		for ($i = 0; $i < $count; $i++) {

			$num++;
			
			//刷新一下输出buffer，防止由于数据过多造成问题
			if ($limit == $num) { 
				ob_flush();
				flush();
				$num = 0;
			}
			
			$row = $data[$i];
			foreach ($row as $key => $value) {
				$row[$key] = iconv('utf-8', 'gbk', $value);
			}

			fputcsv($fp, $row);
		}
	}
?>