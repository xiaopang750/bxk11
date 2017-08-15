<?php
/*description:发现好灵感
 *author:yanyalong
 *date:2013/07/31
 */
class Find extends Temp_Controller {
	function __construct(){
		parent::__construct();
	}
	//发现好灵感灵感展示页	
	function index(){ 
		
		$this->load->view('/index/find/inspir');
	}
	//发现好灵感内容
	function star(){
		safeFilter();
		$user_id = $_SESSION['user_id'];
		$p= $this->input->post('p',true);
		//获取我订阅的标签	
		$this->load->model('Bxk_tag_take_model');
		$taglist= $this->Bxk_tag_take_model->gettag_take($user_id);
		$this->load->model('Bxk_content_model');
		//获取某段时间内我订阅标签下发布灵感的用户	
		if($taglist!=''){
			$user_idarr= $this->Bxk_content_model->user_bytagtime(trim($taglist,','),$user_id,time(),$p,5);
		}else{
			//获取热度最高的标签
			$this->load->model('Bxk_content_tag_model');
			$hottag_id = $this->Bxk_content_tag_model->hottag();
			if($hottag_id==''){
				echojson(0,'无相关数据');
			}
			$user_idarr= $this->Bxk_content_model->user_bytagtime($hottag_id,$user_id,time(),$p,5);
		}
		if(empty($user_idarr['list'])){
			echojson(0,'无相关数据');
		}

		$this->config->load('url');
		$config = $this->config->item('url');
		//循环获取每位用户发布的灵感列表,取前四篇
		foreach ($user_idarr['list'] as $key=>$val) {
			$tag_contentlist[$key]['list'] = $this->Bxk_content_model->findcontentlist($val,1,4);
			$userinfo = model('Bxk_user_model')->userinfo($val);
			$tag_contentlist[$key]['user_pic'] = model('Bxk_user_info_model')->avatar($val);
			$tag_contentlist[$key]['user_id'] = $val;
			$tag_contentlist[$key]['userspace'] = $config['userspace'].$val;
			$tag_contentlist[$key]['user_nickname'] = $userinfo['user_nickname'];
			$tag_contentlist[$key]['tag_take'] = model('Bxk_tag_take_model')->gettag_take($val);
			$tag_contentlist[$key]['allpage'] = $user_idarr['allpage'];
			$usersublist = model("bxk_tag_take_model")->find_sublist($val); 
			$tag_contentlist[$key]['usersublist'] = ($usersublist!=false)?$usersublist:'';
		}
		if(empty($tag_contentlist)){
			echojson(0,'无相关数据');
		}else{
			echojson(1,$tag_contentlist);
		}
	}
	/**
	 *description:猜你喜欢，随机获取系统推荐主题
	 *author:yanyalong
	 *date:2013/08/28
	 */
	public function guess(){
		$this->load->model('Bxk_system_model');
		$tags = $this->Bxk_system_model->theme_recommend(15);
		if(empty($tags)){
			echojson(0,'无相关数据');
		}else{
			echojson(1,$tags);
		}
	}
}


