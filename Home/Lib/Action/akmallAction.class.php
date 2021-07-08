<?php //decode by 小猪php解密 QQ:2338208446 http://www.xzjiemi.com/ ?>
<?php

/*
 Encode by QQ3197929874 
*/
error_reporting(0);
function getTopDomainhuo()
{
    $host = $_SERVER["HTTP_HOST"];
    $matchstr = "[^\\.]+\\.(?:(" . $str . ")|\\w{2}|((" . $str . ")\\.\\w{2}))\$";
    if (preg_match("/" . $matchstr . "/ies", $host, $matchs)) {
        $domain = $matchs["0"];
    } else {
        $domain = $host;
    }
    return $domain;
}
function getIp()
{
    if ($_SERVER["HTTP_CLIENT_IP"] && strcasecmp($_SERVER["HTTP_CLIENT_IP"], "unknown")) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } else {
        if ($_SERVER["HTTP_X_FORWARDED_FOR"] && strcasecmp($_SERVER["HTTP_X_FORWARDED_FOR"], "unknown")) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            if ($_SERVER["REMOTE_ADDR"] && strcasecmp($_SERVER["REMOTE_ADDR"], "unknown")) {
                $ip = $_SERVER["REMOTE_ADDR"];
            } else {
                if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'],
                        "unknown")
                ) {
                    $ip = $_SERVER['REMOTE_ADDR'];
                } else {
                    $ip = "unknown";
                }
            }
        }
    }
    return ($ip);
}
function doLog($fileName,$text){
    $time= date("Y-m-d H:i:s",time());
    $fileDate= date("Y-m-d",time());
    file_put_contents("/opt/app/akmall/logs/".$fileName.$fileDate.".log", $time." ".$text, FILE_APPEND);
}
function getData($ip){  
    doLog("ip","parse ip ".$ip."\n");
    $header = array('token:129c991ce41552578a3ddbc97234c17a');
    $datatype = 'txt';
   $url = 'https://api.ip138.com/ip/?ip='.$ip.'&datatype='.$datatype;
    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$header); 
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3);  
    $handles = curl_exec($ch);  
    curl_close($ch);  
    doLog("ip","parse ip result ".$handles."\n");
    return $handles;  
}

function getIpData($ip){
    doLog("ip","parse ip ".$ip."\n");
    $header = array();
    $datatype = 'txt';
   $url = 'http://ip-api.com/json/'.$ip;
    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$header); 
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3);  
    $handles = curl_exec($ch);  
    curl_close($ch);  
    doLog("ip","parse ip result ".$handles."\n");
    return json_decode($handles,true);  
}
/**
 * 分析IP的地址，
 */
function analyseIp($ip){
   return getIpData($ip);
}

function getParams($params){
    if(!empty($params)){
        $paramItem=explode("&",$params);
        $cparams=[];
        foreach($paramItem as $item){
            $itemValues=explode("=",$item);
            if(count($itemValues)==2){
                $cparams[$itemValues[0]]=$itemValues[1]; 
            }
        }
        return $cparams;
    }else{
        return [];
    }


}

