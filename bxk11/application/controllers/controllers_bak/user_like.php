<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:喜欢
 *author:chenyuda
 *date:2013/08/01
 */
class User_like extends Temp_Controller {
	function __construct(){
        parent::__construct();	
    }
	//喜欢
	function likelist()
	{
					
		$this->load->model('Bxk_user_like_model');
		$user_id = $_SESSION['user_id'];
		$content_id = $this->input->post('content_id');
		$contentinfo = model("bxk_content_model")->contentinfo($content_id);
		if($user_id==$contentinfo['user_id']){
			echojson(0,'亲，不要太自恋哦！');
		}
		$arr=$this->Bxk_user_like_model->add_like($user_id,$content_id);
		if($arr==true){
		include_once $_SERVER['DOCUMENT_ROOT']."/application/libraries/Notice.php";
		//给作者发通知
 		$noticearr = array('notice_type' =>1,'from_user_id'=>$user_id,'content_id'=>$content_id);
		$noticeobj = new Notice($noticearr);
		$noticeobj->ContextInterface();
		//给推荐者发通知
 		$noticearr2 = array('notice_type' =>7,'from_user_id'=>$user_id,'content_id'=>$content_id);
		$noticeobj2 = new Notice($noticearr2);
		$noticeobj2->ContextInterface();
			echojson(1,'喜欢成功');
		}else{
			echojson(0,'喜欢失败');
		}
		
	}

	//取消喜欢
	function off_like()
	{
				
		$this->load->model('Bxk_user_like_model');
		$user_id = $this->input->post('user_id');
		$content_id = $this->input->post('content_id');
		$arr=$this->Bxk_user_like_model->del_like($user_id,$content_id);
		if($arr==true){
			echojson(1,'取消成功');
		}else{
			echojson(0,'取消失败');
		}
	}
	//他喜欢的
	function he_like()
	{
		$this->load->model('Bxk_user_like_model');
		$like_id = $this->input->post('like_id');
		$arr = $this->Bxk_user_like_model->deal_like($like_id);
		print_r($arr);
	}

}
