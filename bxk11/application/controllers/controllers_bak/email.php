<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:发送邮箱(以及邮箱操作)
 *author:chenyuda
 *date:2013/08/16
 */

class Email extends Temp_Controller {
	function __construct(){
        parent::__construct();	
    }
	//显示忘记密码页面
	function find_password()
	{
		
		$this->load->view('index/user/findpass');
	}

	
	//发送邮箱连接修改密码
	function set_email()
	{
				
		safeFilter();
		$this->load->model('Bxk_email_model');
		$user_email = $this->input->post('user_email');
		if(!preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$user_email)){
			echo '{"info":0,"msg":"邮箱格式不正确"}';
		}else
		{
			$res=$this->Bxk_email_model->find_password($user_email);
			if($res==false){
			echojson(0,'发送邮件失败，不存在该邮箱！');
			}else{
			echojson(1,'发送邮件成功，快去邮箱查看您的新密码吧！');
			}
		}
		
	}

	//显示新密码页面
	function new_pass()
	{
		$this->load->view('index/user/mail');
	}
	
	//邮箱发送连接邀请好友
	function email_invite()
	{
		
		$this->load->model('Bxk_email_model');
		$user_email = $this->input->post('user_email');
		$user_id = md5($_SESSION['user_id']);
		$arr = $this->Bxk_email_model->invite_friend($user_email,$user_id);
	}
}
