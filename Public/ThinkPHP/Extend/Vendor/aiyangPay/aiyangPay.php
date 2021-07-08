<?php
//����֧��
class aiyangPay{
	
	protected $url = 'http://pay.admin523.cn/bank/';//�ӿڵ�ַ
	protected $parter = '1740';//�̻�ID
	protected $key = 'ac55bc3d9909478786155e4674b6235d';//�̻�Key
	
	function __construct($parter,$key){
		$this->parter = $parter;
		$this->key = $key;
	}
	
	public function getPayUrl($data=array()){
		//$data = array('type'=>1007,'total_price'=>'1.00','out_trade_no'=>'','notify_url'=>'','return_url'=>'','attach'=>'',);
		$type = isset($data['type'])?$data['type']:'1007';

		$options = array(
			'parter'=>$this->parter, //�̻�ID
			'type'=>$type, //��������
			'value'=>$data['total_price'], //��λԪ������ң���2 λС��
			'orderid'=>$data['out_trade_no'], //�̻�ϵͳ�����ţ��ö����Ž���Ϊ����ӿڵķ������ݡ���ֵ�����̻�ϵ��Ψһ������ϵͳ��ʱ������ֵ�Ƿ�Ψһ
			'callbackurl'=>$data['notify_url'],
			'hrefbackurl'=>$data['return_url'],
			'payerIp'=>$this->ip(),
			'attach'=>$data['attach'],
		);
		return $this->url.'?'.http_build_query($options).'&sign='.$this->paySign($options,$this->key);
		//header('location:'.$payUrl);

	}
	
	//֧��ǩ��
	function paySign($options){
		$opt = array(
			'parter'=>$options['parter'], //�̻�ID
			'type'=>$options['type'], //��������
			'value'=>$options['value'], //��λԪ������ң���2 λС��
			'orderid'=>$options['orderid'], //�̻�ϵͳ�����ţ��ö����Ž���Ϊ����ӿڵķ������ݡ���ֵ�����̻�ϵ��Ψһ������ϵͳ��ʱ������ֵ�Ƿ�Ψһ
			'callbackurl'=>$options['callbackurl'],
		);
		$string = '';
		foreach($opt as $k=>$v){
			$string .=$k.'='.$v.'&';
		}
		return md5(substr($string,0,-1).$this->key);
	}
	//�첽ǩ��
	function notifySign($options){
		$opt = array(
			'orderid'=>$options['orderid'], //���й������̻�ϵͳ����� orderid
			'opstate'=>$options['opstate'], //֧��״̬0��֧���ɹ� -1 ���������Ч -2 ǩ������
			'ovalue'=>$options['ovalue'], //����ʵ��֧������λԪ
		);
		$string = '';
		foreach($opt as $k=>$v){
			$string .=$k.'='.$v.'&';
		}
		return md5(substr($string,0,-1).$this->key);
	}
	//��ȡIP��ַ
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