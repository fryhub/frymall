<?php
class PayModel extends Model {
private $akmallHost = '';
public function __construct(){
$http_type = ((isset($_SERVER['HTTPS']) &&$_SERVER['HTTPS'] == 'on') ||(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ?'https://': 'http://';
$this->akmallHost = $http_type.$_SERVER['HTTP_HOST'].C('akmall_ROOT');
}
public function alipay($data,$akmallConfig){
import('ORG.AlipayDirect.Alipay');
$param  = array(
'notify_url'=>$this->akmallHost.'/Api/alipay.php',
'return_url'=>$this->akmallHost.'/Api/alipayCallbak.php',
'merchant_url'=>$this->akmallHost,
'seller_email'=>$akmallConfig['alipay_mail'],
'out_trade_no'=>$data['order_no'],
'total_fee'=>floatval($data['total_price']),
'subject'=>$data['item_name'].(empty($data['item_params'])?'':'-'.$data['item_params']),
);
$Alipay = new Alipay( $akmallConfig);
$Alipay->submit($param);
}
public function alipayWap($data,$akmallConfig){
import('ORG.AliayWap.Alipay');
$param  = array(
'notify_url'=>$this->akmallHost.'/Api/alipayWap.php',
'call_back_url'=>$this->akmallHost.'/Api/alipayCallbak.php',
'merchant_url'=>$this->akmallHost,
'seller_email'=>$akmallConfig['alipay_mail'],
'out_trade_no'=>$data['order_no'],
'total_fee'=>floatval($data['total_price']),
'subject'=>$data['item_name'].(empty($data['item_params'])?'':'-'.$data['item_params']),
);
$Alipay = new Alipay($akmallConfig);
$Alipay->submit($param);
}
public function alipayWap($data,$akmallConfig){
Vendor('alipay.wap.lib.alipay_submit#class');
$out_trade_no = $data['order_no'];
$subject = $data['item_name'].(empty($data['item_params'])?'':'-'.$data['item_params']);
$total_fee = floatval($data['total_price']);
$show_url = $data['url'];
$body = '';
$alipay_config['partner'] = $akmallConfig['alipay_pid'];
$alipay_config['seller_id']	= $akmallConfig['alipay_mail'];
$alipay_config['key']   = $akmallConfig['alipay_key'];
$alipay_config['notify_url'] = $this->akmallHost.'/Api/alipayWap.php';
$alipay_config['return_url'] = $this->akmallHost.'/Api/alipayCallbak.php';
$alipay_config['sign_type']    = strtoupper('MD5');
$alipay_config['input_charset']= strtolower('utf-8');
$alipay_config['cacert']    = getcwd().'\\cacert.pem';
$alipay_config['transport']    = 'http';
$alipay_config['payment_type'] = "1";
$alipay_config['service'] = "alipay.wap.create.direct.pay.by.user";
$parameter = array(
"service"=>$alipay_config['service'],
"partner"=>$alipay_config['partner'],
"seller_id"=>$alipay_config['seller_id'],
"payment_type"=>$alipay_config['payment_type'],
"notify_url"=>$alipay_config['notify_url'],
"return_url"=>$alipay_config['return_url'],
"_input_charset"=>trim(strtolower($alipay_config['input_charset'])),
"out_trade_no"=>$out_trade_no,
"subject"=>$subject,
"total_fee"=>$total_fee,
"show_url"=>$show_url,
"app_pay"=>"Y",
"body"=>$body,
);
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"get","confirm");
echo $html_text;
}
public function alipayDb($data,$akmallConfig){
Vendor('alipay.dbPay.alipay#class');
$param  = array(
'notify_url'=>$this->akmallHost.'/Api/alipayDb.php',
'return_url'=>$this->akmallHost.'/Api/alipayCallbak.php',
'merchant_url'=>$this->akmallHost,
'seller_email'=>$akmallConfig['alipay_mail'],
'out_trade_no'=>$data['order_no'],
'price'=>$data['total_price'],
'subject'=>$data['item_name'].'  '.$data['item_params'],
'name'=>$data['name'],
'address'=>$data['address'],
'zcode'=>$data['zcode'],
'receive_phone'=>$data['mobile'],
'receive_mobile'=>$data['mobile'],
);
$alipay = new alipay($akmallConfig);
$alipay->submit($param);
}
public function alipayNotify($akmallConfig){
$out_trade_no = $_POST['out_trade_no'];
$trade_no = $_POST['trade_no'];
$trade_status = $_POST['trade_status'];
$AlipayLog = M('AlipayLog');
if($vo = $AlipayLog->create($_POST)){
$vo['pay_type'] = 1;
$AlipayLog->add($vo);
}
import('ORG.AlipayDirect.Alipay');
$Alipay = new Alipay($akmallConfig);
$alipay_config = $Alipay->getConfig();
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();
if($verify_result) {
if($trade_status == 'TRADE_FINISHED') {
logResult("TRADE_FINISHED");
}else if ($trade_status == 'TRADE_SUCCESS') {
$where  = array('order_no'=>trim($out_trade_no));
$order = M('Order')->field('id,item_id,order_no,status,mobile,mail')->where($where)->find();
if($order['status']==0){
$data = array(
'order_id'=>$order['id'],
'status'=>1,
'remark'=>htmlspecialchars($_POST['remark']),
);
$data['sign'] = createSign($data,C('akmall_KEY'));
R('Api/akmallUpdateStatus',array('data'=>$data));
}
}
$this->paySuccess($order['id']);
echo "success";
}else {
echo "fail";
}
}
public function alipayWapNotify1($akmallConfig){
import('ORG.AliayWap.Alipay');
$Alipay = new Alipay($akmallConfig);
$alipayNotify = new AlipayNotify($Alipay->getConfig());
$verify_result = $alipayNotify->verifyNotify();
if($verify_result) {
$xml = simplexml_load_string($_REQUEST['notify_data']);
if( !empty($xml->notify_id) ) {
$out_trade_no = $xml->out_trade_no;
$trade_no = $xml->trade_no;
$trade_status = $xml->trade_status;
$buyer_email = $xml->buyer_email;
$data = (array)$xml;
$AlipayLog = M('AlipayLog');
if($vo = $AlipayLog->create($_POST)){
$vo['pay_type'] = 2;
$AlipayLog->add($vo);
}
if($trade_status == 'TRADE_FINISHED') {
echo "success";
}else if ($trade_status == 'TRADE_SUCCESS') {
$where  = array('order_no'=>trim($out_trade_no));
$order = M('Order')->field('id,item_id,order_no,status,mobile,mail')->where($where)->find();
if($order['status']==0){
$data = array(
'order_id'=>$order['id'],
'status'=>1,
'remark'=>htmlspecialchars($_POST['remark']),
);
$data['sign'] = createSign($data,C('akmall_KEY'));
R('Api/akmallUpdateStatus',array('data'=>$data));
}
$this->paySuccess($order['id']);
echo "success";
}
}
}else {
echo "fail";
}
}
public function alipayWapNotify2($akmallConfig){
Vendor('alipay.wap.lib.alipay_notify#class');
$alipay_config['partner'] = $akmallConfig['alipay_pid'];
$alipay_config['seller_id']	= $akmallConfig['alipay_mail'];
$alipay_config['key']   = $akmallConfig['alipay_key'];
$alipay_config['notify_url'] = $this->akmallHost.'/Api/alipayWap.php';
$alipay_config['return_url'] = $this->akmallHost.'/Api/alipayCallbak.php';
$alipay_config['sign_type']    = strtoupper('MD5');
$alipay_config['input_charset']= strtolower('utf-8');
$alipay_config['cacert']    = getcwd().'\\cacert.pem';
$alipay_config['transport']    = 'http';
$alipay_config['payment_type'] = "1";
$alipay_config['service'] = "alipay.wap.create.direct.pay.by.user";
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();
if($verify_result) {
$out_trade_no = $_POST['out_trade_no'];
$trade_no = $_POST['trade_no'];
$trade_status = $_POST['trade_status'];
$AlipayLog = M('AlipayLog');
if($vo = $AlipayLog->create($_POST)){
$vo['pay_type'] = 2;
$AlipayLog->add($vo);
}
if($_POST['trade_status'] == 'TRADE_FINISHED') {
}else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
$where  = array('order_no'=>trim($out_trade_no));
$order = M('Order')->field('id,item_id,order_no,status,mobile,mail')->where($where)->find();
if($order['status']==0){
$data = array(
'order_id'=>$order['id'],
'status'=>1,
'remark'=>htmlspecialchars($_POST['remark']),
);
$data['sign'] = createSign($data,C('akmall_KEY'));
R('Api/akmallUpdateStatus',array('data'=>$data));
}
$this->paySuccess($order['id']);
echo "success";
}else {
echo "fail";
}
}
}
public function alipayDbNotify($akmallConfig){
Vendor('alipay.dbPay.alipay#class');
$alipay = new alipay($akmallConfig);
$alipayNotify = new AlipayNotify($alipay->getConfig());
$verify_result = $alipayNotify->verifyNotify();
$verify_result =1;
if($verify_result) {
$out_trade_no = $_POST['out_trade_no'];
$trade_no = $_POST['trade_no'];
$trade_status = $_POST['trade_status'];
$where  = array('order_no'=>trim($out_trade_no));
$order = M('Order')->where($where)->find();
if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
echo "success";
}else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
if($order['status']==0){
$data = array(
'order_id'=>$order['id'],
'status'=>1,
'remark'=>htmlspecialchars($_POST['trade_no']),
);
$data['sign'] = createSign($data,C('akmall_KEY'));
R('Api/akmallUpdateStatus',array('data'=>$data));
}
echo "success";
}else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
$data = array(
'order_id'=>$order['id'],
'status'=>3,
'remark'=>htmlspecialchars($_POST['remark']),
);
$data['sign'] = createSign($data,C('akmall_KEY'));
R('Api/akmallUpdateStatus',array('data'=>$data));
echo "success";
}else if($_POST['trade_status'] == 'TRADE_FINISHED') {
$data = array(
'order_id'=>$order['id'],
'status'=>4,
'remark'=>htmlspecialchars($_POST['remark']),
);
$data['sign'] = createSign($data,C('akmall_KEY'));
R('Api/akmallUpdateStatus',array('data'=>$data));
echo "success";
}else {
echo "success";
}
}else {
echo "fail";
}
}
public function wxPayNotify(){
$result_code = $_POST['result_code'];
$out_trade_no = explode('-',$_POST['out_trade_no']);
$transaction_id = $_POST['transaction_id'];
if('SUCCESS'===$result_code){
$where  = array('order_no'=>trim($out_trade_no[0]));
$order = M('Order')->field('id,item_id,order_no,status,mobile,mail')->where($where)->find();
if($order['status']==0){
$data = array(
'order_id'=>$order['id'],
'status'=>1,
'remark'=>htmlspecialchars($transaction_id),
);
$data['sign'] = createSign($data,C('akmall_KEY'));
R('Api/akmallUpdateStatus',array('data'=>$data));
}
$this->paySuccess($order['id']);
echo "success";
}
}
public function yunpayNotify($akmallConfig){
$yun_config['partner'] = $akmallConfig['yunpay_pid'];
$yun_config['key'] = $akmallConfig['yunpay_key'];
$seller_email = $akmallConfig['yunpay_email'];
$GLOBALS['i2ekeys']=$yun_config['key'];
Vendor('yunpay.lib.yun_md5#function');
$yunNotify = md5Verify($_REQUEST['i1'],$_REQUEST['i2'],$_REQUEST['i3'],$yun_config['key'],$yun_config['partner']);
if($yunNotify) {
$out_trade_no = $_REQUEST['i2'];
$trade_no = $_REQUEST['i4'];
$yunprice=$_REQUEST['i1'];
$where  = array('order_no'=>trim($out_trade_no));
$order = M('Order')->field('id,item_id,order_no,status,mobile,mail')->where($where)->find();
if($order['status']==0){
$data = array(
'order_id'=>$order['id'],
'status'=>1,
'remark'=>htmlspecialchars($trade_no),
);
$data['sign'] = createSign($data,C('akmall_KEY'));
R('Api/akmallUpdateStatus',array('data'=>$data));
}
$this->paySuccess($order['id']);
echo "success";
}else {
echo "fail";
}
}
function registNotify(){
list($user_id,$coupon,$time) = explode('_',$_POST['out_trade_no']);
M('User')->where('id='.$user_id)->setField('status',1);
if(!empty($coupon)){
$data = array('is_used'=>1,'used_user'=>$user_id,'used_time'=>time());
M('Coupon')->where("code='{$coupon}'")->save($data);
}
echo "success";
}
function codepayNotify($akmallConfig){
ksort($_POST);
reset($_POST);
$codepay_key= $akmallConfig['codepay_key'];
$sign = '';
foreach ($_POST AS $key =>$val) {
if ($val == ''||$key == 'sign') continue;
if ($sign) $sign .= '&';
$sign .= "$key=$val";
}
if (!$_POST['pay_no'] ||md5($sign .$codepay_key) != $_POST['sign']) {
exit('fail');
}else {
$order_no = trim($_POST['pay_id']);
$money = (float)$_POST['money'];
$price = (float)$_POST['price'];
$param = $_POST['param'];
$pay_no = $_POST['pay_no'];
$where  = array('order_no'=>trim($order_no));
$order = M('Order')->field('id,item_id,order_no,status,mobile,mail,total_price')->where($where)->find();
if($order['status']==0){
$data = array(
'order_id'=>$order['id'],
'status'=>1,
'remark'=>htmlspecialchars($pay_no),
);
$data['sign'] = createSign($data,C('akmall_KEY'));
R('Api/akmallUpdateStatus',array('data'=>$data));
}
$this->paySuccess($order['id']);
exit('success');
}
}
function paypayNotify($akmallConfig){
$api_user = $akmallConfig['paypay_user'];
$api_key = $akmallConfig['paypay_key'];
$params = array(
'ppz_order_id'=>$_POST['ppz_order_id'],
'order_id'=>$_POST['order_id'],
'price'=>$_POST['price'],
'real_price'=>$_POST['real_price'],
'order_info'=>$_POST['order_info'],
);
ksort($params);
$param_str = $api_key;
foreach($params as $param){
$param_str .= $param;
}
$signature = md5($param_str);
if($_POST['signature'] == $signature){
$where  = array('order_no'=>trim($_POST['order_id']));
$order = M('Order')->field('id,item_id,order_no,status,mobile,mail,total_price')->where($where)->find();
if($order['status']==0){
$data = array(
'order_id'=>$order['id'],
'status'=>1,
'remark'=>htmlspecialchars($_POST['ppz_order_id']),
);
$data['sign'] = createSign($data,C('akmall_KEY'));
R('Api/akmallUpdateStatus',array('data'=>$data));
}
$this->paySuccess($order['id']);
exit('success');
}else{
errorLog($_POST,'paypay_signerror');
}
}
function gleepayNotify($akmallConfig){
if(!isset($_POST) ||empty($_POST["signInfo"])) {
$_POST = $_GET;
}
$signKey       = $akmallConfig['creditcard_key'];
$merNo		   = $akmallConfig["creditcard_mid"];
$gatewayNo     = $akmallConfig["creditcard_gateway"];
$tradeNo       = $_POST["tradeNo"];
$orderNo       = $_POST["orderNo"];
$orderAmount   = $_POST["orderAmount"];
$orderCurrency = $_POST["orderCurrency"];
$orderStatus   = $_POST["orderStatus"];
$orderInfo     = $_POST["orderInfo"];
$signInfo      = $_POST["signInfo"];
$remark        = $_POST["remark"];
$sha256src     = $merNo.$gatewayNo.$tradeNo.$orderNo.$orderCurrency.$orderAmount.$orderStatus.$orderInfo.$signKey;
$mysign		   = strtoupper(hash("sha256",$sha256src));
$payResult = "";
if($mysign == $signInfo){
if($orderStatus == "1"){
$payResult = "Congratulations,payment is successful !";
$where  = array('order_no'=>trim($orderNo));
$order = M('Order')->field('id,item_id,order_no,status,mobile,mail,total_price')->where($where)->find();
if($order['status']==0){
$data = array(
'order_id'=>$order['id'],
'status'=>1,
'remark'=>htmlspecialchars($tradeNo),
);
$data['sign'] = createSign($data,C('akmall_KEY'));
R('Api/akmallUpdateStatus',array('data'=>$data));
}
$this->paySuccess($order['id']);
}else if($orderStatus == "-1"||$orderStatus == "-2"){
$payResult = "Processing";
}else if($orderStatus == "0"){
$payResult = "Sorry,payment is failure !";
}
}else {
$payResult = "Data validation failed";
}
session_destroy();
echo $payResult;
}
function paySuccess($order_id){
$Order = M('Order');
$Coupon = M('Coupon');
$info = $Order->where(array('id'=>$order_id))->field('id,coupon')->find();
if($info &&!empty($info['coupon'])){
$coupon_value = $Coupon->where('is_used=0 and types=2')->getField('value');
if($coupon_value){
$data = array('is_used'=>1,'used_user'=>$order_id,'used_time'=>time());
$Coupon->where("code='{$info['coupon']}'")->save($data);
}
$where = "id!=$order_id AND coupon='{$info['coupon']}'";
$Order->where($where)->setInc('total_price',$coupon_value);
$Order->where($where)->setField('coupon','');
}
}
}
?>