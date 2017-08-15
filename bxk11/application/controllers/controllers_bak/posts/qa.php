<?php
class Qa extends User_Controller {
	public $answer;
	public $limit;
	public $question;

	function __construct(){
		parent::__construct();
		$this->ajax_checklogin();
		$this->load->model('t_answer_model');
		$this->load->model('t_questions_model');
		$this->answer =$this->t_answer_model;
		$this->question = $this->t_questions_model;
		$this->limit = 10;
	}
	/**
	 * @abstract 添加内容
	 * @author liuguangping
	 * @version jia178 v.10 2013/11/07
	 * @todo 这里 还没做积分和通知未写和敏感词过滤
	 */
	public function addanswers(){
		safeFilter();
		$this->answer->answer_pid = 0;
		$this->answer->answer_user_id = $_SESSION['user_id'];
		loadLib("Score_Class");
		$Score_Class = new Score_Class($this->answer->answer_user_id,"answer_add");
		if($Score_Class->checkScore()==false){
			echojson(1,'',"积分不足");
		}			
		$user_info =  model("t_user")->get(trim($this->answer->answer_user_id));
		$this->answer->answer_user_nickname = $user_info->user_nickname;

		$this->answer->question_id  = $this->input->post('qid',true);
		$this->answer->answer_content = $this->input->post('answer_str',true);
		$question = model("t_questions")->get($this->answer->question_id);
		$is_black = model("t_user_disable")->is_black($question->user_id,$this->answer->answer_user_id);	
		if($is_black=='1'){
			echojson(1,"",'根据对方设置，您无法进行该操作');
		}

		if(!is_numeric($this->answer->question_id)){
			echojson(1,"","非法操作！");
		}
		if(empty($this->answer->answer_content)){
			echojson(1,"","回答内容不能为空！");
		}
		$forbiddenword = array();
		if(in_array($this->answer->answer_content,$forbiddenword)){
			echojson(1,"","请改用词，之中有敏感词！");
		}
		$this->answer->answer_status = 1;
		$this->answer->answer_subtime = date('Y-m-d H:i:s',time());
		$answer_id = $this->answer->insert();
		if($answer_id!=false){
			if($Score_Class->checkMax()==true){
				$Score_Class->modScore();
			}			
			$answerinfo = $this->answer->new_answer($this->answer->answer_user_id,$this->answer->question_id,$answer_id,$this->answer->answer_user_nickname,$this->answer->answer_content,$this->answer->answer_pid);
			model("t_user")->user_status($this->answer->answer_user_id,'user_answers','+');
			model("t_questions")->question_status($this->answer->question_id,'question_answers','+');
			$data['question_last_answerer'] = $this->answer->answer_user_nickname;
			$data['question_last_answerer_id'] = $this->answer->answer_user_id;
			$where = array('question_id'=>$this->answer->question_id);
			$this->question->updates_global($data,$where);
			loadLib("Notice");
			$notice = new Notice("GetNoticeByAnswer",$this->answer->answer_user_id,$this->answer->question_id,2);
			loadLib("User_Feed");
			new Feed("GetFeedByDiscQuestion",$this->answer->answer_user_id,$this->answer->question_id);
			echojson(0,$answerinfo,'回答成功！');
		}else{
			echojson(1,"","回答失败！");
		}
	}


