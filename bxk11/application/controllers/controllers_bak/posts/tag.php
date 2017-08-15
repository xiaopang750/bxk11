<?php
/*description:标签相关
 *author:yanyalong
 *date:2013/07/28
 */
class Tag extends User_Controller {

	function __construct(){
		parent::__construct();
		$this->ajax_checklogin();
	}
	/**
	 *description:订阅、取消订阅
	 *author:yanyalong
	 *date:2013/11/13
	 */
	public function take(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		loadLib("Score_Class");
		$Score_Class = new Score_Class($user_id,"take_add");
		if($Score_Class->checkScore()==false){
			echojson(1,'',"积分不足");
		}			
		$tag_id= $this->input->post('tid',true);
		$this->load->model('t_tag_take_model');
		$take = $this->t_tag_take_model->exist_take($tag_id,$user_id);
		if($take=="0"){
			$sub = $this->t_tag_take_model->sub_add($tag_id,$user_id);
			if($sub!=false){
				if($Score_Class->checkMax()==true){
					$Score_Class->modScore();
				}			
				loadLib("User_Feed");
				new Feed("GetFeedByTakeTag",$user_id,$tag_id);
				model("t_tag")->modcount($tag_id,'tag_users','+');
				echojson(0,'订阅成功');
			}else{
				echojson(1,'订阅失败');
			}
		}else{
			$sub = $this->t_tag_take_model->del_sub($tag_id,$user_id);
			if($sub!=false){
				model("t_tag")->modcount($tag_id,'tag_users','-');
				echojson(0,'取消成功');
			}else{
				echojson(1,'取消失败');
			}
		}
	}
}

