<?php
/**
 *description:用户信息
 *author:yanyalong
 *date:2013/11/05
 */
class Content extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:灵感博文详情
	 *author:yanyalong
	 *date:2013/11/06
	 */
	public function design(){
		safeFilter();
		$this->config->load('url');
		$config = $this->config->item('url');
		$content_id= $this->input->post('cid',true);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->load->model('t_content_model');
		$this->t_content_model->content_id = $content_id;
		$this->t_content_model->content_type = 1;
		$content = $this->t_content_model->getcontentinfo();
		if($content==false){
			echojson(1,"","不存在的博文");
		}
		$contentinfo['cid'] = $content->content_id;
		$contentinfo['uid'] = $content->user_id;
		$contentinfo['is_me'] = ($content->user_id==$user_id)?"1":"0";
		$contentinfo['project_id'] = ($content->project_id!=null)?$content->project_id:"";
		$contentinfo['project_name'] = ($content->project_name!=null)?$content->project_name:"";
		$contentinfo['title'] = $content->content_title;
		$contentinfo['tags'] = model('t_tag')->taglist_url(11,$content->content_tag,5);
		$contentinfo['likes'] = $content->content_likes;
		$contentinfo['shares'] = $content->content_share;
		$contentinfo['recommends'] = $content->content_recommend;
		$contentinfo['disc'] = $content->content_disc;
		$contentinfo['url'] = $config['contenturl'].$content->content_id;
		$contentinfo['status'] = ($content->content_status==3)?"精选":"";
		$contentinfo['sub_time'] = $content->content_subtime;
		$contentinfo['project_num'] = $content->content_project;
		$this->t_content_model->user_id = $content->user_id;
		$this->t_content_model->content_id = $content_id;
		$pl_content = $this->t_content_model->pl_content();
		$contentinfo['left_page'] = $pl_content['prev_content'];
		$contentinfo['right_page'] = $pl_content['last_content'];
		$contentinfo['plurl'] = $config['contenturl'];
		$content_content = $this->t_content_model->content_analytic($content->content_content);
		$contentinfo['content'] = $content_content['content_content'];
		$contentinfo['pic_num'] = $content_content['pic_num'];
		$userinfo = model("t_user")->get($content->user_id);
		$contentinfo['nick_name'] = ($userinfo->user_nickname!="")?$userinfo->user_nickname:$userinfo->user_email;
		$contentinfo['userspace'] = $config['userspace'].$content->user_id;
		$contentinfo['user_pic']= model("t_user_info")->avatar($content->user_id);
		$contentinfo['fans']= $userinfo->user_fans;
		$contentinfo['user_project']= model("t_album")->album_num($content->user_id)->count;
		if($user_id==""){
			$contentinfo['is_follow'] = "0";		
			$contentinfo['is_like'] = "0";		
			$contentinfo['is_recommend'] = "0";		
		}else{
			$contentinfo['is_follow'] = model('t_user_follow')->is_follow($user_id,$content->user_id);	
			$contentinfo['is_like'] = model('t_user_like')->is_like($content_id,$user_id);	
			$contentinfo['is_recommend'] = model('t_user_content_recommend')->is_recommend($content_id,$user_id);	
		}
		foreach ($content_content['pic_md5'] as $key=>$val) {
			$contentinfo['pic_list'][$key]['pic_url'] = $val['thumb_1'];
			$contentinfo['pic_list'][$key]['pic_content'] = $val['pic_content'];
		}
		if($user_id!=""){
		loadLib("User_Feed");
		new Feed("GetFeedByReadContent",$user_id,$content_id);
		}
		echojson(0,$contentinfo);
	}

	/**
	 *description:最近查看灵感
	 *author:yanyalong
	 *date:2013/12/03
	 */
	public function recentlyView(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(1,"","无相关数据");
		}
		$view= model("t_user_feeds")->recentlyView($user_id,16,5);
		$this->config->load('url');
		$config = $this->config->item('url');
		$str = "";
		if($view!=false){
		foreach ($view as $key=>$val) {
			$str.=$val->feed_content.",";		
		}
		$res= model("t_content")->getbyidlist(trim($str,","),5);
		}else{
			$res = false;	
		}
		if($res==false){
			echojson(1,"","无相关数据");
		}
		foreach ($res as $key=>$val) {
			$content = model("t_content")->content_analytic($val->content_content);
			foreach ($content['pic_md5'] as $keys=>$vals) {
				$recent[$key]['pic_url'] = $vals['thumb_2'];
			}
			$recent[$key]['url'] = $config['contenturl'].$val->content_id;
			$recent[$key]['title'] = $val->content_title;	
		}
		echojson(0,$recent);
	}
	/**
	 *description:你可能喜欢
	 *author:yanyalong
	 *date:2013/12/03
	 */
	public function guessYourLike(){
		safeFilter();
		$p= $this->input->post('p',true);
		$row = 5;
		$res= model("t_content")->explore(1,$p,$row);
		$guess = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		if($res==false){
			echojson(1,"","无相关数据");
		}
		foreach ($res as $key=>$val) {
			$content = model("t_content")->content_analytic($val->content_content);
			foreach ($content['pic_md5'] as $keys=>$vals) {
				$guess[$key]['pic_url'] = $vals['thumb_2'];
			}
			$guess[$key]['url'] = $config['contenturl'].$val->content_id;
			$guess[$key]['title'] = $val->content_title;	
		}
		echojson(0,$guess);
	}
	/**
	 *description:灵感博文详情
	 *author:yanyalong
	 *date:2013/11/06
	 */
	public function product(){
		safeFilter();
		$this->config->load('url');
		$config = $this->config->item('url');
		$content_id= $this->input->post('cid',true);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->load->model('t_content_model');
		$this->load->model('t_pic_pin_model');
		$this->t_content_model->content_id = $content_id;
		$this->t_content_model->content_type = 2;
		$content = $this->t_content_model->getcontentinfo();
		if($content==false){
			$res = $this->t_content_model->get($content_id);
			$contentinfo['userspace'] = $config['userspace'].$res->user_id;
			$userinfo = model("t_user")->get($res->user_id);
			$contentinfo['nick_name'] = $userinfo->user_nickname;
			$contentinfo['user_pic']= model("t_user_info")->avatar($res->user_id);
			$contentinfo['uid'] = $res->user_id;
			if($user_id==""){
				$contentinfo['is_follow'] = "0";		
			}else{
				$contentinfo['is_follow'] = model('t_user_follow')->is_follow($user_id,$res->user_id);	
			}
			echojson(1,$contentinfo,"不存在的博文");
		}
		$contentinfo['id'] = $content->content_id;
		$contentinfo['uid'] = $content->user_id;
		$contentinfo['project_id'] = ($content->project_id!=null)?$content->project_id:"";
		$contentinfo['is_me'] = ($content->user_id==$user_id)?"1":"0";
		$contentinfo['project_name'] = ($content->project_name!=null)?$content->project_name:"";
		$contentinfo['title'] = $content->content_title;
		$contentinfo['tags'] = model('t_tag')->gettaglist_url($content->content_tag_id);
		$contentinfo['likes'] = $content->content_likes;
		$contentinfo['shares'] = $content->content_share;
		$contentinfo['recommends'] = $content->content_recommend;
		$contentinfo['disc'] = $content->content_disc;
		$this->config->load('url');
		$config = $this->config->item('url');
		$contentinfo['url'] = $config['contenturl'].$content->content_id;
		$contentinfo['status'] = ($content->content_status==3)?"精选":"";
		$contentinfo['sub_time'] = $content->content_subtime;
		$contentinfo['project_num'] = $content->content_project;
		$this->t_content_model->user_id = $content->user_id;
		$this->t_content_model->content_id = $content_id;
		$pl_content = $this->t_content_model->pl_content();
		$contentinfo['right_page'] = $pl_content['prev_content'];
		$contentinfo['left_page'] = $pl_content['last_content'];
		$contentinfo['plurl'] = $config['producturl'];
		$content_content = $this->t_content_model->content_analytic($content->content_content);
		$contentinfo['content'] = $content_content['content_content'];
		$contentinfo['pic_num'] = $content_content['pic_num'];
		$userinfo = model("t_user")->get($content->user_id);
		$contentinfo['nick_name'] = ($userinfo->user_nickname!="")?$userinfo->user_nickname:$userinfo->user_email;
		$contentinfo['userspace'] = $config['userspace'].$content->user_id;
		$contentinfo['user_pic']= model("t_user_info")->avatar($content->user_id);
		if($user_id==""){
			$contentinfo['is_follow'] = "0";		
			$contentinfo['is_like'] = "0";		
			$contentinfo['is_recommend'] = "0";		
		}else{
			$contentinfo['is_follow'] = model('t_user_follow')->is_follow($user_id,$content->user_id);	
			$contentinfo['is_like'] = model('t_user_like')->is_like($content_id,$user_id);	
			$contentinfo['is_recommend'] = model('t_user_content_recommend')->is_recommend($content_id,$user_id);	
		}
		foreach ($content_content['pic_md5'] as $key=>$val) {
			$contentinfo['pic_list'][$key]['pic_url'] = $val['thumb_1'];
			$contentinfo['pic_list'][$key]['pic_content'] = $val['pic_content'];
			$this->t_pic_pin_model->pic_id= $val['pic_id'];
			$pin = $this->t_pic_pin_model->getbypic(); 
			foreach ($pin as $keys=>$vals) {
				$contentinfo['pic_list'][$key]['pin_list'][$keys]['class_name']= $vals->pin_product_class_name;
				$contentinfo['pic_list'][$key]['pin_list'][$keys]['class_id']= $vals->pin_product_class_id;
				$product_class = model("t_product_class")->get($vals->pin_product_class_id);
				$contentinfo['pic_list'][$key]['pin_list'][$keys]['class_pid']= $product_class->p_class_pid;
				$product_pclass = model("t_product_class")->get($product_class->p_class_pid);
				$contentinfo['pic_list'][$key]['pin_list'][$keys]['class_pname']= $product_pclass->p_class_name;
				$contentinfo['pic_list'][$key]['pin_list'][$keys]['pin_img']= $vals->pin_img;
				$contentinfo['pic_list'][$key]['pin_list'][$keys]['product_url']= $vals->pin_product_url;
				$contentinfo['pic_list'][$key]['pin_list'][$keys]['product_id']= $vals->pin_product_id;
				$contentinfo['pic_list'][$key]['pin_list'][$keys]['pin_left']= $vals->pin_left;
				$contentinfo['pic_list'][$key]['pin_list'][$keys]['pin_top']= $vals->pin_top;
				$contentinfo['pic_list'][$key]['pin_list'][$keys]['pin_content']= $vals->pin_content;
				$contentinfo['pic_list'][$key]['pin_list'][$keys]['pin_id']= $vals->pin_id;
				$contentinfo['pic_list'][$key]['pin_list'][$keys]['pin_title']= $vals->pin_product_name;
				$contentinfo['pic_list'][$key]['pic_width']= $vals->pic_width;
			}
		}
		echojson(0,$contentinfo);
	}

	/**
	 *description:获取博文评论列表
	 *author:yanyalong
	 *date:2013/11/07
	 */
	public function getdiscu(){
		safeFilter();
		$p= $this->input->post('p',true);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$content_id= $this->input->post('cid',true);
		$this->load->model('t_content_discussion_model');
		$contentinfo = $this->t_content_discussion_model->content_show($content_id,$p,10);
		if(empty($contentinfo)){
			echojson(1,"",'暂无任何评论');
		}		
		foreach ($contentinfo as $key=>$val) {
			if($user_id!=""){
				$contentinfo[$key]['is_black']= model('t_user_disable')->is_black($user_id,$val['user_id']);
			}else{
				$contentinfo[$key]['is_black']= "";
			}
		}
		echojson(0,$contentinfo);
	}

	/**
	 *description:编辑灵感博文数据
	 *author:yanyalong
	 *date:2013/11/08
	 */
	public function editdesign(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$content_id= $this->input->post('cid',true);
		$this->load->model('t_content_model');
		$this->t_content_model->content_id = $content_id;
		$this->t_content_model->content_type = 1;
		$content = $this->t_content_model->getcontentinfo();
		if($content==false){
			echojson(1,"","不存在的博文");
		}
		$content_content = $this->t_content_model->content_analytic($content->content_content);
		$tag_idlist = explode(",",$content->content_tag_id);
		loadLib("System_Class_Tag");
		$System_Class_Tag = new System_Class_Tag();	
		$System_Class_Tag->s_class_type = 11;
		$design['sys_class']= $System_Class_Tag->getTagBySystemClass();
		if($content==false){
			echojson(1,"","数据异常");
		}
		foreach ($design['sys_class'] as $key=>$val) {
			foreach ($val['options'] as $keys=>$vals) {
				foreach($tag_idlist as $keyss=>$valss){
					if(in_array($valss,$vals)){
						$design['sys_class'][$key]['options'][$keys]['select'] = 1; 
					}
				}		
			}
		}		
		$design['title'] = $content->content_title;
		$design['content'] = $content_content['content_content'];
		foreach ($content_content['pic_md5'] as $key=>$val) {
			$design['pic_list'][$key]['pic_url'] = $val['thumb_3'];
			$design['pic_list'][$key]['pic_content'] = $val['pic_content'];
		}
		echojson(0,$design);
	}
	/**
	 *description:编辑家居美图数据
	 *author:yanyalong
	 *date:2013/11/08
	 */
	public function editproduct(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$content_id= $this->input->post('cid',true);
		$this->load->model('t_content_model');
		$this->t_content_model->content_id = $content_id;
		$this->t_content_model->content_type = 2;
		$content = $this->t_content_model->getcontentinfo();
		if($content==false){
			echojson(1,"","不存在的博文");
		}
		$content_content = $this->t_content_model->content_analytic($content->content_content);
		$tag_idlist = explode(",",$content->content_tag_id);
		loadLib("System_Class_Tag");
		$System_Class_Tag = new System_Class_Tag();	
		$System_Class_Tag->s_class_type = 12;
		$product['sys_class']= $System_Class_Tag->getTagBySystemClass();
		if($content==false){
			echojson(1,"","数据异常");
		}
		foreach ($product['sys_class'] as $key=>$val) {
			foreach ($val['options'] as $keys=>$vals) {
				foreach($tag_idlist as $keyss=>$valss){
					if(in_array($valss,$vals)){
						$product['sys_class'][$key]['options'][$keys]['select'] = 1; 
						continue;
					}
				}		
			}
		}		
		$product['title'] = $content->content_title;
		$product['content'] = $content_content['content_content'];
		loadLib("Product_Class");
		$Product_Class = new Product_Class();
		$Product_Class->p_class_pid = 0;
		$pclassList = $Product_Class->getProdutClass();
		foreach ($content_content['pic_md5'] as $key=>$val) {
			$product['pic_list'][$key]['pic_url'] = $val['source'];
			$product['pic_list'][$key]['pic_content'] = $val['pic_content'];
			$this->load->model('t_pic_pin_model');
			$this->t_pic_pin_model->pic_id= $val['pic_id'];
			$pin = $this->t_pic_pin_model->getbypic(); 
			foreach ($pin as $keys=>$vals) {
				$product['pic_list'][$key]['pin_list'][$keys]['class_name']= $vals->pin_product_class_name;
				$product['pic_list'][$key]['pin_list'][$keys]['class_id']= $vals->pin_product_class_id;
				$product_class = model("t_product_class")->get($vals->pin_product_class_id);
				foreach ($pclassList as $keyss=>$valss) {
					if(in_array($product_class->p_class_pid,$valss)){
						$product['pic_list'][$key]['pin_list'][$keys]['pselect']= $keyss+1;
					}
				}
				$Product_Class->p_class_pid = $product_class->p_class_pid;
				$classList = $Product_Class->getProdutClass();
				foreach ($classList as $keysss=>$valsss) {
					if(in_array($vals->pin_product_class_id,$valsss)){
						$product['pic_list'][$key]['pin_list'][$keys]['select']= $keysss+1;
					}
				}
				$product['pic_list'][$key]['pin_list'][$keys]['class_pid']= $product_class->p_class_pid;
				$product_pclass = model("t_product_class")->get($product_class->p_class_pid);
				$product['pic_list'][$key]['pin_list'][$keys]['class_pname']= $product_pclass->p_class_name;
				$product['pic_list'][$key]['pin_list'][$keys]['pin_img']= $vals->pin_img;
				$product['pic_list'][$key]['pin_list'][$keys]['pin_left']= $vals->pin_left;
				$product['pic_list'][$key]['pin_list'][$keys]['pin_top']= $vals->pin_top;
				$product['pic_list'][$key]['pin_list'][$keys]['pin_content']= $vals->pin_content;
				$product['pic_list'][$key]['pin_list'][$keys]['pin_id']= $vals->pin_id;
				$product['pic_list'][$key]['pin_list'][$keys]['pin_title']= $vals->pin_product_name;
				$product['pic_list'][$key]['pic_width']= $vals->pic_width;
			}
		}
		echojson(0,$product);
	}
	/**
	 *description:我喜欢的家居美图
	 *author:yanyalong
	 *date:2013/11/12
	 */
	public function likeproduct(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$p= $this->input->post('p',true);
		$res = model("t_user_like")->mylike($user_id,2,$p,9);
		$this->config->load('url');
		$config = $this->config->item('url');
		if(empty($res)){
			echojson(1,'',"无更多数据");
		}
		foreach ($res as $key=>$val) {
			$contentlist[$key]['id'] = $val->content_id;	
			$contentlist[$key]['project_num']= $val->content_project;
			$contentlist[$key]['likes'] = $val->content_likes;	
			$contentlist[$key]['title'] = $val->content_title;
			$content = model("t_content")->content_analytic($val->content_content);
			foreach ($content['pic_md5'] as $keys=>$vals) {
				$contentlist[$key]['pic_url'] = $vals['thumb_2'];
			}
			$contentlist[$key]['url'] = $config['producturl'].$val->content_id;
		}
		echojson(0,$contentlist);
	}
	/**
	 *description:我喜欢的灵感博文
	 *author:yanyalong
	 *date:2013/11/12
	 */
	public function likedesign(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$p = $this->input->post('p',true);
		$res = model("t_user_like")->mylike($user_id,1,$p,9);
		$this->config->load('url');
		$config = $this->config->item('url');
		if(empty($res)){
			echojson(1,'',"无更多数据");
		}
		foreach ($res as $key=>$val) {
			$contentlist[$key]['id'] = $val->content_id;	
			$contentlist[$key]['project_num']= $val->content_project;
			$contentlist[$key]['likes'] = $val->content_likes;	
			$contentlist[$key]['title'] = $val->content_title;
			$content = model("t_content")->content_analytic($val->content_content);
			foreach ($content['pic_md5'] as $keys=>$vals) {
				$contentlist[$key]['pic_url'] = $vals['thumb_2'];
			}
			$contentlist[$key]['url'] = $config['designurl'].$val->content_id;
		}
		echojson(0,$contentlist);
	}
}
