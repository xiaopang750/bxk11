<?php

/**
 * 百度操作类
 * @author liuguangping
 * @version 1.0 2014/4/23
*/
class WechatMap{
	
	const BAIDU_AK = 'B2058f1845b6c30089f0fe13b753136c';
	const BAIDU_DISTANCE_URL="http://api.map.baidu.com/telematics/v3/distance?waypoints=";

	// 以下是定义model属性
	private $t_weixin;//微信公众号基本信息表
	private $lbs_reply; //微信公众平台LBS回复
	private $CI;
	private $baidu_ak;
	private $token;
	private $weObj;
	private $service_shop;
	private $service_info;

	public function __construct(){

		$this->CI = &get_instance();
		$this->CI->load->model('t_weixin_model');
		$this->t_weixin = $this->CI->t_weixin_model;
		//$this->CI->load->model('t_service_lbs_reply_model');
		//$this->lbs_reply = $this->CI->t_service_lbs_reply_model;
		$this->CI->load->model('t_service_shop_model');
		$this->service_shop = $this->CI->t_service_shop_model;
		$this->CI->load->model('t_service_info_model');
		$this->service_info = $this->CI->t_service_info_model;
		$this->CI->load->model('t_system_model');
		$this->t_system = $this->CI->t_system_model;
		$systemR = $this->t_system->get('baidu_key');
		if($systemR){
			$this->baidu_ak = $systemR->sys_value;
		}

		//$this->baidu_ak = self::BAIDU_AK;
		
		$this->token = trim($_GET['token']);
	}

	public function index(){
		
	}

	/**
	 * 根据经度，纬度得到距离
	 * @author liuguangping
	 * @version 1.0 2014/4/23
	 * @param array $newsData 
	 * 数组结构:
	 *  array(
	 *  	"0"=>array(
	 *  		'Title'=>'msg title',
	 *  		'Description'=>'summary text',
	 *  		'PicUrl'=>'http://www.domain.com/1.jpg',
	 *  		'Url'=>'http://www.domain.com/1.html'
	 *  	),
	 *  	"1"=>....
	 *  )
	*/
	public function getCompanyDistance($x,$y){

		if(!$this->baidu_ak){
			return array('还没配置地图key信息呢，您稍等或联系客服！','text');
		}
		$service_token = $this->token;
		$companies=$this->lbs_reply->getLbsInfo($service_token,6);
		//echo "<pre>";var_dump($companies);die;
		$companyInfo=array();
		$url = self::BAIDU_DISTANCE_URL;
		
		if ($companies){
			foreach ($companies as $key=>$value){
				$currentSum = $url."{$y},{$x};{$value->lbs_longitude},{$value->lbs_latitude};&ak=".$this->baidu_ak."&output=json";
				$rt = json_decode($this->http_get($currentSum),1);
				
				if (is_array($rt)){
					$ldistance = $rt['results'][0];
					if($ldistance){
						$distanceStr=$this->_getDistance(intval($ldistance));
					}else{
						$distanceStr = "0";
					}
				}else {
					$distanceStr = "0";
				}
				$imagArr['Title'] = $value->lbs_name." 电话：{$value->lbs_phone} 距离：{$distanceStr}";
				$imagArr['Description'] = $value->lbs_address;
				if(stripos($value->lbs_logourl, 'http://') === false)
					$picurl = "http://".$value->lbs_logourl;
				else
					$picurl = $value->lbs_logourl;
				$imagArr['PicUrl'] = $picurl;
				//$imagArr['Url'] = site_url('weixin/showMap/show')."?x=".$x."&y=".$y."&lbs_longitude=".$value->lbs_longitude."&lbs_latitude=".$value->lbs_latitude."&ak=".$this->baidu_ak;
				$imagArr['Url'] = site_url('weixin/showMap/showInfo')."?x=".$x."&y=".$y."&lbs_id=".$value->lbs_id."&ak=".$this->baidu_ak;
	  			$companyInfo[] = $imagArr;
			}
			return array($companyInfo,'news');
		}else{
			return array('还没配置公司信息呢，您稍等','text');	
		}
	}

