<?php
/**
 *description:用户信息
 *author:yanyalong
 *date:2013/11/05
 */
class User extends User_Controller {

	function __construct(){
		parent::__construct();
	}

	/**
	 *description:我发布的灵感博文数据
	 *author:yanyalong
	 *date:2013/11/06
	 */
	public function mydesign(){
		safeFilter();
		$user_id = $_SESSION['user_id'];
		$p = $this->input->post('p',true);
		$limit = 5;
		$offset = ($p-1)*$limit;
		$this->load->model('t_content_model');
		$this->t_content_model->user_id= $user_id;
		$this->t_content_model->content_type = 1;
		$res = $this->t_content_model->getbyuser($limit,$offset);
		if(empty($res)){
			echojson(1,'',"无更多数据");
		}
		$contentlist = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$contentlist[$key]['id'] = $val->content_id;	
			$contentlist[$key]['project_num']= $val->content_project;
			$contentlist[$key]['title'] = $val->content_title;	
			$contentlist[$key]['tags'] = model('t_tag')->taglist_url($val->content_tag,5);
			$contentlist[$key]['project_id'] = ($val->project_id!=null)?$val->project_id:"";	
			$contentlist[$key]['project_name'] = ($val->project_name!=null)?$val->project_name:"";	
			$contentlist[$key]['likes'] = $val->content_likes;	
			$contentlist[$key]['shares'] = $val->content_share;	
			$contentlist[$key]['sub_time'] = $val->content_subtime;	
			$contentlist[$key]['url'] = $config['contenturl'].$val->content_id;
			$content = model("t_content")->content_analytic($val->content_content);
			$contentlist[$key]['content'] = $content['content_content'];
			$contentlist[$key]['pic_num'] = $content['pic_num'];
			foreach ($content['pic_md5'] as $keys=>$vals) {
				$contentlist[$key]['pic_list'][$keys]['pic_url1'] = $vals['thumb_1'];
				$contentlist[$key]['pic_list'][$keys]['pic_url2'] = $vals['thumb_2'];
				$contentlist[$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
			}
		}
		echojson(0,$contentlist);
	}
	/**
	 *description:我发布的装修问题数据
	 *author:yanyalong
	 *date:2013/11/06
	 */
	public function myquestion(){
		safeFilter();
		$user_id = $_SESSION['user_id'];
		$p = $this->input->post('p',true);
		$limit = 8;
		$offset = ($p-1)*$limit;
		$this->load->model('t_questions_model');
		$this->t_questions_model->user_id= $user_id;
		$res = $this->t_questions_model->getbyuser($limit,$offset);
		if(empty($res)){
			echojson(1,'',"无更多数据");
		}
		$questionlist = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$questionlist[$key]['id'] = $val->question_id;	
			$questionlist[$key]['project_num']= $val->question_project;
			$questionlist[$key]['project_id'] = ($val->project_id!=null)?$val->project_id:"";	
			$questionlist[$key]['project_name'] = ($val->project_name!=null)?$val->project_name:"";	
			$questionlist[$key]['title'] = $val->question_title;	
			$questionlist[$key]['class_pname'] = $val->class_pname;	
			$questionlist[$key]['class_name'] = $val->class_name;	
			$questionlist[$key]['likes'] = $val->question_likes;	
			$questionlist[$key]['shares'] = $val->question_share;	
			$questionlist[$key]['shares'] = $val->question_share;	
			$questionlist[$key]['answers'] = $val->question_answers;	
			$questionlist[$key]['sub_time'] = $val->question_subtime;	
			$questionlist[$key]['url'] = $config['questionurl'].$val->question_id;
			$content = model("t_questions")->content_analytic($val->question_content);
			$questionlist[$key]['content'] = $content['question_content'];
			$questionlist[$key]['pic_num'] = $content['pic_num'];
			if($content['pic_md5']!=""){
				foreach ($content['pic_md5'] as $keys=>$vals) {
					$questionlist[$key]['pic_list'][$keys]['pic_url1'] = $vals['thumb_1'];
					$questionlist[$key]['pic_list'][$keys]['pic_url2'] = $vals['thumb_2'];
					$questionlist[$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
				}
			}else{
				$questionlist[$key]['pic_list'] = "";
			}
		}
		echojson(0,$questionlist);
	}
	/**
	 *description:我发布的家居美图数据
	 *author:yanyalong
	 *date:2013/11/06
	 */
	public function myproduct(){
		safeFilter();
		$user_id = $_SESSION['user_id'];
		$p = $this->input->post('p',true);
		$limit = 5;
		$offset = ($p-1)*$limit;
		$this->load->model('t_content_model');
		$this->t_content_model->user_id= $user_id;
		$this->t_content_model->content_type = 2;
		$res = $this->t_content_model->getbyuser($limit,$offset);
		if(empty($res)){
			echojson(1,'',"无更多数据");
		}
		$questionlist = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		$this->load->model('t_album_content_model');
		$this->load->model('t_pic_pin_model');
		foreach ($res as $key=>$val) {
			$contentlist[$key]['id'] = $val->content_id;	
			$contentlist[$key]['tags'] = model('t_tag')->taglist_url($val->content_tag,5);
			$contentlist[$key]['project_num']= $val->content_project;
			$contentlist[$key]['title'] = $val->content_title;	
			$contentlist[$key]['project_id'] = ($val->project_id!=null)?$val->project_id:"";	
			$contentlist[$key]['project_name'] = ($val->project_name!=null)?$val->project_name:"";	
			$contentlist[$key]['likes'] = $val->content_likes;	
			$contentlist[$key]['shares'] = $val->content_share;	
			$contentlist[$key]['sub_time'] = $val->content_subtime;	
			$contentlist[$key]['url'] = $config['producturl'].$val->content_id;
			$content = model("t_content")->content_analytic($val->content_content);
			$contentlist[$key]['content'] = $content['content_content'];
			$contentlist[$key]['pic_num'] = $content['pic_num'];
			foreach ($content['pic_md5'] as $keys=>$vals) {
				$contentlist[$key]['pic_list'][$keys]['pic_url1'] = $vals['thumb_1'];
				$contentlist[$key]['pic_list'][$keys]['pic_url2'] = $vals['thumb_2'];
				$contentlist[$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
				$this->t_pic_pin_model->pic_id= $vals['pic_id'];
				$pin = $this->t_pic_pin_model->getbypic(); 
				foreach ($pin as $keyss=>$valss) {
					$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['class_name']= $valss->pin_product_class_name;				
					$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['class_id']= $valss->pin_product_class_id;
					$product_class = model("t_product_class")->get($valss->pin_product_class_id);
					$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['class_pid']= $product_class->p_class_pid;
					$product_pclass = model("t_product_class")->get($product_class->p_class_pid);
					$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['class_pname']= $product_pclass->p_class_name;
					$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_img']= $valss->pin_img;
					$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['product_url']= $valss->pin_product_url;
					$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['product_id']= $valss->pin_product_id;
					$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_left']= $valss->pin_left;
					$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_top']= $valss->pin_top;
					$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_content']= $valss->pin_content;
					$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_id']= $valss->pin_id;
					$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_title']= $valss->pin_product_name;
					$contentlist[$key]['pic_list'][$keys]['pic_width']= $valss->pic_width;
				}

			}
		}
		echojson(0,$contentlist);
	}

	/**
	 *description:个人中心最新一条我发布的博文、美图、问题
	 *author:yanyalong
	 *date:2013/11/11
	 */
	public function mynew(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->load->model('t_content_model');
		$this->t_content_model->user_id= $user_id;
		$res = $this->t_content_model->get_blog_quesiton($user_id,1,1);
		$this->config->load('url');
		$config = $this->config->item('url');
		if(empty($res)){
			echojson(1,$space,"无相关数据");
		}
		foreach ($res as $key=>$val) {
			$contentlist[$key]['id'] = $val->cid;	
			$contentlist[$key]['project_num']= $val->project_num;
			$contentlist[$key]['sub_time'] = $val->subtime;	
			$contentlist[$key]['title'] = $val->title;
			if($val->type=="3"){
				$contentlist[$key]['sub_project_url'] = "/index.php/posts/project/addtoquestion";
				$contentlist[$key]['like_url'] = "/index.php/posts/qa/like";
				$contentlist[$key]['post_type'] = "qid";
				$content = model("t_questions")->content_analytic($val->content);
				$contentlist[$key]['tags'] = "";
				if(is_array($content['pic_md5'])){
					foreach ($content['pic_md5'] as $keys=>$vals) {
						$contentlist[$key]['pic_url'] = $vals['thumb_2'];
					}
				}else{
					$contentlist[$key]['pic_url'] = "";
				}
				$contentlist[$key]['url'] = $config['questionurl'].$val->cid;
			}else{
				$contentlist[$key]['post_type'] = "cid";
				$contentlist[$key]['sub_project_url'] = "/index.php/posts/project/addtocontent";
				$content = model("t_content")->content_analytic($val->content);
				$contentlist[$key]['tags'] = model('t_tag')->taglist_url($val->tags,5);
				if(is_array($content['pic_md5'])){
					foreach ($content['pic_md5'] as $keys=>$vals) {
						$contentlist[$key]['pic_url'] = $vals['thumb_2'];
					}
				}else{
					$contentlist[$key]['pic_url'] = "";
				}
				if($val->type=="1"){
					$contentlist[$key]['url'] = $config['contenturl'].$val->cid;
				}else{
					$contentlist[$key]['url'] = $config['producturl'].$val->cid;
				}
			}
		}
		echojson(0,$contentlist);
	}

	/**
	 *description:个人主页首页信息
	 *author:yanyalong
	 *date:2013/11/11
	 */
	public function index(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$uid = $this->input->post('uid',true);
		$p = $this->input->post('p',true);
		$this->load->model('t_content_model');
		$this->t_content_model->user_id= $user_id;
		$res = $this->t_content_model->get_blog_quesiton($uid,$p,20);
		$this->config->load('url');
		$config = $this->config->item('url');
		$userinfo = model("t_user")->get($uid);
		$space['nick_name'] = ($userinfo->user_nickname!="")?$userinfo->user_nickname:$userinfo->user_email;
		$space['user_pic'] = model("t_user_info")->avatar($uid);
		$space['userspace'] = $config['userspace'].$uid;
		if($user_id==""){
			$space['is_follow'] = "0";		
		}else{
			$space['is_follow'] = model('t_user_follow')->is_follow($user_id,$uid);	
		}
		$space['is_me'] = ($user_id==$uid)?"1":"0";
		$space['is_login'] = ($user_id!="")?"1":"0";
		if(empty($res)){
			echojson(1,$space,"无更多数据");
		}
		foreach ($res as $key=>$val) {
			$contentlist[$key]['id'] = $val->cid;	
			$contentlist[$key]['project_num']= $val->project_num;
			$contentlist[$key]['likes'] = $val->likes;	
			$contentlist[$key]['title'] = $val->title;
			if($val->type=="3"){
				$contentlist[$key]['sub_project_url'] = "/index.php/posts/project/addtoquestion";
				$contentlist[$key]['like_url'] = "/index.php/posts/qa/like";
				$contentlist[$key]['post_type'] = "qid";
				$content = model("t_questions")->content_analytic($val->content);
				$contentlist[$key]['tags'] = "";
				if(is_array($content['pic_md5'])){
					foreach ($content['pic_md5'] as $keys=>$vals) {
						$contentlist[$key]['pic_url'] = $vals['thumb_2'];
					}
				}else{
					$contentlist[$key]['pic_url'] = "";
				}
				$contentlist[$key]['url'] = $config['questionurl'].$val->cid;
			}else{
				$contentlist[$key]['post_type'] = "cid";
				$contentlist[$key]['sub_project_url'] = "/index.php/posts/project/addtocontent";
				$contentlist[$key]['like_url'] = "/index.php/posts/content/like";
				$content = model("t_content")->content_analytic($val->content);
				$contentlist[$key]['tags'] = model('t_tag')->taglist_url($val->tags,5);
				if(is_array($content['pic_md5'])){
					foreach ($content['pic_md5'] as $keys=>$vals) {
						$contentlist[$key]['pic_url'] = $vals['thumb_2'];
					}
				}else{
					$contentlist[$key]['pic_url'] = "";
				}
				if($val->type=="1"){
					$contentlist[$key]['url'] = $config['contenturl'].$val->cid;
				}else{
					$contentlist[$key]['url'] = $config['producturl'].$val->cid;
				}
			}
		}
		$space['contentlist'] = $contentlist;
		echojson(0,$space);
	}
	/**
	 *description:个人中心首页
	 *author:yanyalong
	 *date:2013/11/13
	 */
	public function my(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$p= $this->input->post('p',true);
		$row = 5;
		$this->load->model('t_content_model');
		$follow_userlist = model("t_user_follow")->myfollow($user_id);
		if($follow_userlist==false){
			//获取我的订阅列表
			$this->load->model('t_content_tag_model');
			$res = $this->t_content_tag_model->get_tag_content($user_id,$p,$row);			
		}else{
			//获取我关注用户的信息
			$res = $this->t_content_model->myfollowcontent($follow_userlist,$user_id,$p,$row);			
		}
		if(empty($res)){
			echojson(1,'',"无更多数据");
		}
		$contentlist = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$userinfo = model('t_user')->userinfo($val->user_id);
			$contentlist[$key]['nickname'] = $userinfo['user_nickname'];
			$contentlist[$key]['id'] = $val->content_id;	
			$contentlist[$key]['project_num']= $val->content_project;
			$contentlist[$key]['title'] = $val->content_title;	
			$contentlist[$key]['tags'] = model('t_tag')->taglist_url($val->content_tag,5);
			$contentlist[$key]['likes'] = $val->content_likes;	
			$contentlist[$key]['uid'] = $val->user_id;	
			$contentlist[$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->user_id);	
			$contentlist[$key]['is_like'] = model('t_user_like')->is_like($val->content_id,$user_id);	
			$contentlist[$key]['userspace'] = $config['userspace'].$val->user_id;
			$contentlist[$key]['pic'] = model("t_user_info")->avatar($val->user_id);
			$contentlist[$key]['hot'] = $val->hot;
			$contentlist[$key]['is_me']= ($user_id==$val->user_id)?"1":"0";
			$contentlist[$key]['sub_time'] = $val->content_subtime;	
			if($val->content_type=="1"){
				$contentlist[$key]['url'] = $config['contenturl'].$val->content_id;
			}else{
				$contentlist[$key]['url'] = $config['questionurl'].$val->content_id;
			}
			$content = model("t_content")->content_analytic($val->content_content);
			$contentlist[$key]['pic_num'] = $content['pic_num'];
			$this->load->model('t_pic_pin_model');
			foreach ($content['pic_md5'] as $keys=>$vals) {
				$contentlist[$key]['pic_list'][$keys]['pic_url1'] = $vals['thumb_1'];
				$contentlist[$key]['pic_list'][$keys]['pic_url2'] = $vals['thumb_2'];
				$contentlist[$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
				if($val->content_type=="2"){
					$this->t_pic_pin_model->pic_id= $vals['pic_id'];
					$pin = $this->t_pic_pin_model->getbypic(); 
					foreach ($pin as $keyss=>$valss) {
						$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['pic_width']= $valss->pic_width;
						$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['class_name']= $valss->pin_product_class_name;				
						$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['class_id']= $valss->pin_product_class_id;
						$product_class = model("t_product_class")->get($valss->pin_product_class_id);
						$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['class_pid']= $product_class->p_class_pid;
						$product_pclass = model("t_product_class")->get($product_class->p_class_pid);
						$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['class_pname']= $product_pclass->p_class_name;
						$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_img']= $valss->pin_img;
						$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['product_url']= $valss->pin_product_url;
						$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['product_id']= $valss->pin_product_id;
						$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_left']= $valss->pin_left;
						$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_top']= $valss->pin_top;
						$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_content']= $valss->pin_content;
						$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_id']= $valss->pin_id;
						$contentlist[$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_title']= $valss->pin_product_name;
					}
				}
			}
		}

		echojson(0,$contentlist);
	}
	/**
	 *description:个人主页搜索数据
	 *author:yanyalong
	 *date:2013/11/14
	 */
	public function search(){
		safeFilter();
		$keyword= isset($_POST['wd'])?$this->input->post('wd'):"";
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$uid = $this->input->post('uid',true);
		$p = $this->input->post('p',true);
		if($uid==""||$p==""||$user_id==""){
			echojson(1,'',"无更多数据");
		}
		$this->load->model('t_content_model');
		$this->t_content_model->user_id= $user_id;
		$res = $this->t_content_model->get_blog_quesiton($uid,$p,20,$keyword);
		if(empty($res)){
			echojson(1,'',"无更多数据");
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$contentlist[$key]['id'] = $val->cid;	
			$contentlist[$key]['project_num']= $val->project_num;
			$contentlist[$key]['likes'] = $val->likes;	
			$contentlist[$key]['sub_time'] = $val->subtime;	
			$contentlist[$key]['title'] = $val->title;
			if($val->type=="3"){
				$contentlist[$key]['sub_project_url'] = "/index.php/posts/project/addtoquestion";
				$contentlist[$key]['like_url'] = "/index.php/posts/qa/like";
				$contentlist[$key]['post_type'] = "qid";
				$content = model("t_questions")->content_analytic($val->content);
				$contentlist[$key]['tags'] = "";
				if(is_array($content['pic_md5'])){
					foreach ($content['pic_md5'] as $keys=>$vals) {
						$contentlist[$key]['pic_url'] = $vals['thumb_2'];
					}
				}else{
					$contentlist[$key]['pic_url'] = "";
				}
				$contentlist[$key]['url'] = $config['questionurl'].$val->cid;
			}else{
				$contentlist[$key]['post_type'] = "cid";
				$contentlist[$key]['sub_project_url'] = "/index.php/posts/project/addtocontent";
				$contentlist[$key]['like_url'] = "/index.php/posts/content/like";
				$content = model("t_content")->content_analytic($val->content);
				$contentlist[$key]['tags'] = model('t_tag')->taglist_url($val->tags,5);
				if(is_array($content['pic_md5'])){
					foreach ($content['pic_md5'] as $keys=>$vals) {
						$contentlist[$key]['pic_url'] = $vals['thumb_2'];
					}
				}else{
					$contentlist[$key]['pic_url'] = "";
				}
				if($val->type=="1"){
					$contentlist[$key]['url'] = $config['contenturl'].$val->cid;
				}else{
					$contentlist[$key]['url'] = $config['producturl'].$val->cid;
				}
			}
			$userinfo = model("t_user")->get($uid);
			$space['nick_name'] = ($userinfo->user_nickname!="")?$userinfo->user_nickname:$userinfo->user_email;
			$space['user_pic'] = model("t_user_info")->avatar($uid);
			if($user_id==""){
				$space['is_follow'] = "0";		
			}else{
				$space['is_follow'] = model('t_user_follow')->is_follow($user_id,$uid);	
			}
			$space['is_me'] = ($user_id==$uid)?"1":"0";
			$space['is_login'] = ($user_id!="")?"1":"0";
			$space['contentlist'] = $contentlist;

		}
		echojson(0,$space);
	}
	/**
	 *description:每日之星
	 *author:yanyalong
	 *date:2013/11/29
	 */

	public function index_recommend(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->config->load('url');
		$config = $this->config->item('url');
		//每日之星开始
		$userinfo = model("t_user")->get(model("t_system")->get("star_recommend")->sys_value);
		if($userinfo==false){
			echojson(1,"","无相关数据");
		}
		$todaystar['summary']= model("t_user_info")->get($userinfo->user_id)->user_summary;
		$todaystar['nickname'] = $userinfo->user_nickname;
		$todaystar['type'] = ($userinfo->user_type)?"装修达人":"普通用户";
		$todaystar['fans'] = $userinfo->user_fans;
		$todaystar['views'] = $userinfo->user_views;
		$todaystar['shares'] = $userinfo->user_share;
		$todaystar['user_pic'] = model("t_user_info")->avatar($userinfo->user_id);
		$todaystar['userspace'] = $config['userspace'].$userinfo->user_id;
		$todaystar['star_bg'] = $this->config->base_url()."static/images/main/index/star_bg.jpg";
		$todaystar['uid'] = $userinfo->user_id;
		if($user_id==""){
			$todaystar['is_follow'] = "0";		
		}else{
			$todaystar['is_follow'] = model('t_user_follow')->is_follow($user_id,$userinfo->user_id);	
		}
		if($user_id==$userinfo->user_id){
			$todaystar['is_me'] = "1";		
		}else{
			$todaystar['is_me'] = "0";		
		}
		$data['todaystar'] = $todaystar;
		//每日之星结束
		//热点装修问题开始
		//$this->load->model("t_questions_model");
		//$question = $this->t_questions_model->explore(1,2);		
		//if($question==false){
		//echojson(1,"","无相关数据");
		//}
		//foreach ($question as $key=>$val) {
		//$data['hotquestion'][$key]['url'] = $config['questionurl'].$val->question_id;
		//$data['hotquestion'][$key]['title'] = $val->question_title;
		//$data['hotquestion'][$key]['class_pname'] = $val->class_pname;
		//$data['hotquestion'][$key]['last_answer'] =model("t_answer")->last_answer($val->question_id)->answer_content;
		//$data['hotquestion'][$key]['answers'] = $val->question_answers;
		//}
		//热点装修问题结束
		echojson(0,$data);
	}
	/**
	 *description:获取个人全局信息
	 *author:yanyalong
	 *date:2013/12/16
	 */
	public function myinfo(){
		echo parent::myinfo();
	}
	/**
	 *description:个人空间用户基本信息
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function info(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$uid= isset($_POST['uid'])?$this->input->post('uid'):"";
		if($uid==""||$uid==0){
			echojson(0,"","无相关数据");
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		$this->load->model('t_user_model');
		$this->load->model('t_user_info_model');
		$this->load->model('t_project_scheme_model');
		$this->load->model('t_project_scheme_use_model');
		$this->load->model('t_project_model');
		$this->load->model('t_tag_take_model');
		//获取最新项目设计方案开始
		$user= $this->t_user_model->get($uid);
		if($user==false){
			echojson(0,"","没有此用户");
		}
		$userinfo= $this->t_user_info_model->get($uid);
		$data['user_pic'] = $this->t_user_info_model->avatar($uid);
		$data['userspace_pic'] = "http://cdn2.img.aijiake.com/photo/20130607/MTE3Mg==l.jpg";
		//普通用户默认方案
		if($user->group_id<11){
			$this->load->model("t_project_model");
			$projectinfo = $this->t_project_model->GetProjectInfoByDefault($uid);
			if($projectinfo==false){
				echojson(1,"",'请设置默认项目');
			}
			$project_id = $projectinfo->project_id;
			$defaultScheme= $this->t_project_scheme_use_model->getDefaultByUser($uid,$project_id);
		}elseif($user->group_id>20&&$user->group_id<27){
			//设计师默认方案
			$defaultScheme= $this->t_project_scheme_model->getDefaultByDesigner($uid);
		}		
		//获取默认方案信息
		//获取方案楼盘信息
		if($defaultScheme!=false){
			$schemeinfo = $this->t_project_scheme_model->get($defaultScheme->scheme_id);
			if($schemeinfo==false){
				echojson(1,"",'请设置当前项目的默认案例');
			}
			if($schemeinfo->scheme_user_type==2){
				$data['user_swf'] = $config['xml3d'].$defaultScheme->scheme_id;
			}elseif($schemeinfo->scheme_user_type==1){
				$data['user_swf'] = $config['xml3ddiyshow'].$defaultScheme->scheme_id;
			}else{
				$data['user_swf'] = "";
			}
			$houseinfo = $this->t_project_model->getHouseInfoByProject($defaultScheme->project_id);				
			$data['house'] = $houseinfo->house_name;
		}else{
			$data['house'] = "";
			$data['user_swf'] = "";
		}
		//参观他家
		$data['user_id'] = $uid;
		$data['nickname'] = $user->user_nickname;
		$data['user_level'] = $user->group_id;
		$data['user_summary'] = $userinfo->user_summary;
		$data['company'] = $userinfo->user_company;
		$data['userspace'] = $config['userspace'].$uid;
		if($uid==""){
			$data['is_follow'] = "0";		
		}else{
			$data['is_follow'] = model('t_user_follow')->is_follow($user_id,$uid);	
		}
		$data['is_me'] = ($uid==$user_id)?"1":"0";
		$data['send_message'] = $userinfo->user_company;
		$data['follows'] = $user->user_follows;
		$data['fans'] = $user->user_fans;
		$data['schemes']= $this->t_project_model->getSumSchemeByProject($uid)->count;
		$data['contents']= $user->user_content;
		$data['usertag_list']= $this->t_tag_take_model->gettaglistByUser($uid,'11',5);
		echojson(0,$data);
	}
	/**
	 *description:个人空间右侧用户信息
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function inforight(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$uid= isset($_POST['uid'])?$this->input->post('uid'):"";
		if($uid==""){
			echojson(1,"","无相关数据");
		}
		$this->load->model('t_user_model');
		$user= $this->t_user_model->get($uid);
		$this->config->load('url');
		$config = $this->config->item('url');
		//留言
		$this->load->model('t_user_space_msg_model');
		$res = $this->t_user_space_msg_model->getMsgByUser($uid,1,3);
		if($res!=false){
			foreach ($res as $key=>$val) {
				$data['msg_list'][$key]['user_id'] = $val->msg_send_uid;
				$data['msg_list'][$key]['userspace'] = $config['userspace'].$val->msg_send_uid;
				$data['msg_list'][$key]['user_pic'] = model("t_user_info")->avatar($val->msg_send_uid);
				$data['msg_list'][$key]['nikename'] =$val->msg_send_user_nick;
				$data['msg_list'][$key]['sub_time'] = $val->msg_send_time;
				$data['msg_list'][$key]['msg'] = $val->msg_content;
			}
		}else{
			$data['msg_list'] = "";	
		}
		//粉丝列表
		$this->load->model('t_user_follow_model');
		$arr=$this->t_user_follow_model->dis_fan($uid,1,4);
		if(is_array($arr['follow'])){
			foreach ($arr['follow'] as $key=>$val) {
				$data['fans_list'][$key]['user_pic'] = $val['user_pic'];
				$data['fans_list'][$key]['user_id'] = $val['user_id'];
				$data['fans_list'][$key]['nikename'] = $val['user_nickname'];
				$data['fans_list'][$key]['userspace'] = $val['userspace'];
			}
		}else{
			$data['fans_list']['0']['user_pic'] = "";
			$data['fans_list']['0']['user_id'] = "";
			$data['fans_list']['0']['nikename'] = "";
			$data['fans_list']['0']['userspace'] = "";
		}
		//关注列表	
		$arr=$this->t_user_follow_model->myfollows($uid,1,4);
		if(is_array($arr['follow'])){
			foreach ($arr['follow'] as $key=>$val) {
				$data['follow_list'][$key]['user_pic'] = $val['user_pic'];
				$data['follow_list'][$key]['user_id'] = $val['follow_uid'];
				$data['follow_list'][$key]['nikename'] = $val['user_nickname'];
				$data['follow_list'][$key]['userspace'] = $val['userspace'];
			}
		}else{
			$data['follow_list']['0']['user_pic'] = "";
			$data['follow_list']['0']['user_id'] = "";
			$data['follow_list']['0']['nikename'] = "";
			$data['follow_list']['0']['userspace'] = "";
		}
		//用户方案
		$this->load->model('t_project_room_model');
		$roomlist= $this->t_project_room_model->getRoomListByUserId($uid,1,8);
		foreach ($roomlist as $key=>$val) {
			$data['room_list'][$key]['room_pic'] = roomurl($val->room_id)."big_thumb.jpg";
			$data['room_list'][$key]['room_url'] = $config['roominfo'].$val->room_id; 
		}
		echojson(0,$data);
	}
	/**
	 *description:个人空间设计师最新设计案例
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function newchemer(){
		safeFilter();
		$this->config->load('url');
		$config = $this->config->item('url');
		$uid= isset($_POST['uid'])?$this->input->post('uid'):"";
		if($uid==""){
			echojson(0,"","无相关数据");
		}
		$this->load->model('t_project_scheme_model');
		$this->load->model('t_project_floor_model');
		$res = $this->t_project_scheme_model->schemeListByUser($uid,1,5);
		if($res==false){
			echojson(0,"","无相关数据");
		}
		foreach ($res as $key=>$val) {
			$data[$key]['scheme_name'] = $val->scheme_name;
			$room_id = $this->t_project_floor_model->getTheOneRoomByScheme($val->scheme_id);
			$data[$key]['scheme_pic'] =roomurl($room_id)."rectangle_thumb.jpg"; 
			$data[$key]['scheme_url'] = $config['schemeinfo'].$val->scheme_id;
		}
		echojson(0,$data);
	}
	/**
	 *description:获取用户最新灵感博文
	 *author:yanyalong
	 *date:2013/12/28
	 */
	public function newcontent(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$this->config->load('url');
		$config = $this->config->item('url');
		$uid= isset($_POST['uid'])?$this->input->post('uid'):"";
		$p= isset($_POST['p'])?$this->input->post('p'):"";
		if($uid==""){
			echojson(1,"","无相关数据");
		}
		$res = model("t_user")->contentListByUser($uid,$p,5);		
		if($res==false){
			echojson(1,"","无相关数据");
		}
		$contentlist = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$contentlist[$key]['cid'] = $val->content_id;	
			$contentlist[$key]['project_num']= $val->content_project;
			$contentlist[$key]['title'] = $val->content_title;	
			$contentlist[$key]['tags'] = model('t_tag')->taglist_url(11,$val->content_tag,5);
			$contentlist[$key]['likes'] = $val->content_likes;	
			$contentlist[$key]['disc'] = $val->content_disc;	
			$contentlist[$key]['uid'] = $val->user_id;	
			$userinfo = model("t_user")->get($val->user_id);
			$contentlist[$key]['nickname'] = ($userinfo->user_nickname!="")?$userinfo->user_nickname:$userinfo->user_email;
			$contentlist[$key]['userspace'] = $config['userspace'].$val->user_id;	
			$contentlist[$key]['pic'] = model("t_user_info")->avatar($val->user_id);
			$contentlist[$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->user_id);	
			$contentlist[$key]['sub_time'] = $val->content_subtime;	
			if($val->user_id!=$user_id){
				$contentlist[$key]['is_like'] = model('t_like_questions')->is_like($val->content_id,$user_id);	
				$contentlist[$key]['is_me'] = "0";
			}else{
				$contentlist[$key]['is_like'] = "0";
				$contentlist[$key]['is_me'] = "1";
			}
			$contentlist[$key]['url'] = $config['contenturl'].$val->content_id;
			$content = model("t_content")->content_analytic($val->content_content);
			$contentlist[$key]['pic_num'] = $content['pic_num'];
			$this->load->model('t_pic_pin_model');
			foreach ($content['pic_md5'] as $keys=>$vals) {
				$contentlist[$key]['pic_list'][$keys]['pic_url1'] = $vals['thumb_1'];
				$contentlist[$key]['pic_list'][$keys]['pic_url2'] = $vals['thumb_2'];
				$contentlist[$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
			}
		}
		echojson(0,$contentlist);
	}
	/**
	 *description:获取用户灵感集列表
	 *author:yanyalong
	 *date:2013/12/28
	 */
	public function album(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$this->config->load('url');
		$config = $this->config->item('url');
		$uid= isset($_POST['uid'])?$this->input->post('uid'):"";
		if($uid==""){
			echojson(1,"","无相关数据");
		}
		//获取灵感集列表			
		$this->load->model('t_album_model');
		$res = $this->t_album_model->contentAlbumListByUser($uid);		
		if($res==false){
			echojson(1,"","无相关数据");
		}
		$this->load->model('t_album_content_model');
		foreach ($res as $key=>$val) {
			$data[$key]['album_name'] = $val->album_name;	
			$data[$key]['album_id'] = $val->album_id;	
			$contentinfo = $this->t_album_content_model->getContentListByAlbumId($val->album_id,1,1);
			$content = model("t_content")->content_analytic($contentinfo['0']->content_content);
			$data[$key]['album_pic'] = $content['pic_md5']['0']['thumb_1'];
		}
		echojson(0,$data);
	}
	/**
	 *description:获取设计师案例列表
	 *author:yanyalong
	 *date:2013/12/28
	 */
	public function scheme(){
		safeFilter();
		$this->config->load('url');
		$config = $this->config->item('url');
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$uid= isset($_POST['uid'])?$this->input->post('uid'):"";
		$project_id= isset($_POST['pid'])?$_POST['pid']:"";
		$scheme_type= isset($_POST['scheme_type'])?$_POST['scheme_type']:"";
		if($uid==""){
			echojson(1,"","无相关数据");
		}
		$this->load->model('t_project_room_model');
		$this->load->model('t_project_scheme_tag_model');
		$list = model("t_project_scheme")->getSchemeListByDesigner($uid);		
		if($list==false){
			echojson(1,"","无相关数据");
		}
		$scheme = array();
		$this->config->load('uploads');		
		$upload_config= $this->config->item("room_3d");		
		foreach($list as $key=>$val){
			$scheme[$key]['scheme_id'] = $val->scheme_id;
			$scheme[$key]['scheme_name'] = $val->scheme_name;
			$scheme[$key]['scheme_views'] = $val->scheme_views;
			$scheme[$key]['project_name'] = $val->project_name;
			$scheme[$key]['scheme_url'] = $config['schemeinfo'].$val->scheme_id;
			$scheme[$key]['room_num'] = $val->scheme_rooms;
			$roomlist  =$this->t_project_room_model->getTheRoomListByTheme($val->scheme_id);
			$count = count($roomlist);
			if($count==0){
				$scheme[$key]['room_list'][0]= $upload_config['relative_path']."rectangle_thumb.jpg";	
			}elseif($count==1){
				$scheme[$key]['room_list'][0]= roomurl($roomlist[0]->room_id)."rectangle_thumb.jpg";	
			}else{
				foreach ($roomlist as $keys=>$vals) {
					if($keys<5){
						$scheme[$key]['room_list'][$keys]= roomurl($vals->room_id)."big_thumb.jpg";	
					}
				}
			}
			if(!isset($scheme[$key]['room_list'])){
				$scheme[$key]['room_list'][0]= $upload_config['relative_path']."rectangle_thumb.jpg";	
			}
			$scheme[$key]['schemetag_list']= $this->t_project_scheme_tag_model->tagListBySchemeId($val->scheme_id);
		}
		$data[0]['scheme_list'] = $scheme;
		echojson(0,$data);
	}
	/**
	 *description:普通用户项目方案
	 *author:yanyalong
	 *date:2013/12/28
	 */
	public function project(){
		safeFilter();
		$this->config->load('url');
		$config = $this->config->item('url');
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$uid= isset($_POST['uid'])?$this->input->post('uid'):"";
		$project_id = $this->input->post('pid',true);
		$scheme_type = $this->input->post('scheme_type',true);
		if($uid==""){
			echojson(1,"","无相关数据");
		}
		$this->load->model('t_project_room_model');
		$this->load->model('t_project_scheme_tag_model');
		$this->load->model('t_project_scheme_use_model');
		$this->load->model('t_user_info_model');
		$list = $this->t_project_scheme_use_model->getSchemeListByCommonUserId($uid);		
		$projectarr = array();
		foreach ($list as $key=>$val) {
			if(!in_array($val->project_id,$projectarr)){
				$projectarr[] = $val->project_id;
			}
		}
		if($list==false){
			echojson(1,"","无相关数据");
		}
		$this->config->load('uploads');		
		$upload_config= $this->config->item("room_3d");		
		$scheme = array();
		foreach ($projectarr as $key=>$val) {
			$i=0;
			foreach($list as $keys=>$vals){
				if($vals->project_id==$val){
					$scheme[$key]['project_name'] = $vals->project_name;
					$scheme[$key]['project_size'] = $vals->apartment_use_size;
					$scheme[$key]['project_type'] = $vals->apartment_category;
					$scheme[$key]['project_title'] = $vals->apartment_name.$vals->apartment_title;
					$scheme[$key]['project_budget'] = $vals->project_budget;
					$scheme[$key]['house_name'] = $vals->house_name;
					$scheme[$key]['scheme_list'][$keys]['scheme_name'] = $vals->scheme_name;
					$scheme[$key]['scheme_list'][$keys]['scheme_views'] = $vals->scheme_views;
					$scheme[$key]['scheme_list'][$keys]['scheme_url'] = $config['schemeinfo'].$vals->scheme_id;
					$scheme[$key]['scheme_list'][$keys]['user_pic'] = $this->t_user_info_model->avatar($vals->user_id);
					$scheme[$key]['scheme_list'][$keys]['user_id'] = $vals->user_id;
					$scheme[$key]['scheme_list'][$keys]['designer'] = $vals->user_nickname;
					$scheme[$key]['scheme_list'][$keys]['company'] = $vals->user_company;
					$scheme[$key]['scheme_list'][$keys]['userspace'] = $config['userspace'].$vals->user_id;
					if($user_id==""){
						$scheme[$key]['scheme_list'][$keys]['is_follow'] = "0";		
					}else{
						$scheme[$key]['scheme_list'][$keys]['is_follow'] = model('t_user_follow')->is_follow($user_id,$vals->user_id);	
					}
					$scheme[$key]['scheme_list'][$keys]['is_me'] = ($vals->user_id==$user_id)?"1":"0";
					$scheme[$key]['scheme_list'][$keys]['send_message'] = $config['sendmsg'];
					$scheme[$key]['scheme_list'][$keys]['room_num'] =$vals->scheme_rooms;
					$roomlist  =$this->t_project_room_model->getTheRoomListByTheme($vals->scheme_id);
					$count = count($roomlist);
					if($count==0){
						$scheme[$key]['scheme_list'][$i]['room_list'][0]= $upload_config['relative_path']."rectangle_thumb.jpg";	
					}elseif($count==1){
						$scheme[$key]['scheme_list'][$i]['room_list'][0]= roomurl($roomlist[0]->room_id)."rectangle_thumb.jpg";	
					}else{
						foreach ($roomlist as $keyss=>$valss) {
							if($keys<5){
								$scheme[$key]['scheme_list'][$i]['room_list'][$keyss]= roomurl($valss->room_id)."big_thumb.jpg";	
							}
						}
					}
					if(!isset($scheme[$key]['scheme_list'][$i]['room_list'])){
						$scheme[$key]['scheme_list'][$i]['room_list'][0]= $upload_config['relative_path']."rectangle_thumb.jpg";	
					}
					$scheme[$key]['scheme_list'][$keys]['schemetag_list'] = $this->t_project_scheme_tag_model->tagListBySchemeId($vals->scheme_id);
				}
				$i++;
			}
		}
		echojson(0,$scheme);
	}
	/**
	 *description:收藏产品列表
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function likeproduct(){
		safeFilter();
		$this->config->load('url');
		$config = $this->config->item('url');
		$uid= isset($_POST['uid'])?$this->input->post('uid'):"";
		if($uid==""){
			echojson(1,"","无相关数据");
		}
		$this->load->model('t_certified_product_model');
		$res = $this->t_certified_product_model->getProductListByLike($uid);
		if($res==false){
			echojson(1,"","无相关数据");
		}
		$this->config->load('uploads');		
		$upload_config = $this->config->item("product");		
		$data = array();
		foreach ($res as $key=>$val) {
			$data[$key]['product_name'] = $val->product_name;
			$data[$key]['product_brand'] = $val->brand_name;
			if($val->product_resultpic!=""){
				foreach (explode('|',$val->product_resultpic) as $keys=>$vals) {
					$data[$key]['product_pic'] = $upload_config['relative_path'].'thumb_2/'.$vals;				
				}
			}else{
				$data[$key]['product_pic'] = $upload_config['default_1'];
			}
			$data[$key]['product_url'] = $config['productinfo'].$val->product_id;
			$data[$key]['product_size'] =$val->product_long."*".$val->product_width."*".$val->product_high;
			$tagarr = explode(',',$val->product_key_word);
			//$tagarr =model("t_project_room_tag")->getTagByRoom($val->room_id); 
			foreach ($tagarr as $keys=>$vals) {
				$data[$key]['tag_list'][$keys]['tag_name']= $vals; 
				$data[$key]['tag_list'][$keys]['tag_url']= "#"; 
			}
		}
		echojson(0,$data);
	}
	/**
	 *description:设计师产品推荐
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function product(){
		safeFilter();
		$this->config->load('url');
		$config = $this->config->item('url');
		$uid= isset($_POST['uid'])?$this->input->post('uid'):"";
		if($uid==""){
			echojson(1,"","无相关数据");
		}
		$this->config->load('uploads');		
		$upload_config = $this->config->item("product");		
		$this->load->model('t_project_room_bill_item_model');
		$res = $this->t_project_room_bill_item_model->getProductListByDesignRoomList($uid);
		if($res==false){
			echojson(1,"","无相关数据");
		}
		$data = array();
		foreach ($res as $key=>$val) {
			$data[$key]['product_name'] = $val->product_name;
			$data[$key]['product_brand'] = $val->brand_name;
			if($val->product_resultpic!=""){
				foreach (explode('|',$val->product_resultpic) as $keys=>$vals) {
					$data[$key]['product_pic'] = $upload_config['relative_path'].'thumb_2/'.$vals;				
				}
			}else{
				$data[$key]['product_pic'] = $upload_config['default_1'];
			}
			$data[$key]['product_url'] = $config['productinfo'].$val->product_id;
			$data[$key]['product_size'] =$val->product_long."*".$val->product_width."*".$val->product_high;
			$tagarr = explode(',',$val->product_key_word);
			//$tagarr =model("t_project_room_tag")->getTagByRoom($val->room_id); 
			foreach ($tagarr as $keys=>$vals) {
				$data[$key]['tag_list'][$keys]['tag_name']= $vals; 
				$data[$key]['tag_list'][$keys]['tag_url']= "#"; 
			}
		}
		echojson(0,$data);
	}
}
