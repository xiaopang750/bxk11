<?php
class userset extends User_Controller { 
	function __construct(){
		parent::__construct();
	}
	/**
	 *description:个人设置数据
	 *author:yanyalong
	 *date:2013/11/14
	 */
	public function index(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$district_pid= $this->input->post('pid',true);
		$district_id= $this->input->post('cid',true);
		if($user_id==""){
			echojson(1,'无相关数据');
		}
		$res = model("t_user")->userfull($user_id);
		$modify['user_nickname']=$res->user_nickname;
		$modify['user_email']=$res->user_email;
		$modify['user_pic']=model("t_user_info")->avatar($res->user_id);
		$modify['user_noticeoptions']= $res->user_noticeoptions;
		$modify['user_mailoptions']= $res->user_mailoptions;
		$modify['user_qqid']= $res->user_qqid;
		$modify['user_weixinid']= $res->user_weixinid;
		$modify['user_sinaweiboid']= $res->user_sinaweiboid;
		$modify['user_renrenid']= $res->user_renrenid;
		$modify['user_163id']= $res->user_163id;
		$modify['user_id']= $res->user_id;
		$modify['user_address']= $res->user_address;
		$this->load->model("t_system_district_model");
		$this->t_system_district_model->district_pid = 0;
		$province = $this->t_system_district_model->getbypid();
		if($res->provinceid!=""&&$res->provinceid!=null){
			foreach ($province as $key=>$val) {
				if(in_array($res->provinceid,$val)){
					$province[$key]['select'] = "1";	
				}
				continue;
			}
			$this->t_system_district_model->district_pid = $res->provinceid;
			$city = $this->t_system_district_model->getbypid();
			if($res->cityid!=""&&$res->cityid!=null){
				foreach ($city as $key=>$val) {
					if(in_array($res->cityid,$val)){
						$city[$key]['select'] = "1";	
					}
					continue;
				}
			}	
		}else{
			$city = "";		
		}
		$modify['province'] = $province;
		$modify['city'] = $city;
		echojson(0,$modify);
	}
	/**
	 *description:私信列表数据
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function msglist(){
		safeFilter();
		$this->load->model('t_user_msg_model');
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(1,'无相关数据');
		}
		$type = $this->input->post('type',true);
		$arr['list']=$this->t_user_msg_model->mymsg($user_id,$type);
		$arr['view_nums']=$this->t_user_msg_model->view_nums($user_id);
		if(!empty($arr['list'])){
			echojson(0,$arr);
		}else{
			echojson(1,'无相关数据');
		}
	}
	/**
	 *description:私信详情页
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function msg(){

		safeFilter();
		$this->load->model('t_user_msg_model');
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(1,'无相关数据');
		}
		$msg_user_id= $this->input->post('mid',true);
		$arr=$this->t_user_msg_model->msginfo($user_id,$msg_user_id);
		if(!empty($arr)){
			//标记已读
			$this->t_user_msg_model->view_msg($msg_user_id,$user_id);
			echojson(0,$arr);
		}else{
			echojson(1,'无相关数据');
		}
	}

	/**
	 *description:最新五条通知
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function topnotice(){
		if(isset($_SESSION['notice_show'])&&$_SESSION['notice_show']=='1'){
			$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
			if($user_id==""){
				echojson(1,"",'无相关数据');
			}
			$notice_list= model('t_user_notice')->getnotice($user_id,1,5);
			if(!empty($notice_list)){
				echojson(0,$notice_list);
			}else{
				echojson(1,"",'无相关数据');
			}
		}else{
			echojson(1,"",'无相关数据');
		}
	}
	/**
	 *description:获取用户黑名单列表
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function blacklist(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(1,'无相关数据');
		}
		$blacklist = model("t_user_disable")->blacklist($user_id,1);
		if($blacklist!=false){
			echojson(0,$blacklist);
		}else{
			echojson(1,"",'无相关数据');
		}	
	}
	/**
	 *description:我的粉丝列表
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function fanslist(){
		safeFilter();
		$this->load->model('t_user_follow_model');
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(1,'无相关数据');
		}
		$p= $this->input->post('p');
		$arr=$this->t_user_follow_model->dis_fan($user_id,$p,2);
		if($arr!=false){
			echojson(0,$arr);
		}else{
			echojson(1,"",'无相关数据');
		}
	}
	/**
	 *description:我的关注列表
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function followlist(){
		safeFilter();
		$this->load->model('t_user_follow_model');
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(1,'无相关数据');
		}

		$p = $this->input->post('p',true);
		$arr = $this->t_user_follow_model->myfollows($user_id,$p,10);
		if($arr!=false){
			echojson(0,$arr);
		}else{
			echojson(1,'','无关注用户');
		}
	}
	/**
	 *description:通知页面数据
	 *author:yanyalong
	 *date:2013/11/11
	 */
	public function noticelist(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(1,'无相关数据');
		}

