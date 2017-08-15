<?php
/**
 * 
 * @author liuguangping
 * 
 * @version 1.1 (2014/3/12)
 *
 */
include "wechat.class.php";
class GetInfo
{

	private $weObj;
	public function __construct()
	{
		$options = array(
							'token'=>'m6NQwrjxpL26fQ6o6pNq', //填写你设定的key
							'appid'=>'wx5da2cd9b64bfc966', //填写高级调用功能的app id
							'appsecret'=>'ef4d573c0e1e79225051c7297c71bb81', //填写高级调用功能的密钥
						);
		 $this->weObj = new Wechat($options);
	}

	
	public function index(){
		$callback = "http://aiqisong.azzsh.com/liuguangping/getInfo.class.php?Action=checkLogin";
		$state = "1";
		$scope='snsapi_base';
		$redirect_uri = $this->weObj->getOauthRedirect($callback,$state,$scope='snsapi_base');
		header("Content-type: text/html; charset=utf-8");
		echo "<a href='".$redirect_uri."'>绑定</a>";
	}
	public function checkLogin(){
			echo "<pre>";
					var_dump($_GET);exit;
		header("Content-type: text/html; charset=utf-8");
		//获取access_key
		$resultJson = $this->weObj->getOauthAccessToken();
		if($resultJson){
			$getOpenidArr = $this->weObj->getOauthRefreshToken($resultJson['refresh_token']);
			if($getOpenidArr){
				$openid = $getOpenidArr['openid'];
				$access_token  = $getOpenidArr['access_token'];
				$userInfo = $this->weObj->getOauthUserinfo($access_token,$openid);
				if($userInfo){
					echo "<pre>";
					var_dump($userInfo);exit;
				}else{
					echo "获取用户信息失败!";exit;
				}
			}else{
				echo "获取Refresh_token失败!";exit;
			}
		}else{
			echo "获取Access_key失败！";exit;
		}
	}

}
$getInfo = new GetInfo();
if($action = $_GET['Action']){
	$getInfo->$action();
}else{
	$getInfo->index();
}
