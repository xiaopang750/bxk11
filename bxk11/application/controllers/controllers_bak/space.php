<?php
/*description:灵感模块控制
 *author:yanyalong
 *date:2013/07/28
 */
class Space extends Temp_Controller {
	function __construct(){
		parent::__construct();
	}
	//个人空间首页
	function index(){ 
		$this->load->view('/index/user/personal');
	}
	//个人主页首页内容
	public function spaceinfo(){
		
		$user_id = $_SESSION['user_id'];
		$this->load->model('Bxk_content_model');
		//获取当前用户最新一篇灵感
		$contentinfo['mynew'] = $this->Bxk_content_model->mycontentnew($user_id);
		if($contentinfo['mynew']!=false){
			echojson(1,$contentinfo);
		}else{
			echojson(0,'无相关数据');
		}
	}
	/**
	 *description:个人主页我关注用户的最新灵感，若未关注任何人则展示我订阅的主题的最新灵感，若未订阅任何主题，则为空
	 *author:yanyalong
	 *date:2013/08/24
	 */
	public function myfollow(){
		
		$user_id = $_SESSION['user_id'];
		$p= $this->input->post('p',true);
		$this->load->model('Bxk_content_model');
		$Bxk_user_follow_model= model('Bxk_user_follow_model');
		$follow_userlist = $Bxk_user_follow_model->myfollow($user_id);
		if($follow_userlist==false){
			//获取我的订阅列表
			$this->load->model('Bxk_content_tag_model');
			$contentlist = $this->Bxk_content_tag_model->get_tag_content($user_id,$p,5);			
		}else{
			//获取我关注用户的信息
			$contentlist = $this->Bxk_content_model->myfollowcontent($follow_userlist,$user_id,$p,5);			
		}
		if(!empty($contentlist)){
			echojson(1,$contentlist);
		}else{
			echojson(0,'无相关数据');
		}
	}
	//个人空间灵感列表展示页内容
	public function content_listinfo(){
		$user_id= isset($_POST['user_id'])?$this->input->post('user_id',true):'';
		if($user_id==''||$user_id=='undefined'){
			echojson(0,'无相关数据');
		}
		$p= $this->input->post('p',true);
		$this->load->model('Bxk_user_info_model');
		$this->config->load('url');
		$config = $this->config->item('url');
		$content['userspace'] = $config['userspace'].$user_id;
		$this->load->model('Bxk_content_model');
		$content['list'] = $this->Bxk_content_model->mycontentlist($user_id,$p,6);
		$content['concount'] = ceil(count($this->Bxk_content_model->my_contentall($user_id))/6);
		if(!empty($content['list'])){
			echojson(1,$content);
		}else{
			echojson(0,'无相关数据');
		}
	}
	/**
	 *description:获取用户基本信息
	 *author:yanyalong
	 *date:2013/09/10
	 */
	public function userinfo(){
		$user_id= isset($_POST['user_id'])?$this->input->post('user_id',true):'';
		if($user_id=='undefined'||$user_id==''){
			$content_id= $this->input->post('content_id',true);
			$contentinfo = model("Bxk_content_model")->content($content_id);
			$user_id = $contentinfo['user_id'];
		}else{
			$user_id = $this->input->post('user_id',true);
		}
		$userinfo = model('Bxk_user_model')->userinfo($user_id);
		if(empty($userinfo)){
			echojson(0,'无相关数据');
		}else{
			$myuser_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
			$userinfo['is_myfollow'] = model('Bxk_user_follow_model')->is_follow($myuser_id,$user_id);
			$userinfo['avatar'] = model('Bxk_user_info_model')->avatar($user_id,'m');
				$this->config->load('url');
				$config = $this->config->item('url');
			$userinfo['userspace'] = $config['userspace'].$user_id;
		}
		echojson(1,$userinfo);
	}
	//个人空间我发布的灵感列表展示页面
	public function mycontent(){
		
		$this->load->view('/index/publish/my_publish');
	}
	//个人空间我发布的灵感列表页内容
	public function mycontentlist(){
		$user_id = $_SESSION['user_id'];
		$p= $this->input->post('p',true);
		$this->load->model('Bxk_user_info_model');
		$content['avatar'] = $this->Bxk_user_info_model->avatar($user_id,'m');
		$this->load->model('Bxk_content_model');
		$content['list'] = $this->Bxk_content_model->mycontentlist($user_id,$p,4);
		if(empty($content['list'])){
			echojson(0,'无相关数据');
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		$content['userspace'] = $config['userspace'].$user_id;
		if(!empty($content)){
			echojson(1,$content);
		}else{
			echojson(0,'无相关数据');
		}
	}
	//个人空间灵感内容展示页
	public function content(){	
		$this->load->view('/index/publish/my_publish_detail');
	}
	//个人空间灵感内容页内容
	public function contentinfo(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$content_id= $this->input->post('content_id',true);
		$this->load->model('Bxk_content_model');
		$contentinfo = $this->Bxk_content_model->content($content_id);
		if($contentinfo==false){
			echojson(0,'无相关数据');
		}
		$userinfo = model('Bxk_user_model')->userinfo($contentinfo['user_id']);
		$contentinfo['user_pic'] = model('Bxk_user_info_model')->avatar($contentinfo['user_id']);
		$contentinfo['user_nickname'] = $userinfo['user_nickname'];
		if($user_id!=''){
		$contentinfo['is_myfollow'] = model('Bxk_user_follow_model')->is_follow($user_id,$contentinfo['user_id']);
		$contentinfo['is_mylike'] = model('Bxk_user_like_model')->is_like($content_id,$user_id);
		$contentinfo['is_myrecommend'] = model('User_content_recommend_model')->is_recommend($content_id,$user_id);
		$contentinfo['is_mydisable'] = model('Bxk_user_disable_model')->is_black($user_id,$contentinfo['user_id']);
		}else{
		$contentinfo['is_myfollow'] = "0";
		$contentinfo['is_mylike'] = "0";
		$contentinfo['is_myrecommend'] = "0";
		$contentinfo['is_mydisable'] ="0";
		}
		$contentinfo['hotinfo'] = model('Bxk_content_model')->hotinfo($content_id,1,5);
		$contentinfo['disc_num'] = model('Bxk_content_discussion_model')->count_num($content_id);
		$this->config->load('url');
		$config = $this->config->item('url');
		$contentinfo['userspace'] = $config['userspace'].$contentinfo['user_id'];
		$contentinfo['content_tag'] = model('bxk_tag_model')->gettaglist_url($contentinfo['content_tag']);
		if(!empty($contentinfo)){
			echojson(1,$contentinfo);
		}else{
			echojson(0,'无相关数据');
		}
	}
	/**
	 *description:获取当前博文的上下篇灵感
	 *author:yanyalong
	 *date:2013/09/11
	 */
	public function pl_content(){
		$content_id= $this->input->post('content_id',true);
		$contentinfo = model('Bxk_content_model')->content($content_id);
		if($contentinfo==false){
			echojson(1,'无相关数据');
		}
		$pl_content = model('Bxk_content_model')->pl_content($contentinfo['user_id'],$content_id);
		echojson(1,$pl_content);
	}
	/**
	 *description:获取博文评论内容
	 *author:yanyalong
	 *date:2013/08/27
	 */
	public function getdisc(){
		$p= $this->input->post('p',true);
		$content_id= $this->input->post('cid',true);
		$this->load->model('Bxk_content_discussion_model');
		$contentinfo = $this->Bxk_content_discussion_model->content_show($content_id,$p,10);
		if(!empty($contentinfo)){
			echojson(1,$contentinfo);
		}else{
			echojson(0,'暂无任何评论');
		}
	}
	//个人空间灵感搜索功能
	public function search(){
		$user_id = $_SESSION['user_id'];
		$keywords= isset($_POST['keywords'])?$this->input->post('keywords',true):'';
		$this->load->model('Bxk_content_model');
		$bloglist = $this->Bxk_content_model->blog_search($keyword,$user_id);
		if(!empty($bloglist)){
			echojson(1,$bloglist);
		}else{
			echojson(0,'无相关数据');
		}
	}
	/**
	 *description:修改灵感博文状态
	 *author:yanyalong
	 *date:2013/08/15
	 */
	public function manage_content(){
				
		$content_id= $this->input->post('content_id',true);
		$content_status= $this->input->post('status',true);
		$this->load->model('Bxk_content_model');
		$delcontent= $this->Bxk_content_model->manage_contents($content_id,$content_status);
		if($delcontent!='0'){
			echojson(1,'修改成功');
		}else{
			echojson(0,'修改失败');
		}
	}
	/**
	 *description:关注一个人
	 *author:yanyalong
	 *date:2013/08/21
	 */
	public function follow(){
				
		$user_id = $_SESSION['user_id'];
		$follow_uid =  $this->input->post('follow_uid',true);
		if($follow_uid==$user_id){
			echojson(0,'不能关注自己');
		}
		$this->load->model('Bxk_user_follow_model');
		$res = $this->Bxk_user_follow_model->follow($user_id,$follow_uid);
		if($res!=false){
			model("bxk_user_model")->user_status($user_id,'user_follows','+');
			model("bxk_user_model")->user_status($follow_uid,'user_fans','+');
			//给被关注者发通知
			include_once $_SERVER['DOCUMENT_ROOT']."/application/libraries/Notice.php";
			$noticearr = array('notice_type' =>3,'from_user_id'=>$user_id,'to_user_id'=>$follow_uid);
			$noticeobj = new Notice($noticearr);
			$noticeobj->ContextInterface();
			echojson(1,'关注成功');
		}else{
			echojson(0,'关注失败');
		}
	}
	/**
	 *description:移除粉丝
	 *author:yanyalong
	 *date:2013/08/21
	 */
	public function del_fans(){
				
		$user_id = $_SESSION['user_id'];
		$follow_uid =  $this->input->post('follow_uid',true);
		$this->load->model('Bxk_user_follow_model');
		$res = $this->Bxk_user_follow_model->del_follow($follow_uid,$user_id);

		if($res!=false){	
			model("bxk_user_model")->user_status($user_id,'user_fans','-');
			model("bxk_user_model")->user_status($follow_uid,'user_follows','-');
			echojson(1,'取消成功');
		}else{
			echojson(0,'取消失败');
		}
	}

	/**
	 *description:取消关注
	 *author:yanyalong
	 *date:2013/08/21
	 */
	public function del_follow(){
				
		$user_id = $_SESSION['user_id'];
		$follow_uid =  $this->input->post('follow_uid',true);
		$this->load->model('Bxk_user_follow_model');
		$res = $this->Bxk_user_follow_model->del_follow($user_id,$follow_uid);
		if($res!=false){	
			model("bxk_user_model")->user_status($user_id,'user_follows','-');
			model("bxk_user_model")->user_status($follow_uid,'user_fans','-');
			echojson(1,'取消成功');
		}else{
			echojson(0,'取消失败');
		}
	}
	/**
	 *description:取消关注
	 *author:yanyalong
	 *date:2013/08/21
	 */
	//public function del_follow(){
		//		
		//$user_id = $_SESSION['user_id'];
		//$follow_uid =  $this->input->post('follow_uid',true);
		//$this->load->model('Bxk_user_follow_model');
		//$res = $this->Bxk_user_follow_model->del_follow($user_id,$follow_uid);

		//if($res!=false){	
			//model("bxk_user_model")->user_status($user_id,'user_fans','-');
			//model("bxk_user_model")->user_status($follow_uid,'user_follows','-');
			//echojson(1,'取消成功');
		//}else{
			//echojson(0,'取消失败');
		//}
	//}



	/**
	 *description:获取灵感热度详情
	 *author:yanyalong
	 *date:2013/09/17
	 */
	public function hotinfo(){
		$content_id= $this->input->post('content_id',true);
		$p= $this->input->post('p',true);
		$hotinfo = model('Bxk_content_model')->hotinfo($content_id,$p,10);
		if($hotinfo!=false){
			echojson(1,$hotinfo);
		}else{
			echojson(0,'无相关数据');
		}
	}
	/**
	 *description:获取用户基本信息
	 *author:yanyalong
	 *date:2013/09/24
	 */
	public function user_info(){
		$user_id=isset($_POST['user_id'])?$this->input->post('user_id',true):'';
		if($user_id==''){
			echojson(0,'无相关数据');
		}else{
			$userinfo = model('bxk_user_model')->userinfo($user_id);	
			if(empty($userinfo)){
				echojson(0,'无相关数据');
			}else{
				$userinfo['user_pic'] = model('bxk_user_info_model')->avatar($user_id);
				$this->config->load('url');
				$config = $this->config->item('url');
				$userinfo['userspace'] = $config['userspace'].$user_id;
				echojson(1,$userinfo);
			}
		}

	}

	public function test(){
		loadLib("Notice");
		$notice = new Notice("GetNoticeByShare",2,136,1);
		if(is_object($notice)){
			echojson(0,'添加通知成功');
		}else{
			echojson(1,'添加通知失败');
		}
	}
}


