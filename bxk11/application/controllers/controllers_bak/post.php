<?php
/*description:产品的灵感
 *author:yanyalong
 *date:2013/07/28
 */
class Post extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:产品的灵感表单页
	 *author:yanyalong
	 *date:2013/10/22
	 */
	public function product(){
		$this->checklogin();
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['product']);	
	}
	//产品的灵感添加表单页
	function product_add(){
		loadLib("System_Class_Tag");
		$System_Class_Tag = new System_Class_Tag();
		$System_Class_Tag->s_class_type = 11;
		$product = $System_Class_Tag->getTagBySystemClass();
		if($product!=false){
			echojson(0,$product);
		}else{
			echojson(1,'',"无相关数据");
		}
	}
	/**
	 *description:家居美图分类
	 *author:yanyalong
	 *date:2013/10/31
	 */
	public function productClassByPid(){
		safeFilter();
		$productClassPid= $this->input->post('productClassPid',true);
		loadLib("Product_Class");
		$Product_Class = new Product_Class();
		$Product_Class->p_class_pid = $productClassPid;
		$productClass = $Product_Class->getProdutClass();
		if($productClass!=false){
			echojson(0,$productClass);
		}else{
			echojson(1,'',"无相关数据");
		}
	}

	//产品的灵感添加执行
	public function product_add_exec(){
		safeFilter();
		$this->ajax_checklogin();
		$user_id = $_SESSION['user_id'];
		loadLib("Score_Class");
		$Score_Class = new Score_Class($user_id,"content_add");
		if($Score_Class->checkScore()==false){
			echojson(1,'',"积分不足");
		}			
		loadLib("Content_Class");
		$Content_Class = new Content_Class();	
		$content_title= $this->input->post('content_title',true);
		$content_content= $this->input->post('content_content',true);
		$content_content= $Content_Class->replace_str($content_content);
		$tag_idlist= $this->input->post('tag_idlist',true);
		$tag_namelist= $this->input->post('tag_namelist',true);
		$imgname= $this->input->post('imgname',true);
		$pin= $this->input->post('pin',true);
		$sensitive_check = true;
		if($sensitive_check==false){
			echojson(1,"","存在敏感词");
		}	
		if(trim($content_title)==''){
			echojson(1,"","标题不能为空");
		}
		if((strlen(trim($content_title)) + mb_strlen(trim($content_title),'UTF8'))/2>40){
			echojson(1,"","标题不能超过20个字");
		}
		if(trim($imgname)==''){
			echojson(1,"","禁止非法操作");
		}
		//检测并处理图钉数据
		loadLib("Pin_Class");
		$Pin_Class = new Pin_Class();
		$Pin_Class->pinStr = $pin;
		$pinarr = $Pin_Class->checkPinStr();
		if($pinarr==false){
			echojson(1,"","禁止非法操作");
		}
		foreach(explode('|^|',rtrim($imgname,'|^|')) as $key=>$info){
			$imginfo[] = explode('^|^',trim($info,','));
		}	
		$this->config->load('uploads');
		$config = $this->config->item('product');
		$countimg=0;
		//积分计数器，记录积分事件
		$score = 0;
		$this->load->database();
		$this->load->model('t_pic_pin_model');
		loadLib("Content_Class");
		$Content_Class = new Content_Class();	
		foreach ($imginfo as $key=>$val) {
			$pic_content = $Content_Class->replace_str($val[1]);
			$pic_id = model("t_pic")->pic_add($config['upload_path'].$val[0],$user_id,$pic_content);
			$picinfo[] = $pic_id.':'.$val[0].':'.$pic_content;
			if(!empty($pinarr)){
				foreach ($pinarr as $key=>$val) {
					$this->t_pic_pin_model->pic_id= $pic_id;
					$this->t_pic_pin_model->user_id= $user_id;
					$this->t_pic_pin_model->pin_product_name= $val['pin_product_name'];
					$this->t_pic_pin_model->pin_content= $val['pin_content'];
					$this->t_pic_pin_model->pin_product_class_id= $val['pin_product_class_id'];
					$this->t_pic_pin_model->pin_product_class_name= $val['pin_product_class_name'];
					$this->t_pic_pin_model->pin_top= $val['pin_top'];
					$this->t_pic_pin_model->pin_left= $val['pin_left'];
					$this->t_pic_pin_model->insert();
				}
			}
			$countimg++;
		}
		//记录积分事件
		$content_img = "[img]".$countimg."{";
		foreach ($picinfo as $key=>$val) {
			$content_img .= $val.',';
		}
		$content_img  =trim($content_img,',');
		$content_img .="}[/img]";

		//插入灵感记录
		if($content_content==""){
			$content_content = " ";	
		}
		$content_content = "[content]".$content_content."[/content]".$content_img;
		$this->load->model('t_content_model');
		$this->t_content_model->user_id= $user_id;
		$this->t_content_model->content_title = $content_title;
		$this->t_content_model->content_type= '2';
		$this->t_content_model->content_content = $content_content;
		$this->t_content_model->content_tag = $tag_namelist;
		$this->t_content_model->content_tag_id = $tag_idlist;
		$content_id = $this->t_content_model->insert();	
		if($content_id){
			if($Score_Class->checkMax()==true){
				$Score_Class->modScore();
			}			
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
			model("t_user")->user_status($user_id,'user_content','+');
			loadLib("User_Feed");
			new Feed("GetFeedByAddContent",$user_id,$content_id);
			if(!empty($tag_idlist)){
				$res = model('t_content_tag')->content_tags_add(trim($tag_idlist,','),$content_id);
				if($res){
					echojson(0,'',"发布成功");
				}else{
					echojson(1,'',"发布失败");
				}
			}
		}else{
			echojson(1,'',"发布失败");
		}	
	}
	/**
	 *description:积分是否足够
	 *author:yanyalong
	 *date:2013/10/21
	 */
	public function isEnoughScore(){
		safeFilter();
		$score= $this->input->post('score',true);
		$isEnoughScore= true;
		if($isEnoughScore==false){
			echojson(1,"","没有足够积分");
		}else{
			echojson(0,"","积分足够");
		}
	}
	/**
	 *description:家装美图表单页
	 *author:yanyalong
	 *date:2013/10/22
	 */
	public function design(){
		safeFilter();
		$this->checklogin();
		$data['title'] = "发布家居灵感";
		$data['config']	= $this->myinfo();
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['design'],$data);	
	}
	//设计的灵感添加表单页内容
	function design_add(){
		loadLib("System_Class_Tag");
		$System_Class_Tag = new System_Class_Tag();	
		$System_Class_Tag->s_class_type = 11;
		$design= $System_Class_Tag->getTagBySystemClass();
		if($design!=false){
			echojson(0,$design);
		}else{
			echojson(1,"","无相关数据");
		}
	}

	public function design_info(){
		safeFilter();
		$this->load->model('Bxk_tag_model');
		$tags = $this->Bxk_tag_model->gettagsbytype(32);
		$content_id= $this->input->post('content_id',true);
		//推荐标签
		$this->load->model('Bxk_content_model');
		$contentinfo = $this->Bxk_content_model->content($content_id);
		$taginfo= model("Bxk_content_tag_model")->content_taginfo($content_id);
		foreach ($tags as $key=>$val) {
			foreach ($val as $keys=>$vals){
				foreach ($taginfo['32'] as $keyss=>$valss) {
					if($valss['tag_id']==$vals['tag_id']){
						$tags[$key][$keys]['select_status'] = '1';		
					}
				}
			}
		}
		$contentinfo['taginfo'] = $taginfo;
		$contentinfo['province'] = $tags['所在地'];
		$contentinfo['color'] = $tags['装修色调'];
		$contentinfo['style'] = $tags['装修风格'];
		$contentinfo['area'] = $tags['面积'];
		$contentinfo['type'] = $tags['户型'];
		$contentinfo['price'] = $tags['项目造价'];
		foreach($taginfo['32'] as $key=>$val){
			if($val['tag_pid']==567){
				$city_tag_pid = $val['tag_id'];
			}		
		}
		$contentinfo['city'] = $this->Bxk_tag_model->get_tags($city_tag_pid);
		foreach($contentinfo['city'] as $key=>$val){
			foreach($taginfo['32'] as $keys=>$vals){
				if($vals['tag_id']==$val['tag_id']){
					$contentinfo['city'][$key]['select_status'] = '1';		
					$contentinfo['build'] = $this->Bxk_tag_model->get_tags($vals['tag_id']);
				}	
			}
		}
		if(!empty($contentinfo['build'])){
			foreach ($contentinfo['build'] as $key=>$val) {
				foreach($taginfo['32'] as $keys=>$vals){
					if($val['tag_id']==$vals['tag_id']){
						$contentinfo['build'][$key]['select_status'] = '1';		
					}
				}
			}
		}else{
			$contentinfo['build'] = "";	
		}	
		if($contentinfo!=false){
			echojson(0,$contentinfo);
		}else{
			echojson(1,'无相关数据');
		}
	}

	/**
	 *description:装修问题添加表单页面
	 *author:yanyalong
	 *date:2013/10/22
	 */
	function question(){ 
		$this->checklogin();
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['question']);	
	}
	//装修问题添加表单页内容
	function question_add(){
		$this->load->model('t_question_class_model');
		$this->t_question_class_model->class_pid = 0;
		$res = $this->t_question_class_model->get_where('class_pid');
		if($res!=false){
			$question = array();
			foreach ($res as $key=>$val) {
				$question[$key]->class_name = $val->class_name;
				$question[$key]->class_id = $val->class_id;
			}
			echojson(0,$question);
		}else{
			echojson(1,'',"无相关数据");
		}
	}
	//装修问题添加执行
	public function question_add_exec(){
		safeFilter();
		$this->ajax_checklogin();
		$this->CI = &get_instance();
		$this->CI->config->load('uploads');
		$thumb_config = $this->CI->config->item('question');
		$user_id = $_SESSION['user_id'];
		loadLib("Score_Class");
		$Score_Class = new Score_Class($user_id,"question_add");
		if($Score_Class->checkScore()==false){
			echojson(1,'',"积分不足");
		}			
		$user_nickname = $_SESSION['user_nickname'];
		loadLib("Content_Class");
		$Content_Class = new Content_Class();	
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
		//插入装修问题记录
		$question_content = "[content]".$question_content."[/content]".$content_img;
		$this->load->model('t_questions_model');
		$this->t_questions_model->question_title= $question_title;
		$this->t_questions_model->question_content= $question_content;
		$this->t_questions_model->class_pid= $class_arr['0'];
		$this->t_questions_model->class_id= $class_arr['1'];
		$this->load->model('t_question_class_model');
		$questionClassInfo = $this->t_question_class_model->get($class_arr['1']);
		$this->t_questions_model->class_name= $questionClassInfo->class_name;
		$this->t_questions_model->class_pname= $questionClassInfo->class_p_name;;
		$this->t_questions_model->user_nickname= $user_nickname;
		$this->t_questions_model->question_last_user_nickname= $user_nickname;
		$this->t_questions_model->user_id= $user_id;
		$this->t_questions_model->question_last_user_id= $user_id;
		$question_id = $this->t_questions_model->insert();	
		if($question_id){
			if($Score_Class->checkMax()==true){
				$Score_Class->modScore();
			}			
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
			model("t_user")->user_status($user_id,'user_questions','+');
			$this->t_question_class_model->updateClassNumbers($class_arr['0'],'+');
			$this->t_question_class_model->updateClassNumbers($class_arr['1'],'+');
			loadLib("User_Feed");
			new Feed("GetFeedByAddQuestion",$user_id,$question_id);
			echojson(0,'',"发布成功");
		}else{
			echojson(1,'',"发布失败");
		}
	}
	/**
	 *description:获取小分类数据
	 *author:yanyalong
	 *date:2013/10/20
	 */
	public function getClassList(){
		safeFilter();
		$class_pid= $this->input->post('class_id',true);
		$this->load->model('t_question_class_model');
		$this->t_question_class_model->class_pid = $class_pid;
		$res = $this->t_question_class_model->get_where('class_pid');
		if($res!=false){
			$question = array();
			foreach ($res as $key=>$val) {
				$question[$key]['class_name'] = $val->class_name;  
				$question[$key]['class_id'] = $val->class_id;
			}
			echojson(0,$question);
		}else{
			echojson(1,'',"无相关数据");
		}
	}

	//设计的灵感添加执行
	public function design_add_exec(){
		$this->ajax_checklogin();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		if($user_id==""){
			echojson(1,'',"未登录");
		}
		safeFilter();
		$_POST = disableCheck();
		loadLib("Score_Class");
		$Score_Class = new Score_Class($user_id,"content_add");
		if($Score_Class->checkScore()==false){
			echojson(1,'',"积分不足");
		}			
		loadLib("Content_Class");
		$Content_Class = new Content_Class();	
		$content_title= $this->input->post('title',true);
		$content_content= $this->input->post('content_content',true);
		$content_content= $Content_Class->replace_str($content_content);
		$project_name = strip_tags($this->input->post('name'));
		if($project_name==''){
			echojson(1,'','项目的名称不能为空');
		}
		$tag_namelist= $this->input->post('tag_namelist',true);
		$imgname= $this->input->post('imgname',true);
		//$sensitive_check = true;
		//if($sensitive_check==false){
		//echojson(1,"","存在敏感词");
		//}	
		if(trim($content_title)==''){
			echojson(1,"","标题不能为空");
		}
		if((strlen(trim($content_title)) + mb_strlen(trim($content_title),'UTF8'))/2>40){
			echojson(1,"","标题不能超过20个字");
		}
		if(trim($imgname)==''){
			echojson(1,"","禁止非法操作");
		}
		foreach(explode('|^|',rtrim($imgname,'|^|')) as $key=>$info){
			$imginfo[] = explode('^|^',trim($info,','));
		}	
		$this->config->load('uploads');
		$config = $this->config->item('design');
		$countimg=0;
		//积分计数器，记录积分事件
		$score = 0;
		$this->load->database();
		foreach ($imginfo as $key=>$val) {
			$pic_content = $Content_Class->replace_str($val[1]);
			$pic_id = model("t_pic")->pic_add($config['upload_path'].$val[0],$user_id,$pic_content);
			$picinfo[] = $pic_id.':'.$val[0].':'.$pic_content;
			$countimg++;
		}
		//记录积分事件
		$content_img = "[img]".$countimg."{";
		foreach ($picinfo as $key=>$val) {
			$content_img .= $val.',';
		}
		$content_img  =trim($content_img,',');
		$content_img .="}[/img]";
		//插入灵感记录
		if($content_content==""){
			$content_content = " ";	
		}
		$content_content = "[content]".$content_content."[/content]".$content_img;
		$this->load->model('t_content_model');
		$tagarr = model("t_tag")->tagIdByName($tag_namelist); 
		$tag_idlist = "";
		if(!empty($tagarr)){
			foreach ($tagarr as $key=>$val) {
				$tag_idlist.=$val->tag_id.',';	
			}
			$tag_idlist = trim($tag_idlist,',');
		}
		//$t_content_model = new t_content_model($user_id,$content_title,1,$content_content,$tag_namelist,$tag_idlist);
		$this->t_content_model->user_id= $user_id;
		$this->t_content_model->content_title = $content_title;
		$this->t_content_model->content_type= '1';
		$this->t_content_model->content_content = $content_content;
		$this->t_content_model->content_tag = $tag_namelist;
		$this->t_content_model->content_tag_id = $tag_idlist;
		$content_id = $this->t_content_model->insert();	
		if($content_id){
			loadLib("Album_Class");
			AlbumFactory::createObj($project_name,$content_id,$user_id);
			if($Score_Class->checkMax()==true){
				$Score_Class->modScore();
			}			
			//记录积分事件
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
			model("t_user")->user_status($user_id,'user_content','+');
			loadLib("User_Feed");
			new Feed("GetFeedByAddContent",$user_id,$content_id);
			$this->config->load('url');
			$config = $this->config->item('url');
			$url = $config['contenturl'].$content_id;
			if(!empty($tag_idlist)){
				$res = model('t_content_tag')->content_tags_add(trim($tag_idlist,','),$content_id);
				if($res){
					echojson(0,$url,"发布成功");
				}else{
					echojson(1,"","发布失败");
				}
			}else{
				echojson(0,$url,"发布成功");
			}
		}else{
			echojson(1,"","发布失败");
		}	
	}
	/**
	 *description:获取家居灵感热门标签信息
	 *author:yanyalong
	 *date:2013/12/04
	 */
	public function tagbyhot(){
		$res = model("t_content_tag")->tagrank_byhot();				
		if($res==false){
			echojson(1,"","无相关推荐");
		}
		$this->load->helper('py');
		$arr = array();
		foreach ($res as $key=>$val) {
			$arr[$key]['name'] = $val['tag_name'];
			$ptag = Pinyin($val['tag_name'],'utf-8');
			if($ptag!=""){
				$arr[$key]['pinyin'] =$ptag;
			}else{
				$arr[$key]['pinyin'] =$val['tag_name'];
			}
		}
		echojson(0,$arr);
	}

}


