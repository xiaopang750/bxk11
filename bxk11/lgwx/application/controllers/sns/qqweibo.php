<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Generator By "Auto Codeigniter" At 2013/12/16 16:10:17 
 *       liuguangpingAuthor: liuguangping
 *        Email: liuguangpingtest@163.com

 */
class Qqweibo extends CI_Controller {
	private $qqweiboObj;
	private $qqweiboConfig;
	private $cooperationModel;
	private $userMode;
	//private $userInfoMode;
	private $openid;
	private $userData = array();
	private $access_token = '';
	private $expires_in = '';
	private $user_email = '';
	private $user_id = '';
	private $current_url;

	public function __construct(){

		session_start();
		parent::__construct();
        if(!isset($_SESSION['wap_service_id'])){
            die("失效的链接地址，请从正常通道进入当前页面");
        }
		loadLib( 'sns/qqweibo/Tencent');
		$this->load->helper('import_excel');
		$this->qqweiboConfig = C('sns','qqweibo');
		$client_id = $this->qqweiboConfig['QW_CLIENT_ID'];
		$client_secret = $this->qqweiboConfig['QW_CLIENT_SECRET'];
		$debug = $this->qqweiboConfig['QW_DEBUG'];
		OAuth::init($client_id, $client_secret);
		Tencent::$debug = $debug;
		$this->cooperationModel = model('t_user_cooperation_login');
		$this->userMode = model('t_user');
		//$this->userInfoMode = model('t_user_info');
		$this->openid = '';
		$url = C('wap_url','wap');
		if(isset($_SESSION['current_url'])) $this->current_url = $_SESSION['current_url'];
		//else $this->current_url = "http://".$_SERVER['HTTP_HOST'].$url['wapindex']."&service_id=".$_SESSION['wap_service_id'];
		else $this->current_url = $_SERVER['HTTP_HOST'].$url['wapindex']."&service_id=".$_SESSION['wap_service_id'];
		//unset($_SESSION['wap_service_id']);
	}

	public function index(){

		$code_url = OAuth::getAuthorizeURL($this->qqweiboConfig['QW_CALLBACK_URL']);
		//echo "<a href=".$code_url."><img src='"."http://".$_SERVER['HTTP_HOST']."/application/libraries/sns/qqweibo/logo.png' title='点击进入授权页面'' alt='点击进入授权页面'' border='0' /></a>";exit;
		echo "<a href=".$code_url."><img src='".$_SERVER['HTTP_HOST']."/application/libraries/sns/qqweibo/logo.png' title='点击进入授权页面'' alt='点击进入授权页面'' border='0' /></a>";exit;
	}

	/**
	 *description: 新浪认证
	 *author: liuguangping
	 *date:2013/12/27
	 */
	public function authorize(){

		safeFilter();
		$callback = $this->qqweiboConfig['QW_CALLBACK_URL'];//回调url
        $code = $_GET['code'];
        $openid = $_GET['openid'];
        $openkey = $_GET['openkey'];
        //获取授权token
        $url = OAuth::getAccessToken($code, $callback);
        $r = Http::request($url);
        parse_str($r, $token);

        //存储授权数据
   
        $_SESSION['t_access_token'] = $token['access_token'];
        $_SESSION['t_refresh_token'] = $token['refresh_token'];
        $_SESSION['t_expire_in'] = $token['expires_in'];
        $_SESSION['t_code'] = $code;
        $_SESSION['t_openid'] = $openid;
        $_SESSION['t_openkey'] = $openkey;
        
        //验证授权
        $param = array(
        	'access_token' => $token['access_token'],
        	'openid' => $openid,
        	'openkey' => $openkey
        	);
        try{$r = OAuth::checkOAuthValid($param);}catch (JiaException $e){$this->goBackUrl($e->getMessage(),U('login/index'));}
        if($r){
        	$this->openid = $openid;
			if (isset($token) && $token) {
				$_SESSION['token'] = $token;
				$this->access_token = $token['access_token'];
				$this->expires_in = $token['expires_in'];
				$this->refresh_token = $token['refresh_token'];
				setcookie( 'weibojs_'.$this->qqweiboConfig['QW_CLIENT_ID'], http_build_query($token) );
				
				if(!$this->isRegist()){
					//获取用户基本信息
					Tencent::$params = $param;
					Tencent::$debug = $this->qqweiboConfig['QW_DEBUG'];
					$userInfoObj = Tencent::api('user/info');
	    			$userInfoArr = json_decode($userInfoObj, true);
	    			$this->userData = $userInfoArr['data'];
	    			$this->user_nickname = $this->userData['nick'];
				}
				
				if($insert_id = $this->qqweiboConsole()){
					$_SESSION['user_id'] = $this->user_id;
					//$_SESSION['user_email'] = $this->user_email;
					$_SESSION['nickname'] = $this->user_nickname;
					//同步登录注册
					$this->goBackUrl('',$this->current_url);
				}else{
					$this->goBackUrl('授权失败',$this->current_url);
				}

			} else {
				$this->goBackUrl('授权失败',$this->current_url);
			}
        }else{
        	$this->goBackUrl('授权失败',$this->current_url);
        }
		
	}

	private function goBackUrl($msg='',$url){
		unset($_SESSION['current_url']);
		if($this->current_url) jumpAjax($msg,$this->current_url); else jumpAjax($msg,$url);
	}

