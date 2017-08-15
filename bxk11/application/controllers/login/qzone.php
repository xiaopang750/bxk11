<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Generator By "Auto Codeigniter" At 2013/12/16 16:10:17 
 *       liuguangpingAuthor: liuguangping
 *        Email: liuguangpingtest@163.com

 */
class Qzone extends MY_Controller {

	private $qzoneObj;
	private $qzoneConfig;
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
		loadLib( 'sns/qzone/API/qqConnectAPI');
		$this->load->helper('import_excel');
		$this->qzoneObj = new QC();
		$this->qzoneConfig = C('sns','qzone');
		$this->cooperationModel = model('t_user_cooperation_login');
		$this->userMode = model('t_user');
		//$this->userInfoMode = model('t_user_info');
		$this->openid = '';
		
	}

	public function index(){
		$code_url = $this->qzoneObj->getAuthorizeURL();
		echo "<a href=".$code_url."><img src='"."http://".$_SERVER['HTTP_HOST']."/application/libraries/sns/qzone/qq_login.png' title='点击进入授权页面'' alt='点击进入授权页面'' border='0' /></a>";exit;
	}

	/**
	 *description: 新浪认证
	 *author: liuguangping
	 *date:2013/12/27
	 */
	public function authorize(){
		safeFilter();

		try{
			$token = $this->qzoneObj->getAccessToken();
		}catch(Jia178Exception $e){
			$error = $e->getMessage();
			echo $this->getMsg('msg',$error);exit;
		}

		try{
			$this->openid = $this->qzoneObj->get_openid();
		}catch(Jia178Exception $e){
			$error = $e->getMessage();
			echo $this->getMsg('msg',$error);exit;
		}

		if (isset($token) && $token) {
			$_SESSION['token'] = $token;
			$this->access_token = $token['access_token'];
			$this->expires_in = $token['expires_in'];
			$this->refresh_token = $token['refresh_token'];
			setcookie( 'weibojs_'.$this->qzoneConfig['appid'], http_build_query($token) );
			
			if(!$this->isRegist()){
				//获取用户基本信息
				try{
					$this->qzoneObj = new QC($this->access_token,$this->openid);
					$this->userData = $this->qzoneObj->get_user_info();
					$this->user_nickname = $this->userData['nickname'];
				}catch(Jia178Exception $e){
					$error = $e->getMessage();
					echo $this->getMsg('msg',$error);exit;
				}
			}
			

			
			if($insert_id = $this->qzoneConsole()){
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
	private function qzoneConsole(){
		$where['login_type'] = $this->qzoneConfig['login_type'];
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
			$this->userMode->user_nickname = $userData['nickname'];
			$this->userMode->user_passwd = md5('JIA2014178haha'); 
			$this->userMode->user_email = '';//邮箱没用
			$this->userMode->user_mobile = '';
			$this->userMode->user_reg_time = date('Y-m-d H:i:s');
			if($userData['gender'] != '男') $sex = 2; else $sex = 1;
			$this->userMode->user_sex = $sex;
			$b_sourceUrl = $userData['figureurl_2'];
			$m_sourceUrl = $userData['figureurl_1'];
			$s_sourceUrl = $userData['figureurl'];
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
						@copy($userData['figureurl_2'],$avatar_dir_b);
						@copy($userData['figureurl_1'],$avatar_dir_m);
						@copy($userData['figureurl'],$avatar_dir_s);*/
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
		$this->cooperationModel->login_type = $this->qzoneConfig['login_type'];
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
			if($userData['gender'] != '男') $sex = 2; else $sex = 1;
			$this->userInfoMode->user_id = $insert_id;
			$this->userInfoMode->user_sex = $sex;
			$this->userInfoMode->user_birthday = '';
			$this->userInfoMode->user_pic = $userData['figureurl_2'];
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
		$where['login_type'] = $this->qzoneConfig['login_type'];
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
		$where['login_type'] = $this->qzoneConfig['login_type'];
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