	/**
	 *description:问题有用无用
	 *author:baohanbin
	 *date:2013/11/07
	 */
	public function useful()
	{
		safeFilter();
		$user_id = $_SESSION['user_id'];
		$qa_id = $this->input->post('qid',true);
		$this->load->model('t_question_approval_model');
		$this->t_question_approval_model->user_id = $user_id;
		$this->t_question_approval_model->approval_obj_id = $qa_id;
		$this->t_question_approval_model->approval_obj_type = 1;
		$obj = $this->t_question_approval_model->get_id($user_id,$qa_id);
		if($obj)
		{
			$res = $this->t_question_approval_model->del($user_id,$qa_id);
			$this->load->model('t_questions_model');
			$mes = $this->t_questions_model->del_questions($qa_id);
			$this->load->model('t_user_model');
			$nes = $this->t_user_model->del_recommend($user_id);
			if(($res || $mes || $nes) == true)
			{
				echojson(0,"",'删除成功');
			}
			else
			{
				echojson(1,"",'删除失败');
			}
		}
		else
		{
			$res = $this->t_question_approval_model->insert();
			$this->load->model('t_questions_model');
			$mes = $this->t_questions_model->up_questions($qa_id);
			$this->load->model('t_user_model');
			$nes = $this->t_user_model->up_recommend($user_id);
			if(($res || $mes || $nes) == true)
			{
				echojson(0,"",'成功');
			}
			else
			{
				echojson(1,"",'失败');
			}
		}
	}