	/**
	 *description: 登录注册控制
	 *author: liuguangping
	 *date:2013/12/27
	 */
	private function qqweiboConsole(){
		$where['login_type'] = $this->qqweiboConfig['LOGIN_TYPE'];
		    $where['openid'] = $this->openid;
		 $cooperationInfo = $this->cooperationModel->getOne('cl_id,user_id',$where);
		 if($cooperationInfo){

		 	//登录过
		 	$this->updateCooperation($cooperationInfo->user_id);
		 	$this->user_id = $cooperationInfo->user_id;
		 	$user = $this->userMode->get($this->user_id);
		 	$this->user_email = $user->user_email;
		 	return true;
		 }else{
		 	//插入用户表
		 	$this->saveUser();
		 	if($this->user_id){
		 		//$this->saveUserInfo($this->user_id);
		 		$this->saveCooperation($this->user_id);
		 		$this->user_id = $this->user_id;
		 		return true;
		 	}else{
		 		return false;
		 	}

		 }
	}

	/**
	 *description: 保存用户信息
	 *author: liuguangping
	 *date:2013/12/27
	 */
	private function saveUser(){
		if($this->userData){
			$userData = $this->userData;
			//$this->userMode->group_id = 1;
			$this->userMode->user_type = 1;
			$this->userMode->user_nickname = $userData['nick'];
			$this->userMode->user_passwd = md5('JIA2014178haha'); 
			$this->userMode->user_email = '';//邮箱没用
			$this->userMode->user_mobile = '';
			$this->userMode->user_reg_time = date('Y-m-d H:i:s');
			if($userData['sex'] != '1') $sex = 2; else $sex = 1;
			$this->userMode->user_sex = $sex;
			$b_sourceUrl = $userData['head'].'/120';
			$m_sourceUrl = $userData['head'].'/100';
			$s_sourceUrl = $userData['head'].'/40';
			$this->userMode->user_pic_b = $b_sourceUrl;
			$this->userMode->user_pic_m = $m_sourceUrl;
			$this->userMode->user_pic_s = $s_sourceUrl;
			$this->userMode->user_reg_ip = getClientIp();
			//$this->userMode->user_randcode = '';
			if($insert_id = $this->userMode->insert()){
				$data['user_email'] = $insert_id.'@jia178.com';
				if($this->userMode->updates_global($data,array('user_id'=>$insert_id))){
					$this->config->load('uploads');
					$config = $this->config->item('avatar');
					$avatar_dir = intval(ceil($insert_id/$config['count']));
					$avatar_dir = $config['true_path'].$avatar_dir;
					if(mkdirs($avatar_dir)){
						//todo 下面函数获取图片太慢 在这不获取
						/*$avatar_dir_b = $avatar_dir.'/'.$insert_id."_b.jpg";
						$avatar_dir_m = $avatar_dir.'/'.$insert_id."_m.jpg";
						$avatar_dir_s = $avatar_dir.'/'.$insert_id."_s.jpg";
						//https_head
						@copy($userData['head'].'/120',$avatar_dir_b);
						@copy($userData['head'].'/100',$avatar_dir_m);
						@copy($userData['head'].'/40',$avatar_dir_s);*/
						$this->user_email = $data['user_email'];
						$this->user_id = $insert_id;
						return true;
					}else{
						$this->userMode->delete($insert_id);
						return false;
					}
					
				}else{
					$this->userMode->delete($insert_id);
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	/**
	 *description: 保存用户合作登录信息
	 *author: liuguangping
	 *date:2013/12/27
	 */
	private function saveCooperation($insert_id){
		$this->cooperationModel->openid = $this->openid;
		$this->cooperationModel->user_id = $insert_id;
		$this->cooperationModel->token = $this->access_token;
		$time = time()+($this->expires_in);
		$this->cooperationModel->expire_time = date("Y-m-d H:i:s",$time);
		$this->cooperationModel->refresh_token = $this->refresh_token;
		$this->cooperationModel->login_type = $this->qqweiboConfig['LOGIN_TYPE'];
		if($this->cooperationModel->insert()) return true; else return false;
	}

	/**
	 *description: 保存用户详细信息
	 *author: liuguangping
	 *date:2013/12/27
	 */
	private function saveUserInfo($insert_id){
		if($userData = $this->userData){
			$this->userInfoMode->user_reg_time = date('Y-m-d H:i:s');
			if($userData['sex'] != '1') $sex = 2; else $sex = 1;
			$this->userInfoMode->user_id = $insert_id;
			$this->userInfoMode->user_sex = $sex;
			$this->userInfoMode->user_birthday = '';
			$this->userInfoMode->user_pic = $userData['head'].'/120';
			$this->userInfoMode->user_reg_ip = getClientIp();
			if($this->userInfoMode->insert()){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	/**
	 *description: 修改用户合作登录信息
	 *author: liuguangping
	 *date:2013/12/27
	 */
	private function updateCooperation($insert_id){
		$where['login_type'] = $this->qqweiboConfig['LOGIN_TYPE'];
		    $where['openid'] = $this->openid;
		   $where['user_id'] = $insert_id;

		$time = time()+($this->expires_in);
		$data['token'] = $this->access_token;
		$data['refresh_token'] = $this->refresh_token;
		$data['expire_time'] = date("Y-m-d H:i:s",$time);
		if($this->cooperationModel->update($data,$where)) return true; else return false;
	}

	private function getMsg($key,$value){
		parse_str($value,$myArr);
		return $myArr[$key];
	}

	private function isRegist(){
		$where['login_type'] = $this->qqweiboConfig['LOGIN_TYPE'];
			$where['openid'] = $this->openid;
		 $cooperationInfo = $this->cooperationModel->getOne('cl_id,user_id',$where);
		 if($cooperationInfo){
		 	//登录过
		 	$this->updateCooperation($cooperationInfo->user_id);
		 	$this->user_id = $cooperationInfo->user_id;
		 	$user = $this->userMode->get($this->user_id);
		 	$this->user_email = $user->user_email;
		 	$this->user_id = $user->user_id;
		 	$this->user_nickname = $user->user_nickname;
		 	return true;
		 }else{
		 	return false;
		 }
	}

}


