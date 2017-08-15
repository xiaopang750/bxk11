<?php
/**
 *description:探索页
 *author:yanyalong
 *date:2013/08/01
 */
class Explore extends Temp_Controller {

	function __construct(){
		parent::__construct();
	}
	//探索页页面
	function index(){ 
		$this->load->view('/index/views');
	}
	//探索页灵感推荐
	public function content_recommend(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$contentinfo['countinfo'] = model("bxk_content_model")->content_explore();
		$contentinfo['life'] = model("bxk_content_model")->life_recommend(4);
		$contentinfo['design'] = model("bxk_content_model")->design_recommend(2);
		$contentinfo['product'] = model("bxk_content_model")->product_recommend(2);
		$contentinfo['diary'] = model("bxk_content_model")->user_recommend($user_id,4,40);
		if(count($contentinfo['diary'])<40||$contentinfo['life']<4||$contentinfo['design']<2||$contentinfo['product']<2){
			echojson(0,'数据不完整，不展示');
		}
		if(!empty($contentinfo)){
			echojson(1,$contentinfo);
		}else{
			echojson(0,'无相关推荐数据');
		}
	}
}