		$this->load->model('t_user_notice_model');
		$notice_list= $this->t_user_notice_model->getnotice($user_id,1,5);
		if(!empty($notice_list)){
			$this->t_user_notice_model->delnotice($user_id,5);
			echojson(0,$notice_list);
		}else{
			echojson(1,"",'无相关数据');
		}
	}
	/**
	 *description:发现好灵感页面数据
	 *author:yanyalong
	 *date:2013/11/12
	 */
	public function discovery(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(1,'无相关数据');
		}
		$p= $this->input->post('p',true);
		//获取我订阅的标签	
		$this->load->model('t_tag_take_model');
		$taglist= $this->t_tag_take_model->gettag_take($user_id);
		$this->load->model('t_content_model');
		//获取某段时间内我订阅标签下发布灵感的用户	
		if($taglist!=''){
			$user_idarr= $this->t_content_model->user_bytagtime(trim($taglist,','),$user_id,time(),$p,5);
		}else{
			//获取热度最高的标签
			$this->load->model('t_content_tag_model');
			$hottag_id = $this->t_content_tag_model->hottag();
			if($hottag_id==''){
				echojson(1,'无相关数据');
			}
			$user_idarr= $this->t_content_model->user_bytagtime($hottag_id,$user_id,time(),$p,5);
		}
		if(empty($user_idarr['list'])){
			echojson(1,'无相关数据');
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		//循环获取每位用户发布的灵感列表,取前四篇
		foreach ($user_idarr['list'] as $key=>$val) {
			$this->t_content_model->user_id = $val;
			$list = $this->t_content_model->getbyuser(4,0);
			foreach ($list as $keys=>$vals) {
				$content = model("t_content")->content_analytic($vals->content_content);
				if($vals->content_type=="1"){
					$tag_contentlist[$key]['pic_list'][$keys]['url'] = $config['contenturl'].$vals->content_id;
				}else{
					$tag_contentlist[$key]['pic_list'][$keys]['url'] = $config['producturl'].$vals->content_id;
				}
				if(is_array($content['pic_md5'])){
					foreach ($content['pic_md5'] as $keyss=>$valss) {
						$tag_contentlist[$key]['pic_list'][$keys]['pic'] = $valss['thumb_3'];
					}
				}
			}
			$userinfo = model('t_user')->userinfo($val);
			$tag_contentlist[$key]['user_pic'] = model('t_user_info')->avatar($val);
			$tag_contentlist[$key]['user_id'] = $val;
			$tag_contentlist[$key]['userspace'] = $config['userspace'].$val;
			$tag_contentlist[$key]['nickname'] = $userinfo['user_nickname'];
			$usersublist = model("t_tag_take")->find_sublist($val); 
			$tag_contentlist[$key]['tags'] = ($usersublist!=false)?$usersublist:'';
		}
		echojson(0,$tag_contentlist);
	}
	/**
	 *description:合作登录
	 *author:yanyalong
	 *date:2014/01/20
	 */
	public function  sina_login(){
		include_once( './login/sina/config.php' );
		include_once( './login/sina/saetv2.ex.class.php' );
		$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
		$data['sina_url']= $o->getAuthorizeURL( WB_CALLBACK_URL );
		echojson(0,$data);
	}
	
}


