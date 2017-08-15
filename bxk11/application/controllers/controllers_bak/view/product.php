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
	public function  service(){
		safeFilter();
		//$product_id = $this->input->post('pid',true);
		//$city = $this->input->post('city',true);
		for ($i = 0; $i <10; $i++) {
			$data["city"]['district_code'] = "110000";
			$data["city"]['district_name'] = "北京市";
			$data['servicelist'][$i]['service_id'] = rand(1,1000);
			$data['servicelist'][$i]['service_name'] = "北京市灵感无限公司第".rand(1,1000)."分公司";
			$data['servicelist'][$i]['service_url'] = "#";
		}
		echojson(0,$data);
	}
	/**
	 *description:获取产品详情
	 *author:yanyalong
	 *date:2013/12/28
	 */
	public function info(){
		safeFilter();
		$product_id = $this->input->post('pid',true);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->load->model('t_certified_product_model');
		$this->load->model('t_system_class_model');
		$this->load->model('t_tag_model');
		$this->load->model('t_certified_product_tag_model');
		$this->config->load('uploads');		
		$upload_config = $this->config->item("product");		
		$res = $this->t_certified_product_model->getProductInfoById($product_id);
		if($res==false){
			echojson(1,'',"无相关数据");
		}
		//$data['product_brand']= $res->brand_name;
		//echo "<pre>";var_dump($res->brand_name);exit;
		//$sdd->ffff= $res->brand_name;
		$data['product_brand']= $res->brand_name;
		$data['product_name']= $res->product_name;
		$data['product_code']= $res->product_system_code;
		$data['product_price']= $res->product_price;
		$data['product_hot']=$res->product_hot;
		$data['product_size']= $res->product_long."*".$res->product_width."*".$res->product_high;
		$data['product_style']= "";
		$product_tag = $this->t_certified_product_tag_model->getTagByProductId($product_id);
		$data['product_class_b']= "";
		$data['product_class_s']= "";
		if($product_tag!=false){
			$taginfo = $this->t_tag_model->getTagInfoByTagClass(12,$product_tag->tag_id); 
			if($taginfo!=""){
				$data['product_class_b']= $taginfo->s_class_p_name;
				$data['product_class_s']= $taginfo->s_class_name;
			}
		}
		if($res->product_resultpic!=""){
			foreach (explode('|',$res->product_resultpic) as $key=>$val) {
				$data['product_piclist'][$key]['s'] = $upload_config['relative_path'].'thumb_3/'.$val;				
				$data['product_piclist'][$key]['b'] = $upload_config['relative_path'].'thumb_1/'.$val;				
			}
		}
		$data['product_unit']= $res->product_unit;
		$data['product_description']= $res->product_description;
		$data['product_series']= $res->series_name;
		$data['product_materials']= $res->product_materials;
		$data['product_auxiliary']= $res->product_auxiliary;
		$data['product_pattern']= $res->pattern_type;
		if($user_id==""){
			$data['is_collect']= "0";		
		}else{
			$data['is_collect']= model('t_like_product')->is_like($product_id,$user_id);	
		}
		echojson(0,$data);
	}
	/**
	 *description:产品相关样板间
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function room(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$product_id = $this->input->post('pid',true);
		$this->load->model('t_project_room_bill_item_model');
		$res= $this->t_project_room_bill_item_model->getRoomListByProductId($product_id);
		$this->load->model('t_project_room_model');
		$data = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		$this->load->model('t_user_info_model');
		if($res==false){
			echojson(1,'',"无相关数据");
		}
		foreach ($res as $key=>$val) {
			$data[$key]['room_name'] = $val->room_name;
			$data[$key]['room_thinking'] = $val->room_thinking;
			$data[$key]['room_views'] = $val->room_views;
			$data[$key]['room_url'] = $config['roominfo'].$val->room_id;
			$data[$key]['room_pic'] =  roomurl($val->room_id)."rectangle_thumb.jpg";
			$data[$key]['user_pic'] = $this->t_user_info_model->avatar($val->user_id);
			$data[$key]['user_id'] = $val->user_id;
			$data[$key]['designer'] = $val->user_nickname;
			$data[$key]['company'] = $val->user_company;
			$data[$key]['userspace'] = $config['userspace'].$val->user_id;
			$data[$key]['send_message'] = $config['sendmsg'];
			$tagarr = explode(',',$val->room_keyword);
			//$tagarr =model("t_project_room_tag")->getTagByRoom($val->room_id); 
			foreach ($tagarr as $keys=>$vals) {
				$data[$key]['roomtag_list'][$keys]['tag_name']= $vals; 
				$data[$key]['roomtag_list'][$keys]['tag_url']= "#"; 
			}
			if($user_id==""){
				$data[$key]['is_follow'] = "0";		
			}else{
				$data[$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->user_id);	
			}
			$data[$key]['is_me'] = ($val->user_id==$user_id)?"1":"0";
		}
		echojson(0,$data);
	}
}

