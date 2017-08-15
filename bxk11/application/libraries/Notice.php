<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
abstract class GetNotice{
	public $user_id;
	public $content_id;
	public $urlConfig;
	public $noticeTypeDescription;
	public $blogTitle;
	public $fuser_id;
	public $systemNotice;
	public $notice_expiry;
	public $avatar;
	abstract public function GetMyNotice();
	public function __construct($user_id="",$content_id="",$blog_type="",$systemNotice="",$notice_expiry="",$fuser_id=""){
		$this->CI = &get_instance();
		$this->CI->load->model('t_user_notice_model');
		$this->CI->load->model('t_content_model');
		$this->CI->load->model('t_user_model');
		$this->CI->load->model('t_questions_model');
		$this->CI->load->model('t_content_discussion_model');
		$this->CI->load->model('t_answer_model');
		$this->CI->load->model('t_user_info_model');
		$this->CI->config->load('url');
		$this->urlConfig = $this->CI->config->item('url');
		if($user_id!=""){
			$this->user_id = $user_id;
			$this->avatar = $this->CI->t_user_info_model->avatar($user_id);
		}
		$this->content_id = $content_id;
		$this->blog_type = $blog_type;
		$this->notice_expiry= $notice_expiry;
		$this->systemNotice= $systemNotice;
		$this->fuser_id= $fuser_id;
	}
	protected function noticeEdit(){
		$userinfo = $this->CI->t_user_model->userinfo($this->user_id);
		$userinfo['user_nickname'] = ($userinfo['user_nickname'])?$userinfo['user_nickname']:$userinfo['user_email'];
		$flag = true;
		switch ($this->blog_type) {
		case '1':	//家居美图，装修美图
			$content  = $this->CI->t_content_model->get($this->content_id);
			$this->blogTitle = $content->content_title;
			$this->CI->t_user_notice_model->user_id = $content->user_id;
			if($content->content_type==1){
				$this->CI->t_user_notice_model->notice_content = "<a href='".$this->urlConfig["userspace"].$this->user_id."'>".$userinfo['user_nickname']."</a>$this->noticeTypeDescription<a href='".$this->urlConfig["contenturl"].$this->content_id."'>".$this->blogTitle."</a>"; 
			}else{
				$this->CI->t_user_notice_model->notice_content = "<a href='".$this->urlConfig["userspace"].$this->user_id."'>".$userinfo['user_nickname']."</a>$this->noticeTypeDescription<a href='".$this->urlConfig["producturl"].$this->content_id."'>".$this->blogTitle."</a>"; 
			}
			if($content->user_id==$this->user_id){
				$flag = false;	
			}
			break;
		case '2'://装修问题
			$question= $this->CI->t_questions_model->get($this->content_id);
			$this->blogTitle = $question->question_title;
			$this->CI->t_user_notice_model->user_id = $question->user_id;
			$this->CI->t_user_notice_model->notice_content = "<a href='".$this->urlConfig["userspace"].$this->user_id."'>".$userinfo['user_nickname']."</a>$this->noticeTypeDescription<a href='".$this->urlConfig["questionurl"].$this->content_id."'>".$this->blogTitle."</a>"; 
			if($question->user_id==$this->user_id){
				$flag = false;	
			}
			break;
		}
		if($flag==true){
			return $this->CI->t_user_notice_model->insert();
		}else{
			return true;
		}
	}
}
/**
 *description:生成系统通知
 *author:yanyalong
 *date:2013/11/04
 */
class GetNoticeBySystem extends GetNotice{
	public function GetMyNotice(){
		$this->noticeTypeDescription = "系统通知：";
		$this->CI->t_user_notice_model->notice_type = 0;
		$this->CI->t_user_notice_model->user_id = 0;
		$this->CI->t_user_notice_model->notice_expiry = $this->notice_expiry;
		$this->CI->t_user_notice_model->notice_content = $this->noticeTypeDescription.$this->systemNotice;   
		return $this->CI->t_user_notice_model->insert();
	}
}
/**
 *description:生成喜欢灵感通知
 *author:yanyalong
 *date:2013/11/04
 */
class GetNoticeByLikes extends GetNotice{
	public function GetMyNotice(){
		$this->noticeTypeDescription = "喜欢了您的";
		$this->CI->t_user_notice_model->notice_type = 1;
		return $this->noticeEdit();
	}
}
/**
 *description:生成关注通知
 *author:yanyalong
 *date:2013/11/04
 */
class GetNoticeByFollow extends GetNotice{
	public function GetMyNotice(){
		$userinfo = $this->CI->t_user_model->userinfo($this->user_id);
		$userinfo['user_nickname'] = ($userinfo['user_nickname'])?$userinfo['user_nickname']:$userinfo['user_email'];
		$this->noticeTypeDescription = "关注了你";
		$this->CI->t_user_notice_model->user_id = $this->fuser_id;
		$this->CI->t_user_notice_model->notice_type = 2;
		$this->CI->t_user_notice_model->notice_content = "<a href='".$this->urlConfig["userspace"].$this->user_id."'>".$userinfo['user_nickname']."</a>".$this->noticeTypeDescription."</a>"; 
		return $this->CI->t_user_notice_model->insert();
	}
}

/**
 *description:生成评论灵感通知
 *author:yanyalong
 *date:2013/11/04
 */
class GetNoticeByDisc extends GetNotice{
	public function GetMyNotice(){
		$this->noticeTypeDescription = "评论了您的";
		$this->CI->t_user_notice_model->notice_type = 3;
		return $this->noticeEdit();
	}
}
/**
 *description:生成回复通知
 *author:yanyalong
 *date:2013/11/04
 */