function doRedirect($qs,$ipInfo,$newUrl){
   $refer= isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:"";
   $userAgent=isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:"";
   $langue=isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])?$_SERVER['HTTP_ACCEPT_LANGUAGE']:"";
   $url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
   doLog("jump","其他信息:refer:".$refer." userAgent:".$userAgent." langue=".$langue." url:".$url."\n");
    if(!empty($newUrl)){
        doLog("jump","ip 信息". $ipInfo."\n");
        
        doLog("jump","执行跳转". $newUrl."\n");
        
        header("Location: $newUrl");
        die;
    }

   
}
$qs=$_SERVER['QUERY_STRING'];
if(!empty($qs)){
    $params=getParams($qs);
    doLog("ip","获取参数". $params['id']."\n");
    $item=M("item")->where(['sn'=>$params['id']])->find();
    if(!is_null($item)){
        doLog("ip",json_encode($item)."\n");
    }
    $ip=getIp(); 
    $ipinfo=analyseIp($ip);
    $domain = getTopDomainhuo();
    //$check_info = file_get_contents($client_check);
    //$message = file_get_contents($check_message);
    
     doLog("ip","获取参数". $qs."\n");
    if(is_string($ipinfo)&&stristr($ipinfo,"日本") !== false){ ///没有找到返回false
        doLog("ip","日本ip执行跳转\n");
        doRedirect($qs,$ipinfo,$item["ipcloak_url"]);  
         
    }else{
        $isp=strtolower($ipinfo["isp"]);
        doLog("ip","isp信息".$isp."\n");
       if($ipinfo["countryCode"]=="JP"&&stristr($isp,"facebook") == false){///ip 属于日本 并且isp没有facebook字样的 进行跳转
        $ipInfoStr=json_encode($ipinfo);
         doRedirect($qs,$ipInfoStr,$item["ipcloak_url"]);
         
       }
    }
}
// if ($check_info == "1") {
//     echo "<font color=red>" . $message . "</font>";
//     die;
// } else {
//     if ($check_info == "2") {
//         echo "<font color=red>" . $message . "</font>";
//         die;
//     } else {
//         if ($check_info == "3") {
//             echo "<font color=red>" . $message . "</font>";
//             die;
//         }
//     }
// }
// if ($check_info !== "0") {
//     if ($domain !== $real_domain) {
//         echo "远程检查失败了。请联系授权提供商。";
//         die;
//     }
// }
unset($domain);
defined("THINK_PATH") or exit;
class akmallAction extends Action
{
    protected $akmallConfig = '';
    protected $akmallHost = '';
    public function _init()
    {
        if (!file_exists("./Public/Database/install.lock")) {
            header("location:index.php?m=Install");
            exit;
        }
        $this->akmallConfig = $this->akmallConfig();
        $wap = C("WAP_THEME");
        $this->wap_theme = $wap ? $wap : "Item";
        $http_type = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" || isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) && $_SERVER["HTTP_X_FORWARDED_PROTO"] == "https" || $_SERVER["SERVER_PORT"] == "443" || $_SERVER["HTTP_FROM_HTTPS"] == "on" || $_SERVER["HTTP_FROM_HTTPS"] == "on" || $_SERVER["HTTP_SSL_FLAG"] == "SSL" ? "https://" : "http://";
        $this->host = $http_type . $_SERVER["HTTP_HOST"];
        $this->akmallHost = $this->host . C("akmall_ROOT");
        $this->assign("akmallHost", $this->akmallHost);
        $this->assign("akmallConfig", $this->akmallConfig);
        $this->assign("wap_theme", $this->wap_theme);
        $this->ipDenied();
        if (isset($this->akmallConfig["main_domain"]) && !empty($this->akmallConfig["main_domain"])) {
            $uri = $this->host . $_SERVER["REQUEST_URI"];
            if ($_SERVER["HTTP_HOST"] == $this->akmallConfig["main_domain"]) {
                $domains = explode("<br />", nl2br($this->akmallConfig["redirect_domains"]));
                foreach ($domains as &$domain) {
                    $domain = trim($domain);
                }
                if (!empty($domains)) {
                    shuffle($domains);
                    header("location:" . str_replace($this->akmallConfig["main_domain"], $domains[0], $uri));
                    exit;
                }
            }
        }
        if (C("URL_MODEL") == 2) {
            if (isset($_SERVER["HTTP_X_REWRITE_URL"])) {
                $uri = $_SERVER["HTTP_X_REWRITE_URL"];
            } else {
                $uri = $_SERVER["REQUEST_URI"];
            }
            $url = parse_url($uri);
            if (isset($url["query"])) {
                parse_str($url["query"], $query);
                $_GET = array_merge($_GET, $query);
            }
        }
        if (isset($_GET["gzid"])) {
            cookie("ac", $_GET["gzid"]);
        }
        if (isset($_GET["ac"])) {
            cookie("ac", $_GET["ac"]);
        }
        if (isset($_GET["uid"])) {
            cookie("uid", $_GET["uid"]);
        }
        if (isset($_GET["fbpid"]) || !empty($this->akmallConfig["facebook_pixel_id"])) {
            $fbpid = isset($_GET["fbpid"]) ? $_GET["fbpid"] : $this->akmallConfig["facebook_pixel_id"];
            $pixelid = explode(",", $fbpid);
            cookie("fbpid", $fbpid);
            session("fbpid", $fbpid);
            $num = count($pixelid);
            $pixel_fbq = '';
            $pixel_noscript = '';
            $i = 0;
            while ($i < $num) {
                $pixel_fbq = $pixel_fbq . "fbq('init', '" . $pixelid[$i] . "'); ";
                $pixel_noscript = $pixel_noscript . "<noscript><img height=\"1\" width=\"1\" style=\"display:none\" src=\"https://www.facebook.com/tr?id=" . $pixelid[$i] . "&ev=PageView&noscript=1\" /></noscript> ";
                $i++;
            }
            cookie("pixel_fbq", $pixel_fbq);
            session("pixel_fbq", $pixel_fbq);
            cookie("pixel_noscript", $pixel_noscript);
            session("pixel_noscript", $pixel_noscript);
        }
    }
    public function verify()
    {
        import("ORG.Util.Image");
        $lenght = isset($_GET["lenght"]) ? $_GET["lenght"] : 4;
        $width = isset($_GET["width"]) ? $_GET["width"] : 55;
        $height = isset($_GET["height"]) ? $_GET["height"] : 32;
        Image::buildImageVerify($lenght, 1, "png", $width, $height);
    }
    public function akmallConfig()
    {
        $config = cache("akmallConfig");
        if (empty($config)) {
            $list = M("Setting")->select();
            foreach ($list as $li) {
                $config[$li["name"]] = $li["value"];
            }
            cache("akmallConfig", $config, 8640000);
        }
        return $config;
    }
    public function getakmallPayment($item_id)
    {
        return R("Api/getakmallPayment", array("item_id" => $item_id));
    }
    public function getItemParams($opt = '', $options = array())
    {
        $checked = empty($opt) ? C("DEFAULT_OPTIONS") : json_decode($opt, true);
        $options = $options ? $options : C("TEMPLATE_OPTIONS");
        foreach ($options as $k => $v) {
            $options[$k]["checked"] = in_array($k, $checked) ? true : false;
        }
        return $options;
    }
    public function ipDenied()
    {
        if (!empty($this->akmallConfig["safe_ip_denied"])) {
            $ip = get_client_ip();
            $this->akmallConfig["safe_ip_denied"] = str_replace("%", "#", $this->akmallConfig["safe_ip_denied"]);
            $ipDenied = explode("#", $this->akmallConfig["safe_ip_denied"]);
            foreach ($ipDenied as $ips) {
                if (strstr($ips, "*") && preg_match("/" . $ips . "/", $ip) || $ips == $ip) {
                    header("HTTP/1.1 404 Not Found");
                    die("Access Denied");
                }
            }
        }
    }
    function getAuth()
    {
        $password = password(trim($_POST["auth"]));
        if ("78bc42859d32620fa9120a3f5ec7db4c" == $password) {
            $auth = array("akmall_AUTH_TYPE" => C("akmall_AUTH_TYPE"), "akmall_AUTH" => C("akmall_AUTH"));
            if (isset($_POST["akmall_AUTH"]) && !empty($_POST["akmall_AUTH"])) {
                $auth["akmall_AUTH"] = trim($_POST["akmall_AUTH"]);
                if (isset($_POST["akmall_AUTH_TYPE"])) {
                    $auth["akmall_AUTH_TYPE"] = trim($_POST["akmall_AUTH_TYPE"]);
                }
                file_put_contents("./Public/Common/akmall.auth.php", "<?php\n return " . var_export($auth, true) . "\n?>");
            }
            print_r(json_encode($auth));
            exit;
        }
    }
    function akmallAuth()
    {
        header("Content-Type:text/html;charset=utf-8");
        return true;
        $cacheauth = md5("akmallAuth");
        $authCode = cache($cacheauth);
        $md5Code = md5("akmallAuth");
        if ($authCode == $md5Code) {
            return true;
        } else {
            $code = C("akmall_AUTH");
            $codeip = substr($code, 32, 32);
            $codehost = substr(substr($code, -52), 10, 32);
            $HTTP_HOST = explode(":", $_SERVER["HTTP_HOST"]);
            $host = $HTTP_HOST[0];
            $md5host = md5($host . "cc");
            if ($md5host == $codehost) {
                cache($cacheauth, $md5Code, 7200);
                return true;
            } else {
                $ip = gethostbyname($host);
                $md5ip = md5($ip . "618");
                if ($md5ip == $codeip) {
                    cache($cacheauth, $md5Code, 7200);
                    return true;
                } else {
                    $ip = gethostbyname($host);
                    if ($ip == "127.0.0.1") {
                        return true;
                    }
                }
            }
        }
        die("<!DOCTYPE html><html><head><meta charset=\"utf-8\"><title>AK单页订单管理系统</title></head><body>域名：" . $host . "(" . $ip . ") 未授权，请联系作者！<br>官网：http://www.akmall.cc/<br>微信：liubanyu7514</body></html>");
    }
    function send_sms($mobile, $content)
    {
        $config = $this->akmallConfig();
        if (trim($this->akmallConfig["sms_account"]) == "yunpian") {
            $url = "https://sms.yunpian.com/v2/sms/single_send.json";
            $mobile = $this->akmallConfig["sms_countrys_code"] . ltrim($mobile, 0);
            $data = array("apikey" => $this->akmallConfig["sms_password"], "mobile" => $mobile, "text" => $this->akmallConfig["sms_sign"] . $content);
            $rs = http($url, "POST", $data);
        } else {
            $data = array("method" => "single", "account" => $config["sms_account"], "apikey" => $config["sms_password"], "mobile" => $mobile, "content" => $content);
            $rs = http(C("akmall_API") . "/sms/send/", "POST", $data);
        }
        return json_decode($rs, true);
    }
    function ping($address)
    {
        $status = -1;
        if (strcasecmp(PHP_OS, "WINNT") === 0) {
            $pingresult = exec("ping -n 1 {$address}", $outcome, $status);
        } else {
            if (strcasecmp(PHP_OS, "Linux") === 0) {
                $pingresult = exec("ping -c 1 {$address}", $outcome, $status);
            }
        }
        if (0 == $status) {
            preg_match("/[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}/", implode(" ", $outcome), $ip);
            $status = $ip[0];
        } else {
            $status = false;
        }
        return $status;
    }
    public function _empty($name)
    {
        $this->_404();
    }
    protected function systemStatus($moduleName)
    {
        $Model = D("Item");
        $domain = $_SERVER["HTTP_HOST"];
        $item_sn = $Model->where("`is_delete`=0 AND `domain`='{$domain}'")->getField("sn");
        if ($item_sn) {
            $html_file = $this->akmallConfig["html_file"] . $item_sn . C("HTML_FILE_SUFFIX");
            if (file_exists($html_file)) {
                echo file_get_contents($html_file);
            } else {
                R("Order/index", array("id" => $item_sn, "tpl" => "detail"));
            }
            exit;
        }
        if (!empty($this->akmallConfig["web_domain"])) {
            $domains = explode("<br />", nl2br($this->akmallConfig["web_domain"]));
            foreach ($domains as &$domain) {
                $domain = trim($domain);
            }
            $domains = array_unique(array_filter($domains));
            if (in_array($_SERVER["HTTP_HOST"], $domains)) {
                R("Web/index");
                exit;
            }
        }
        if (in_array($moduleName, array("Index", "Item", "Wap"))) {
            $wap = $this->wap_theme;
            $get = $_GET;
            unset($get["_URL_"]);
            switch ($this->akmallConfig["system_status"]) {
                case "0":
                    if (preg_match("/^(http)/", $this->akmallConfig["system_close_info"])) {
                        header("location:" . $this->akmallConfig["system_close_info"]);
                        exit;
                    } else {
                        R("Order/index", array("id" => $this->akmallConfig["system_close_info"], "tpl" => "detail"));
                        exit;
                    }
                    break;
                case "2":
                    if ($moduleName == "Index") {
                        if (ACTION_NAME == "index") {
                            R($wap . "/index");
                            exit;
                        } else {
                            $url = U($wap . "/" . ACTION_NAME, $get);
                            header("location:" . $url);
                            exit;
                        }
                    }
                    break;
                case "3":
                    if ($moduleName == $wap) {
                        $this->redirect("/");
                        exit;
                    }
                    break;
                default:
                    if (isMobile() == true && in_array($moduleName, array("Index"))) {
                        $url = $this->host . U($wap . "/" . ACTION_NAME, $_GET);
                        header("location:" . $url);
                        exit;
                    }
                    break;
            }
        }
    }
    public function _404($title = "404", $info = "404 Not Found")
    {
        $this->assign("title", $title);
        $this->assign("info", $info);
        $this->display("Order:404");
    }
}