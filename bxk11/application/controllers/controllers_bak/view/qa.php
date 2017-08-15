<?php

/**
 *description:装修问题
 *author:yanyalong
 *date:2013/11/07
 */
class qa extends User_Controller {

	public $answer;
	public $limit;
	function __construct(){
		parent::__construct();
		$this->load->model('t_answer_model');
		$this->answer =$this->t_answer_model;
		$this->limit = 10;
	}

	public function question(){
		safeFilter();
		$this->config->load('url');
		$config = $this->config->item('url');
		$question_id= $this->input->post('qid',true);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->load->model('t_questions_model');
		$this->t_questions_model->question_id = $question_id;
		$question= $this->t_questions_model->getquestioninfo();
		if($question==false){
			$res = $this->t_questions_model->get($question_id);
			$questioninfo['userspace'] = $config['userspace'].$res->user_id;
			$userinfo = model("t_user")->get($res->user_id);
			$questioninfo['nick_name'] = $userinfo->user_nickname;
			$questioninfo['user_pic']= model("t_user_info")->avatar($res->user_id);
			$questioninfo['uid'] = $res->user_id;
			if($user_id==""){
				$questioninfo['is_follow'] = "0";		
			}else{
				$questioninfo['is_follow'] = model('t_user_follow')->is_follow($user_id,$res->user_id);	
			}
			echojson(1,$questioninfo,"不存在的装修问题");
		}
		$questioninfo['class_pname']= $question->class_pname;
		$questioninfo['class_name'] = $question->class_name;
		$questioninfo['class_id'] = $question->class_id;
		$questioninfo['class_pid'] = $question->class_pid;
		$questioninfo['id'] = $question->question_id;
		$questioninfo['uid'] = $question->user_id;
		$questioninfo['is_me'] = ($question->user_id==$user_id)?"1":"0";
		$questioninfo['project_id'] = ($question->project_id!=null)?$question->project_id:"";
		$questioninfo['project_name'] = ($question->project_name!=null)?$question->project_name:"";
		$questioninfo['title'] = $question->question_title;
		$questioninfo['likes'] = $question->question_likes;
		$questioninfo['shares'] = $question->question_share;
		$questioninfo['recommends'] = $question->question_recommend;
		$questioninfo['disc'] = $question->question_answers;
		$this->config->load('url');
		$config = $this->config->item('url');
		$questioninfo['url'] = $config['questionurl'].$question->question_id;
		$questioninfo['status'] = ($question->question_status==3)?"精选":"";
		$questioninfo['sub_time'] = $question->question_subtime;
		$questioninfo['project_num'] = $question->question_project;
		$this->t_questions_model->user_id = $question->user_id;
		$this->t_questions_model->question_id = $question_id;
		$pl_question = $this->t_questions_model->pl_question();
		$questioninfo['right_page'] = $pl_question['prev_question'];
		$questioninfo['left_page'] = $pl_question['last_question'];
		$questioninfo['plurl'] = $config['questionurl'];
		$question_question = $this->t_questions_model->content_analytic($question->question_content);
		$questioninfo['content'] = $question_question['question_content'];
		$questioninfo['pic_num'] = $question_question['pic_num'];
		$userinfo = model("t_user")->get($question->user_id);
		$questioninfo['nick_name'] = ($userinfo->user_nickname!="")?$userinfo->user_nickname:$userinfo->user_email;
		$questioninfo['userspace'] = $config['userspace'].$question->user_id;
		$questioninfo['user_pic']= model("t_user_info")->avatar($question->user_id);
		if($user_id==""){
			$questioninfo['is_follow'] = "0";		
			$questioninfo['is_like'] = "0";		
			$questioninfo['is_recommend'] = "0";		
		}else{
			$questioninfo['is_follow'] = model('t_user_follow')->is_follow($user_id,$question->user_id);	
			$questioninfo['is_like'] = model('t_like_questions')->is_like($question_id,$user_id);	
			$questioninfo['is_recommend'] = model('t_question_approval')->is_approval($question_id,$user_id);	
		}
		if($question_question['pic_md5']!=""){
			foreach ($question_question['pic_md5'] as $key=>$val) {
				$questioninfo['pic_list'][$key]['pic_url'] = $val['thumb_1'];
				$questioninfo['pic_list'][$key]['pic_content'] = $val['pic_content'];
			}
		}else{
			$questioninfo['pic_list'] = "";
		}
		echojson(0,$questioninfo);
	}
	/**
	 *description:编辑家居美图数据
	 *author:yanyalong
	 *date:2013/11/08
	 */
	public function editquestion(){
		safeFilter();
		$question_id= $this->input->post('qid',true);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->load->model('t_question_class_model');
		$this->t_question_class_model->class_pid = 0;
		$p_class_list = $this->t_question_class_model->get_where('class_pid');
		$this->load->model('t_questions_model');
		$this->t_questions_model->question_id = $question_id;
		$question= $this->t_questions_model->getquestioninfo();
		if($question==false){
			echojson(1,"","不存在的装修问题");
		}
		$this->t_question_class_model->class_pid = $question->class_pid;
		$class_list = $this->t_question_class_model->get_where('class_pid');
		foreach($p_class_list as $key=>$val){
			$questioninfo['p_class_list'][$key]['class_id'] = $val->class_id;	
			$questioninfo['p_class_list'][$key]['class_name'] = $val->class_name;	
			if($question->class_pid==$val->class_id){
				$questioninfo['p_class_list'][$key]['select'] = "1";	
			}	
		}	
		foreach($class_list as $key=>$val){
			$questioninfo['class_list'][$key]['class_id'] = $val->class_id;	
			$questioninfo['class_list'][$key]['class_name'] = $val->class_name;	
			if($question->class_id==$val->class_id){
				$questioninfo['class_list'][$key]['select'] = "1";	
			}	
		}	
		$questioninfo['title'] = $question->question_title;
		$this->t_questions_model->question_id = $question_id;
		$question_question = $this->t_questions_model->content_analytic($question->question_content);
		$questioninfo['content'] = $question_question['question_content'];
		if(is_array($question_question["pic_md5"])){
			foreach ($question_question['pic_md5'] as $key=>$val) {
				$questioninfo['pic_list'][$key]['pic_url'] = $val['thumb_1'];
				$questioninfo['pic_list'][$key]['pic_content'] = $val['pic_content'];
			}
		}else{
			$questioninfo['pic_list'] = "";
		}
		echojson(0,$questioninfo);
	}
	/**
	 *description:我喜欢的装修问题
	 *author:yanyalong
	 *date:2013/11/12
	 */
	public function likequestion(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$p= $this->input->post('p',true);
		$res = model("t_like_questions")->mylike($user_id,$p,9);
		$this->config->load('url');
		$config = $this->config->item('url');
		if(empty($res)){
			echojson(1,'',"无更多数据");
		}
		foreach ($res as $key=>$val) {
			$contentlist[$key]['id'] = $val->question_id;	
			$contentlist[$key]['title'] = $val->question_title;
			$contentlist[$key]['class_pname'] = $val->class_pname;
			$contentlist[$key]['class_name'] = $val->class_name;
			$contentlist[$key]['likes'] = $val->question_likes;	
			$contentlist[$key]['shares'] = $val->question_share;	
			$contentlist[$key]['url'] = $config['questionurl'].$val->question_id;
			$contentlist[$key]['answers'] = $val->question_answers;
			$contentlist[$key]['sub_time'] = $val->question_subtime;
			$contentlist[$key]['project_num']= $val->question_project;
			$contentlist[$key]['status']= ($val->question_status=="3")?"精选":"";
			$contentlist[$key]['is_like']= "1";
			$content = model("t_questions")->content_analytic($val->question_content);
			if(is_array($content['pic_md5'])){
				foreach ($content['pic_md5'] as $keys=>$vals) {
					$contentlist[$key]['content'] = $content['question_content'];
					$contentlist[$key]['pic_list'][$keys]['pic_url'] = $vals['thumb_1'];
					$contentlist[$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
				}
			}
		$userinfo = model("t_user")->get($val->user_id);
		$contentlist[$key]['nick_name'] = ($userinfo->user_nickname!="")?$userinfo->user_nickname:$userinfo->user_email;
		$contentlist[$key]['uid'] = $val->user_id;
		$contentlist[$key]['user_pic'] = model('t_user_info')->avatar($val->user_id);
		$contentlist[$key]['userspace'] = $config['userspace'].$val->user_id;
		
		}
		echojson(0,$contentlist);
	}
	
	/**
	 * @abstract 获取回答列表
	 * @author liuguangping
	 * @version jia178 v.10 2013/11/07
	 *
	 */
	
	public function getanswers(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$question_id =$this->input->post('qid',true);
		$page = $this->input->post('p',true);
		if(!is_numeric($page) or $page < 1 or !$page)
			$page = 1;
		$limit = $this->limit;
		$office = ($page-1)*$limit;
		$select_field = 'answer_user_id,answer_id,answer_content,question_id,answer_user_nickname,answer_pid';
		$where = array('question_id'=>$question_id,'answer_status'=>1);
		$result = $this->answer->get_page($select_field,'answer_id','desc',$where,$limit,$office);
		$array = array();
		foreach ($result as $val){
			$value = $this->answer->new_answer($val['answer_user_id'],$val['question_id'],$val['answer_id'],$val['answer_user_nickname'],$val['answer_content'],$val['answer_pid']);
			if($user_id == ''){
				$is_black = 0;
			}else{
				$is_black = model('t_user_disable')->is_black($user_id,$val['answer_user_id']);
			}
			
			$array[] = array(
					'user_id'=>$value['user_id'],
					'user_pic'=>$value['user_pic'],
					'answer_id'=>$value['answer_id'],
					'answer_content'=>$value['answer_content'],
					'is_black'=>$is_black
			);
		}
		if($array){
			echojson(0, $array);
		}else{
			echojson(1,'', '此问题还没有人回答！');
		}
	}

	/**
	 *description:获取相关问题列表
	 *author:yanyalong
	 *date:2013/11/18
	 */
	public function getlike(){
		safeFilter();
		$keyword = $this->input->post('kw',true);
	   	if($keyword==""){
			echojson('1','','无相关数据');
		}
		$res = model("t_questions")->getlike($keyword,5);
	   	if($res==false){
			echojson('1','','无相关数据');
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		$question = array();
		foreach ($res as $key=>$val) {
			$question[$key]['url'] = $config['questionurl'].$val->question_id;
			$question[$key]['title'] = $val->question_title;
		}
		echojson(0,$question);
	}
}


