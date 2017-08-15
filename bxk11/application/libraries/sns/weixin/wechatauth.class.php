<?php
/**
 *	微信开放平台PHP-SDK, 官方API部分
 *  @author  yezhulin <liuguangpingtest@163.com>
 *  @link #
 *  @version 1.2
 *  usage:
 *   $options = array(
 *			'token'=>'tokenaccesskey', //填写你设定的key
 *			'appid'=>'wxdk1234567890', //填写高级调用功能的app id
 *			'appsecret'=>'xxxxxxxxxxxxxxxxxxx', //填写高级调用功能的密钥
 *			'partnerid'=>'88888888', //财付通商户身份标识
 *			'partnerkey'=>'', //财付通商户权限密钥Key
 *			'paysignkey'=>'' //商户签名密钥Key
 *		);
 *	 $weObj = new Wechat($options);
 */
class Wechatauth
{
	
	const OAUTH_PREFIX = 'https://open.weixin.qq.com/connect/qrconnect?';
	const OAUTH_TOKEN_PREFIX = 'https://api.weixin.qq.com/sns/oauth2';
	const OAUTH_TOKEN_URL = '/access_token?';
	const OAUTH_REFRESH_URL = '/refresh_token?';
	const OAUTH_USERINFO_URL = 'https://api.weixin.qq.com/sns/userinfo?';
	const OAUTH_ISAUTH_URL = 'https://api.weixin.qq.com/sns/auth?';
	
