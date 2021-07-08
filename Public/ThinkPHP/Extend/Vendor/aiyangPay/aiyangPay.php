<?php
//爱扬支付
class aiyangPay{
	
	protected $url = 'http://pay.admin523.cn/bank/';//接口地址
	protected $parter = '1740';//商户ID
	protected $key = 'ac55bc3d9909478786155e4674b6235d';//商户Key
	
	function __construct($parter,$key){
		$this->parter = $parter;
		$this->key = $key;
	}
	
	public function getPayUrl($data=array()){
		//$data = array('type'=>1007,'total_price'=>'1.00','out_trade_no'=>'','notify_url'=>'','return_url'=>'','attach'=>'',);
		$type = isset($data['type'])?$data['type']:'1007';

		$options = array(
			'parter'=>$this->parter, //商户ID
			'type'=>$type, //银行类型
			'value'=>$data['total_price'], //单位元（人民币），2 位小数
			'orderid'=>$data['out_trade_no'], //商户系统订单号，该订单号将作为爱扬接口的返回数据。该值需在商户系内唯一，爱扬系统暂时不检查该值是否唯一
			'callbackurl'=>$data['notify_url'],
			'hrefbackurl'=>$data['return_url'],
			'payerIp'=>$this->ip(),
			'attach'=>$data['attach'],
		);
		return $this->url.'?'.http_build_query($options).'&sign='.$this->paySign($options,$this->key);
		//header('location:'.$payUrl);

	}
	
	//支付签名
	function paySign($options){
		$opt = array(
			'parter'=>$options['parter'], //商户ID
			'type'=>$options['type'], //银行类型
			'value'=>$options['value'], //单位元（人民币），2 位小数
			'orderid'=>$options['orderid'], //商户系统订单号，该订单号将作为爱扬接口的返回数据。该值需在商户系内唯一，爱扬系统暂时不检查该值是否唯一
			'callbackurl'=>$options['callbackurl'],
		);
		$string = '';
		foreach($opt as $k=>$v){
			$string .=$k.'='.$v.'&';
		}
		return md5(substr($string,0,-1).$this->key);
	}
	//异步签名
	function notifySign($options){
		$opt = array(
			'orderid'=>$options['orderid'], //上行过程中商户系统传入的 orderid
			'opstate'=>$options['opstate'], //支付状态0：支付成功 -1 请求参数无效 -2 签名错误
			'ovalue'=>$options['ovalue'], //订单实际支付金额，单位元
		);
		$string = '';
		foreach($opt as $k=>$v){
			$string .=$k.'='.$v.'&';
		}
		return md5(substr($string,0,-1).$this->key);
	}
	//获取IP地址
	function ip($type = 0,$adv=false) {
		$type       =  $type ? 1 : 0;
		static $ip  =   NULL;
		if ($ip !== NULL) return $ip[$type];
		if($adv){
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				$pos    =   array_search('unknown',$arr);
				if(false !== $pos) unset($arr[$pos]);
				$ip     =   trim($arr[0]);
			}elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
				$ip     =   $_SERVER['HTTP_CLIENT_IP'];
			}elseif (isset($_SERVER['REMOTE_ADDR'])) {
				$ip     =   $_SERVER['REMOTE_ADDR'];
			}
		}elseif (isset($_SERVER['REMOTE_ADDR'])) {
			$ip     =   $_SERVER['REMOTE_ADDR'];
		}
		$long = sprintf("%u",ip2long($ip));
		$ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
		return $ip[$type];
	}
 
}






?>