<?php
class Content extends User_Controller {

	function __construct(){
		parent::__construct();
		$this->ajax_checklogin();
	}
	/**
	 *description:添加一条评论
	 *author:yanyalong
	 *date:2013/11/07
	 */
	public function adddiscu(){
		safeFilter();
		$_POST = disableCheck();
		$this->load->model('t_content_discussion_model');
		$content_id = $this->input->post('cid');
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		loadLib("Score_Class");
		$Score_Class = new Score_Class($user_id,"discussion_add");
		if($Score_Class->checkScore()==false){
			echojson(1,'',"积分不足");
		}			
		$disc_con = $this->input->post('disc_con');
		$disc_id = $this->t_content_discussion_model->manage($content_id,$user_id,$disc_con);
		$content = model("t_content")->get($content_id);
		$is_black = model("t_user_disable")->is_black($content->user_id,$user_id);	
		if($is_black=='1'){
			echojson(1,"",'根据对方设置，您无法进行该操作');
		}
		if($disc_id!=false){
			if($Score_Class->checkMax()==true){
				$Score_Class->modScore();
			}			
			$discinfo = $this->t_content_discussion_model->new_disc($disc_id);		
			$discinfo['disc_num'] = model('t_content_discussion')->count_num($content_id);
			model("t_user")->user_status($user_id,'user_discussions','+');
			loadLib("Notice");
			$notice = new Notice("GetNoticeByDisc",$user_id,$content_id,1);
			loadLib("User_Feed");
			new Feed("GetFeedByDiscContent",$user_id,$content_id);
			echojson(0,$discinfo);
		}else{
			echojson(1,"","评论失败");
		}
	}
	/**
	 *description:发表回复
	 *author:yanyalong
	 *date:2013/08/20
	 */
	public	function addreply()
	{	
		safeFilter();
		$_POST = disableCheck();
		$disc_pid= $this->input->post('did',true);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		loadLib("Score_Class");
		$Score_Class = new Score_Class($user_id,"discussion_add");
		if($Score_Class->checkScore()==false){
			echojson(1,'',"积分不足");
		}			
		$disc_con = $this->input->post('reply_str',true);
		$this->load->model('t_content_discussion_model');
		$res = $this->t_content_discussion_model->new_disc($disc_pid);		
		$content = model("t_content")->get($res['content_id']);
		$is_black = model("t_user_disable")->is_black($content->user_id,$user_id);	
		if($is_black=='1'){
			echojson(1,"",'根据对方设置，您无法进行该操作');
		}
		$disc_id = $this->t_content_discussion_model->reply($user_id,$disc_con,$disc_pid);
		if($disc_id==false){
			echojson(1,"","回复失败");
		}else{
			if($Score_Class->checkMax()==true){
				$Score_Class->modScore();
			}			
			$discinfo = $this->t_content_discussion_model->new_disc($disc_id);		
			loadLib("Notice");
			$notice = new Notice("GetNoticeByReply",$user_id,$disc_id,1);
			$discinfo['disc_num'] = model('t_content_discussion')->count_num($discinfo['content_id']);
			model("t_user")->user_status($user_id,'user_discussions','+');
			loadLib("User_Feed");
			new Feed("GetFeedByReplyContent",$user_id,$discinfo['content_id']);
			echojson(0,$discinfo,"回复成功");
		}
	}
	/**
	 *description:删除一条博文
	 *author:yanyalong
	 *date:2013/11/07
	 */
	public function delcontent(){
		safeFilter();
		$content_id = $this->input->post('cid',true);
		$user_id = $_SESSION['user_id'];
		$this->load->model('t_content_model');
		$delcontent= $this->t_content_model->manage_contents($content_id,11);
		if($delcontent!='0'){
			model("t_user")->user_status($user_id,'user_content','-');
			echojson(0,"",'删除成功');
		}else{
			echojson(1,"",'删除失败');
		}
	}
	/**
	 *description:编辑灵感博文
	 *author:yanyalong
	 *date:2013/11/08
	 */
	public function editdesign(){
		safeFilter();
		$user_id = $_SESSION['user_id'];
		loadLib("Content_Class");
		$Content_Class = new Content_Class();	
		$content_title= $this->input->post('content_title',true);
		$content_content= $this->input->post('content_content',true);
		$content_content= $Content_Class->replace_str($content_content);
		$tag_idlist= $this->input->post('tag_idlist',true);
		$tag_namelist= $this->input->post('tag_namelist',true);
		$imgname= $this->input->post('imgname',true);
		$content_id= $this->input->post('cid',true);
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
		$score++; 
		$content_img = "[img]".$countimg."{";
		foreach ($picinfo as $key=>$val) {
			$content_img .= $val.',';
		}
		$content_img  =trim($content_img,',');
		$content_img .="}[/img]";
		//删除灵感标签
		model("t_content_tag")->delContentTags($content_id);
		//插入灵感记录
		if($content_content==""){
			$content_content = " ";	
		}
		$content_content = "[content]".$content_content."[/content]".$content_img;
		$editflag = model('t_content')->content_edit($content_id,$tag_idlist,$tag_namelist,$content_title,$content_content);
		if($editflag==true){
			//记录积分事件
			$score++; 
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
			model("t_user")->user_status($user_id,'user_vailable_score','+',$score);
			model("t_user")->user_status($user_id,'user_score','+',$score);
			if(!empty($tag_idlist)){
				$res = model('t_content_tag')->content_tags_add(trim($tag_idlist,','),$content_id);
				if($res){
					echojson(0,"","编辑成功");
				}else{
					echojson(1,"","编辑失败");
				}
			}
		}else{
			echojson(1,"","编辑失败");
		}	
	}
	/**
	 *description:编辑家居美图
	 *author:yanyalong
	 *date:2013/11/08
	 */
	public function editproduct(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(1,'','未登录');
		}
		safeFilter();
		$_POST = disableCheck();
		loadLib("Content_Class");
		$Content_Class = new Content_Class();	
		$content_title= $this->input->post('content_title',true);
		$content_content= $this->input->post('content_content',true);
		$content_content= $Content_Class->replace_str($content_content);
		$tag_idlist= $this->input->post('tag_idlist',true);
		$tag_namelist= $this->input->post('tag_namelist',true);
		$imgname= $this->input->post('imgname',true);
		$pin= $this->input->post('pin',true);
		$content_id = $this->input->post('cid',true);
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
		foreach ($imginfo as $key=>$val) {
			$pic_content = $Content_Class->replace_str($val[1]);
			$pic_id = model("t_pic")->pic_add($config['upload_path'].$val[0],$user_id,$pic_content);
			$picinfo[] = $pic_id.':'.$val[0].':'.$pic_content;
			if(!empty($pinarr)){
				model("t_pic_pin")->delPicPins($pic_id);
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
					$score--;
				}
			}
			$countimg++;
		}
		//记录积分事件
		$score++; 
		$content_img = "[img]".$countimg."{";
		foreach ($picinfo as $key=>$val) {
			$content_img .= $val.',';
		}
		$content_img  =trim($content_img,',');
		$content_img .="}[/img]";
		//删除灵感标签
		model("t_content_tag")->delContentTags($content_id,$tag_idlist);
		//插入灵感记录
		if($content_content==""){
			$content_content = " ";	
		}
		$content_content = "[content]".$content_content."[/content]".$content_img;
		$editflag = model('t_content')->content_edit($content_id,$tag_idlist,$tag_namelist,$content_title,$content_content);
		if($editflag==true){
			//记录积分事件
			$score++; 
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
			model("t_user")->user_status($user_id,'user_vailable_score','+',$score);
			model("t_user")->user_status($user_id,'user_score','+',$score);
			if(!empty($tag_idlist)){
				$res = model('t_content_tag')->content_tags_add(trim($tag_idlist,','),$content_id);
				if($res){
					echojson(0,"","编辑成功");
				}else{
					echojson(1,"","编辑失败");
				}
			}
		}else{
			echojson(1,"","编辑失败");
		}	
	}

	/**
	 *description:博文有用无用
	 *author:baohanbin
	 *date:2013/11/07
	 */
	public function useful()
	{
		safeFilter();
		$user_id = $_SESSION['user_id'];
		$content_id = $this->input->post('cid',true);
		$this->load->model('t_user_content_recommend_model');
		$this->t_user_content_recommend_model->user_id = $user_id;
		$this->t_user_content_recommend_model->content_id = $content_id;
		$this->t_user_content_recommend_model->recommend_reason = '';
		$obj = $this->t_user_content_recommend_model->get_id($user_id,$content_id);
		if($obj)
		{
			$res = $this->t_user_content_recommend_model->del($user_id,$content_id);
			if($res!=false)
			{
				$this->load->model('t_content_model');
				$mes = $this->t_content_model->del_recommend($content_id);
				$this->load->model('t_user_model');
				$nes = $this->t_user_model->del_recommend($user_id);
				echojson(0,"",'取消推荐成功');
			}
			else
			{
				echojson(1,"",'取消推荐失败');
			}
		}
		else
		{
			$res = $this->t_user_content_recommend_model->insert();
			if($res!=false)
			{
				$this->load->model('t_content_model');
				$mes = $this->t_content_model->up_recommend($content_id);
				$this->load->model('t_user_model');
				$nes = $this->t_user_model->up_recommend($user_id);

				echojson(0,"",'推荐成功');
			}
			else
			{
				echojson(1,"",'推荐失败');
			}
		}
	}
	/**
	 *description:喜欢、取消喜欢
	 *author:yanyalong
	 *date:2013/11/08
	 */
	public function like(){
		safeFilter();
		$content_id = $this->input->post('cid');
		$user_id = $_SESSION['user_id'];	
		loadLib("Score_Class");
		$Score_Class = new Score_Class($user_id,"like_add");
		if($Score_Class->checkScore()==false){
			echojson(1,'',"积分不足");
		}			
		$this->load->model('t_user_like_model');				
		$is_like = $this->t_user_like_model->is_like($content_id,$user_id);	
		$this->t_user_like_model->content_id = $content_id;
		$this->t_user_like_model->user_id = $user_id;
		if($is_like=="1"){
			if($this->t_user_like_model->dellike()!=false){
				model("t_user")->user_status($user_id,'user_likes','-');
				model("t_content")->content_status($content_id,'content_likes','-');
				echojson(0,"",'取消喜欢成功');
			}else{
				echojson(1,"",'取消喜欢失败');
			}												
		}else{
			if($this->t_user_like_model->insert()!=false){
				if($Score_Class->checkMax()==true){
					$Score_Class->modScore();
				}			
				model("t_user")->user_status($user_id,'user_likes','+');
				model("t_content")->content_status($content_id,'content_likes','+');
				loadLib("Notice");
				$notice = new Notice("GetNoticeByLikes",$user_id,$content_id,"1","","","");
				loadLib("User_Feed");
				new Feed("GetFeedByLikeContent",$user_id,$content_id);
				echojson(0,"",'喜欢成功');
			}else{
				echojson(1,"",'喜欢失败');
			}
		}
	}
}