	/**
	 * @abstract 回复回答
	 * @author liuguangping
	 * @version jia178 v.10 2013/11/07
	 * @todo 这里 还没做积分和通知未写和敏感词过滤
	 */
	public function addreply(){
		safeFilter();
		$this->answer->answer_pid = $this->input->post('aid',true);	
		$this->answer->answer_user_id = $_SESSION['user_id'];
		loadLib("Score_Class");
		$Score_Class = new Score_Class($this->answer->answer_user_id,"answer_add");
		if($Score_Class->checkScore()==false){
			echojson(1,'',"积分不足");
		}			
		$this->answer->answer_user_nickname = trim($_SESSION['user_nickname']);
		$user_info =  model("t_user")->get(trim($this->answer->answer_user_id));
		$this->answer->answer_user_nickname = $user_info->user_nickname;
		$this->answer->answer_content = $this->input->post('reply_str',true);

		$answer= model('t_answer')->get($this->answer->answer_pid);
		$question= model('t_questions')->get($answer->question_id);
		$is_black = model("t_user_disable")->is_black($question->user_id,$this->answer->answer_user_id);	
		if($is_black=='1'){
			echojson(1,'根据对方设置，您无法进行该操作');
		}
		if(!is_numeric($this->answer->answer_pid )){
			echojson(1,"","非法请求！");
		}
		if(empty($this->answer->answer_content)){
			echojson(1,"","回复内容不能为空！");
		}

		$forbiddenword = array();
		if(in_array($this->answer->answer_content,$forbiddenword)){
			echojson(1,"","请改用词，之中有敏感词！");
		}
		$this->answer->answer_status = 1;
		$this->answer->answer_subtime = date('Y-m-d H:i:s',time());
		$quertions = model('t_answer')->get($this->answer->answer_pid);
		$this->answer->question_id  = $quertions->question_id;
		//if($quertions->answer_user_id == $this->answer->answer_user_id){
		//echojson(1,"","不能回复自己");
		//}
		$answer_id = $this->answer->insert();
		if($answer_id!=false){
			if($Score_Class->checkMax()==true){
				$Score_Class->modScore();
			}			
			$answerinfo = $this->answer->new_answer($this->answer->answer_user_id,$this->answer->question_id,$answer_id,$this->answer->answer_user_nickname,$this->answer->answer_content,$this->answer->answer_pid);
			model("t_user")->user_status($this->answer->answer_user_id,'user_answers','+');
			model("t_questions")->question_status($this->answer->question_id,'question_answers','+');
			loadLib("Notice");
			$notice = new Notice("GetNoticeByReplyAnswer",$this->answer->answer_user_id,$answer_id,2);
			loadLib("User_Feed");
			new Feed("GetFeedByReplyQuestion",$this->answer->answer_user_id,$this->answer->question_id);
			echojson(0,$answerinfo,'回复成功！');
		}else{
			echojson(1,"","回答失败！");
		}
	}
	/**
	 * @abstract 删除回答记录
	 * @author liuguangping
	 * @version jia178 v.10 2013/11/07
	 * @todo 这里 通知未写
	 * 
	 */
	public function delanswers(){

		safeFilter();
		$answer_id =$this->input->post('id',true);
		$answer_user_id = $_SESSION['user_id'];
		if($result = $this->answer->get($answer_id)){

			if($result->answer_user_id ==  $answer_user_id){
				$data['answer_status'] = 21;
				$where = array('answer_id'=>$answer_id);
				if($this->answer->updates_global($data,$where)){
					model("t_user")->user_status($this->answer->answer_user_id,'user_answers','-');
					echojson(0,'','删除成功！');
				}else{

					echojson(1,'','删除失败！');
				}
			}else{
				echojson(1,'','不是本人的回答的，不能删除！');
			}
		}else{
			echojson(1,'','非法操作,未能找到记录！');
		}
	}
	/**
	 * @abstract 删除问题记录
	 * @author liuguangping
	 * @version jia178 v.10 2013/11/07
	 * @todo 这里 通知未写
	 *
	 */
	public function delquestion(){
		safeFilter();
		$question_id = htmlspecialchars(trim($this->input->post('qid')));
		$question_user_id = $_SESSION['user_id'];
		if($result = $this->question->get($question_id)){
			if($result->user_id ==  $question_user_id){
				$data['question_status'] = 11;
				$where = array('question_id'=>$question_id);
				if($this->question->updates_global($data,$where)){
					model("t_user")->user_status($question_user_id,'user_questions','-');
					echojson(0,'','删除成功！');
				}else{
					echojson(1,'','删除失败！');
				}
			}else{
				echojson(1,'','不是本人的问题，不能删除！');
			}
		}else{
			echojson(1,'','非法操作,未能找到记录！');
		}
	}
	/**
	 *description:编辑装修问题
	 *author:yanyalong
	 *date:2013/11/08
	 */
	public function editquestion(){
		safeFilter();
		$user_id = $_SESSION['user_id'];
		$user_nickname = $_SESSION['user_nickname'];
		loadLib("Content_Class");
		$Content_Class = new Content_Class();	
		$question_id= $this->input->post('qid',true);
		$question_title= $this->input->post('content_title',true);
		$question_content= $this->input->post('content_content',true);
		$question_content= $Content_Class->replace_str($question_content);
		$imgname= $this->input->post('imgname',true);
		$class= $this->input->post('class_id',true);
		$sensitive_check = true;
		if($sensitive_check==false){
			echojson(1,"","存在敏感词");
		}	
		if(trim($question_title)==''){
			echojson(1,"","标题不能为空");
		}
		if((strlen(trim($question_title)) + mb_strlen(trim($question_title),'UTF8'))/2>40){
			echojson(1,"","标题不能超过20个字");
		}
		if(trim($class)==''){
			echojson(1,"","禁止非法操作");
		}
		$class_arr = explode('^|^',$class);
		$content_img = "[img]";
		$score = 0;
		if($imgname!=""){
			foreach(explode('|^|',rtrim($imgname,'|^|')) as $key=>$info){
				$imginfo[] = explode('^|^',trim($info,','));
			}	
			$this->config->load('uploads');
			$config = $this->config->item('question');
			$countimg=0;
			//积分计数器，记录积分事件
			$this->load->database();
			foreach ($imginfo as $key=>$val) {
				$pic_content = $Content_Class->replace_str($val[1]);
				$pic_id = model("t_pic")->pic_add($config['upload_path'].$val[0],$user_id,$pic_content);
				$picinfo[] = $pic_id.':'.$val[0].':'.$pic_content;
				$countimg++;
			}
			//记录积分事件
			$score++; 
			$content_img .= $countimg."{";
			foreach ($picinfo as $key=>$val) {
				$content_img .= $val.',';
			}
			$content_img  =trim($content_img,',');
			$content_img .="}";
		}else{
			$content_img .=" ";
		}
		$content_img .="[/img]";
		$question_content = "[content]".$question_content."[/content]".$content_img;
		$this->load->model('t_questions_model');
		$this->t_questions_model->question_id = $question_id;
		$question= $this->t_questions_model->getquestioninfo();
		$this->t_questions_model->question_title= $question_title;
		$this->t_questions_model->question_content= $question_content;
		$this->t_questions_model->class_pid= $class_arr['0'];
		$this->t_questions_model->class_id= $class_arr['1'];
		$this->t_questions_model->question_id=$question_id;
		$this->load->model('t_question_class_model');
		$questionClassInfo = $this->t_question_class_model->get($class_arr['1']);
		$this->t_questions_model->class_name = $questionClassInfo->class_name;
		$this->t_questions_model->class_pname = $questionClassInfo->class_p_name;;
		$editflag = model('t_questions')->question_edit();
		if($editflag==true){
			////保存分享信息
			//$this->load->model('t_user_share_model');
			//$this->t_user_share_model->user_id= $user_id;
			//$this->t_user_share_model->share_url= '';
			//$this->t_user_share_model->share_dest_url= '';
			//$this->t_user_share_model->user_id= $user_id;
			//$this->t_user_share_model->share_type= 3;
			//$share_id= $this->t_user_share_model->insert();	
			//if($share_id!=false){
			////记录积分事件
			//$score++; 
			//}
			//$this->load->model('t_user_feeds_model');
			//$this->t_user_feeds_model->user_id= $user_id;
			//$this->t_user_feeds_model->feed_content= '';
			//$this->t_user_feeds_model->feed_type= '';
			//$share_id= $this->t_user_feeds_model->insert();	
			//更新用户积分
			//测试更新功能
			//$this->load->model('t_user_model');
			//$userinfo = $this->t_user_model->get($user_id);
			//$userinfo->user_vailable_score = "user_vailable_score+1";
			//$userinfo->update($user_id);
			$this->load->model('t_question_class_model');
			if($class_arr['0']!=$question->class_pid){
				$this->t_question_class_model->updateClassNumbers($class_arr['0'],'+');
				$this->t_question_class_model->updateClassNumbers($question->class_pid,'-');
			}
			if($class_arr['1']!=$question->class_id){
				$this->t_question_class_model->updateClassNumbers($class_arr['1'],'+');
				$this->t_question_class_model->updateClassNumbers($question->class_id,'-');
			}
			echojson(0,'',"编辑成功");
		}else{
			echojson(1,'',"编辑失败");
		}
	}
	/**
	 *description:喜欢、取消喜欢
	 *author:yanyalong
	 *date:2013/11/08
	 */
	public function like(){
		safeFilter();
		$question_id= $this->input->post('qid');
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		loadLib("Score_Class");
		$Score_Class = new Score_Class($user_id,"like_add");
		if($Score_Class->checkScore()==false){
			echojson(1,'',"积分不足");
		}			
		$this->load->model('t_like_questions_model');				
		$is_like = $this->t_like_questions_model->is_like($question_id,$user_id);	
		$this->t_like_questions_model->like_question_id= $question_id;
		$this->t_like_questions_model->user_id = $user_id;
		if($is_like=="1"){
			if($this->t_like_questions_model->dellike()!=false){
				model("t_user")->user_status($user_id,'user_likes','-');
				model("t_questions")->question_status($question_id,'question_likes','-');
				echojson(0,"",'取消喜欢成功');
			}else{
				echojson(1,"",'取消喜欢失败');
			}												
		}else{
			$this->t_like_questions_model->like_q_type=1;
			if($this->t_like_questions_model->insert()!=false){
				if($Score_Class->checkMax()==true){
					$Score_Class->modScore();
				}			
				model("t_user")->user_status($user_id,'user_likes','+');
				model("t_questions")->question_status($question_id,'question_likes','+');
				loadLib("Notice");
				$notice = new Notice("GetNoticeByLikes",$user_id,$question_id,"2");
				loadLib("User_Feed");
				new Feed("GetFeedByLikeQuestion",$user_id,$question_id);
				echojson(0,"",'喜欢成功');
			}else{
				echojson(1,"",'喜欢失败');
			}
		}
	}
}
