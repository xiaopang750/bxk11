<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Generator By "Auto Codeigniter" At 2013/12/16 16:10:17 
 *       liuguangpingAuthor: liuguangping
 *        Email: liuguangpingtest@163.com

 */
class Renren extends MY_Controller {

	private $renrenObj;
	private $renrenConfig;
	private $cooperationModel;
	private $userMode;
	//private $userInfoMode;
	private $openid;
	private $userData = array();
	private $access_token = '';
	private $expires_in = '';
	private $user_email = '';
	private $user_id = '';

	public function __construct(){

		parent::__construct();
		loadLib( 'sns/renren/RennClient');
		$this->load->helper('import_excel');
		
		$this->renrenConfig = C('sns','renren');
		$this->renrenObj = new RennClient ( $this->renrenConfig['app_key'], $this->renrenConfig['app_secret'] );
		$this->renrenObj->setDebug ( $this->renrenConfig['debug'] );
		$this->cooperationModel = model('t_user_cooperation_login');
		$this->userMode = model('t_user');
		//$this->userInfoMode = model('t_user_info');
		$this->openid = '';
		
	}

	public function index(){
		// 生成state并存入SESSION，以供CALLBACK时验证使用
		$state = uniqid ( 'renren_', true );
		$_SESSION ['renren_state'] = $state;
		// 得认证授权的url
		$code_url = $this->renrenObj->getAuthorizeURL ( $this->renrenConfig['callback_url'], 'code', $state );
		echo "<a href=".$code_url."><img src='"."http://".$_SERVER['HTTP_HOST']."/application/libraries/sns/renren/renren.png' title='点击进入授权页面'' alt='点击进入授权页面'' border='0' /></a>";exit;
	}

	/**
	 *description: 新浪认证
	 *author: liuguangping
	 *date:2013/12/27
	 */
	public function authorize(){

		safeFilter();
		// 处理code -- 根据code来获得token
		if (isset ( $_REQUEST ['code'] )) {
			$keys = array ();
			// 验证state，防止伪造请求跨站攻击
			$state = $_REQUEST ['state'];
			if (!isset($_SESSION ['renren_state']) || empty ( $state ) || $state !== $_SESSION ['renren_state']) {
				echo "非法请求！";exit;
			}
			unset ( $_SESSION ['renren_state'] );
			
			// 获得code
			$keys ['code'] = $_REQUEST ['code'];
			$keys ['redirect_uri'] = $this->renrenConfig['callback_url'];
			try {
				// 根据code来获得token
				$token = $this->renrenObj->getCodeInfo ( 'code', $keys );
			} catch ( RennException $e ) {
				$error =  $e->getMessage();
				echo $error;exit;
		
			}
		}else{
			echo "非法操作！";exit;
		}
		if (isset($token) && $token) {
			$_SESSION['token'] = $token;
			$this->access_token = $token['access_token'];
			$this->expires_in = '';
			$this->refresh_token = '';
			//setcookie( 'weibojs_'.$this->renrenConfig['app_key'], http_build_query($token) );
			$this->openid = $token['user']['id'];
			if(!$this->isRegist()){
				//获取用户基本信息
				try{
					// 获得用户接口
					$user_service = $this->renrenObj->getUserService ();
					// 获得指定用户
					$user = $user_service->getUser ( $this->openid );
					$this->userData = $user;
					$this->user_nickname = $user['name'];

				}catch(InvalideAuthorizationException $e){
					$error = $e->getMessage();
					echo $error;exit;
				}
			}
			

			
			if($insert_id = $this->renrenConsole()){
				$_SESSION['user_id'] = $this->user_id;
				$_SESSION['user_email'] = $this->user_email;
				$_SESSION['user_nickname'] = $this->user_nickname;
				//同步登录注册
			    jumpAjax('',U('user/home'));
			}else{
				echo "授权失败。";
			}

		} else {
			echo "授权失败。";
		}
		
	}

	/**
	 *description: 登录注册控制
	 *author: liuguangping
	 *date:2013/12/27
	 */
	private function renrenConsole(){
		$where['login_type'] = $this->renrenConfig['login_type'];
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
			$this->userMode->user_nickname = $userData['name'];
			$this->userMode->user_passwd = md5('JIA2014178haha'); 
			$this->userMode->user_email = '';//邮箱没用
			$this->userMode->user_mobile = '';
			$this->userMode->user_reg_time = date('Y-m-d H:i:s');
			if($userData['basicInformation']['sex'] != 'MALE') $sex = 2; else $sex = 1;
			$this->userMode->user_sex = $sex;
			$avatar = $userData['avatar'];
			$b_sourceUrl = $avatar['0']['url'];
			$m_sourceUrl = $avatar['1']['url'];
			$s_sourceUrl = $avatar['2']['url'];
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
						/*$avatar_dir_b = $avatar_dir.'/'.$insert_id."_b.jpg";
						$avatar_dir_m = $avatar_dir.'/'.$insert_id."_m.jpg";
						$avatar_dir_s = $avatar_dir.'/'.$insert_id."_s.jpg";
						file_put_contents($avatar_dir_b ,$userData['avatar_hd']);
						file_put_contents($avatar_dir_m ,$userData['avatar_large']);
						file_put_contents($avatar_dir_s ,$userData['profile_image_url']);
						$avatar = $userData['avatar'];
						@copy($avatar['0']['url'],$avatar_dir_b);
						@copy($avatar['1']['url'],$avatar_dir_m);
						@copy($avatar['2']['url'],$avatar_dir_s);*/
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
		$this->cooperationModel->login_type = $this->renrenConfig['login_type'];
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
			if($userData['basicInformation']['sex'] != 'MALE') $sex = 2; else $sex = 1;
			$this->userInfoMode->user_id = $insert_id;
			$this->userInfoMode->user_sex = $sex;
			$this->userInfoMode->user_birthday = $userData['basicInformation']['birthday'];
			$avatar = $userData['avatar'];
			$b_soruceUrl = $avatar['0']['url'];
			$this->userInfoMode->user_pic = $b_soruceUrl;
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
		$where['login_type'] = $this->renrenConfig['login_type'];
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
		$where['login_type'] = $this->renrenConfig['login_type'];
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


