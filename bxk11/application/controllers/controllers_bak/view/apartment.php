<?php
/**
 *description:户型信息
 *author:yanyalong
 *date:2013/12/14
 */
class Apartment extends User_Controller {
	function __construct(){
		parent::__construct();
		//$this->ajax_checklogin();
	}

	/**
	 *description:获取户型类型列表
	 *author:yanyalong
	 *date:2013/12/14
	 */
	public function typelist(){
		$list = model("t_system_class")->classlist(13,"空间");		
		if($list==false){
			echojson(1,"","无相关数据");
		}
		$res= model("t_system_class")->taglist($list[0]->s_class_name);
		if($res==false){
			echojson(1,"","无相关数据");
		}
		$taglist = array();
		foreach ($res as $key=>$val) {
			$taglist[$key]['tag_id'] = $val->tag_id;
			$taglist[$key]['tag_name'] = $val->tag_name;
		}
		echojson(0,$taglist);		
	}
	/**
	 *description:获取户型图
	 *author:yanyalong
	 *date:2013/12/14
	 */
	public function getfloorpic(){
		safeFilter();
		$apartment_category_id= $this->input->post('tag_id',true);
		$house_id= $this->input->post('house_id',true);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		//$apartment_category_id= 303;
		//$house_id = 4;
		$list = model("t_house_apartment")->getFloorPic($apartment_category_id,$house_id,$user_id);		
		if($list==false){
			echojson(1,"","无相关户型信息");
		}
		$floorpic = array();
		foreach ($list as $key=>$val) {
			$floorpic[$key]['apartment_id']	= $val->apartment_id;
			$floorpic[$key]['apartment_floor_pic1']	= apartmenturl($val->apartment_id,$val->apartment_floor_pic1);
			$floorpic[$key]['apartment_category']	= $val->apartment_category;
			$floorpic[$key]['apartment_title']	= $val->apartment_title;
			$floorpic[$key]['apartment_size']	= $val->apartment_size;
		}
		echojson(0,$floorpic);
	}
}




