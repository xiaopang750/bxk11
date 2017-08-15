<?php
/*description:通知模块控制器
 *author:yanyalong
 *date:2013/07/31
 */
class Notice extends Temp_Controller {
	function __construct(){
		parent::__construct();
	}
	//个人空间通知页面
	public function index(){
		
		$this->load->view('index/user/inform');
	}
	//个人空间通知页面内容
	public function noticeinfo(){
		$user_id = $_SESSION['user_id'];
		$this->load->model('Bxk_user_notice_model');
		$notice_list= $this->Bxk_user_notice_model->getnotice($user_id,1,5);
		if(!empty($notice_list)){
			$this->Bxk_user_notice_model->delnotice($user_id,5);
			echojson(1,$notice_list);
		}else{
			echojson(0,'无相关数据');
		}
	}
	//个人空间最新通知
	public function spacenotice(){
		if(isset($_SESSION['notice_show'])&&$_SESSION['notice_show']=='1'){
			$user_id = $_SESSION['user_id'];
			$notice_list= model('Bxk_user_notice_model')->getnotice($user_id,1,5);
			if(!empty($notice_list)){
				echojson(1,$notice_list);
			}else{
				echojson(0,'无相关数据');
			}
		}else{
			echojson(0,'无相关数据');
		}
	}

	/**
	 *description:批量删除通知
	 *author:yanyalong
	 *date:2013/08/23
	 */
	public function del_notices(){
		$notice_id_list= trim($this->input->post('notice_id_list',true),',');
		$this->load->model('Bxk_user_notice_model');
		if($this->Bxk_user_notice_model->del_notices($notice_id_list)!=false){
			unset($_SESSION['notice_show']);
			setcookie("notice_show","",time()-3600);
			echojson(1,'执行成功');
		}else{
			echojson(0,'无相关数据');
		}
	}
	/**
	 *description:删除所有通知
	 *author:yanyalong
	 *date:2013/08/23
	 */
	public function del_allnotice(){
		$user_id = $_SESSION['user_id'];
		$this->load->model('Bxk_user_notice_model');
		if($this->Bxk_user_notice_model->del_allnotice($user_id)==false){
			echojson(0,'删除失败');
		}else{
			echojson(1,'删除成功');
		}
	}
	/**
	 *description:拉黑名单
	 *author:yanyalong
	 *date:2013/08/21
	 */
	public function blackbyuser_id(){
				
		$user_id = $_SESSION['user_id'];
		$udisable_user_id= $this->input->post('udisable_user_id',true);
		$udisable_status= $this->input->post('udisable_status',true);
		$this->load->model('Bxk_user_disable_model');
		if($this->Bxk_user_disable_model->blackbyuser_id($user_id,$udisable_user_id,$udisable_status)){
			echojson(1,'执行成功');
		}else{
			echojson(0,'执行失败');
		}
	}
	/**
	 *description:取消拉黑
	 *author:yanyalong
	 *date:2013/08/21
	 */
	public function delblack(){
				
		$user_id = $_SESSION['user_id'];
		$udisable_user_id= $this->input->post('udisable_user_id',true);
		$this->load->model('Bxk_user_disable_model');
		if($this->Bxk_user_disable_model->del_black($user_id,$udisable_user_id)==0){
			echojson(0,'执行失败');
		}else{
			echojson(1,'执行成成功');
		}
	}
	/**
	 *description:获取我的黑名单列表
	 *author:yanyalong
	 *date:2013/09/23
	 */
	public function myblacklist(){
		$user_id = $_SESSION['user_id'];
		$res = model("Bxk_user_disable_model")->blacklist($user_id,'1');
		if($res==false){
			echojson(0,'暂无数据');
		}else{
			echojson(1,$res);
		}
	}
}

