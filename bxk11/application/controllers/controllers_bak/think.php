<?php
/**
 *description:灵感主页
 *author:yanyalong
 *date:2013/08/30
 */
class Think extends Temp_Controller {

	function __construct(){
		parent::__construct();
	}
	//灵感首页展示
	function index(){ 
		
		$this->load->view('/index/inspiration/inspiration');
	}
	//灵感首页推荐主题内容
	public function theme(){
		$this->load->model('Bxk_system_model');
		$tags = $this->Bxk_system_model->theme_recommend(8);
		if(!empty($tags)){
			echojson(1,$tags);
		}else{
			echojson(0,'无相关数据');
		}
	} 
	/**
	 *description:灵感首页标签热度排行列表内容
	 *author:yanyalong
	 *date:2013/08/24
	 */
	public function tagrank(){
		$tagrank = model('Bxk_content_tag_model')->tagrank(15);			
		if(!empty($tagrank)){
			echojson(1,$tagrank);
		}else{
			echojson(0,'无相关数据');
		}
	}
}


