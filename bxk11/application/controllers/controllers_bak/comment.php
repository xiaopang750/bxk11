<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comment extends Temp_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:添加一条评论
	 *author:yanyalong
	 *date:2013/08/21
	 */
	public function addcomment(){
				
		safeFilter();
		$this->load->model('Bxk_content_discussion_model');
		$content_id = $this->input->post('content_id');
		$user_id = $_SESSION['user_id'];
		$disc_con = $this->input->post('disc_con');
		$disc_id = $this->Bxk_content_discussion_model->manage($content_id,$user_id,$disc_con);
		if($disc_id!=false){
		$discinfo = $this->Bxk_content_discussion_model->new_disc($disc_id);		
		$discinfo['disc_num'] = model('Bxk_content_discussion_model')->count_num($content_id);
		include_once $_SERVER['DOCUMENT_ROOT']."/application/libraries/Notice.php";
		//给作者发通知
		$noticearr = array('notice_type' =>4,'from_user_id'=>$user_id,'disc_id'=>$disc_id);
		$noticeobj = new Notice($noticearr);
		$noticeobj->ContextInterface();
		//给推荐者发通知
		$noticearr2 = array('notice_type' =>9,'from_user_id'=>$user_id,'disc_id'=>$disc_id);
		$noticeobj2 = new Notice($noticearr2);
		$noticeobj2->ContextInterface();
		model("bxk_user_model")->user_status($user_id,'user_discussions','+');
		echojson(1,$discinfo);
		}else{
		echojson(0,"评论失败");
		}
	}
	/**
	 *description:发表回复
	 *author:yanyalong
	 *date:2013/08/20
	 */
	public	function reply()
	{	
				
		$disc_pid= $this->input->post('disc_pid',true);
		$user_id = $_SESSION['user_id'];
		$disc_con = $this->input->post('disc_con',true);
		$this->load->model('Bxk_content_discussion_model');
		$disc_id = $this->Bxk_content_discussion_model->reply($user_id,$disc_con,$disc_pid);
		if($disc_id==false){
			echojson(0,'回复失败');
		}else{
		$discinfo = $this->Bxk_content_discussion_model->new_disc($disc_id);		
		$discinfo['disc_num'] = model('Bxk_content_discussion_model')->count_num($discinfo['content_id']);
		include_once $_SERVER['DOCUMENT_ROOT']."/application/libraries/Notice.php";
			$noticearr = array('notice_type' =>5,'from_user_id'=>$user_id,'disc_id'=>$disc_id);
			$noticeobj = new Notice($noticearr);
			$noticeobj->ContextInterface();
			model("bxk_user_model")->user_status($user_id,'user_discussions','+');
			echojson(1,$discinfo);
		}
	}

	/**
	 *description:管理一条评论
	 *author:yanyalong
	 *date:2013/09/22
	 */
	function comment_del(){
		$this->load->model('Bxk_content_discussion_model');
		$disc_id = $this->input->post('disc_id',true);
		$disc_status = $this->input->post('disc_status',true);
		$arr = $this->Bxk_content_discussion_model->manage_del($disc_id,$disc_status);
		if($arr==fasle){
			echojson(0,'修改失败');
		}else{
			echojson(1,'修改成功');
		}
	}
}
