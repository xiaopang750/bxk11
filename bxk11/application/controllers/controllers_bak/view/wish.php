<?php
/**
 *description:发现好灵感
 *author:yanyalong
 *date:2013/11/15
 */
class wish extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:发现好灵感(灵感博文)
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function design(){

		safeFilter();
		$keyword= isset($_POST['wd'])?$this->input->post('wd'):"";
		$order= isset($_POST['order'])?$this->input->post('order'):"new";
		$tag= isset($_POST['tag'])?$this->input->post('tag'):"";
		$p= isset($_POST['p'])?$this->input->post('p'):"";
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$row = 5;
		$res = model("t_content_tag")->wish_content($tag,1,$keyword,$order,$p,$row);
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
			$contentlist[$key]['sub_time'] = $val->content_subtime;	
			$contentlist[$key]['tags'] = model('t_tag')->taglist_url(11,$val->content_tag,5);
			$contentlist[$key]['likes'] = $val->content_likes;	
			$contentlist[$key]['status'] =($val->content_status==3)?"精选":"";
			$contentlist[$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->user_id);	
			$contentlist[$key]['is_like'] = model('t_user_like')->is_like($val->content_id,$user_id);	
			$contentlist[$key]['is_me']= ($user_id==$val->user_id)?"1":"0";
			$contentlist[$key]['url'] = $config['contenturl'].$val->content_id;
			$contentlist[$key]['userspace'] = $config['userspace'].$val->user_id;
			$contentlist[$key]['nickname'] = $val->user_nickname;
			$contentlist[$key]['uid'] = $val->user_id;
			$contentlist[$key]['pic']= model("t_user_info")->avatar($val->user_id);
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
	 *description:发现好灵感(家居美图)
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function product(){
		safeFilter();
		$keyword= isset($_POST['wd'])?$this->input->post('wd'):"";
		$order= isset($_POST['order'])?$this->input->post('order'):"new";
		$tag= isset($_POST['tag'])?$this->input->post('tag'):"";
		$p= isset($_POST['p'])?$this->input->post('p'):"";
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";

		$row = 5;
		$res = model("t_content_tag")->wish_content($tag,2,$keyword,$order,$p,$row);
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
			$contentlist[$key]['sub_time'] = $val->content_subtime;	
			$contentlist[$key]['tags'] = model('t_tag')->taglist_url(11,$val->content_tag,5);
			$contentlist[$key]['likes'] = $val->content_likes;	
			$contentlist[$key]['status'] =($val->content_status==3)?"精选":"";
			$contentlist[$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->user_id);	
			$contentlist[$key]['is_like'] = model('t_user_like')->is_like($val->content_id,$user_id);	
			$contentlist[$key]['is_me']= ($user_id==$val->user_id)?"1":"0";
			$contentlist[$key]['url'] = $config['producturl'].$val->content_id;
			$contentlist[$key]['userspace'] = $config['userspace'].$val->user_id;
			$contentlist[$key]['nickname'] = $val->user_nickname;
			$contentlist[$key]['uid'] = $val->user_id;
			$contentlist[$key]['pic']= model("t_user_info")->avatar($val->user_id);
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
	 *description:发现好灵感(装修问题)
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function question(){
		safeFilter();
		$keyword= isset($_POST['wd'])?$this->input->post('wd'):"";
		$p= isset($_POST['p'])?$this->input->post('p'):"";
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$order = isset($_POST['order'])?$_POST['order']:"new";
		$class_id = isset($_POST['class_id'])?$this->input->post('class_id'):""; 
		$class_pid= isset($_POST['class_pid'])?$this->input->post('class_pid'):""; 
		$row = 5;
		$res = model("t_questions")->wish_question($class_id,$class_pid,$keyword,$order,$p,$row);
		if(empty($res)){
			echojson(1,'',"无更多数据");
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$contentlist[$key]['id'] = $val->question_id;	
			$contentlist[$key]['title'] = $val->question_title;
			$contentlist[$key]['class_pname'] = $val->class_pname;
			$contentlist[$key]['class_name'] = $val->class_name;
			$contentlist[$key]['likes'] = $val->question_likes;	
			$contentlist[$key]['shares'] = $val->question_share;	
			$contentlist[$key]['url'] = $config['questionurl'].$val->question_id;
			$contentlist[$key]['userspace'] = $config['userspace'].$val->user_id;
			$contentlist[$key]['answers'] = $val->question_answers;
			$contentlist[$key]['sub_time'] = $val->question_subtime;
			$contentlist[$key]['project_num']= $val->question_project;
			$contentlist[$key]['status']= ($val->question_status=="3")?"精选":"";
			$contentlist[$key]['pic'] = model('t_user_info')->avatar($val->user_id);
			$content = model("t_questions")->content_analytic($val->question_content);
			if(is_array($content['pic_md5'])){
				foreach ($content['pic_md5'] as $keys=>$vals) {
					$contentlist[$key]['content'] = $content['question_content'];
					$contentlist[$key]['pic_list'][$keys]['pic_url'] = $vals['thumb_1'];
					$contentlist[$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
				}
			}
		if($user_id==""){
			$contentlist[$key]['is_like'] = "0";		
		}else{
			$contentlist[$key]['is_like'] = model('t_like_questions')->is_like($val->question_id,$user_id);	
		}
			$userinfo = model("t_user")->get($val->user_id);
			$contentlist[$key]['nick_name'] = ($userinfo->user_nickname!="")?$userinfo->user_nickname:$userinfo->user_email;
			$contentlist[$key]['uid'] = $val->user_id;
			$contentlist[$key]['pic'] = model('t_user_info')->avatar($val->user_id);
			$contentlist[$key]['userspace'] = $config['userspace'].$val->user_id;
		}
		echojson(0,$contentlist);
	}
	/**
	 *description:一起畅想选项数据
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function source(){
		safeFilter();
		$type = $this->input->post('type',true);
		$order = array("new"=>"最新","hot"=>"精选","likes"=>"喜欢数","project"=>"加入项目灵感数");
		switch ($type) {
		case 'design':
			loadLib("System_Class_Tag");
			$System_Class_Tag = new System_Class_Tag();	
			$System_Class_Tag->s_class_type = 11;
			$design= $System_Class_Tag->getTagBySystemClass();
			$designlist['order'] = $order;
			$designlist['list'] = $design;
			if($designlist!=false){
				echojson(0,$designlist);
			}else{
				echojson(1,"","无相关数据");
			}
			break;
		case 'product':
			loadLib("System_Class_Tag");
			$System_Class_Tag = new System_Class_Tag();
			$System_Class_Tag->s_class_type = 12;
			$product = $System_Class_Tag->getTagBySystemClass();
			$productlist['order'] = $order;
			$productlist['list'] = $product;
			if($productlist!=false){
				echojson(0,$productlist);
			}else{
				echojson(1,'',"无相关数据");
			}
			break;
		case 'question':
			$this->load->model('t_question_class_model');
			$this->t_question_class_model->class_pid = 0;
			$res = $this->t_question_class_model->get_where('class_pid');
			$questionlist['order'] = $order;
			if($res!=false){
				$question = array();
				foreach ($res as $key=>$val) {
					$question[$key]['class_name'] = $val->class_name;
					$question[$key]['class_id'] = $val->class_id;
				}
			$questionlist['list'] = $question;
				echojson(0,$questionlist);
			}else{
				echojson(1,'',"无相关数据");
			}
			break;
		}
	}
	/**
	 *description:美图达人
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function designmaster(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$row = 20;
		$res = model("t_content")->contentmaster(1,$row);	
		if(empty($res)){
			echojson(1,'',"无相关数据");
		}
		$list = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$usersublist = model("t_tag_take")->find_sublist($val->user_id,3); 
			$list[$key]['tags'] = ($usersublist!=false)?$usersublist:'';
			$list[$key]['pic'] = model('t_user_info')->avatar($val->user_id);
			$list[$key]['userspace'] = $config['userspace'].$val->user_id;
			$list[$key]['user_id'] = $val->user_id;
			$list[$key]['user_nickname'] = $val->user_nickname;
			if($user_id==""){
				$list[$key]['is_follow'] = "0";		
			}else{
				$list[$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->user_id);	
			}
			$list[$key]['is_me'] = ($user_id==$val->user_id)?"1":"0";
		}
		echojson(0,$list);
	}
	/**
	 *description:产品达人
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function productmaster(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$row = 20;
		$res = model("t_content")->contentmaster(2,$row);	
		if(empty($res)){
			echojson(1,'',"无相关数据");
		}
		$list = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$usersublist = model("t_tag_take")->find_sublist($val->user_id,3); 
			$list[$key]['tags'] = ($usersublist!=false)?$usersublist:'';
			$list[$key]['pic'] = model('t_user_info')->avatar($val->user_id);
			$list[$key]['userspace'] = $config['userspace'].$val->user_id;
			$list[$key]['user_id'] = $val->user_id;
			$list[$key]['user_nickname'] = $val->user_nickname;
			if($user_id==""){
				$list[$key]['is_follow'] = "0";		
			}else{
				$list[$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->user_id);	
			}
			$list[$key]['is_me'] = ($user_id==$val->user_id)?"1":"0";
		}
		echojson(0,$list);
	}
	/**
	 *description:问题达人
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function questionmaster(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$row = 20;
		$res = model("t_questions")->questionmaster($row);	
		if(empty($res)){
			echojson(1,'',"无相关数据");
		}
		$list = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$usersublist = model("t_tag_take")->find_sublist($val->user_id,3); 
			$list[$key]['tags'] = ($usersublist!=false)?$usersublist:'';
			$list[$key]['pic'] = model('t_user_info')->avatar($val->user_id);
			$list[$key]['userspace'] = $config['userspace'].$val->user_id;
			$list[$key]['user_id'] = $val->user_id;
			$list[$key]['user_nickname'] = $val->user_nickname;
			if($user_id==""){
				$list[$key]['is_follow'] = "0";		
			}else{
				$list[$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->user_id);	
			}
			$list[$key]['is_me'] = ($user_id==$val->user_id)?"1":"0";
		}
		echojson(0,$list);
	}
	/**
	 *description:探索页数据
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function explore_design(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$p = $this->input->post('p',true);
		$row = 5;
		$this->config->load('url');
		$config = $this->config->item('url');
		//灵感博文
		$design = model("t_content")->explore(1,$p,$row);
		if($design==false){
			echojson(1,"","无相关数据");
		}
		$contentlist = array();
		foreach ($design as $key=>$val) {
			$userinfo = model("t_user")->get($val->user_id);
			$contentlist[$key]['title'] = $val->content_title;	
			$contentlist[$key]['sub_time'] = $val->content_subtime;	
			$contentlist[$key]['tags'] = model('t_tag')->taglist_url(11,$val->content_tag,5);
			$contentlist[$key]['likes'] = $val->content_likes;	
			$contentlist[$key]['discs'] = $val->content_disc;	
			if($user_id==""){
			$contentlist[$key]['is_like'] = "0";
			}
			$contentlist[$key]['is_like'] = model('t_user_like')->is_like($val->content_id,$user_id);	
			$contentlist[$key]['url'] = $config['contenturl'].$val->content_id;
			$contentlist[$key]['views'] = $val->content_views;
			$contentlist[$key]['cid'] = $val->content_id;
			$contentlist[$key]['userspace'] = $config['userspace'].$val->user_id;
			$contentlist[$key]['nickname'] = $userinfo->user_nickname;
			$contentlist[$key]['pic']= model("t_user_info")->avatar($val->user_id);
			$content = model("t_content")->content_analytic($val->content_content);
			$contentlist[$key]['pic_url'] = $content['pic_md5'][0]['thumb_1'];
			$contentlist[$key]['pic_content'] = $content['pic_md5'][0]['pic_content'];
		}
		echojson(0,$contentlist);
	}

	/**
	 *description:探索家居美图数据
	 *author:yanyalong
	 *date:2013/11/18
	 */
	public function explore_product(){
		safeFilter();
		$this->config->load('url');
		$config = $this->config->item('url');
		$p = $this->input->post('p',true);
		$product = model("t_content")->explore(2,$p,1);		
		if($product==false){
			echojson(1,"","无相关数据");
		}
		$productlist = array();
		foreach ($product['list'] as $key=>$val) {
			$productlist['count'] = $product['count'];
			$productlist['list'][$key]['url'] = $config['producturl'].$val->content_id;
			$content= model("t_content")->content_analytic($val->content_content);
			$productlist['list'][$key]['pic_url'] = $content['pic_md5'][0]['thumb_1'];
			$this->load->model('t_pic_pin_model');
			$this->t_pic_pin_model->pic_id= $content['pic_md5'][0]['pic_id'];
			$pin = $this->t_pic_pin_model->getbypic(); 
			foreach ($pin as $keyss=>$valss) {
				$productlist['list'][$key]['pin_list'][$keyss]['pic_width']= $valss->pic_width;
				$productlist['list'][$key]['pin_list'][$keyss]['class_name']= $valss->pin_product_class_name;				
				$productlist['list'][$key]['pin_list'][$keyss]['class_id']= $valss->pin_product_class_id;
				$product_class = model("t_product_class")->get($valss->pin_product_class_id);
				$productlist['list'][$key]['pin_list'][$keyss]['class_pid']= $product_class->p_class_pid;
				$product_pclass = model("t_product_class")->get($product_class->p_class_pid);
				$productlist['list'][$key]['pin_list'][$keyss]['class_pname']= $product_pclass->p_class_name;
				$productlist['list'][$key]['pin_list'][$keyss]['pin_img']= $valss->pin_img;
				$productlist['list'][$key]['pin_list'][$keyss]['product_url']= $valss->pin_product_url;
				$productlist['list'][$key]['pin_list'][$keyss]['product_id']= $valss->pin_product_id;
				$productlist['list'][$key]['pin_list'][$keyss]['pin_left']= $valss->pin_left;
				$productlist['list'][$key]['pin_list'][$keyss]['pin_top']= $valss->pin_top;
				$productlist['list'][$key]['pin_list'][$keyss]['pin_content']= $valss->pin_content;
				$productlist['list'][$key]['pin_list'][$keyss]['pin_id']= $valss->pin_id;
				$productlist['list'][$key]['pin_list'][$keyss]['pin_title']= $valss->pin_product_name;
			}
		}
		echojson(0,$productlist);
	}
	/**
	 *description:探索装修问题数据
	 *author:yanyalong
	 *date:2013/11/18
	 */
	public function explore_question(){
		safeFilter();
		$p = $this->input->post('p',true);
		$this->config->load('url');
		$config = $this->config->item('url');
		//装修问题
		$questionlist = array();
		$question = model("t_questions")->explore($p,8);		
		if($question==false){
			echojson(1,"","无相关数据");
		}
		foreach ($question['list'] as $key=>$val) {
			$questionlist['count'] = $question['count'];
			$questionlist['list'][$key]['url'] = $config['questionurl'].$val->question_id;
			$questionlist['list'][$key]['title'] = $val->question_title;
			$questionlist['list'][$key]['class_pname'] = $val->class_pname;
			$questionlist['list'][$key]['class_name'] = $val->class_name;
			$questionlist['list'][$key]['answers'] = $val->question_answers;
			$questionlist['list'][$key]['sub_time'] = $val->question_subtime;
			$questionlist['list'][$key]['pic'] = model("t_user_info")->avatar($val->user_id);
			$questionlist['list'][$key]['status']= ($val->question_status=="3")?"精选":"";
			$questionlist['list'][$key]['userspace'] = $config['userspace'].$val->user_id;
			$userinfo = model("t_user")->get($val->user_id);
			$questionlist['list'][$key]['nickname'] = ($userinfo->user_nickname!="")?$userinfo->user_nickname:$userinfo->user_email;
		}
		echojson(0,$questionlist);
	}

	/**
	 *description:探索明星用户推荐数据
	 *author:yanyalong
	 *date:2013/11/18
	 */

	public function explore_user(){
		safeFilter();
		$this->config->load('url');
		$config = $this->config->item('url');
		$p = $this->input->post('p',true);
		$row = 45;
		$user_list = array();
		//家装达人
		$user= model("t_user")->explore($p,$row);		
		if($user['list']==false){
			echojson(1,"","无相关数据");
		}
		foreach ($user['list'] as $key=>$val) {
			$user_list['count'] = $user['count'];
			$user_list['list'][$key]['userspace'] = $config['userspace'].$val->user_id;
			$user_list['list'][$key]['nickname'] = $val->user_nickname;
			$user_list['list'][$key]['id'] = $val->user_id;
			$user_list['list'][$key]['content_num'] = $val->user_content+$val->user_questions;
			$user_list['list'][$key]['pic'] = model("t_user_info")->avatar($val->user_id);
		}
		echojson(0,$user_list);
	}
	
}
