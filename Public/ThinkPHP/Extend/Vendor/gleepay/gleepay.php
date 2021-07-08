<?php

class gleepay{

	
	 /**
     * Payment Submit
     * @param $url
     * @param $data
     * @return array
     */
    function payment_submit($url,$data){
        
        $info = $this->curl_post($url, $data);
        return $info;
    }

    /**
     * use curl send http/https
     * @param $url
     * @param $data
     * @return array
     */
    function curl_post($url, $data){
        if(strstr(strtolower($url), 'https://')) {
            $port = 443;
        }else {
            $port = 80;
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_PORT, $port);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_TIMEOUT, 300);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $tmpInfo = curl_exec($curl);
        curl_close($curl);
        return $tmpInfo;
    }

    /**
     * use file_get_contents send http/https
     * @param $url
     * @param $data
     * @return array
     */
    function http_post($url, $data){
        $result = '';
        $options  = array(
            'http' => array(
            'method' => "POST",
            'header' => "Accept-language: en\r\n" . "Cookie: foo=bar\r\n",
            'content-type' => "multipart/form-data",
            'content' => $data,
            'timeout' => 15 * 60
            )
        );
        $context  = stream_context_create($options);
        if(!empty($context)) {
            $result   = file_get_contents($url, false, $context);
        }
        return $result;
    }

    /**
     * get client IP
     * @return string
     */
    function get_client_ip(){
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $online_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        elseif(isset($_SERVER['HTTP_CLIENT_IP'])){
            $online_ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif(isset($_SERVER['HTTP_X_REAL_IP'])){
            $online_ip = $_SERVER['HTTP_X_REAL_IP'];
        }else{
            $online_ip = $_SERVER['REMOTE_ADDR'];
        }
        $ips = explode(",",$online_ip);
        return $ips[0];
    }

    /**
     * charsets
     * @param string $string_before
     * @return string $string_after
     */
    function string_replace($string_before) {
        $string_after = str_replace("\n"," ",$string_before);
        $string_after = str_replace("\r"," ",$string_after);
        $string_after = str_replace("\r\n"," ",$string_after);
        $string_after = str_replace("'","&#39 ",$string_after);
        $string_after = str_replace('"',"&#34 ",$string_after);
        $string_after = str_replace("(","&#40 ",$string_after);
        $string_after = str_replace(")","&#41 ",$string_after);
        return $string_after;
    }

    /**
     * Get browser language
     * @return string $acceptLan
     */
    function getBrowserLang() {
        $acceptLan = '';
        if(isSet($_SERVER['HTTP_ACCEPT_LANGUAGE']) && !empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
            $acceptLan = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
            $acceptLan = $acceptLan[0];
        }
        return $acceptLan;
    }

    /**
     * Get browser type
     * @return string
     */
    function getBrowser(){
        if(empty($_SERVER['HTTP_USER_AGENT'])){
            return '';
        }
        if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'rv:11.0')){
            return 'IE';
        }
        if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'rv:11.0') ||
            false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 10.0')){
            return 'IE';
        }
        if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 9.0')){
            return 'IE';
        }
        if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 8.0')){
            return 'IE';
        }
        if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 7.0')){
            return 'IE';
        }
        if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 6.0')){
            return 'IE';
        }
        if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')){
            return 'IE';
        }
        if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Firefox')){
            return 'Firefox';
        }
        if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Chrome')){
            return 'Chrome';
        }
        if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Safari')){
            return 'Safari';
        }
        if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Opera') ||
            false!==strpos($_SERVER['HTTP_USER_AGENT'],'OPR')){
            return 'Opera';
        }
        return '';
    }

    /**
     * check payment param
     * @return string $error  
     */
    function checkTransParam() {
        $error = '';
        if(!isset($_POST) || empty($_POST)) {
            $_POST = $_GET;
        }
        if(empty($error) && (empty($_POST['merNo']) || $_POST['merNo'] == '')) {
            $error = 'Merchant No. is empty,please contact the webshop customer service center !';
        }
        if(empty($error) && (empty($_POST['gatewayNo']) || $_POST['gatewayNo'] == '')){
            $error = 'Gateway No. is empty,please contact the webshop customer service center !';
        }
        if(empty($error) && (empty($_POST['orderAmount']) || $_POST['orderAmount'] == '')){
            $error = 'Order amount is empty,please contact the webshop customer service center !';
        }
        if(empty($error) && (empty($_POST['orderCurrency']) || $_POST['orderCurrency'] == '')){
            $error = 'Order currency is empty,please contact the webshop customer service center !';
        }
        if(empty($error) && (empty($_POST['orderNo']) || $_POST['orderNo'] == '')){
            $error = 'Order No. is empty,please contact the webshop customer service center !';
        }
        if(empty($error) && (empty($_POST['returnUrl']) || $_POST['returnUrl'] == '')){
            //$error = 'Return url is empty,please contact the webshop customer service center !';
        }
        if(empty($error) && (empty($_POST['firstName']) || $_POST['firstName'] == '')){
            $error = 'First name is empty,please back to the webshop to fill it !';
        }
        if(empty($error) && (empty($_POST['lastName']) || $_POST['lastName'] == '')){
            $error = 'Last name is empty,please back to the webshop to fill it !';
        }
        if(empty($error) && (empty($_POST['email']) || $_POST['email'] == '')){
            $error = 'Email is empty,please back to the webshop to fill it !';
        }
        return $error;
    }

    /**
     * check payment param
     * @return string $error  
     */
    function checkPaymentParam() {
        $error = '';
        if(!isset($_POST) || empty($_POST)) {
            $_POST = $_GET;
        }
        if(empty($error) && (empty($_POST['returnUrl']) || $_POST['returnUrl'] == '')){
            //$error = 'Return url is incorrect,please back to the payment page to re-fill it !';
        }
		
        if(empty($error) && (empty($_POST['cardNo']) || $_POST['cardNo'] == '')){
            $error = 'Card No. is incorrect,please back to the payment page to re-fill it !';
        }
		
        if(empty($error) && (empty($_POST['cardSecurityCode']) || $_POST['cardSecurityCode'] == '')){
            $error = 'CVV/CVV2 is incorrect,please back to the payment page to re-fill it !';
        }
        if(empty($error) && (empty($_POST['cardExpireMonth']) || $_POST['cardExpireMonth'] == '')){
            $error = 'Expiration month is incorrect,please back to the payment page to re-fill it !';
        }
        if(empty($error) && (empty($_POST['cardExpireYear']) || $_POST['cardExpireYear'] == '')){
            $error = 'Expiration year is incorrect,please back to the payment page to re-fill it !';
        }
		
        return $error;
    }

    /**
     * analysis xml
     * @param string $str
     * @return 
     */
    function xml_parser($str){
        $xml_parser = xml_parser_create();
        if(!xml_parse($xml_parser,$str,true)){
            xml_parser_free($xml_parser);
            return '';
        }else {
            return (json_decode(json_encode(simplexml_load_string($str)),true));
        }
    }

	function checkData($signKey){
		if(!isset($_POST) || empty($_POST)) {
			$_POST = $_GET;
		}
			
		$sha256src = $_POST['merNo'].
					 $_POST['gatewayNo'].
					 $_POST['orderNo']. 
					 $_POST['orderCurrency'].
					 $_POST['orderAmount'].
					 $_POST['returnUrl']. 
					 $signKey;    
		$signInfo = strtolower(hash("sha256",$sha256src));
		if(strtolower($_POST['signInfo']) != $signInfo) {
				return "Data validation failure,please contact the webshop customer service center !";
		}
		return "";
	} 

	//Get default language
    function getDefaultLang() {
        $acceptLan = '';
        if(isSet($_SERVER['HTTP_ACCEPT_LANGUAGE']) && !empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
            $acceptLan = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
            $acceptLan = $acceptLan[0];
        }
		if(strlen($acceptLan) > 2) {
			  $acceptLan = substr($acceptLan,0,2);
		} else if(strlen($acceptLan) < 2) {
			  $acceptLan = 'en';
		}
		return strtolower($acceptLan);
    }
	
}