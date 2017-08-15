<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:用户推荐
 *author:chenyuda
 *date:2013/08/01
 */
class User_recomment extends Temp_Controller {
	function __construct(){
        parent::__construct();	
    }
	//用户推荐
	function recomment()
	{
				
		$user_id = $_SESSION['user_id'];
		$this->load->model('User_content_recommend_model');
		$content_id = $this->input->post('content_id',true);
		$contentinfo = model("bxk_content_model")->contentinfo($content_id);
		if($user_id==$contentinfo['user_id']){
			echojson(0,'亲，不要太自恋哦！');
		}
		$recommend_addtime = $this->input->post('recommend_addtime');
		$arr=$this->User_content_recommend_model->recommend_add($user_id,$content_id,$recommend_addtime);
		if($arr==true){
		include_once $_SERVER['DOCUMENT_ROOT']."/application/libraries/Notice.php";
		//给作者发通知
 		$noticearr = array('notice_type' =>2,'from_user_id'=>$user_id,'content_id'=>$content_id);
		$noticeobj = new Notice($noticearr);
		$noticeobj->ContextInterface();
		//给推荐者发通知
 		$noticearr2 = array('notice_type' =>7,'from_user_id'=>$user_id,'content_id'=>$content_id);
		$noticeobj2 = new Notice($noticearr2);
		$noticeobj2->ContextInterface();
			echojson(1,'推荐成功');
		}else{
			echojson(0,'推荐失败');
		}
	}
	//取消推荐
	function del_recomment()
	{
				
		$this->load->model('User_content_recommend_model');
		$user_id = $_SESSION['user_id'];
		$content_id = $this->input->post('content_id');
		$arr=$this->User_content_recommend_model->recommend_del($user_id,$content_id);
		if($arr==true){
			echojson(1,'取消成功');
		}else{
			echojson(0,'取消失败');
		}
	}
}
