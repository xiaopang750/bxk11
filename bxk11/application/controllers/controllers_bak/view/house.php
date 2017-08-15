<?php
/**
 *description:楼盘信息
 *author:yanyalong
 *date:2013/12/14
 */
class House extends User_Controller {

	function __construct(){
		parent::__construct();
		//$this->ajax_checklogin();
	}
	
	/**
	 *description:获取楼盘列表
	 *author:yanyalong
	 *date:2013/12/14
	 */
	public function getlist(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$house_name = $this->input->post('house',true);
		$house_city = $this->input->post('house_city',true);
		$list = model("t_house")->getList($house_name,$house_city,$user_id);		
		if($list==false){
			echojson(1,"","该城市暂无楼盘信息");
		}
		$house = array();
		foreach ($list as $key=>$val) {
			$house[$key]['house_id'] = $val->house_id;
			$house[$key]['house_name'] = $val->house_name;
		}
		echojson(0,$house);
	}
}




