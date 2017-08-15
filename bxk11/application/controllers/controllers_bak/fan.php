<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:查询当前登录用户的粉丝
 *author:chenyuda	
 *date:2013/08/01
 */
class Fan extends Temp_Controller {
	function __construct(){
        parent::__construct();	
    }
	//查询当前登录用户的fans
	function sel_fan()
	{
		
		$this->load->model('Bxk_user_follow_model');
		$fan['fans'] = $this->Bxk_user_follow_model->dis_fan();
		$user_info = model("bxk_user_model")->userinfo($user_id);
		$fan['user_fans'] = $user_info['user_fans'];
		if($fan!=false){
			echojson(1,$fan);
		}else{
			echojson(0,'无相关数据');
		}
	}

	
}
