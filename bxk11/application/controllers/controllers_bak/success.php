<?php
/**
 *description:注册成功跳转页
 *author:yanyalong
 *date:2013/08/01
 */
class Success extends Temp_Controller {
	function __construct(){
		parent::__construct();
	}
	//注册成功跳转展示页内容
	public function theme(){
		
		$this->load->model('Bxk_system_model');
		$tags = $this->Bxk_system_model->theme_recommend(12);
		if(!empty($tags)){
			echojson(1,$tags);
		}else{
			echojson(0,'无相关数据');
		}
	} 
}


