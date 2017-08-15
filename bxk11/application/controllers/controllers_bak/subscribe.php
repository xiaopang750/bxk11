<?php
/*description:订阅模块
 *author:yanyalong
 *date:2013/07/31
 */
class Subscribe extends Temp_Controller {

	function __construct(){
		parent::__construct();
	}
	//批量订阅主题
	public function add_subs(){
				
		$tagid_list= $this->input->post('tagid_list',true);
			$user_id = $_SESSION['user_id'];
		$this->load->model('Bxk_tag_take_model');
		$sub = $this->Bxk_tag_take_model->subs_add($tagid_list,$user_id);
		if($sub!=false){
			echojson(1,'订阅成功');
		}else{
			echojson(0,'订阅失败');
		}
	}
	//订阅主题
	public function add_sub(){
		$tag_id=isset($_POST['tag_id'])?$this->input->post('tag_id',true):'';
		$user_id = $_SESSION['user_id'];
		$this->load->model('Bxk_tag_take_model');
		$sub = $this->Bxk_tag_take_model->sub_add($tag_id,$user_id);
		if($sub!=false){
			model('bxk_tag_model')->modtag_users($tag_id,'+');				
			echojson(1,'订阅成功');
		}else{
			echojson(0,'订阅失败');
		}
	}
	/**
	 *description:取消订阅
	 *author:yanyalong
	 *date:2013/09/22
	 */
	public function del_sub(){
		$tag_id=isset($_POST['tag_id'])?$this->input->post('tag_id',true):'';
		$user_id = $_SESSION['user_id'];
		$this->load->model('Bxk_tag_take_model');
		$sub = $this->Bxk_tag_take_model->del_sub($tag_id,$user_id);
		if($sub!=false){
			model('bxk_tag_model')->modtag_users($tag_id,'-');				
			echojson(1,'取消成功');
		}else{
			echojson(0,'取消失败');
		}
	}
	/**
	 *description:获取订阅列表
	 *author:yanyalong
	 *date:2013/09/24
	 */
	public function mysublist(){
				
		$user_id = $_SESSION['user_id'];
		$mysublist = model("bxk_tag_take_model")->mysublist($user_id);
		if($mysublist==false){
			echojson(0,'暂无订阅');
		}else{
			echojson(1,$mysublist);
		}
	}
}


