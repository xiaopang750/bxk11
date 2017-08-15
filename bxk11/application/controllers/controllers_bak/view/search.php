<?php

/**
 *description:搜索
 *author:yanyalong
 *date:2013/11/07
 */
class search extends User_Controller {
	function __construct(){
		parent::__construct();
	}
	/**
	 *description:顶部搜索框数据
	 *author:yanyalong
	 *date:2013/11/13
	 */
	public function topsearch(){
		$keyword= $this->input->post('wd',true);
		$this->config->load('url');
		$config = $this->config->item('url');
		$flag = 0;
		if($keyword==""){
			$keyword = model("t_user_search")->hot_keyword();
			foreach ($keyword as $key=>$val) {
				$list[$key]['search_url'] = $config['top_search'].$val->search_content."&type=all";
				$list[$key]['keyword'] = $val->search_content;
			}
			echojson(0,$list);	
		}else{
			$this->config->load('url');
			$config = $this->config->item('url');
			//用户
			$user = model("t_user")->user_search($keyword,1,2);
			if($user!=""){
				foreach ($user['user_list'] as $key=>$val) {
					$user_list['user_list'][$key]['url'] = $config['userspace'].$val['user_id'];
					$user_list['user_list'][$key]['name'] = $val['user_nickname'];
				}
			$user_list['search_url'] = $config['top_search'].$keyword."&type=user";
			$user_list['num'] = $user['num'];
			}else{
				$flag++;

			$user_list['search_url'] = "";
			$user_list['user_list'] = array() ;
			$user_list['num'] = "";
			}
			$search['user'] = $user_list;
			//灵感博文
			$design = model("t_content")->content_search($keyword,1,1,2);
			if($design!=""){
				foreach ($design['list'] as $key=>$val) {
					$designlist['design_list'][$key]['url'] = $config['contenturl'].$val->content_id;
					$designlist['design_list'][$key]['name'] = $val->content_title;
				}
				$designlist['search_url'] = $config['top_search'].$keyword."&type=design";
				$designlist['num'] = $design['num'];
			}else{
				$flag++;
				$designlist['search_url'] = "";
				$designlist['num'] = "";
				$designlist['design_list'] = array();
			}
			$search['design'] = $designlist;
			//家居美图
			$product= model("t_content")->content_search($keyword,2,1,2);
			if($product!=""){
				foreach ($product['list'] as $key=>$val) {
					$productlist['product_list'][$key]['url'] = $config['contenturl'].$val->content_id;
					$productlist['product_list'][$key]['name'] = $val->content_title;
				}
				$productlist['search_url'] = $config['top_search'].$keyword."&type=product";
				$productlist['num'] = $product['num'];
			}else{
				$flag++;
				$productlist['search_url'] = "";
				$productlist['num'] = "";
				$productlist['product_list'] = array();
			}
			$search['product'] = $productlist;
			//装修问题
			$question = model("t_questions")->question_search($keyword,1,2);
			if($question!=""){
				foreach ($question['list'] as $key=>$val) {
					$questionlist['question_list'][$key]['url'] = $config['questionurl'].$val->question_id;
					$questionlist['question_list'][$key]['name'] = $val->question_title;
				}
				$questionlist['search_url'] = $config['top_search'].$keyword."&type=question";
				$questionlist['num'] = $question['num'];
			}else{
				$flag++;
				$questionlist['search_url'] = "";
				$questionlist['num'] = "";
				$questionlist['question_list'] = array();
			}
			$search['question'] = $questionlist;
		}
		if($flag==4){
		echojson(1,"","无相关数据");
		}
		echojson(0,$search);
	}
	/**
	 *description:顶部综合搜索结果页数据
	 *author:yanyalong
	 *date:2013/11/13
	 */
	public function index(){

		$keyword= isset($_POST['wd'])?$this->input->post('wd'):"";
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$type = $this->input->post('type',true);
		$p = $this->input->post('p',true);
		$this->config->load('url');
		$config = $this->config->item('url');
		switch ($type) {
		case 'design':
			$flag=0;
			//灵感博文
			$design = model("t_content")->content_search($keyword,1,$p,5);
			if(!empty($design['list'])){
				foreach ($design['list'] as $key=>$val) {
					$designlist['design_list'][$key]['title'] = $val->content_title;
					$designlist['design_list'][$key]['id'] = $val->content_id;	
					$designlist['design_list'][$key]['project_num']= $val->content_project;
					$designlist['design_list'][$key]['title'] = $val->content_title;	
					$designlist['design_list'][$key]['tags'] = model('t_tag')->taglist_url($val->content_tag,5);
					$designlist['design_list'][$key]['likes'] = $val->content_likes;	
					if($user_id==""){
						$designlist['design_list'][$key]['is_follow'] = "0";
						$designlist['design_list'][$key]['is_like'] = "0";
						$designlist['design_list'][$key]['is_me']= "0";
					}else{
						$designlist['design_list'][$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->user_id);	
						$designlist['design_list'][$key]['is_like'] = model('t_user_like')->is_like($val->content_id,$user_id);	
						$designlist['design_list'][$key]['is_me']= ($user_id==$val->user_id)?"1":"0";
					}
					$designlist['design_list'][$key]['url'] = $config['contenturl'].$val->content_id;
					$designlist['design_list'][$key]['userspace'] = $config['userspace'].$val->user_id;
					$designlist['design_list'][$key]['pic'] = model("t_user_info")->avatar($val->user_id);
					$userinfo = model("t_user")->get($val->user_id);
					$designlist['design_list'][$key]['nickname'] = ($userinfo->user_nickname!="")?$userinfo->user_nickname:$userinfo->user_email;
					$designlist['design_list'][$key]['uid'] = $val->user_id;
					$designlist['design_list'][$key]['sub_time'] = $val->content_subtime;
					$content = model("t_content")->content_analytic($val->content_content);
					$designlist['design_list'][$key]['pic_num'] = $content['pic_num'];
					foreach ($content['pic_md5'] as $keys=>$vals) {
						$designlist['design_list'][$key]['pic_list'][$keys]['pic_url1'] = $vals['thumb_1'];
						$designlist['design_list'][$key]['pic_list'][$keys]['pic_url2'] = $vals['thumb_2'];
						$designlist['design_list'][$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
					}
				}
				$designlist['search_url'] = $config['top_search'].$keyword."&type=design";
				$designlist['num'] = $design['num'];
			}else{
				$flag++;
				$designlist['search_url'] = "";
				$designlist['num'] = "";
				$designlist['design_list'] = array();
			}
			if($flag==1){
			echojson(1,"","无相关数据");
			}else{
			echojson(0,$designlist);
			}
			break;
		case 'product':
			//家居美图
			$flag=0;
			$product= model("t_content")->content_search($keyword,2,$p,5);
			if(!empty($product['list'])){
				foreach ($product['list'] as $key=>$val) {
					$productlist['product_list'][$key]['title'] = $val->content_title;
					$productlist['product_list'][$key]['id'] = $val->content_id;	
					$productlist['product_list'][$key]['project_num']= $val->content_project;
					$productlist['product_list'][$key]['title'] = $val->content_title;	
					$productlist['product_list'][$key]['tags'] = model('t_tag')->taglist_url($val->content_tag,5);
					$productlist['product_list'][$key]['likes'] = $val->content_likes;	
					if($user_id==""){
						$productlist['product_list'][$key]['is_follow'] = "0";
						$productlist['product_list'][$key]['is_like'] = "0";
						$productlist['product_list'][$key]['is_me']= "0";
					}else{
						$productlist['product_list'][$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->user_id);	
						$productlist['product_list'][$key]['is_like'] = model('t_user_like')->is_like($val->content_id,$user_id);	
						$productlist['product_list'][$key]['is_me']= ($user_id==$val->user_id)?"1":"0";

					}
					$productlist['product_list'][$key]['url'] = $config['contenturl'].$val->content_id;
					$productlist['product_list'][$key]['userspace'] = $config['userspace'].$val->user_id;
					$productlist['product_list'][$key]['pic'] = model("t_user_info")->avatar($val->user_id);
					$userinfo = model("t_user")->get($val->user_id);
					$productlist['product_list'][$key]['nickname'] = ($userinfo->user_nickname!="")?$userinfo->user_nickname:$userinfo->user_email;
					$productlist['product_list'][$key]['uid'] = $val->user_id;
					$productlist['product_list'][$key]['sub_time'] = $val->content_subtime;
					$content = model("t_content")->content_analytic($val->content_content);
					$productlist['product_list'][$key]['pic_num'] = $content['pic_num'];
					$this->load->model('t_pic_pin_model');
					foreach ($content['pic_md5'] as $keys=>$vals) {
						$productlist['product_list'][$key]['pic_list'][$keys]['pic_url1'] = $vals['thumb_1'];
						$productlist['product_list'][$key]['pic_list'][$keys]['pic_url2'] = $vals['thumb_2'];
						$productlist['product_list'][$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
						$this->t_pic_pin_model->pic_id= $vals['pic_id'];
						$pin = $this->t_pic_pin_model->getbypic(); 
						foreach ($pin as $keyss=>$valss) {
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['pic_width']= $valss->pic_width;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['class_name']= $valss->pin_product_class_name;				
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['class_id']= $valss->pin_product_class_id;
							$product_class = model("t_product_class")->get($valss->pin_product_class_id);
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['class_pid']= $product_class->p_class_pid;
							$product_pclass = model("t_product_class")->get($product_class->p_class_pid);
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['class_pname']= $product_pclass->p_class_name;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_img']= $valss->pin_img;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['product_url']= $valss->pin_product_url;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['product_id']= $valss->pin_product_id;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_left']= $valss->pin_left;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_top']= $valss->pin_top;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_content']= $valss->pin_content;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_id']= $valss->pin_id;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_title']= $valss->pin_product_name;
						}
					}
				}
				$productlist['search_url'] = $config['top_search'].$keyword."&type=product";
				$productlist['num'] = $product['num'];
			}else{
				$flag++;
				$productlist['search_url'] = "";
				$productlist['num'] = "";
				$productlist['product_list'] = array();
			}
			if($flag==1){
			echojson(1,"","无相关数据");
			}else{
			echojson(0,$productlist);
			}
			break;
		case 'question':
			$flag=0;
			$question = model("t_questions")->question_search($keyword,$p,20);
			if(!empty($question['list'])){
				foreach ($question['list'] as $key=>$val) {
					$questionlist['question_list'][$key]['id'] = $val->question_id;
					$questionlist['question_list'][$key]['url'] = $config['questionurl'].$val->question_id;
					$questionlist['question_list'][$key]['title'] = $val->question_title;
					$questionlist['question_list'][$key]['id'] = $val->question_id;	
					$questionlist['question_list'][$key]['title'] = $val->question_title;
					$questionlist['question_list'][$key]['class_pname'] = $val->class_pname;
					$questionlist['question_list'][$key]['class_name'] = $val->class_name;
					$questionlist['question_list'][$key]['likes'] = $val->question_likes;	
					$questionlist['question_list'][$key]['shares'] = $val->question_share;	
					$questionlist['question_list'][$key]['url'] = $config['questionurl'].$val->question_id;
					$questionlist['question_list'][$key]['answers'] = $val->question_answers;
					$questionlist['question_list'][$key]['sub_time'] = $val->question_subtime;
					$questionlist['question_list'][$key]['project_num']= $val->question_project;
					$questionlist['question_list'][$key]['user_pic'] = model("t_user_info")->avatar($val->user_id);
					$questionlist['question_list'][$key]['status']= ($val->question_status=="3")?"精选":"";
					if($user_id==""){
						$questionlist['question_list'][$key]['is_like'] = "0";
					}else{
						$questionlist['question_list'][$key]['is_like'] = model('t_like_questions')->is_like($val->question_id,$user_id);	
					}
					$content = model("t_questions")->content_analytic($val->question_content);
					$questionlist['question_list'][$key]['pic_num'] = $content['pic_num'];
					if(is_array($content['pic_md5'])){
						foreach ($content['pic_md5'] as $keys=>$vals) {
							$questionlist['question_list'][$key]['content'] = $content['question_content'];
							$questionlist['question_list'][$key]['pic_list'][$keys]['pic_url'] = $vals['thumb_1'];
							$questionlist['question_list'][$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
						}
					}
				}
				$questionlist['search_url'] = $config['top_search'].$keyword."&type=question";
				$questionlist['num'] = $question['num'];
			}else{
				$flag++;
				$questionlist['search_url'] = "";
				$questionlist['num'] = "";
				$questionlist['question_list'] = array();
			}
			if($flag==1){
			echojson(1,"","无相关数据");
			}else{
			echojson(0,$questionlist);
			}
			break;
		case 'user':
			//用户
			$flag = 0;
			$user = model("t_user")->user_search($keyword,$p,20);
			if(!empty($user['user_list'])){
				foreach ($user['user_list'] as $key=>$val) {
					$user_list['user_list'][$key]['userspace'] = $config['userspace'].$val['user_id'];
					$user_list['user_list'][$key]['nickname'] = $val['user_nickname'];
					$user_list['user_list'][$key]['id'] = $val['user_id'];
					$user_list['user_list'][$key]['pic'] = model("t_user_info")->avatar($val['user_id']);
					$usersublist = model("t_tag_take")->find_sublist($val['user_id']); 
					$user_list['user_list'][$key]['tags'] = ($usersublist!=false)?$usersublist:'';
					if($user_id==""){
						$user_list['user_list'][$key]['is_me'] = "0";
						$user_list['user_list'][$key]['is_follow'] = "0";
					}else{
						$user_list['user_list'][$key]['is_me'] = ($user_id==$val['user_id'])?"1":"0";
						$user_list['user_list'][$key]['is_follow'] =  model('t_user_follow')->is_follow($user_id,$val['user_id']);
					}
				}
			$user_list['search_url'] = $config['top_search'].$keyword."&type=user";
			$user_list['num'] = $user['num'];
			}else{
			$user_list['search_url'] = "";
			$user_list['user_list'] = array() ;
			$user_list['num'] = "";
			$flag++;
			}
			if($flag==1){
			echojson(1,"","无相关数据");
			}else{
			echojson(0,$user_list);
			}
			break;
		case 'all':
			//全部
			$flag = 0;
			$user = model("t_user")->user_search($keyword,1,6);
			if($user!=""){
				foreach ($user['user_list'] as $key=>$val) {
					$user_list['user_list'][$key]['userspace'] = $config['userspace'].$val['user_id'];
					$user_list['user_list'][$key]['nickname'] = $val['user_nickname'];
					$user_list['user_list'][$key]['id'] = $val['user_id'];
					$user_list['user_list'][$key]['pic'] = model("t_user_info")->avatar($val['user_id']);
					$usersublist = model("t_tag_take")->find_sublist($val['user_id']); 
					$user_list['user_list'][$key]['tags'] = ($usersublist!=false)?$usersublist:'';
					if($user_id==""){
						$user_list['user_list'][$key]['is_me'] = "0";
						$user_list['user_list'][$key]['is_follow'] = "0";
					}else{
						$user_list['user_list'][$key]['is_me'] = ($user_id==$val['user_id'])?"1":"0";
						$user_list['user_list'][$key]['is_follow'] =  model('t_user_follow')->is_follow($user_id,$val['user_id']);
					}
				}
				$user_list['search_url'] = $config['top_search'].$keyword."&type=user";
				$user_list['num'] = $user['num'];
			}else{
			$user_list['search_url'] = "";
			$user_list['user_list'] = array() ;
			$user_list['num'] = "";
			$flag++;
			}
			$search['user'] = $user_list;
			//灵感博文
			$design = model("t_content")->content_search($keyword,1,1,2);
			if(!empty($design['list'])){
				foreach ($design['list'] as $key=>$val) {
					$designlist['design_list'][$key]['title'] = $val->content_title;
					$designlist['design_list'][$key]['id'] = $val->content_id;	
					$designlist['design_list'][$key]['project_num']= $val->content_project;
					$designlist['design_list'][$key]['title'] = $val->content_title;	
					$designlist['design_list'][$key]['tags'] = model('t_tag')->taglist_url($val->content_tag,5);
					$designlist['design_list'][$key]['likes'] = $val->content_likes;	
					if($user_id==""){
						$designlist['design_list'][$key]['is_follow'] = "0";
						$designlist['design_list'][$key]['is_like'] = "0";
						$designlist['design_list'][$key]['is_me']= "0";
					}else{
						$designlist['design_list'][$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->user_id);	
						$designlist['design_list'][$key]['is_like'] = model('t_user_like')->is_like($val->content_id,$user_id);	
						$designlist['design_list'][$key]['is_me']= ($user_id==$val->user_id)?"1":"0";
					}
					$designlist['design_list'][$key]['url'] = $config['contenturl'].$val->content_id;
					$designlist['design_list'][$key]['userspace'] = $config['userspace'].$val->user_id;
					$designlist['design_list'][$key]['pic'] = model("t_user_info")->avatar($val->user_id);
					$userinfo = model("t_user")->get($val->user_id);
					$designlist['design_list'][$key]['nickname'] = ($userinfo->user_nickname!="")?$userinfo->user_nickname:$userinfo->user_email;
					$designlist['design_list'][$key]['uid'] = $val->user_id;
					$designlist['design_list'][$key]['user_pic'] = model("t_user_info")->avatar($val->user_id);
					$designlist['design_list'][$key]['sub_time'] = $val->content_subtime;
					$content = model("t_content")->content_analytic($val->content_content);
					$designlist['design_list'][$key]['pic_num'] = $content['pic_num'];
					$designlist['design_list'][$key]['sub_project_url'] ="/index.php/posts/project/addtocontent"; 
					$designlist['design_list'][$key]['like_url'] = "/index.php/posts/content/like"; 
					foreach ($content['pic_md5'] as $keys=>$vals) {
						$designlist['design_list'][$key]['pic_list'][$keys]['pic_url1'] = $vals['thumb_1'];
						$designlist['design_list'][$key]['pic_list'][$keys]['pic_url2'] = $vals['thumb_2'];
						$designlist['design_list'][$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
					}
				}
				$designlist['search_url'] = $config['top_search'].$keyword."&type=design";
				$designlist['num'] = $design['num'];
			}else{
				$flag++;
				$designlist['search_url'] = "";
				$designlist['num'] = "";
				$designlist['design_list'] = array();
			}
			$search['design'] = $designlist;
			//家居美图
			$product= model("t_content")->content_search($keyword,2,1,2);
			if(!empty($product['list'])){
				foreach ($product['list'] as $key=>$val) {
					$productlist['product_list'][$key]['title'] = $val->content_title;
					$productlist['product_list'][$key]['id'] = $val->content_id;	
					$productlist['product_list'][$key]['project_num']= $val->content_project;
					$productlist['product_list'][$key]['title'] = $val->content_title;	
					$productlist['product_list'][$key]['tags'] = model('t_tag')->taglist_url($val->content_tag,5);
					$productlist['product_list'][$key]['likes'] = $val->content_likes;	
					if($user_id==""){
						$productlist['product_list'][$key]['is_follow'] = "0";
						$productlist['product_list'][$key]['is_like'] = "0";
						$productlist['product_list'][$key]['is_me']= "0";
					}else{
						$productlist['product_list'][$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->user_id);	
						$productlist['product_list'][$key]['is_like'] = model('t_user_like')->is_like($val->content_id,$user_id);	
						$productlist['product_list'][$key]['is_me']= ($user_id==$val->user_id)?"1":"0";

					}
					$productlist['product_list'][$key]['url'] = $config['contenturl'].$val->content_id;
					$productlist['product_list'][$key]['userspace'] = $config['userspace'].$val->user_id;
					$productlist['product_list'][$key]['pic'] = model("t_user_info")->avatar($val->user_id);
					$userinfo = model("t_user")->get($val->user_id);
					$productlist['product_list'][$key]['nickname'] = ($userinfo->user_nickname!="")?$userinfo->user_nickname:$userinfo->user_email;
					$productlist['product_list'][$key]['uid'] = $val->user_id;
					$productlist['product_list'][$key]['user_pic'] = model("t_user_info")->avatar($val->user_id);
					$productlist['product_list'][$key]['sub_time'] = $val->content_subtime;
					$productlist['product_list'][$key]['sub_project_url'] ="/index.php/posts/project/addtocontent"; 
					$productlist['product_list'][$key]['like_url'] = "/index.php/posts/content/like"; 
					$content = model("t_content")->content_analytic($val->content_content);
					$productlist['product_list'][$key]['pic_num'] = $content['pic_num'];
					$this->load->model('t_pic_pin_model');
					foreach ($content['pic_md5'] as $keys=>$vals) {
						$productlist['product_list'][$key]['pic_list'][$keys]['pic_url1'] = $vals['thumb_1'];
						$productlist['product_list'][$key]['pic_list'][$keys]['pic_url2'] = $vals['thumb_2'];
						$productlist['product_list'][$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
						$this->t_pic_pin_model->pic_id= $vals['pic_id'];
						$pin = $this->t_pic_pin_model->getbypic(); 
						foreach ($pin as $keyss=>$valss) {
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['pic_width']= $valss->pic_width;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['class_name']= $valss->pin_product_class_name;				
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['class_id']= $valss->pin_product_class_id;
							$product_class = model("t_product_class")->get($valss->pin_product_class_id);
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['class_pid']= $product_class->p_class_pid;
							$product_pclass = model("t_product_class")->get($product_class->p_class_pid);
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['class_pname']= $product_pclass->p_class_name;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_img']= $valss->pin_img;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['product_url']= $valss->pin_product_url;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['product_id']= $valss->pin_product_id;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_left']= $valss->pin_left;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_top']= $valss->pin_top;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_content']= $valss->pin_content;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_id']= $valss->pin_id;
							$productlist['product_list'][$key]['pic_list'][$keys]['pin_list'][$keyss]['pin_title']= $valss->pin_product_name;
						}

					}
				}
				$productlist['search_url'] = $config['top_search'].$keyword."&type=product";
				$productlist['num'] = $product['num'];
			}else{
				$flag++;
				$productlist['search_url'] = "";
				$productlist['num'] = "";
				$productlist['product_list'] = array();
			}
			$search['product'] = $productlist;
			//装修问题
			$question = model("t_questions")->question_search($keyword,1,2);
			if(!empty($question['list'])){
				foreach ($question['list'] as $key=>$val) {
					$questionlist['question_list'][$key]['id'] = $val->question_id;
					$questionlist['question_list'][$key]['url'] = $config['questionurl'].$val->question_id;
					$questionlist['question_list'][$key]['title'] = $val->question_title;
					$questionlist['question_list'][$key]['id'] = $val->question_id;	
					$questionlist['question_list'][$key]['title'] = $val->question_title;
					$questionlist['question_list'][$key]['class_pname'] = $val->class_pname;
					$questionlist['question_list'][$key]['class_name'] = $val->class_name;
					$questionlist['question_list'][$key]['likes'] = $val->question_likes;	
					$questionlist['question_list'][$key]['shares'] = $val->question_share;	
					$questionlist['question_list'][$key]['url'] = $config['questionurl'].$val->question_id;
					$questionlist['question_list'][$key]['answers'] = $val->question_answers;
					$questionlist['question_list'][$key]['sub_time'] = $val->question_subtime;
					$questionlist['question_list'][$key]['project_num']= $val->question_project;
					$questionlist['question_list'][$key]['sub_project_url'] ="/index.php/posts/project/addtoquestion"; 
					$questionlist['question_list'][$key]['like_url'] = "/index.php/posts/qa/like"; 
					$questionlist['question_list'][$key]['status']= ($val->question_status=="3")?"精选":"";
					$questionlist['question_list'][$key]['user_pic'] = model("t_user_info")->avatar($val->user_id);
					if($user_id==""){
						$questionlist['question_list'][$key]['is_like'] = "0";
					}else{
						$questionlist['question_list'][$key]['is_like'] = model('t_like_questions')->is_like($val->question_id,$user_id);	
					}
					$content = model("t_questions")->content_analytic($val->question_content);
					$questionlist['question_list'][$key]['pic_num'] = $content['pic_num'];
					if(is_array($content['pic_md5'])){
						foreach ($content['pic_md5'] as $keys=>$vals) {
							$questionlist['question_list'][$key]['content'] = $content['question_content'];
							$questionlist['question_list'][$key]['pic_list'][$keys]['pic_url'] = $vals['thumb_1'];
							$questionlist['question_list'][$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
						}
					}
				}
				$questionlist['search_url'] = $config['top_search'].$keyword."&type=question";
				$questionlist['num'] = $question['num'];
			}else{
				$flag++;
				$questionlist['search_url'] = "";
				$questionlist['num'] = "";
				$questionlist['question_list'] = array();
			}
			$search['question'] = $questionlist;
			break;
		}
		if($flag==4){
		echojson(1,"","无相关数据");
		}else{
		echojson(0,$search);
		}
	}
}