	private $appid;
	private $appsecret;
	private $user_token;
	private $access_token;
	public $debug =  false;

	
	public function __construct($options)
	{
		$this->appid = isset($options['appid'])?$options['appid']:'';
		$this->appsecret = isset($options['appsecret'])?$options['appsecret']:'';
		$this->debug = isset($options['debug'])?$options['debug']:false;

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
	
	/**
	 * 通用auth验证方法，暂时仅用于菜单更新操作
	 * @param string $appid
	 * @param string $appsecret
	 */
	public function checkAuth($appid='',$appsecret=''){
		if (!$appid || !$appsecret) {
			$appid = $this->appid;
			$appsecret = $this->appsecret;
		}
		//TODO: get the cache access_token
		if($this->getTokenCache()) return $this->getTokenCache();
		$result = $this->http_get(self::API_URL_PREFIX.self::AUTH_URL.'appid='.$appid.'&secret='.$appsecret);
		if ($result)
		{
			$json = json_decode($result,true);
			if (!$json || isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			$this->access_token = $json['access_token'];
			$expire = $json['expires_in'] ? intval($json['expires_in'])-100 : 3600;
			//TODO: cache access_token
			$this->setTokenCache($expire);
			return $this->access_token;
		}
		return false;
	}

	/**
	 *获取cache access_token 操作
	 * @param string $appid
	 * @param string $appsecret
	 */
	public function getTokenCache(){
		if(!$this->token) return false;
		$timeNow = time();
		$where['service_token'] = $this->token;
		$weixinR = model('t_weixin')->getOne('*',$where);
		if($weixinR){
			$expire = intval($weixinR->access_token_expire);
			$access_token = $weixinR->access_token;
			$tokentime = intval($weixinR->access_token_time);
			$timeDifference = $timeNow-$tokentime;
			if($timeDifference>$expire){
				$this->resetAuth();
				return false;
			}else{
				$this->access_token = $access_token;
				return $this->access_token;
			}
		}else{
			return false;
		}
	}

	/**
	 * 设置cache access_token 操作
	 * @param string $appid
	 * @param string $appsecret
	 */
	public function setTokenCache($expire){
		if(!$this->token) return false;
		$timeNow = time();
		$where['service_token'] = $this->token;
		$weixinR = model('t_weixin')->getOne('*',$where);
		if($weixinR){

			$data['access_token'] = $this->access_token;
			$data['access_token_time'] = $timeNow;
			$data['access_token_expire'] = $expire;
		
			if(model('t_weixin')->updates_global($data,$where)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	/**
	 * 删除cache access_token 操作
	 * @param string $appid
	 * @param string $appsecret
	 */
	public function resetTokenCache(){
		if(!$this->token) return false;

		$where['service_token'] = $this->token;
		$weixinR = model('t_weixin')->getOne('*',$where);
		if($weixinR){

			$data['access_token'] = '';
			$data['access_token_time'] = '';
			$data['access_token_expire'] = '';
		
			if(model('t_weixin')->updates_global($data,$where)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	/**
	 * 删除验证数据
	 * @param string $appid
	 */
	public function resetAuth($appid=''){
		$this->access_token = '';
		//TODO: remove cache
		$this->resetTokenCache();
		return true;
	}
		
	/**
	 * 微信api不支持中文转义的json结构
	 * @param array $arr
	 */
	static function json_encode($arr) {
		$parts = array ();
		$is_list = false;
		//Find out if the given array is a numerical array
		$keys = array_keys ( $arr );
		$max_length = count ( $arr ) - 1;
		if (($keys [0] === 0) && ($keys [$max_length] === $max_length )) { //See if the first key is 0 and last key is length - 1
			$is_list = true;
			for($i = 0; $i < count ( $keys ); $i ++) { //See if each key correspondes to its position
				if ($i != $keys [$i]) { //A key fails at position check.
					$is_list = false; //It is an associative array.
					break;
				}
			}
		}
		foreach ( $arr as $key => $value ) {
			if (is_array ( $value )) { //Custom handling for arrays
				if ($is_list)
					$parts [] = self::json_encode ( $value ); /* :RECURSION: */
				else
					$parts [] = '"' . $key . '":' . self::json_encode ( $value ); /* :RECURSION: */
			} else {
				$str = '';
				if (! $is_list)
					$str = '"' . $key . '":';
				//Custom handling for multiple data types
				if (is_numeric ( $value ) && $value<2000000000)
					$str .= $value; //Numbers
				elseif ($value === false)
				$str .= 'false'; //The booleans
				elseif ($value === true)
				$str .= 'true';
				else
					$str .= '"' . addslashes ( $value ) . '"'; //All other things
				// :TODO: Is there any more datatype we should be in the lookout for? (Object?)
				$parts [] = $str;
			}
		}
		$json = implode ( ',', $parts );
		if ($is_list)
			return '[' . $json . ']'; //Return numerical JSON
		return '{' . $json . '}'; //Return associative JSON
	}
	
	
	
	/**
	 * 获取授权后的用户资料
	 * @param string $access_token
	 * @param string $openid
	 * @return array {openid,nickname,sex,province,city,country,headimgurl,privilege}
	 */
	public function getOauthUserinfo($access_token,$openid){
		$result = $this->http_get(self::OAUTH_USERINFO_URL.'access_token='.$access_token.'&openid='.$openid);
		if ($result)
		{
			$json = json_decode($result,true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			return $json;
		}
		return false;
	}
	
	/**
	 * oauth 授权跳转接口
	 * @param string $callback 回调URI
	 * @return string
	 */
	public function getOauthRedirect($callback,$state='',$scope='snsapi_login'){
		$state = $_SESSION['weixxinstate'] = $state?$state:md5($this->appid.time());
		return self::OAUTH_PREFIX.'appid='.$this->appid.'&redirect_uri='.urlencode($callback).'&response_type=code&scope='.$scope.'&state='.$state.'#wechat_redirect';
	}
	
	/*
	 * 通过code获取Access Token
	 * @return array {access_token,expires_in,refresh_token,openid,scope}
	 */
	public function getOauthAccessToken(){
		$code = isset($_GET['code'])?$_GET['code']:'';
		if (!$code) return false;
		$state = isset($_GET['state'])?$_GET['state']:'';
		if (!$state) return false;
		if (!isset($_SESSION['weixxinstate'])) return false;
		if ($_SESSION['weixxinstate'] != $state) return false;
		$result = $this->http_get(self::OAUTH_TOKEN_PREFIX.self::OAUTH_TOKEN_URL.'appid='.$this->appid.'&secret='.$this->appsecret.'&code='.$code.'&grant_type=authorization_code');
		if ($result)
		{
			$json = json_decode($result,true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			$this->user_token = $json['access_token'];
			return $json;
		}
		return false;
	}
	
	/**
	 * 刷新access token并续期
	 * @param string $refresh_token
	 * @return boolean|mixed
	 */
	public function getOauthRefreshToken($refresh_token){
		$result = $this->http_get(self::OAUTH_TOKEN_PREFIX.self::OAUTH_REFRESH_URL.'appid='.$this->appid.'&grant_type=refresh_token&refresh_token='.$refresh_token);

		if ($result)
		{
			$json = json_decode($result,true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			$this->user_token = $json['access_token'];
			return $json;
		}
		return false;
	}
	
	/**
	 * 检验授权凭证（access_token）是否有效
	 * @param string $access_token
	 * @param string $openid
	 * @return array {errcode,errmsg}
	 */
	public function getIsAuth($access_token,$openid){
		$result = $this->http_get(self::OAUTH_ISAUTH_URL.'access_token='.$access_token.'&openid='.$openid);
		if ($result)
		{
			$json = json_decode($result,true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			return $json;
		}
		return false;
	}
}
