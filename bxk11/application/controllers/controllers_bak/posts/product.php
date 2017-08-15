<?php
/**
 *description:用户信息
 *author:yanyalong
 *date:2013/11/05
 */
class Product extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:产品经销商
	 *author:yanyalong
	 *date:2013/12/28
	 */
	public function like(){
		safeFilter();
		$product_id= $this->input->post('pid');
		$user_id = $_SESSION['user_id'];	
		//loadLib("Score_Class");
		//$Score_Class = new Score_Class($user_id,"like_add");
		//if($Score_Class->checkScore()==false){
		//echojson(1,'',"积分不足");
		//}			
		$this->load->model('t_like_product_model');				
		$is_like = $this->t_like_product_model->is_like($product_id,$user_id);	
		$this->t_like_product_model->product_id= $product_id;
		$this->t_like_product_model->user_id = $user_id;
		if($is_like=="1"){
			if($this->t_like_product_model->dellike()!=false){
				//model("t_user")->user_status($user_id,'user_likes','-');
				//model("t_content")->content_status($product_id,'content_likes','-');
				echojson(0,"",'取消喜欢成功');
			}else{
				echojson(1,"",'取消喜欢失败');
			}												
		}else{
			if($this->t_like_product_model->insert()!=false){
				//if($Score_Class->checkMax()==true){
				//$Score_Class->modScore();
				//}			
				//model("t_user")->user_status($user_id,'user_likes','+');
				//model("t_content")->content_status($product_id,'content_likes','+');
				//loadLib("Notice");
				//$notice = new Notice("GetNoticeByLikes",$user_id,$product_id,"1","","","");
				//loadLib("User_Feed");
				//new Feed("GetFeedByLikeContent",$user_id,$product_id);
				echojson(0,"",'喜欢成功');
			}else{
				echojson(1,"",'喜欢失败');
			}
		}
	}
}