class GetNoticeByReply extends GetNotice{
	public function GetMyNotice(){
		//获取当前回复信息
		$discinfo= $this->CI->t_content_discussion_model->get($this->content_id);
		//获取当前回复的父评论信息
		$pdiscinfo= $this->CI->t_content_discussion_model->get($discinfo->disc_pid);
		if($this->user_id!=$pdiscinfo->user_id){

			$this->blogTitle = $discinfo->disc_con;
			$this->CI->t_user_notice_model->user_id = $pdiscinfo->user_id;
			$userinfo = $this->CI->t_user_model->userinfo($this->user_id);
			$userinfo['user_nickname'] = ($userinfo['user_nickname'])?$userinfo['user_nickname']:$userinfo['user_email'];
			$this->noticeTypeDescription = "回复了你的评论：";
			$this->CI->t_user_notice_model->notice_type = 4;
			if($this->blog_type==1){
				$url = "contenturl";	
			}else{
				$url = "questionurl";
			}
			$this->CI->t_user_notice_model->notice_content = "<a href='".$this->urlConfig["userspace"].$this->user_id."'>".$userinfo['user_nickname']."</a>".$this->noticeTypeDescription."<a href='".$this->urlConfig[$url].$discinfo->content_id."'>".$this->blogTitle."</a>";
			return $this->CI->t_user_notice_model->insert();
		}else{
			return true;	
		}

	}
}
/**
 *description:生成分享灵感通知
 *author:yanyalong
 *date:2013/11/04
 */
class GetNoticeByShare extends GetNotice{
	public function GetMyNotice(){
		$this->noticeTypeDescription = "分享了您的";
		$this->CI->t_user_notice_model->notice_type = 5;
		return $this->noticeEdit();
	}
}
/**
 *description:生成回答通知
 *author:yanyalong
 *date:2013/11/04
 */
class GetNoticeByAnswer extends GetNotice{
	public function GetMyNotice(){
		$this->noticeTypeDescription = "回答了您的";
		$this->CI->t_user_notice_model->notice_type = 6;
		return $this->noticeEdit();
	}
}
/**
 *description:生成回复答案通知
 *author:yanyalong
 *date:2013/11/04
 */
class GetNoticeByReplyAnswer extends GetNotice{
	public function GetMyNotice(){
		//获取当前回复信息
		$answerinfo= $this->CI->t_answer_model->get($this->content_id);
		//获取当前回复的父评论信息
		$panswerinfo= $this->CI->t_answer_model->get($answerinfo->answer_pid);
		$this->blogTitle = $answerinfo->answer_content;
		$this->CI->t_user_notice_model->user_id = $panswerinfo->answer_user_id;
		$userinfo = $this->CI->t_user_model->userinfo($this->user_id);
		$userinfo['user_nickname'] = ($userinfo['user_nickname'])?$userinfo['user_nickname']:$userinfo['user_email'];
		if($this->user_id!=$panswerinfo->answer_user_id){
			$this->noticeTypeDescription = "回复了你的回答：";
			$this->CI->t_user_notice_model->notice_type = 7;
			$url = "questionurl";
			$this->CI->t_user_notice_model->notice_content = "<a href='".$this->urlConfig["userspace"].$this->user_id."'>".$userinfo['user_nickname']."</a>".$this->noticeTypeDescription."<a href='".$this->urlConfig[$url].$answerinfo->question_id."'>".$this->blogTitle."</a>";
			return $this->CI->t_user_notice_model->insert();
		}else{
			return true;	
		}
	}
}
/**
 *description:生成加入项目灵感集通知
 *author:yanyalong
 *date:2013/11/04
 */
class GetNoticeByAlbum extends GetNotice{
	public function GetMyNotice(){
		$userinfo = $this->CI->t_user_model->userinfo($this->user_id);
		$userinfo['user_nickname'] = ($userinfo['user_nickname'])?$userinfo['user_nickname']:$userinfo['user_email'];
		$flag = true;
		switch ($this->blog_type) {
		case '1':	//家居美图，装修美图
			$content  = $this->CI->t_content_model->get($this->content_id);
			$this->blogTitle = $content->content_title;
			$this->CI->t_user_notice_model->user_id = $content->user_id;
			$this->CI->t_user_notice_model->notice_content = "<a href='".$this->urlConfig["userspace"].$this->user_id."'>".$userinfo['user_nickname']."</a>将您的<a href='".$this->urlConfig["contenturl"].$this->content_id."'>".$this->blogTitle."</a>加入了项目灵感集"; 
			if($content->user_id==$this->user_id){
				$flag = false;	
			}
			break;
		case '2'://装修问题
			$question= $this->CI->t_questions_model->get($this->content_id);
			$this->blogTitle = $question->question_title;
			$this->CI->t_user_notice_model->user_id = $question->user_id;
			$this->CI->t_user_notice_model->notice_content = "<a href='".$this->urlConfig["userspace"].$this->user_id."'>".$userinfo['user_nickname']."</a>将您的<a href='".$this->urlConfig["questionurl"].$this->content_id."'>".$this->blogTitle."</a>加入了项目灵感集"; 
			if($question->user_id==$this->user_id){
				$flag = false;	
			}
			break;
		}
		if($flag==true){
			return $this->CI->t_user_notice_model->insert();
		}else{
			return true;
		}
	}
}

//策略类
class Notice{
	public function Notice($noticeTypeClass="",$user_id="",$content_id="",$blog_type="",$systemNotice="",$notice_expiry="",$fuser_id=""){
		$obj = new $noticeTypeClass($user_id,$content_id,$blog_type,$systemNotice,$notice_expiry,$fuser_id);
		if($obj instanceof GetNotice){//若当前对象的抽象继承于抽象类，则符合规范
			return $obj->GetMyNotice();
		}else{//否则显示错误信息
			return false;
		}
	}
}