	/**
	 * 根据经度，纬度得到离门店的距离
	 * @author liuguangping
	 * @version 1.0 2014/4/29
	 * @param array $newsData 
	 * 数组结构:
	 *  array(
	 *  	"0"=>array(
	 *  		'Title'=>'msg title',
	 *  		'Description'=>'summary text',
	 *  		'PicUrl'=>'http://www.domain.com/1.jpg',
	 *  		'Url'=>'http://www.domain.com/1.html'
	 *  	),
	 *  	"1"=>....
	 *  )
	*/
	public function getShopDistance($x,$y){

		if(!$this->baidu_ak){
			return array('还没配置地图key信息呢，您稍等或联系客服！','text');
		}
		$service_token = $this->token;

		$where['service_token'] = $service_token;
		$weixinR = $this->t_weixin->getOne('*',$where);
		if($weixinR){
			$service_info = $this->service_info->get($weixinR->service_id);
			if($service_info->service_status<3){
				$companies = $this->service_shop->getShopListByService($weixinR->service_id,10);
			}else{
				return array('还没配置门店信息呢，您稍等','text');
			}
			
		}else{
			return array('还没配置门店信息呢，您稍等','text');
		}
		
		
		//echo "<pre>";var_dump($companies);die;
		$companyInfo=array();
		$url = self::BAIDU_DISTANCE_URL;
		
		if ($companies){
			foreach ($companies as $key=>$value){
				$currentSum = $url."{$y},{$x};{$value->shop_longitude},{$value->shop_latitude};&ak=".$this->baidu_ak."&output=json";
				$rt = json_decode($this->http_get($currentSum),1);
				
				if (is_array($rt)){
					$ldistance = $rt['results'][0];
					if($ldistance){
						$distanceStr=$this->_getDistance(intval($ldistance));
					}else{
						$distanceStr = "0";
					}
				}else {
					$distanceStr = "0";
				}
				if($value->shop_status == 1){
					$imagArr['Title'] = $value->shop_name."旗舰店 电话：{$service_info->service_phone} 距离：{$distanceStr}";
				}else{
					$imagArr['Title'] = $value->shop_name." 距离：{$distanceStr}";
				}
				
				$imagArr['Description'] = $value->shop_address;
				$this->CI->config->load('uploads');
				$config = $this->CI->config->item('serviceShop');
				if(!$value->shop_logo){
					$value->shop_logo = $config['relative_upload'].$value->shop_pic1;
				}
				$shopLogo = $_SERVER['HTTP_HOST'].$value->shop_logo;
				if(stripos($shopLogo, 'http://') === false)
					$picurl = "http://".$shopLogo;
				else
					$picurl = $shopLogo;
				$imagArr['PicUrl'] = $picurl;
				//$imagArr['Url'] = site_url('weixin/showMap/show')."?x=".$x."&y=".$y."&lbs_longitude=".$value->lbs_longitude."&lbs_latitude=".$value->lbs_latitude."&ak=".$this->baidu_ak;
				$imagArr['Url'] = site_url('weixin/showMap/showShopInfo')."?x=".$x."&y=".$y."&shop_id=".$value->shop_id."&ak=".$this->baidu_ak;
	  			$companyInfo[] = $imagArr;
			}
			return array($companyInfo,'news');
		}else{
			return array('还没配置门店信息呢，您稍等','text');	
		}
	}

	/**
	 * 计算距离
	 * @author liuguangping
	 * @version 1.0 2014/4/23
	*/
	private function _getDistance($distance){
		if ($distance>1000){
			$distanceStr=(round($distance/1000,2)).'公里';
		}else {
			$distanceStr=$distance.'米';
		}
		return $distanceStr;
	}

	/**
	 * GET 请求
	 * @param string $url
	 */
	private function http_get($url){
		$oCurl = curl_init();
		if(stripos($url,"https://")!==FALSE){
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
		}
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		if(intval($aStatus["http_code"])==200){
			return $sContent;
		}else{
			return false;
		}
	}
	
	/**
	 * POST 请求
	 * @param string $url
	 * @param array $param
	 * @return string content
	 */
	private function http_post($url,$param){
		$oCurl = curl_init();
		if(stripos($url,"https://")!==FALSE){
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
		}
		if (is_string($param)) {
			$strPOST = $param;
		} else {
			$aPOST = array();
			foreach($param as $key=>$val){
				$aPOST[] = $key."=".urlencode($val);
			}
			$strPOST =  join("&", $aPOST);
		}
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($oCurl, CURLOPT_POST,true);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		if(intval($aStatus["http_code"])==200){
			return $sContent;
		}else{
			return false;
		}
	}


}