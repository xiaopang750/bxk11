<?php
class userset extends User_Controller {

	function __construct(){
		parent::__construct();
		$this->ajax_checklogin();
	}
	/**
	 *description:关注/取消关注
	 *author:yanyalong
	 *date:2013/11/08
	 */
	public function follow(){
		safeFilter();
		$follow_uid = $this->input->post('uid',true);	
		$user_id = $_SESSION['user_id'];
		loadLib("Score_Class");
		$Score_Class = new Score_Class($user_id,"follow_add");
		if($Score_Class->checkScore()==false){
			echojson(1,'',"积分不足");
		}			
		$this->load->model("t_user_follow_model");
		$is_exist = model("t_user")->get($follow_uid);	
		if($is_exist==false){
			echojson(1,'不存在的用户');
		}
		if($user_id==$follow_uid){
			echojson(1,'你不能关注你自己');
		}
		$is_black = model("t_user_disable")->is_black($follow_uid,$user_id);	
		if($is_black=='1'){
			echojson(1,"",'根据对方设置，您无法进行该操作');
		}
		$is_follow = $this->t_user_follow_model->is_follow($user_id,$follow_uid);	
		$this->t_user_follow_model->user_id = $user_id;
		$this->t_user_follow_model->follow_uid=$follow_uid;
		if($is_follow=='1'){
			if($this->t_user_follow_model->del_follow()!=false){
				model("t_user")->user_status($user_id,'user_follows','-');
				model("t_user")->user_status($follow_uid,'user_fans','-');
				echojson(0,'取消成功');
			}else{
				echojson(1,'取消失败');
			}
		}else{
			if($this->t_user_follow_model->insert()!=false){
				if($Score_Class->checkMax()==true){
					$Score_Class->modScore();
				}			
				model("t_user")->user_status($user_id,'user_follows','+');
				model("t_user")->user_status($follow_uid,'user_fans','+');
				loadLib("Notice");
				$notice = new Notice("GetNoticeByFollow",$user_id,"","","","",$follow_uid);
				loadLib("User_Feed");
				new Feed("GetFeedByFollow",$user_id,$follow_uid);
				echojson(0,"",'关注成功');
			}else{
				echojson(1,"",'关注失败');
			}
		}
	}
	/**
	 *description:拉黑/取消拉黑
	 *author:yanyalong
	 *date:2013/11/08
	 */
	public function black(){
		safeFilter();
		$udisable_user_id = $this->input->post('uid',true);
		$user_id = $_SESSION['user_id'];
		$is_exist = model("t_user")->get($udisable_user_id);	
		if($is_exist==false){
			echojson(1,'不存在的用户');
		}
		if($udisable_user_id==$user_id){
			echojson(1,'自己不能拉黑自己哦！');
		}
		$this->load->model("t_user_disable_model");
		$is_black = $this->t_user_disable_model->is_black($user_id,$udisable_user_id);	
		$this->t_user_disable_model->user_id= $user_id;
		$this->t_user_disable_model->udisable_user_id=$udisable_user_id;
		$this->t_user_disable_model->udisable_status=1;
		if($is_black=='1'){
			if($this->t_user_disable_model->del_black()!=false){
				echojson(0,'取消成功');
			}else{
				echojson(1,'取消失败');
			}
		}elseif($is_black=='11'){
			if($this->t_user_disable_model->set_black()!=false){
				//如果关注了该用户则取消关注
				$this->load->model("t_user_follow_model");
				$is_follow = $this->t_user_follow_model->is_follow($user_id,$udisable_user_id);	
				$this->t_user_follow_model->user_id = $user_id;
				$this->t_user_follow_model->follow_uid=$udisable_user_id;
				if($is_follow=='1'){
					if($this->t_user_follow_model->del_follow()!=false){
						model("t_user")->user_status($user_id,'user_follows','-');
						model("t_user")->user_status($udisable_user_id,'user_fans','-');
					}
				}
				echojson(0,'拉黑成功');
			}else{
				echojson(1,'拉黑失败');
			}
		}else{
			if($this->t_user_disable_model->insert()!=false){
				$this->load->model("t_user_follow_model");
				$is_follow = $this->t_user_follow_model->is_follow($user_id,$udisable_user_id);	
				$this->t_user_follow_model->user_id = $user_id;
				$this->t_user_follow_model->follow_uid=$udisable_user_id;
				if($is_follow=='1'){
					if($this->t_user_follow_model->del_follow()!=false){
						model("t_user")->user_status($user_id,'user_follows','-');
						model("t_user")->user_status($udisable_user_id,'user_fans','-');
					}
				}
				echojson(0,"",'拉黑成功');
			}else{
				echojson(1,"",'拉黑失败');
			}
		}
	}
	/**
	 *description:发送私信功能
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function sendmsg(){
		safeFilter();
		$_POST = disableCheck();
		$msg_content = $this->input->post('msg_content',true);
		$msg_to_usernick= $this->input->post('to_usernick',true);
		$msg_to_uid= $this->input->post('to_uid',true);
		$user_id = $_SESSION['user_id'];
		$user_nickname = $_SESSION['user_nickname'];
		if((strlen(trim($msg_content)) + mb_strlen(trim($msg_content),'UTF8'))/2>1000){
			echojson(1,'私信内容最多不能超过500个字');
		}
		$this->load->model('t_user_msg_model');
		$msg=$this->t_user_msg_model->letter_deal($user_id,$msg_content,$msg_to_uid,$msg_to_usernick,$user_nickname);
		if($msg==1){
			echojson(0,"",'发送成功');
		}elseif($msg==2){
			echojson(1,"",'根据对方设置，您无法进行该操作');
		}else{
			echojson(1,"",'发送失败');
		}
	}
	/**
	 *description:删除全部通知
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function delallnotice(){
		$user_id = $_SESSION['user_id'];
		$this->load->model('t_user_notice_model');
		if($this->t_user_notice_model->del_allnotice($user_id)==false){
			echojson(1,'','删除失败');
		}else{
			echojson(0,'','删除成功');
		}
	}
	/**
	 *description:删除私信
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function removemsg(){
		safeFilter();
		$this->load->model('t_user_msg_model');
		$user_id = $_SESSION['user_id'];
		$uid = $this->input->post('uid',true);	
		$res = $this->t_user_msg_model->letter_del($user_id,$uid);
		if($res!=false){
			echojson(0,'删除成功');
		}else{
			echojson(1,'删除失败');
		}
	}
	/**
	 *description:不感兴趣
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function notinterest(){
		safeFilter();
		$udisable_user_id = $this->input->post('uid',true);
		$user_id = $_SESSION['user_id'];
		$is_exist = model("t_user")->get($udisable_user_id);	
		if($is_exist==false){
			echojson(1,'不存在的用户');
		}
		if($udisable_user_id==$user_id){
			echojson(1,'亲，不要讨厌自己！');
		}
		$this->load->model("t_user_disable_model");
		$is_black = $this->t_user_disable_model->is_black($user_id,$udisable_user_id);	
		$this->t_user_disable_model->user_id= $user_id;
		$this->t_user_disable_model->udisable_user_id=$udisable_user_id;
		$this->t_user_disable_model->udisable_status=11;
		if($is_black!='0'){
			echojson(0,"",'操作成功');
		}else{
			if($this->t_user_disable_model->insert()!=false){
				echojson(0,"",'操作成功');
			}else{
				echojson(1,"",'操作失败');
			}
		}
	}
	/**
	 *description:输入昵称拉黑
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function blacknickname(){
		safeFilter();
		$user_nickname= $this->input->post('nickname',true);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$res=model("t_user_disable")->add_black($user_id,$user_nickname);
		if($res=='0'){
			echojson(1,"",'添加失败');
		}elseif($res=='1'){
			echojson(1,"",'用户名不能为空');
		}elseif($res=='2'){
			echojson(1,"",'不存在的用户名');
		}elseif($res=='3'){
			echojson(1,"",'不能将自己拉入黑名单');
		}elseif($res=='4'){
			echojson(1,"",'该用户已经在您的黑名单中了');
		}else{
			echojson(0,$res);
		}
	}
	/**
	 *description:移除粉丝
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function removefans(){
		safeFilter();
		$user_id = $_SESSION['user_id'];
		$follow_uid =  $this->input->post('uid',true);
		$this->load->model('t_user_follow_model');
		$this->t_user_follow_model->user_id = $follow_uid;
		$this->t_user_follow_model->follow_uid = $user_id;
		$is_follow = model('t_user_follow')->is_follow($follow_uid,$user_id);	
		if($is_follow=="1"){
			$res = $this->t_user_follow_model->del_follow();
			if($res!=false){	
				model("t_user")->user_status($user_id,'user_fans','-');
				model("t_user")->user_status($follow_uid,'user_follows','-');
				echojson(0,"",'移除成功');
			}else{
				echojson(1,"",'移除失败');
			}
		}else{
			echojson(1,"",'该用户并未关注您');
		}
	}
	/**
	 *description:搜索我的粉丝
	 *author:yanyalong
	 *date:2013/11/12
	 */
	public function search_fans(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->load->model('t_user_follow_model');
		$user_nickname= $this->input->post('nickname',true);
		$p= $this->input->post('p',true);
		$arr=$this->t_user_follow_model->fans_search($user_nickname,$user_id,$p,2);
		if($arr!=false){
			echojson(0,$arr);
		}else{
			echojson(1,"",'没有搜索结果');
		}
	}
	/**
	 *description:搜索我的关注
	 *author:yanyalong
	 *date:2013/11/12
	 */
	public function search_follows(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->load->model('t_user_follow_model');
		$user_nickname= $this->input->post('nickname',true);
		$p= $this->input->post('p',true);
		$arr=$this->t_user_follow_model->follow_search($user_nickname,$user_id,$p,2);
		if($arr!=false){
			echojson(0,$arr);
		}else{
			echojson(1,"",'没有搜索结果');
		}
	}
	/**
	 *description:根据父id获取地区列表信息
	 *author:yanyalong
	 *date:2013/11/14
	 */
	public function getdistrict(){
		safeFilter();
		$district_pcode= $this->input->post('district_pcode',true);
		$this->load->model("t_system_district_model");
		$this->t_system_district_model->district_pcode = $district_pcode;
		$res = $this->t_system_district_model->getDepthByPcode();
		if($res==false){
			echojson(1,"",'无相关结果');
		}else{
			echojson(0,$res);
		}
	}
	/**
	 *description:修改昵称
	 *author:yanyalong
	 *date:2013/11/14
	 */
	public function nickname(){
		safeFilter();
		$user_nickname = $this->input->post('nickname',true);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->load->model('t_user_model');
		if($user_nickname == '')
		{
			echojson(1,"",'用户名不能为空');
		}
		if((strlen($user_nickname) + mb_strlen($user_nickname,'UTF8'))/2>20){
			echojson(1,"",'昵称长度不能超过10个字');
		}
		$res= $this->t_user_model->update_nick($user_nickname,$user_id);
		if($res==1){
			echojson(1,"",'用户名已存在');
		}elseif($res==2){
			echojson(1,"",'修改失败');
		}else{
			echojson(0,"",'修改成功');
		}
	}
	/**
	 *description:修改密码
	 *author:yanyalong
	 *date:2013/11/14
	 */
	public function changepass(){
		safeFilter();
		$user_passwd = $this->input->post('password',true);
		$user_passwd1 = $this->input->post('password1',true);
		$user_passwd2 = $this->input->post('password2',true);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->load->model('t_user_model');
		$userinfo = $this->t_user_model->get($user_id);	
		if($userinfo->user_passwd!=md5($user_passwd)){
			echojson(1,"",'原密码输入错误');
		}
		if($user_passwd==''||$user_passwd1==''||$user_passwd2=='')
		{
			echojson(1,"",'输入项不完整');
		}
		if(!preg_match('/^[a-zA-Z\d_]{6,16}$/',$user_passwd1)){
			echojson(1,"",'密码格式不正确');
		}		
		if($user_passwd1!=$user_passwd2){
			echojson(1,"",'两次密码不一致');
		}
		$res= $this->t_user_model->update_passwd(md5($user_passwd1),$user_id);
		if($res==false){
			echojson(1,"",'修改失败');
		}else{
			echojson(0,"",'修改成功');
		}
	}
	/**
	 *description:修改邮箱
	 *author:yanyalong
	 *date:2013/11/14
	 */
	function changeemail(){
		safeFilter();
		$this->load->model('t_user_model');
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$user_email = $this->input->post('user_email');
		if($user_email==""){
			echojson(1,"",'邮箱不能为空');
		}
		if(!preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$user_email)){
			echojson(1,"",'邮箱格式不正确');
		}else{
			$res= $this->t_user_model->update_email($user_email,$user_id);
			if($res==1){
				echojson(1,"",'邮箱已存在');
			}elseif($res==2){
				echojson(1,"",'修改失败');
			}else{
				echojson(0,"",'修改成功');
			}
		}
	}
	/**
	 *description:修改用户地址
	 *author:yanyalong
	 *date:2013/11/14
	 */
	public function address(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$provinceid = $this->input->post('provinceid',true);
		$cityid = $this->input->post('cityid',true);
		$provinceid = model("t_system_district")->get($cityid)->district_pid;
		$user_address= $this->input->post('user_address',true);
		if($provinceid==""||$cityid==""){
			echojson(1,"",'请选择省份和城市');
		}	
		$this->load->model('t_user_info_model');
		$data['provinceid']= $provinceid;
		$data['cityid'] = $cityid;
		$data['user_address']= $user_address;
		$data['user_id']= $user_id;
		$where = array('user_id'=>$user_id);
		$res = $this->t_user_info_model->update('t_user_info',$data,$where);
		if($res == true){
			echojson(0,"",'修改成功');
		}else{
			echojson(1,"",'修改失败');
		}
	}
	/**
	 *description:修改站内通知项
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function noticeoptions(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$noticeoptions = $this->input->post('noticeoptions',true);
		if($noticeoptions==""||count(explode(',',$noticeoptions))!=5){
			echojson(1,"",'数据异常');
		}	
		$this->load->model('t_user_info_model');
		$res = $this->t_user_info_model->update_notice($noticeoptions,$user_id);
		if($res == true){
			echojson(0,"",'修改成功');
		}else{
			echojson(1,"",'修改失败');
		}
	}

	/**
	 *description:修改站内邮件通知项
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function mailoptions(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$mailoptions = $this->input->post('mailoptions',true);
		if($mailoptions==""||count(explode(',',$mailoptions))!=2){
			echojson(1,"",'数据异常');
		}	
		$this->load->model('t_user_info_model');
		$res = $this->t_user_info_model->update_mail($mailoptions,$user_id);
		if($res == true){
			echojson(0,"",'修改成功');
		}else{
			echojson(1,"",'修改失败');
		}
	}
	/**
	 *description:批量删除通知
	 *author:yanyalong
	 *date:2013/11/18
	 */
	public function del_notices(){
		safeFilter();
		$notice_id_list= trim($this->input->post('notice',true),',');
		$this->load->model('t_user_notice_model');
		if($this->t_user_notice_model->del_notices($notice_id_list)!=false){
			unset($_SESSION['notice_show']);
			setcookie("notice_show","",time()-3600);
			echojson(0,"",'执行成功');
		}else{
			echojson(1,"",'无相关数据');
		}
	}

	/**
	 *description:修改头像信息
	 *author:yanyalong
	 *date:2013/11/19
	 */
	function setavatar(){
		safeFilter();
		$this->load->model('t_user_info_model');
		$user_id = $this->input->post('user_id');
		$user_pic = $this->input->post('user_pic');
		$res=$this->t_user_info_model->set_head($user_id,$user_pic);
		$user_pic = model("t_user_info")->avatar($user_id);
		if($res==true){
			echojson(0,$user_pic,'修改成功');
		}else{
			echojson(1,"",'修改失败');
		}
	}
}



