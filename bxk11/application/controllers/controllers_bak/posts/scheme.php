<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scheme extends User_Controller {
	public $roomlib_class; 
	function __construct(){
		parent::__construct();
		//$this->ajax_checklogin();
	}

	/**
	 *description:生成方案
	 *author:yanyalong
	 *date:2013/12/19
	 */
	public function addscheme(){
		safeFilter();
		$_POST = disableCheck();
		loadLib("Scheme_Class");
		SchemeCheckFactory::createObj($_POST,'mod');	
		$scheme_name= isset($_POST['scheme_name'])?$this->input->post('scheme_name',true):'';
		$scheme_type = isset($_POST['scheme_type'])?$this->input->post('scheme_type',true):'';
		$scheme_cost= isset($_POST['scheme_cost'])?$this->input->post('scheme_cost',true):'';
		$scheme_thinking= isset($_POST['scheme_thinking'])?$this->input->post('scheme_thinking',true):'';
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$nick_name = isset($_SESSION['user_nickname'])?$_SESSION['user_nickname']:"";
		$project_id= isset($_POST['pid'])?$this->input->post('pid',true):'';
		//$project_id = 18;
		$project = model("t_project")->get($project_id);
		//$scheme_name = "1dsfdsfdsf".rand(1,10000);
		//$scheme_type = 1;
		//$scheme_cost = 12312;
		//$scheme_thinking ="12312321312asdsadsa";

		if($project==false){
			echojson(1,"","异常操作");
		}
		$this->load->model('t_project_scheme_model');
		$this->t_project_scheme_model->project_id= $project_id;
		$this->t_project_scheme_model->user_id= $user_id;
		$this->t_project_scheme_model->apartment_id= $project->apartment_id;
		$this->t_project_scheme_model->house_id= $project->house_id;
		$this->t_project_scheme_model->scheme_type= $scheme_type;
		$this->t_project_scheme_model->scheme_name= $scheme_name;
		$this->t_project_scheme_model->scheme_cost= $scheme_cost;
		$this->t_project_scheme_model->scheme_user_type=2;
		$this->t_project_scheme_model->scheme_thinking= $scheme_thinking;
		$this->t_project_scheme_model->scheme_designer_id= $user_id;
		$this->t_project_scheme_model->scheme_designer=$nick_name;
		$this->t_project_scheme_model->scheme_status=21;
		$scheme_id= $this->t_project_scheme_model->insert();	
		if($scheme_id!=false){
			$this->load->model('t_project_floor_model');
			$this->t_project_floor_model->scheme_id= $scheme_id;
			$floor_id = $this->t_project_floor_model->insert();	
			if($floor_id!=false){
				$data['scheme_id']= $scheme_id;
				$data['floor_id']= $floor_id;
				echojson(0,$data);
			}else{
				echojson(1,"","创建失败");
			}
		}else{
			echojson(1,"","创建失败");
		}
	}

	/**
	 *description:更新装修案例提交
	 *author:yanyalong
	 *date:2013/12/15
	 */

	public function release(){
		safeFilter();
		$scheme_status= $this->input->post('scheme_status');
		if(!in_array($scheme_status,array(1,21))){
			echojson(1,"","异常操作");
		}
		$scheme_id= $this->input->post('scheme_id');
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";

		//删除当前案例旧标签关联数据
		$this->load->model('t_project_scheme_tag_model');
		$this->t_project_scheme_tag_model->delTagByScheme($scheme_id);
		//获取当前案例下所有房间的标签id信息	
		$tag_idarr = $this->t_project_scheme_tag_model->TagListByScheme($scheme_id);
		foreach ($tag_idarr as $key=>$val) {
			$this->t_project_scheme_tag_model->tag_id= $val->tag_id;
			$this->t_project_scheme_tag_model->scheme_id= $scheme_id;
			$this->t_project_scheme_tag_model->insert();	
		}
		$this->load->model('t_project_scheme_model');
		$schemeinfo = $this->t_project_scheme_model->get($scheme_id);
		if($schemeinfo->scheme_type=='2'){
			//生成xml
			loadLib("Roomlib_Class");	
			$xmlaction_bak = new Roomlib_Class();
			$this->roomlib_class = $xmlaction_bak;
			$this->roomlib_class->xml3d($scheme_id);
		}
		//更新装修案例主表
		$this->load->model('t_project_scheme_model');
		$param = array('scheme_status'=>$scheme_status);
		$res = $this->t_project_scheme_model->upscheme($scheme_id,$param);	
		//插入下载积分设置表
		$this->load->model('t_project_scheme_downset_model');
		$this->t_project_scheme_downset_model->scheme_id= $scheme_id;
		$this->t_project_scheme_downset_model->downset_type= 1;
		$this->t_project_scheme_downset_model->downset_score= 10;
		$this->t_project_scheme_downset_model->insert();	
		echojson(0,'','执行成功');
	}
	/**
	 *description:删除案例
	 *author:yanyalong
	 *date:2013/12/17
	 */
	public function delScheme(){
		safeFilter();
		//检测案例id
		$scheme_id= isset($_POST['scheme_id'])?$this->input->post('scheme_id',true):'';
		if($scheme_id==""){
			echojson(0,'','取消成功');
		}
		//删除当前案例旧标签关联数据
		$this->load->model('t_project_scheme_model');
		$param = array('scheme_status'=>'99');
		$res = $this->t_project_scheme_model->upscheme($scheme_id,$param);	
		if($res==false){
			echojson(1,'','取消失败');
		}else{
			echojson(0,'','取消成功');
		}
	}
	/**
	 *description:检测方案名称是否已存在
	 *author:yanyalong
	 *date:2013/12/21
	 */
	public function checkscheme(){
		safeFilter();
		$scheme_name= isset($_POST['scheme_name'])?$this->input->post('scheme_name',true):'';
		$project_id = isset($_POST['pid'])?$this->input->post('pid',true):'';
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		//检测装修案例名称开始
		if(trim($scheme_name)==""){
			echojson(1,'','案例名称不能为空');
		}
		if((strlen(trim($scheme_name)) + mb_strlen(trim($scheme_name),'UTF8'))/2>50){
			echojson(1,"","方案名称不能超过25个字");
		}
		$is_exist = model("t_project_scheme")->is_has($scheme_name,$user_id,$project_id);
		if($is_exist!=false){
			echojson(1,'','本项目下已存在同名案例');
		}
		echojson(0,'','方案名称可用');
	}
	/**
	 *description:添加一条评论
	 *author:yanyalong
	 *date:2013/11/07
	 */
	public function adddiscu(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(2,"",'未登录');
		}
		safeFilter();
		$_POST = disableCheck();
		$this->load->model('t_scheme_discussion_model');
		$scheme_id = $this->input->post('sid');
		//$scheme_id= 708;
		//loadLib("Score_Class");
		//$Score_Class = new Score_Class($user_id,"discussion_add");
		//if($Score_Class->checkScore()==false){
		//echojson(1,'',"积分不足");
		//}			
		$disc_con = $this->input->post('disc_con');
		$disc_id = $this->t_scheme_discussion_model->manage($scheme_id,$user_id,$disc_con);
		$scheme= model("t_project_scheme")->get($scheme_id);
		$is_black = model("t_user_disable")->is_black($scheme->user_id,$user_id);	
		if($is_black=='1'){
			echojson(1,"",'根据对方设置，您无法进行该操作');
		}
		if($disc_id!=false){
			//if($Score_Class->checkMax()==true){
			//$Score_Class->modScore();
			//}			
			$discinfo = $this->t_scheme_discussion_model->new_disc($disc_id);		
			$discinfo['disc_num'] = model('t_scheme_discussion')->count_num($scheme_id);
			//model("t_user")->user_status($user_id,'user_discussions','+');
			//loadLib("Notice");
			//$notice = new Notice("GetNoticeByDisc",$user_id,$scheme_id,1);
			//loadLib("User_Feed");
			//new Feed("GetFeedByDiscContent",$user_id,$scheme_id);
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
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(2,"",'未登录');
		}
		safeFilter();
		$_POST = disableCheck();
		$disc_pid= $this->input->post('did',true);
		//$disc_pid = 3;
		//loadLib("Score_Class");
		//$Score_Class = new Score_Class($user_id,"discussion_add");
		//if($Score_Class->checkScore()==false){
		//echojson(1,'',"积分不足");
		//}			
		$disc_con = $this->input->post('reply_str',true);
		$this->load->model('t_scheme_discussion_model');
		$res = $this->t_scheme_discussion_model->new_disc($disc_pid);		
		$scheme= model("t_project_scheme")->get($res['scheme_id']);
		$is_black = model("t_user_disable")->is_black($scheme->user_id,$user_id);	
		if($is_black=='1'){
			echojson(1,"",'根据对方设置，您无法进行该操作');
		}
		$disc_id = $this->t_scheme_discussion_model->reply($user_id,$disc_con,$disc_pid);
		if($disc_id==false){
			echojson(1,"","回复失败");
		}else{
			//if($Score_Class->checkMax()==true){
			//$Score_Class->modScore();
			//}			
			$discinfo = $this->t_scheme_discussion_model->new_disc($disc_id);		
			//loadLib("Notice");
			//$notice = new Notice("GetNoticeByReply",$user_id,$disc_id,1);
			$discinfo['disc_num'] = model('t_scheme_discussion')->count_num($discinfo['scheme_id']);
			//model("t_user")->user_status($user_id,'user_discussions','+');
			//loadLib("User_Feed");
			//new Feed("GetFeedByReplyContent",$user_id,$discinfo['scheme_id']);
			echojson(0,$discinfo,"回复成功");
		}
	}
	/**
	 *description:喜欢、取消喜欢
	 *author:yanyalong
	 *date:2013/11/08
	 */
	public function like(){
		safeFilter();
		$scheme_id= $this->input->post('sid');
		//$scheme_id= 708;
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(2,"",'未登录');
		}
		//loadLib("Score_Class");
		//$Score_Class = new Score_Class($user_id,"like_add");
		//if($Score_Class->checkScore()==false){
		//echojson(1,'',"积分不足");
		//}			
		$this->load->model('t_like_scheme_model');				
		$is_like = $this->t_like_scheme_model->is_like($scheme_id,$user_id);	
		$this->t_like_scheme_model->scheme_id= $scheme_id;
		$this->t_like_scheme_model->user_id = $user_id;
		if($is_like=="1"){
			if($this->t_like_scheme_model->dellike()!=false){
				//model("t_user")->user_status($user_id,'user_likes','-');
				//model("t_content")->content_status($scheme_id,'content_likes','-');
				echojson(0,"",'取消喜欢成功');
			}else{
				echojson(1,"",'取消喜欢失败');
			}												
		}else{
			if($this->t_like_scheme_model->insert()!=false){
				//if($Score_Class->checkMax()==true){
				//$Score_Class->modScore();
				//}			
				//model("t_user")->user_status($user_id,'user_likes','+');
				//model("t_content")->content_status($scheme_id,'content_likes','+');
				//loadLib("Notice");
				//$notice = new Notice("GetNoticeByLikes",$user_id,$scheme_id,"1","","","");
				//loadLib("User_Feed");
				//new Feed("GetFeedByLikeContent",$user_id,$scheme_id);
				echojson(0,"",'喜欢成功');
			}else{
				echojson(1,"",'喜欢失败');
			}
		}
	}
	/**
	 *description:搬到我家
	 *author:yanyalong
	 *date:2013/12/25
	 */
	public function tomyhome(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(2,"",'未登录');
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		$house_city= $this->input->post('house_city');
		$scheme_id= isset($_POST['sid'])?$this->input->post('sid'):"";
		//$scheme_id = 708;
		$this->load->model("t_user_model");
		$this->load->model("t_project_scheme_model");
		$userinfo = $this->t_user_model->get($user_id);
		if($userinfo==false||$scheme_id==""){
			echojson(1,"",'非法操作');
		}
		$schemeinfo = $this->t_project_scheme_model->get($scheme_id);
		if($schemeinfo==false){
			echojson(1,"",'非法操作');
		}
		if($schemeinfo->scheme_user_type!=2){
			echojson(1,"",'只有设计师发布的案例可以执行此操作哦');
		}
		//判断用户是否是普通用户
		if($userinfo->group_id>10){
			echojson(1,"",'只有普通用户可以操作哦');
		}
		//获取当前用户默认项目
		$this->load->model("t_project_model");
		$projectinfo = $this->t_project_model->GetProjectInfoByDefault($user_id);
		if($projectinfo==false){
			echojson(1,"",'请设置默认项目');
		}
		$project_id = $projectinfo->project_id;
		//查询当前项目是否已经应用过该案例
		$this->load->model("t_project_scheme_use_model");
		$scheme_use = $this->t_project_scheme_use_model->getSchemeUseByProjectSchemeUser($project_id,$scheme_id,$user_id);	
		if($scheme_use!=false){
			echojson(1,"",'当前项目已经应用过该案例');
		}
		//查询是否下载过该案例
		$this->load->model("t_user_down_model");
		$checkDown= $this->t_user_down_model->checkDownBySchemeUser($scheme_id,$user_id,2);	
		$downset_score = 0;
		$downset_gold= 0;
		if($checkDown==false){
			$this->load->model("t_project_scheme_downset_model");
			$downset = $this->t_project_scheme_downset_model->getDownSetBySchemeId($scheme_id);	
			if($downset!=false){
				$downset_score = $downset->downset_score;	
				//$downset_gold = $downset->downset_gold;	
				if($userinfo->user_score<$downset_score/*||$userinfo->user_gold<$downset_gold*/){
					//echojson(1,"",'积分或金币不足');
					echojson(1,"",'积分不足');
				}
			}
		}
		$this->t_user_down_model->user_id=$user_id;	
		$this->t_user_down_model->user_down_type=2;	
		$this->t_user_down_model->user_down_objid=$scheme_id;	
		$this->t_user_down_model->room_downscore=$downset_score;	
		$this->t_user_down_model->room_downgold=$downset_gold;	
		$user_down_id = $this->t_user_down_model->insert();
		if($user_down_id==false){
			echojson(1,"",'插入用户下载信息失败');
		}else{
			//更新用户积分信息	
			$this->t_user_model->user_status($user_id,"user_score",'-',$downset_score);	
			//$this->t_user_model->user_status($user_id,"user_gold",'-',$downset_gold);	
			//更新方案下载数		
			$this->t_project_scheme_model->scheme_status($scheme_id,"scheme_downs",'+');	
			//插入方案应用信息
			$this->t_project_scheme_use_model->user_id=$user_id;	
			$this->t_project_scheme_use_model->project_id=$project_id;	
			$this->t_project_scheme_use_model->scheme_id=$scheme_id;	
			$this->t_project_scheme_use_model->scheme_use_is_now=1;	
			$scheme_use_id = $this->t_project_scheme_use_model->insert();
			if($scheme_use_id==false){
				echojson(1,"",'插入方案应用表失败');
			}else{
				//更新用户其他案例状态为非默认
				$this->t_project_scheme_use_model->scheme_status($scheme_use_id,$project_id,$user_id,'0',"<>");	
				//更新用户默认项目方案数
				$this->t_project_model->project_status($project_id,"project_schemes",'+');	
				$msg = "恭喜，操作成功";
				if($downset_score!=0){
					$msg .= "消耗了".$downset_score."积分,您当前的积分为".($userinfo->user_score-$downset_score);
				}
				//if($downset_gold!=0){
				//$msg .="消耗了".$downset_gold."金币,当前金币为".($userinfo->user_gold-$user_gold);
				//}
				$data['info'] = $msg;
				$data['scheme_url'] = $config['schemeinfo'].$scheme_id;
				echojson(0,"",$data);
			}	
		}
	}
}

