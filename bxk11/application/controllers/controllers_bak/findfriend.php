<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Findfriend extends Temp_Controller {
	function __construct(){
		parent::__construct();	
	}
	//发送邀请链接
	function invite_link()
	{
		
		$user_id = $_SESSION['user_id'];
		$url = $this->config->site_url()."/lead?inviteCode=$user_id"; 
		echojson(1,$url);
	}

	//接受到usl上的加密串进行解密，两人互相加为粉丝
	function geturl()
	{
		safeFilter();
		$this->load->model('Bxk_user_follow_model');
		$follow_uid= $this->input->post('user_id',true);
		$user_id= $_SESSION['user_id'];
		$res = model("bxk_user_follow_model")->follow($user_id,$follow_uid);	
		model("bxk_user_model")->user_status($user_id,'user_follows','+');
		model("bxk_user_model")->user_status($follow_uid,'user_fans','+');
		if($res!=false){
			echojson(1,"关注成功");
		}else{
			echojson(0,"关注失败");
		}
	} 

	//寻找好友显示页面
	function find_friend_show()
	{
		
		$this->load->view('index/find/find_friend');
	}
	//接受到usl上的加密串进行解密，两人互相加为粉丝

}
