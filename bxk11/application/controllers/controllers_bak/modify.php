<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:个人设置
 *author:chenyuda
 *date:2013/08/01
 */
class Modify extends Temp_Controller {
	function __construct(){
        parent::__construct();	
    }

    function index(){ 
				
		$this->load->view('index/user/modify');
	}
	
	//显示个人设置页面
	function show_set()
	{
				
		$this->load->model('Bxk_user_model');
		$user_id = @$_SESSION['user_id'];
		$exc=$this->Bxk_user_model->get($user_id);
		print_r(json_encode($exc));
	}

	//修改用户昵称
	function nick_update()
	{
				
		safeFilter();
		$this->load->model('Bxk_user_model');
		$user_id = $_SESSION['user_id'];
		$user_nickname = $this->input->post('user_nickname');
		if($user_nickname == '')
		{
			echojson(0,'用户名不能为空');
		}
		if((strlen($user_nickname) + mb_strlen($user_nickname,'UTF8'))/2>20){
			echojson(0,'昵称长度不能超过10个字');
		}
			
			$res= $this->Bxk_user_model->update_nick($user_nickname,$user_id);
			if($res==1){
			echojson(0,'用户名已存在');
			}elseif($res==2){
			echojson(0,'修改失败');
			}else{
			echojson(1,'修改成功');
			}
	}
	/*
		修改用户邮箱
	*/
		function email_update()
	{
				
		safeFilter();
		$this->load->model('Bxk_user_model');
		$user_id = $_SESSION['user_id'];
		$user_email = $this->input->post('user_email');
		if(!preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$user_email)){
			echojson(0,'邮箱格式不正确');
		}else{
			$res= $this->Bxk_user_model->update_email($user_email,$user_id);
			if($res==1){
			echojson(0,'邮箱已存在');
			}elseif($res==2){
			echojson(0,'修改失败');
			}else{
			echojson(1,'修改成功');
			}
		}
	}
	/*
		修改居住地，以及通知
	*/
		function address_notice()
		{
					
		safeFilter();
			$this->load->model('Bxk_user_info_model');
			$user_id = $_SESSION['user_id'];
			$user_hometown = $this->input->post('user_hometown');
			$user_residency = $this->input->post('user_residency');
			$user_address = $this->input->post('user_address');
			$user_noticeoptions = $this->input->post('user_noticeoptions');
			$user_mailoptions = $this->input->post('user_mailoptions');
			$user_dynamicoptions = $this->input->post('user_dynamicoptions');
			$exc=$this->Bxk_user_info_model->set_address_notice($user_id,$user_hometown,$user_residency,$user_address,$user_noticeoptions,$user_mailoptions,$user_dynamicoptions);
			print_r($exc);
		}

		/*修改头像*/
		function head_update()
		{
					
		safeFilter();
				$this->load->model('Bxk_user_info_model');
				$user_id = $this->input->post('user_id');
				$user_pic = $this->input->post('user_pic');
				$exc=$this->Bxk_user_info_model->set_head($user_id,$user_pic);
				print_r($exc);
		}
}
