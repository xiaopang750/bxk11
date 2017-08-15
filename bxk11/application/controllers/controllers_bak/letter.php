<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*description:私信功能
 *author:chenyuda
 *date:2013/08/05
 */

class Letter extends Temp_Controller {

	function __construct(){
		parent::__construct();
	}
	//显示私信页面
	function letter_show()
	{
		
		$this->load->view('index/user/self_message');
	}

	//显示发送私信页面
	function send_message()
	{
		
		$this->load->view('index/user/send_message');
	}

	//显示私信页面需要的内容

	public function index_letter()
	{
		
		$this->load->model('Bxk_user_msg_model');
		$user_id = $_SESSION['user_id'];
		$type = $this->input->post('type',true);
		$arr['list']=$this->Bxk_user_msg_model->mymsg($user_id,$type);
		$arr['view_nums']=$this->Bxk_user_msg_model->view_nums($user_id);
		if(!empty($arr['list'])){
			echojson(1,$arr);
		}else{
			echojson(0,'无相关数据');
		}
	}


	//显示私信详细页面
	public function show_mag_letter()
	{
		
		$this->load->model('Bxk_user_msg_model');
		$user_id = $_SESSION['user_id'];
		$msg_user_id= $this->input->post('msg_user_id',true);
		$arr=$this->Bxk_user_msg_model->msginfo($user_id,$msg_user_id);
		if(!empty($arr)){
			//标记已读
			$this->Bxk_user_msg_model->view_msg($msg_user_id,$user_id);
			echojson(1,$arr);
		}else{
			echojson(0,'无相关数据');
		}
		
	}

	//发私信
	function letter_get()
	{
		
		$this->load->model('Bxk_user_msg_model');
		$msg_content = $this->input->post('msg_content',true);
		if((strlen(trim($msg_content)) + mb_strlen(trim($msg_content),'UTF8'))/2>1000){
			echojson(0,'私信内容最多不能超过500个字');
		}
		$user_id = $_SESSION['user_id'];
		$msg_to_uid = $this->input->post('msg_to_uid',true);
		$msg_to_usernick = $this->input->post('msg_to_usernick',true);
		$msg_send_user_nick = $this->input->post('msg_send_user_nick',true);
		$msg=$this->Bxk_user_msg_model->letter_deal($user_id,$msg_content,$msg_to_uid,$msg_to_usernick,$msg_send_user_nick);
		if($msg==1){
			echojson(1,'发送成功');
		}elseif($msg==2){
			echojson(0,'你已经被对方拉入黑名单，无法给对方发私信');
		}else{
			echojson(0,'发送失败');
		}
	}

	/**
	 *description:删除私信
	 *author:yanyalong
	 *date:2013/09/18
	 */
	function del_letter(){
		
		$this->load->model('Bxk_user_msg_model');
		$user_id = $_SESSION['user_id'];
		$msg_user_id = $this->input->post('msg_user_id',true);	
		$res = $this->Bxk_user_msg_model->letter_del($user_id,$msg_user_id);
		if($res!=false){
			echojson(1,'删除成功');
		}else{
			echojson(0,'删除失败');
		}
	}
}
